<?php

class IWJ_Gateway_Stripe extends IWJ_Payment_Gateway{

    function __construct()
    {
        parent::__construct();

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

    }

    function enqueue_scripts(){
        if($this->is_available()){
            wp_register_script('stripe-checkout', 'https://checkout.stripe.com/checkout.js');
            wp_localize_script('stripe-checkout', 'stripe_options', array('publish_key' => $this->get_publish_key()));
        }
    }

    function get_title(){
        return __('Stripe', 'iwjob');
    }

    function get_description(){
        wp_enqueue_script('stripe-checkout');

        return $this->get_option('description');
    }

    function get_icon(){
        return IWJ_PLUGIN_URL.'/assets/img/paypal.png';
    }

    function admin_option_fields(){
        return array(
            array(
                'id' 			=> 'enable',
                'name'			=> __( 'Enable' , 'iwjob' ),
                'type'			=> 'select',
                'options'		=> array(
                    '1' => __('Yes', 'iwjob'),
                    '0' => __('No', 'iwjob'),
                ),
                'std'		    => '0',
            ),
            array(
                'id' 			=> 'description',
                'name'			=> __( 'Description' , 'iwjob' ),
                'type'			=> 'textarea',
                'std'		    => 'Pay with your credit card via Stripe.',
            ),
            array(
                'id' 			=> 'test_mode',
                'name'			=> __( 'Test Mode' , 'iwjob' ),
                'type'			=> 'select',
                'options'		=> array(
                    '1' => __('Yes', 'iwjob'),
                    '0' => __('No', 'iwjob'),
                ),
                'std'		    => '1',
            ),
            array(
                'id' 			=> 'test_secret_key',
                'name'			=> __( 'Test Secret Key' , 'iwjob' ),
                'type'			=> 'text',
                'std'		=> '',
            ),
            array(
                'id' 			=> 'test_publish_key',
                'name'			=> __( 'Test Publishable Key' , 'iwjob' ),
                'type'			=> 'text',
                'std'		=> '',
            ),
            array(
                'id' 			=> 'secret_key',
                'name'			=> __( 'Live Secret Key' , 'iwjob' ),
                'type'			=> 'text',
                'std'		=> '',
            ),
            array(
                'id' 			=> 'publish_key',
                'name'			=> __( 'Live Publishable Key' , 'iwjob' ),
                'type'			=> 'text',
                'std'		=> '',
            ),
        );
    }

    public function is_available(){

        if($this->get_option('enable') && $this->get_secret_key() && $this->get_publish_key()){
            return true;
        }

        return false;
    }

    function is_test_mode(){
        return $this->get_option('test_mode') == '1' ? true : false;
    }

    function get_secret_key(){
        if($this->is_test_mode()){
            return $this->get_option('test_secret_key');
        }

        return $this->get_option('secret_key');
    }

    function get_publish_key(){
        if($this->is_test_mode()){
            return $this->get_option('test_publish_key');
        }

        return $this->get_option('publish_key');
    }

    function process_payment($order_id, $tab = 'new-job'){
        // Create Token for Card or Customer
        if(isset($_POST['stripe_token'])) {
            $order = IWJ_Order::get_order($order_id);
            if($order){
                if(!class_exists('Stripe')){
                    require(dirname(__FILE__) . '/stripe/stripe_init.php');
                }

                \Stripe\Stripe::setApiKey($this->get_secret_key());

                try {
                    $token_id = $_POST['stripe_token'];
                    $chargeparam = $this->charge_array($order, $token_id);
                    $charge = \Stripe\Charge::create($chargeparam);

                    if ($charge->paid == true) {
                        $note = '';
                        $timestamp = date('Y-m-d H:i:s A e', $charge->created);
                        if ($charge->source->object == "card") {
                            $note = __('Charge ' . $charge->status . ' at ' . $timestamp . ',Charge ID=' . $charge->id . ',Card=' . $charge->source->brand . ' : ' . $charge->source->last4 . ' : ' . $charge->source->exp_month . '/' . $charge->source->exp_year, 'iwjob');
                        }

                        $order->completed_order($note);

                    } else {
                        $order->add_order_note('Charge ' . $charge->status);
                    }

                } catch (Exception $e) {

                    $body = $e->getJsonBody();
                    $error = $body['error']['message'];
                    $order->add_order_note(__('Stripe Error.' . $error, 'iwjob'));
                }

                wp_redirect($order->get_received_url($tab));
                exit;
            }
        }

        wp_redirect(get_home_url('/'));
        exit;
    }

    function payment_recieved($order, $tab){
    }

    public function charge_array($order,$token_id){

        $chargearray = array(
            'amount'                    => $this->stripe_order_total($order),
            'currency'                  => $order->get_currency(),
            'capture'                   => false,
            'metadata'                  => array(
                'Order #'               => $order->get_id(),
                //'Total Tax'             => $order->get_total_tax(),
                //'Customer IP'           => $this->get_client_ip(),
                'WP customer #'         => $order->get_author_id(),
            ) ,
            'description'               => get_bloginfo('blogname').' Order #'.$order->get_id(),
        );
        $chargearray['card']      = $token_id;

        return $chargearray ;
    }

    public function stripe_order_total($order)
    {
        $grand_total    = $order->get_price();
        $currency = '' != $order->get_currency() ? $order->get_currency() : iwj_get_system_currency() ;
        $stripe_zerocurrency = array("BIF","CLP","DJF","GNF","JPY","KMF","KRW","MGA","PYG","RWF","VND","VUV","XAF","XOF","XPF");
        if(in_array($currency ,$stripe_zerocurrency ))
        {
            $amount              = number_format($grand_total,0,".","") ;
        }
        else
        {
            $amount              = $grand_total * 100 ;
        }

        return $amount;
    }
}