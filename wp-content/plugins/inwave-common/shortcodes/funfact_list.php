<?php

/*
 * Inwave_Funfact_List for Visual Composer
 */
if (!class_exists('Inwave_Funfact_List')) {

    class Inwave_Funfact_List extends Inwave_Shortcode{

        protected $name = 'inwave_funfact_list';
        protected $style;

        function init_params() {
            return array(
                "name" => __("Funfact List", 'inwave-common'),
                "base" => $this->name,
                "content_element" => true,
                'category' => 'Theme Custom',
                'icon' => 'iw-default',
                "description" => __("Add a set of list info and give some custom style.", 'inwave-common'),
                "as_parent" => array('only' => 'inwave_funfact'),
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

            $output = $class = '';
            extract(shortcode_atts(array(
                "class" => "",
            ), $atts));

            $output .= '<div class="iw-funfact-list ' . $class . '">';
            $output .= do_shortcode($content);
            $output .= '<div class="clear"></div>';
            $output .= '</div>';
            return $output;
        }
    }
}


new Inwave_Funfact_List;
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Inwave_Funfact_List extends WPBakeryShortCodesContainer {
    }
}
