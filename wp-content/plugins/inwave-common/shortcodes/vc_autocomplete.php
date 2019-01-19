<?php
Class Inwave_VC_Autocomplete{
    static function init(){
        add_filter( 'vc_autocomplete_iwj_jobs_carousel_cat_callback', array(__CLASS__, 'vc_autocomplete_taxonomies_field_search'), 10, 3 );
        add_filter( 'vc_autocomplete_iwj_jobs_carousel_cat_render', array(__CLASS__, 'vc_autocomplete_taxonomies_field_render'), 10, 1 );

        add_filter( 'vc_autocomplete_iwj_jobs_carousel_type_callback', array(__CLASS__, 'vc_autocomplete_taxonomies_field_search'), 10, 3 );
        add_filter( 'vc_autocomplete_iwj_jobs_carousel_type_render', array(__CLASS__, 'vc_autocomplete_taxonomies_field_render'), 10, 1 );

        add_filter( 'vc_autocomplete_iwj_jobs_carousel_level_callback', array(__CLASS__, 'vc_autocomplete_taxonomies_field_search'), 10, 3 );
        add_filter( 'vc_autocomplete_iwj_jobs_carousel_level_render', array(__CLASS__, 'vc_autocomplete_taxonomies_field_render'), 10, 1 );

        add_filter( 'vc_autocomplete_iwj_jobs_carousel_skill_callback', array(__CLASS__, 'vc_autocomplete_taxonomies_field_search'), 10, 3 );
        add_filter( 'vc_autocomplete_iwj_jobs_carousel_skill_render', array(__CLASS__, 'vc_autocomplete_taxonomies_field_render'), 10, 1 );

        add_filter( 'vc_autocomplete_iwj_jobs_carousel_location_callback', array(__CLASS__, 'vc_autocomplete_taxonomies_field_search'), 10, 3 );
        add_filter( 'vc_autocomplete_iwj_jobs_carousel_location_render', array(__CLASS__, 'vc_autocomplete_taxonomies_field_render'), 10, 1 );

        add_filter( 'vc_autocomplete_iwj_jobs_carousel_salary_callback', array(__CLASS__, 'vc_autocomplete_taxonomies_field_search'), 10, 3 );
        add_filter( 'vc_autocomplete_iwj_jobs_carousel_salary_render', array(__CLASS__, 'vc_autocomplete_taxonomies_field_render'), 10, 1 );


        add_filter( 'vc_autocomplete_iwj_jobs_list_cat_callback', array(__CLASS__, 'vc_autocomplete_taxonomies_field_search'), 10, 3 );
        add_filter( 'vc_autocomplete_iwj_jobs_list_cat_render', array(__CLASS__, 'vc_autocomplete_taxonomies_field_render'), 10, 1 );

        add_filter( 'vc_autocomplete_iwj_jobs_list_type_callback', array(__CLASS__, 'vc_autocomplete_taxonomies_field_search'), 10, 3 );
        add_filter( 'vc_autocomplete_iwj_jobs_list_type_render', array(__CLASS__, 'vc_autocomplete_taxonomies_field_render'), 10, 1 );

        add_filter( 'vc_autocomplete_iwj_jobs_list_level_callback', array(__CLASS__, 'vc_autocomplete_taxonomies_field_search'), 10, 3 );
        add_filter( 'vc_autocomplete_iwj_jobs_list_level_render', array(__CLASS__, 'vc_autocomplete_taxonomies_field_render'), 10, 1 );

        add_filter( 'vc_autocomplete_iwj_jobs_list_skill_callback', array(__CLASS__, 'vc_autocomplete_taxonomies_field_search'), 10, 3 );
        add_filter( 'vc_autocomplete_iwj_jobs_list_skill_render', array(__CLASS__, 'vc_autocomplete_taxonomies_field_render'), 10, 1 );

        add_filter( 'vc_autocomplete_iwj_jobs_list_location_callback', array(__CLASS__, 'vc_autocomplete_taxonomies_field_search'), 10, 3 );
        add_filter( 'vc_autocomplete_iwj_jobs_list_location_render', array(__CLASS__, 'vc_autocomplete_taxonomies_field_render'), 10, 1 );

        add_filter( 'vc_autocomplete_iwj_jobs_list_salary_callback', array(__CLASS__, 'vc_autocomplete_taxonomies_field_search'), 10, 3 );
        add_filter( 'vc_autocomplete_iwj_jobs_list_salary_render', array(__CLASS__, 'vc_autocomplete_taxonomies_field_render'), 10, 1 );


    }

    static function vc_autocomplete_taxonomies_field_render($term){
        $taxonomy_names = get_object_taxonomies( 'iwj_job' );
        $terms = get_terms( $taxonomy_names, array(
            'include' => array( $term['value'] ),
            'hide_empty' => false,
        ) );
        $data = false;
        if ( is_array( $terms ) && 1 === count( $terms ) ) {
            $term = $terms[0];
            $data = vc_get_term_object( $term );
        }

        return $data;
    }

    static function vc_autocomplete_taxonomies_field_search($search_string, $tag, $params ) {
        $data = array();
        $vc_taxonomies = get_terms( "iwj_".$params, array(
            'hide_empty' => false,
            'search' => $search_string,
        ) );
        if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
            foreach ( $vc_taxonomies as $t ) {
                if ( is_object( $t ) ) {
                    $data[] = vc_get_term_object( $t );
                }
            }
        }

        return $data;
    }
}

Inwave_VC_Autocomplete::init();