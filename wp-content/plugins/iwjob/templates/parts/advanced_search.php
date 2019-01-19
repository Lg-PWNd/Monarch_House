<?php
extract($atts);
$keyword = isset($_GET['keyword']) ? sanitize_text_field($_GET['keyword']) : '';
$show_advanced_search = false;
?>
<form action="<?php echo iwj_get_page_permalink('jobs'); ?>" class="iw-job-advanced_search">
    <div class="content-search in-page-heading">
        <div class="section-filter filter-advance">
            <?php do_action('iwj_before_advanced_search_jobs'); ?>
            <div class="default-fields">
                <div class="row">
                    <?php do_action('iwj_before_advanced_search_jobs_default_fields'); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="filter-item">
                            <input class="form-control keywords" type="text" name="keyword" placeholder="<?php echo __('Enter Keywords', 'iwjob'); ?>" value="<?php echo $keyword; ?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="filter-item">
                            <select class="default-sorting iwj-select-2 form-control"  name="iwj_cat">
                                <option value="" selected="selected"><?php echo __("Choose category", 'iwjob') ?></option>
                                <?php
                                $category_request = IWJ_Job_Listing::get_request_taxonomies('iwj_cat');
                                $category_value = $category_request ? $category_request[0] : '';
                                $terms_cat = get_terms( array(
                                    'taxonomy' => 'iwj_cat',
                                    'hide_empty' => false,
                                ) );
                                foreach($terms_cat as $cat) {
                                    echo '<option value="'.esc_attr( $cat->slug ).'" '.selected($category_value, $cat->term_id, false).'>'.$cat->name.'</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <?php do_action('iwj_after_advanced_search_jobs_default_fields'); ?>
                </div>
            </div>
            <div class="advanced-fields <?php echo !$show_advanced_search ? 'hide' : ''; ?>">
                <div class="row">
                    <?php do_action('iwj_before_advanced_search_jobs_adv_fields'); ?>
                    <?php if(!iwj_option( 'disable_type' )){ ?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="filter-item">
                                <select class="default-sorting iwj-select-2 form-control"  name="iwj_type" >
                                    <option value="" selected="selected"><?php echo __("Choose job type", 'iwjob') ?></option>
                                    <?php
                                    $type_request = IWJ_Job_Listing::get_request_taxonomies('iwj_type');
                                    $type_value = $type_request ? $type_request[0] : '';
                                    $terms_type = get_terms( array(
                                        'taxonomy' => 'iwj_type',
                                        'hide_empty' => false,
                                    ) );
                                    foreach( $terms_type as $type ) {
                                        echo '<option value="'.esc_attr( $type->slug ).'" '.selected($type_value, $type->term_id, false).'>'.$type->name.'</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="filter-item">
                            <select class="default-sorting iwj-select-2 form-control"  name="iwj_location">
                                <option value="" selected="selected"><?php echo __("Choose Location", 'iwjob') ?></option>
                                <?php
                                $location_request = IWJ_Job_Listing::get_request_taxonomies('iwj_location');
                                $location_value = $location_request ? $location_request[0] : '';
                                $terms_location = get_terms( array(
                                    'taxonomy' => 'iwj_location',
                                    'hide_empty' => false,
                                ) );
                                foreach( $terms_location as $location ) {
                                    echo '<option value="'.esc_attr( $location->slug ).'" '.selected($location_value, $location->term_id, false).'>'.$location->name.'</option>';
                                } ?>
                            </select>
                        </div>
                    </div>

                    <?php if(!iwj_option( 'disable_level' )){?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="filter-item">
                                <select class="default-sorting iwj-select-2 form-control"  name="iwj_level">
                                    <option value="" selected="selected"><?php echo __("Choose level", 'iwjob') ?></option>
                                    <?php
                                    $level_request = IWJ_Job_Listing::get_request_taxonomies('iwj_level');
                                    $level_value = $level_request ? $level_request[0] : '';
                                    $terms_level = get_terms( array(
                                        'taxonomy' => 'iwj_level',
                                        'hide_empty' => false,
                                    ) );
                                    foreach( $terms_level as $level ) {
                                        echo '<option value="'.esc_attr( $level->slug ).'" '.selected($level_value, $level->term_id, false).'>'.$level->name.'</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="filter-item">
                            <select class="default-sorting iwj-select-2 form-control"  name="iwj_salary">
                                <option value="" selected="selected"><?php echo __("Choose salary", 'iwjob') ?></option>
                                <?php
                                $salary_request = IWJ_Job_Listing::get_request_taxonomies('iwj_salary');
                                $salary_value = $salary_request ? $salary_request[0] : '';
                                $terms_salary = get_terms( array(
                                    'taxonomy' => 'iwj_salary',
                                    'hide_empty' => false,
                                ) );
                                foreach( $terms_salary as $salary ) {
                                    echo '<option value="'.esc_attr( $salary->slug ).'" '.selected($salary_value, $salary->term_id, false).'>'.$salary->name.'</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <?php do_action('iwj_after_advanced_search_jobs_adv_fields'); ?>
                </div>
            </div>
            <?php do_action('iwj_before_advanced_search_jobs_submit_btn'); ?>
            <div class="clearfix"></div>
            <div class="bottom-section-filter">
                <div class="action-search pull-right">
                    <span class="hide-advance show-hide-search <?php echo $show_advanced_search ? 'active' : ''; ?>"><?php echo $show_advanced_search ? __("Hide advance search", 'iwjob') : __("Show advance search", 'iwjob') ?></span>
                    <button type="submit" class="btn-search btn"><i class="ion-search"></i></button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</form>
