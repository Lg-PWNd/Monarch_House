<?php
/**
 * Created by PhpStorm.
 * User: VodKa
 * Date: 8/16/2017
 * Time: 11:20 AM
 * Inwave_Faq_Listing for Visual Composer
 */
if (!class_exists('Inwave_Faq_Listing')) {

    class Inwave_Faq_Listing extends Inwave_Shortcode{

        protected $name = 'iw_gallery_listing';

        function init_params() {

            return array(
                'name' => __('Faq Listing', 'inwavethemes'),
                'description' => __('Create a list of Faq', 'inwavethemes'),
                'base' => $this->name,
                'category' => 'Theme Custom',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Posts per page", 'inwave-common'),
                        "description" => __('Accepts -1 (all) or any positive number.', 'inwave-common'),
                        "param_name" => "posts_per_page",
                        "value" => '12',
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
                        'group' => __( 'Design Options', 'inwavethemes' )
                    )
                )
            );
        }

        // Shortcode handler function for list Icon
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            extract(shortcode_atts(array(
                "posts_per_page" => "",
                "css" => "",
                "class" => ""
            ), $atts));

            $class .= ' '. vc_shortcode_custom_css_class($css);

            $paged = (get_query_var('page')) ? get_query_var('page') : 1;

            $args = array(
                'post_type' => 'faq',
                'post_status' => 'publish',
                'posts_per_page' => $posts_per_page,
                'paged' => $paged
            );

            $query = new WP_Query($args);


            ob_start();
            ?>
            <div class="iw-faqs <?php echo esc_attr($class); ?>" data-posts_per_page="<?php echo esc_attr($posts_per_page); ?>">
                <div class="iw-shortcode-accordions">
                    <div id="ajax-posts" class="iw-accordions">
                        <div id="accordion" class="iw-accordions-items iw-faqs-main panel-group">
                            <?php
                            $i = 0;
                            if ($query->have_posts()) :
                                while ($query->have_posts()) :
                                    $query->the_post();
                                    $total_posts = $query->found_posts;
                                    ?>
                                    <div class="iw-accordion-item faq-accordion-item panel panel-default">
                                        <div class="iw-accordion-header faq-accordion-header panel-heading <?php echo $i == 0 ? 'active' : '' ?>">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo get_the_ID(); ?>"><?php the_title(); ?></a>
                                        </div>
                                        <div id="<?php echo get_the_ID(); ?>" class="iw-accordion-content panel-collapse collapse <?php echo $i == 0 ? 'in' : '' ?>">
                                            <div class="panel-body iw-desc"><?php the_content();?></div>
                                        </div>
                                    </div>
                                    <?php
                                $i++;
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            $total_page = ceil( $total_posts / $posts_per_page); // Calculate Total pages
                            ?>
                        </div>
                        <div id="hidden_data_total_post" data-totalpost="<?php echo $total_page;?>"></div>
                    </div>
                </div>

                <?php if ($total_posts > $posts_per_page) { ?>
                    <div class="iw-load-more-faq">
                        <button class="load-more load-posts theme-bg" id="load-more-faq"><span class="ajax-loading-icon"><i class="fa fa-spinner fa-spin fa-2x"></i></span><?php echo  __('Load more', 'inwavethemes') ?></button>
                    </div>
                <?php } ?>
            </div>

            <?php
            $html = ob_get_contents();
            ob_end_clean();

            return $html;
        }
    }
}

new Inwave_Faq_Listing();
