<?php
/*
 * Inwave_Work_Steps for Visual Composer
 */
if (!class_exists('Inwave_Work_Steps')) {

    class Inwave_Work_Steps extends Inwave_Shortcode{

        protected $name = 'inwave_work_steps';
        protected $item_count = 0;
        protected $style;

        function init_params() {
            return array(
                "name" => __("Work Steps", 'inwave-common'),
                "base" => $this->name,
                "content_element" => true,
                'category' => 'Theme Custom',
                'icon' => 'iw-default',
                "description" => '',
                "as_parent" => array('only' => 'inwave_work_step'),
                "show_settings_on_create" => true,
                "js_view" => 'VcColumnView',
                "params" => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "value" => "",
                        "description" => __("Write your own CSS and mention the class name here.", 'inwave-common'),
                    ),
                )
            );
        }


        // Shortcode handler function for list
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $class = $style = '';
            extract(shortcode_atts(array(
                "class" => "",
            ), $atts));

            wp_enqueue_style('owl-carousel');
            wp_enqueue_style('owl-theme');
            wp_enqueue_style('owl-transitions');
            wp_enqueue_script('owl-carousel');

            $data_plugin_options = array(
                "navigation"=>false,
                "autoHeight"=>false,
                "pagination"=>false,
                "autoPlay"=>true,
                "paginationNumbers"=>false,
                "items"=>3,
                "itemsDesktop"=>array(1199, 3),
                "itemsDesktopSmall"=>array(991, 3),
                "itemsTablet"=>array(767, 1),
                "itemsTabletSmall"=>false,
                "itemsMobile"=>array(479, 1),
            );

            Inwave_Work_Step::$item_count = 0;

            $output .= '<div class="iw-work-steps ' . $class . '">';
            $output .= '<div class="owl-carousel" data-plugin-options="'.htmlspecialchars(json_encode($data_plugin_options)).'">';
            $output .= do_shortcode($content);
            $output .= '</div>';
            $output .= '</div>';
            return $output;
        }
    }
}


new Inwave_Work_Steps;
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Inwave_Work_Steps extends WPBakeryShortCodesContainer {
    }
}
