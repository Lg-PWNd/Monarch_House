<?php
$mode_view_class              = 'iwj-grid';
$show_employer_public_profile = iwj_option( 'show_employer_public_profile', '' );
$login_page_id                = get_permalink( iwj_option( 'login_page_id' ) );
?>

<div class="iwj-employers <?php echo $mode_view_class; ?>">
	<?php
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post();
			$employer = IWJ_Employer::get_employer( get_the_ID() );
			$image    = iwj_get_avatar( $employer->get_author_id() );
			?>
			<div class="grid-content">
				<div class="iwj-employer-item">
					<?php if ( $image ) : ?>
						<div class="employer-image"><?php echo $image; ?></div>
					<?php endif; ?>
					<div class="employer-info">
						<div class="info-top">
							<h3>
								<?php
								if ( ! $show_employer_public_profile || ( $show_employer_public_profile && is_user_logged_in() ) ) {
									$link_profile = get_permalink( $employer->get_id() );
								} else {
									$link_profile = add_query_arg( 'redirect_to', $employer->permalink(), $login_page_id );
								} ?>
								<a href="<?php echo esc_url( $link_profile ); ?>" class="employer-name"><?php echo $employer->get_title(); ?></a>
							</h3>
						</div>
						<div class="info-company">
							<?php if ( $category_titles = $employer->get_category_titles() ) : ?>
								<div class="company">
									<i class="fa fa-suitcase"></i><?php echo implode( ', ', $category_titles ); ?></div>
							<?php endif; ?>
							<?php if ( $employer->get_address() ) : ?>
								<div class="address">
									<i class="fa fa-map-marker"></i><?php echo $employer->get_address(); ?></div>
							<?php endif; ?>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php endwhile;
		wp_reset_postdata();
	endif; ?>
</div>

<?php if ( $query->max_num_pages > 1 ): ?>
	<?php
	if ( ! isset( $paged ) ) {
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
	}
	?>
	<div class="clearfix"></div>
	<div class="w-pagination ajax-employer-pagination">
		<?php iwj_ajax_pagination( $query->max_num_pages, $paged ); ?>
	</div>
<?php endif; ?>


