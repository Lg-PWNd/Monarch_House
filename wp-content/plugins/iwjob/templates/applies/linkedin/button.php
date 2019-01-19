<?php
$cookie = 'iwj_linkedin_apply_' . $job->get_id();
if(isset($_COOKIE[$cookie]) && $_COOKIE[$cookie]){
    echo '<a href="javascript:void(0)" class="apply-job applied"><i class="fa fa-linkedin"></i>'.__('Applied with linkedin', 'iwjob').'</a>';
}else{
    wp_enqueue_style('iwj-apply-linkedin');
    wp_enqueue_script('iwj-apply-linkedin');
    $url = $self->get_apply_url($job);
    echo '<a href="'.esc_url($url).'" class="apply-job apply-with-linkedin"><i class="fa fa-linkedin"></i>'.__('Apply with linkedin', 'iwjob').'</a>';
}
?>
