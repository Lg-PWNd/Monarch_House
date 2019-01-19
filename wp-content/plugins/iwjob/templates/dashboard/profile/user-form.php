<?php
$user = IWJ_User::get_user();
?>
<div class="iwj-edit-candidate-profile iwj-edit-profile-page">
    <form method="post" action="" class="iwj-form-2 iwj-user-form">

        <?php do_action('iwj_before_user_form', $user); ?>

        <div class="basic iwj-block">
            <?php iwj_field_avatar(IWJ_PREFIX.'avatar', '', false, 0, null, '', ''); ?>

            <?php
            //Your Name
            iwj_field_text('your_name', __('Your Name *', 'iwjob'), true, 0, $user->get_display_name(), '', '', __('Enter your name', 'iwjob'));

            //email
            iwj_field_email('email', __('Email *', 'iwjob'), true, 0, $user->get_email(), '', '', __('Enter your email', 'iwjob'));

            iwj_field_textarea('description', __('Description', 'iwjob'), false, 0, $user->get_description());

            //website url
            iwj_field_url('website', __('Website', 'iwjob'), false, 0, $user->get_website(), '', '', __('Enter your website', 'iwjob'));
            ?>

            <div class="iwj-respon-msg iwj-hide"></div>
            <div class="iwj-button-loader">
                <button type="submit" class="iwj-btn iwj-btn-primary iwj-user-btn"><?php echo __('Update Profile', 'iwjob');?></button>
            </div>
        </div>

        <?php
        do_action('iwj_after_user_form', $user);
        ?>
    </form>

    <?php
    iwj_get_template_part('dashboard/profile/change-password');
    ?>
</div>