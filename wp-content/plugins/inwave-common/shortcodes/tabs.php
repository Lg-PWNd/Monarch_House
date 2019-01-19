<?php
/*
 * Inwave_Tabs for Visual Composer
 */
if (!class_exists('Inwave_Tabs')) {

    class Inwave_Tabs extends Inwave_Shortcode2
    {

        protected $name = 'inwave_tabs';
        protected $name2 = 'inwave_tab_container';
        protected $layout;
        protected $item_count = 0;
        protected $first_item = 0;
        protected $active_item = 1;


        function init_params()
        {
            return array(
                "name" => __("Tabs", 'inwave-common'),
                "base" => $this->name,
                "content_element" => true,
                'category' => 'Theme Custom',
                "description" => __("Add a set of tabs and give some custom style.", 'inwave-common'),
                "as_parent" => array('only' => 'inwave_tab_container'),
                "show_settings_on_create" => true,
                "js_view" => 'VcColumnView',
                'icon' => 'iw-default',
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "class" => "iw-tabs-style",
                        "heading" => "Style",
                        "param_name" => "layout",
                        "value" => array(
                            "Tab - Style 1" => "layout1",
                            "Tab - Style 2" => "layout2",
                            "Tab - Style 3" => "layout3",
                        )
                    ),
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style ( Icon - background color theme)", 'inwave-common'),
                        "param_name" => "preview_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/tab-1.png',
                        "dependency" => array('element' => 'layout', 'value' => 'layout1')
                    ),
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style ( Icon - background color theme)", 'inwave-common'),
                        "param_name" => "preview_style2",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/tab-2.png',
                        "dependency" => array('element' => 'layout', 'value' => 'layout2')
                    ),
	                array(
		                "type" => "iwevent_preview_image",
		                "heading" => __("Preview Style ( Icon - background color theme)", 'inwave-common'),
		                "param_name" => "preview_style3",
		                "value" => get_template_directory_uri() . '/assets/images/shortcodes/tab-3.png',
		                "dependency" => array('element' => 'layout', 'value' => 'layout3')
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
                        "class" => "",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "value" => "",
                        "description" => __("Write your own CSS and mention the class name here.", 'inwave-common'),
                    ),
                )
            );
        }

        function init_params2()
        {
            return array(
                "name" => __("Tab Container", 'inwave-common'),
                "base" => $this->name2,
                "content_element" => true,
                'icon' => 'iw-default',
                'category' => 'Theme Custom',
                "description" => __("Add a set of tabs and give some custom style.", 'inwave-common'),
                "show_settings_on_create" => true,
                "as_child" => array('only' => 'inwave_tabs'),
                "as_parent" => array('except' => 'inwave_tabs,inwave_tab_container'),
                "js_view" => 'VcColumnView',
                "params" => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Title", 'inwave-common'),
                        "value" => "This is title",
                        "param_name" => "title"
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "value" => "",
                        "description" => __("Write your own CSS and mention the class name here.", 'inwave-common'),
                    ),
                )
            );
        }

        function register_scripts()
        {
            wp_register_script('iw-tabs', plugins_url() . '/inwave-common/assets/js/iw-tabs.js', array('jquery'), INWAVE_COMMON_VERSION, true);
        }

        // Shortcode handler function for list
        function init_shortcode($atts, $content = null)
        {
            wp_enqueue_script('iw-tabs');
            $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes($this->name, $atts) : $atts;

            $output = $layout = $item_active = $class ='';
            extract(shortcode_atts(array(
                "class" => "",
                'layout' => '1',
                'item_active' => ''
            ), $atts));

            $this->first_item = true;
            $this->layout = $layout;
            $this->item_count = 0;
            $item_active_default = 1;
            if ($item_active) {
                $item_active_default = $item_active;
            }
            $this->active_item = $item_active;
            $type = 'tab';
            $matches = array();
            $count = preg_match_all('/\[inwave_tab_container\s+title="([^\"]+)"(.*)\]/Usi', $content, $matches);
            $output .= '<div class="iw-tabs ' . $class . ' ' . $layout . '" data-type="'.$type.'">';

            $output.= '<div class="iw-tab-items iwj-magic-line-wrap">';
            $output.= '<div class="iw-tab-items-bg iwj-magic-line">';
            if ($count) {
                $i = 0;
                foreach ($matches[1] as $key => $value) {
                    $i++;
                    $icon = isset($matches[2][$key]) ? $matches[2][$key] : '';
                    $output.= '<div class="iw-tab-item iwj-toggle ' . ($i == $item_active ? 'active' : '') . '">';
                    $output.= '<div class="iw-tab-title">' . $value . '</div>';
                    $output.= '</div>';
                }
            }
            $output .= '</div>';
            $output .= '</div>';

            $output .= '<div class="iw-tab-content">';
            $output .= '<div class="iw-tab-content-inner">';
            $output .= do_shortcode($content);
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="clearfix"></div>';
            $output .= '</div>';

            return $output;
        }

        // Shortcode handler function for item
        function init_shortcode2($atts, $content = null)
        {
            $output = $title = $icon = $class = '';
            $content = do_shortcode($content);
            $content = preg_replace('/^\<\/p\>(.*)\<p\>$/Usi', '$1', $content);
            $this->item_count++;

            extract(shortcode_atts(array(
                'title' => '',
                'class' => ''
            ), $atts));

            $active_item_content = 1;
            if($this->active_item)  {
                $active_item_content = $this->active_item;
            }

            $output .= '<div class="iw-tab-item-content ' . ($this->item_count == $active_item_content ? 'active' : 'next') . ' ' . $class . '">';
            $output .= $content;
            $output .= '</div>';
            if ($this->first_item) {
                $this->first_item = false;
            }
            return $output;
        }
    }
}

new Inwave_Tabs;

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Inwave_Tabs extends WPBakeryShortCodesContainer
    {
    }
    class WPBakeryShortCode_Inwave_Tab_Container extends WPBakeryShortCodesContainer
    {
    }
}
