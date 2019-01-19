<?php
/*
 * Inwave_Map for Visual Composer
 */
if (!class_exists('Inwave_Posts')) {

    class Inwave_Posts extends Inwave_Shortcode{

        protected $name = 'inwave_posts';

        function init_params() {
            $_categories = get_categories();
            $cats = array(__("All", 'inwave-common') => '');
            foreach ($_categories as $cat) {
                $cats[$cat->name] = $cat->term_id;
            }

            return array(
                'name' => __('Posts', 'inwave-common'),
                'description' => __('Display a list of posts ', 'inwave-common'),
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
                        'type' => 'textfield',
                        "heading" => __("Post Ids", 'inwave-common'),
                        "value" => "",
                        "param_name" => "post_ids",
                        "description" => __('Id of posts you want to get. Separated by commas.', 'inwave-common')
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Post Category", 'inwave-common'),
                        "param_name" => "category",
                        "value" => $cats,
                        "description" => __('Category to get posts.', 'inwave-common')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Post per page", 'inwave-common'),
                        "param_name" => "post_number",
                        "value" => "3",
						"admin_label" => true,
                        "description" => __('Number of posts to display on box.', 'inwave-common')
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => "Number column",
                        "param_name" => "number_column",
                        "value" => array(
                            "1" => "1",
                            "2" => "2",
                            "3" => "3",
                            "4" => "4"
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Order By", 'inwave-common'),
                        "param_name" => "order_by",
                        "value" => array(
                            'ID' => 'ID',
                            'Title' => 'title',
                            'Date' => 'date',
                            'Modified' => 'modified',
                            'Ordering' => 'menu_order',
                            'Random' => 'rand'
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Order Type", 'inwave-common'),
                        "param_name" => "order_type",
                        "value" => array(
                            'ASC' => 'ASC',
                            'DESC' => 'DESC'
                        ),
                    ),
					array(
                        "type" => "textfield",
                        "heading" => __("Number word of description", 'inwave-common'),
						'description' => __('Trim description. Exp: 15', 'inwave-common'),
                        "param_name" => "number_desc",
                        "value" => '15',
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
            $output = $post_ids = $category = $post_number = $number_column = $order_by = $order_type = $style = $number_desc = $class = '';
            extract(shortcode_atts(array(
                'title' => '',
                'post_ids' => '',
                'category' => '',
                'post_number' => 3,
                'number_column' => 3,
                'order_by' => 'ID',
                'order_type' => 'DESC',
                'style' => 'style1',
				'number_desc' => '15',
                'class' => ''
                            ), $atts));

            $args = array();
            if ($post_ids) {
                $args['post__in'] = explode(',', $post_ids);
            } else {
                if ($category) {
                    $args['category__in'] = $category;
                }
            }
            $args['posts_per_page'] = $post_number;
            $args['order'] = $order_type;
            $args['orderby'] = $order_by;
            $args['suppress_filters'] = 0;
            $posts = get_posts($args);
            $class .= ' '. $style;

            ob_start();
            switch ($style) {
                case 'style1':
					?>
					<div class="iw-posts <?php echo $class ?>">
                        <div class="iw-posts-list row">
							<?php
                                foreach ($posts as $post) :
									$img = get_the_post_thumbnail_url($post->ID, 'full');
									$img_src = count($img) ? $img : '';
									if(!$img_src){
										$img_src = inwave_get_placeholder_image();
									}
									$img_src = inwave_resize($img_src, 370, 370, true);
                                    $comment_count = get_comments_number();
									?>
									<div class="col-md-<?php echo 12 / $number_column ?> col-sm-6 col-xs-12 element-item">
                                        <div class="post-item">
                                            <div class="post-image">
                                                <img src="<?php echo $img_src; ?>" alt="">
                                            </div>
                                            <div class="post-content-wrap">
                                                <div class="post-content">
                                                    <?php
                                                    $post_categories = get_the_category( $post->ID );
                                                    $cats = array();
                                                    if(!empty($post_categories)){
                                                        foreach($post_categories as $post_cat):
                                                            $term_link = get_term_link($post_cat);
                                                            $cats[] = '<a href="' . esc_url($term_link) . '">' . $post_cat->name . '</a>';
                                                        endforeach;
                                                    }
                                                    ?>
                                                    <?php if (!empty($cats)) : ?>
                                                        <span class="post-category"><?php echo implode(' / ', $cats); ?> - </span>
                                                    <?php endif; ?>
                                                    <span class="post-date"><?php echo get_the_date("d. F. Y"); ?></span>
                                                    <h3 class="post-title">
                                                        <a href="<?php echo get_permalink($post); ?>"><?php echo $post->post_title ?></a>
                                                    </h3>
                                                    <div class="post-description">
                                                        <?php
                                                        if($post->post_excerpt){
                                                            echo wp_trim_words($post->post_excerpt, $number_desc);
                                                        } else {
                                                            echo strip_shortcodes(wp_trim_words( $post->post_content, $number_desc ));
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="post-bottom">
                                                        <span class="post-author">
                                                            <?php echo esc_html__('by', 'inwave-common'); ?> <span><?php echo get_the_author_link(); ?></span>
                                                        </span>
                                                        <?php if($comment_count) : ?>
                                                            <span class="post-comment-count"><?php echo $comment_count; ?> <?php echo esc_html__('comment', 'inwave-common'); ?></span>
                                                        <?php endif; ?>
                                                        <a class="post-read-more theme-color" href="<?php echo get_permalink($post); ?>"><i class="ion-arrow-right-c"></i><?php echo esc_html__('Read more', 'inwave-common') ;?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-social-share">
                                                <?php
                                                inwave_social_sharing(get_permalink(), Inwave_Helper::substrword(get_the_excerpt(), 10), get_the_title());
                                                ?>
                                            </div>
                                        </div>
									</div>
                            <?php endforeach;?>
                        </div>
					</div>
				<?php
                break;

                case 'style2':
					?>
					<div class="iw-posts-2 <?php echo $class ?>">
                        <div class="iw-posts-list row">
							<?php
                                foreach ($posts as $post) :
									$img = get_the_post_thumbnail_url($post->ID, 'full');
									$img_src = count($img) ? $img : '';
									if(!$img_src){
										$img_src = inwave_get_placeholder_image();
									}
									$img_src = inwave_resize($img_src, 370, 245, true);
                                    $comment_count = get_comments_number();
                                    $post_categories = get_the_category( $post->ID );
                                    $cats = array();
                                    if(!empty($post_categories)){
                                        foreach($post_categories as $post_cat):
                                            $term_link = get_term_link($post_cat);
                                            $cats[] = '<a href="' . esc_url($term_link) . '">' . $post_cat->name . '</a>';
                                        endforeach;
                                    }
									?>
									<div class="col-md-<?php echo 12 / $number_column ?> col-sm-6 col-xs-12 element-item">
                                        <div class="post-item">
                                            <div class="post-image">
                                                <img src="<?php echo $img_src; ?>" alt="">
                                                <?php if (!empty($cats)) : ?>
                                                    <span class="post-category theme-bg"><?php echo implode(' / ', $cats); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="post-content">
<!--                                                <span class="post-date">--><?php //echo get_the_date("d. F. Y"); ?><!--</span>-->
                                                <h3 class="post-title">
                                                    <a href="<?php echo get_permalink($post); ?>"><?php echo $post->post_title ?></a>
                                                </h3>
                                                <div class="post-description">
                                                    <?php
                                                    if($post->post_excerpt){
                                                        echo wp_trim_words($post->post_excerpt, $number_desc);
                                                    } else {
                                                        echo strip_shortcodes(wp_trim_words( $post->post_content, $number_desc ));
                                                    }
                                                    ?>
                                                </div>
                                                <div class="post-bottom">
                                                    <span class="post-author">
                                                        <?php echo esc_html__('By:', 'inwave-common'); ?> <span><?php echo get_the_author_posts_link(); ?></span>
                                                    </span>
                                                    <a class="post-read-more theme-color" href="<?php echo get_permalink($post); ?>"><?php echo esc_html__('Read more', 'inwave-common') ;?><i class="ion-arrow-right-c"></i></a>
                                                </div>
                                            </div>
                                        </div>
									</div>
                            <?php endforeach;?>
                        </div>
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

new Inwave_Posts();