<div class="iwj-register">
    <?php if(!is_user_logged_in()) {
        $disable_candidate_register = iwj_option('disable_candidate_register');
        $disable_employer_register = iwj_option('disable_employer_register');
        if(!$disable_candidate_register || !$disable_employer_register){
        ?>
        <form action="<?php echo esc_url(get_permalink()); ?>" method="post" class="iwj-form iwj-register-form">
            <?php if(!$disable_candidate_register && !$disable_employer_register){ ?>

            <div class="iwj-magic-line-wrap">
                <div class="iwj-magic-line">
                    <p class="<?php echo isset($_GET['role']) || ( isset($_GET['role']) && 'employer' == $_GET['role'])?'':'active'; ?> iwj-toggle iwj-candidate-toggle"><?php echo __('Candidate', 'iwjob'); ?></p>
                    <p class="<?php echo isset($_GET['role']) && 'employer' == $_GET['role']?'active':''; ?> iwj-toggle iwj-employer-toggle"><?php echo __('Employer', 'iwjob'); ?></p>
                </div>
            </div>
            <?php } ?>
            <div class="iwj-field">
                <label><?php echo __('User name', 'iwjob'); ?></label>
                <div class="iwj-input">
                    <i class="fa fa-user"></i>
                    <input type="text" name="username" placeholder="<?php echo __('Enter Your Username.', 'iwjob'); ?>">
                </div>
            </div>
            <div class="iwj-field">
                <label><?php echo __('Email', 'iwjob'); ?></label>
                <div class="iwj-input">
                    <i class="fa fa-envelope-o"></i>
                    <input type="email" name="email" placeholder="<?php echo __('Enter Your Email Address.', 'iwjob'); ?>">
                </div>
            </div>
            <?php if(!$disable_employer_register){
                $class = $disable_candidate_register || (isset($_GET['role']) && 'employer' == isset($_GET['role']))? '' : 'hide';
            ?>
            <div class="iwj-field <?php echo $class; ?> company-field">
                <label><?php echo __('Company Name', 'iwjob'); ?></label>
                <div class="iwj-input">
                    <i class="fa fa-vcard-o"></i>
                    <input type="text" name="company" placeholder="<?php echo __('Enter Company Name.', 'iwjob'); ?>">
                </div>
            </div>
            <?php } ?>
            <?php if(!iwj_option('registration_generate_password')){ ?>
                <div class="iwj-field">
                    <label><?php echo __('Password', 'iwjob'); ?></label>
                    <div class="iwj-input">
                        <i class="fa fa-keyboard-o"></i>
                        <input type="password" name="password" placeholder="<?php echo __('Enter Your Password.', 'iwjob'); ?>" required>
                    </div>
                </div>
            <?php } ?>
            <div class="iwj-respon-msg iwj-hide"></div>
            <div class="iwj-button-loader">
                <?php $role = !$disable_candidate_register ? 'candidate' : 'employer'; ?>
                <input type="hidden" name="role" value="<?php echo $role; ?>">
                <?php
                if(in_array('register', iwj_option('use_recaptcha', array()))) {
                    echo '<div class="g-recaptcha" data-sitekey="'.iwj_option('google_recaptcha_site_key').'"></div>';
                }
                ?>
                <button type="submit" name="register" class="iwj-btn iwj-btn-primary iwj-btn-full iwj-btn-large iwj-register-btn"><?php echo __('Register', 'iwjob'); ?></button>
            </div>
            <?php if(iwj_option('terms_and_conditions_page') || iwj_option('privacy_policy_page')) { ?>
                <div class="register-account text-center">
                    <?php
                    echo __('By hitting the <span class="theme-color">"Register"</span> button, you agree to the ', 'iwjob');
                    $terms_and_conditions_url = iwj_option('terms_and_conditions_page') ? get_the_permalink(iwj_option('terms_and_conditions_page')) : '';
                    $privacy_policy_url = iwj_option('privacy_policy_page') ? get_the_permalink(iwj_option('privacy_policy_page')) : '';
                    if($terms_and_conditions_url && $privacy_policy_url){
                       echo sprintf(__('<a target="_blank" href="%s">Terms conditions</a> and <a target="_blank" href="%s">Privacy Policy</a>','iwjob'), $terms_and_conditions_url, $privacy_policy_url);
                    }elseif($terms_and_conditions_url){
                        echo sprintf(__('<a target="_blank" href="%s">Terms conditions</a>','iwjob'), $terms_and_conditions_url);
                    }else{
                        echo sprintf(__('<a target="_blank" href="%s">Privacy Policy</a>','iwjob'), $privacy_policy_url);
                    }
                    ?>
                </div>
            <?php } ?>
            <input type="hidden" name="redirect_to" value="<?php echo $redirect_to; ?>">
        </form>
        <?php }else{
            echo __('Sorry, the registration function is temporarily unavailable, please come back later', 'iwjob');
        }?>
    <?php }else{
        $user = IWJ_User::get_user();
        ?>
        <div class="logged-in">
            <p><?php echo sprintf(__('You are logged in as <strong>%s</strong>', 'iwjob'), $user->get_display_name()); ?></p>
            <p><?php echo sprintf(__('Click <a href="%s">here</a> to go to Dashboard Manager', 'iwjob'), iwj_get_page_permalink('dashboard')); ?></p>
        </div>
    <?php } ?>
</div>
