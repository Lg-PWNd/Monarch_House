<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package injob
 */
$header_layout = Inwave_Helper::getPostOption('header_option' , 'header_layout');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>">
    <?php wp_head(); ?>
</head>
<body id="page-top" <?php body_class(); ?>>

<?php
get_template_part('blocks/canvas', 'menu');
?>

<?php
$show_preload = Inwave_Helper::getPostOption('show_preload' , 'show_preload');
if($show_preload && $show_preload != 'no'){
    echo '<div id="preview-area">
        <div id="preview-spinners">
            <div class="sk-chasing-dots">
                <div class="sk-child sk-dot1"></div>
                <div class="sk-child sk-dot2"></div>
              </div>
        </div>
    </div>';
}
?>

<div class="wrapper">
    <div class="iw-overlay"></div>
    <?php
        $header_layout = Inwave_Helper::getPostOption('header_option' , 'header_layout');
        if(!$header_layout){
            $header_layout = 'default';
        }

        if($header_layout != 'none'){
            get_template_part('headers/header', $header_layout);
        }
    ?>
    <?php
    if(function_exists('putRevSlider')){
        $slider = Inwave_Helper::getPostOption('slider');
        if($slider){
            ?>
            <div class="slide-container <?php echo esc_attr($slider)?>">
                <?php putRevSlider($slider); ?>
            </div>
            <?php
        }
    }
    ?>
    <?php
        if(!is_page_template( 'page-templates/home-page.php' ) && !is_404()){
            get_template_part('blocks/page', 'heading');
        }
    ?>