<?php
/*Register VC Jobs*/
if (!class_exists('Inwave_Register_VC_Login')) {
    function Inwave_Register_VC_Login() {
        if (class_exists('Vc_Manager')) {
            global $wpdb;
            vc_map(array(
                'name' => __('Login Page', 'inwave-common'),
                'description' => __('Using for Login Page', 'inwave-common'),
                'base' => 'iwj_login',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "textarea",
                        "heading" => __("Pre Text", "inwavethemes"),
                        "param_name" => "pre_text",
                        "std" => "",
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Login');
}

if (!class_exists('Inwave_Register_VC_Register')) {
    function Inwave_Register_VC_Register() {
        if (class_exists('Vc_Manager')) {
            global $wpdb;
            vc_map(array(
                'name' => __('Register Page', 'inwave-common'),
                'description' => __('Using for Register Page', 'inwave-common'),
                'base' => 'iwj_register',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Register');
}

if (!class_exists('Inwave_Register_VC_Verify_Account')) {
    function Inwave_Register_VC_Verify_Account() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Verify Account', 'inwave-common'),
                'base' => 'iwj_verify_account',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Verify_Account');
}


if (!class_exists('Inwave_Register_VC_Jobs')) {
    function Inwave_Register_VC_Jobs() {
        if (class_exists('Vc_Manager')) {
            global $wpdb;

            vc_map(array(
                'name' => __('Jobs Page', 'inwave-common'),
                'description' => __('Using for Jobs Page', 'inwave-common'),
                'base' => 'iwj_jobs',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Jobs');
}

if (!class_exists('Inwave_Register_VC_Jobs_Carousel')) {
    function Inwave_Register_VC_Jobs_Carousel() {
        if (class_exists('Vc_Manager')) {

            $fields = array(
                array(
                    "type" => "dropdown",
                    "admin_label" => true,
                    "heading" => "Style",
                    "param_name" => "style",
                    "value" => array(
                        "Style 1" => "style1",
                        "Style 2" => "style2",
                        "Style 3" => "style3"
                    )
                ),
                array(
                    "type" => "iwevent_preview_image",
                    "heading" => __("Preview Style", 'inwave-common'),
                    "param_name" => "preview_style_1",
                    "value" => get_template_directory_uri() . '/assets/images/shortcodes/job-carousel-1.png',
                    "dependency" => array('element' => 'style', 'value' => 'style1')
                ),
                array(
                    "type" => "iwevent_preview_image",
                    "heading" => __("Preview Style", 'inwave-common'),
                    "param_name" => "preview_style_2",
                    "value" => get_template_directory_uri() . '/assets/images/shortcodes/job-carousel-2.png',
                    "dependency" => array('element' => 'style', 'value' => 'style2')
                ),
                array(
                    "type" => "iwevent_preview_image",
                    "heading" => __("Preview Style", 'inwave-common'),
                    "param_name" => "preview_style_3",
                    "value" => get_template_directory_uri() . '/assets/images/shortcodes/job-carousel-3.png',
                    "dependency" => array('element' => 'style', 'value' => 'style3')
                ),
                array(
                    'type' => 'textfield',
                    "admin_label" => true,
                    "heading" => __("Title Block", 'inwave-common'),
                    "description" => "",
                    "value" => "Featured jobs",
                    "param_name" => "title_block",
                    "dependency" => array('element' => 'style', 'value' => array('style2', 'style3'))
                ),
                array(
                    "type" => "dropdown",
                    "admin_label" => true,
                    "heading" => "Filter Jobs",
                    "param_name" => "filter",
                    "value" => array(
                        "Any Jobs" => "any",
                        "Only Featured" => "featured",
                        "Recommend By Candidate Profile" => "recommend",
                    )
                ),
            );

            $taxonomies_filter = array(
                "Categories" => "cat",
                "Types" => "type",
                "Levels" => "level",
                "Skills" => "skill",
                "Locations" => "location",
                "Salaries" => "salary",
            );

            if(function_exists('iwj_option')){
                if(iwj_option('disable_type')){
                    unset($taxonomies_filter['Types']);
                }
                if(iwj_option('disable_level')){
                    unset($taxonomies_filter['Levels']);
                }
                if(iwj_option('disable_skill')){
                    unset($taxonomies_filter['Skills']);
                }
            }

            $fields[] = array(
                "type"        => "checkbox",
                "admin_label" => true,
                "heading"     => "Filter by taxonomies",
                "param_name"  => "taxonomies_filter",
                "value"       => $taxonomies_filter
            );

            $fields[] = array(
                'type' => 'autocomplete',
                'heading' => __( 'Categories', 'iwjob' ),
                'param_name' => 'cat',
                'settings' => array(
                    'multiple' => true,
                    'min_length' => 1,
                    'groups' => true,
                    // In UI show results grouped by groups, default false
                    'unique_values' => true,
                    // In UI show results except selected. NB! You should manually check values in backend, default false
                    'display_inline' => true,
                    // In UI show results inline view, default false (each value in own line)
                    'delay' => 500,
                    // delay for search. default 500
                    'auto_focus' => true,
                    // auto focus input, default true
                ),
                'param_holder_class' => 'vc_not-for-custom',
                "dependency" => array('element' => 'taxonomies_filter', 'value' => 'cat')
            );
            if(function_exists('iwj_option')){
                if(!iwj_option('disable_type')){
                    $fields[] = array(
                        'type' => 'autocomplete',
                        'heading' => __( 'Types', 'iwjob' ),
                        'param_name' => 'type',
                        'settings' => array(
                            'multiple' => true,
                            'min_length' => 1,
                            'groups' => true,
                            // In UI show results grouped by groups, default false
                            'unique_values' => true,
                            // In UI show results except selected. NB! You should manually check values in backend, default false
                            'display_inline' => true,
                            // In UI show results inline view, default false (each value in own line)
                            'delay' => 500,
                            // delay for search. default 500
                            'auto_focus' => true,
                            // auto focus input, default true
                        ),
                        'param_holder_class' => 'vc_not-for-custom',
                        "dependency" => array('element' => 'taxonomies_filter', 'value' => 'type')
                    );
                }
                if(!iwj_option('disable_level')){
                    $fields[] = array(
                        'type' => 'autocomplete',
                        'heading' => __( 'Levels', 'iwjob' ),
                        'param_name' => 'level',
                        'settings' => array(
                            'multiple' => true,
                            'min_length' => 1,
                            'groups' => true,
                            // In UI show results grouped by groups, default false
                            'unique_values' => true,
                            // In UI show results except selected. NB! You should manually check values in backend, default false
                            'display_inline' => true,
                            // In UI show results inline view, default false (each value in own line)
                            'delay' => 500,
                            // delay for search. default 500
                            'auto_focus' => true,
                            // auto focus input, default true
                        ),
                        'param_holder_class' => 'vc_not-for-custom',
                        "dependency" => array('element' => 'taxonomies_filter', 'value' => 'level')
                    );
                }

                if(!iwj_option('disable_skill')){
                    $fields[] = array(
                        'type' => 'autocomplete',
                        'heading' => __( 'Skills', 'iwjob' ),
                        'param_name' => 'skill',
                        'settings' => array(
                            'multiple' => true,
                            'min_length' => 1,
                            'groups' => true,
                            // In UI show results grouped by groups, default false
                            'unique_values' => true,
                            // In UI show results except selected. NB! You should manually check values in backend, default false
                            'display_inline' => true,
                            // In UI show results inline view, default false (each value in own line)
                            'delay' => 500,
                            // delay for search. default 500
                            'auto_focus' => true,
                            // auto focus input, default true
                        ),
                        'param_holder_class' => 'vc_not-for-custom',
                        "dependency" => array('element' => 'taxonomies_filter', 'value' => 'skill')
                    );
                }
            }

            $fields[] = array(
                'type' => 'autocomplete',
                'heading' => __( 'Locations', 'iwjob' ),
                'param_name' => 'location',
                'settings' => array(
                    'multiple' => true,
                    'min_length' => 1,
                    'groups' => true,
                    // In UI show results grouped by groups, default false
                    'unique_values' => true,
                    // In UI show results except selected. NB! You should manually check values in backend, default false
                    'display_inline' => true,
                    // In UI show results inline view, default false (each value in own line)
                    'delay' => 500,
                    // delay for search. default 500
                    'auto_focus' => true,
                    // auto focus input, default true
                ),
                'param_holder_class' => 'vc_not-for-custom',
                "dependency" => array('element' => 'taxonomies_filter', 'value' => 'location')
            );

            $fields[] = array(
                'type' => 'autocomplete',
                'heading' => __( 'Salaries', 'iwjob' ),
                'param_name' => 'salary',
                'settings' => array(
                    'multiple' => true,
                    'min_length' => 1,
                    'groups' => true,
                    // In UI show results grouped by groups, default false
                    'unique_values' => true,
                    // In UI show results except selected. NB! You should manually check values in backend, default false
                    'display_inline' => true,
                    // In UI show results inline view, default false (each value in own line)
                    'delay' => 500,
                    // delay for search. default 500
                    'auto_focus' => true,
                    // auto focus input, default true
                ),
                'param_holder_class' => 'vc_not-for-custom',
                "dependency" => array('element' => 'taxonomies_filter', 'value' => 'salary')
            );

            $fields = array_merge($fields, array(
                array(
                    "type" => "textfield",
                    "heading" => __("Include Ids", 'inwave-common'),
                    "description" => __('Separator by comma', 'inwave-common'),
                    "param_name" => "include_ids",
                    "value" => '',
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Exclude Ids", 'inwave-common'),
                    "description" => __('Separator by comma', 'inwave-common'),
                    "param_name" => "exclude_ids",
                    "value" => '',
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Order By', 'inwave-common' ),
                    'param_name' => 'order_by',
                    "value" => array(
                        "Date" => "date",
                        "Title" => "title",
                        "Modified" => "modified",
                        "Salary" => "salary",
                        "Featured" => "featured",
                        "Random" => "rand",
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Order', 'inwave-common' ),
                    'param_name' => 'order',
                    "value" => array(
                        "DESC" => "DESC",
                        "ASC" => "ASC",
                    ),
                    "dependency" => array('element' => 'order_by', 'value' => array('title', 'date', 'modified'))
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Limit", 'inwave-common'),
                    "description" => __('Accepts -1 (all) or any positive number.', 'inwave-common'),
                    "param_name" => "limit",
                    "value" => '12',
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Jobs per page", 'inwave-common'),
                    "param_name" => "jobs_per_page",
                    "value" => '6',
                    "dependency" => array('element' => 'style', 'value' => array('style1', 'style2'))
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Extra Class", 'inwave-common'),
                    "param_name" => "class",
                    "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                ),
            ));

            vc_map(array(
                'name' => __('Jobs List With Carousel', 'inwave-common'),
                'base' => 'iwj_jobs_carousel',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => $fields
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Jobs_Carousel');
}

if (!class_exists('Inwave_Register_VC_Jobs_List')) {
    function Inwave_Register_VC_Jobs_List() {
        if (class_exists('Vc_Manager')) {
            $args         = array(
                'pad_counts'         => 1,
                'show_counts'        => 1,
                'hierarchical'       => 1,
                'hide_empty'         => 1,
                'show_uncategorized' => 1,
                'orderby'            => 'name',
                'menu_order'         => false
            );

			$fields = array(
                array(
                    "type" => "dropdown",
                    "admin_label" => true,
                    "heading" => "Style",
                    "param_name" => "style",
                    "value" => array(
                        "Style 1" => "style1",
                        "Style 2" => "style2",
                        "Style 3" => "style3",
                    )
                ),
                array(
                    "type" => "iwevent_preview_image",
                    "heading" => __("Preview Style", 'inwave-common'),
                    "param_name" => "preview_style_1",
                    "value" => get_template_directory_uri() . '/assets/images/shortcodes/job-list-style1.png',
                    "dependency" => array('element' => 'style', 'value' => 'style1')
                ),
                array(
                    "type" => "iwevent_preview_image",
                    "heading" => __("Preview Style", 'inwave-common'),
                    "param_name" => "preview_style_2",
                    "value" => get_template_directory_uri() . '/assets/images/shortcodes/job-list-style2.png',
                    "dependency" => array('element' => 'style', 'value' => 'style2')
                ),
                array(
                    "type" => "iwevent_preview_image",
                    "heading" => __("Preview Style", 'inwave-common'),
                    "param_name" => "preview_style_3",
                    "value" => get_template_directory_uri() . '/assets/images/shortcodes/job-list-style3.png',
                    "dependency" => array('element' => 'style', 'value' => 'style3')
                ),
                array(
                    "type"        => "dropdown",
                    "admin_label" => true,
                    "heading"     => "Filter Jobs",
                    "param_name"  => "filter",
                    "value"       => array(
                        "Any Job"       => "any",
                        "Only Featured" => "featured",
                        "Recommend By Candidate Profile" => "recommend",
                    )
                ),
            );

            $taxonomies_filter = array(
                "Categories" => "cat",
                "Types" => "type",
                "Levels" => "level",
                "Skills" => "skill",
                "Locations" => "location",
                "Salaries" => "salary",
            );

            if(function_exists('iwj_option')){
                if(iwj_option('disable_type')){
                    unset($taxonomies_filter['Types']);
                }
                if(iwj_option('disable_level')){
                    unset($taxonomies_filter['Levels']);
                }
                if(iwj_option('disable_skill')){
                    unset($taxonomies_filter['Skills']);
                }
            }

            $fields[] = array(
                "type"        => "checkbox",
                "admin_label" => true,
                "heading"     => "Filter by taxonomies",
                "param_name"  => "taxonomies_filter",
                "value"       => $taxonomies_filter
            );

            $fields[] = array(
                'type' => 'autocomplete',
                'heading' => __( 'Categories', 'iwjob' ),
                'param_name' => 'cat',
                'settings' => array(
                    'multiple' => true,
                    'min_length' => 1,
                    'groups' => true,
                    // In UI show results grouped by groups, default false
                    'unique_values' => true,
                    // In UI show results except selected. NB! You should manually check values in backend, default false
                    'display_inline' => true,
                    // In UI show results inline view, default false (each value in own line)
                    'delay' => 500,
                    // delay for search. default 500
                    'auto_focus' => true,
                    // auto focus input, default true
                ),
                'param_holder_class' => 'vc_not-for-custom',
                "dependency" => array('element' => 'taxonomies_filter', 'value' => 'cat')
            );
            if(function_exists('iwj_option')){
                if(!iwj_option('disable_type')){
                    $fields[] = array(
                        'type' => 'autocomplete',
                        'heading' => __( 'Types', 'iwjob' ),
                        'param_name' => 'type',
                        'settings' => array(
                            'multiple' => true,
                            'min_length' => 1,
                            'groups' => true,
                            // In UI show results grouped by groups, default false
                            'unique_values' => true,
                            // In UI show results except selected. NB! You should manually check values in backend, default false
                            'display_inline' => true,
                            // In UI show results inline view, default false (each value in own line)
                            'delay' => 500,
                            // delay for search. default 500
                            'auto_focus' => true,
                            // auto focus input, default true
                        ),
                        'param_holder_class' => 'vc_not-for-custom',
                        "dependency" => array('element' => 'taxonomies_filter', 'value' => 'type')
                    );
                }
                if(!iwj_option('disable_level')){
                    $fields[] = array(
                        'type' => 'autocomplete',
                        'heading' => __( 'Levels', 'iwjob' ),
                        'param_name' => 'level',
                        'settings' => array(
                            'multiple' => true,
                            'min_length' => 1,
                            'groups' => true,
                            // In UI show results grouped by groups, default false
                            'unique_values' => true,
                            // In UI show results except selected. NB! You should manually check values in backend, default false
                            'display_inline' => true,
                            // In UI show results inline view, default false (each value in own line)
                            'delay' => 500,
                            // delay for search. default 500
                            'auto_focus' => true,
                            // auto focus input, default true
                        ),
                        'param_holder_class' => 'vc_not-for-custom',
                        "dependency" => array('element' => 'taxonomies_filter', 'value' => 'level')
                    );
                }
                if(!iwj_option('disable_skill')){
                    $fields[] = array(
                        'type' => 'autocomplete',
                        'heading' => __( 'Skills', 'iwjob' ),
                        'param_name' => 'skill',
                        'settings' => array(
                            'multiple' => true,
                            'min_length' => 1,
                            'groups' => true,
                            // In UI show results grouped by groups, default false
                            'unique_values' => true,
                            // In UI show results except selected. NB! You should manually check values in backend, default false
                            'display_inline' => true,
                            // In UI show results inline view, default false (each value in own line)
                            'delay' => 500,
                            // delay for search. default 500
                            'auto_focus' => true,
                            // auto focus input, default true
                        ),
                        'param_holder_class' => 'vc_not-for-custom',
                        "dependency" => array('element' => 'taxonomies_filter', 'value' => 'skill')
                    );
                }
            }
            $fields[] = array(
                'type' => 'autocomplete',
                'heading' => __( 'Locations', 'iwjob' ),
                'param_name' => 'location',
                'settings' => array(
                    'multiple' => true,
                    'min_length' => 1,
                    'groups' => true,
                    // In UI show results grouped by groups, default false
                    'unique_values' => true,
                    // In UI show results except selected. NB! You should manually check values in backend, default false
                    'display_inline' => true,
                    // In UI show results inline view, default false (each value in own line)
                    'delay' => 500,
                    // delay for search. default 500
                    'auto_focus' => true,
                    // auto focus input, default true
                ),
                'param_holder_class' => 'vc_not-for-custom',
                "dependency" => array('element' => 'taxonomies_filter', 'value' => 'location')
            );

            $fields[] = array(
                'type' => 'autocomplete',
                'heading' => __( 'Salaries', 'iwjob' ),
                'param_name' => 'salary',
                'settings' => array(
                    'multiple' => true,
                    'min_length' => 1,
                    'groups' => true,
                    // In UI show results grouped by groups, default false
                    'unique_values' => true,
                    // In UI show results except selected. NB! You should manually check values in backend, default false
                    'display_inline' => true,
                    // In UI show results inline view, default false (each value in own line)
                    'delay' => 500,
                    // delay for search. default 500
                    'auto_focus' => true,
                    // auto focus input, default true
                ),
                'param_holder_class' => 'vc_not-for-custom',
                "dependency" => array('element' => 'taxonomies_filter', 'value' => 'salary')
            );

            $fields = array_merge($fields, array(
                array(
                    "type" => "textfield",
                    "heading" => __("Include Ids", 'inwave-common'),
                    "description" => __('Separator by comma', 'inwave-common'),
                    "param_name" => "include_ids",
                    "value" => '',
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Exclude Ids", 'inwave-common'),
                    "description" => __('Separator by comma', 'inwave-common'),
                    "param_name" => "exclude_ids",
                    "value" => '',
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Order By', 'inwave-common' ),
                    'param_name' => 'order_by',
                    "value" => array(
                        "Date" => "date",
                        "Title" => "title",
                        "Modified" => "modified",
                        "Salary" => "salary",
                        "Featured" => "featured",
                        "Random" => "rand",
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Order', 'inwave-common' ),
                    'param_name' => 'order',
                    "value" => array(
                        "DESC" => "DESC",
                        "ASC" => "ASC",
                    ),
                    "dependency" => array('element' => 'order_by', 'value' => array('title', 'date', 'modified'))
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Limit", 'inwave-common'),
                    "description" => __('Accepts -1 (all) or any positive number.', 'inwave-common'),
                    "param_name" => "limit",
                    "value" => '12',
                ),
                array(
                    "type" => "dropdown",
	                "heading" => __("Show Load More", 'inwave-common'),
	                "param_name" => "show_load_more",
	                "value" => array(
		                "Yes" => "1",
		                "No" => "0",
	                ),
	                "std" => "0"
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Extra Class", 'inwave-common'),
                    "param_name" => "class",
                    "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                ),
            ));

            vc_map(array(
                'name' => __('Jobs List', 'inwave-common'),
                'base' => 'iwj_jobs_list',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => $fields
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Jobs_List');
}

if (!class_exists('Inwave_Register_VC_Find_Jobs')) {
    function Inwave_Register_VC_Find_Jobs() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Find Jobs', 'inwave-common'),
                'base' => 'iwj_find_jobs',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "heading" => "Button style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1" => "style1",
                            "Style 2" => "style2",
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Limit Keyword", 'inwave-common'),
                        "description" => __('Accepts 0 (all) or any positive number.', 'inwave-common'),
                        "param_name" => "limit_keyword",
                        "value" => '10',
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Find_Jobs');
}

if (!class_exists('Inwave_Register_VC_Advanced_Search')) {
    function Inwave_Register_VC_Advanced_Search() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Advanced Search Jobs - Black', 'inwave-common'),
                'base' => 'iwj_advanced_search',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Advanced_Search');
}

if (!class_exists('Inwave_Register_VC_Advanced_Search_White')) {
    function Inwave_Register_VC_Advanced_Search_White() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Advanced Search Jobs - White', 'inwave-common'),
                'base' => 'iwj_advanced_search_white',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Advanced_Search_White');
}

if (!class_exists('Inwave_Register_VC_Advanced_Search_With_Radius')) {
    function Inwave_Register_VC_Advanced_Search_With_Radius() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Advanced Search Radius', 'inwave-common'),
                'base' => 'iwj_advanced_search_with_radius',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "heading" => "Unit",
                        "param_name" => "unit",
                        "value" => array(
                            "Kilometers" => "Km",
                            "Miles" => "Miles",
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Min Radius", 'inwave-common'),
                        "param_name" => "min_radius",
                        "value" => "15",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Max Radius", 'inwave-common'),
                        "param_name" => "max_radius",
                        "value" => "100",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Default Radius", 'inwave-common'),
                        "param_name" => "default_radius",
                        "value" => "40",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Advanced_Search_With_Radius');
}

if (!class_exists('Inwave_Register_VC_Candidates')) {
    function Inwave_Register_VC_Candidates() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Candidates Page', 'inwave-common'),
                'description' => __('Using for Candidates Page', 'inwave-common'),
                'base' => 'iwj_candidates',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Candidates');
}

if (!class_exists('Inwave_Register_VC_Advanced_Search_Candidates')) {
    function Inwave_Register_VC_Advanced_Search_Candidates() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Advanced Search Candidates', 'inwave-common'),
                'base' => 'iwj_advanced_search_candidates',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Advanced_Search_Candidates');
}

if (!class_exists('Inwave_Register_VC_Recent_Resumes')) {
    function Inwave_Register_VC_Recent_Resumes() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Recent Resumes', 'inwave-common'),
                'base' => 'iwj_recent_resumes',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Limit", 'inwave-common'),
                        "description" => __('Accepts -1 (all) or any positive number.', 'inwave-common'),
                        "param_name" => "limit",
                        "value" => '12',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Add candidate id you want show its", 'inwave-common'),
                        "description" => __('Separated by commas', 'inwave-common'),
                        "param_name" => "candidate_ids",
                        "value" => '',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Recent_Resumes');
}

if (!class_exists('Inwave_Register_VC_Employers')) {
    function Inwave_Register_VC_Employers() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Employers Page', 'inwave-common'),
                'description' => __('Using for Employers Page', 'inwave-common'),
                'base' => 'iwj_employers',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Employers');
}

if (!class_exists('Inwave_Register_Employers_Slider')) {
    function Inwave_Register_Employers_Slider() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Employers List With Carousel', 'inwave-common'),
                'base' => 'iwj_employers_slider',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "heading" => "Button style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1" => "style1",
                            "Style 2" => "style2",
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        "admin_label" => true,
                        "heading" => __("Title Block", 'inwave-common'),
                        "description" => "",
                        "value" => "Featured Employer",
                        "param_name" => "title_block",
                        "dependency" => array('element' => 'style', 'value' => 'style2')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Employer IDs", 'inwave-common'),
                        "description" => __('Separated by commas', 'inwave-common'),
                        "param_name" => "employer_ids",
                        "value" => '',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Exclude IDs", 'inwave-common'),
                        "description" => __('Separated by commas', 'inwave-common'),
                        "param_name" => "exclude_ids",
                        "value" => '',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Limit", 'inwave-common'),
                        "description" => __('Number of employers', 'inwave-common'),
                        "param_name" => "limit",
                        "value" => '',
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Hide Empty", 'inwave-common'),
                        "description" => __('Hide employers who do not have jobs', 'inwave-common'),
                        "param_name" => "hide_empty",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0',
                        )
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Order By', 'inwave-common' ),
                        'param_name' => 'order_by',
                        "value" => array(
                            "Name" => "name",
                            "Count" => "count",
                            "Date" => "date",
                            "Custom [Category IDs]" => "custom",
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Order', 'inwave-common' ),
                        'param_name' => 'order',
                        "value" => array(
                            "DESC" => "DESC",
                            "ASC" => "ASC",
                        ),
                        "dependency" => array('element' => 'order_by', 'value' => array('name', 'date', 'count'))
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Employers Per Slider", 'inwave-common'),
                        "description" => __('Number of employers per a slider', 'inwave-common'),
                        "param_name" => "employers_per_slider",
                        "value" => '8',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("AutoPlay Slider", 'inwave-common'),
                        "param_name" => "auto_play",
                        "value" => array(
                            'No' => '0',
                            'Yes' => '1'
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_Employers_Slider');
}

if (!class_exists('Inwave_Register_VC_Categories')) {
    function Inwave_Register_VC_Categories() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Categories', 'inwave-common'),
                'base' => 'iwj_categories',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "heading" => "Select Style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1" => "style1",
                            "Style 2" => "style2",
                            "Style 3" => "style3",
                            "Style 4" => "style4",
                            "Style 5" => "style5",
                            "Style 6" => "style6",
                            "Style 7" => "style7",
                            "Style 8" => "style8",
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Categories per row", 'inwave-common'),
                        "param_name" => "cats_per_row",
                        "value" => '3',
                        "dependency" => array('element' => 'style', 'value' => array('style1', 'style2', 'style3', 'style4', 'style5', 'style6', 'style7'))
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Category IDs", 'inwave-common'),
                        "description" => __("Separated by commas", 'inwave-common'),
                        "param_name" => "cat_ids",
                        "value" => '',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Exclude Categories', 'inwave-common' ),
                        "description" => __("Separated by commas", 'inwave-common'),
                        'param_name' => 'exclude_ids',
                        'value' => '',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Hide Empty', 'inwave-common' ),
                        'param_name' => 'hide_empty',
                        "value" => array(
                            "No" => "0",
                            "Yes" => "1",
                        ),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Limit", 'inwave-common'),
                        "param_name" => "limit",
                        "value" => '',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Order By', 'inwave-common' ),
                        'param_name' => 'order_by',
                        "value" => array(
                            "Name" => "name",
                            "ID" => "term_id",
                            "Count" => "count",
                            "Custom [Category IDs]" => "custom",
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Order', 'inwave-common' ),
                        'param_name' => 'order',
                        "value" => array(
                            "DESC" => "DESC",
                            "ASC" => "ASC",
                        ),
                        "dependency" => array('element' => 'order_by', 'value' => array('name', 'term_id', 'count'))
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Show All Categories Button', 'inwave-common' ),
                        'param_name' => 'show_categories_btn',
                        "value" => array(
                            "No" => "0",
                            "Yes" => "1",
                        ),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Link to view all categories", 'inwave-common'),
                        "param_name" => "link_all_cats",
                        "value" => '#',
                        "dependency" => array('element' => 'show_categories_btn', 'value' => '1')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Text link to view all categories", 'inwave-common'),
                        "param_name" => "text_link_all_cats",
                        "value" => 'All Categories',
                        "dependency" => array('element' => 'show_categories_btn', 'value' => '1')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Categories');
}

if (!class_exists('Inwave_Register_VC_Pricing_Tables')) {
    function Inwave_Register_VC_Pricing_Tables() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Pricing Tables', 'inwave-common'),
                'base' => 'iwj_pricing_tables',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Hide Free Package', 'inwave-common' ),
                        'param_name' => 'hide_free_package',
                        "value" => array(
                            "Yes" => "1",
                            "No" => "0",
                        ),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Pricing_Tables');
}

if (!class_exists('Inwave_Register_VC_Recommend_ADV')) {
    function Inwave_Register_VC_Recommend_ADV() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Recommend ADV', 'inwave-common'),
                'base' => 'iwj_recommend_adv',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Title", 'inwave-common'),
                        "description" => "",
                        "param_name" => "title",
                        "value" => '',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }

    add_action('init', 'Inwave_Register_VC_Recommend_ADV');
}

if (!class_exists('Inwave_Register_VC_Jobs_Suggestion')){
    function Inwave_Register_VC_Jobs_Suggestion() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Jobs List Suggestion', 'inwave-common'),
                'base' => 'iwj_jobs_suggestion',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "admin_label" => true,
                        "heading" => "Filter Jobs",
                        "param_name" => "filter",
                        "value" => array(
                            "Any Jobs" => "any",
                            "Only Featured" => "featured",
                            "Recommend By Candidate Profile" => "recommend",
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Include Ids", 'inwave-common'),
                        "description" => __('Separator by comma', 'inwave-common'),
                        "param_name" => "include_ids",
                        "value" => '',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Exclude Ids", 'inwave-common'),
                        "description" => __('Separator by comma', 'inwave-common'),
                        "param_name" => "exclude_ids",
                        "value" => '',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Order By', 'inwave-common' ),
                        'param_name' => 'order_by',
                        "value" => array(
                            "Date" => "date",
                            "Title" => "title",
                            "Modified" => "modified",
                            "Random" => "rand",
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Order', 'inwave-common' ),
                        'param_name' => 'order',
                        "value" => array(
                            "DESC" => "DESC",
                            "ASC" => "ASC",
                        ),
                        "dependency" => array('element' => 'order_by', 'value' => array('title', 'date', 'modified'))
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Limit", 'inwave-common'),
                        "description" => __('Accepts -1 (all) or any positive number.', 'inwave-common'),
                        "param_name" => "limit",
                        "value" => '12',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }
    add_action('init', 'Inwave_Register_VC_Jobs_Suggestion');
}

if (!class_exists('Inwave_Register_VC_Candidates_Suggestion')){
    function Inwave_Register_VC_Candidates_Suggestion() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Candidates List Suggestion', 'inwave-common'),
                'base' => 'iwj_candidates_suggestion',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "admin_label" => true,
                        "heading" => "Filter Candidates",
                        "param_name" => "filter",
                        "value" => array(
                            "Any Candidates" => "any",
                            "Recommend By Candidate Profile" => "recommend",
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "admin_label" => true,
                        "heading" => "Number candidate on row",
                        "param_name" => "candidate_on_row",
                        "value" => array(
                            "2" => "2",
                            "3" => "3",
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Include Ids", 'inwave-common'),
                        "description" => __('Separator by comma', 'inwave-common'),
                        "param_name" => "include_ids",
                        "value" => '',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Exclude Ids", 'inwave-common'),
                        "description" => __('Separator by comma', 'inwave-common'),
                        "param_name" => "exclude_ids",
                        "value" => '',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Order By', 'inwave-common' ),
                        'param_name' => 'order_by',
                        "value" => array(
                            "Date" => "date",
                            "Title" => "title",
                            "Modified" => "modified",
                            "Random" => "rand",
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Order', 'inwave-common' ),
                        'param_name' => 'order',
                        "value" => array(
                            "DESC" => "DESC",
                            "ASC" => "ASC",
                        ),
                        "dependency" => array('element' => 'order_by', 'value' => array('title', 'date', 'modified'))
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Limit", 'inwave-common'),
                        "description" => __('Accepts -1 (all) or any positive number.', 'inwave-common'),
                        "param_name" => "limit",
                        "value" => '12',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    ),
                )
            ));
        }
    }
    add_action('init', 'Inwave_Register_VC_Candidates_Suggestion');
}

if (!class_exists('Inwave_Register_VC_Search_Map')){
    function Inwave_Register_VC_Search_Map() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Search Jobs With Map', 'inwave-common'),
                'base' => 'iwj_search_map',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "attach_image",
                        "heading" => __("Marker Icon", 'inwave-common'),
                        "param_name" => "marker_icon",
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Marker Icon hover", 'inwave-common'),
                        "param_name" => "marker_icon_hover",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Default Latitude", 'inwave-common'),
                        "admin_label" => true,
                        "param_name" => "latitude",
                        "value" => "",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Default Longitude", 'inwave-common'),
                        "admin_label" => true,
                        "param_name" => "longitude",
                        "value" => "",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Default Zoom", 'inwave-common'),
                        "param_name" => "zoom",
                        "value" => "",
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => "Unit",
                        "param_name" => "unit",
                        "value" => array(
                            "Kilometers" => "Km",
                            "Miles" => "Miles",
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Min Radius", 'inwave-common'),
                        "param_name" => "min_radius",
                        "value" => "15",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Max Radius", 'inwave-common'),
                        "param_name" => "max_radius",
                        "value" => "100",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Default Radius", 'inwave-common'),
                        "param_name" => "default_radius",
                        "value" => "40",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    )
                )
            ));
        }
    }
    add_action('init', 'Inwave_Register_VC_Search_Map');
}

if (!class_exists('Inwave_Register_VC_Find_Map')){
    function Inwave_Register_VC_Find_Map() {
        if (class_exists('Vc_Manager')) {

            vc_map(array(
                'name' => __('Simple Search Jobs With Map', 'inwave-common'),
                'base' => 'inwave_map_find_job',
                'category' => 'Plugin Jobs',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "attach_image",
                        "heading" => __("Marker Icon", 'inwave-common'),
                        "param_name" => "marker_icon",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Default Latitude", 'inwave-common'),
                        "admin_label" => true,
                        "param_name" => "latitude",
                        "value" => "51.5130703",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Default Longitude", 'inwave-common'),
                        "admin_label" => true,
                        "param_name" => "longitude",
                        "value" => "-0.117941",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Default Zoom", 'inwave-common'),
                        "param_name" => "zoom",
                        "value" => "11",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Map height", 'inwave-common'),
                        "param_name" => "height",
                        "value" => "400",
                        "description"=> __("Example: 400(in px) or 100vh", 'inwave-common'),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Limit Keyword Form Find Jobs", 'inwave-common'),
                        "param_name" => "limit_keyword",
                        "value" => "6",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Limit Item Jobs Show On Map", 'inwave-common'),
                        "param_name" => "limit_find_job",
                        "value" => "-1",
                        "description"=> __("Add numbers items you want show on map OR show all items : add - 1", 'inwave-common'),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Find Jobs Style", 'inwave-common'),
                        "param_name" => "style",
                        "value" => array(
                            "Light" => "style1",
                            "Dark" => "style2",
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", 'inwave-common'),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common')
                    )
                )
            ));
        }
    }
    add_action('init', 'Inwave_Register_VC_Find_Map');
}

if ( ! class_exists( 'Inwave_Register_VC_Jobs_Indeed' ) ) {
    function Inwave_Register_VC_Jobs_Indeed() {
        if ( class_exists( 'Vc_Manager' ) ) {

			$ide_publisher_id = get_option( 'iwj_ide_publisher_id', '' );
			vc_map( array(
				'name'     => __( 'Jobs Indeed', 'inwave-common' ),
				'base'     => 'iwj_jobs_indeed',
				'category' => 'Plugin Jobs',
				'icon'     => 'iw-default',
				'params'   => array(
					array(
						"type" => "dropdown",
						"admin_label" => true,
						"heading" => "Style",
						"param_name" => "style",
						"value" => array(
							"Style 1" => "style1",
							"Style 2" => "style2",
							"Style 3" => "style3",
						)
					),
					array(
						"type" => "iwevent_preview_image",
						"heading" => __("Preview Style", 'inwave-common'),
						"param_name" => "preview_style_1",
						"value" => get_template_directory_uri() . '/assets/images/shortcodes/job-list-style1.png',
						"dependency" => array('element' => 'style', 'value' => 'style1')
					),
					array(
						"type" => "iwevent_preview_image",
						"heading" => __("Preview Style", 'inwave-common'),
						"param_name" => "preview_style_2",
						"value" => get_template_directory_uri() . '/assets/images/shortcodes/job-list-style2.png',
						"dependency" => array('element' => 'style', 'value' => 'style2')
					),
					array(
						"type" => "iwevent_preview_image",
						"heading" => __("Preview Style", 'inwave-common'),
						"param_name" => "preview_style_3",
						"value" => get_template_directory_uri() . '/assets/images/shortcodes/job-list-style3.png',
						"dependency" => array('element' => 'style', 'value' => 'style3')
					),
					array(
						"type"        => "textfield",
						"admin_label" => true,
						"heading"     => __( 'Publisher ID', "inwave-common" ),
						"param_name"  => "ide_publisher_id",
						"value"       => $ide_publisher_id,
						'description' => __( 'Your Publisher ID from indeed. Don\'t you have such a key? <a href="https://ads.indeed.com/jobroll/signup" target="_blank">Request one here</a>', 'inwave-common' ),
					),
					array(
						"type"        => "textfield",
						"admin_label" => true,
						"heading"     => __( 'Query', "inwave-common" ),
						"param_name"  => "ide_query",
						"value"       => __( 'wordpress', 'inwave-common' ),
						"description" => __( 'Enter terms to search for by default. By default terms are ANDed. Search for multiple terms at once by using the "or" keyword between each keyword.', 'inwave-common' ),
					),
					array(
						'param_name' => 'ide_country',
						'heading'    => __( 'Country', 'inwave-common' ),
						'type'       => 'dropdown',
						'value'      => function_exists('iwj_get_country_keys') ? iwj_get_country_keys() : '',
						'description' => __('Details country ISO codes <a href="https://countrycode.org/">here</a>', 'iwjob'),
					),
					array(
						'type'       => 'textfield',
						'heading'    => __( 'Location', 'inwave-common' ),
						'param_name' => 'ide_location',
						'value'      => '',
						'description'     => __( 'Use a postal code or a "city, state/province/region" combination.', 'iwjob' ),
					),
					array(
						'param_name'  => 'ide_job_type',
						'heading'     => __( 'Job Type', 'inwave-common' ),
						'type'        => 'dropdown',
						'admin_label' => true,
						'value'       => array(
							__( 'Any', 'inwave-common' )  => '',
							__( 'Full time', 'inwave-common' )  => 'fulltime',
							__( 'Part time', 'inwave-common' )  => 'parttime',
							__( 'Contract', 'inwave-common' )   => 'contract',
							__( 'Internship', 'inwave-common' ) => 'internship',
							__( 'Temporary', 'inwave-common' )  => 'temporary',
						),
					),
					array(
						"type"        => "attach_image",
						"class"       => "",
						"heading"     => __( "Logo Company", "inwave-common" ),
						"param_name"  => "ide_logo_company",
						"value"       => "",
						"description" => __( "Default company logo.", "inwave-common" ),
 					),
					array(
						'param_name' => 'ide_from_item',
						'heading'    => __( 'Show From Item', 'inwave-common' ),
						'type'       => 'textfield',
						'value'      => __( '1', 'inwave-common' ),
					),
					array(
						'param_name' => 'ide_max_item',
						'heading'    => __( 'Show Items', 'inwave-common' ),
						'type'       => 'textfield',
						'value'      => __( '10', 'inwave-common' ),
					),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Show filter bar', 'inwave-common' ),
                        'param_name' => 'show_filter_bar',
                        "value" => array(
                            "No"  => "0",
                            "Yes" => "1",
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Show load more', 'inwave-common' ),
                        'param_name' => 'show_load_more',
                        "value" => array(
                            "No"  => "0",
                            "Yes" => "1",
                        ),
                    ),
					array(
						"type"        => "textfield",
						"heading"     => __( "Extra Class", 'inwave-common' ),
						"param_name"  => "class",
						"description" => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'inwave-common' )
					),
				)
			) );
		}
	}

    add_action( 'init', 'Inwave_Register_VC_Jobs_Indeed' );
}