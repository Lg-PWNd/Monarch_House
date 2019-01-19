<?php
/*
  Plugin Name: Inwave Common Version InJob
  Plugin URI: http://inwavethemes.com
  Description: Includes advanced addon elements for Visual Composer, Custom post type, ...
  Version: 2.9.0
  Author: Inwavethemes
  Author URI: http://www.inwavethemes.com
  License: GNU General Public License v2 or later
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

define('INWAVE_COMMON_VERSION', '2.9.0');
define('INWAVE_COMMON', plugin_dir_path( __FILE__ ));

// translate plugin
load_plugin_textdomain('inwave-common', false, dirname(plugin_basename(__FILE__)) . '/languages/');

//include files
require_once INWAVE_COMMON .'inc/helper.php';
require_once INWAVE_COMMON .'custom-post-type/post-type.php';
require_once INWAVE_COMMON .'inc/shortcode.class.php';

if(!function_exists('inwave_initialize_cmb_meta_boxes')){
    add_action( 'init', 'inwave_initialize_cmb_meta_boxes', 9999 );
    /**
     * Initialize the metabox class.
     */
    function inwave_initialize_cmb_meta_boxes() {
        if ( ! class_exists( 'inwave_CMB_Meta_Box' ) )
            require_once INWAVE_COMMON .'inc/metaboxes/init.php';
    }
}

if(!function_exists('more_faq_ajax')){
    function more_faq_ajax() {

        $ppp  = ( isset( $_POST["ppp"] ) ) ? $_POST["ppp"] : 1;
        $page = ( isset( $_POST['pageNumber'] ) ) ? $_POST['pageNumber'] : 0;

        header( "Content-Type: text/html" );

        $args = array(
            'suppress_filters' => true,
            'post_type' => 'faq',
            'post_status' => 'publish',
            'posts_per_page' => $ppp,
            'paged' => $page
        );

        $query = new WP_Query($args);


        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
            ?>
            <div class="iw-accordion-item panel panel-default">
                <div class="iw-accordion-header panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo get_the_ID(); ?>"><?php the_title();?></a>
                </div>
                <div id="<?php echo get_the_ID(); ?>" class="iw-accordion-content panel-collapse collapse">
                    <div class="panel-body iw-desc"><?php the_content();?></div>
                </div>
            </div>

        <?php
        endwhile;
        endif;
        wp_reset_postdata();
    }

    add_action( 'wp_ajax_nopriv_more_faq_ajax', 'more_faq_ajax' );
    add_action( 'wp_ajax_more_faq_ajax', 'more_faq_ajax' );
}