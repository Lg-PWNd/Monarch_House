<?php
/*
 * Inwave_Quote for Visual Composer
 */
if (!class_exists('Inwave_Quote')) {

    class Inwave_Quote extends Inwave_Shortcode{

        protected $name = 'inwave_quote';

        function init_params() {

            return array(
                'name' => __('Quote', 'inwave-common'),
                'description' => __('Add a quote ', 'inwave-common'),
                'base' => $this->name,
                'icon' => 'iw-default',
                'category' => 'Theme Custom',
                'params' => array(
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
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", 'inwave-common'),
                        "param_name" => "preview_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/posts-style1.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        'type' => 'textarea_html',
                        "heading" => __("Testimonial Content", 'inwave-common'),
                        "description" => __("You can add |TEXT_EXAMPLE| to specify strong words, <br />{TEXT_EXAMPLE} to specify colorful words, <br />'///' to insert line break tag (br)", 'inwave-common'),
                        "value" => "",
                        "param_name" => "content"
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            );
        }

        // Shortcode handler function for list Icon
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;
            $output = $style = $class = '';
            extract(shortcode_atts(array(
                'style' => 'style1',
                'class' => ''
                            ), $atts));

            $content= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$content);
            $content= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$content);
            $content= preg_replace('/\/\/\//i', '<br />', $content);

            ob_start();
            switch ($style) {
                case 'style1':
					?>
                    <div class="iw-quote-item style1 <?php echo $class; ?>">
                        <div class="icon-quote">“</div>
                        <div class="quote-content"><?php echo $content; ?></div>
					</div>
				<?php
                break;
			}
            $html = ob_get_contents();
            ob_end_clean();

            return $html;
        }
    }
}

new Inwave_Quote();