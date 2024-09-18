<section class="banner_nine_area" style="<?php echo $bg_color; ?>">
    <div class="border_shap"></div>
    <div class="border_shap_two"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 d-flex align-items-center">
                <div class="banner_content">

                    <?php if(!empty($atts['title'])) { ?>
                        <h2 style="<?php echo $title_color . $title_size; ?>"> <?php appland_spanTag($atts['title']); ?> </h2>
                    <?php } ?>
                    <?php if(!empty($atts['subtitle'])) { ?>
                        <p style="<?php echo $subtitle_color . $subtitle_size; ?>"> <?php echo $atts['subtitle']; ?> </p>
                    <?php } ?>
                    <?php
                    if(!empty($buttons)) {
                    foreach ($buttons as $button) {
                        if($button['btn_type']=='theme_btn') {
                            $btn = !empty($button['btn']) ? $button['btn'] : '';
                            $btn = vc_build_link($btn);
                            $btn_style = isset($button['btn_style']) ? $button['btn_style'] : '';
                            if ($btn_style == 'bg_btn') {
                                $style_class = '';
                            } elseif ($btn_style == 'transparent_btn') {
                                $style_class = ' btn-transparent';
                            }
                            if($button['btn_style']=='bg_btn') {
                                echo '<a href="' . esc_url($btn['url']) . '" target="' . $btn['target'] . '" class="app_banner_btn'.$style_class.'"> ' . esc_html($btn['title']) . ' </a>';
                            } else {
                                echo '<a href="' . esc_url($btn['url']) . '" target="' . $btn['target'] . '" class="app_banner_btn'.$style_class.'"> ' . esc_html($btn['title']) . ' </a>';
                            }
                        }
                        else {
                            echo do_shortcode($button['btn_shortcode']);
                        }
                    }}
                    ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="app_screen_two">
                    <?php
                    $featured_image1 = !empty($atts['slide_image']) ? wp_get_attachment_image_url($atts['slide_image'], 'full') : '';
                    $featured_image2 = !empty($atts['featured_image2']) ? wp_get_attachment_image_url($atts['featured_image2'], 'full') : '';

                    if(!empty($featured_image1)) : ?>
                        <img class="img one wow slideInnew" src="<?php echo esc_url($featured_image1) ?>" alt="" data-parallax='{"x": 0, "y": -150}'>
                    <?php endif; ?>
                    <?php if(!empty($featured_image2)) : ?>
                        <img class="img two wow slideInnew" src="<?php echo esc_url($featured_image2) ?>" alt="" data-parallax='{"x": 10, "y": -100}'>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>