<?php
$post     = get_post();
$employer = IWJ_Employer::get_employer( $post );
$author   = $employer->get_author();
if ( is_single() && $post && $post->post_type == 'iwj_employer' ) {
	$show_employer_public_profile = iwj_option( 'show_employer_public_profile', '' );
	if ( ! $show_employer_public_profile || ( $show_employer_public_profile && is_user_logged_in() ) ) {
		echo $args['before_widget'];

		if ( isset( $instance['title'] ) ) {
			$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
			$title = apply_filters( 'widget_title', $title, $instance, $widget_id );

			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
		}
		?>

		<div class="iwj-employer-widget-wrap">
			<div class="iwj-widget-information iwj-single-widget">
				<p class="employer-desc"><?php echo $employer->get_short_description(); ?></p>
				<ul>
					<?php if ( $viewed = $employer->get_views() ) { ?>
						<li>
							<i class="ion-ios-eye"></i>
							<span><?php echo sprintf( __( 'Viewed : %s', 'iwjob' ), $viewed ); ?></span>
						</li>
					<?php } ?>
					<?php if ( $posted_jobs = $author->count_jobs( false, true ) ) { ?>
						<li>
							<i class="ion-android-checkbox-outline"></i>
							<span><?php echo sprintf( __( 'Posted Jobs : %s', 'iwjob' ), $posted_jobs ); ?></span>
						</li>
					<?php } ?>
					<?php if ( $location_links = $employer->get_locations_links() ) { ?>
						<li>
							<i class="ion-android-pin"></i>
							<span><?php echo sprintf( __( 'Locations : %s', 'iwjob' ), $location_links ); ?></span>
						</li>
					<?php } ?>
					<?php if ( $categories_links = $employer->get_categories_links() ) { ?>
						<li>
							<i class="ion-android-folder-open"></i>
							<span><?php echo sprintf( __( 'Categories : %s', 'iwjob' ), $categories_links ); ?></span>
						</li>
					<?php } ?>
					<?php if ( $size = $employer->get_size() ) { ?>
						<li>
							<i class="ion-android-contacts"></i>
							<span><?php echo sprintf( __( 'Company Size : %s', 'iwjob' ), $size ); ?></span>
						</li>
					<?php } ?>
					<?php if ( $followers = $author->count_followers() ) { ?>
						<li>
							<i class="ion-android-star"></i>
							<span><?php echo sprintf( __( 'Followers : %s', 'iwjob' ), $followers ); ?></span>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>

		<?php
		echo $args['after_widget'];
	}
}