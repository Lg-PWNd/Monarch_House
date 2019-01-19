<?php if ($categories) { ?>
    <div class="iwj-categories <?php echo $atts['style'] .' '.$atts['class']; ?>">
        <?php
        switch ($atts['style']){
            case 'style1':
                $i = 1;
                $cats_per_row = $atts['cats_per_row'] ? $atts['cats_per_row'] : 5;
                foreach ($categories as $category) {
                    $icon_class = get_term_meta($category->term_id, IWJ_PREFIX.'icon_class', true);
                    if(!$icon_class){
                        $icon_class = 'ion-android-contacts';
                    }
                    ?>
                    <div class="item-category">
                        <div class="item-category-inner">
                            <span class="category-icon"><i class="<?php echo $icon_class; ?>"></i></span>
                            <h3 class="category-title"><a href="<?php echo get_term_link($category->slug, 'iwj_cat'); ?>"><?php echo $category->name; ?></a></h3>
                            <div class="total-jobs"><?php echo sprintf(_n('( %d job )', '( %d jobs )', $category->total,'iwjob'), $category->total); ?></div>
                        </div>
                    </div>
                <?php
                    if($atts['cats_per_row'] && $i > 1 && ($i % $cats_per_row  == 0) && count($categories) > $i){
                        echo '<div class="clearfix"></div>';
                    }
                $i++;
                }

                if($atts['show_categories_btn']){
                    ?>
                    <div class="item-category all-categories">
                        <div class="item-category-inner">
                            <h3 class="category-title"><a href="<?php echo $atts['link_all_cats']; ?>"><?php echo $atts['text_link_all_cats']; ?></a></h3>
                        </div>
                    </div>
                    <?php
                }
                break;
            case 'style5':
                $item_class =  'col-md-3 col-sm-4 col-xs-12';
                if($atts['cats_per_row'] == '1'){
                    $item_class =  'col-md-12 col-sm-12';
                }elseif($atts['cats_per_row'] == '2'){
                    $item_class =  'col-md-6 col-sm-6 col-xs-12';
                }elseif($atts['cats_per_row'] == '3'){
                    $item_class =  'col-md-4 col-sm-4 col-xs-12';
                }elseif($atts['cats_per_row'] == '4'){
                    $item_class =  'col-md-3 col-sm-4 col-xs-12';
                }elseif($atts['cats_per_row'] == '6'){
                    $item_class =  'col-md-2 col-sm-2 col-xs-12';
                }
                echo '<div class="row">';
                foreach ($categories as $category) {
                    $icon_class = get_term_meta($category->term_id, IWJ_PREFIX.'icon_class', true);
                    if(!$icon_class){
                        $icon_class = 'ion-android-contacts';
                    }
                    $img_src = '';
                    $bg_image = get_term_meta($category->term_id, IWJ_PREFIX.'bg_image', true);
                    if($bg_image){
                        $image = wp_get_attachment_image_src($bg_image, 'full');
                        $img_src = count($image) ? $image[0] : '';
                    }
                    if (!$img_src) {
                        $img_src = IWJ_PLUGIN_URL.'/assets/img/cat_bg.png';
                    }
                    ?>
                    <div class="<?php echo $item_class; ?>">
                        <div class="item-category">
                            <div class="category-image" style="background-image: url(<?php echo $img_src; ?>)"></div>
                            <span class="category-icon"><i class="<?php echo $icon_class; ?>"></i></span>
                            <h3 class="category-title"><a href="<?php echo get_term_link($category->slug, 'iwj_cat'); ?>"><?php echo $category->name; ?></a></h3>
                            <div class="total-jobs"><?php echo sprintf(_n('( %d job )', '( %d jobs )', $category->total,'iwjob'), $category->total); ?></div>
                        </div>
                    </div>
                    <?php
                }
                echo '</div>';

                if($atts['show_categories_btn']){
                    ?>
                    <div class="all-categories">
                            <a  class="iwj-btn iwj-btn-primary" href="<?php echo $atts['link_all_cats']; ?>"><?php echo $atts['text_link_all_cats']; ?></a>
                    </div>
                    <?php
                }
                break;
            case 'style2':
                $item_class =  'col-md-3 col-sm-3 col-xs-12';
                if($atts['cats_per_row'] == '1'){
                    $item_class =  'col-md-12 col-sm-12';
                }elseif($atts['cats_per_row'] == '2'){
                    $item_class =  'col-md-6 col-sm-6 col-xs-12';
                }elseif($atts['cats_per_row'] == '3'){
                    $item_class =  'col-md-4 col-sm-4 col-xs-12';
                }elseif($atts['cats_per_row'] == '4'){
                    $item_class =  'col-md-3 col-sm-3 col-xs-12';
                }elseif($atts['cats_per_row'] == '6'){
                    $item_class =  'col-md-2 col-sm-2 col-xs-12';
                }
                ?>
                <div class="row">
                    <?php foreach ($categories as $category) {
                        $icon_class = get_term_meta($category->term_id, IWJ_PREFIX.'icon_class', true);
                        if(!$icon_class){
                            $icon_class = 'ion-android-contacts';
                        }

                        $img_src = '';
                        $bg_image = get_term_meta($category->term_id, IWJ_PREFIX.'bg_image', true);
                        if($bg_image){
                            $image = wp_get_attachment_image_src($bg_image, 'full');
                            $img_src = count($image) ? $image[0] : '';
                        }
                        if (!$img_src) {
                            $img_src = IWJ_PLUGIN_URL.'/assets/img/cat_bg.png';
                        }
                        ?>
                        <div class="<?php echo $item_class; ?>">
                            <div class="item-category" style="background-image: url(<?php echo $img_src; ?>)">
                                <span class="category-icon"><i class="<?php echo $icon_class; ?>"></i></span>
                                <div class="category-info">
                                    <h3 class="category-title"><a href="<?php echo get_term_link($category->slug, 'iwj_cat'); ?>"><?php echo $category->name; ?></a></h3>
                                    <div class="total-jobs"><?php echo sprintf(_n('( %d job )', '( %d jobs )', $category->total,'iwjob'), $category->total); ?></div>
                                    <div><a class="view-link" href="<?php echo get_term_link($category->slug, 'iwj_cat'); ?>"><?php echo __('View Jobs', 'iwjob') ?></a></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php
                if($atts['show_categories_btn']){
                    ?>
                    <div class="all-categories">
                        <a  class="iwj-btn iwj-btn-primary" href="<?php echo $atts['link_all_cats']; ?>"><?php echo $atts['text_link_all_cats']; ?></a>
                    </div>
                    <?php
                }

                break;
            case 'style3':
            case 'style4':
            $item_class =  'col-md-3 col-sm-3 col-xs-12';
            if($atts['cats_per_row'] == '1'){
                $item_class =  'col-md-12 col-sm-12';
            }elseif($atts['cats_per_row'] == '2'){
                $item_class =  'col-md-6 col-sm-6 col-xs-12';
            }elseif($atts['cats_per_row'] == '3'){
                $item_class =  'col-md-4 col-sm-4 col-xs-12';
            }elseif($atts['cats_per_row'] == '4'){
                $item_class =  'col-md-3 col-sm-3 col-xs-12';
            }elseif($atts['cats_per_row'] == '6'){
                $item_class =  'col-md-2 col-sm-2 col-xs-12';
            }
        ?>
            <div class="row">
                <?php foreach ($categories as $category) {
                    ?>
                        <div class="<?php echo $item_class; ?>">
                            <div class="item-category">
                                <a href="<?php echo get_term_link($category->slug, 'iwj_cat'); ?>"><?php echo $category->name; ?></a>
                                <span><?php echo $category->total ?></span>
                            </div>
                        </div>
                <?php } ?>
            </div>

        <?php
            if($atts['show_categories_btn']){
                ?>
                <div class="all-categories">
                    <a  class="iwj-btn iwj-btn-primary" href="<?php echo $atts['link_all_cats']; ?>"><?php echo $atts['text_link_all_cats']; ?></a>
                </div>
                <?php
            }
        break;
            case 'style6':
                $item_class =  'col-md-3 col-sm-3 col-xs-12';
                if($atts['cats_per_row'] == '1'){
                    $item_class =  'col-md-12 col-sm-12';
                }elseif($atts['cats_per_row'] == '2'){
                    $item_class =  'col-md-6 col-sm-6 col-xs-12';
                }elseif($atts['cats_per_row'] == '3'){
                    $item_class =  'col-md-4 col-sm-4 col-xs-12';
                }elseif($atts['cats_per_row'] == '4'){
                    $item_class =  'col-md-3 col-sm-3 col-xs-12';
                }elseif($atts['cats_per_row'] == '6'){
                    $item_class =  'col-md-2 col-sm-2 col-xs-12';
                }
                wp_enqueue_script('isotope');
                ?>
                <div class="iwj-isotope-main isotope">
                    <div class="row">
                        <?php
                        $i = 1;
                        foreach ($categories as $category) {
                            $icon_class = get_term_meta($category->term_id, IWJ_PREFIX.'icon_class', true);
                            if(!$icon_class){
                                $icon_class = 'ion-android-contacts';
                            }

                            $img_src = '';
                            $bg_image = get_term_meta($category->term_id, IWJ_PREFIX.'bg_image', true);
                            if($bg_image){
                                $image = wp_get_attachment_image_src($bg_image, 'full');
                                $img_src = count($image) ? $image[0] : '';
                            }
                            if (!$img_src) {
                                $img_src = IWJ_PLUGIN_URL.'/assets/img/cat_bg.png';
                            }
                            ?>
                            <div class="style6-1 <?php echo $item_class; ?>  element-item">
                                <div class="item-category" style="background-image: url(<?php echo $img_src; ?>)">
                                    <span class="category-icon"><i class="<?php echo $icon_class; ?>"></i></span>
                                    <div class="category-info">
                                        <h3 class="category-title"><a href="<?php echo get_term_link($category->slug, 'iwj_cat'); ?>"><?php echo $category->name; ?></a></h3>
                                        <div class="total-jobs"><?php echo sprintf(_n('( %d job )', '( %d jobs )', $category->total,'iwjob'), $category->total); ?></div>
                                        <div><a class="view-link" href="<?php echo get_term_link($category->slug, 'iwj_cat'); ?>"><?php echo __('View Jobs', 'iwjob') ?></a></div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        } ?>
                    </div>
                </div>
                <?php
                if($atts['show_categories_btn']){
                    ?>
                    <div class="all-categories">
                        <a  class="iwj-btn iwj-btn-primary" href="<?php echo $atts['link_all_cats']; ?>"><?php echo $atts['text_link_all_cats']; ?></a>
                    </div>
                <?php
                }
                break;

            case 'style7':
                $item_class =  'col-md-3 col-sm-3 col-xs-12';
                if($atts['cats_per_row'] == '1'){
                    $item_class =  'col-md-12 col-sm-12';
                }elseif($atts['cats_per_row'] == '2'){
                    $item_class =  'col-md-6 col-sm-6 col-xs-12';
                }elseif($atts['cats_per_row'] == '3'){
                    $item_class =  'col-md-4 col-sm-4 col-xs-12';
                }elseif($atts['cats_per_row'] == '4'){
                    $item_class =  'col-md-3 col-sm-3 col-xs-12';
                }elseif($atts['cats_per_row'] == '6'){
                    $item_class =  'col-md-2 col-sm-2 col-xs-12';
                }
                wp_enqueue_script('isotope');
                ?>
                <div class="iwj-isotope-main isotope">
                    <div class="row">
                        <?php
                        $i = 1;
                        foreach ($categories as $category) {
                            $icon_class = get_term_meta($category->term_id, IWJ_PREFIX.'icon_class', true);
                            if(!$icon_class){
                                $icon_class = 'ion-android-contacts';
                            }
                            ?>
                            <div class="<?php echo $item_class; ?> element-item">
                                <div class="item-category">
                                    <span class="category-icon theme-color"><i class="<?php echo $icon_class; ?>"></i></span>
                                    <div class="category-info">
                                        <h3 class="category-title"><a href="<?php echo get_term_link($category->slug, 'iwj_cat'); ?>"><?php echo $category->name; ?></a></h3>
                                        <div class="total-jobs theme-color"><?php echo sprintf(_n('%d job', '%d jobs', $category->total,'iwjob'), $category->total); ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        } ?>
                    </div>
                </div>
                <?php
                if($atts['show_categories_btn']){
                    ?>
                    <div class="all-categories">
                        <a  class="iwj-btn iwj-btn-primary" href="<?php echo $atts['link_all_cats']; ?>"><?php echo $atts['text_link_all_cats']; ?></a>
                    </div>
                <?php
                }

                break;

            case 'style8':
                ?>
                <div class="items-category">
                    <?php
                    $i = 1;
                    foreach ($categories as $category) {
                        $icon_class = get_term_meta($category->term_id, IWJ_PREFIX.'icon_class', true);
                        if(!$icon_class){
                            $icon_class = 'ion-android-contacts';
                        }
                        ?>
                        <div class="item-category">
                            <span class="category-icon theme-color"><i class="<?php echo $icon_class; ?>"></i></span>
                            <h3 class="category-title"><a href="<?php echo get_term_link($category->slug, 'iwj_cat'); ?>"><?php echo $category->name; ?></a></h3>
                            <div class="total-jobs"><?php echo sprintf(_n('( %d job )', '( %d jobs )', $category->total,'iwjob'), $category->total); ?></div>
                        </div>
                        <?php
                        $i++;
                    } ?>
                </div>
                <?php
                if($atts['show_categories_btn']){
                    ?>
                    <div class="all-categories">
                        <a  class="iwj-btn iwj-btn-primary" href="<?php echo $atts['link_all_cats']; ?>"><?php echo $atts['text_link_all_cats']; ?></a>
                    </div>
                <?php
                }

                break;
        }
        ?>
    </div>
<?php } ?>