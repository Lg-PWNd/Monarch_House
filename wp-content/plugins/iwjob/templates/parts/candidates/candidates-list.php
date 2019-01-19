<?php
$mode_view_class               = 'iwj-listing';
$show_candidate_public_profile = iwj_option( 'show_candidate_public_profile', '' );
$login_page_id                 = get_permalink( iwj_option( 'login_page_id' ) );
?>

<div class="iwj-candidates <?php echo $mode_view_class; ?>">
	<?php
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post();
			$candidate = IWJ_Candidate::get_candidate( get_the_ID() );
			$image     = iwj_get_avatar( $candidate->get_author_id() ); ?>
			<div class="candidate-item">
				<?php if ( $image ) : ?>
					<div class="candidate-image"><?php echo $image; ?></div>
				<?php endif; ?>
				<div class="candidate-info">
					<div class="info-item">
						<h3 class="candidate-title">
							<?php
							if ( ! $show_candidate_public_profile ) {
								$link_profile = $candidate->permalink();
							} else {
								if ( $user ) {
									if ( $show_candidate_public_profile == 1 ) {
										$link_profile = $candidate->permalink();
									} else {
										if ( $user->is_employer() ) {
											$link_profile = $candidate->permalink();
										} else {
											$link_profile = 'javascript:void(0)';
										}
									}
								} else {
									$link_profile = add_query_arg( 'redirect_to', $candidate->permalink(), $login_page_id );
								}
							} ?>
							<a href="<?php echo $link_profile; ?>"><?php echo $candidate->get_title(); ?></a>
						</h3>
					</div>
					<div class="info-item">
						<?php if ( $category_titles = $candidate->get_category_titles() ) : ?>
							<div class="categories">
								<i class="fa fa-suitcase"></i><?php echo implode( ', ', $category_titles ); ?></div>
						<?php endif; ?>
						<?php if ( $candidate->get_address() ) : ?>
							<div class="address">
								<i class="fa fa-map-marker"></i><?php echo $candidate->get_address(); ?></div>
						<?php endif; ?>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php

		endwhile;
		wp_reset_postdata();
	endif;
	?>
	<div class="clear"></div>
</div>

<?php if ( $query->max_num_pages > 1 ): ?>
	<?php
	if ( ! isset( $paged ) ) :
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
	endif;
	?>

	<div class="w-pagination ajax-candidate-pagination"><?php iwj_ajax_pagination( $query->max_num_pages, $paged ); ?></div>

<?php endif; ?>


