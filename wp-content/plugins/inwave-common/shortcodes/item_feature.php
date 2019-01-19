<?php

/*
 * Inwave_Item_Feature for Visual Composer
 */
if (!class_exists('Inwave_Item_Feature')) {

    class Inwave_Item_Feature extends Inwave_Shortcode{

        protected $name = 'inwave_item_feature';

        function init_params() {
            return array(
                'name' => __("Item feature", 'inwavethemes'),
                'description' => __('Add a item info', 'inwavethemes'),
                'base' => $this->name,
                'category' => 'Theme Custom',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "admin_label" => true,
                        "heading" => __("Title", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title",
                    ),
                    array(
                        'type' => 'iw_icon',
                        "heading" => __("Icon", "inwavethemes"),
                        "value" => "",
                        "param_name" => "icon",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Icon Size", "inwavethemes"),
                        "param_name" => "icon_size",
                        "description" => __("Example: 50", "inwavethemes"),
                        "value" => "50",
                    ),
                    array(
                        'type' => 'textarea',
                        "heading" => __("Description", "inwavethemes"),
                        "value" => "",
                        "param_name" => "description",
                    ),
                    array(
                        'type' => 'textfield',
                        "admin_label" => true,
                        "heading" => __("Min Height Item", "inwavethemes"),
                        "value" => "320px",
                        "param_name" => "height_item",
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
                        'group' => __( 'Design Options', 'js_composer' )
                    )
                )
            );
        }

        // Shortcode handler function for list Icon
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $class = '';
            extract(shortcode_atts(array(
                'title' => '',
                'icon' => '',
                'icon_size' => '',
                'description' => '',
                'height_item' => '',
                'css' => '',
                'class' => '',
            ), $atts));

            $class .= ' '. vc_shortcode_custom_css_class( $css);


            $output .= '<div class="iw-item-feature ' . $class . '" style="min-height: '.$height_item.'">';
            if ($icon){
                $output .= '<div class="icon theme-color" style="font-size:' . $icon_size . 'px"><i class="'.esc_attr($icon).'"></i></div>';
            }
            if ($title){
                $output .= '<h3 class="title">'.$title.'</h3>';
            }
            if ($description){
                $output .= '<p class="description">'.$description.'</p>';
            }
            $output .= '</div>';

            return $output;
        }
    }
}

new Inwave_Item_Feature;
