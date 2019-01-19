<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category ARIVA
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'inwave_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function inwave_metaboxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'inwave_';

    $sideBars = array();
    foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
        $sideBars[$sidebar['id']] = ucwords( $sidebar['name'] );
    }

    $menuArr = array();
    $menuArr[''] = 'Default';
    $menus = get_terms('nav_menu');
    foreach ( $menus as $menu ) {
        $menuArr[$menu->slug] = $menu->name;
    }

    /**
     * Metabox to be displayed on a single page ID
     */
    if((isset($_GET['post']) && $_GET['post'] != get_option( 'page_for_posts' )) || !isset($_GET['post'])){
        $meta_boxes['page_metas'] = array(
            'id'         => 'page_metas',
            'title'      => esc_html__( 'Page Options', 'injob' ),
            'pages'      => array( 'page' ), // Post type
            'context'    => 'side',
            'priority'   => 'low',
            'show_names' => true, // Show field names on the left
            'fields'     => array(
                array(
                    'name'    => esc_html__('Main Color', 'injob'),
                    'id'      => $prefix . 'main_color',
                    'type'    => 'colorpicker',
                    'default' => '',
                ),
                array(
                    'name'    => esc_html__('Background Color Page', 'injob'),
                    'id'      => $prefix . 'background_color_page',
                    'type'    => 'colorpicker',
                    'default' => '',
                ),
                array(
                    'name'    => esc_html__('Select Revolution  Slider', 'injob'),
                    'id'      => $prefix . 'slider',
                    'type'    => 'select',
                    'options' => Inwave_Helper::getRevoSlider(),
                    'default' => '',
                ),
                array(
                    'name'    => esc_html__( 'Show preload', 'injob' ),
                    'id'      => $prefix . 'show_preload',
                    'type'    => 'select',
                    'options' => array(
                        '' => esc_html__( 'Default', 'injob' ),
                        'yes'   => esc_html__( 'Yes', 'injob' ),
                        'no'     => esc_html__( 'No', 'injob' ),
                    ),
                ),
                array(
                    'name'    => esc_html__( 'Primary Menu', 'injob' ),
                    'id'      => $prefix . 'primary_menu',
                    'type'    => 'select',
                    'options' => $menuArr,
                ),
	            array(
		            'name'    => esc_html__( 'Show Page For', 'injob' ),
		            'id'      => $prefix . 'public_page',
		            'type'    => 'select',
		            'default' => '',
		            'options' => array(
			            '' => esc_html__( 'Anyone', 'injob' ),
			            'no'  => esc_html__( 'Only Users Registered', 'injob' ),
		            ),
	            ),
                array(
                    'name' => esc_html__( 'Extra class', 'injob' ),
                    'desc' => esc_html__( 'Add extra class for page content', 'injob' ),
                    'default' => '',
                    'id' => $prefix . 'page_class',
                    'type' => 'text',
                ),
                array(
                    'name' => esc_html__( 'Header Options', 'injob' ),
                    'id'   => $prefix . 'header_options_title',
                    'type' => 'title',
                ),
                array(
                    'name'    => esc_html__( 'Header style', 'injob' ),
                    'id'      => $prefix . 'header_option',
                    'type'    => 'select',
                    'options' => array(
                        '' => esc_html__( 'Default', 'inmedical' ),
                        'none'   => esc_html__( 'None', 'inmedical' ),
                        'default'   => esc_html__( 'Header Style 1', 'injob' ),
                        'v2'     => esc_html__( 'Header Style 2', 'injob' ),
                        'v3'     => esc_html__( 'Header Style 3', 'injob' ),
                        'v4'     => esc_html__( 'Header Style 4', 'injob' ),
                        'v5'     => esc_html__( 'Header Style 5', 'injob' ),
                    ),
                ),
                array(
                    'name'    => esc_html__( 'Sticky Header', 'injob' ),
                    'id'      => $prefix . 'header_sticky',
                    'type'    => 'select',
                    'options' => array(
                        '' => esc_html__( 'Default', 'injob' ),
                        'yes'   => esc_html__( 'Yes', 'injob' ),
                        'no'     => esc_html__( 'No', 'injob' ),
                    ),
                ),
                array(
                    'name' => esc_html__( 'Change logo', 'injob' ),
                    'id'   => $prefix . 'logo',
                    'type' => 'file',
                ),
                array(
                    'name' => esc_html__( 'Change logo sticky', 'injob' ),
                    'id'   => $prefix . 'logo_sticky',
                    'type' => 'file',
                ),
                array(
                    'name' => esc_html__( 'Change logo mobile', 'injob' ),
                    'id'   => $prefix . 'logo_mobile',
                    'type' => 'file',
                ),
                array(
                    'name' => esc_html__( 'Buy Package URL', 'injob' ),
                    'id'   => $prefix . 'buy_service_url',
                    'type' => 'text',
                ),
                array(
                    'name' => esc_html__( 'Page Heading Options', 'injob' ),
                    'id'   => $prefix . 'page_heading_options_title',
                    'type' => 'title',
                ),
                array(
                    'name'    => esc_html__( 'Show page heading', 'injob' ),
                    'id'      => $prefix . 'show_pageheading',
                    'type'    => 'select',
                    'options' => array(
                        '' => esc_html__( 'Default', 'injob' ),
                        'yes'   => esc_html__( 'Yes', 'injob' ),
                        'no'     => esc_html__( 'No', 'injob' ),
                    ),
                ),
                array(
                    'name' => esc_html__( 'Page heading background image', 'injob' ),
                    'id'   => $prefix . 'pageheading_bg',
                    'type' => 'file',
                ),
                array(
                    'name' => esc_html__( 'Page heading background color', 'injob' ),
                    'id'   => $prefix . 'page_title_bg_color',
                    'type' => 'file',
                ),
                array(
                    'name'    => esc_html__( 'Show page breadcrumb', 'injob' ),
                    'id'      => $prefix . 'breadcrumbs',
                    'type'    => 'select',
                    'options' => array(
                        '' => esc_html__( 'Default', 'injob' ),
                        'yes'   => esc_html__( 'Yes', 'injob' ),
                        'no'     => esc_html__( 'No', 'injob' ),
                    ),
                ),
                array(
                    'name' => esc_html__( 'Sidebar Options', 'injob' ),
                    'id'   => $prefix . 'sidebar_options_title',
                    'type' => 'title',
                ),
                array(
                    'name'    => esc_html__( 'Sidebar Position', 'injob' ),
                    'id'      => $prefix . 'sidebar_position',
                    'type'    => 'select',
                    'options' => array(
                        '' => esc_html__( 'Default Theme Option', 'injob' ),
                        'none'   => esc_html__( 'Without Sidebar', 'injob' ),
                        'right'     => esc_html__( 'Right', 'injob' ),
                        'left'     => esc_html__( 'Left', 'injob' ),
                    ),
                ),
                array(
                    'name'    => esc_html__( 'Sidebar', 'injob' ),
                    'id'      => $prefix . 'sidebar_name',
                    'type'    => 'select',
                    'options' => $sideBars,
                ),
                array(
                    'name'    => esc_html__( 'Sidebar 2', 'injob' ),
                    'id'      => $prefix . 'sidebar_name_2',
                    'type'    => 'select',
                    'options' => $sideBars,
                ),
                array(
                    'name'    => esc_html__( 'Sticky Sidebar', 'injob' ),
                    'id'      => $prefix . 'sidebar_sticky',
                    'type'    => 'select',
                    'options' => array(
                        '1'   => esc_html__( 'Yes', 'injob' ),
                        '0'     => esc_html__( 'No', 'injob' ),
                    ),
                ),
            )
        );
    }

    $sideBars = array_merge(array('' => esc_html__('Default Theme Option', 'injob')), $sideBars);

    $meta_boxes['post_metas'] = array(
        'id'         => 'post_metas',
        'title'      => esc_html__( 'Post Options', 'injob' ),
        'pages'      => array( 'post' ), // Post type
        'context'    => 'side',
        'priority'   => 'low',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => esc_html__( 'Extra class', 'injob' ),
                'desc' => esc_html__( 'Add extra class for page content', 'injob' ),
                'default' => '',
                'id' => $prefix . 'page_class',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Heading image', 'injob' ),
                'desc' => esc_html__( 'If blank we will use the featured image.', 'injob' ),
                'id'   => $prefix . 'pageheading_bg',
                'type' => 'file',
            ),
            array(
                'name'    => esc_html__( 'Show Featured Image', 'injob' ),
                'id'      => $prefix . 'show_featured_image',
                'type'    => 'select',
                'options' => array(
                    'yes'   => esc_html__( 'Yes', 'injob' ),
                    'no'     => esc_html__( 'No', 'injob' ),
                ),
            ),
            array(
                'name'    => esc_html__( 'Sidebar Position', 'injob' ),
                'id'      => $prefix . 'sidebar_position',
                'type'    => 'select',
                'options' => array(
                    '' => esc_html__( 'Default Theme Option', 'injob' ),
                    'none'   => esc_html__( 'Without Sidebar', 'injob' ),
                    'right'     => esc_html__( 'Right', 'injob' ),
                    'left'     => esc_html__( 'Left', 'injob' ),
                ),
            ),
            array(
                'name'    => esc_html__( 'Sidebar', 'injob' ),
                'id'      => $prefix . 'sidebar_name',
                'type'    => 'select',
                'options' => $sideBars,
            ),
            array(
                'name'    => esc_html__( 'Sticky Sidebar', 'injob' ),
                'id'      => $prefix . 'sidebar_sticky',
                'type'    => 'select',
                'options' => array(
                    ''   => esc_html__( 'Default Theme Option', 'injob' ),
                    'yes'   => esc_html__( 'Yes', 'injob' ),
                    'no'     => esc_html__( 'No', 'injob' ),
                ),
            ),
        )
    );

    return $meta_boxes;
}