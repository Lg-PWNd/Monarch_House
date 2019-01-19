<div class="iw-recent-resumes shortcode <?php echo $class; ?>">
    <div class="iwj-items">
        <?php foreach ($recent_resumes as $recent_resume) :
            $recent_resume = IWJ_Candidate::get_candidate($recent_resume);
            $user = IWJ_User::get_user();
            $desc = $recent_resume->get_description();
            $image = get_avatar( $recent_resume->get_author_id(), 100 );
            ?>
            <div class="recent-resume-item iwj-item">
                <div class="resumes-image"><?php echo ($image); ?></div>
                <div class="resumes-info">
                    <div class="info-top">
                        <div class="resumes-avatar"><?php echo ($image); ?></div>
                        <h3 class="name"><a href="<?php echo get_permalink($recent_resume->get_id()); ?>"><?php echo $recent_resume->get_title();?></a></h3>
                        <?php if($recent_resume->get_headline()) : ?>
                            <div class="resumes-job"><?php echo $recent_resume->get_headline(); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="info-bottom">
                        <?php if (iwj_option('view_free_resum')  || ($user && $user->can_view_resum($recent_resume->get_id()))) : ?>
                        <div class="social-link">
                            <ul>
                                <?php
                                foreach($recent_resume->get_social_media() as $key=>$value){
                                    if($value != null && $value !=''){
                                        if($key=="google_plus"){
                                            echo '<li><a class="google-plus" href="'. $value .'" title="'. $key .'"><i class="ion-social-googleplus"></i></a></li>';
                                        }else{
                                            echo '<li><a class="'. $key .'" href="'. $value .'" title="'. $key .'"><i class="ion-social-'. $key .'"></i></a></li>';
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <?php if($desc) : ?>
                            <div class="desc"><?php echo esc_attr(wp_trim_words($desc, 10)); ?></div>
                        <?php endif; ?>
                        <a class="view-resume" href="<?php echo get_permalink($recent_resume->get_id()); ?>"><?php echo __("View Resume", 'iwjob'); ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="clear"></div>
    </div>
</div>