<?php
/*
 * Inwave_Map for Visual Composer
 */
if (!class_exists('Inwave_Map')) {

    class Inwave_Map extends Inwave_Shortcode{

        protected $name = 'inwave_map';

        function register_scripts()
        {
            wp_register_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key='.Inwave_Helper::getThemeOption('google_api').'&libraries=places', array('jquery'), INWAVE_COMMON_VERSION, true);
            wp_register_script('infobox', 'https://cdn.rawgit.com/googlemaps/v3-utility-library/master/infobox/src/infobox.js', array('jquery'), INWAVE_COMMON_VERSION, true);
            wp_register_script('iw-map', plugins_url() . '/inwave-common/assets/js/iw-map.js', array('jquery'), INWAVE_COMMON_VERSION, true);
        }

        function init_params() {
            return array(
                'name' => 'Map',
                'description' => __('Display a Google Map. You can define map styles in theme options', 'inwave-common'),
                'base' => $this->name,
                'icon' => 'iw-default',
                'category' => 'Theme Custom',
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
                        "type" => "attach_image",
                        "heading" => __("Marker Icon", 'inwave-common'),
                        "param_name" => "marker_icon",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Latitude", 'inwave-common'),
                        "admin_label" => true,
                        "param_name" => "latitude",
                        "value" => "40.6700",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Longitude", 'inwave-common'),
                        "admin_label" => true,
                        "param_name" => "longitude",
                        "value" => "-73.9400",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Zoom", 'inwave-common'),
                        "param_name" => "zoom",
                        "value" => "11",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Map height", 'inwave-common'),
                        "param_name" => "height",
                        "value" => "400",
                        "description"=> __("Example: 400(in px) or 100vh", 'inwave-common'),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("panBy x", 'inwave-common'),
                        "param_name" => "panby_x",
                        "value" => "0",
                        "description"=> __("Changes the center of the map by the given distance in pixels.. Example: 50", 'inwave-common'),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("panBy y", 'inwave-common'),
                        "param_name" => "panby_y",
                        "value" => "0",
                        "description"=> __("Changes the center of the map by the given distance in pixels. Example: 50", 'inwave-common'),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Map Info width", 'inwave-common'),
                        "param_name" => "info_width",
                        "value" => "460",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Map Info Height", 'inwave-common'),
                        "param_name" => "info_height",
                        "value" => "386",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Map Info panBy x", 'inwave-common'),
                        "param_name" => "info_panby_x",
                        "value" => "200",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Map Info panBy y", 'inwave-common'),
                        "param_name" => "info_panby_y",
                        "value" => "40",
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Map Info Title", 'inwave-common'),
                        "description" => __("You can add |TEXT_EXAMPLE| to specify strong words, <br />{TEXT_EXAMPLE} to specify colorful words", 'inwave-common'),
                        "value" => "Job Board",
                        "param_name" => "map_info_title",
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Address", 'inwave-common'),
                        "value" => "320 Rainbow Building, Van Quan Ha Dong, Ha Noi, Vietnam",
                        "param_name" => "address",
                        "description" => __('Enter address.', 'inwave-common'),
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Phone number", 'inwave-common'),
                        "value" => "+84 04 1234 566 66",
                        "param_name" => "phone_number",
                        "description" => __('Enter phone number.', 'inwave-common'),
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Email Address", 'inwave-common'),
                        "value" => "hello@ineventwordpress.com",
                        "param_name" => "email_address",
                        "description" => __('Enter email address.', 'inwave-common'),
                    ),
                    array(
                        'type' => 'textfield',
                        "group" => "Contact Form",
                        "holder" => "div",
                        "heading" => __("Add contact form 7 ID", 'inwave-common'),
                        "value" => "",
                        "param_name" => "contact_form_7_id",
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    )
                )
            );
        }

        // Shortcode handler function for list Icon
        function init_shortcode($atts, $content=null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;
            wp_enqueue_script('google-maps');
            wp_enqueue_script('infobox');
            wp_enqueue_script('iw-map');

            wp_localize_script('iw-map', 'iwmap', array(
                'map_styles' => Inwave_Helper::getThemeOption('map_styles') ? Inwave_Helper::getThemeOption('map_styles') : '',
            ));

            extract(shortcode_atts(array(
                'style' => '',
                'map_info_title' => '',
                'address' => '',
                'phone_number' => '',
                'email_address' => '',
                'get_in_touch_url' => '',
                'latitude' => '',
                'longitude' => '',
                'marker_icon' => '',
                'height' => '',
                'info_width' => '',
                'info_height' => '',
                'info_panby_x' => '',
                'info_panby_y' => '',
                'panby_x' => '',
                'panby_y' => '',
                'zoom' => '11',
                'contact_form_7_id' => '',
                'class' => ''
            ), $atts));
            $icon_url = '';
            if($marker_icon){
                $img = wp_get_attachment_image_src($marker_icon, 'large');
                $icon_url = count($img) ? $img[0] : '';
            }

            if($height){
                if(is_numeric($height)){
                    $height = 'style="height:'.esc_attr($height).'px"';
                }
                else
                {
                    $height = 'style="height:'.esc_attr($height).'"';
                }
            }

            $map_info_title= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$map_info_title);
            $map_info_title= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$map_info_title);
            $output = '';
            $attributes = array();
            $attributes[] = 'data-style_block="' . esc_attr($style) . '"';
            $attributes[] = 'data-map_info_title="' . esc_attr($map_info_title) . '"';
            $attributes[] = 'data-address="' . esc_attr($address) . '"';
            $attributes[] = 'data-phone_number="' . esc_attr($phone_number) . '"';
            $attributes[] = 'data-email_address="' . esc_attr($email_address) . '"';
            $attributes[] = 'data-marker_icon="' . esc_attr($icon_url) . '"';
            $attributes[] = 'data-lat="' . esc_attr($latitude) . '"';
            $attributes[] = 'data-long="' . esc_attr($longitude) . '"';
            $attributes[] = 'data-zoom="' . esc_attr($zoom) . '"';
            $attributes[] = 'data-panby_x="' . esc_attr($panby_x ? $panby_x: 0) . '"';
            $attributes[] = 'data-panby_y="' . esc_attr($panby_y ? $panby_y : 0) . '"';
            $attributes[] = 'data-width="' . esc_attr($info_width) . '"';
            $attributes[] = 'data-height="' . esc_attr($info_height) . '"';
            $attributes[] = 'data-info_panby_x="' . esc_attr($info_panby_x ? $info_panby_x : 0) . '"';
            $attributes[] = 'data-info_panby_y="' . esc_attr($info_panby_y ? $info_panby_y : 0) . '"';
            $attributes = implode( ' ', $attributes );


            switch ($style) {
                case 'style1':
                    $output .= '<div class="inwave-map-contact style1" '.$height.'>';
                    $output .= '<div class="inwave-map">';
                    $output .= '<div class="map-contain" '.$attributes.' >';
                    $output .= '<div class="map-view map-frame" '.$height.'></div>';
                    $output .= '</div>';

                    $output .= '</div>';

                    if ($contact_form_7_id) {
                        $output .= '<div class="form-contact">';
                        $output .= '<div class="row">';
                        $output .= '<div class="container">';
                        $output .= '<div class="iw-contact-form7 col-md-6 col-sm-8 col-xs-12">';
                        if($contact_form_7_id) {
                            $contact_form_7_shortcode = '[contact-form-7 id="'.$contact_form_7_id.'"]';
                            $output .= '<div>' .do_shortcode( $contact_form_7_shortcode ). '</div>';
                        }
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '</div>';
                    }
                    $output .= '</div>';
                    break;

                case 'style2':
                    $output .= '<div class="inwave-map-contact style2" '.$height.'>';
                    $output .= '<div class="inwave-map">';
                    $output .= '<div class="map-contain" '.$attributes.' >';
                    $output .= '<div class="map-view map-frame" '.$height.'></div>';
                    $output .= '</div>';

                    $output .= '</div>';
                    $output .= '</div>';
                    break;

            }

            return $output;
        }
    }
}

new Inwave_Map();
