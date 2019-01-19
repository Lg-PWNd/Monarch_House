<?php
/**
 * The Template for displaying all single posts
 * @package injob
 */

get_header();
$job = IWJ_Job::get_job(get_post());
$author = $job->get_author();
$get_more_details = $job->get_more_details();
$user = IWJ_User::get_user();
$job_sidebar = iwj_option('job_sidebar');
wp_enqueue_script('google-maps');
wp_enqueue_script('infobox');
?>
    <div class="contents-main iw-job-content iw-job-detail" id="contents-main">
    <div class="container">
            <div class="row">
                <div class="<?php echo esc_attr(inwave_get_classes('container', $job_sidebar)) ?>">
                <div class="job-detail">
                    <div class="job-detail-content">
						<div id="job-detail-content">
                        <div class="job-detail-info">
                            <ul>
                                <li class="address">
                                    <div class="content-inner">
                                        <div class="left">
                                            <i class="fa fa-map-marker"></i>
                                            <span class="title"><?php _e('Location:', 'iwjob'); ?></span>
                                        </div>
                                        <div class="content"><?php echo $job->get_locations_links(); ?></div>
                                    </div>
                                </li>
                                <li class="salary">
                                    <div class="content-inner">
                                        <div class="left">
                                            <i class="iwj-icon-money"></i>
                                            <span class="title"><?php _e('Salary:', 'iwjob'); ?></span>
                                        </div>
                                        <?php $postfix = $job->get_salary_postfix(); ?>
                                        <div class="content"><?php echo $job->get_salary(); echo $postfix ? _x(' / ', 'Salary Postsfix', 'iwjob').$postfix : ''; ?></div>
                                    </div>
                                </li>
                                <?php
                                $type = $job->get_type();
                                if($type){
                                ?>
                                <li class="job-type">
                                    <div class="content-inner">
                                        <div class="left">
                                            <i class="fa fa-suitcase"></i>
                                            <span class="title"><?php _e('Job type:', 'iwjob'); ?></span>
                                        </div>
                                        <div class="content">
                                            <?php echo $type->name; ?>
                                        </div>
                                    </div>
                                </li>
                                <?php } ?>
                                <li class="posted">
                                    <div class="content-inner">
                                        <div class="left">
                                            <i class="iwj-icon-calendar"></i>
                                            <span class="title"><?php _e('Posted:', 'iwjob'); ?></span>
                                        </div>
                                        <div class="content">
                                            <?php printf( _x( '%s ago', '%s = human-readable time difference', 'iwjob' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="category">
                                    <div class="content-inner">
                                        <div class="left">
                                            <i class="iwj-icon-info"></i>
                                            <span class="title"><?php _e('Category:', 'iwjob'); ?></span>
                                        </div>
                                        <div class="content">
                                            <?php
                                            $cat = $job->get_category();
                                            if($cat){
                                                echo $cat->name;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="year-exp">
                                    <div class="content-inner">
                                        <div class="left">
                                            <i class="fa fa-graduation-cap"></i>
                                            <span class="title"><?php _e('Deadline:', 'iwjob'); ?></span>
                                        </div>
                                        <div class="content">
                                            <?php
                                            $deadline = $job->get_deadline();
                                            if($deadline){
                                                echo date_i18n(get_option('date_format'), $deadline);
                                            }else{
                                                echo __('Open', 'iwjob');
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                $languages = $job->get_languages();
                                if($languages){
                                    $language_titles = iwj_get_language_titles($languages);
                                ?>
								<li class="job-languages">
									<div class="content-inner">
										<div class="left">
											<i class="fa fa-language"></i>
											<span class="title"><?php _e('Languages:', 'iwjob'); ?></span>
										</div>
										<div class="content">
				                            <?php echo implode(", ", $language_titles); ?>
										</div>
									</div>
								</li>
                                <?php } ?>

                                <?php
                                $genders = $job->get_genders();
                                if($genders){
                                $gender_titles = iwj_gender_titles($genders);
                                ?>
								<li class="job-gender">
									<div class="content-inner">
										<div class="left">
											<i class="ion-transgender"></i>
											<span class="title"><?php _e('Gender:', 'iwjob'); ?></span>
										</div>
										<div class="content">
											<?php echo implode(", ", $gender_titles); ?>
										</div>
									</div>
								</li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="job-detail-about">
                            <?php if ($description = $job->get_description(true)) : ?>
                                <div class="job-detail-desc item">
                                    <?php echo $description; ?>
                                </div>
                            <?php endif; ?>
                            <?php
                            $data_map_maker = IWJ_PLUGIN_URL.'/assets/images/map-marker-job.png';
                            $map_maker = iwj_option('iwj_map_maker');
                            if ($map_maker) {
                                $data_map_maker = esc_url( wp_get_attachment_url($map_maker[0]) );
                            }
                            $maps = $job->get_map();
                            $lat = $maps[0];
                            $lng = $maps[1];
                            $zoom = $maps[2];
                            ?>
                            <?php if ($lat && $lng) : ?>
                                <div class="location iwj-map item">
                                    <h4 class="title"><?php _e('location', 'iwjob'); ?></h4>
                                    <div id="job-detail-map" class="job-detail-map" data-lat="<?php echo esc_attr($lat); ?>" data-lng="<?php echo esc_attr($lng); ?>" data-zoom="<?php echo esc_attr($zoom); ?>" data-maker="<?php echo esc_attr($data_map_maker); ?>"
                                         data-address="<?php echo esc_attr($job->get_address()); ?>" style="height: 332px;">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
						</div>
                        <div class="action-button">
                            <div class="button">
                                <?php
                                $can_apply = $job->can_apply();
                                if($can_apply === 0){
                                    echo '<span class="job-expired">'.__('This job has expired.', 'iwjob').'</span>';
                                }elseif($user && !$user->can_apply()){
                                    echo '<span class="job-expired">'.__('The Employer not permission to apply job.', 'iwjob').'</span>';
                                }else{
                                	if($job->get_indeed_url()){ ?>
										<a href="<?php echo esc_url($job->get_indeed_url()); ?>" class="apply-job">
											<i class="ion-android-checkbox-outline"></i><?php echo esc_html__('Apply for job','iwjob'); ?></a>
	                                <?php
                                	}elseif($job->get_custom_apply_url()){ ?>
										<a href="<?php echo esc_url($job->get_custom_apply_url()); ?>" class="apply-job">
											<i class="ion-android-checkbox-outline"></i><?php echo esc_html__('Apply for job','iwjob'); ?></a>
										<?php
									}else{
		                                $applies = IWJ()->applies->applies();
		                                if($applies){
			                                foreach ($applies as $apply){
				                                if($apply->is_available()){
					                                $apply->apply_button($job);
				                                }
			                                }
		                                }
									}
                                } ?>

                                <?php if(!is_user_logged_in()){ ?>
                                    <a href="#" class="save-job iwj-save-job" data-toggle="modal" data-target="#iwj-login-popup"><i class="ion-heart"></i><?php echo __('Save job','iwjob'); ?></a>
                                <?php } elseif(current_user_can('apply_job')){
                                    $saved_job = $user && $user->is_saved_job(get_the_ID()) ? true : false;
                                    $save_text = $saved_job ? __('<i class="ion-heart"></i> Saved job','iwjob') : __('<i class="ion-heart"></i> Save job','iwjob');
                                    ?>
                                    <div class="iwj-button-loader">
                                        <a href="#" class="save-job iwj-save-job <?php echo $saved_job ? 'saved' : '';?>" data-id="<?php echo get_the_ID(); ?>"><?php echo $save_text; ?></a>
                                        <div class="iwj-respon-msg iwj-hide"></div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="post-social-share">
                            <h4 class="post-share-title"><?php echo esc_html__('Share:', 'iwjob'); ?></h4>
                            <div class="post-share-buttons-inner">
                                <?php
                                inwave_social_sharing(get_permalink(), Inwave_Helper::substrword(get_the_excerpt(), 10), get_the_title());
                                ?>
	                            <?php if ( iwj_option( 'show_print_job' ) ) { ?>
									<div class="iwj-print-job">
										<h4 class="post-share-title"><?php echo esc_html__('Print:', 'iwjob'); ?></h4>
										<a href="javascript:void(0);" class="iwj-button-print-job" data-title="<?php echo $job->get_title(); ?>" data-author="<?php echo $author->get_display_name(); ?>" data-author_avatar="<?php echo iwj_get_avatar_url($author->get_id()); ?>">
											<i class="fa fa-print"></i>
										</a>
									</div>
	                            <?php } ?>
                                <div class="clearfix"></div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <?php
                    $related_jobs = $job->get_related();
                    if($related_jobs){ ?>
                    <div class="job-related">
                        <div class="title theme-color"><?php echo __('Related job','iwjob') ;?></div>
                        <div class="iwj-jobs iwj-listing">
                            <?php
                            foreach ($related_jobs as $related_job){
                                $related_author = $related_job->get_author();
                                $is_featured = $related_job->is_featured();
                                $type = $related_job->get_type();
                                $permalink = $related_job->permalink();
                            ?>
                                <div class="job-item <?php echo $is_featured ? 'featured-item' : '' ?>">
                                    <?php if($related_author){ ?>
                                        <div class="job-image"><?php echo iwj_get_avatar( $related_author->get_id() ); ?></div>
                                    <?php } ?>
                                    <div class="job-info">
                                        <h3 class="job-title"><a href="<?php echo esc_url($permalink); ?>"><?php echo ($related_job->get_title()); ?></a></h3>
                                        <div class="info-company">
                                            <?php if ($related_author) : ?>
                                                <div class="company"><i class="fa fa-suitcase"></i>
                                                    <?php if($related_author->is_active_profile()){ ?>
                                                        <a href="<?php echo $related_author->permalink(); ?>"><?php echo $related_author->get_display_name(); ?></a>
                                                    <?php }else{
                                                        echo $related_author->get_display_name();
                                                    } ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($locations = $related_job->get_locations_links()) : ?>
                                                <div class="address"><i class="fa fa-map-marker"></i><?php echo $locations; ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if($is_featured) : ?>
                                            <span class="job-featured"><?php echo __('Featured', 'iwjob'); ?></span>
                                        <?php endif; ?>
                                        <div class="job-type <?php echo $type ? $type->slug : ''; ?>">
                                            <?php if($type) {
                                                $color = get_term_meta($type->term_id, IWJ_PREFIX.'color', true);
                                                ?>
                                                <a class="type-name" href="<?php echo get_term_link($type->term_id, 'iwj_type'); ?>" <?php echo $color ? 'data-color="'.$color.'" style="color: '.$color.'"' : ''; ?>><?php echo $type->name; ?></a>
                                            <?php } ?>
                                            <?php if(!is_user_logged_in()){ ?>
                                                <button class="save-job" data-toggle="modal" data-target="#iwj-login-popup"><i class="fa fa-heart"></i></button>
                                            <?php }else if(current_user_can('apply_job')) { ?>
                                                <a href="#" class="iwj-save-job <?php echo $user->is_saved_job($related_job->get_id()) ? 'saved' : ''; ?>" data-id="<?php echo $related_job->get_id(); ?>" data-in-list="true"><i class="fa fa-heart"></i></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                </div>
                <?php if ($job_sidebar && is_active_sidebar('sidebar-job')) : ?>
                    <div class="iw-job-detail-sidebar iwj-sidebar-sticky <?php echo esc_attr(inwave_get_classes('sidebar', $job_sidebar)) ?>">
                        <div class="widget-area" role="complementary">
                            <?php dynamic_sidebar('sidebar-job'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
        if($job->has_status('draft')){ ?>
            <div class="iwj-job-action-btn">
                <a class="edit-job iwj-btn-shadow iwj-btn-icon iwj-btn-danger" href="<?php echo $job->edit_draft_link(); ?>"><?php echo __('<i class="ion-ios-compose"></i> Edit', 'iwjob'); ?></a>
                <a class="publish-job iwj-btn-shadow iwj-btn-icon iwj-btn-primary" href="<?php echo $job->publish_draft_link(); ?>"><?php echo __('<i class="ion-android-send"></i> Publish', 'iwjob'); ?></a>
            </div>
        <?php } ?>
    </div>

<?php get_footer(); ?>