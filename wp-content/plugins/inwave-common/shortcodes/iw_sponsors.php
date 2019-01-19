<?php

/*
 * Inwave_Sponsors for Visual Composer
 */

if (!class_exists('Inwave_Sponsors')) {

    class Inwave_Sponsors extends Inwave_Shortcode2{

        protected $name = 'inwave_sponsors';
        protected $name2 = 'inwave_sponsor_item';
        protected $sponsors;
        protected $sponsor_item;
        protected $style;

        function init_params()
        {
            return array(
                "name" => __("Sponsors", 'inwave-common'),
                "base" => $this->name,
                "content_element" => true,
                'category' => 'Theme Custom',
                'icon' => 'iw-default',
                "description" => __("Add a set of sponsor and give some custom style.", 'inwave-common'),
                "as_parent" => array('only' => $this->name2),
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
                    array(
                        "type" => "textfield",
                        "group" => "Carousel Options",
                        "heading" => __("Items Desktop", 'inwave-common'),
                        "param_name" => "item_desktop",
                        "value" => '8',
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Carousel Options",
                        "heading" => __("Items Desktop Small", 'inwave-common'),
                        "param_name" => "item_desktop_small",
                        "value" => '4',
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Carousel Options",
                        "heading" => __("AutoPlay Slider", 'inwave-common'),
                        "param_name" => "auto_play",
                        "value" => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        )
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

        function init_params2() {
            return array(
                "name" => __("Sponsor Item", 'inwave-common'),
                "base" => $this->name2,
                "class" => "inwave_sponsor_item",
                'icon' => 'iw-default',
                'category' => 'Theme Custom',
//                "as_child" => array('only' => $this->name),
                "description" => __("Add a list of sponsors with some content and give some custom style.", 'inwave-common'),
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "type" => "attach_image",
                        "heading" => __("Sponsor Image", 'inwave-common'),
                        "param_name" => "image",
                        "value" => "",
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Link Sponsor", 'inwave-common'),
                        "value" => "#",
                        "param_name" => "link_sponsor",
                    ),
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

            $output = $class = $auto_play = $item_desktop = $item_desktop_small = '';
            //$id = 'iwt-' . rand(10000, 99999);
            extract(shortcode_atts(array(
                "class" => "",
                "auto_play" => "",
                "item_desktop" => "",
                "item_desktop_small" => "",
                'css' => '',
            ), $atts));

            $data_plugin_options = array(
                "navigation"=>true,
                "autoHeight"=>false,
                "pagination"=>false,
                "autoPlay"=>false,
                "paginationNumbers"=>false,
                "items"=>$item_desktop,
                "itemsDesktop"=>array(1199, $item_desktop),
                "itemsDesktopSmall"=>array(991, $item_desktop_small),
                "itemsTablet"=>array(767, 3),
                "itemsTabletSmall"=>false,
                "itemsMobile"=>array(479, 1),
                "navigationText" => array('<i class="ion-android-arrow-back"></i>', '<i class="ion-android-arrow-forward"></i>')
            );

            wp_enqueue_style('owl-carousel');
            wp_enqueue_style('owl-theme');
            wp_enqueue_style('owl-transitions');
            wp_enqueue_script('owl-carousel');

            $output = '<div class="iw-sponsors '.$class.'">';
            $output .= '<div class="owl-carousel" data-plugin-options="'.htmlspecialchars(json_encode($data_plugin_options)).'">';
            $output .= do_shortcode($content);
            $output .= '</div>';
            $output .= '</div>';

            return $output;
        }

        // Shortcode handler function for item
        function init_shortcode2($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name2, $atts ) : $atts;

            $output = $image = $link_sponsor = $class = '';
            extract(shortcode_atts(array(
                'image' => '',
                'link_sponsor' => '',
                'class' => ''
            ), $atts));

            if ($image) {
                $img = wp_get_attachment_image_src($image, 'full');
                $image = '<img src="' . $img[0] . '" alt=""/>';
            }

            $output.= '<div class="iw-sponsor-item">';
            if($image){
                if ($link_sponsor) {
                    $output.= '<div class="testi-image"><a href="'.$link_sponsor.'">' . $image . '</a></div>';
                }
                else {
                    $output.= '<div class="testi-image">' . $image . '</div>';
                }
            }
            $output.= '</div>';
            return $output;
        }
    }
}

new Inwave_Sponsors;
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Inwave_Sponsors extends WPBakeryShortCodesContainer {}
}
