<?php
$post      = get_post();
$user      = IWJ_User::get_user();
$candidate = IWJ_Candidate::get_candidate( $post );

if ( is_single() && $post && $post->post_type == 'iwj_candidate' ) {
	$show_candidate_public_profile = iwj_option( 'show_candidate_public_profile', '' );
	if ( ! $show_candidate_public_profile || ( is_user_logged_in() && ( $show_candidate_public_profile == 1 || ( $show_candidate_public_profile == 2 && $user->is_employer() ) ) ) ) {
		echo $args['before_widget'];
		if ( isset( $instance['title'] ) ) {
			$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
			$title = apply_filters( 'widget_title', $title, $instance, $widget_id );

			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
		}
		?>
		<div class="iwj-candicate-widget-wrap">
			<div class="iwj-widget-information iwj-single-widget">
				<p class="candidate-desc"><?php echo $candidate->get_description(); ?></p>
				<ul>
					<?php if ( $viewed = $candidate->get_views() ) { ?>
						<li>
							<i class="ion-ios-eye"></i>
							<span><?php echo sprintf( __( 'Viewed : %s', 'iwjob' ), $viewed ); ?></span>
						</li>
					<?php } ?>
					<?php if ( $age = $candidate->get_age() ) { ?>
						<li>
							<i class="ion-android-calendar"></i>
							<span><?php echo sprintf( __( 'Age : %s', 'iwjob' ), $age ); ?></span>
						</li>
					<?php } ?>
					<?php if ( $gender = $candidate->get_gender() ) {
						$gender_title = iwj_gender_titles( $gender );
						?>
						<li>
							<i class="ion-transgender"></i>
							<span><?php echo sprintf( __( 'Gender : %s', 'iwjob' ), $gender_title ); ?></span>
						</li>
					<?php } ?>
					<?php if ( $languages = $candidate->get_languages() ) {
						$language_titles = iwj_get_language_titles( $languages );
						?>
						<li>
							<i class="ion-android-pin"></i>
							<span><?php echo sprintf( _n( 'Language : %s', 'Languages : %s', count( $languages ), 'iwjob' ), implode( ', ', $language_titles ) ); ?></span>
						</li>
					<?php } ?>
					<?php if ( $levels = $candidate->get_levels() ) {
						$levels_links = $candidate->get_levels_links();
						?>
						<li>
							<i class="ion-levels"></i>
							<span><?php echo sprintf( _n( 'Level : %s', 'Levels : %s', count( $levels ), 'iwjob' ), $levels_links ); ?></span>
						</li>
					<?php } ?>
					<?php if ( $types = $candidate->get_types() ) {
						$types_links = $candidate->get_types_links();
						?>
						<li>
							<i class="ion-levels"></i>
							<span><?php echo sprintf( _n( 'Type : %s', 'Types : %s', count( $types ), 'iwjob' ), $types_links ); ?></span>
						</li>
					<?php } ?>
					<?php if ( $categories = $candidate->get_categories() ) {
						$categories_links = $candidate->get_categories_links();
						?>
						<li>
							<i class="ion-android-folder-open"></i>
							<span><?php echo sprintf( _n( 'Category : %s', 'Categories : %s', count( $categories ), 'iwjob' ), $categories_links ); ?></span>
						</li>
					<?php } ?>
					<?php if ( $skills = $candidate->get_skills() ) {
						$skills_links = $candidate->get_skills_links();
						?>
						<li>
							<i class="ion-android-bulb"></i>
							<span><?php echo sprintf( _n( 'Skill : %s', 'Skills : %s', count( $skills ), 'iwjob' ), $skills_links ); ?></span>
						</li>
					<?php } ?>
					<?php if ( $locations = $candidate->get_locations() ) {
						$location_links = $candidate->get_locations_links();
						?>
						<li>
							<i class="ion-android-pin"></i>
							<span><?php echo sprintf( __( 'Locations : %s', 'Location : %s', count( $locations ), 'iwjob' ), $location_links ); ?></span>
						</li>
					<?php } ?>

				</ul>
			</div>
		</div>

		<?php

		echo $args['after_widget'];
	}
}