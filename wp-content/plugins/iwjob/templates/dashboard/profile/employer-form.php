<?php

/*wp_enqueue_script('jquery-collapse');
wp_enqueue_script('jquery-collapse-storage');
wp_enqueue_script('jquery-cookie-collapse-storage');*/

$user = IWJ_User::get_user();
$employer = $user->get_employer(true);
?>

<div class="iwj-edit-employer-profile iwj-edit-profile-page">
    <?php if($employer && $employer->is_pending()){ ?>
        <div class="iwj-not-active">
            <?php echo iwj_get_alert(__('Your profile is currently awaiting approval.', 'iwjob'), 'info'); ?>
        </div>
    <?php } ?>

    <form method="post" action="" class="iwj-form-2 iwj-employer-form">

        <?php do_action('iwj_before_employer_form', $employer); ?>

        <div class="iwj-block">
            <div class="basic-area iwj-block-inner">
                <?php
                $post_id = $employer ? $employer->get_id() : 0;
                ?>

                <?php iwj_field_avatar(IWJ_PREFIX.'avatar', '', false, $post_id, null, '', ''); ?>

                <div class="row">
                    <div class="col-md-6">
                        <?php
                        //company name
                        $value = $employer ? $employer->get_title(true) : '';

                        iwj_field_text('company_name', __('Company Name *', 'iwjob'), true, $post_id, $value, '', '', __('Enter company name', 'iwjob'));

                        //headline
                        iwj_field_text(IWJ_PREFIX.'headline', __('Headline *', 'iwjob'), true, $post_id, null, '', '', __('Enter headline', 'iwjob'));

                        //webstie
                        iwj_field_url('website', __('Website', 'iwjob'), false, $post_id, $user->get_website(), '', '', __('Enter website', 'iwjob'));

                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        //email
                        iwj_field_email('email', __('Email *', 'iwjob'), true, $post_id, $user->get_email(), '', '', __('Enter your email', 'iwjob'));

                        //phone
                        iwj_field_text(IWJ_PREFIX.'phone', __('Phone *', 'iwjob'), true, $post_id, null, '', '', __('Enter phone number', 'iwjob'));

                        //Founded Date
                        iwj_field_text(IWJ_PREFIX.'founded_date', __('Founded Date *', 'iwjob'), true, $post_id, null, '', '', __('Enter Founded date', 'iwjob'));
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        iwj_field_taxonomy('iwj_size','size', __('Company Size *', 'iwjob'), true, $post_id, null, array(), '', __('Select Size', 'iwjob'));
                        ?>
                    </div>
                </div>

                <?php
                //Short Description
                $value = $employer ? $employer->get_short_description() : '';
                iwj_field_textarea('short_description', __('Short Description *', 'iwjob'), true, $post_id, $value);

                //Short Description
                $value = $employer ? $employer->get_description() : '';
                iwj_field_wysiwyg('description', __('Description', 'iwjob'), true, $post_id, $value,'', '','', array(
                    'quicktags' => false,
                    'editor_height' => 200
                ));
                ?>
            </div>

            <?php do_action('iwj_employer_form_after_general', $employer); ?>

            <div class="working-preferances-area iwj-block-inner">
                <h3 class=""><?php echo __('Working Preferences', 'iwjob'); ?></h3>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        iwj_field_taxonomy2('iwj_cat','categories', __('Categories *', 'iwjob'), true, $post_id, null, array(), '', __('Select Categories', 'iwjob'), true);
                        ?>
                    </div>
                </div>
            </div>

            <?php do_action('iwj_employer_form_after_preferences', $employer); ?>

            <div class="location-area iwj-block-inner">
                <h3 class=""><?php echo __('Location & Map', 'iwjob'); ?></h3>
                <?php
                if(!iwj_option('auto_detect_location')) {
                    iwj_field_select_tree('iwj_location', IWJ_PREFIX . 'location', __('Location *', 'iwjob'), true, $post_id);
                }
                iwj_field_text(IWJ_PREFIX.'address', __('Address *', 'iwjob'), true, $post_id);
                iwj_field_map(IWJ_PREFIX.'map', __('Map', 'iwjob'), $post_id, null, null, '', IWJ_PREFIX.'address');
                ?>
            </div>

            <?php do_action('iwj_employer_form_after_map', $employer); ?>

            <div class="video-area iwj-block-inner">
                <h3 class=""><?php echo __('Video URL', 'iwjob'); ?></h3>
                <div>
                    <?php
                    iwj_field_url(IWJ_PREFIX.'video', '', false, $post_id, null, '', '', __('Accept the youtube or vimeo url', 'iwjob'));
                    ?>
                </div>
            </div>

            <?php do_action('iwj_employer_form_after_video', $employer); ?>

            <div class="gallery-area iwj-block-inner">
                <h3 class=""><?php echo __('Gallery', 'iwjob'); ?></h3>
                <div>
                    <?php
                    iwj_field_gallery(IWJ_PREFIX.'gallery', '', false, $post_id);
                    ?>
                </div>
            </div>

            <?php do_action('iwj_employer_form_after_gallery', $employer); ?>

            <div class="socials-area iwj-block-inner">
                <h3 class=""><?php echo __('Company Social', 'iwjob'); ?></h3>
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            iwj_field_text(IWJ_PREFIX.'facebook', __('Facebook', 'iwjob'), false, $post_id);
                            iwj_field_text(IWJ_PREFIX.'google_plus', __('Google Plus', 'iwjob'), false, $post_id);
                            iwj_field_text(IWJ_PREFIX.'vimeo', __('Vimeo', 'iwjob'), false, $post_id);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            iwj_field_text(IWJ_PREFIX.'twitter', __('Twitter', 'iwjob'), false, $post_id);
                            iwj_field_text(IWJ_PREFIX.'youtube', __('Youtube', 'iwjob'), false, $post_id);
                            iwj_field_text(IWJ_PREFIX.'linkedin', __('Linkedin', 'iwjob'), false, $post_id);
                            ?>
                        </div>
                    </div>
                </div>

            </div>

            <?php do_action('iwj_employer_form_after_socials', $employer); ?>

            <?php do_action('iwj_after_employer_form', $employer); ?>

            <div class="iwj-button-loader-respon-msg clearfix">
                <div class="iwj-button-loader">
                    <button type="submit" class="iwj-btn iwj-btn-primary iwj-employer-btn"><?php echo __('Update Profile', 'iwjob');?></button>
                </div>
                <div class="iwj-respon-msg iwj-hide"></div>
            </div>
        </div>

    </form>

    <?php
    iwj_get_template_part('dashboard/profile/change-password');
    ?>
</div>