<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of functions
 *
 * @developer duongca
 */
if (!function_exists('inwave_get_shortcodes')) {

    function inwave_get_shortcodes() {
        return array(
            'base',//required
            'heading',
            'testimonials',
            'posts',
            'info_list',
            'item_info',
            'member',
            'iw_faq_listing',
//            'iw_search_form',
            'button',
            'funfact_list',
            'funfact',
            'video',
            'iw_sponsors',
            'map',
            'iw_sponsors',
            'tabs',
            'work_steps',
            'work_step',
            'iw_accordions',
            'iw_count_down',
            'item_feature',
            'image-link',
        );
    }
}

if (!function_exists('inwave_add_shortcode_script')) {

    function inwave_add_shortcode_script($scripts) {
        if ($scripts) {
            $theme_info = wp_get_theme();
            foreach ($scripts as $key => $scripts2) {
                foreach ($scripts2 as $key2 => $script) {
                    if ($key == 'scripts') {
                        wp_enqueue_script($key2, $script, array('jquery'), $theme_info->get('Version'));
                    } else {
                        wp_enqueue_style($key2, $script, array(), $theme_info->get('Version'));
                    }
                }
            }
        }
    }
}

if (!function_exists('inwave_get_element_by_tags')) {
    /**
     * Function to get element by tag
     * @param string $tag tag name. Eg: embed, iframe...
     * @param string $content content to find
     * @param int $type type of tag. <br/> 1. [tag_name settings]content[/tag_name]. <br/>2. [tag_name settings]. <br/>3. HTML tags.
     * @return type
     */
    function inwave_get_element_by_tags($tag, $content, $type = 1) {
        if ($type == 1) {
            $pattern = "/\[$tag(.*)\](.*)\[\/$tag\]/Uis";
        } elseif ($type == 2) {
            $pattern = "/\[$tag(.*)\]/Uis";
        } elseif ($type == 3) {
            $pattern = "/\<$tag(.*)\>(.*)\<\/$tag\>/Uis";
        } else {
            $pattern = null;
        }
        $find = null;
        if ($pattern) {
            preg_match($pattern, $content, $matches);
            if ($matches) {
                $find = $matches;
            }
        }
        return $find;
    }
}

if(!function_exists('inwave_resize')) {
    function inwave_resize($url, $width, $height = null, $crop = null, $single = true)
    {
        //validate inputs
        if (!$url OR !$width) return false;

        //define upload path & dir
        $upload_info = wp_upload_dir();
        $upload_dir = $upload_info['basedir'];
        $upload_url = $upload_info['baseurl'];
        //check if $img_url is local
        if (strpos($url, $upload_url) === false){
            //define path of image
            $rel_path = str_replace(content_url(), '', $url);
            $img_path = WP_CONTENT_DIR  . $rel_path;
        }
        else
        {
            $rel_path = str_replace($upload_url, '', $url);
            $img_path = $upload_dir . $rel_path;
        }

        //check if img path exists, and is an image indeed
        if (!file_exists($img_path) OR !getimagesize($img_path)) return $url;

        //get image info
        $info = pathinfo($img_path);
        $ext = $info['extension'];
        list($orig_w, $orig_h) = getimagesize($img_path);

        //get image size after cropping
        $dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
        $dst_w = $dims[4];
        $dst_h = $dims[5];

        //use this to check if cropped image already exists, so we can return that instead
        $suffix = "{$dst_w}x{$dst_h}";
        $dst_rel_url = str_replace('.' . $ext, '', $url);
        $destfilename = "{$img_path}-{$suffix}.{$ext}";
        if (!$dst_h) {
            //can't resize, so return original url
            $img_url = $url;
            $dst_w = $orig_w;
            $dst_h = $orig_h;
        } //else check if cache exists
        elseif (file_exists($destfilename) && getimagesize($destfilename)) {
            $img_url = "{$dst_rel_url}-{$suffix}.{$ext}";
        } //else, we resize the image and return the new resized image url
        else {
            // Note: This pre-3.5 fallback check will edited out in subsequent version
            if (function_exists('wp_get_image_editor')) {

                $editor = wp_get_image_editor($img_path);

                if (is_wp_error($editor) || is_wp_error($editor->resize($width, $height, $crop)))
                    return false;

                $resized_file = $editor->save();

                if (!is_wp_error($resized_file)) {
                    $resized_rel_path = str_replace($upload_dir, '', $resized_file['path']);
                    $img_url = "{$dst_rel_url}-{$suffix}.{$ext}";
                } else {
                    return false;
                }

            }
        }

        //return the output
        if ($single) {
            //str return
            $image = $img_url;
        } else {
            //array return
            $image = array(
                0 => $img_url,
                1 => $dst_w,
                2 => $dst_h
            );
        }

        return $image;
    }
}

if(!function_exists('iwj_get_placeholder_image')){
    function iwj_get_placeholder_image($dimension = array()){
        $thumnail_original_url = IWJ_PLUGIN_URL . '/assets/img/placehold-image.png';
        if($dimension){
            $thumnail_part = IWJ_PLUGIN_DIR . '/assets/img/placehold-image-'.($dimension[0] ? '-'.$dimension[1] : '').'.png';
            if(!file_exists($thumnail_part)){
                return iwj_resize_image($thumnail_original_url, $dimension[0], $dimension[1], true);
            }else{
                return IWJ_PLUGIN_URL . '/assets/img/placehold-image-'.($dimension[0] ? '-'.$dimension[1] : '').'.png';
            }
        }

        return $thumnail_original_url;
    }
}

