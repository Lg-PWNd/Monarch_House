<?php
/**
 *
 * Template Name: Blog Page - Template
 * Description: A page template that displays the Homepage or a Front page as in theme main page with slider and some other contents of the
 * post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package robojob lite
 */

get_header();

if ( get_header_image() ) :
    $header_image = get_header_image();
else:
    $header_image = '';
endif; // End header image check.

$sidebar_class = robojob_lite_sidebar_archive_class();

if (is_front_page()) { ?>


<section class="section page-header" <?php if( ! empty($header_image) ) { echo 'style="background-image:url(' . esc_url($header_image) . ')"'; } ?>>

<?php } ?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1><?php echo esc_html_e('Blog', 'robojob-lite'); ?></h1>
					<div class="page-header-meta">
						<?php the_archive_description( '<h4>', '</h4>' ); ?>
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="pagehead-button">
				<a href="#" class="btn btn-primary btn-lg">Post a job</a>
		</div> -->

</section>
<!-- End Titlebar -->

<section class="section section-content">
	<div class="container">
		<div class="row">

			<div id="primary" class="content-area <?php echo esc_attr($sidebar_class); ?>">
				<main id="main" class="site-main" role="main">

					<?php
						$blog_args = array(
							'post_type' => 'post',
							'orderby'	=> 'DATE',
							'order'		=> 'DESC',
							'post_status' => 'publish',
							'paged' => get_query_var('page'),
							);
						$blog_query = new WP_Query($blog_args);
					if ( $blog_query->have_posts() ) :

						if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>

						<?php
						endif;

						/* Start the Loop */
						while ( $blog_query->have_posts() ) : $blog_query->the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
    						get_template_part('template-parts/content','archive');

						endwhile;

						the_posts_pagination( array(
                            'mid_size' => 2,
                            'prev_text' => __( 'Back', 'robojob-lite' ),
                            'next_text' => __( 'Next', 'robojob-lite' ),
                        ) );

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

				</main>
				<!-- End Main -->
			</div>
			<!-- End Primary -->

			<?php robojob_lite_sidebar_archive(); ?>

		</div>
		<!-- End Row -->
	</div>
	<!-- End Container -->
</section>
<!-- End Section Content -->

<?php
get_footer();
