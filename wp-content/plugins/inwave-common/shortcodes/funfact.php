<?php
/*
 * Inwave_Funfact for Visual Composer
 */
if (!class_exists('Inwave_Funfact')) {

    class Inwave_Funfact extends Inwave_Shortcode{

        protected $name = 'inwave_funfact';

        function init_params() {
            return array(
                'name' => __("Funfact", 'inwave-common'),
                'description' => __('Insert a funfact style', 'inwave-common'),
                'base' => $this->name,
                'icon' => 'iw-default',
                'category' => 'Theme Custom',
                'params' => array(
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", 'inwave-common'),
                        "param_name" => "preview_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/preview-funfact.png',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", 'inwave-common'),
                        "param_name" => "preview_style2",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/preview-funfact-2.png',
                        "dependency" => array('element' => 'style', 'value' => 'style2')
                    ),
                    array(
                        "type" => "dropdown",
                        "admin_label" => true,
                        "heading" => __("Style", 'inwave-common'),
                        "param_name" => "style",
                        "value" => array(
                            'Style 1' => 'style1',
                            'Style 2' => 'style2',
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "admin_label" => true,
                        "heading" => __("Number",'inwave-common'),
                        "param_name" => "number",
                        "value" => __("7854",'inwave-common'),
                        "description" => __("Add number funfact on for element",'inwave-common')
                    ),
                    array(
                        "type" => "textfield",
                        "admin_label" => true,
                        "heading" => __("title",'inwave-common'),
                        "param_name" => "title",
                        "value" => "",
                        "description" => __("Add title Funfacr for element",'inwave-common')
                    ),
                    array(
                        "type" => "textfield",
                        "admin_label" => true,
                        "heading" => __("Sub title",'inwave-common'),
                        "param_name" => "sub_title",
                        "value" => "",
                        "description" => __("Add sub title Funfacr for element",'inwave-common'),
                        "dependency" => array('element' => 'style', 'value' => 'style2')
                    ),
                    array(
                        "type" => "textfield",
                        "admin_label" => true,
                        "heading" => __("Prefix",'inwave-common'),
                        "param_name" => "prefix",
                        "value" => '',
                        "description" => __("Add prefix funfact for element",'inwave-common')
                    ),
                    array(
                        "type" => "textfield",
                        "admin_label" => true,
                        "heading" => __("Suffix",'inwave-common'),
                        "param_name" => "suffix",
                        "value" => '',
                        "description" => __("Add suffix funfact for element",'inwave-common')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Speed",'inwave-common'),
                        "param_name" => "speed",
                        "value" => '1000',
                        "description" => __("Set speed funfact for element",'inwave-common')
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __( 'Add comma?', 'inwave-common' ),
                        'param_name' => 'add_comma',
                    ),
                )
            );
        }

        function register_scripts()
        {
            wp_register_script('iw-funfact', plugins_url() . '/inwave-common/assets/js/iw-funfact.js', array('jquery'), INWAVE_COMMON_VERSION, true);
        }

        function init_shortcode($atts, $content = null){
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $el_class = $html = '';
            extract( shortcode_atts(
                array(
                    // alway
                    'style' => '',
                    'el_class' => '',
                    'number' => '',
                    'title' => '',
                    'sub_title' => '',
                    'prefix' => '',
                    'suffix' => '',
                    'speed' => '',
                    'add_comma' => '',
                ), $atts ));

            wp_enqueue_script('jquery-countTo');
            wp_enqueue_script('waypoints');
            wp_enqueue_script('iw-funfact');

            $funfact_settings = array();
            $funfact_settings['to'] = $number;
            $funfact_settings['speed'] = (int)$speed;
            $funfact_settings['add_comma'] = $add_comma ? true : false;
            switch ($style) {
                case 'style1':
                    $html .='<div class="inwave-funfact '.$style.'" data-settings="'.esc_attr(json_encode($funfact_settings)).'">';
                            $html .='<div class="funfact-number-wrap">';
                            if($prefix != ''){
                                $html .='<span class="funfact-prefix">'.$prefix.'</span>';
                            }
                            $html .='<span data-number="'.esc_attr($number).'" class="funfact-number">'.$number.'</span>';
                            if($suffix !=''){
                                $html .='<span class="funfact-prefix">'.$suffix.'</span>';
                            }
                            $html .='</div>';
                            if ($title) {
                                $html .='<p class="funfact-title">'.$title.'</p>';
                            }
                    $html .='</div>';
                    break;

                case 'style2':
                    $html .='<div class="inwave-funfact '.$style.'" data-settings="'.esc_attr(json_encode($funfact_settings)).'">';
                            if ($title) {
                                $html .='<h3 class="funfact-title">'.$title.'</h3>';
                            }
                            $html .='<div class="funfact-number-wrap">';
                            if($prefix != ''){
                                $html .='<span class="funfact-prefix theme-color">'.$prefix.'</span>';
                            }
                            $html .='<span data-number="'.esc_attr($number).'" class="funfact-number">'.$number.'</span>';
                            if($suffix !=''){
                                $html .='<span class="funfact-prefix theme-color">'.$suffix.'</span>';
                            }
                            $html .='</div>';
                            if ($sub_title) {
                                $html .='<p class="funfact-sub-title theme-color">'.$sub_title.'</p>';
                            }
                    $html .='</div>';
                    break;
            }

            return $html;
        }
    }
}

new Inwave_Funfact();
