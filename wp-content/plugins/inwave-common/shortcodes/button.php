<?php
/*
 * Inwave_Button for Visual Composer
 */
if (!class_exists('Inwave_Button')) {

    class Inwave_Button extends Inwave_Shortcode{

        protected $name = 'inwave_button';

        function register_scripts()
        {
            wp_enqueue_style('iw_button', plugins_url('inwave-common/assets/css/iw-button.css'), array(), INWAVE_COMMON_VERSION);
        }

        function init_params() {
            return array(
                'name' => __("Button", 'inwave-common'),
                'description' => __('Insert a button with some styles', 'inwave-common'),
                'base' => 'inwave_button',
                'icon' => 'iw-default',
                'category' => 'Theme Custom',
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "heading" => "Button style",
                        "param_name" => "style",
                        "value" => array(
                            "Button 1 - Background color" => "button1",
                            "Button 2 - background none, border" => "button2",
                        )
                    ),
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Button Border Color", 'inwave-common'),
                        "param_name" => "border_color_button",
                        "description" => __('Border color for Button', 'inwave-common'),
                        "value" => "",
                        "dependency" => array('element' => 'style', 'value' => 'button2')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Button Text", 'inwave-common'),
                        "param_name" => "button_text",
                        "holder" => "div",
                        "value"=>"Click here"
                    ),
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Button Background Color", 'inwave-common'),
                        "param_name" => "bg_button",
                        "description" => __('Background color for Button', 'inwave-common'),
                        "value" => "",
                        "dependency" => array('element' => 'style', 'value' => 'button1')
                    ),
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Button Color", 'inwave-common'),
                        "param_name" => "color_button",
                        "description" => __('Color for Button', 'inwave-common'),
                        "value" => "",
                    ),
                    array(
                        'type' => 'dropdown',
                        "heading" => __("Button Font Weight", 'inwave-common'),
                        "description" => __('Font Weight Button Text', 'inwave-common'),
                        "param_name" => "font_weight",
                        "value" => array(
                            "Default" => "",
                            "Extra Bold" => "900",
                            "Bold" => "700",
                            "SemiBold" => "600",
                            "Medium" => "500",
                            "Normal" => "400",
                            "Light" => "300"
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Button Link", 'inwave-common'),
                        "param_name" => "button_link",
                        "value"=>"#"
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => "Button Width",
                        "param_name" => "button_width",
                        "value" => array(
                            "Width Auto" => "width-auto",
                            "Full Width" => "full-width",
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("button align", 'inwave-common'),
                        "param_name" => "align",
                        "value" => array(
                            "Default" => "",
                            "Left" => "left",
                            "Right" => "right",
                            "Center" => "center"
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
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

        function init_shortcode($atts, $content = null){
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $class = $button_link = $button_text = $align = $css = $style = $bg_button = $border_color_button = $button_width = $border_icon = $color_button = $font_weight = '';
            extract(shortcode_atts(array(
                'class' => '',
                'button_link' => '',
                'button_text' => '',
                'align' => '',
                'css' => '',
                'style' => 'button1',
                'bg_button' => '',
                'border_color_button' => '',
                'button_width' => 'width-auto',
                'color_button' => '',
                'font_weight' => '',
            ), $atts));

            return self::inwave_button_shortcode_html($button_link,$button_text,$align,$css,$style,$bg_button,$border_color_button,$button_width,$color_button,$font_weight,$border_icon,$class);
        }

        public static function inwave_button_shortcode_html($button_link,$button_text,$align,$css,$style,$bg_button,$border_color_button,$button_width,$color_button,$font_weight,$class =''){
            $output='';
            $class .= ' '.$style.' '. vc_shortcode_custom_css_class( $css);
            if($align){
                $class.= ' '.$align.'-text';
            }
            $extracss = array();
            if($font_weight){
                $extracss[] .= 'font-weight: '.esc_attr($font_weight);
            }
            if($bg_button){
                $extracss[] .= 'background-color: '.esc_attr($bg_button);
            }
            if($color_button){
                $extracss[] .= 'color: '.esc_attr($color_button);
            }
            if($border_color_button){
                $extracss[] .= 'border-color: '.esc_attr($border_color_button);
            }
            switch($style){
                case 'button1':
                case 'button2':
                    $output .=  '<div class="iw-button '.$class.'">';
                        $output .= '<a class="'.$button_width.'" href="'.$button_link.'" style="'.implode("; ",$extracss).'">';
                            $output .= '<span class="button-text">'.$button_text.'</span>';
                        $output .= '</a>';
                    $output .= '</div>';
                    break;
            }
            return $output;
        }
    }
}

new Inwave_Button;
