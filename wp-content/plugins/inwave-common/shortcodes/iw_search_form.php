<?php
/**
 * Created by PhpStorm.
 * User: VodKa
 * Date: 8/16/2017
 * Time: 11:20 AM
 * Inwave_Search_Form for Visual Composer
 */
if (!class_exists('Inwave_Search_Form')) {

    class Inwave_Search_Form extends Inwave_Shortcode{

        protected $name = 'inwave_search_form';

        function init_params() {

            return array(
                'name' => __('Inwave Search Form', 'inwavethemes'),
                'description' => "",
                'base' => $this->name,
                'category' => 'Theme Custom',
                'icon' => 'iw-default',
                'params' => array(
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
                        'group' => __( 'Design Options', 'inwavethemes' )
                    )
                )
            );
        }

        // Shortcode handler function for list Icon
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            extract(shortcode_atts(array(
                "css" => "",
                "class" => ""
            ), $atts));

            $class .= ' '. vc_shortcode_custom_css_class($css);

            global $post;

            ob_start();
            ?>
            <div class="iw-search-form iwj-form <?php echo esc_attr($class); ?>">
                <form action="<?php echo get_permalink($post->ID); ?>" method="get">
                    <div class="iwj-field">
                        <label><?php echo __("What you're looing for?" ,"inwavethemes"); ?></label>
                        <div class="iwj-input">
                            <i class="ion-android-create"></i>
                            <input placeholder="<?php echo __("Enter keyword", 'inwavethemes') ?>" name="keyword" value="<?php echo (isset($_GET['keyword']) ? esc_attr($_GET['keyword']) : ''); ?>" type="text">
                        </div>
                    </div>
                    <div class="field-item-submit">
                        <button class="theme-bg"><i class="ion-android-arrow-forward"></i></button>
                    </div>
                </form>
            </div>

            <?php
            $html = ob_get_contents();
            ob_end_clean();

            return $html;
        }
    }
}

new Inwave_Search_Form();
