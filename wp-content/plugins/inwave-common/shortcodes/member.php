<?php

/*
 * Inwave_Tabs for Visual Composer
 */
if (!class_exists('Inwave_Member')) {

    class Inwave_Member extends Inwave_Shortcode
    {
        protected $name = 'inwave_member';

        function init_params()
        {
            return array(
                'name' => 'Member Item',
                'description' => __('Show a personal member', 'inwavethemes'),
                'base' => $this->name,
                'category' => 'Theme Custom',
                'icon' => 'iw-default',
                "show_settings_on_create" => true,
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "admin_label" => true,
                        "heading" => "Style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1 - Image Left" => "style1",
                            "Style 2 - Image Right" => "style2",
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Name", "inwavethemes"),
                        "value" => "",
                        "param_name" => "name"
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Position", "inwavethemes"),
                        "value" => "",
                        "param_name" => "position"
                    ),
                    array(
                        'type' => 'textarea',
                        "holder" => "div",
                        "heading" => __("Description", "inwavethemes"),
                        "value" => "",
                        "param_name" => "description"
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => __("Social links", "inwavethemes"),
                        "description" => __("Separated by newline", "inwavethemes"),
                        "param_name" => "social_links",
                        "value" => ""
                    ),
                    array(
                        'type' => 'attach_image',
                        "heading" => __("Image Member", "inwavethemes"),
                        "param_name" => "img",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', "inwavethemes")
                    ),
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'inwavethemes' ),
                        'param_name' => 'css',
                        // 'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'inwavethemes' ),
                        'group' => __( 'Design Options', 'inwavethemes' )
                    )
                )
            );
        }

        // Shortcode handler function for list
        function init_shortcode($atts, $content = null)
        {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $style = $img = $name = $position = $class = $css = $description = $social_links = '';
            extract(shortcode_atts(array(
                'style' => '',
                'img' => '',
                'name' => '',
                'position' => '',
                'description' => '',
                'social_links' => '',
                'css' => '',
                'class' => '',
            ), $atts));

            $class .= ' '. $style .' '. vc_shortcode_custom_css_class( $css);

            $img_tag = '';
            if ($img) {
                $img = wp_get_attachment_image_src($img, 'large');
                $img = inwave_resize($img[0], 960, 600, true);
                $img_tag .= '<img src="' . $img . '" alt="' . $name . '">';
            }

            $social_links = str_replace('<br />', "\n", $social_links);
            $social_links = explode("\n", $social_links);

            $output .= '<div class="iw-member' . $class . '">';
                if ($img_tag){
                    $output .= '<div class="member-img">'.$img_tag.'</div>';
                }
                $output .= '<div class="member-info">';
                    $output .= '<div class="content-inner">';
                        if ($name){
                            $output .= '<h3 class="name">' . $name . '</h3>';
                        }
                        if ($position){
                            $output .= '<div class="position">' . $position . '</div>';
                        }
                        if ($description){
                            $output .= '<div class="desc">' . $description . '</div>';
                        }
                        $output .= '<div class="social-links">';
                            foreach ($social_links as $link) {
                                $domain = explode(".com", $link);

                                if ($link && isset($domain[0])) {

                                    $domain = str_replace(array('https://', 'http://'), '', $domain[0]);
                                    if ($domain == 'plus.google') {
                                        $domain = 'googleplus-outline';
                                    }

                                    $output .= '<a href="' . $link . '"><i class="ion-social-' . $domain . '"></i></a>';
                                }
                            }
                        $output.= '</div>';
                    $output.= '</div>';
                $output .= '</div>';
            $output .= '</div>';

			return $output;

        }
    }
}

new Inwave_Member();