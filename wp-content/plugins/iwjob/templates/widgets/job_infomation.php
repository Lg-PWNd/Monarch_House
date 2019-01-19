<?php
$post = get_post();
$job = IWJ_Job::get_job(get_post());
$author = $job->get_author();
$user = IWJ_User::get_user();

if (is_single() && $post) {
    echo $args['before_widget'];

    if (isset($instance['title'])) {
        $title = (!empty($instance['title'])) ? $instance['title'] : '';
        $title = apply_filters('widget_title', $title, $instance, $widget_id);

        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
    }
    ?>
    <div class="iwj-job-widget-wrap">
        <div class="info-top">
            <?php $employer = $author->get_employer(); ?>
            <div class="company-logo"><?php echo ($employer && $employer->is_active()) ? '<a href="' . esc_url($author->permalink()) . '">' : ''; ?><?php echo iwj_get_avatar($author->get_id()); ?><?php echo ($employer && $employer->is_active()) ? '</a>' : ''; ?>
            </div>
            <h3 class="iwj-title">
                <?php
                if ($employer && $employer->is_active()) {
                    ?>
                    <a class="theme-color" href="<?php echo esc_url($author->permalink()); ?>"><?php echo $author->get_display_name() ?></a>
                <?php } else { ?>
                    <?php echo $author->get_display_name() ?>
                <?php } ?>
            </h3>
            <?php if ($author->get_headline()) { ?>
                <div class="headline"><?php echo $author->get_headline(); ?></div>
            <?php } ?>
        </div>
        <div class="iwj-sidebar-bottom info-bottom">
            <?php if ($author->get_short_description()) : ?>
                <div class="description"><?php echo $author->get_short_description(); ?></div>
            <?php endif; ?>
            <div class="company-link">
                <?php if ($author->get_website()) { ?>
                    <a class="website" href="<?php echo esc_url($author->get_website()); ?>"><i class="ion-link"></i><span><?php _e('website company', 'iwjob'); ?></span></a>
                    <a class="link-detail" href="<?php echo esc_url($author->permalink()); ?>"><i class="ion-ios-list-outline"></i><span><?php _e('Company info', 'iwjob'); ?></span></a>
                        <?php } ?>
            </div>

        </div>
    </div>
    <?php
    echo $args['after_widget'];
}