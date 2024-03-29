<?php
/**
 *
 * Creating a custom job search form for homepage
 * The [jobs] shortcode is will use search_location and search_keywords variables from the query string.
 *
 * @link https://wpjobmanager.com/document/tutorial-creating-custom-job-search-form/
 *
 * @package robojob lite
 * @since Robojob 1.0.0
 */
$robojob_lite_theme_options = robojob_lite_options();
$find_a_job_link = $robojob_lite_theme_options['find_a_job_link'];
?>

<div class="job_listings">

  <form class="job_filters" method="GET" action="<?php echo esc_url( home_url( '/' ) ); ?><?php echo esc_attr($find_a_job_link);?>">
    <div class="search_jobs">

      <div class="search_keywords">
        <label for="search_keywords"><?php esc_html_e( 'Keywords', 'robojob-lite' ); ?></label>
        <input type="text" id="search_keywords" name="search_keywords" placeholder="<?php esc_attr_e( 'Keywords', 'robojob-lite' ); ?>">
      </div>

      <div class="search_location">
        <label for="search_location"><?php esc_html_e( 'All Location', 'robojob-lite' ); ?></label>
        <input type="text"  id="search_location" name="search_location" placeholder="<?php esc_attr_e( 'Location', 'robojob-lite' ); ?>">
      </div>

      <div class="search_categories custom_search_categories">
        <label for="search_category"><?php esc_attr_e( 'Job Category', 'robojob-lite' ); ?></label>
        <select id="search_category" class="robo-search-category" name="search_category">
          <?php foreach ( get_job_listing_categories() as $cat ) : ?>
            <option value="<?php echo esc_attr( $cat->term_id ); ?>"><?php echo esc_html( $cat->name ); ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="search_submit">
        <input type="submit" value="Search" />
      </div>

    </div>
  </form>

</div>
<script type='text/javascript'>
/* <![CDATA[ */
  //Chosen - Custom Form
  //document.getElementById("search_category").chosen();
/* ]]> */
</script>
