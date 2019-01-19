<?php

if (!class_exists('Inwave_Testimonials')) {

    class Inwave_Testimonials extends Inwave_Shortcode2{

        protected $name = 'inwave_testimonials';
        protected $name2 = 'inwave_testimonial_item';
        protected $testimonials;
        protected $testimonial_item;
        protected $style;


        function register_scripts()
        {
            wp_register_script('iw-testimonials', plugins_url('inwave-common/assets/js/iw-testimonials.js'), array('jquery'), INWAVE_COMMON_VERSION);
            wp_register_script('slick', plugins_url('inwave-common/assets/js/slick.min.js'), array('jquery'), INWAVE_COMMON_VERSION);
            wp_register_style('iw-testimonials', plugins_url('inwave-common/assets/css/iw-testimonials.css'), array(), INWAVE_COMMON_VERSION);
            wp_register_style('slick', plugins_url('inwave-common/assets/css/slick.css'), array(), INWAVE_COMMON_VERSION);
        }

        function init_params()
        {
            return array(
                "name" => __("Testimonials", 'inwave-common'),
                "base" => $this->name,
                "content_element" => true,
                'category' => 'Theme Custom',
                'icon' => 'iw-default',
                "description" => __("Add a set of testimonial and give some custom style.", 'inwave-common'),
                "as_parent" => array('only' => $this->name2),
                "show_settings_on_create" => true,
                "js_view" => 'VcColumnView',
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "class" => "iw-testimonials-style",
                        "heading" => "Style",
						"admin_label" =>true,
                        "param_name" => "style",
                        "value" => array(
                            "Style 1" => "style1",
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Item active", 'inwave-common'),
                        "value" => "1",
                        "description" => __("Choose item active", 'inwave-common'),
                        "param_name" => "item_active",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "value" => "",
                        "description" => __("Write your own CSS and mention the class name here.", 'inwave-common'),
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
                "name" => __("Testimonial Item", 'inwave-common'),
                "base" => $this->name2,
                "class" => "inwave_testimonial_item",
                'icon' => 'iw-default',
                'category' => 'Theme Custom',
                "description" => __("Add a list of testimonials with some content and give some custom style.", 'inwave-common'),
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "class" => "iw-testimonials-style",
                        "heading" => "Style",
                        "admin_label" =>true,
                        "param_name" => "style",
                        "value" => array(
                            "Style 1" => "style1",
                            "Style 2" => "style2",
                            "Style 3" => "style3",
                            "Style 4" => "style4",
                        )
                    ),
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", 'inwave-common'),
                        "param_name" => "preview_style1",
						"value" => get_template_directory_uri() . '/assets/images/shortcodes/testimonial-style4.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Name", 'inwave-common'),
                        "value" => "This is Name",
                        "param_name" => "name",
                        "dependency" => array('element' => 'style', 'value' => array('style3', 'style4'))
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Position", 'inwave-common'),
                        "value" => "",
                        "param_name" => "position",
                        "dependency" => array('element' => 'style', 'value' => array('style3', 'style4'))
                    ),
                    array(
                        'type' => 'textarea_html',
                        "heading" => __("Testimonial Content", 'inwave-common'),
                        "description" => __("You can add |TEXT_EXAMPLE| to specify strong words, <br />{TEXT_EXAMPLE} to specify colorful words, <br />'///' to insert line break tag (br)", 'inwave-common'),
                        "value" => "",
                        "param_name" => "content"
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Rating", "inwave-common"),
                        "description" => "value: 0 -> 100%, Example: 100%",
                        "value" => "100%",
                        "param_name" => "rating",
                        "dependency" => array('element' => 'style', 'value' => 'style4')
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Client Image", 'inwave-common'),
                        "param_name" => "image",
                        "value" => "",
                        "dependency" => array('element' => 'style', 'value' => array('style3', 'style4'))
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => "Text align",
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
                        "value" => "",
                        "description" => __("Write your own CSS and mention the class name here.", 'inwave-common'),
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

        // Shortcode handler function for list
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $class = $style = $item_active = '';
            extract(shortcode_atts(array(
                "class" => "",
                "style" => "style1",
                "item_active" => "",
				'css' => '',
            ), $atts));

            $this->style = $style;

            $active = 1;
            if ($item_active) {
                $active = $item_active;
            }

            $matches = array();
            //$count = preg_match_all('/\[inwave_testimonial_item(?:\s+layout="([^\"]*)"){0,1}(?:\s+title="([^\"]*)"){0,1}(?:\s+name="([^\"]*)"){0,1}(?:\s+date="([^\"]*)"){0,1}(?:\s+position="([^\"]*)"){0,1}(?:\s+image="([^\"]*)"){0,1}(?:\s+rate="([^\"]*)"){0,1}(?:\s+testimonial_text="([^\"]*)"){0,1}(?:\s+class="([^\"]*)"){0,1}\]/i', $content, $matches);
            $count = preg_match_all( '/inwave_testimonial_item([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
            if ($count) {
                wp_enqueue_script('iw-testimonials');
                wp_enqueue_script('slick');
                wp_enqueue_style('iw-testimonials');
                wp_enqueue_style('slick');

                switch ($style){
                    case 'style1' :
                        $output .= '<div class="iw-testimonals style1 ' . $class . '">';
                        $output.= '<div class="slick-slider-for">';
                        $output .= do_shortcode($content);
                        $items = array();
                        foreach ($matches[1] as $value) {
                            $items[] = shortcode_parse_atts( $value[0] );
                        }
                        $output.= '</div>';
                        $output.= '<div class="slick-slider-nav">';
                        foreach ($items as $key => $item) {
                            $name = html_entity_decode($item['name']);
                            $position = html_entity_decode($item['position']);
                            $image = $item['image'];
                            if ($image) {
                                $img = wp_get_attachment_image_src($image);
                                $image = '<img class="grayscale" src="' . $img[0] . '" alt=""/>';
                            }
                            $output.= '<div data-item-active="' . $key . '" class="iw-testimonial-client-item ' . ($key == 0 ? 'active' : '') . '">';
                            if($image){
                                $output.= '<div class="testi-image">' . $image . '</div>';
                            }
                            if ( $name || $position ) {
                                $output.= '<div class="thumb-info">';
                                    if($name){
                                        $output.= '<div class="testi-client-name">' . $name . '</div>';
                                    }
                                    if($position){
                                        $output.= '<div class="testi-client-position">' . $position . '</div>';
                                    }
                                $output.= '</div>';
                            }
                            $output.= '</div>';
                        }
                        $output.= '</div>';
                        $output .= '</div>';
                        break;
                }
            }

            return $output;
        }

        // Shortcode handler function for item
        function init_shortcode2($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name2, $atts ) : $atts;

            $output = $style = $name = $position = $rating = $image = $align = $class = $css = '';
            extract(shortcode_atts(array(
                'style' => '',
                'name' => '',
                'position' => '',
                'title' => '',
                "rating" => "",
                'image' => '',
                'align' => '',
                'css' => '',
                'class' => ''
            ), $atts));

            $class .= ' '.$style.' '. vc_shortcode_custom_css_class( $css);
            if($align){
                $class.= ' text-'.$align;
            }

            $star_rating = '';
            if($rating){
                $star_rating.= 'width: '.esc_attr($rating);
            }

            if ($image) {
                $img = wp_get_attachment_image_src($image);
                $image = '<img src="' . $img[0] . '" alt=""/>';
            }

            $content= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$content);
            $content= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$content);
            $content= preg_replace('/\/\/\//i', '<br />', $content);

            switch ($style){
                case 'style1':
                $output.= '<div class="iw-testimonial-item '.$class.'">';
                    $output.= '<div class="testi-info-wrap">';
                        $output.= '<div class="icon-quote">“</div>';
                        if($content){
                            $output.= '<div class="testi-content">' . $content . '</div>';
                        }
                    $output.= '</div>';
                $output.= '</div>';
            break;

            case 'style2':
                $output.= '<div class="iw-testimonial-item '.$class.'">';
                    $output.= '<div class="testi-info-wrap">';
                        if($content){
                            $output.= '<div class="testi-content">“' . $content . '”</div>';
                        }
                    $output.= '</div>';
                $output.= '</div>';
            break;

            case 'style3':
                $output.= '<div class="iw-testimonial-item'.$class.'">';
                    $output.= '<div class="testi-info-wrap">';
                        $output.= '<i class="iwj-icon-quote-right"></i>';
                        if($content){
                            $output.= '<div class="testi-content">' . $content . '</div>';
                        }
                        $output.= '<div class="testi-bottom">';
                            if($image){
                                $output.= '<div class="testi-image">' . $image . '</div>';
                            }
                            $output.= '<div class="testi-bottom-left">';
                                if($name){
                                    $output.= '<div class="testi-client-name">' . $name . '</div>';
                                }
                                if($position){
                                    $output.= '<div class="testi-client-position">' . $position . '</div>';
                                }
                            $output.= '</div>';
                            $output.= '<div class="clearfix"></div>';
                        $output.= '</div>';
                    $output.= '</div>';
                $output.= '</div>';
            break;

            case 'style4':
                $output.= '<div class="iw-testimonial-item slickslide'.$class.'">';
                    $output.= '<div class="testi-info-wrap">';
                        $output .= '<div class="iw-star-rating">';
                            $output .= '<span class="rating" style="' .$star_rating. '"></span>';
                        $output .= '</div>';
                        if($content){
                            $output.= '<div class="testi-content">' . $content . '</div>';
                        }
                    $output.= '</div>';
                $output.= '</div>';
            break;

            }
            return $output;
        }
    }
}

new Inwave_Testimonials;
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Inwave_Testimonials extends WPBakeryShortCodesContainer {}
}
