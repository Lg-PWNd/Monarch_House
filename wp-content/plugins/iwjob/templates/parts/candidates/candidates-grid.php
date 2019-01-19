<?php
$mode_view_class               = 'iwj-grid';
$show_candidate_public_profile = iwj_option( 'show_candidate_public_profile', '' );
$login_page_id                = get_permalink( iwj_option( 'login_page_id' ) );?>

	<div class="iwj-candidates <?php echo $mode_view_class; ?>">
		<?php
		if ( $query->have_posts() ) :
			$user = IWJ_User::get_user();
			while ( $query->have_posts() ) :
				$query->the_post();
				$candidate = IWJ_Candidate::get_candidate( get_the_ID() );
				$image     = iwj_get_avatar( $candidate->get_author_id() );
				$desc      = $candidate->get_description(); ?>
				<div class="grid-content">
					<div class="candidate-item">
						<div class="candidate-bg-image"><?php echo( $image ); ?></div>
						<div class="candidate-info">
							<div class="info-top">
								<div class="candidate-image"><?php echo( $image ); ?></div>
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
								<?php if ( $candidate->get_headline() ) : ?>
									<div class="headline"><?php echo $candidate->get_headline(); ?></div>
								<?php endif; ?>
							</div>
							<div class="info-bottom">
								<?php
								if ( iwj_option( 'view_free_resum' ) || ( $user && $user->can_view_resum( $candidate->get_id() ) ) ) { ?>
									<div class="social-link">
										<ul>
											<?php
											foreach ( $candidate->get_social_media() as $key => $value ) {
												if ( $value != null && $value != '' ) {
													if ( $key == "google_plus" ) {
														echo '<li><a class="google-plus" href="' . $value . '" title="' . $key . '"><i class="ion-social-googleplus"></i></a></li>';
													} else {
														echo '<li><a class="' . $key . '" href="' . $value . '" title="' . $key . '"><i class="ion-social-' . $key . '"></i></a></li>';
													}
												}
											}
											?>
										</ul>
									</div>
								<?php } ?>
								<?php if ( $desc ) : ?>
									<div class="candidate-desc"><?php echo esc_attr( wp_trim_words( $desc, 15 ) ); ?></div>
								<?php endif; ?>
								<a class="view-resume" href="<?php echo $link_profile; ?>"><?php echo __( "View Resume", 'iwjob' ); ?></a>
							</div>
						</div>
					</div>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
		endif;
		?>
	</div>


<?php if ( $query->max_num_pages > 1 ): ?>
	<?php
	if ( ! isset( $paged ) ) :
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
	endif;
	?>
	<div class="clearfix"></div>
	<div class="w-pagination ajax-candidate-pagination"><?php iwj_ajax_pagination( $query->max_num_pages, $paged ); ?></div>
<?php endif; ?>