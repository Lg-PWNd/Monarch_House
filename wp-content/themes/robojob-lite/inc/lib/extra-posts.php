<?php
/**
 * Robojob extra-posts (testimonial, latest blog, services, call-to-action, call out).
 *
 * @package robojob lite
 */
if ( ! function_exists( 'testimonial_layout' ) ) :

    function testimonial_layout() {

        $customizer_options   = robojob_lite_options();
        $testimonial_count    = 3;
        $testimonial_title    = $customizer_options['testimonial_title'];
        $testimonial_bg_image = $customizer_options['testimonial_bg_image'];
        $bg_image_class        = ( ! empty($testimonial_bg_image)?'section-bg':'');
        $testimonial_category    = $customizer_options['testimonial_category'];
         $tax_query = '';
         if($testimonial_category!='none'){
                $tax_query[] =  array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $testimonial_category,
                );
            }
        $testimonial_argument = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'oderby'         => 'date',
            'order'          => 'desc',
            'posts_per_page' => $testimonial_count,
            'tax_query' => $tax_query,
            );
        $testimonial_query = new WP_Query($testimonial_argument);
        ob_start();
        global $post;
        if ($testimonial_query->have_posts() ) : ?>
            <!-- Start of layout2 -->
            <section class="section <?php echo esc_attr($bg_image_class); ?> cp-testimonial-sec alt" style="background-image: url(<?php echo esc_attr($testimonial_bg_image); ?>);">
                <div class="loader"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ( ! empty($testimonial_title) ) : ?>
                                <div class="section-header">
                                    <h3><?php echo esc_html($testimonial_title); ?></h3>
                                </div>
                            <?php endif; ?>

                            <div class="single-item-testimonial">
                                <?php
                                while ($testimonial_query->have_posts() ) :
                                    $testimonial_query->the_post();
                                    $testimonial_image_id  = get_post_thumbnail_id();
                                    $testimonial_image_url = wp_get_attachment_image_src($testimonial_image_id,'thumbnail');
                                    $testimonial_image     = $testimonial_image_url[0];
                                    $alt = get_post_meta($testimonial_image_id, '_wp_attachment_image_alt', true);
                                    ?>
                                    <div class="testimonial">
                                        <blockquote>
                                            <?php echo wp_kses_post(robojob_lite_get_excerpt($post->ID,300));?>
                                        </blockquote>
                                        <div class="testimonial-author">
                                            <img src="<?php echo esc_attr($testimonial_image); ?>" alt="<?php if (! empty($alt)){ echo esc_attr($alt); } else { echo esc_attr($post->post_title); } ?>">
                                            <span><?php the_title(); ?></span>
                                        </div>
                                    </div>
                               <?php
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </div>
                            <!-- End Testimonial Section -->
                        </div>
                    </div>
                </div>
            </section>
        <?php
        endif;
        wp_reset_query();

    }

endif;

if ( ! function_exists( 'latest_blog' ) ) :
    function latest_blog() {

        $customizer_options = robojob_lite_options();
        global $post;
        global $wp_query;
        $blog_category    = $customizer_options['blog_category'];
        $blog_post_count = 6;
        $tax_query = '';
         if($blog_category!='none'){
                $tax_query[] =  array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $blog_category,
                );
            }
        elseif ($blog_category == 'none') {
            $tax_query = '';
        }
        /* Get all sticky posts */
        $sticky = get_option( 'sticky_posts' );
        $sticky_count = count($sticky);

        if(!empty($sticky)){
            if(!empty($sticky_count) && $sticky_count > $blog_post_count):
                $blog_post_count = 0;
            elseif (!empty($sticky_count) && $blog_post_count >$sticky_count):
                $blog_post_count = $blog_post_count - $sticky_count;
            endif;
        }

        $blog_argument = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $blog_post_count,
                'orderby'     => 'date',
                'order'          => 'desc',
                'tax_query' => $tax_query,
                'ignore_sticky_posts' => 1,
                    );
        $blog_query = new WP_Query($blog_argument);
            $bg_image_class        = 'section-bg';
           ?>
            <!-- Start the  Blog section-->
            <section class="section cp-blog-sec">
                <div class="container">
                    <div class="row">
                            <div class="col-md-12 mb0">
                                <div class="section-header">
                                    <h3><?php echo esc_html__('Recent Posts', 'robojob-lite'); ?></h3>
                                </div>
                                <!-- End Section Header -->
                            </div>
                        <?php

                        if (!empty($sticky)) {
                               robojob_lite_sticky_posts($post);
                        }
                        /* Start the Loop */
                        global $post;
                        $count = 1;
                        /* Start the Loop */
                        while ( $blog_query->have_posts() ) :
                            $blog_query->the_post();
                            $post_format = get_post_format();
                            $total_posts = $blog_query->post_count;
                            ?>
                            <div class="col-md-4 col-sm-12 mob-margin-bot-30">
                                <div class="card">
                                    <article class="recent-post card-content">
                                        <?php robojob_lite_blog_post_format($post_format, $post->ID);?>
                                        <div class="card-body">
                                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <div class="entry-meta">
                                                <?php
                                                $blog_post_author = $customizer_options['blog_author_image'] ;
                                                    if ('1' == $blog_post_author ) {  ?>
                                                        <div class="entry-author">
                                                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr(get_the_author()); ?>">
                                                                <span class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 60, '', 'author-image', '' ); ?></span>
                                                            </a>
                                                        </div>
                                                    <?php }
                                                $blog_meta = $customizer_options['blog_meta'];
                                                if ('1' == $blog_meta ) {
                                                    robojob_lite_posted_on();
                                                } ?>
                            				</div>
                                            <p><?php echo wp_kses_post(robojob_lite_get_excerpt($post->ID,100)); ?></p>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-card"><?php echo esc_html__('Read More', 'robojob-lite'); ?></a>
                                    </article>
                                </div>
                            </div>
                            <?php
                                if (($count + $sticky_count) % 3 == 0 && ($count + $sticky_count) < $total_posts) {
                                        echo '</div>';
                                        echo '<div class="row">';
                                }
                             $count++;
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
             <?php

    }

endif;

if ( ! function_exists( 'cta_section' ) ) :

    function cta_section() {

            $customizer_options  = robojob_lite_options();
            $cta_page_id         = $customizer_options['cta_page_id'];
            $cta_button_link     = $customizer_options['cta_button_link'];
            $cta_layout          = 'center-button';
            $cta_right_button    = '';
            $post_thumbnail_id   = get_post_thumbnail_id($cta_page_id);
            $attachment          = get_post_meta($post_thumbnail_id);
            $featured_image      = wp_get_attachment_image_src($post_thumbnail_id , 'full');
            $bg_image_class      = ( ! empty($featured_image)?'section-bg':'');
            if ( $cta_page_id ) :
            ?>
            <!-- Start of call toacton imagebackground section -->
                <section class="call-to-action section text-center <?php echo esc_attr($bg_image_class); ?>" <?php if( ! empty($featured_image) ) { echo 'style="background-image:url(' . esc_url($featured_image[0]) . ')"'; } ?>>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="c2a-inner upper <?php echo esc_attr($cta_right_button); ?>">
                                    <h3><?php echo esc_html(get_the_title($cta_page_id)); ?></h3>
                                    <p><?php echo esc_html(robojob_lite_excerpt_by_id($cta_page_id)); ?></p>
                                    <div class="c2a-btn">
                                        <?php if ( ! empty($cta_button_link) ) { ?>
                                            <a href="<?php echo esc_url($cta_button_link); ?>" class="btn btn-default btn-lg "><?php echo esc_html__('Read More', 'robojob-lite'); ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php
            endif;
    }

endif;

if ( ! function_exists( 'service_section' ) ) :

    function service_section() {

        $customizer_options    = robojob_lite_options();
        $service_bg_image      = $customizer_options['service_bg_image'];
        $bg_image_class        = ( ! empty($service_bg_image)?'section-bg':'');
        $service_category    = $customizer_options['service_category'];
        for ( $i=1; $i <= 2 ; $i++ ) {
            $service_title[] = $customizer_options['service_title'. $i .''];
            $service_description[] = $customizer_options['service_description'. $i .''];
            $service_button_text[] = $customizer_options['service_button_text'. $i .''];
            $service_button_link[] = $customizer_options['service_button_link'. $i .''];
        }
        $service_title = array_filter($service_title);
        $service_description = array_filter($service_description);
         if (!empty($service_title) || !empty($service_description))
        {
         ?>

            <!-- Startof Services section -->
            <section class="section section-jobs-service section-bg section-light <?php echo esc_attr($bg_image_class); ?>" style="background-image: url(<?php echo esc_attr($service_bg_image); ?>);" >

                <div class="container">
                    <div class="row">
                       <?php
                            for ( $i=0; $i <= 1 ; $i++ ) {
                                if (!empty($service_title[$i]) || !empty($service_description[$i])) { ?>
                                    <div class="col-md-6">
                                        <div class="c2a-inner upper text-center mob-margin-bot-30">
                                            <h3><?php echo esc_html($service_title[$i]); ?></h3>
                                            <?php echo esc_html($service_description[$i]);?>
                                            <?php if (!empty($service_button_text[$i]) || !empty($service_button_link[$i])) { ?>
                                                 <div class="c2a-btn">
                                                    <a href="<?php echo (esc_url($service_button_link[$i])); ?>" class="btn btn-default">
                                                        <?php echo esc_html($service_button_text[$i]); ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                      <?php     }
                            } ?>

                   </div>
                </div>
            </section>

        <?php
        }

    }
endif;

if ( ! function_exists( 'call_out_section' ) ) :

    function call_out_section() {

        $customizer_options    = robojob_lite_options();
        $call_out_heading        = $customizer_options['call_out_heading'];
        for ( $i=1; $i <= 3 ; $i++ ) {
            $callout_title[] = $customizer_options['callout_title'. $i .''];
            $callout_description[] = $customizer_options['callout_description'. $i .''];
            $callout_icon[] = $customizer_options['callout_icon'. $i .''];
        }

        $callout_title = array_filter($callout_title);
        $callout_description = array_filter($callout_description);
        if (!empty($callout_title) || !empty($callout_description))
        {
         ?>

            <!-- Startof call_outs section -->
            <section class="section callout-section">
                <div class="container">
                    <div class="row">
                        <?php if ( ! empty($call_out_heading) ) { ?>
                            <div class="col-md-12 mb0">
                                <div class="section-header">
                                    <h3><?php echo esc_html($call_out_heading); ?></h3>
                                </div>
                                <!-- End Section Header -->
                            </div>
                        <?php } ?>

                        <?php
                            $class = 'col-md-4 col-sm-4';
                            for ( $i=0; $i <= 2 ; $i++ ) {
                                if (!empty($callout_icon[$i]) || !empty($callout_title[$i]) || !empty($callout_description[$i])) {
                        ?>

                                <div class="<?php echo esc_attr($class); ?>">
                                    <div class="c2a-inner upper text-center mob-margin-bot-30">

                                            <?php if (!empty($callout_icon[$i])) { ?><span class="icon"><i class="<?php echo esc_attr($callout_icon[$i]); ?>"></i></span><?php } ?>
                                            <?php if (!empty($callout_title[$i])) { ?><h3><?php echo esc_html($callout_title[$i]); ?></h3><?php } ?>
                                            <?php if (!empty($callout_description[$i])) { ?><p>
                                                <?php echo esc_html($callout_description[$i]); ?>
                                            </p><?php } ?>


                                    </div>
                                </div>

                        <?php  } }  ?>

                    </div>
                </div>

            </section>

        <?php
        }

    }

endif;
