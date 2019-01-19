<?php
class IWJ_Admin_Setting{
    static $fields = array();

    static function init(){
        add_filter( 'iwj_plugin_settings', array(__CLASS__, 'general_settings'), 10, 1 );
        add_filter( 'iwj_plugin_settings', array(__CLASS__, 'job_settings'), 10, 1 );
        add_filter( 'iwj_plugin_settings', array(__CLASS__, 'display_settings'), 10, 1 );
        add_filter( 'iwj_plugin_settings', array(__CLASS__, 'price_settings'), 10, 1 );
        add_filter( 'iwj_plugin_settings', array(__CLASS__, 'email_settings'), 10, 1 );
        add_filter( 'iwj_plugin_settings', array(__CLASS__, 'apply_settings'), 10, 1 );
        add_filter( 'iwj_plugin_settings', array(__CLASS__, 'social_login_settings'), 10, 1 );
        add_filter( 'iwj_plugin_settings', array(__CLASS__, 'payment_gateway_settings'), 10, 1 );
    }

    static function general_settings($def){

        $settings = array(
            'general' => array(
                'name'    => __( 'General', 'iwjob' ),
                'options' => array(
                    array(
                        'name' => __( 'Page Settings', 'iwjob' ),
                        'options' => array(
                            array(
                                'name' => __( 'Login Page', 'iwjob' ),
                                'id'   => 'login_page_id',
                                'type' => 'post',
                                'post_type' => 'page',
                            ),
                            array(
                                'name' => __( 'Register Page', 'iwjob' ),
                                'id'   => 'register_page_id',
                                'type' => 'post',
                                'post_type' => 'page',
                            ),
                            array(
                                'name' => __( 'Verify Account Page', 'iwjob' ),
                                'id'   => 'verify_account_page_id',
                                'type' => 'post',
                                'post_type' => 'page',
                            ),
                            array(
                                'name' => __( 'Lost Password Page', 'iwjob' ),
                                'id'   => 'lostpass_page_id',
                                'type' => 'post',
                                'post_type' => 'page',
                            ),
                            array(
                                'name' => __( 'Dashboard Page', 'iwjob' ),
                                'id'   => 'dashboard_page_id',
                                'type' => 'post',
                                'post_type' => 'page',
                            ),
                            array(
                                'name' => __( 'Jobs Page', 'iwjob' ),
                                'id'   => 'jobs_page_id',
                                'type' => 'post',
                                'post_type' => 'page',
                            ),
                            array(
                                'name' => __( 'Employers Page', 'iwjob' ),
                                'id'   => 'employers_page_id',
                                'type' => 'post',
                                'post_type' => 'page',
                            ),
                            array(
                                'name' => __( 'Candidates Page', 'iwjob' ),
                                'id'   => 'candidates_page_id',
                                'type' => 'post',
                                'post_type' => 'page',
                            ),
                            array(
                                'name'      => __( 'Job Suggestion Page', 'iwjob' ),
                                'id'        => 'suggest_job_page_id',
                                'type'      => 'post',
                                'post_type' => 'page',
                            ),
                            array(
                                'name'      => __( 'Candidate Suggestion Page', 'iwjob' ),
                                'id'        => 'candidate_suggestion_page_id',
                                'type'      => 'post',
                                'post_type' => 'page',
                            ),
                            array(
                                'name' => __( 'Terms and conditions Page', 'iwjob' ),
                                'id'   => 'terms_and_conditions_page',
                                'type' => 'post',
                                'post_type' => 'page',
                            ),
                            array(
                                'name' => __( 'Privacy Policy Page', 'iwjob' ),
                                'id'   => 'privacy_policy_page',
                                'type' => 'post',
                                'post_type' => 'page',
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Slug Settings', 'iwjob' ),
                        'options' => array(
                            array(
                                'name' => __( 'Job Slug', 'iwjob' ),
                                'id'   => 'job_slug',
                                'type' => 'text',
                                'std' => 'job',
                            ),
                            array(
                                'name' => __( 'Employer Slug', 'iwjob' ),
                                'id'   => 'employer_slug',
                                'type' => 'text',
                                'std' => 'employer',
                            ),
                            array(
                                'name' => __( 'Candidate Slug', 'iwjob' ),
                                'id'   => 'candidate_slug',
                                'type' => 'text',
                                'std' => 'candidate',
                            ),
                            array(
                                'name' => __( 'Category Slug', 'iwjob' ),
                                'id'   => 'category_slug',
                                'type' => 'text',
                                'std' => 'cat',
                            ),
                            array(
                                'name' => __( 'Type Slug', 'iwjob' ),
                                'id'   => 'type_slug',
                                'type' => 'text',
                                'std' => 'type',
                            ),
                            array(
                                'name' => __( 'Sallary Slug', 'iwjob' ),
                                'id'   => 'sallary_slug',
                                'type' => 'text',
                                'std' => 'sallary',
                            ),
                            array(
                                'name' => __( 'Skill Slug', 'iwjob' ),
                                'id'   => 'skill_slug',
                                'type' => 'text',
                                'std' => 'skill',
                            ),
                            array(
                                'name' => __( 'Level Slug', 'iwjob' ),
                                'id'   => 'level_slug',
                                'type' => 'text',
                                'std' => 'level',
                            ),
                            array(
                                'name' => __( 'Location Slug', 'iwjob' ),
                                'id'   => 'location_slug',
                                'type' => 'text',
                                'std' => 'location',
                            ),
                        )
                    ),
                ),
            ),
        );

        $settings = apply_filters('iwj_setting_general_fields', $settings);

        return array_merge( $def, $settings );
    }

    static function job_settings($def){

        $settings = array(
            'job-settings' => array(
                'name'    => __( 'Settings', 'iwjob' ),
                'options' => array(
                    array(
                        'name' => __( 'General Settings', 'iwjob' ),
                        'options' => array(
                            array(
                                'name' => __( 'Disable Employer Registration', 'iwjob' ),
                                'id'   => 'disable_employer_register',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Disable Candidate Registration', 'iwjob' ),
                                'id'   => 'disable_candidate_register',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Verify Account?', 'iwjob' ),
                                'id'   => 'verify_account',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Automatically generated password?', 'iwjob' ),
                                'id'   => 'registration_generate_password',
                                'type' => 'select',
                                'std' => '1',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Use Woocommerce Checkout?', 'iwjob' ),
                                'desc' => '<div><a class="iwj-create-all-job-products" href="#">Create All Job Products</a><div><small>Normally the product will be created by the user. But you can create products manually if it does not already exist. This will help you to easily manage and change product parameters such as price, thumbnail ...</small></div></div><div class="iwj-all-job-products">'.IWJ_Woocommerce::get_products_list().'</div>',
                                'id'   => 'woocommerce_checkout',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Include the my account page of the woocommerce into the dashboard?', 'iwjob' ),
                                'desc' => __( 'Including orders and downloads', 'iwjob' ),
                                'id'   => 'include_my_account_woocommerce',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
	                        array(
		                        'name' => __( 'Disable Notification', 'iwjob' ),
		                        'id'   => 'disable_notification',
		                        'type' => 'checkbox-list',
		                        'options' => array(
			                        'candidate' => __('Candidate', 'iwjob'),
			                        'employer' => __('Employer', 'iwjob'),
			                        'guest' => __('Guest', 'iwjob'),
		                        ),
	                        ),
	                        array(
		                        'name' => __( 'Display Date Format', 'iwjob' ),
		                        'desc' => __( 'Click <a href="http://php.net/manual/en/function.date.php" target="_blank">here</a> to see all format', 'iwjob' ),
		                        'id'   => 'display_date_format',
		                        'type' => 'text',
		                        'std' => 'Y/m/d',
	                        ),
                        )
                    ),
                    array(
                        'name' => __( 'Job Settings', 'iwjob' ),
                        'options' => array(
                            array(
                                'name' => __( 'Disable Type', 'iwjob' ),
                                'id'   => 'disable_type',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Disable Skill', 'iwjob' ),
                                'id'   => 'disable_skill',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Disable Level', 'iwjob' ),
                                'id'   => 'disable_level',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
	                        array(
		                        'name' => __( 'Disable Job Gender', 'iwjob' ),
		                        'id'   => 'disable_gender',
		                        'type' => 'select',
		                        'std' => '',
		                        'options' => array(
			                        '1' => __('Yes', 'iwjob'),
			                        '' => __('No', 'iwjob'),
		                        ),
	                        ),
                            array(
                                'name' => __( 'Submit Job Mode', 'iwjob' ),
                                'id'   => 'submit_job_mode',
                                'type' => 'select',
                                'std' => '1',
                                'options' => array(
                                    '' => __('Free', 'iwjob'),
                                    '1' => __('Use Package', 'iwjob'),
                                    '2' => __('Single Price', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Edit Job Auto Appoved ?', 'iwjob' ),
                                'id'   => 'edit_job_auto_approved',
                                'type' => 'select',
                                'std' => '1',
                                'options' => array(
                                    '' => __('No', 'iwjob'),
                                    '1' => __('Yes', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Edit Free Job Auto Appoved ?', 'iwjob' ),
                                'id'   => 'edit_free_job_auto_approved',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '' => __('No', 'iwjob'),
                                    '1' => __('Yes', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'New Job Auto Appoved ?', 'iwjob' ),
                                'id'   => 'new_job_auto_approved',
                                'type' => 'select',
                                'std' => '1',
                                'options' => array(
                                    '' => __('No', 'iwjob'),
                                    '1' => __('Yes', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'New Free Job Auto Appoved ?', 'iwjob' ),
                                'id'   => 'new_free_job_auto_approved',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '' => __('No', 'iwjob'),
                                    '1' => __('Yes', 'iwjob'),
                                ),
                            ),

                            array(
                                'name' => __( 'Time to keep draft jobs (in hours)', 'iwjob' ),
                                'desc' => __( 'Leave blank if you do not want to automatically delete', 'iwjob' ),
                                'id'   => 'delete_draft_job_hours',
                                'type' => 'text',
                                'std' => '24',
                            ),
                            array(
                                'name' => __( 'Keep Jobs When Delete User', 'iwjob' ),
                                'id'   => 'keep_jobs_delete_user',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '' => __('No', 'iwjob'),
                                    '1' => __('Keep Jobs', 'iwjob'),
                                    '2' => __('Keep Jobs & Applications', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Move Jobs from Deleting User To User ID', 'iwjob' ),
                                'desc' => __( 'If is blank jobs will be moved to admin', 'iwjob' ),
                                'id'   => 'keep_jobs_user_id',
                                'type' => 'text',
                                'std' => '',
                            ),
                            array(
                                'name' => __( 'Automatic detect location from google map address', 'iwjob' ),
                                'id'   => 'auto_detect_location',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '' => __('No', 'iwjob'),
                                    '1' => __('Yes', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Allow Address Types', 'iwjob' ),
                                'desc' => __( 'Google address types which will be use add to location. see more <a href="https://developers.google.com/maps/documentation/geocoding/intro">here</a>', 'iwjob' ),
                                'id'   => 'allow_adress_types',
                                'type' => 'select',
                                'multiple' => true,
                                'std' => array('country', 'administrative_area_level_1', 'administrative_area_level_2'),
                                'options' => array(
                                    'country' => __('country', 'iwjob'),
                                    'administrative_area_level_1' => __('administrative_area_level_1', 'iwjob'),
                                    'administrative_area_level_2' => __('administrative_area_level_2', 'iwjob'),
                                    'administrative_area_level_3' => __('administrative_area_level_3', 'iwjob'),
                                    'administrative_area_level_4' => __('administrative_area_level_4', 'iwjob'),
                                    'administrative_area_level_5' => __('administrative_area_level_5', 'iwjob'),
                                    'sublocality_level_1' => __('sublocality_level_1', 'iwjob'),
                                    'sublocality_level_2' => __('sublocality_level_2', 'iwjob'),
                                    'sublocality_level_3' => __('sublocality_level_3', 'iwjob'),
                                    'sublocality_level_4' => __('sublocality_level_4', 'iwjob'),
                                    'sublocality_level_5' => __('sublocality_level_5', 'iwjob'),
                                    'neighborhood' => __('neighborhood', 'iwjob'),
                                ),
                            ),
	                        array(
		                        'name' => __( 'Disable Job Languages', 'iwjob' ),
		                        'id'   => 'disable_language',
		                        'type' => 'select',
		                        'std' => '',
		                        'options' => array(
			                        '1' => __('Yes', 'iwjob'),
			                        '' => __('No', 'iwjob'),
		                        ),
	                        ),
	                        array(
		                        'name'     => __( 'Allow Languages', 'iwjob' ),
		                        'id'       => 'allow_languages',
		                        'type'     => 'select_advanced',
		                        'multiple' => true,
		                        'options'  => iwj_languages(),
	                        ),
	                        array(
		                        'id'   => 'exclude_skills',
		                        'name' => esc_html__( 'Exclude Skills', 'iwjob' ),
		                        'type' => 'textarea',
		                        'desc' => esc_html__( 'Enter your exclude skills (Each skill separated by comma, Ex: sex,xxx,...)', 'iwjob' )
	                        ),
                            array(
                                'name' => __( 'Job Suggestion Conditions', 'iwjob' ),
                                'desc' => __( 'Select the conditions to select the jobs', 'iwjob' ),
                                'id'   => 'job_suggestion_conditions',
                                'type' => 'select_advanced',
                                'multiple' => true,
                                'std' => array('category', 'type', 'level', 'skill'),
                                'options' => array(
                                    'category' => __('Category', 'iwjob'),
                                    'type' => __('Type', 'iwjob'),
                                    'level' => __('Level', 'iwjob'),
                                    'skill' => __('Skill', 'iwjob'),
                                    'location' => __('Location', 'iwjob'),
                                    'language' => __('Language', 'iwjob'),
                                    'gender' => __('Gender', 'iwjob'),
                                ),
                            ),
                            array(
                                'id' 			=> 'default_job_content',
                                'name'			=> __( 'Default job content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                /*'options'       => array(
                                    'quicktags' => false,
                                    'editor_height' => 250,
                                    'media_buttons' => false
                                ),*/
                                'std'		=> '<h4>Overview</h4>
            <blockquote>Lorem ipsum dolor sit amet consectetur adipiscing, elit vehicula semper velit vestibulum felis purus, gravida rhoncus vulputate aliquet cras. Conubia libero morbi tristique rutrum elementum dapibus per cras volutpat, semper consequat nisl aenean urna ultricies tincidunt etiam senectus. Rhoncus blandit neque vivamus nullam sodales maecenas felis faucibus, lectus suspendisse vitae donec hendrerit montes ultrices fames, penatibus est pulvinar sagittis proin phareultrices fringilla.</blockquote>

            <hr />

            <h4>What You Will Do</h4>
            <ol>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                <li>Auctor class pellentesque augue dignissim venenatis, turpis vestibulum lacinia dignissim venenatis.</li>
                <li>Mus arcu euismod ad hac dui, vivamus platea netus.</li>
                <li>Neque per nisl posuere sagittis, id platea dui.</li>
                <li>A enim magnis dapibus, nullam odio porta, nisl class.</li>
                <li>Turpis leo pellentesque per nam, nostra fringilla id.</li>
            </ol>

            <hr />

            <h4>What we can offer you</h4>
            <ul>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                <li>Mus arcu euismod ad hac dui, vivamus platea netus.</li>
                <li>Neque per nisl posuere sagittis, id platea dui.</li>
                <li>A enim magnis dapibus, nullam odio porta, nisl class.</li>
                <li>Turpis leo pellentesque per nam, nostra fringilla id.</li>
            </ul>',
                            ),
	                        array(
		                        'name' => __( 'Allow Input Custom Apply URL', 'iwjob' ),
		                        'id'   => 'custom_apply_url',
		                        'type' => 'select',
		                        'std' => '',
		                        'options' => array(
			                        '1' => __('Yes', 'iwjob'),
			                        '' => __('No', 'iwjob'),
		                        ),
	                        ),
                        ),
                    ),
                    array(
                        'name' => __( 'Job Price Settings', 'iwjob' ),
                        'options' => array(
                            'job_price' => array(
                                'name' => __( 'Job Price', 'iwjob' ),
                                'desc' => __( 'Job Price for Single Price Mode', 'iwjob' ),
                                'id'   => 'job_price',
                                'type' => 'text',
                                'std' => '5',
                            ),
                            'renew_job_price' => array(
                                'name' => __( 'Renew Job Price', 'iwjob' ),
                                'id'   => 'renew_job_price',
                                'type' => 'text',
                                'std' => '5',
                            ),
                            'job_expiry' => array(
                                'name' => __( 'Job exprity', 'iwjob' ),
                                'id'   => 'job_expiry',
                                'type' => 'text',
                                'std' => '1',
                            ),
                            'job_expiry_unit' => array(
                                'name' => __( 'Job exprity Unit', 'iwjob' ),
                                'id'   => 'job_expiry_unit',
                                'type' => 'select',
                                'std' => 'year',
                                'options' => array(
                                    'day' => __('Days', 'iwjob'),
                                    'month' => __('Months', 'iwjob'),
                                    'year' => __('Years', 'iwjob'),
                                ),
                            ),
                            /*'max_category' => array(
                                'name' => __( 'Maximum categories in Job', 'iwjob' ),
                                'id'   => 'max_category',
                                'type' => 'text',
                            ),*/
                        )
                    ),
                    array(
                        'name' => __( 'Feature Job Price Settings', 'iwjob' ),
                        'options' => array(
                            'featured_job_price' => array(
                                'name' => __( 'Featured Job Price', 'iwjob' ),
                                'id'   => 'featured_job_price',
                                'type' => 'text',
                                'std' => '5',
                            ),
                            'featured_job_expiry' => array(
                                'name' => __( 'Featured Job exprity', 'iwjob' ),
                                'id'   => 'featured_job_expiry',
                                'type' => 'text',
                                'std' => '1',
                            ),
                            'featured_job_expiry_unit' => array(
                                'name' => __( 'Featured Job exprity Unit', 'iwjob' ),
                                'id'   => 'featured_job_expiry_unit',
                                'type' => 'select',
                                'std' => 'year',
                                'options' => array(
                                    'day' => __('Days', 'iwjob'),
                                    'month' => __('Months', 'iwjob'),
                                    'year' => __('Years', 'iwjob'),
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Job Package Settings', 'iwjob' ),
                        'options' => array(
                            array(
                                'name' => __( 'Package Featured', 'iwjob' ),
                                'id'   => 'package_featured_id',
                                'type' => 'post',
                                'post_type' => 'iwj_package',
                                'js_options' => array(
                                    'allowClear' => true,
                                )
                            ),
                            array(
                                'name' => __( 'Free Job Package', 'iwjob' ),
                                'id'   => 'free_package_id',
                                'type' => 'post',
                                'post_type' => 'iwj_package',
                                'js_options' => array(
                                    'allowClear' => true,
                                )
                            ),
                            array(
                                'name' => __( 'Number of free packages', 'iwjob' ),
                                'desc' => __( 'The number of free packages that each user is using', 'iwjob' ),
                                'id'   => 'free_package_times',
                                'type' => 'text',
                                'std' => '1',
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Employer Settings', 'iwjob' ),
                        'options' => array(
                            array(
                                'name' => __( 'Employer Profile Auto Approved ?', 'iwjob' ),
                                'id'   => 'employer_auto_approved',
                                'type' => 'select',
                                'std' => '1',
                                'options' => array(
                                    '' => __('No', 'iwjob'),
                                    '1' => __('Yes', 'iwjob'),
                                ),
                            ),
	                        array(
		                        'name'    => __( 'Who can see employer', 'iwjob' ),
		                        'id'      => 'show_employer_public_profile',
		                        'type'    => 'select',
		                        'std'     => '',
		                        'options' => array(
			                        ''  => __( 'Anyone', 'iwjob' ),
			                        '1' => __( 'Only Users Registered', 'iwjob' ),
		                        ),
	                        ),
	                        array(
		                        'name'    => __( 'Delete Application', 'iwjob' ),
		                        'id'      => 'employer_can_delete_application',
		                        'type'    => 'select',
		                        'std'     => '',
		                        'options' => array(
			                        ''  => __( 'No', 'iwjob' ),
			                        '1' => __( 'Yes', 'iwjob' ),
		                        ),
	                        ),
                        )
                    ),
                    array(
                        'name' => __( 'Candidate Settings', 'iwjob' ),
                        'options' => array(
                            array(
                                'name' => __( 'Candidate Profile Auto Approved ?', 'iwjob' ),
                                'id'   => 'candidate_auto_approved',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '' => __('No', 'iwjob'),
                                    '1' => __('Yes', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'View Resume Mode', 'iwjob' ),
                                'id'   => 'view_free_resum',
                                'type' => 'select',
                                'std' => '1',
                                'options' => array(
                                    '' => __('Use Package', 'iwjob'),
                                    '1' => __('View Free', 'iwjob'),
                                ),
                            ),
                            /*array(
                                'name' => __( 'Resume Package Featured', 'iwjob' ),
                                'id'   => 'resum_package_featured_id',
                                'type' => 'post',
                                'post_type' => 'iwj_resum_package',
                                'js_options' => array(
                                    'allowClear' => true,
                                )
                            ),*/
                            array(
                                'name' => __( 'Free Resume Package', 'iwjob' ),
                                'id'   => 'free_resum_package_id',
                                'type' => 'post',
                                'post_type' => 'iwj_resum_package',
                                'js_options' => array(
                                    'allowClear' => true,
                                )
                            ),
                            array(
                                'name' => __( 'Number of free resume packages', 'iwjob' ),
                                'desc' => __( 'The number of free packages that each user is using', 'iwjob' ),
                                'id'   => 'free_resum_package_times',
                                'type' => 'text',
                            ),
	                        array(
		                        'name' => __( 'Apply Job Mode', 'iwjob' ),
		                        'id'   => 'apply_job_mode',
		                        'type' => 'select',
		                        'std' => '1',
		                        'options' => array(
			                        '' => __('Use Package', 'iwjob'),
			                        '1' => __('Apply Free', 'iwjob'),
		                        ),
	                        ),
	                        array(
		                        'name' => __( 'Free Apply Job Package', 'iwjob' ),
		                        'id'   => 'free_apply_job_package_id',
		                        'type' => 'post',
		                        'post_type' => 'iwj_apply_package',
		                        'js_options' => array(
			                        'allowClear' => true,
		                        )
	                        ),
	                        array(
		                        'name' => __( 'Number of free apply job packages', 'iwjob' ),
		                        'desc' => __( 'The number of free packages that each user is using', 'iwjob' ),
		                        'id'   => 'free_apply_job_package_times',
		                        'type' => 'text',
	                        ),
	                        array(
		                        'name'     => __( 'Candidate Suggestion Conditions', 'iwjob' ),
		                        'desc'     => __( 'Select the conditions to select the candidate', 'iwjob' ),
		                        'id'       => 'candidate_suggestion_conditions',
		                        'type'     => 'select_advanced',
		                        'multiple' => true,
		                        'std'      => array( 'profile_category' ),
		                        'options'  => array(
			                        'profile_category' => __( 'Profile Category', 'iwjob' ),
			                        'job_gender'       => __( 'Job Gender', 'iwjob' ),
			                        'job_language'     => __( 'Job Language', 'iwjob' ),
			                        'job_type'         => __( 'Job Type', 'iwjob' ),
			                        'job_skill'        => __( 'Job Skills', 'iwjob' ),
			                        'job_category'     => __( 'Job Category', 'iwjob' ),
			                        'job_level'        => __( 'Job Level', 'iwjob' ),
		                        ),
	                        ),
	                        array(
		                        'name'    => __( 'Who can see candidates', 'iwjob' ),
		                        'id'      => 'show_candidate_public_profile',
		                        'type'    => 'select',
		                        'std'     => '',
		                        'options' => array(
			                        ''  => __( 'Anyone', 'iwjob' ),
			                        '1' => __( 'Only Users Registered', 'iwjob' ),
			                        '2' => __( 'Only Employers', 'iwjob' ),
		                        ),
	                        ),
	                        array(
		                        'name' => __( 'Maximum file size upload CV (MB)', 'iwjob' ),
		                        'desc' => __( 'Enter the maximum file size CV. If empty, we will use maximum file size upload of your hosting.', 'iwjob' ),
		                        'id'   => 'maximum_file_size_cv',
		                        'type' => 'number',
	                        ),
                        )
                    ),
                    array(
                        'name' => __('Review Settings', 'iwjob'),
                        'options' => array(
	                        array(
		                        'id'      => 'disable_review',
		                        'name'    => esc_html__( 'Disable review', 'iwjob' ),
		                        'type'    => 'select',
		                        'std'     => '',
		                        'options' => array(
			                        ''  => __( 'No', 'iwjob' ),
			                        '1' => __( 'Yes', 'iwjob' ),
		                        ),
	                        ),
	                        array(
		                        'id'   => 'review_options',
		                        'name' => esc_html__( 'Options review', 'iwjob' ),
		                        'type' => 'textarea',
		                        'desc' => esc_html__( 'Enter your criteria rating (Each criteria on a line)', 'iwjob' )
	                        ),
	                        array(
		                        'id'      => 'edit_review_auto_approved',
		                        'name'    => esc_html__( 'Edit review auto approved', 'iwjob' ),
		                        'desc'    => esc_html__( 'Administrator will recheck the review when the user update their reviews', 'iwjob' ),
		                        'type'    => 'select',
		                        'std'     => '',
		                        'options' => array(
			                        ''  => __( 'No', 'iwjob' ),
			                        '1' => __( 'Yes', 'iwjob' ),
		                        ),
	                        )
                        )
                    ),
                    array(
                        'name' => __( 'Order Settings', 'iwjob' ),
                        'options' => array(
                            array(
                                'name' => __( 'Time To Keep Pending Payment Order (in hours)', 'iwjob' ),
                                'desc' => __( 'Leave blank if you do not want to automatically delete', 'iwjob' ),
                                'id'   => 'delete_pending_order_hours',
                                'type' => 'text',
                                'std' => '48',
                            ),
                            array(
                                'name' => __( 'Addition Infomation', 'iwjob' ),
                                'id'   => 'order_infomation',
                                'type' => 'textarea',
                                'std' => 'My name is imran&nbsp; typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin.[citation needed]',
                            ),
                            array(
                                "name" => esc_html__("Logo", 'iwjob'),
                                "desc" => esc_html__("Please choose an image file for your logo on the order.", 'iwjob'),
                                "id" => "order_logo",
                                "std" => get_template_directory_uri() . "/assets/images/logo.png",
                                "mod" => "",
                                'type'	=> 'image_advanced',
                                'max_file_uploads'	=> 1,
                            ),
                        ),
                    ),
                    array(
                        'name' => __( 'ReCaptcha Settings', 'iwjob' ),
                        'options' => array(
                            array(
                                'name' => __('Using ReCaptcha', 'iwjob' ),
                                'id'   => 'use_recaptcha',
                                'type' => 'checkbox-list',
                                'options' => array(
                                    'login' => __('Login Form', 'iwjob'),
                                    'register' => __('Register Form', 'iwjob'),
                                    'contact' => __('Contact Form', 'iwjob'),
                                    'job_alert' => __('Job Alert Form', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Google Secret Key', 'iwjob' ),
                                'desc' => __( 'Get key in <a href="https://www.google.com/recaptcha/admin">here</a>', 'iwjob' ),
                                'id'   => 'google_recaptcha_secret_key',
                                'type' => 'text',
                            ),
                            array(
                                'name' => __( 'Google Site Key', 'iwjob' ),
                                'desc' => __( 'Get key in <a href="https://www.google.com/recaptcha/admin">here</a>.', 'iwjob' ),
                                'id'   => 'google_recaptcha_site_key',
                                'type' => 'text',
                            ),
                        ),
                    ),

                )
            ),
        );

        $settings = apply_filters('iwj_setting_settings_fields', $settings);

        return array_merge( $def, $settings );
    }

    static function display_settings($def){
        $sideBars = array();
        foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
            $sideBars[$sidebar['id']] = ucwords( $sidebar['name'] );
        }
        $settings = array(
            'display-settings' => array(
                'name'    => __( 'Display Settings', 'iwjob' ),
                'options' => array(
                    array(
                        'name' => __( 'General Settings', 'iwjob' ),
                        'options' => array(
                            'dashboard_items_per_page' => array(
                                'name' => __( 'Items Per Page on Dashboard', 'iwjob' ),
                                'desc' => __( 'Limit jobs, Applications, Packages, Orders... on Dashboard.', 'iwjob' ),
                                'id'   => 'dashboard_items_per_page',
                                'std'   => '12',
                                'type' => 'text',
                            ),
                        ),
                    ),
                    array(
                        'name' => __( 'Job Settings', 'iwjob' ),
                        'options' => array(
                            array(
                                'name' => __( 'Sorting Jobs Default', 'iwjob' ),
                                'id'   => 'sorting_jobs_default',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    'featured' => __('Featured', 'iwjob'),
                                    'date' => __('New Job', 'iwjob'),
                                    'salary' => __('Salary', 'iwjob'),
                                    'name' => __('Title', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Always prioritize featured jobs when sorting', 'iwjob' ),
                                'desc' => __( 'If yes then featured jobs are always given priority. Conversely, it is only given priority when the sorting state is Default', 'iwjob' ),
                                'id'   => 'prioritize_featured_jobs',
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Show expired job', 'iwjob' ),
                                'id'   => 'show_expired_job',
                                'type' => 'select',
                                'std' => '1',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            'jobs_per_page' => array(
                                'name' => __( 'Jobs Per Page', 'iwjob' ),
                                'desc' => __( 'Limit jobs on jobs page, archive page.', 'iwjob' ),
                                'id'   => 'jobs_per_page',
                                'std'   => '12',
                                'type' => 'text',
                            ),
                            array(
                                'name' => __( 'Show company', 'iwjob' ),
                                'id'   => 'show_company_job',
                                'desc'   => __( 'in jobs page', 'iwjob' ),
                                'type' => 'select',
                                'std' => '1',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Show salary', 'iwjob' ),
                                'id'   => 'show_salary_job',
                                'desc'   => __( 'in jobs page', 'iwjob' ),
                                'type' => 'select',
                                'std' => '1',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Show Location', 'iwjob' ),
                                'id'   => 'show_location_job',
                                'desc'   => __( 'in jobs page', 'iwjob' ),
                                'type' => 'select',
                                'std' => '1',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            'jobs_sidebar' => array(
                                "name" => esc_html__("Jobs Sidebar", 'iwjob'),
                                "desc" => esc_html__("Using for jobs archive page (taxonomies ...)", 'iwjob'),
                                "id" => "jobs_sidebar",
                                "std" => "3",
                                "type" => "select",
                                "options" => array(
                                    '' => __('Without Sidebar', 'iwjob'),
                                    'left' => __('Left Sidebar', 'iwjob'),
                                    'right' => __('Right Sidebar', 'iwjob'),
                                    'both' => __('Left + Right', 'iwjob'),
                                )
                            ),
                            'job_sidebar' => array(
                                "name" => esc_html__("Job Details Sidebar", 'iwjob'),
                                "desc" => esc_html__("Using for job details", 'iwjob'),
                                "id" => "job_sidebar",
                                "std" => "right",
                                "type" => "select",
                                "options" => array(
                                    '' => __('Without Sidebar', 'iwjob'),
                                    'left' => __('Left Sidebar', 'iwjob'),
                                    'right' => __('Right Sidebar', 'iwjob'),
                                )
                            ),
                            'limit_item_related' => array(
                                "name" => esc_html__("Limit item related job", 'iwjob'),
                                "desc" => esc_html__("Accepts -1 (all) or any positive number.", 'iwjob'),
                                "id" => "limit_item_related",
                                "std" => "3",
                                "type" => "text"
                            ),
                            'show_find_jobs' => array(
                                "name" => esc_html__("Show Search Form Jobs", 'iwjob'),
                                "desc" => esc_html__("Show search form jobs on jobs page and all taxonomies of jobs", 'iwjob'),
                                "id" => "show_find_jobs",
                                "std" => 1,
                                "type" => "checkbox"
                            ),
                            'search_form_jobs_style' => array(
                                "name" => esc_html__("Search Form Jobs Style", 'iwjob'),
                                "desc" => esc_html__("Search form jobs style.", 'iwjob'),
                                "id" => "search_form_jobs_style",
                                "std" => '',
                                "type" => "select",
                                "options" => array(
                                    '' => esc_html__('Simple Search', 'iwjob'),
                                    'style1' => esc_html__('Advanced Search', 'iwjob'),
                                    'style2' => esc_html__('Advanced Search With Radius', 'iwjob'),
                                )
                            ),
                            'find_jobs_style' => array(
                                "name" => esc_html__("Simple Search Style", 'iwjob'),
                                "desc" => esc_html__("Form Simple Search style.", 'iwjob'),
                                "id" => "find_jobs_style",
                                "std" => 'style2',
                                "type" => "select",
                                "options" => array(
                                    'style1' => esc_html__('Light', 'iwjob'),
                                    'style2' => esc_html__('Dark', 'iwjob'),
                                )
                            ),
                            'limit_keyword_job' => array(
                                "name" => esc_html__("Limit Keyword Form Find Jobs", 'iwjob'),
                                "desc" => esc_html__("Accepts 0 (all) or any positive number.", 'iwjob'),
                                "id" => "limit_keyword_job",
                                "std" => "10",
                                "type" => "text"
                            ),
	                        array(
		                        'name' => __( 'Show Print', 'iwjob' ),
		                        'id'   => 'show_print_job',
		                        'desc'   => __( 'in jobs detail page', 'iwjob' ),
		                        'type' => 'select',
		                        'std' => '',
		                        'options' => array(
			                        '1' => __('Yes', 'iwjob'),
			                        '' => __('No', 'iwjob'),
		                        ),
	                        ),
	                        array(
		                        'name' => __( 'Show Rss Feed', 'iwjob' ),
		                        'id'   => 'show_rss_feed_job',
		                        'desc'   => __( 'show rss feed on jobs page and archive page', 'iwjob' ),
		                        'type' => 'select',
		                        'std' => '',
		                        'options' => array(
			                        '1' => __('Yes', 'iwjob'),
			                        '' => __('No', 'iwjob'),
		                        ),
	                        ),
                        )
                    ),
                    array(
                        'name' => __( 'Employer Settings', 'iwjob' ),
                        'options' => array(
                            array(
                                'name' => __( 'Show employer alphabet filter', 'iwjob' ),
                                'id'   => 'show_filter_alpha_employer',
                                'type' => 'select',
                                'std' => '1',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            'employers_per_page' => array(
                                'name' => __( 'Employers Per Page', 'iwjob' ),
                                'desc' => __( 'Limit employers on employers page, archive page.', 'iwjob' ),
                                'id'   => 'employers_per_page',
                                'std'   => '12',
                                'type' => 'text',
                            ),
                            'employer_sidebar' => array(
                                "name" => esc_html__("Employer Details Sidebar", 'iwjob'),
                                "desc" => esc_html__("Using for employer details", 'iwjob'),
                                "id" => "employer_sidebar",
                                "std" => "right",
                                "type" => "select",
                                "options" => array(
                                    '' => __('Without Sidebar', 'iwjob'),
                                    'left' => __('Left Sidebar', 'iwjob'),
                                    'right' => __('Right Sidebar', 'iwjob'),
                                )
                            ),
                            array(
                                'name' => __( 'Show Rss Feed', 'iwjob' ),
                                'id'   => 'show_rss_feed_employer',
                                'desc'   => __( 'show rss feed on employers page', 'iwjob' ),
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Avatar Width', 'iwjob' ),
                                'id'   => 'employer_avatar_width',
                                'type' => 'text',
                            ),
                            array(
                                'name' => __( 'Avatar Height', 'iwjob' ),
                                'id'   => 'employer_avatar_height',
                                'type' => 'text',
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Candidate Settings', 'iwjob' ),
                        'options' => array(
                            'candidates_per_page' => array(
                                'name' => __( 'Candidates Per Page', 'iwjob' ),
                                'desc' => __( 'Limit candidates on candidates page, archive page.', 'iwjob' ),
                                'id'   => 'candidates_per_page',
                                'std'   => '12',
                                'type' => 'text',
                            ),
                            'show_advanced_search_candidates' => array(
                                "name" => esc_html__("Show Advanced Search", 'iwjob'),
                                "desc" => esc_html__("Show Advanced Search on candidates page", 'iwjob'),
                                "id" => "show_advanced_search_candidates",
                                "std" => 1,
                                "type" => "checkbox"
                            ),
                            'candidate_sidebar' => array(
                                "name" => esc_html__("Candidate Details Sidebar", 'iwjob'),
                                "desc" => esc_html__("Using for candidate details", 'iwjob'),
                                "id" => "candidate_sidebar",
                                "std" => "right",
                                "type" => "select",
                                "options" => array(
                                    '' => __('Without Sidebar', 'iwjob'),
                                    'left' => __('Left Sidebar', 'iwjob'),
                                    'right' => __('Right Sidebar', 'iwjob'),
                                )
                            ),
                            array(
                                'name' => __( 'Show Rss Feed', 'iwjob' ),
                                'id'   => 'show_rss_feed_candidate',
                                'desc'   => __( 'show rss feed on candidates page', 'iwjob' ),
                                'type' => 'select',
                                'std' => '',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Avatar Width', 'iwjob' ),
                                'id'   => 'candidate_avatar_width',
                                'type' => 'text',
                            ),
                            array(
                                'name' => __( 'Avatar Height', 'iwjob' ),
                                'id'   => 'candidate_avatar_height',
                                'type' => 'text',
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Map Settings', 'iwjob' ),
                        'options' => array(
                            array(
                                'name' => __( 'Google API Key', 'iwjob' ),
                                'desc' => __( 'If blank we will receive at theme options.', 'iwjob' ),
                                'id'   => 'google_api_key',
                                'type' => 'text',
                            ),
                            array(
                                'name' => __( 'Default Latitude', 'iwjob' ),
                                'id'   => 'map_latitude',
                                'type' => 'text',
                            ),
                            array(
                                'name' => __( 'Default longitude', 'iwjob' ),
                                'id'   => 'map_logtitude',
                                'type' => 'text',
                            ),
                            array(
                                'name' => __( 'Default zoom', 'iwjob' ),
                                'id'   => 'map_zoom',
                                'type' => 'text',
                            ),
                            array(
                                'name' => __( 'Map Styles', 'iwjob' ),
                                'id'   => 'map_styles',
                                'type' => 'textarea',
                            ),
                            array(
                                "name" => esc_html__("Map marker", 'iwjob'),
                                "desc" => esc_html__("Please choose an image file for your map marker.", 'iwjob'),
                                "id" => "iwj_map_maker",
                                "std" => get_template_directory_uri() . "/assets/images/map-marker-job.png",
                                "mod" => "",
                                'type'			=> 'image_advanced',
                                'max_file_uploads'	=> 1,
                            ),
                        ),
                    ),

                )
            ),
        );

        $settings = apply_filters('iwj_setting_display_fields', $settings);

        return array_merge( $def, $settings );
    }

    static function price_settings($def){
        $settings = array(
            'price-settings' => array(
                'name'    => __( 'Price Settings', 'iwjob' ),
                'options' => array(
                    array(
                        'name' => __( 'Price Settings', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'currency',
                                'name'			=> __( 'Default Job Currency' , 'iwjob' ),
                                'type'			=> 'select_advanced',
                                'options'		=> iwj_get_currencies(),
                                'std'		    => 'USD',
                            ),
                            array(
                                'id' 			=> 'allow_currencies',
                                'name'			=> __( 'Job Allow Currencies' , 'iwjob' ),
                                'type'			=> 'select_advanced',
                                'multiple'		=> true,
                                'options'		=> iwj_get_currencies(),
                                'std'		    => array('USD', 'EUR'),
                            ),
                            array(
                                'id' 			=> 'system_currency',
                                'name'			=> __( 'System Currency' , 'iwjob' ),
                                'type'			=> 'select_advanced',
                                'options'		=> iwj_get_currencies(),
                                'std'		    => 'USD',
                            ),
                            array(
                                'id' 			=> 'price_trim_zeros',
                                'name'			=> __( 'Trim Zeros' , 'iwjob' ),
                                'type'			=> 'select_advanced',
                                'std'			=> '1',
                                'js_options' => array(
                                    'minimumResultsForSearch'=> -1
                                ),
                                'options'		=> array(
                                    '1' => __('Yes'),
                                    '0' => __('No'),
                                ),
                            ),
                            array(
                                'name' => __( 'Use Tax', 'iwjob' ),
                                'id'   => 'tax_used',
                                'type' => 'select',
                                'options' => array(
                                    '1' => __('Yes', 'iwjob'),
                                    '' => __('No', 'iwjob'),
                                ),
                            ),
                            array(
                                'name' => __( 'Tax Value', 'iwjob' ),
                                'desc' => __( 'in percent', 'iwjob' ),
                                'id'   => 'tax_value',
                                'type' => 'text',
                            ),
                        )
                    )
                )
            ),
        );

        $settings = apply_filters('iwj_setting_price_fields', $settings);

        return array_merge( $def, $settings );
    }

    static function email_settings($def){

        $settings = array(
            'email-settings' => array(
                'name'    => __( 'Email Settings', 'iwjob' ),
                'group_type' =>'accordion',
                'options' => array(
                    array(
                        'name' => __( 'New Register', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_register_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_register_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'New Registration',
                            ),
                            array(
                                'id' 			=> 'email_register_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'New Registration',
                            ),
                            array(
                                'id' 			=> 'email_register_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'New Register[Admin]', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_admin_register_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_admin_register_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'New Registration',
                            ),
                            array(
                                'id' 			=> 'email_admin_register_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'New Registration',
                            ),
                            array(
                                'id' 			=> 'email_admin_register_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Verify Account', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_verify_account_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'desc'			=> __( 'Will use when use resend verification or change new email' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_verify_account_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Verify account',
                            ),
                            array(
                                'id' 			=> 'email_verify_account_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Verify account',
                            ),
                            array(
                                'id' 			=> 'email_verify_account_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Reset Password', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_resetpass_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_resetpass_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Reset Password Request',
                            ),
                            array(
                                'id' 			=> 'email_resetpass_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Reset Password',
                            ),
                            array(
                                'id' 			=> 'email_resetpass_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Delete Account', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_delete_account_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_delete_account_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Account successfully deleted',
                            ),
                            array(
                                'id' 			=> 'email_delete_account_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Account successfully deleted',
                            ),
                            array(
                                'id' 			=> 'email_delete_account_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'New Job', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_new_job_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                                'desc' => __('Send to Follower', 'iwjob')
                            ),
                            array(
                                'id' 			=> 'email_new_job_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'New Job From {$author_name}',
                            ),
                            array(
                                'id' 			=> 'email_new_job_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'New Job From {$author_name}',
                            ),
                            array(
                                'id' 			=> 'email_new_job_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Review Job[Admin]', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_review_job_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_review_job_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Review Job',
                            ),
                            array(
                                'id' 			=> 'email_review_job_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Review Job',
                            ),
                            array(
                                'id' 			=> 'email_review_job_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Approved Job', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_approved_job_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_approved_job_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Approved Job {$job_title}',
                            ),
                            array(
                                'id' 			=> 'email_approved_job_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Your Job has been approved!',
                            ),
                            array(
                                'id' 			=> 'email_approved_job_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Rejected Job', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_rejected_job_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_rejected_job_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Rejected Job {$job_title}',
                            ),
                            array(
                                'id' 			=> 'email_rejected_job_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Your job has been rejected!',
                            ),
                            array(
                                'id' 			=> 'email_rejected_job_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Alert Jobs', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_alert_job_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_alert_job_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Hi {$display_name}, {$total_jobs}  new jobs for {$position} position is available',
                            ),
                            array(
                                'id' 			=> 'email_alert_job_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> ' {$total_jobs} new jobs for {$position}',
                            ),
                            array(
                                'id' 			=> 'email_alert_job_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Confirm Alert Jobs', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_confirm_alert_job_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'desc'			=> __( 'Only applicable to guests who use email to register' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_confirm_alert_job_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> '',
                            ),
                            array(
                                'id' 			=> 'email_confirm_alert_job_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> '',
                            ),
                            array(
                                'id' 			=> 'email_confirm_alert_job_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Review Profile[Admin]', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_review_profile_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_review_profile_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Review Profile',
                            ),
                            array(
                                'id' 			=> 'email_review_profile_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Review Profile',
                            ),
                            array(
                                'id' 			=> 'email_review_profile_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Approved Profile', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_approved_profile_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_approved_profile_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Approved Profile',
                            ),
                            array(
                                'id' 			=> 'email_approved_profile_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Your profile has been approved.',
                            ),
                            array(
                                'id' 			=> 'email_approved_profile_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Rejected Profile', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_rejected_profile_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_rejected_profile_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Rejected Profile',
                            ),
                            array(
                                'id' 			=> 'email_rejected_profile_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Your profile has been rejected',
                            ),
                            array(
                                'id' 			=> 'email_rejected_profile_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'New Order', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_new_order_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_new_order_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'New Order',
                            ),
                            array(
                                'id' 			=> 'email_new_order_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'New Order',
                            ),
                            array(
                                'id' 			=> 'email_new_order_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'New Order[Admin]', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_new_order_admin_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'desc'	=> __( 'Will be send when new order was changed to hold | completed' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_new_order_admin_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'New Order',
                            ),
                            array(
                                'id' 			=> 'email_new_order_admin_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'New Order',
                            ),
                            array(
                                'id' 			=> 'email_new_order_admin_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Hold Order', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_hold_order_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_hold_order_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Order #{$order_number} is on hold',
                            ),
                            array(
                                'id' 			=> 'email_hold_order_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Thank you for ordering!',
                            ),
                            array(
                                'id' 			=> 'email_hold_order_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Completed Order', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_completed_order_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_completed_order_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Order #{$order_number} has been completed',
                            ),
                            array(
                                'id' 			=> 'email_completed_order_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Thank you for ordering!',
                            ),
                            array(
                                'id' 			=> 'email_completed_order_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Email Customer Note', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_customer_note_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_customer_note_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> '{$site_title} Notification for #{$order_number}',
                            ),
                            array(
                                'id' 			=> 'email_customer_note_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Greetings from InJob Team!',
                            ),
                            array(
                                'id' 			=> 'email_customer_note_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Email Customer Invoice', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_customer_invoice_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_customer_invoice_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Invoice For Order #{$order_number} from {$order_date} on {$site_title}',
                            ),
                            array(
                                'id' 			=> 'email_customer_invoice_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Invoice For Order #{$order_number}',
                            ),
                            array(
                                'id' 			=> 'email_customer_invoice_paid_subject',
                                'name'			=> __( 'Email Subject (paid)' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Invoice For Order #{$order_number} from {$order_date} on {$site_title}',
                            ),
                            array(
                                'id' 			=> 'email_customer_invoice_paid_heading',
                                'name'			=> __( 'Email Heading (paid)' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Invoice For Order #{$order_number}',
                            ),
                            array(
                                'id' 			=> 'email_customer_invoice_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'New Application[Candidate]', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_new_application_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'desc'	=> __( 'Will be send to candidate' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_new_application_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'You have been applied for {$job_title} at {$job_author_name}',
                            ),
                            array(
                                'id' 			=> 'email_new_application_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Thank you for your application',
                            ),
                            array(
                                'id' 			=> 'email_new_application_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'New Application[Employer]', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_new_application_employer_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'desc'	=> __( 'Will be send to employer' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_new_application_employer_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'New application for {$job_title}',
                            ),
                            array(
                                'id' 			=> 'email_new_application_employer_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'New application',
                            ),
                            array(
                                'id' 			=> 'email_new_application_employer_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                            ),
                        )
                    ),
                    array(
                        'name' => __( 'Application Contact', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_application_enable',
                                'name'			=> __( 'Email Enable' , 'iwjob' ),
                                'desc'	=> __( 'Will be used when employer send an email to candidate in applications list.' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_application_subject',
                                'name'			=> __( 'Email Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> '{$subject}',
                            ),
                            array(
                                'id' 			=> 'email_application_heading',
                                'name'			=> __( 'Email Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Email From {from_name}',
                            ),
                            array(
                                'id' 			=> 'email_application_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '{$message}',
                                'attributes'    => array(
                                    'rows' => 5,
                                ),
                            ),
                            array(
                                'id' 			=> 'email_application_interview_subject',
                                'name'			=> __( 'Default Interview application Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Interview letter',
                            ),
                            array(
                                'id' 			=> 'email_application_interview_message',
                                'name'			=> __( 'Default Interview application Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                /*'options'       => array(
                                    'quicktags' => false,
                                    'editor_height' => 250,
                                    'media_buttons' => false
                                ),*/
                                'std'		=> 'Hi. {applier_name}.

Lacinia fusce nam nibh diam rhoncus sodales, vestibulum blandit viverra facilisis velit, ante auctor sociis et ornare. Sociis condimentum massa suscipit nisl parturient platea hac, in iaculis congue nec ridiculus mus, himenaeos consequat vulputate lacus velit natoque. Eleifend euismod interdum sem imperdiet consequat tristique augue per condimentum nam platea feugiat cum, parturient ligula enim ullamcorper vivamus commodo purus.

Best Regard,

InJob inc.',
                            ),
                            array(
                                'id' 			=> 'email_application_accept_subject',
                                'name'			=> __( 'Default Accepted application Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Congratulations! Your resume has passed our application round',
                            ),
                            array(
                                'id' 			=> 'email_application_accept_message',
                                'name'			=> __( 'Default Accepted application Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                /*'options'       => array(
                                    'quicktags' => false,
                                    'editor_height' => 250,
                                    'media_buttons' => false
                                ),*/
                                'std'		=> 'Hi. {applier_name}.

Lacinia fusce nam nibh diam rhoncus sodales, vestibulum blandit viverra facilisis velit, ante auctor sociis et ornare. Sociis condimentum massa suscipit nisl parturient platea hac, in iaculis congue nec ridiculus mus, himenaeos consequat vulputate lacus velit natoque. Eleifend euismod interdum sem imperdiet consequat tristique augue per condimentum nam platea feugiat cum, parturient ligula enim ullamcorper vivamus commodo purus.

Best Regard,

InJob inc.',
                            ),
                            array(
                                'id' 			=> 'email_application_reject_subject',
                                'name'			=> __( 'Default Rejected application Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Unfortunately! Your resume didn\'t passed our application round',
                            ),
                            array(
                                'id' 			=> 'email_application_reject_message',
                                'name'			=> __( 'Default Rejected application Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                /*'options'       => array(
                                    'quicktags' => false,
                                    'editor_height' => 250,
                                    'media_buttons' => false
                                ),*/
                                'std'		=> 'Hi. {applier_name}.

Lacinia fusce nam nibh diam rhoncus sodales, vestibulum blandit viverra facilisis velit, ante auctor sociis et ornare. Sociis condimentum massa suscipit nisl parturient platea hac, in iaculis congue nec ridiculus mus, himenaeos consequat vulputate lacus velit natoque. Eleifend euismod interdum sem imperdiet consequat tristique augue per condimentum nam platea feugiat cum, parturient ligula enim ullamcorper vivamus commodo purus.

Best Regard,

InJob inc.',
                            ),
                        )
                    ),
	                array(
		                'name' => __( 'New Review [Admin]', 'iwjob' ),
		                'options' => array(
			                array(
				                'id' 			=> 'email_new_review_enable',
				                'name'			=> __( 'Email Enable' , 'iwjob' ),
				                'type'			=> 'checkbox',
				                'std'		=> '1',
			                ),
			                array(
				                'id' 			=> 'email_new_review_subject',
				                'name'			=> __( 'Email Subject' , 'iwjob' ),
				                'type'			=> 'text',
				                'std'		=> 'New Review',
			                ),
			                array(
				                'id' 			=> 'email_new_review_heading',
				                'name'			=> __( 'Email Heading' , 'iwjob' ),
				                'type'			=> 'text',
				                'std'		=> 'New Review',
			                ),
			                array(
				                'id' 			=> 'email_new_review_content',
				                'name'			=> __( 'Email Content' , 'iwjob' ),
				                'type'			=> 'textarea',
				                'std'		=> '',
				                'attributes'    => array(
					                'rows' => 10,
				                ),
			                ),
		                )
	                ),
	                array(
		                'name' => __( 'Approved Review [employer]', 'iwjob' ),
		                'options' => array(
			                array(
				                'id' 			=> 'email_approved_review_enable',
				                'name'			=> __( 'Email Enable' , 'iwjob' ),
				                'type'			=> 'checkbox',
				                'desc' 			=> __( 'Send to Employer', 'iwjob'),
				                'std'		=> '1',
			                ),
			                array(
				                'id' 			=> 'email_approved_review_subject',
				                'name'			=> __( 'Email Subject' , 'iwjob' ),
				                'type'			=> 'text',
				                'std'		=> '',
			                ),
			                array(
				                'id' 			=> 'email_approved_review_heading',
				                'name'			=> __( 'Email Heading' , 'iwjob' ),
				                'type'			=> 'text',
				                'std'		=> '',
			                ),
			                array(
				                'id' 			=> 'email_approved_review_content',
				                'name'			=> __( 'Email Content' , 'iwjob' ),
				                'type'			=> 'textarea',
				                'std'		=> '',
				                'attributes'    => array(
					                'rows' => 10,
				                ),
			                ),
		                )
	                ),
	                array(
		                'name' => __( 'Approved Review [candidate]', 'iwjob' ),
		                'options' => array(
			                array(
				                'id' 			=> 'email_candidate_approved_review_enable',
				                'name'			=> __( 'Email Enable' , 'iwjob' ),
				                'type'			=> 'checkbox',
				                'desc' 			=> __( 'Send to Candidate', 'iwjob'),
				                'std'		=> '1',
			                ),
			                array(
				                'id' 			=> 'email_candidate_approved_review_subject',
				                'name'			=> __( 'Email Subject' , 'iwjob' ),
				                'type'			=> 'text',
				                'std'		=> '',
			                ),
			                array(
				                'id' 			=> 'email_candidate_approved_review_heading',
				                'name'			=> __( 'Email Heading' , 'iwjob' ),
				                'type'			=> 'text',
				                'std'		=> '',
			                ),
			                array(
				                'id' 			=> 'email_candidate_approved_review_content',
				                'name'			=> __( 'Email Content' , 'iwjob' ),
				                'type'			=> 'textarea',
				                'std'		=> '',
				                'attributes'    => array(
					                'rows' => 10,
				                ),
			                ),
		                )
	                ),
                    array(
                    	'name' => __( 'Rejected Review', 'iwjob' ),
	                    'options' => array(
		                    array(
			                    'id' 			=> 'email_rejected_review_enable',
			                    'name'			=> __( 'Email Enable' , 'iwjob' ),
			                    'type'			=> 'checkbox',
			                    'std'		=> '1',
		                    ),
		                    array(
			                    'id' 			=> 'email_rejected_review_subject',
			                    'name'			=> __( 'Email Subject' , 'iwjob' ),
			                    'type'			=> 'text',
			                    'std'		=> '',
		                    ),
		                    array(
			                    'id' 			=> 'email_rejected_review_heading',
			                    'name'			=> __( 'Email Heading' , 'iwjob' ),
			                    'type'			=> 'text',
			                    'std'		=> '',
		                    ),
		                    array(
			                    'id' 			=> 'email_rejected_review_content',
			                    'name'			=> __( 'Email Content' , 'iwjob' ),
			                    'type'			=> 'textarea',
			                    'std'		=> '',
			                    'attributes'    => array(
				                    'rows' => 10,
			                    ),
		                    ),
	                    )
					),
                    array(
                        'name' => __( 'Contact Email', 'iwjob' ),
                        'options' => array(
                            array(
                                'id' 			=> 'email_contact_enable',
                                'name'			=> __( 'Contact Email Enable' , 'iwjob' ),
                                'desc'	=> __( 'Will be used when user contact employer or candidate on single page' , 'iwjob' ),
                                'type'			=> 'checkbox',
                                'std'		=> '1',
                            ),
                            array(
                                'id' 			=> 'email_contact_subject',
                                'name'			=> __( 'Contact Subject' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> '{$subject}',
                            ),
                            array(
                                'id' 			=> 'email_contact_heading',
                                'name'			=> __( 'Contact Heading' , 'iwjob' ),
                                'type'			=> 'text',
                                'std'		=> 'Contact From {$from_name}',
                            ),
                            array(
                                'id' 			=> 'email_contact_content',
                                'name'			=> __( 'Email Content' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'		=> '{$message}',
                                'attributes'    => array(
                                    'rows' => 5,
                                ),
                            ),
                        )
                    ),

                    array(
                        'name' => __( 'Email Style', 'iwjob' ),
                        'options' => array(
	                        array(
		                        'id' 			=> 'admin_email_receiver',
		                        'name'			=> __( 'Admin Email' , 'iwjob' ),
		                        'type'			=> 'text',
		                        'desc'	=> __( 'Enter the email address to receive all emails replace for admin email. If empty, the system will automatic get email of your site system in General Setting.' , 'iwjob' ),
	                        ),
	                        array(
		                        'id' 			=> 'admin_email_from_name',
		                        'name'			=> __( 'Admin Name' , 'iwjob' ),
		                        'type'			=> 'text',
		                        'desc'	=> __( 'Enter the name of heading in admin\'s email. If empty, the system will automatic get Site Title of your site in General Setting.' , 'iwjob' ),
	                        ),
                            array(
                                'id' 			=> 'email_background_color',
                                'name'			=> __( 'Email Background Color' , 'iwjob' ),
                                'type'			=> 'color',
                                'std'		=> '#eeeeee',
                            ),
                            array(
                                'id' 			=> 'email_body_background_color',
                                'name'			=> __( 'Email Body Background Color' , 'iwjob' ),
                                'type'			=> 'color',
                                'std'		=> '#ffffff',
                            ),
                            array(
                                'id' 			=> 'email_base_color',
                                'name'			=> __( 'Email Base Color' , 'iwjob' ),
                                'type'			=> 'color',
                                'std'		=> '#33427a',
                            ),
                            array(
                                'id' 			=> 'email_text_color',
                                'name'			=> __( 'Email Text Color' , 'iwjob' ),
                                'type'			=> 'color',
                                'std'		=> '#aaaaaa',
                            ),
                            array(
                                'id' 			=> 'email_body_text_color',
                                'name'			=> __( 'Email Body Text Color' , 'iwjob' ),
                                'type'			=> 'color',
                                'std'		=> '#aaaaaa',
                            ),
                            array(
                                'id' 			=> 'email_template',
                                'name'			=> __( 'Email Template [Allow HTML]' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'attributes'    => array(
                                    'rows' => 10,
                                ),
                                'std'     => '<!DOCTYPE html>
<html {$language_attributes} >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset={$charset}" />
		<title>{$site_title}</title>
	</head>
	<body {if $is_rtl eq 1}rightmargin{else}leftmargin{/if}="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
		<div id="wrapper" dir="{if $is_rtl eq 1}rtl{else}ltr{/if}">
		    <table id="template_container">
                <tr>
                    <td id="template_top_header">
                        <div id="logoWrap" align="bottom" style="text-align:center!important;background-image:url(\'http://inwavethemes.com/wordpress/injob/wp-content/uploads/2017/06/email-header-line.jpg\')!important;background-repeat:no-repeat!important;background-size:600px 50px;background-position:center center!important">
	<center>
	 <a href="#" style="text-decoration:none" target="_blank"><img id="logo" src="http://inwavethemes.com/wordpress/injob/wp-content/uploads/2017/06/email-logo-small.png" width="130" height="43" style="height:auto;line-height:100%;outline:none;text-decoration:none;max-width:100%;margin:10px auto 15px;border:0; padding: 0 20px; background: #eee"></a>
	</center>
</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="template_table">
                            <thead id="template_header">
                                <tr>
                                    <td align="center" valign="top">
                                        <h1>#email_heading#</h1>
                                    </td>
                                </tr>
                            </thead>
                            <tbody id="template_body">
                                <!-- Content -->
                                <tr>
                                    <td valign="top" id="body_content">
                                        <div id="body_content_inner">
											#email_body_content#
										 </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
				<tr>
					<td id="template_footer">
						<center>Copyright © 2017 InwaveThemes Inc., All rights reserved.</center>
					</td>
				</tr>
            </table>
		</div>
	</body>
</html>',
                            ),
                            array(
                                'id' 			=> 'email_styles',
                                'name'			=> __( 'Email Styles [CSS]' , 'iwjob' ),
                                'type'			=> 'textarea',
                                'std'     => '',
                            ),
                        )
                    ),
                )
            ),
        );

        $settings = apply_filters('iwj_setting_email_fields', $settings);

        return array_merge( $def, $settings );
    }

    static function apply_settings($def){

        $settings = array(
            'application-form-settings' => array(
                'name'    => __( 'Apply Methods', 'iwjob' ),
                'callback' => array('IWJ_Admin_Setting', 'apply_settings_callback')
            ),
        );

        return array_merge( $def, $settings );
    }

    static function apply_settings_callback($tab, $settings){
        $applies = IWJ()->applies->applies();
        if($applies){
            echo '<table class="form-table">';

            do_action('iwj_before_apply_settings', $settings, $applies);

            foreach ($applies as $apply){
                echo '<tr class="iwj-heading"><th colspan="2">';
                echo '<span>'.$apply->get_title().'</span>';
                $description = $apply->get_description();
                if($description){
                    echo '<p>'.$description.'</p>';
                }
                echo '</th></tr>';
                $admin_option_fields = $apply->admin_option_fields();
                if ($admin_option_fields) {
                    if(is_array($admin_option_fields)){
                        foreach ($admin_option_fields as $field) {
                            $field['id'] = 'apply_' . $apply->id.'_'.$field['id'];
                            $field = IWJMB_Field::call( 'normalize', $field );
                            $meta = isset($settings[$field['id']]) ? $settings[$field['id']] : $field['std'];
                            IWJMB_Field::input($field, $meta );
                        }
                    }elseif(is_string($admin_option_fields)){
                        echo $admin_option_fields;
                    }
                }
            }

            do_action('iwj_after_apply_settings', $settings, $applies);

            echo '</table>';
        }
    }

    static function social_login_settings($def){

        $settings = array(
            'social-login-settings' => array(
                'name'    => __( 'Social Logins', 'iwjob' ),
                'callback' => array('IWJ_Admin_Setting', 'social_login_settings_callback')
            ),
        );

        return array_merge( $def, $settings );
    }

    static function social_login_settings_callback($tab, $settings){
        $socials = IWJ()->social_logins->social_logins();
        if($socials){
            echo '<table class="form-table">';

            do_action('iwj_before_social_login_settings', $settings, $socials);

            foreach ($socials as $social){
                echo '<tr class="iwj-heading"><th colspan="2">'.$social->get_title().'</th></tr>';
                $admin_option_fields = $social->admin_option_fields();
                if ($admin_option_fields) {
                    if(is_array($admin_option_fields)){
                        foreach ($admin_option_fields as $field) {
                            $field['id'] = 'social_' . $social->id.'_'.$field['id'];
                            $field = IWJMB_Field::call( 'normalize', $field );
                            $meta = isset($settings[$field['id']]) ? $settings[$field['id']] : $field['std'];
                            IWJMB_Field::input($field, $meta );
                        }
                    }elseif(is_string($admin_option_fields)){
                        echo $admin_option_fields;
                    }
                }
            }

            do_action('iwj_after_social_login_settings', $settings, $socials);

            echo '</table>';
        }
    }

    static function payment_gateway_settings($def){

        $settings = array(
            'payment-gateway-settings' => array(
                'name'    => __( 'Payment Gateways', 'iwjob' ),
                'callback' => array('IWJ_Admin_Setting', 'payment_gateway_settings_callback')
            ),
        );

        return array_merge( $def, $settings );
    }

    static function payment_gateway_settings_callback($tab, $settings){
        $payment_gateways = IWJ()->payment_gateways->payment_gateways();
        if($payment_gateways){
            echo '<table class="form-table">';

            do_action('iwj_before_payment_gateway_settings', $settings, $payment_gateways);

            foreach ($payment_gateways as $gateway){
                echo '<tr class="iwj-heading"><th colspan="2">'.$gateway->get_title().'</th></tr>';
                $admin_option_fields = $gateway->admin_option_fields();
                if ($admin_option_fields) {
                    if(is_array($admin_option_fields)){
                        foreach ($admin_option_fields as $field) {
                            $field['id'] = 'gateway_' . $gateway->id.'_'.$field['id'];
                            $field = IWJMB_Field::call( 'normalize', $field );
                            $meta = isset($settings[$field['id']]) ? $settings[$field['id']] : $field['std'];
                            IWJMB_Field::input($field, $meta );
                        }
                    }elseif(is_string($admin_option_fields)){
                        echo $admin_option_fields;
                    }
                }
            }

            do_action('iwj_after_payment_gateway_settings', $settings, $payment_gateways);

            echo '</table>';
        }
    }

    static function setting_page(){
        if (isset( $_POST['iwj-security'] ) && wp_verify_nonce( $_POST['iwj-security'], 'iwj-save-settings' )) {
            self::save_settings();
        }

        wp_enqueue_script( 'iwjmb-clone');
        wp_enqueue_script("jquery-ui-core");
        wp_enqueue_script("jquery-ui-tabs");
        wp_enqueue_script("jquery-ui-accordion");
        wp_enqueue_style("jquery-ui-accordion");
        $settings = iwj_option();
        ?>
        <div class="wrap">
            <div class="iwj-setting-page">
            <form action="" method="post">
            <div id="iwj-setting-tabs">
                <ul>
                    <?php
                    $plugin_settings = apply_filters('iwj_plugin_settings', array());
                    if($plugin_settings){
                        foreach ($plugin_settings AS $tab => $tab_settings){
                            echo '<li><a href="#iwj-tab-'.$tab.'">'.$tab_settings['name'].'</a></li>';
                        }
                    }
                    ?>
                </ul>
            <?php
                $plugin_settings = apply_filters('iwj_plugin_settings', array());
                if($plugin_settings){
                    foreach ($plugin_settings AS $tab => $tab_settings){
                        echo '<div id="iwj-tab-'.$tab.'">';
                        if(isset($tab_settings['callback']) && $tab_settings['callback']){
                            $callable_name = '';
                            if(is_callable($tab_settings['callback'], false, $callable_name)){
                                call_user_func_array($callable_name, array($tab_settings, $settings));
                            }
                        }else{
                            $accordion = isset($tab_settings['group_type']) && $tab_settings['group_type'] == 'accordion';
                            if(!$accordion){
                                echo '<table class="form-table">';
                            }else{
                                echo '<div class="iwj-setting-accordion">';
                            }
                            foreach ($tab_settings['options'] as $group){
                                if($group['name']){
                                    if($accordion){
                                        echo '<h3 class="accordion-title">'.$group['name'];
                                        if(isset($group['desc']) && $group['desc']){
                                            echo '<span>'.$group['desc'].'</span>';
                                        }
                                        echo '</h3>';
                                    }else{
                                        echo '<tr class="iwj-heading"><th colspan="2">';
                                        echo '<span>'.$group['name'].'</span>';
                                        if(isset($group['desc']) && $group['desc']){
                                            echo '<p>'.$group['desc'].'</p>';
                                        }
                                        echo '</th></tr>';
                                    }
                                }

                                if($accordion){
                                    echo '<div><table class="form-table">';
                                }

                                if(isset($group['callback']) && $group['callback']){
                                    $callable_name = '';
                                    if(is_callable($group['callback'], false, $callable_name)){
                                        call_user_func_array($callable_name, array($group, $settings));
                                    }
                                }elseif(isset($group['options']) && $group['options']){
                                    if($tab == 'job-settings'){
                                        foreach ($group['options'] as $field_key => $field){
                                            if($field_key && $field_key == 'job_expiry'){
                                                //job expiry
                                                echo '<tr class="iwjmb-field">';
                                                echo '<th class="iwjmb-label"><label>'.__( 'Job Duration', 'iwjob' ).'</label></th>';
                                                echo '<td>';
                                                $field = IWJMB_Field::call( 'normalize', $group['options']['job_expiry'] );
                                                $meta = isset($settings[$field['id']]) ? $settings[$field['id']] : $field['std'];
                                                echo IWJMB_Field::call( $field, 'input', $meta );
                                                $field = IWJMB_Field::call( 'normalize', $group['options']['job_expiry_unit'] );
                                                $meta = isset($settings[$field['id']]) ? $settings[$field['id']] : $field['std'];
                                                echo IWJMB_Field::call( $field, 'input', $meta );
                                                echo '<p>'.__('This time is used for free job or a renewing job').'</p>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }elseif($field_key && $field_key == 'featured_job_expiry'){
                                                //featured expiry
                                                echo '<tr class="iwjmb-field">';
                                                echo '<th class="iwjmb-label"><label>'.__( 'Featured Job Duration', 'iwjob' ).'</label></th>';
                                                echo '<td>';
                                                $field = IWJMB_Field::call( 'normalize', $group['options']['featured_job_expiry'] );
                                                $meta = isset($settings[$field['id']]) ? $settings[$field['id']] : $field['std'];
                                                echo IWJMB_Field::call( $field, 'input', $meta );
                                                $field = IWJMB_Field::call( 'normalize', $group['options']['featured_job_expiry_unit'] );
                                                $meta = isset($settings[$field['id']]) ? $settings[$field['id']] : $field['std'];
                                                echo IWJMB_Field::call( $field, 'input', $meta );
                                                echo '</td>';
                                                echo '</tr>';
                                            }elseif(!$field_key || ($field_key && !in_array($field_key, array('job_expiry', 'job_expiry_unit', 'featured_job_expiry', 'featured_job_expiry_unit', '')))){
                                                $field = IWJMB_Field::call( 'normalize', $field );
                                                $meta = isset($settings[$field['id']]) ? $settings[$field['id']] : $field['std'];
                                                IWJMB_Field::input($field, $meta );
                                            }
                                        }
                                    }else{
                                        foreach ($group['options'] as $field){
                                            $field = IWJMB_Field::call( 'normalize', $field );
                                            $meta = isset($settings[$field['id']]) ? $settings[$field['id']] : $field['std'];
                                            if ( $field['clone'] || $field['multiple'] ) {
                                                if ( empty( $meta ) || ! is_array( $meta ) ) {
                                                    /**
                                                     * Note: if field is clonable, $meta must be an array with values
                                                     * so that the foreach loop in self::show() runs properly
                                                     *
                                                     * @see self::show()
                                                     */
                                                    $meta = $field['clone'] ? array( '' ) : array();
                                                }
                                            }
                                            IWJMB_Field::input($field, $meta );
                                        }
                                    }
                                }

                                if($accordion){
                                    echo '</table></div>';
                                }
                            }
                            if(!$accordion) {
                                echo '</table>';
                            }else{
                                echo '</div>';
                            }
                        }
                        echo '</div>';
                    }
                }
            ?>
            </div>
            <?php wp_nonce_field( 'iwj-save-settings', 'iwj-security' ); ?>

            <p class="submit">
                <button type="submit" class="button button-primary"><?php echo __('Save Changes', 'iwjob') ; ?></button>
                <button type="button" class="button iwj-reset-settings"><?php echo __('Reset Default', 'iwjob') ; ?></button>
            </p>
            </form>
        </div>
        </div>
    <?php
    }

    static function save_settings(){
        $settings = get_option('iwj_settings', array());
        $new_settings = array();
        $plugin_settings = apply_filters('iwj_plugin_settings', array());
        if($plugin_settings) {
            foreach ($plugin_settings AS $tab => $tab_settings) {
                if (isset($tab_settings['callback']) && $tab_settings['callback']) {
                    continue;
                } else {
                    foreach ($tab_settings['options'] as $group) {
                        if (isset($group['callback']) && $group['callback']) {
                            continue;
                        } else {
                            foreach ($group['options'] as $field) {
                                $field = IWJMB_Field::call( 'normalize', $field );
                                if($field['disabled']){
                                    continue;
                                }
                                $single = $field['clone'] || !$field['multiple'];
                                $old = isset($settings[$field['id']]) ? $settings[$field['id']] : ($single ? '' : array()) ;
                                $new    = isset( $_POST[ $field['id'] ] ) ? $_POST[ $field['id'] ] : ( $single ? '' : array() );

                                // Allow field class change the value
                                if ( $field['clone'] ) {
                                    $new = IWJMB_Clone::value( $new, $old, 0, $field );
                                } else {
                                    $new = IWJMB_Field::call( $field, 'value', $new, $old, 0 );
                                    $new = IWJMB_Field::call( $field, 'sanitize_value', $new);
                                }
                                if(is_array($new)){
                                    $new = iwj_stripslashes($new);
                                }else{
                                    $new = stripslashes($new);
                                }
                                $new_settings[$field['id']] = $new;
                            }
                        }
                    }
                }
            }
        }

        //save applies
        $applies = IWJ()->applies->applies();
        if($applies){
            foreach ($applies as $apply){
                $admin_option_fields = $apply->admin_option_fields();
                if($admin_option_fields){
                    if(is_array($admin_option_fields)) {
                        foreach ($admin_option_fields as $field) {
                            $field['id'] = 'apply_' . $apply->id . '_' . $field['id'];
                            $field = IWJMB_Field::call('normalize', $field);
                            if($field['disabled']){
                                continue;
                            }
                            $single = $field['clone'] || !$field['multiple'];
                            $old = isset($settings[$field['id']]) ? $settings[$field['id']] : ($single ? '' : array());
                            $new = isset($_POST[$field['id']]) ? $_POST[$field['id']] : ($single ? '' : array());
                            if ($field['clone']) {
                                $new = IWJMB_Clone::value($new, $old, 0, $field);
                            } else {
                                $new = IWJMB_Field::call($field, 'value', $new, $old, 0);
                                $new = IWJMB_Field::call($field, 'sanitize_value', $new);
                            }

                            if (is_array($new)) {
                                $new = array_map('stripslashes', $new);
                            } else {
                                $new = stripslashes($new);
                            }

                            $new_settings[$field['id']] = $new;
                        }
                    }else{
                        $new_settings = $apply->admin_saved_fields($new_settings);
                    }
                }
            }
        }

        // save payment gateways
        $payment_gateways = IWJ()->payment_gateways->payment_gateways();
        if($payment_gateways){
            foreach ($payment_gateways as $payment_gateway){
                $admin_option_fields = $payment_gateway->admin_option_fields();
                if($admin_option_fields){
                    if(is_array($admin_option_fields)) {
                        foreach ($admin_option_fields as $field) {
                            $field['id'] = 'gateway_' . $payment_gateway->id . '_' . $field['id'];
                            $field = IWJMB_Field::call('normalize', $field);
                            if($field['disabled']){
                                continue;
                            }
                            $single = $field['clone'] || !$field['multiple'];
                            $old = isset($settings[$field['id']]) ? $settings[$field['id']] : ($single ? '' : array());
                            $new = isset($_POST[$field['id']]) ? $_POST[$field['id']] : ($single ? '' : array());
                            if ($field['clone']) {
                                $new = IWJMB_Clone::value($new, $old, 0, $field);
                            } else {
                                $new = IWJMB_Field::call($field, 'value', $new, $old, 0);
                                $new = IWJMB_Field::call($field, 'sanitize_value', $new);
                            }

                            if (is_array($new)) {
                                $new = array_map('stripslashes', $new);
                            } else {
                                $new = stripslashes($new);
                            }

                            $new_settings[$field['id']] = $new;
                        }
                    }else{
                        $new_settings = $payment_gateway->admin_saved_fields($new_settings);
                    }
                }
            }
        }

        // save socials
        $socials = IWJ()->social_logins->social_logins();
        if($socials){
            foreach ($socials as $social){
                $admin_option_fields = $social->admin_option_fields();
                if($admin_option_fields){
                    if(is_array($admin_option_fields)) {
                        foreach ($admin_option_fields as $field){
                            $field['id'] = 'social_'.$social->id.'_'.$field['id'];
                            $field = IWJMB_Field::call( 'normalize', $field );
                            if($field['disabled']){
                                continue;
                            }
                            $single = $field['clone'] || !$field['multiple'];
                            $old = isset($settings[$field['id']]) ? $settings[$field['id']] : ($single ? '' : array()) ;
                            $new    = isset( $_POST[ $field['id'] ] ) ? $_POST[ $field['id'] ] : ( $single ? '' : array() );
                            if ( $field['clone'] ) {
                                $new = IWJMB_Clone::value( $new, $old, 0, $field );
                            } else {
                                $new = IWJMB_Field::call( $field, 'value', $new, $old, 0 );
                                $new = IWJMB_Field::call( $field, 'sanitize_value', $new);
                            }

                            if(is_array($new)){
                                $new = array_map('stripslashes', $new);
                            }else{
                                $new = stripslashes($new);
                            }
                            $new_settings[$field['id']] = $new;
                        }
                    }else{
                        $new_settings = $social->admin_saved_fields($new_settings);
                    }
                }
            }
        }

        $new_settings = apply_filters('iwj_save_settings', $new_settings, $settings);
        update_option('iwj_settings', $new_settings);

        /*if(defined('ICL_LANGUAGE_CODE')){
            global $sitepress;
            if(ICL_LANGUAGE_CODE != $sitepress->get_default_language()){
                update_option('iwj_settings_'.ICL_LANGUAGE_CODE, $new_settings);
            }else{
                update_option('iwj_settings', $new_settings);
            }
        }else{
            update_option('iwj_settings', $new_settings);
        }*/

        IWJ_Post_Types::register_post_types();
        flush_rewrite_rules();
    }
}

IWJ_Admin_Setting::init();