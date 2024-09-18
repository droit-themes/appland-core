<?php
$shape_image = !empty($atts['shape_image']) ?
    wp_get_attachment_image($atts['shape_image'], 'full') :
    '<img src="'.plugin_dir_url(__FILE__).'hero8_images/h_bg.png" alt="'.$atts['title'].'">';
?>
<section class="app_banner_area d_flex">
    <div class="bg_overlay">
        <?php echo $shape_image; ?>
    </div>
    <div class="container">
        <div class="row d_flex">
            <div class="col-md-6 flex">
                <div class="app_banner_texts">

                    <?php if(!empty($atts['title'])) { ?>
                        <h2 style="<?php echo $title_color . $title_size; ?>"> <?php appland_spanTag($atts['title']); ?> </h2>
                    <?php } ?>
                    <?php if(!empty($atts['subtitle'])) { ?>
                        <p style="<?php echo $subtitle_color . $subtitle_size; ?>"> <?php echo $atts['subtitle']; ?> </p>
                    <?php } ?>

                    <?php
                    if(is_array($buttons)) {
                    foreach ($buttons as $button) {
                        if($button['btn_type']=='theme_btn') {
                            $btn = vc_build_link($button['btn']);
                            if($button['btn_style']=='bg_btn') {
                                echo '<a href="' . esc_url($btn['url']) . '" target="' . $btn['target'] . '" class="app_banner_btn"> ' . esc_html($btn['title']) . ' </a>';
                            } else {
                                echo '<a href="' . esc_url($btn['url']) . '" target="' . $btn['target'] . '" class="app_banner_btn_two"> ' . esc_html($btn['title']) . ' </a>';
                            }
                        }
                        else {
                            echo do_shortcode($button['btn_shortcode']);
                        }
                    }}
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="banner_app_img">
                    <?php
                    $featured_images = vc_param_group_parse_atts($atts['featured_images']);
                    if(!empty($featured_images)) {
                        foreach ($featured_images as $featured_image) {
                            $fi_alt_text = !empty($featured_image['fi_alt_text']) ? $featured_image['fi_alt_text'] : get_bloginfo('name');
                            $top = !empty($featured_image['fi_top']) ? 'top:'.$featured_image['fi_top'].';' : '';
                            $right = !empty($featured_image['fi_right']) ? 'right:'.$featured_image['fi_right'].';' : '';
                            $bottom = !empty($featured_image['fi_bottom']) ? 'bottom:'.$featured_image['fi_bottom'].';' : '';
                            $left = !empty($featured_image['fi_left']) ? 'left:'.$featured_image['fi_left'].';' : '';
                            $animation_delay = !empty($featured_image['animation_delay']) ? $featured_image['animation_delay'] : '08';
                            $featured_image = wp_get_attachment_image_src($featured_image['featured_image'], 'full'); ?>
                            <div class="app_screen wow slideInnew <?php echo $is_fi_on_mobile; ?>" data-wow-delay="<?php echo $animation_delay ?>s" style="<?php echo $top . $right . $bottom . $left; ?>">
                                <img src="<?php echo isset($featured_image[0]) ? $featured_image[0] : ''; ?>" alt="<?php echo esc_attr($fi_alt_text) ?>"  data-parallax='{"x": 20, "y": -150}'>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>