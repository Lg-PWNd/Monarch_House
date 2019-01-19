<?php if ($packages) {
    $sliderConfig = '{';
    $sliderConfig .= '"navigation":false';
    $sliderConfig .= ',"autoPlay":true';
    $sliderConfig .= ',"pagination":false';
    $sliderConfig .= ',"items":3';
    $sliderConfig .= ',"itemsDesktop":[1199,3]';
    $sliderConfig .= ',"itemsDesktopSmall":[991,2]';
    $sliderConfig .= ',"itemsTablet":[768,2]';
    $sliderConfig .= ',"itemsMobile":[540,1]';
    $sliderConfig .= '}';

    wp_enqueue_style('owl-carousel');
    wp_enqueue_style('owl-theme');
    wp_enqueue_style('owl-transitions');
    wp_enqueue_script('owl-carousel');

    ?>
    <div class="iwj-pricing-tables <?php echo $atts['class']; ?>">
        <div class="owl-carousel" data-plugin-options='<?php echo $sliderConfig; ?>'>
            <?php
            foreach ($packages as $package){
                $img_src = '';
                $thumbnail_id = get_post_thumbnail_id($package->get_id());
                if($thumbnail_id){
                    $image = wp_get_attachment_image_src($bg_image, 'full');
                    $img_src = count($image) ? $image[0] : '';
                }
                if (!$img_src) {
                    $img_src = IWJ_PLUGIN_URL.'/assets/img/package_bg.png';
                }

                $pricing_table_color = get_post_meta($package->get_id(), IWJ_PREFIX.'pricing_table_color', true);
                if(!$pricing_table_color){
                    $pricing_table_color = '#34495E';
                }

                $active = $package->is_active();

                echo '<div class="pricing-item '.($package->is_featured() ? 'featured-item' : '').' '.($active ? 'active-item' : '').'">';
                echo '<div class="item-top" style="background-image: url('.$img_src.')">';
                echo '<div class="item-top-bg" style=" background-color: '.$pricing_table_color.'"></div>';
                echo '<div class="item-top-content">';
                if($active){
                    echo '<span class="active-label">'.__('Active', 'iwjob').'</span>';
                }
                if ($package->is_featured()) {
                    echo '<div class="star"><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i></div>';
                }
                if ($package->get_sub_title()) {
                    echo '<div class="sub-title">'.$package->get_sub_title().'</div>';
                }
                if ($package->get_title()) {
                    echo '<h3 class="title"> '.$package->get_title().'</h3>';
                }
                if ($package->get_price()) {
                    echo '<div class="price"> '.iwj_system_price($package->get_price()).'</div>';
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="item-bottom">';
                $jobs = $package->get_number_job();
                $features = $package->get_number_featured_job();
                $renews = $package->get_number_renew_job();
                $max_cat = $package->get_max_categories();
                echo '<ul>';
                    echo '<li class="package-posting">'.sprintf(_n('<strong>%d</strong> Job posting', '<strong>%d</strong> Jobs posting', $jobs, 'iwjob'), $jobs).'</li>';
                    echo '<li class="package-features">'.sprintf(_n('<strong>%d</strong> Feature job', '<strong>%d</strong> Feature Jobs', $features, 'iwjob'), $features).'</li>';
                    echo '<li class="package-renews">'.sprintf(_n('<strong>%d</strong> Renew job', '<strong>%d</strong> Renew Jobs', $renews, 'iwjob'), $renews).'</li>';

                $unit = $package->get_job_expiry_unit();
                $expiry = $package->get_job_expiry();
                if ($expiry) {
                    echo '<li class="package-duration">';
                    switch ($unit){
                        case 'day':
                            echo sprintf(_n('<strong>%d</strong> Day duration', '<strong>%d</strong> Days duration', $expiry, 'iwjob'), $expiry);
                            break;
                        case 'month':
                            echo sprintf(_n('<strong>%d</strong> Month duration', '<strong>%d</strong> Months duration', $expiry, 'iwjob'), $expiry);
                            break;
                        case 'year':
                            echo sprintf(_n('<strong>%d</strong> Year duration', '<strong>%d</strong> Years duration', $expiry, 'iwjob'), $expiry);
                            break;
                    }
                    echo '</li>';
                }
                if($max_cat){
                    echo '<li class="package-categories">'.sprintf(_n('<strong>%d</strong> Category', '<strong>%d</strong> Categories', $max_cat, 'iwjob'), $max_cat).'</li>';
                }else{
                    echo '<li class="package-categories infinty">'.__('<strong class="ion-ios-infinite"></strong> Categories', 'iwjob').'</li>';
                }
                echo '</ul>';

                if($active){
                    echo '<a class="buy-now" href="'.$package->get_submit_job_url().'" style=" background-color: '.$pricing_table_color.'">'.__("Submit Now", 'iwjob').'</a>';
                }else{
                    if($package->is_free()){
                        echo '<a class="buy-now" href="'.$package->get_buy_url().'" style=" background-color: '.$pricing_table_color.'">'.__("Choose Now", 'iwjob').'</a>';
                    }else{
                        echo '<a class="buy-now" href="'.$package->get_buy_url().'" style=" background-color: '.$pricing_table_color.'">'.__("Buy Now", 'iwjob').'</a>';
                    }
                }

                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
<?php } ?>