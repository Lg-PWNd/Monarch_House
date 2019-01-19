<?php

/*
 * Inwave_Accordions for Visual Composer
 */
if (!class_exists('Inwave_Accordions')) {

    class Inwave_Accordions extends Inwave_Shortcode2
    {

        protected $name = 'inwave_accordions';
        protected $name2 = 'inwave_accordion_item';
        protected $layout;
        protected $item_count = 0;
        protected $first_item = 0;
        protected $item_row = 0;
        protected $icon_title = 'fa fa-check';
        protected $active_item = 1;

        function init_params()
        {
            return array(
                "name" => __("Accordions", 'inwavethemes'),
                "base" => $this->name,
                "content_element" => true,
                'category' => 'Theme Custom',
                "description" => __("Add a set of Accordion and give some custom style.", "inwavethemes"),
                "as_parent" => array('only' => 'inwave_accordion_item'),
                "show_settings_on_create" => true,
                "js_view" => 'VcColumnView',
                'icon' => 'iw-default',
                "params" => array(
                    array(
                        'type' => 'textfield',
                        "heading" => __("Item active", "inwavethemes"),
                        "value" => "1",
                        "description" => __("Choose item active", "inwavethemes"),
                        "param_name" => "item_active",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "value" => "",
                        "description" => __("Write your own CSS and mention the class name here.", "inwavethemes"),
                    ),
                )
            );
        }

        function init_params2()
        {
            return array(
                "name" => __("Accordion Item", 'inwavethemes'),
                "base" => $this->name2,
                'icon' => 'iw-default',
                'category' => 'Theme Custom',
                "description" => __("Add a set of Accordion and give some custom style.", "inwavethemes"),
                "show_settings_on_create" => true,
                "as_child" => array('only' => 'inwave_accordion'),
                "params" => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Title", "inwavethemes"),
                        "value" => "This is title",
                        "param_name" => "title"
                    ),
                    array(
                        'type' => 'textarea_html',
                        "admin_label" => true,
                        "heading" => __("Content", "inwavethemes"),
                        "value" => '',
                        "param_name" => "content"
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "value" => "",
                        "description" => __("Write your own CSS and mention the class name here.", "inwavethemes"),
                    ),
                )
            );
        }

        function register_scripts()
        {
            wp_register_script('iw-accordions', plugins_url() . '/inwave-common/assets/js/iw-accordions.js', array('jquery'), INWAVE_COMMON_VERSION, true);
        }

        // Shortcode handler function for list
        function init_shortcode($atts, $content = null)
        {
            $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes($this->name, $atts) : $atts;

            wp_enqueue_script('iw-accordions');

            $output = $layout = $icon_title = $item_active = $class ='';
            extract(shortcode_atts(array(
                "class" => "",
                "icon_title" => '',
                "item_active" => '',
                'layout' => '',
            ), $atts));

            $this->first_item = true;
            $this->layout = $layout;
            $this->item_count = 0;
            $this->icon_title = $icon_title;
            $this->active_item = $item_active;
            $output .= '<div class="iw-shortcode-accordions">';
            $output .= '<div class="iw-accordions ' . $class . ' ' . $layout . '" data-type="accordion">';
            $output .= '<div class="iw-accordions-item">';
            $output .= do_shortcode($content);
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';


            return $output;
        }

        // Shortcode handler function for item
        function init_shortcode2($atts, $content = null)
        {
            $output = $title = $sub_title = $font_size_title = $link = $icon_img = $description = $class = '';
            $this->item_count++;

            extract(shortcode_atts(array(
                'title' => '',
                'class' => ''
            ), $atts));

            $active_item_content = 1;
            if($this->active_item)  {
                $active_item_content = $this->active_item;
            }

            $output .= '<div class="iw-accordion-item ' . $class . '">';
            $output .= '<div class="iw-accordion-header ' . ($this->item_count == $active_item_content ? 'active' : '') . '">';
            $output .= '<div class="iw-accordion-title">' . $title . '</div>';
            $output .= '</div>';
            $output .= '<div class="iw-accordion-content" ' . ($this->item_count == $active_item_content ? '' : 'style="display: none;"') . '>';
            if ($content) {
                $output .= '<div class="iw-desc">' . apply_filters('the_content', $content) . '</div>';
            }
            $output .= '</div>';
            $output .= '</div>';
            if ($this->first_item) {
                $this->first_item = false;
            }
            return $output;
        }
    }
}

new Inwave_Accordions;

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Inwave_Accordions extends WPBakeryShortCodesContainer
    {
    }
}
