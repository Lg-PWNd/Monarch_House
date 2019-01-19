<?php
if($employers){
wp_enqueue_style('owl-carousel');
wp_enqueue_style('owl-theme');
wp_enqueue_style('owl-transitions');
wp_enqueue_script('owl-carousel');
$style = $atts['style'];
?>
    <?php
    switch ($style) {
        case 'style1':
            $data_plugin_options = array(
                "navigation"=>true,
                "autoHeight"=>true,
                "pagination"=>false,
                "autoPlay"=>($atts['auto_play'] ? true : false),
                "paginationNumbers"=>false,
                "singleItem"=>true,
                "navigationText" => array('<i class="ion-android-arrow-back"></i>', '<i class="ion-android-arrow-forward"></i>')
            );
            ?>
            <div class="iwj-employers-slider <?php echo $atts['class']; echo $atts['style']; ?>">
                <div class="iwj-employers-slider-inner">
                    <div class=" owl-carousel navigation-text-v1" data-plugin-options="<?php echo htmlspecialchars(json_encode($data_plugin_options)); ?>">
                        <div class="employer-items items-1">
                            <div class="row">
                                <?php
                                $item_per_slider = $atts['employers_per_slider'] ? $atts['employers_per_slider'] : 8;
                                $item_class =  'col-md-3 col-sm-6 col-xs-12';
                                if($item_per_slider == '1'){
                                    $item_class =  'col-md-12 col-sm-12 col-xs-12';
                                }elseif($item_per_slider == '2'){
                                    $item_class =  'col-md-6 col-sm-6 col-xs-12';
                                }elseif($item_per_slider == '3'){
                                    $item_class =  'col-md-4 col-sm-6 col-xs-12';
                                }elseif($item_per_slider == '4'){
                                    $item_class =  'col-md-3 col-sm-6 col-xs-12';
                                }elseif($item_per_slider == '6'){
                                    $item_class =  'col-md-4 col-sm-6 col-xs-12';
                                }

                                $i = 0;
                                $number_item = 12 % $item_per_slider;
                                foreach ($employers as $employer) :
                                    $clear = '';
                                    if(($i > 0) && ($item_per_slider >= 5) && $number_item != 0) {
                                        if($i % $number_item == 0){
                                            $clear = " clear";
                                        }
                                    }
                                    $total_jobs = $employer->total_jobs;
                                    $employer = IWJ_Employer::get_employer($employer);
                                    $author = $employer->get_author();

                                    $image = iwj_get_avatar( $author->get_id());
                                    if($i > 0 && count($employers) > $i && $i % $item_per_slider == 0){
                                        echo '</div>
                                </div>
                                <div class="employer-items items-'.($i+1).'">
                                <div class="row">';
                                    }
                                    ?>
                                    <div class="<?php echo $item_class; echo $clear; ?>">
                                        <div class="employer-item">
                                            <div class="employer-image"><a href="<?php echo $author->permalink(); ?>"><?php echo $image; ?></a></div>
                                            <h3 class="employer-title"><a href="<?php echo $author->permalink(); ?>"><?php echo $author->get_display_name(); ?></a></h3>
                                            <div class="employer-locations"><?php echo $employer->get_locations_links(); ?></div>
                                            <a class="total-jobs" href="<?php echo $author->permalink(); ?>"><strong class="number"><?php echo $total_jobs; ?></strong> <?php echo _n('Open Position', 'Open Positions', $total_jobs, 'iwjob'); ?></a>
                                        </div>
                                    </div>
                                    <?php
                                    $i ++;
                                endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            break;

        case 'style2':
            $data_plugin_options = array(
                "navigation"=>true,
                "autoHeight"=>true,
                "pagination"=>false,
                "autoPlay"=>($atts['auto_play'] ? true : false),
                "paginationNumbers"=>false,
                "singleItem"=>true,
                "navigationText" => array('<i class="ion-android-arrow-back"></i>', '<i class="ion-android-arrow-forward"></i>')
            );
            ?>
            <div class="iwj-employers-slider <?php echo $atts['class']; echo $atts['style']; ?>">
                <div class="title-block-carousel"><?php
                    $title = $atts['title_block'] ? $atts['title_block'] : 'Employers';
                    _e($title, 'iwjob'); ?>
                </div>
                <div class="iwj-employers-slider-inner">
                    <div class=" owl-carousel navigation-text-v2" data-plugin-options="<?php echo htmlspecialchars(json_encode($data_plugin_options)); ?>">
                        <?php
                        $i = 0;
                        foreach ($employers as $employer) :
                            $total_jobs = $employer->total_jobs;
                            $employer = IWJ_Employer::get_employer($employer);
                            $author = $employer->get_author();

                            $image = iwj_get_avatar( $author->get_id());
                            ?>
                            <div class="employer-item">
                                <div class="employer-image"><a href="<?php echo $author->permalink(); ?>"><?php echo $image; ?></a></div>
                                <h3 class="employer-title"><a href="<?php echo $author->permalink(); ?>"><?php echo $author->get_display_name(); ?></a></h3>
                                <div class="employer-locations"><?php echo $employer->get_locations_links(); ?></div>
                                <?php
                                $average_rate = IWJ_Reviews::get_average_rate( $employer->get_id() );
                                if ( count( $average_rate ) ) { ?>
                                    <div class="iwj-box-rating">
										<div class="iwj-count-rate" title="<?php esc_attr_e( $average_rate['average'], 'iwjob' ); ?>">
											<?php echo IWJ_Reviews::get_number_stars( $average_rate['average'] ); ?>
										</div>
										<div class="iwj-text-totals-rate">
											<?php echo sprintf(_n('rating %d', 'ratings %d',  $average_rate['totals'], 'iwjob'), $average_rate['totals']); ?>
										</div>
                                    </div>
                                <?php } ?>
                                <a class="total-jobs" href="<?php echo $author->permalink(); ?>"><strong class="number"><?php echo $total_jobs; ?></strong> <?php echo _n('Open Position', 'Open Positions', $total_jobs, 'iwjob'); ?></a>
                            </div>
                            <?php
                            $i ++;
                        endforeach; ?>
                    </div>
                </div>
            </div>
    <?php
    break;
    }
    ?>

<?php } ?>