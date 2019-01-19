<?php
/*
 * Inwave_Work_Step for Visual Composer
 */
if (!class_exists('Inwave_Work_Step')) {

    class Inwave_Work_Step extends Inwave_Shortcode{

        protected $name = 'inwave_work_step';
        public static $item_count = 0;

        function init_params() {
            return array(
                'name' => __("Work Step", 'inwave-common'),
                'description' => __('Add a work step', 'inwave-common'),
                'base' => $this->name,
                'category' => 'Theme Custom',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "admin_label" => true,
                        "heading" => "Style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1" => "style1",
                            "Style 2" => "style2",
                        )
                    ),
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", 'inwave-common'),
                        "param_name" => "preview_style_1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/work-step1.png',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),

                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", 'inwave-common'),
                        "param_name" => "preview_style_2",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/work-step2.png',
                        "dependency" => array('element' => 'style', 'value' => 'style2')
                    ),
                    array(
                        'type' => 'textfield',
                        "admin_label" => true,
                        "heading" => __("Title", 'inwave-common'),
                        "description" => '',
                        "value" => "",
                        "param_name" => "title",
                    ),
                    array(
                        'type' => 'textarea',
                        "heading" => __("Description", 'inwave-common'),
                        "description" => '',
                        "value" => "",
                        "param_name" => "description",
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        'type' => 'iw_icon',
                        "heading" => __("Icon", 'inwave-common'),
                        "value" => "",
						"description" => __("Click and select icon of your choice. You can get complete list of available icons here: <a target='_blank' href='http://fortawesome.github.io/Font-Awesome/icons/'>Font-Awesome</a>", 'inwave-common'),
                        "param_name" => "icon",
                    ),
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Background color icon", 'inwave-common'),
                        "param_name" => "bg_color_icon",
                        "description" => '',
                        "value" => "",
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                )
            );
        }

        // Shortcode handler function for work step
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $style = $class = $title = $icon = $bg_color_icon = $description = '';
            extract(shortcode_atts(array(
                "style" => "",
                'title' => '',
                'description' => '',
				'icon' => '',
				'bg_color_icon' => '',
                'class' => '',
            ), $atts));

            if ($style) {
                $class = ' '.$style;
            }

            switch ($style) {
                // Normal style
                case 'style1':
                    self::$item_count++;
                    $output .= '<div class="iw-work-step '.$class.'">';
                    if ($icon){
                        $output .= '<div class="icon"><span class="count-step" style="color:' . $bg_color_icon . '">'.self::$item_count.'</span><i style="background:' . $bg_color_icon . '; -webkit-box-shadow: 0 5px 25px 0 ' . $bg_color_icon . '; box-shadow: 0 5px 25px 0 ' . $bg_color_icon . ';" class="'.esc_attr($icon).'"></i></div>';
                    }
                    $output .= '<div class="info-wrap">';
                    if ($title){
                        $output .= '<h3 class="title">'.$title.'</h3>';
                    }
                    if ($description){
                        $output .= '<p class="description">'.$description.'</p>';
                    }
                    $output .= '</div>';
                    $output .= '</div>';
                    break;

                case 'style2':
                    $output .= '<div class="iw-work-step '.$class.'">';
                    if ($icon){
                        $output .= '<div class="icon"><i class="'.esc_attr($icon).'"></i></div>';
                    }
                    if ($title){
                        $output .= '<h3 class="title">'.$title.'</h3>';
                    }
                    $output .= '</div>';
                    break;
            }

            return $output;
        }
    }
}

new Inwave_Work_Step;
