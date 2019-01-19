<?php
/*
 * Inwave_Image_Link for Visual Composer
 */
if (!class_exists('Inwave_Image_Link')) {

    class Inwave_Image_Link extends Inwave_Shortcode{

        protected $name = 'inwave_image_link';

        function init_params() {

            return array(
                'name' => __('Image Link', 'inwave-common'),
                'description' => __('Add a image ', 'inwave-common'),
                'base' => $this->name,
                'icon' => 'iw-default',
                'category' => 'Theme Custom',
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        "heading" => __("Image", 'inwave-common'),
                        "param_name" => "img",
                        "description" => "",
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Title", 'inwave-common'),
                        "description" => "",
                        "value" => "",
                        "param_name" => "title"
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Link Read More", 'inwave-common'),
                        "value" => "#",
                        "param_name" => "link",
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Title Item Comming Soon", 'inwave-common'),
                        "description" => "",
                        "value" => "Comming soon!",
                        "param_name" => "title_comming"
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Title Item Comming Soon", 'inwave-common'),
                        "description" => "",
                        "value" => "Map Search",
                        "param_name" => "sub_title_comming"
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
            $img = $title = $link = $title_comming = $sub_title_comming = $class = '';
            extract(shortcode_atts(array(
                'img' => '',
                'title' => '',
                'link' => '',
                'title_comming' => '',
                'sub_title_comming' => '',
                'class' => ''
                            ), $atts));

            if ($img) {
                $img = wp_get_attachment_image_src($img, 'large');
                $img = $img[0];
            }

            ob_start();
					?>
                    <div class="iw-image-link <?php echo $class; ?>">
                        <div class="image">
                            <a href="<?php echo esc_url($link); ?>"><img src="<?php echo esc_url($img); ?>" alt=""></a>
                            <div class="content-comming-soon">
                                <div class="cs-sub-title"><?php echo esc_attr($sub_title_comming) ?></div>
                                <div class="cs-title"><?php echo esc_attr($title_comming) ?></div>
                            </div>
                        </div>
                        <div class="title"><a href="<?php echo esc_url($link); ?>"><?php echo $title; ?></a></div>
					</div>
            <?php
            $html = ob_get_contents();
            ob_end_clean();

            return $html;
        }
    }
}

new Inwave_Image_Link();