<?php
/*
 * Register post type Faq
*/
function inwave_post_type_faq()
{

    $labels = array(
        'name' 					=> __('Faq', 'bolder'),
        'singular_name' 		=> __('Faq', 'bolder'),
        'add_new' 				=> __('Add New', 'bolder'),
        'all_items' 			=> __('All Faqs', 'bolder'),
        'add_new_item' 			=> __('Add New Faq', 'bolder'),
        'edit_item' 			=> __('Edit Faq', 'bolder'),
        'new_item' 				=> __('New Faq', 'bolder'),
        'view_item' 			=> __('View Faq', 'bolder'),
        'search_items' 			=> __('Search Faq', 'bolder'),
        'not_found' 			=> __('No Faq Found', 'bolder'),
        'not_found_in_trash' 	=> __('No Faq Found in Trash', 'bolder'),
        'parent_item_colon' 	=> '',
    );

    global $inwave_theme_option;

    $args = array(
        'labels' 			=> $labels,
        'public' 			=> true,
        'show_ui' 			=> true,
        'capability_type' 	=> 'post',
        'taxonomies'        => array( 'faq_cats', ),
        'hierarchical' 		=> false,
        'rewrite' 			=> array('slug' => (isset($inwave_theme_option['faq_slug']) && $inwave_theme_option['faq_slug']) ? $inwave_theme_option['faq_slug'] : 'faq', 'with_front' => true),
        'query_var' 		=> true,
        'show_in_nav_menus' => true,
        'has_archive'          => true,
        'menu_icon' 		=> 'dashicons-list-view',
        'supports' 			=> array('title', 'editor', 'author'),
    );

    register_post_type( 'faq' , $args );
    register_taxonomy('faq_cats',
        array('faq'),
        array(
            'hierarchical' 		=> true,
            'public'            => true,
            'label' 			=> 'Faq Categories',
            'show_admin_column'	=>'true',
            'singular_label' 	=> 'Category',
            'query_var' 		=> true,
            'rewrite'           => array(
                'slug'                       => 'faq-category',
                'with_front'                 => true,
                'hierarchical'               => false,
            ),
        )
    );
}

/**
 * Adds the meta box container.
 */



function save($post_id) {
    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    /* @var $_POST type */
    if (!isset($_POST['inf_post_metabox_nonce'])) {
        return $post_id;
    }

    $nonce = $_POST['inf_post_metabox_nonce'];

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($nonce, 'inf_post_metabox')) {
        return $post_id;
    }

    // If this is an autosave, our form has not been submitted,
    //     so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Check the user's permissions.
    $post_type = $_POST['post_type'];
    if ('page' == $post_type) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }

    /* OK, its safe for us to save the data now. */
}
add_action('init', 'inwave_post_type_faq');
add_action('save_post', 'save');


?>