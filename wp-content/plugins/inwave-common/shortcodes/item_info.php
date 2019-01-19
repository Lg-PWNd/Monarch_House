<?php

/*
 * Inwave_Item_Info for Visual Composer
 */
if (!class_exists('Inwave_Item_Info')) {

    class Inwave_Item_Info extends Inwave_Shortcode{

        protected $name = 'inwave_item_info';

        function init_params() {
            $google_fonts = function_exists('inwave_get_googlefonts') ? inwave_get_googlefonts() : array();
            $font_weight = function_exists('inwave_get_fonts_weight') ? inwave_get_fonts_weight() : array();
            $text_transform = function_exists('inwave_get_text_transform') ? inwave_get_text_transform() : array();
            $font_style = function_exists('inwave_get_font_style') ? inwave_get_font_style() : array();
            return array(
                'name' => __("Item Info", 'inwave-common'),
                'description' => __('Add a item info', 'inwave-common'),
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
                            "Style 3" => "style3",
                            "Style 4" => "style4",
                        )
                    ),
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", 'inwave-common'),
                        "param_name" => "preview_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/info-item-1.png',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", 'inwave-common'),
                        "param_name" => "preview_style2",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/info-item-2.png',
                        "dependency" => array('element' => 'style', 'value' => 'style2')
                    ),
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", 'inwave-common'),
                        "param_name" => "preview_style3",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/info-item-3.png',
                        "dependency" => array('element' => 'style', 'value' => 'style3')
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Min Height Item", 'inwave-common'),
                        "value" => "",
                        "description" => __('Custom min height item. Example: 185px', 'inwave-common'),
                        "param_name" => "item_min_height",
                        "dependency" => array('element' => 'style', 'value' => array('style2', 'style3', 'style4'))
                    ),
                    array(
                        'type' => 'textfield',
                        "admin_label" => true,
                        "heading" => __("Title", 'inwave-common'),
                        "description" => __("You can add |TEXT_EXAMPLE| to specify strong words, <br />{TEXT_EXAMPLE} to specify colorful words, <br />'///' to insert line break tag (br)", 'inwave-common'),
                        "value" => "",
                        "param_name" => "title",
                    ),
					array(
                        'type' => 'textfield',
                        "admin_label" => true,
                        "heading" => __("Sub Title", 'inwave-common'),
                        "description" => __("You can add |TEXT_EXAMPLE| to specify strong words, <br />{TEXT_EXAMPLE} to specify colorful words, <br />'///' to insert line break tag (br)", 'inwave-common'),
                        "value" => "",
                        "param_name" => "sub_title",
                        "dependency" => array('element' => 'style', 'value' => array('style1', 'style3'))
                    ),
                    array(
                        'type' => 'textarea',
                        "heading" => __("Description", 'inwave-common'),
                        "description" => __("You can add |TEXT_EXAMPLE| to specify strong words, <br />{TEXT_EXAMPLE} to specify colorful words, <br />'///' to insert line break tag (br)", 'inwave-common'),
                        "value" => "",
                        "param_name" => "description",
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Link Read More", 'inwave-common'),
                        "value" => "#",
                        "param_name" => "link",
                    ),
					array(
                        'type' => 'textfield',
                        "heading" => __("Read more text", 'inwave-common'),
                        "value" => "Read more",
                        "param_name" => "readmore_text",
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        'type' => 'attach_image',
                        "heading" => __("Background Image", 'inwave-common'),
                        "param_name" => "img",
                        "description" => __("Background Image", 'inwave-common'),
                        "dependency" => array('element' => 'style', 'value' => array('style1', 'style2'))
                    ),
                    array(
                        'type' => 'iw_icon',
                        "heading" => __("Icon Item", 'inwave-common'),
                        "value" => "",
                        "description" => __("Click and select icon of your choice. You can get complete list of available icons here: <a target='_blank' href='http://fortawesome.github.io/Font-Awesome/icons/'>Font-Awesome</a>", 'inwave-common'),
                        "param_name" => "icon_item",
                        "dependency" => array('element' => 'style', 'value' => array('style2', 'style3', 'style4'))
                    ),
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Background Color Icon", 'inwave-common'),
                        "param_name" => "bg_icon",
                        "description" => __("Default background color theme", 'inwave-common'),
                        "value" => "",
                        "dependency" => array('element' => 'style', 'value' => 'style3')
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Text align", 'inwave-common'),
                        "param_name" => "align",
                        "value" => array(
                            "Default" => "",
                            "Left" => "left",
                            "Right" => "right",
                            "Center" => "center"
                        ),
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    //title style
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Title Color", 'inwave-common'),
                        "group" => "Title Style",
                        "param_name" => "color_title",
                        "description" => __('Color for Title', 'inwave-common'),
                        "value" => "",
                    ),
                    array(
                        'type' => 'textfield',
                        "group" => "Title Style",
                        "heading" => __("Title Font Size", 'inwave-common'),
                        "value" => "",
                        "description" => __('Custom font-size title. Example: 30px', 'inwave-common'),
                        "param_name" => "font_size_title",
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Title Font Family", 'inwave-common'),
                        "group" => "Title Style",
                        "param_name" => "font_family_title",
                        "description" => __('Font family of Title', 'inwave-common'),
                        "value" => $google_fonts,
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Title Style",
                        "heading" => __("Load Font Family from google", 'inwave-common'),
                        "param_name" => "load_font_title",
                        "value" => array(
                            __('No', 'inwave-common') => '',
                            __('Yes', 'inwave-common') => '1',
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Title Style",
                        "heading" => __("Title Font Weight", 'inwave-common'),
                        "param_name" => "font_weight_title",
                        "description" => __('Font weight of Title', 'inwave-common'),
                        "value" => $font_weight,
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Title Style",
                        "heading" => __("Title Text Transform", 'inwave-common'),
                        "param_name" => "text_transform_title",
                        "description" => __('Text Transform of Title', 'inwave-common'),
                        "value" => $text_transform,
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Title Style",
                        "heading" => __("Title Line Height", 'inwave-common'),
                        "param_name" => "line_height_title",
                        "description" => __('Line height of Title. Example: 30px or 1', 'inwave-common'),
                        "value" => "",
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Title Style",
                        "heading" => __("Title Margin-bottom", 'inwave-common'),
                        "param_name" => "margin_bottom_title",
                        "description" => __('Margin bottom of Title', 'inwave-common'),
                        "value" => '',
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Title Style",
                        "heading" => __("Title Letter Spacing", 'inwave-common'),
                        "param_name" => "margin_letter_spacing",
                        "description" => __('Letter spacing of Title', 'inwave-common'),
                        "value" => '',
                    ),

                    //subtitle style
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Sub Title Color", 'inwave-common'),
                        "group" => "Sub Title Style",
                        "param_name" => "color_sub_title",
                        "description" => __('Color for Sub Title', 'inwave-common'),
                        "value" => "",
                    ),
                    array(
                        'type' => 'textfield',
                        "group" => "Sub Title Style",
                        "heading" => __(" Sub Title Font Size", 'inwave-common'),
                        "value" => "",
                        "description" => __('Custom font-size title. Example: 30px', 'inwave-common'),
                        "param_name" => "font_size_sub_title",
                        "dependency" => array('element' => 'style', 'value' => array('style1', 'style3'))
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Sub Title Font Family", 'inwave-common'),
                        "group" => "Sub Title Style",
                        "param_name" => "font_family_sub_title",
                        "description" => __('Font family of Sub Title', 'inwave-common'),
                        "value" => $google_fonts,
                        "dependency" => array('element' => 'style', 'value' => array('style1', 'style3'))
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Sub Title Style",
                        "heading" => __("Load Font Family from google", 'inwave-common'),
                        "param_name" => "load_font_sub_title",
                        "value" => array(
                            __('No', 'inwave-common') => '',
                            __('Yes', 'inwave-common') => '1',
                        ),
                        "dependency" => array('element' => 'style', 'value' => array('style1', 'style3'))
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Sub Title Style",
                        "heading" => __("Sub Title Font Weight", 'inwave-common'),
                        "param_name" => "font_weight_sub_title",
                        "description" => __('Font weight of Sub Title', 'inwave-common'),
                        "value" => $font_weight,
                        "dependency" => array('element' => 'style', 'value' => array('style1', 'style3'))
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Sub Title Style",
                        "heading" => __("Sub Title Text Transform", 'inwave-common'),
                        "param_name" => "text_transform_sub_title",
                        "description" => __('Text Transform of Sub Title', 'inwave-common'),
                        "value" => $text_transform,
                        "dependency" => array('element' => 'style', 'value' => array('style1', 'style3'))
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Sub Title Style",
                        "heading" => __("Sub Title Line Height", 'inwave-common'),
                        "param_name" => "line_height_sub_title",
                        "description" => __('Line height of Sub Title', 'inwave-common'),
                        "value" => "",
                        "dependency" => array('element' => 'style', 'value' => array('style1', 'style3'))
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Sub Title Style",
                        "heading" => __("Margin bottom", 'inwave-common'),
                        "param_name" => "margin_bottom_sub_title",
                        "description" => __('Margin bottom of Sub Title. Example: 30px', 'inwave-common'),
                        "value" => "",
                        "dependency" => array('element' => 'style', 'value' => array('style1', 'style3'))
                    ),

                    //Description style
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Description Color", 'inwave-common'),
                        "group" => "Description Style",
                        "param_name" => "color_description",
                        "description" => __('Color for Description', 'inwave-common'),
                        "value" => "",
                    ),
                    array(
                        'type' => 'textfield',
                        "group" => "Description Style",
                        "heading" => __(" Description Font Size", 'inwave-common'),
                        "value" => "",
                        "description" => __('Custom font-size Description. Example: 30px', 'inwave-common'),
                        "param_name" => "font_size_description",
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Description Font Family", 'inwave-common'),
                        "group" => "Description Style",
                        "param_name" => "font_family_description",
                        "description" => __('Font family of Description', 'inwave-common'),
                        "value" => $google_fonts,
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Description Style",
                        "heading" => __("Load Font Family from google", 'inwave-common'),
                        "param_name" => "load_font_description",
                        "value" => array(
                            __('No', 'inwave-common') => '',
                            __('Yes', 'inwave-common') => '1',
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Description Style",
                        "heading" => __("Description Font Weight", 'inwave-common'),
                        "param_name" => "font_weight_description",
                        "description" => __('Font weight of Description', 'inwave-common'),
                        "value" => $font_weight,
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Description Style",
                        "heading" => __("Description Text Transform", 'inwave-common'),
                        "param_name" => "text_transform_description",
                        "description" => __('Text Transform of Description', 'inwave-common'),
                        "value" => $text_transform,
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Description Style",
                        "heading" => __("Description Font Style", 'inwave-common'),
                        "param_name" => "font_style_description",
                        "description" => __('Font Style of Description', 'inwave-common'),
                        "value" => $font_style,
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Description Style",
                        "heading" => __("Description Line Height", 'inwave-common'),
                        "param_name" => "line_height_description",
                        "description" => __('Line height of description', 'inwave-common'),
                        "value" => "",
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Description Style",
                        "heading" => __("Margin top", 'inwave-common'),
                        "param_name" => "margin_top_description",
                        "description" => __('Margin bottom of Description. Example: 30px', 'inwave-common'),
                        "value" => "",
                    ),

                    //Read more style

                    array(
                        'type' => 'iw_icon',
                        "heading" => __("Icon Read More", 'inwave-common'),
                        "group" => "Read More Style",
                        "value" => "",
                        "description" => __("Click and select icon of your choice. You can get complete list of available icons here: <a target='_blank' href='http://fortawesome.github.io/Font-Awesome/icons/'>Font-Awesome</a>", 'inwave-common'),
                        "param_name" => "icon",
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Read More Background Color", 'inwave-common'),
                        "group" => "Read More Style",
                        "param_name" => "bg_read_more",
                        "description" => __('Background Color for Read More', 'inwave-common'),
                        "value" => "",
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Read More Color", 'inwave-common'),
                        "group" => "Read More Style",
                        "param_name" => "color_read_more",
                        "description" => __('Color for Read More', 'inwave-common'),
                        "value" => "",
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        'type' => 'textfield',
                        "group" => "Read More Style",
                        "heading" => __(" Read More Font Size", 'inwave-common'),
                        "value" => "",
                        "description" => __('Custom font-size Read More. Example: 14px', 'inwave-common'),
                        "param_name" => "font_size_read_more",
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Read More Font Family", 'inwave-common'),
                        "group" => "Read More Style",
                        "param_name" => "font_family_read_more",
                        "description" => __('Font family of Read More', 'inwave-common'),
                        "value" => $google_fonts,
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Read More Style",
                        "heading" => __("Load Font Family from google", 'inwave-common'),
                        "param_name" => "load_font_read_more",
                        "value" => array(
                            __('No', 'inwave-common') => '',
                            __('Yes', 'inwave-common') => '1',
                        ),
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Read More Style",
                        "heading" => __("Read More Font Weight", 'inwave-common'),
                        "param_name" => "font_weight_read_more",
                        "description" => __('Font weight of Read More', 'inwave-common'),
                        "value" => $font_weight,
                        "dependency" => array('element' => 'style', 'value' => 'style1')
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

            $output = $style = $class = $height_item = $title = $sub_title = $link = $img = $icon = $icon_item = $bg_icon = $icon_align = $align = $description = $css = $item_min_height = $readmore_text = $border_item = $border_item_v4 = '';
            extract(shortcode_atts(array(
                'style' => '',
                'height_item' => '',
                'title' => '',
                'sub_title' => '',
                'link' => '',
				'item_min_height' => '',
                'img' => '',
                'icon_item' => '',
                'bg_icon' => '',
				'border_item' => '',
                'border_icon' => '',
                'icon_align' => '',
				'readmore_text' => '',
                'align' => '',
                'description' => '',
                'css' => '',
                'color_title' => '',
                'font_size_title' => '',
                'font_family_title' => '',
                'load_font_title' => '',
                'font_weight_title' => '',
                'text_transform_title' => '',
                'line_height_title' => '',
                'margin_bottom_title' => '',
                'margin_letter_spacing' => '',

                'color_sub_title' => '',
                'font_size_sub_title' => '',
                'font_family_sub_title' => '',
                'load_font_sub_title' => '',
                'font_weight_sub_title' => '',
                'text_transform_sub_title' => '',
                'line_height_sub_title' => '',
                'margin_bottom_sub_title' => '',

                'color_description' => '',
                'font_size_description' => '',
                'font_family_description' => '',
                'load_font_description' => '',
                'font_weight_description' => '',
                'text_transform_description' => '',
                'font_style_description' => '',
                'line_height_description' => '',
                'margin_top_description' => '',

                'icon' => '',
                'bg_read_more' => '',
                'color_read_more' => '',
                'font_size_read_more' => '',
                'font_family_read_more' => '',
                'load_font_read_more' => '',
                'font_weight_read_more' => '',

                'class' => '',
            ), $atts));

            $class .= ' '.$style.' '. vc_shortcode_custom_css_class( $css);
            if($align){
                $class.= ' '.$align.'-text';
            }
            $img_tag = '';
            $bg_image_tag = '';
            if ($img) {
                $img = wp_get_attachment_image_src($img, 'large');
                $img = $img[0];
                $img_tag .= '<img src="' . $img . '" alt="' . $title . '">';
                $bg_image_tag.= 'background-image: url('.$img .')';
            }

            //title
            $title_style = array();
            if($color_title){
                $title_style[] = 'color: '.esc_attr($color_title);
            }
            if($font_size_title){
                $title_style[] = 'font-size: '.esc_attr($font_size_title);
            }
            if($font_family_title){
                if($load_font_title && !isset(Inwave_Shortcode::$loadfonts[$font_family_title.$font_weight_title])){
                    $font_url = "http" . ((is_ssl()) ? 's' : '') . "://fonts.googleapis.com/css?family={$font_family_title}";
                    wp_enqueue_style('google-font-'.strtolower(str_replace(" ", "-", $font_family_title.$font_weight_title)), $font_url);
                    Inwave_Shortcode::$loadfonts[$font_family_title.$font_weight_title] = true;
                }
                $title_style[] = 'font-family: '.esc_attr($font_family_title);
            }
            if($font_weight_title){
                $title_style[] = 'font-weight: '.esc_attr($font_weight_title);
            }
            if($text_transform_title){
                $title_style[] = 'text-transform: '.esc_attr($text_transform_title);
            }
            if($line_height_title){
                $title_style[] = 'line-height: '.esc_attr($line_height_title);
            }
            if($margin_bottom_title || $margin_bottom_title != 0){
                $title_style[] = 'margin-bottom: '.esc_attr($margin_bottom_title);
            }
            if($margin_letter_spacing){
                $title_style[] = 'letter-spacing: '.esc_attr($margin_letter_spacing);
            }

            //subtitle
            $sub_title_style = array();
            if($color_sub_title){
                $sub_title_style[] = 'color: '.esc_attr($color_sub_title);
            }
            if($font_size_sub_title){
                $sub_title_style[] = 'font-size: '.esc_attr($font_size_sub_title);
            }
            if($font_family_sub_title){
                if($load_font_sub_title && !isset(Inwave_Shortcode::$loadfonts[$font_family_sub_title.$font_weight_sub_title])){
                    $font_url = "http" . ((is_ssl()) ? 's' : '') . "://fonts.googleapis.com/css?family={$font_family_sub_title}";
                    wp_enqueue_style('google-font-'.strtolower(str_replace(" ", "-", $font_family_sub_title.$font_weight_sub_title)), $font_url);
                    Inwave_Shortcode::$loadfonts[$font_family_sub_title.$font_weight_sub_title] = true;
                }
                $sub_title_style[] = 'font-family: '.esc_attr($font_family_sub_title);
            }
            if($font_weight_sub_title){
                $sub_title_style[] = 'font-weight: '.esc_attr($font_weight_sub_title);
            }
            if($text_transform_sub_title){
                $sub_title_style[] = 'text-transform: '.esc_attr($text_transform_sub_title);
            }
            if($line_height_sub_title){
                $sub_title_style[] = 'line-height: '.esc_attr($line_height_sub_title);
            }
            if($margin_bottom_sub_title || $margin_bottom_sub_title != 0){
                $sub_title_style[] = 'margin-bottom: '.esc_attr($margin_bottom_sub_title);
            }

            //description
            $description_style = array();
            if($color_description){
                $description_style[] = 'color: '.esc_attr($color_description);
            }
            if($font_size_description){
                $description_style[] = 'font-size: '.esc_attr($font_size_description);
            }
            if($font_family_description){
                if($load_font_description && !isset(Inwave_Shortcode::$loadfonts[$font_family_description.$font_weight_description])){
                    $font_url = "http" . ((is_ssl()) ? 's' : '') . "://fonts.googleapis.com/css?family={$font_family_description}";
                    wp_enqueue_style('google-font-'.strtolower(str_replace(" ", "-", $font_family_description.$font_weight_description)), $font_url);
                    Inwave_Shortcode::$loadfonts[$font_family_description.$font_weight_description] = true;
                }
                $description_style[] = 'font-family: '.esc_attr($font_family_description);
            }
            if($font_weight_description){
                $description_style[] = 'font-weight: '.esc_attr($font_weight_description);
            }
            if($text_transform_description){
                $description_style[] = 'text-transform: '.esc_attr($text_transform_description);
            }
            if($font_style_description){
                $description_style[] = 'font-style: '.esc_attr($font_style_description);
            }
            if($line_height_description){
                $description_style[] = 'line-height: '.esc_attr($line_height_description);
            }
            if($margin_top_description){
                $description_style[] = 'margin-top: '.esc_attr($margin_top_description);
            }

            //read more
            $read_more_class = 'bg-no';
            if ($bg_read_more) {
                $read_more_class = 'bg-yes';
            }
            $read_more_style = array();
            if($color_read_more){
                $read_more_style[] = 'color: '.esc_attr($color_read_more);
            }
            if($bg_read_more){
                $read_more_style[] = 'background-color: '.esc_attr($bg_read_more);
            }
            if($font_size_read_more){
                $read_more_style[] = 'font-size: '.esc_attr($font_size_read_more);
            }
            if($font_family_read_more){
                if($load_font_read_more && !isset(Inwave_Shortcode::$loadfonts[$font_family_read_more.$font_weight_read_more])){
                    $font_url = "http" . ((is_ssl()) ? 's' : '') . "://fonts.googleapis.com/css?family={$font_family_read_more}";
                    wp_enqueue_style('google-font-'.strtolower(str_replace(" ", "-", $font_family_read_more.$font_weight_read_more)), $font_url);
                    Inwave_Shortcode::$loadfonts[$font_family_read_more.$font_weight_read_more] = true;
                }
                $read_more_style[] = 'font-family: '.esc_attr($font_family_read_more);
            }
            if($font_weight_read_more){
                $read_more_style[] = 'font-weight: '.esc_attr($font_weight_read_more);
            }

            $min_height = '';
            if ($item_min_height) {
                $min_height.= 'min-height: '.$item_min_height.' ';
            }
            $style_itemv2 = array();
            if($bg_image_tag){
                $style_itemv2[] = $bg_image_tag;
            }
            if($min_height){
                $style_itemv2[] = $min_height;
            }


            $title= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$title);
            $title= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$title);
            $title= preg_replace('/\/\/\//i', '<br />', $title);

            $sub_title= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$sub_title);
            $sub_title= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$sub_title);
            $sub_title= preg_replace('/\/\/\//i', '<br />', $sub_title);

            $description= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$description);
            $description= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$description);
            $description= preg_replace('/\/\/\//i', '<br />', $description);

            switch ($style) {
                // Normal style
                case 'style1':
                    $output .= '<div class="iw-item-info '.$style.'" style="'.$bg_image_tag.'">';
                    $output .= '<div class="iw-item-info-inner ' . $class . '">';
                    $output .= '<div class="info-wrap">';
                    if ($sub_title){
                        $output .= '<div class="sub-title" style="'.implode("; ",$sub_title_style).'">'.$sub_title.'</div>';
                    }
                    if ($title){
                        $output .= '<h3 class="title" style="'.implode("; ",$title_style).'">'.$title.'</h3>';
                    }
                    if ($description){
                        $output .= '<p class="description" style="'.implode("; ",$description_style).'">'.$description.'</p>';
                    }
                    if ($readmore_text && $link){
                        $output .= '<a class="item-readmore '.esc_attr($read_more_class).'" style="'.implode("; ",$read_more_style).'" href="'.esc_url($link).'" ><i class="'.$icon.'"></i><span>'.$readmore_text.'</span></a>';
                    }
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '</div>';
                    break;

                case 'style2':
                    $output .= '<div class="iw-item-info '.$class.'" style="'.implode("; ",$style_itemv2).'">';
                        $output .= '<div class="info-wrap">';
                            if($icon_item){
                                $output .= '<div class="item-info-icon"><i class="'.$icon_item.'"></i></div>';
                            }
                            $output .= '<div class="info-content">';
                                if ($title){
                                    if ($link) {
                                        $output .= '<h3 class="title"><a href="'.$link.'" style="'.implode("; ",$title_style).'">'.$title.'</a></h3>';
                                    }
                                    else {
                                        $output .= '<h3 class="title" style="'.implode("; ",$title_style).'">'.$title.'</h3>';
                                    }
                                }
                                if ($description){
                                    $output .= '<p class="description" style="'.implode("; ",$description_style).'">'.$description.'</p>';
                                }
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                    break;

                    case 'style3':
                        $output .= '<div class="iw-item-info '.$class.'" style="'.$min_height.'">';
                            $output .= '<div class="info-wrap">';
                                $output .= '<div class="info-content">';
                                    if($icon_item){
                                        $output .= '<div class="item-info-icon" style="background: '.$bg_icon.';"><i class="'.$icon_item.'"></i></div>';
                                    }
                                    $output .= '<div class="info-content-right">';
                                        if ($title){
                                            if ($link) {
                                                $output .= '<h3 class="title"><a href="'.$link.'" style="'.implode("; ",$title_style).'">'.$title.'</a></h3>';
                                            }
                                            else {
                                                $output .= '<h3 class="title" style="'.implode("; ",$title_style).'">'.$title.'</h3>';
                                            }
                                        }
                                        if ($sub_title){
                                            $output .= '<div class="sub-title" style="'.implode("; ",$sub_title_style).'">'.$sub_title.'</div>';
                                        }
                                    $output .= '</div>';
                                $output .= '</div>';
                                if ($description){
                                    $output .= '<p class="description" style="'.implode("; ",$description_style).'">'.$description.'</p>';
                                }
                            $output .= '</div>';
                        $output .= '</div>';
                        break;

                case 'style4':
                    $output .= '<div class="iw-item-info  style2 '.$class.'" style="'.$min_height.'">';
                    $output .= '<div class="info-wrap">';
                    if($icon_item){
                        $output .= '<div class="item-info-icon"><i class="'.$icon_item.'"></i></div>';
                    }
                    $output .= '<div class="info-content">';
                    if ($title){
                        if ($link) {
                            $output .= '<h3 class="title"><a href="'.$link.'" style="'.implode("; ",$title_style).'">'.$title.'</a></h3>';
                        }
                        else {
                            $output .= '<h3 class="title" style="'.implode("; ",$title_style).'">'.$title.'</h3>';
                        }
                    }
                    if ($description){
                        $output .= '<p class="description" style="'.implode("; ",$description_style).'">'.$description.'</p>';
                    }
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '</div>';
                    break;
            }
            return $output;
        }
    }
}

new Inwave_Item_Info;
