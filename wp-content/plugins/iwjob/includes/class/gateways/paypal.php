<?php

class IWJ_Gateway_Paypal extends IWJ_Payment_Gateway{

    function __construct(){

        parent::__construct();

        add_action( 'wp_ajax_iwj_paypal_ipn', array($this, 'ipn_check_response'));
        add_action( 'wp_ajax_nopriv_iwj_paypal_ipn', array($this, 'ipn_check_response') );
    }

    function get_title(){
        return __('Paypal', 'iwjob');
    }

    function get_description(){
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
                'std'		    => 'Pay via PayPal; you can pay with your credit card if you don\'t have a PayPal account.',
            ),
            array(
                'id' 			=> 'sandbox',
                'name'			=> __( 'Sandbox' , 'iwjob' ),
                'desc'	        => __( 'Sandbox method.', 'iwjob' ),
                'type'			=> 'select',
                'options'		=> array(
                    '1' => __('Yes', 'iwjob'),
                    '0' => __('No', 'iwjob'),
                ),
                'std'		    => '1',
            ),
            array(
                'id' 			=> 'email',
                'name'			=> __( 'Paypal email' , 'iwjob' ),
                'type'			=> 'text',
                'std'		=> '',
            ),
            array(
                'id' 			=> 'identity_token',
                'name'			=> __( 'Identity Token' , 'iwjob' ),
                'desc'	=> __( 'Using for PDT Notification', 'iwjob' ),
                'type'			=> 'text',
                'std'		=> '',
            ),
        );
    }

    public function is_available(){

        if($this->get_option('enable') && $this->get_option('email')){
            return true;
        }

        return false;
    }

    function get_payment_gateway_url(){
        if ($this->get_option('sandbox')) {
            return "https://www.sandbox.paypal.com/cgi-bin/webscr";
        } else {
            return "https://www.paypal.com/cgi-bin/webscr";
        }
    }

    public function get_ipn_url(){
        $url = home_url('/'). 'wp-admin/admin-ajax.php?action=iwj_paypal_ipn';
        return $url;
    }

    function process_payment($order_id, $tab = 'new-job'){
        $output = '';
        $order = IWJ_Order::get_order($order_id);
        if($order){
            $business_email = $this->get_option('email');
            $currency = iwj_get_currency();
            $price = $order->get_price();
            $title = $order->get_title();
            $return_url = $this->get_received_url($order, $tab);
            $cancel_url = $order->get_cancel_url('jobs');
            $output .= '<form name="PayPalForm" id="iwj-paypal-form" action="' . $this->get_payment_gateway_url() . '" method="post">  
                            <input type="hidden" name="cmd" value="_xclick">  
                            <input type="hidden" name="business" value="' . sanitize_email($business_email) . '">
                            <input type="hidden" name="amount" value="' . $price . '">
                            <input type="hidden" name="item_name" value="' . sanitize_text_field($title) . '"> 
                            <input type="hidden" name="currency_code" value="' . $currency . '">
                            <input type="hidden" name="item_number" value="' . $order->get_id() . '">  
                            <input type="hidden" name="custom" value="' . $order->get_key(). '">  
                            <input name="cancel_return" value="' . esc_url($cancel_url) . '" type="hidden">  
                            <input type="hidden" name="no_note" value="1">  
                            <input type="hidden" name="notify_url" value="' . sanitize_text_field($this->get_ipn_url()) . '">
                            <input type="hidden" name="lc">
                            <input type="hidden" name="rm" value="'.(is_ssl() ? 2 : 1).'">
                            <input type="hidden" name="return" value="' . esc_url($return_url) . '">  
                        </form>';
            echo $output;
            echo '<script>
				  	document.getElementById("iwj-paypal-form").submit();
				  </script>';
        }

        die;
    }

    /**
     * Check Response for PDT.
     */
    public function pdt_check_response() {
        if ( empty( $_REQUEST['item_number'] ) || empty( $_REQUEST['tx'] ) || empty( $_REQUEST['st'] ) ) {
            return false;
        }

        $order_id    = iwj_clean( stripslashes( $_REQUEST['item_number'] ) );
        $status      = iwj_clean( strtolower( stripslashes( $_REQUEST['st'] ) ) );
        $amount      = iwj_clean( stripslashes( $_REQUEST['amt'] ) );
        $transaction = iwj_clean( stripslashes( $_REQUEST['tx'] ) );

        if ( ! ( $order = IWJ_Order::get_order( $order_id ) ) || $order->get_status() != 'iwj-pending-payment' ) {
            return false;
        }

        $transaction_result = $this->pdt_validate_transaction( $transaction );

        update_post_meta( $order->get_id(), '_paypal_status', $status );
        update_post_meta( $order->get_id(), '_transaction_id', $transaction );

        if ( $transaction_result ) {
            if ( 'completed' === $status ) {
                if ( $order->get_price() != $amount ) {
                    //IWJ_Log::add( 'Payment error: Amounts do not match (amt ' . $amount . ')', 'error' );
                    $order->change_status('iwj-hold', __( 'Validation error: PayPal amounts do not match (amt %s).', 'iwjob' ));
                } else {
                    $order->completed_order(__( 'PDT payment completed.', 'iwjob' ));
                }
            } else {
                if ( 'authorization' === $transaction_result['pending_reason'] ) {
                    $order->change_status('iwj-hold', __( 'Payment authorized. Change payment status to processing or complete to capture funds.', 'iwjob' ));
                } else {
                    $order->change_status('iwj-hold', sprintf( __( 'Payment pending (%s).', 'iwjob' ), $transaction_result['pending_reason'] ));
                }
            }
        }

        return true;
    }

    //pdt validate
    protected function pdt_validate_transaction( $transaction ) {
        $pdt = array(
            'body' 			=> array(
                'cmd' => '_notify-synch',
                'tx'  => $transaction,
                'at'  => $this->get_option('identity_token'),
            ),
            'timeout' 		=> 60,
            'httpversion'   => '1.1',
            'user-agent'	=> 'IWJ/',
        );

        // Post back to get a response.
        $response = wp_safe_remote_post( $this->get_option('sandbox') ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr', $pdt );

        if ( is_wp_error( $response ) || ! strpos( $response['body'], "SUCCESS" ) === 0 ) {
            return false;
        }

        // Parse transaction result data
        $transaction_result  = array_map( 'iwj_clean', array_map( 'urldecode', explode( "\n", $response['body'] ) ) );
        $transaction_results = array();

        foreach ( $transaction_result as $line ) {
            $line                            = explode( "=", $line );
            $transaction_results[ $line[0] ] = isset( $line[1] ) ? $line[1] : '';
        }

        if ( ! empty( $transaction_results['charset'] ) && function_exists( 'iconv' ) ) {
            foreach ( $transaction_results as $key => $value ) {
                $transaction_results[ $key ] = iconv( $transaction_results['charset'], 'utf-8', $value );
            }
        }

        return $transaction_results;
    }

    protected function get_paypal_order( $raw_custom ) {
        // We have the data in the correct format, so get the order.
        if ( ( $custom = json_decode( $raw_custom ) ) && is_object( $custom ) ) {
            $order_id  = $custom->order_id;
            $order_key = $custom->order_key;

            // Fallback to serialized data if safe. This is @deprecated in 2.3.11
        } elseif ( preg_match( '/^a:2:{/', $raw_custom ) && ! preg_match( '/[CO]:\+?[0-9]+:"/', $raw_custom ) && ( $custom = maybe_unserialize( $raw_custom ) ) ) {
            $order_id  = $custom[0];
            $order_key = $custom[1];

            // Nothing was found.
        } else {
            IWJ_Log::add( 'Order ID and key were not found in "custom".', 'error' );
            return false;
        }

        $order = IWJ_Order::get_order( $order_id );
        if ( !$order  ) {
            IWJ_Log::add( 'Order '.$order_id.' not found.', 'error' );
        }

        if ( ! $order || $order->get_order_key() !== $order_key ) {
            IWJ_Log::add( 'Order '.$order_id.' Keys do not match.', 'error' );
            return false;
        }

        return $order;
    }

    public function ipn_check_response() {
        if ( ! empty( $_POST ) && $this->validate_ipn() ) {
            $posted = wp_unslash( $_POST );

            // @codingStandardsIgnoreStart
            $this->ipn_valid_response($posted );
            // @codingStandardsIgnoreEnd
            exit;
        }

        wp_die( 'PayPal IPN Request Failure', 'PayPal IPN', array( 'response' => 500 ) );
    }

    public function validate_ipn() {
        // Get received values from post data
        $validate_ipn        = wp_unslash( $_POST );
        $validate_ipn['cmd'] = '_notify-validate';

        // Send back post vars to paypal
        $params = array(
            'body'        => $validate_ipn,
            'timeout'     => 60,
            'httpversion' => '1.1',
            'compress'    => false,
            'decompress'  => false,
            'user-agent'  => 'iwjob',
        );

        // Post back to get a response.
        $response = wp_safe_remote_post( $this->get_option('sanbox') ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr', $params );

        // Check to see if the request was valid.
        if ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 && strstr( $response['body'], 'VERIFIED' ) ) {
            return true;
        }

        //IWJ_Log::add( 'Received invalid response from PayPal : '.$response->get_error_message(), 'error' );

        return false;
    }

    public function ipn_valid_response( $posted ) {

        if ( ! empty( $posted['custom'] ) && ( $order = $this->get_paypal_order( $posted['custom'] ) ) && $order->has_status('pending-payment')) {
            // Lowercase returned variables.
            $posted['payment_status'] = strtolower( $posted['payment_status'] );

            // Sandbox fix.
            if ( isset( $posted['test_ipn'] ) && 1 == $posted['test_ipn'] && 'pending' == $posted['payment_status'] ) {
                $posted['payment_status'] = 'completed';
            }

            switch ($posted['payment_status']) {
                case 'Completed':
                    $order->completed_order(__( 'IPN payment completed.', 'iwjob' ));
                    break;
                case 'Pending':
                    if ( 'authorization' === $posted['pending_reason'] ) {
                        $order->change_status('iwj-hold', __( 'Payment authorized. Change payment status to processing or complete to capture funds.', 'iwjob' ));
                    } else {
                        $order->change_status('iwj-hold', sprintf( __( 'Payment pending (%s).', 'iwjob' ), $posted['pending_reason'] ));
                    }
                    break;
                case 'Voided':
                    $order->cancelled_order();
                    break;
                case 'Refunded':
                    break;
            }
        }
    }

    function payment_recieved($order, $tab){
        if ( !empty( $_REQUEST['item_number'])) {
            $order_id    = iwj_clean( stripslashes( $_REQUEST['item_number'] ) );
            if($this->get_option('identity_token')){
                $this->pdt_check_response();
            }

            $order = IWJ_Order::get_order($order_id);
            $dashboard = iwj_get_page_permalink('dashboard');
            if($order){
                wp_redirect($order->get_received_url($tab));
            }else{
                wp_redirect($dashboard);
            }

            exit;
        }
    }
}