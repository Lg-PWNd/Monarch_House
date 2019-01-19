<?php
class IWJ_Admin_User{
    static $cache;

    static function init(){
        add_action( 'edit_user_profile', array( __CLASS__ , 'extra_profile_fields') );
        add_action( 'show_user_profile', array( __CLASS__, 'extra_profile_fields' ) );
        add_filter( 'manage_users_columns', array( __CLASS__ , 'users_columns'));
        add_filter( 'manage_users_custom_column', array( __CLASS__ , 'users_columns_content'), 10, 3 );
        add_filter('user_row_actions',  array( __CLASS__ , 'row_actions'), 10, 2);
        add_filter('wp_loaded',  array( __CLASS__ , 'verify_account'));
    }

    static function extra_profile_fields($user){
        ?>
        <h3><?php echo __('Job Information', 'iwjob'); ?></h3>

        <table class="form-table">
            <?php
                $field = array(
                    'name' => __('Avatar', 'iwjob'),
                    'id' => IWJ_PREFIX.'avatar',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1
                );

            $field = IWJMB_Field::call( 'normalize', $field );
            $meta = get_user_meta($user->ID, IWJ_PREFIX.'avatar', true);
            IWJMB_Field::input($field, $meta );
            ?>

            <?php
            if(user_can($user->ID, 'create_iwj_jobs')){
            ?>
            <tr>
                <th><label><?php echo __('Employer', 'iwjob'); ?></label></th>
                <td>
                    <?php
                    $employer = get_user_meta($user->ID, IWJ_PREFIX . 'employer_post', true);
                    if ($employer) {
                        $link = '<a href="'.get_edit_post_link($employer).'">'.__('here', 'iwjob').'</a>';
                        echo sprintf(__('Click %s to manager.', 'iwjob'), $link);
                        ?>
                    <?php } ?>
                </td>
            </tr>
            <?php }elseif(user_can($user->ID, 'apply_job')){ ?>
            <tr>
                <th><label><?php echo __('Candidate', 'iwjob'); ?></label></th>
                <td>
                    <?php
                    $candidate = get_user_meta($user->ID, IWJ_PREFIX . 'candidate_post', true);
                    if ($candidate) {
                        $link = '<a href="'.get_edit_post_link($candidate).'">'.__('here', 'iwjob').'</a>';
                        echo sprintf(__('Click %s to manager.', 'iwjob'), $link);
                    }
                    ?>
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php
    }

    static function users_columns( $column ) {
        $new_column = array();
        foreach ($column as $key => $title){
            $new_column[$key] = $title;
            if($key == 'role'){
                $new_column['iwj_profile'] = __('Profile', 'iwjob');
                if(iwj_option('verify_account')){
                    $new_column['iwj_verified'] = __('Verified', 'iwjob');
                }
            }
        }

        return $new_column;
    }

    static function users_columns_content( $val, $column_name, $user_id ) {
        switch ($column_name) {
            case 'iwj_profile' :
                $user = IWJ_User::get_user($user_id);
                $profile_id = 0;
                if($user->is_employer()){
                    $profile_id = $user->get_employer_id();
                }elseif($user->is_candidate()){
                    $profile_id = $user->get_candidate_id();
                }

                if($profile_id){
                    $val .= '<a href="'.get_permalink($profile_id).'" target="_blank">'.__('View', 'iwjob').'</a> | ';
                    $val .= '<a href="'.get_edit_post_link($profile_id).'" target="_blank">'.__('Edit', 'iwjob').'</a>';
                }
                break;
            case 'iwj_verified' :
                $user = IWJ_User::get_user($user_id);
                if($user->is_verified()){
                    $val = __('Yes', 'iwjob');
                }else{
                    $val = __('No', 'iwjob');
                }
                break;
            default:
        }

        return $val;
    }

    static function row_actions($actions, $user_object) {
        if(iwj_option('verify_account') && current_user_can('edit_users', $user_object->ID)){
            $user = IWJ_User::get_user($user_object->ID);
            if(!$user->is_verified()){
                $actions['verify_account'] = "<a class='iwj_verify_account' href='" . admin_url( "users.php?iwj_verify_account=$user_object->ID") . "'>" . __( 'Verify', 'iwjob' ) . "</a>";
            }
        }
        return $actions;
    }

    static function verify_account(){
        if(is_blog_admin() && isset($_GET['iwj_verify_account']) && $_GET['iwj_verify_account']){
            $user_id = $_GET['iwj_verify_account'];
            if(current_user_can('edit_users', $user_id)){
                delete_user_meta($user_id, IWJ_PREFIX.'verify_code');
            }

            wp_redirect(admin_url( "users.php"));
            exit;
        }
    }
}

IWJ_Admin_User::init();