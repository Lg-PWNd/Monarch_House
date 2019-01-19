<?php
/*
 * @package inChurch
 * @version 1.0.0
 * @created Jun 8, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */


/**
 * Description of iwe_count_down
 *
 * @developer duongca
 */
if (!class_exists('Inwave_Count_Down')) {

    class Inwave_Count_Down extends Inwave_Shortcode{

        protected $name = 'iw_count_down';

        function register_scripts()
        {
            wp_register_script('jquery-countdown', plugins_url('inwave-common/assets/js/jquery.countdown.js'), array('jquery'), INWAVE_COMMON_VERSION);
            wp_register_script('iw-countdown', plugins_url() . '/inwave-common/assets/js/iw-countdown.js', array('jquery'), INWAVE_COMMON_VERSION, true);
        }

        function init_params() {
           return array(
                'name' => __('Count Down', 'inwavethemes'),
                'description' => __('Add a event speaker block', 'inwavethemes'),
                'base' => $this->name,
                'category' => 'Theme Custom',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Start Date", "inwavethemes"),
                        "param_name" => "start_date",
                        "value"=>"2017-09-9"
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("End Date", "inwavethemes"),
                        "param_name" => "end_date",
                        "value"=>"2017-09-29"
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("End Time", "inwavethemes"),
                        "param_name" => "time",
                        "value"=>"00-00-00"
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Price", "inwavethemes"),
                        "param_name" => "price",
                        "value"=>"$39,$49,$59"
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', "inwavethemes")
                    ),
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        // 'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
                        'group' => __( 'Design Options', 'js_composer' )
                    )

                )
            );
        }

        // Shortcode handler function for list Icon
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;
            $output = $start_date = $end_date = $time = $price = $class = $css = '';
            extract(shortcode_atts(array(
                "start_date" => "",
                "end_date" => "",
                "time" => "",
                "price" => "",
                "css" => "",
                "class" => ""
            ), $atts));
            
            $class .= ' '. vc_shortcode_custom_css_class( $css);

            wp_enqueue_script('jquery-countdown');
            wp_enqueue_script('iw-countdown');

            $extract_price = $extract_date = $extract_time = array('', '' ,'');
            if($end_date && $time){
                $extract_date = explode("-", $end_date);
                $extract_time = explode("-", $time);
            }
            if($start_date && $end_date){
                $strat_date_number = strtotime($start_date);
                $end_date_number = strtotime($end_date);
                $date_number = abs($end_date_number - $strat_date_number);;
                $date_number = (floor($date_number / (86400)));
            }
            if($price){
                $extract_price = explode(",", $price);
            }

            ob_start();
            ?>
                <div class="inwave-countdown" data-date-number="<?php echo esc_attr($date_number); ?>" data-countdown="<?php echo esc_attr($extract_date[0].'/'.$extract_date[1].'/'.$extract_date[2].' '.$extract_time[0].':'.$extract_time[1].':'.$extract_time[2]); ?>">
                    <div class="date-countdown day-count">
                        <div class="content-inner">
                            <span class="day date"></span>
                            <span class="day-label date-label">DAYS</span>
                        </div>
                    </div>
                    <div class="date-countdown hour-count">
                        <div class="content-inner">
                            <span class="hour date"></span>
                            <span class="hour-label date-label">HOURS</span>
                        </div>
                    </div>
                    <div class="date-countdown minute-count">
                        <div class="content-inner">
                            <span class="minute date"></span>
                            <span class="minute-label date-label">MINS</span>
                        </div>
                    </div>
                    <div class="date-countdown second-count">
                        <div class="content-inner">
                            <span class="second date"></span>
                            <span class="second-label date-label">SECS</span>
                        </div>
                    </div>
                </div>
                <div class="price-countdown">
                    <div class="price-width">
                        <div class="price-line">
                            <span class="line theme-bg"></span>
                        </div>
                        <div class="price-start price active"><?php echo esc_attr($extract_price[0]); ?></div>
                        <div class="price-center price"><?php echo esc_attr($extract_price[1]); ?></div>
                        <div class="price-end price"><?php echo esc_attr($extract_price[2]); ?></div>
                    </div>
                </div>
            <?php
            $html = ob_get_contents();
            ob_end_clean();

            return $html;
        }
    }
}

new Inwave_Count_Down();
