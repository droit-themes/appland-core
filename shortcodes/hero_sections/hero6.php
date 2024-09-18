<?php
$image_ids = $atts['background_images'];
$image_ids = explode(',', $image_ids);
$overlay_opacity = !empty($atts['overlay_opacity']) ? "opacity: {$atts['overlay_opacity']};" : '';
?>
<section class="header-home-five home-six">
<div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="none" data-interval="5000" data-scroll-index="0">
    <?php
    if(!empty($image_ids)) { ?>
        <div class="carousel-inner" role="listbox">
            <!-- Third Slide -->
            <?php
            unset($i);
            $i = 1;
            foreach ($image_ids as $image_id) {
                $image_src = wp_get_attachment_image_src($image_id, 'full');
                $image_src = isset($image_src[0]) ? $image_src[0] : '';
                ?>
                <div class="item <?php echo $i == 1 ? 'active' : ''; ?>">
                    <img src="<?php echo $image_src; ?>" alt="" class="slide-image"/>
                    <div class="bs-slider-overlay" style="<?php echo $bg_color.$overlay_opacity; ?>"></div>
                </div>
                <?php
                ++$i;
            }
            ?>
        </div>
    <?php } ?>
    <!-- End of Wrapper For Slides -->
    <div class="slider_content">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-header-text lr-padding <?php if($is_fi_on_mobile=='hidden-xs') echo 'xs-padding'; ?>">

                    <?php if(!empty($atts['title'])) : ?>
                        <h1 style="<?php echo $title_color . $title_size; ?>"> <?php Appland_spanTag($atts['title']); ?> </h1>
                    <?php endif; ?>
                    <?php if(!empty($atts['subtitle'])) { ?>
                        <p style="<?php echo $subtitle_color . $subtitle_size; ?>"> <?php echo $atts['subtitle']; ?> </p>
                    <?php } ?>

                    <?php
                    if (is_array($buttons)) {
                        $i = 1;
                        foreach ($buttons as $button) {
                            $btn = !empty($button['btn']) ? vc_build_link($button['btn']) : '';
                            $btn_type = isset($button['btn_type']) ? $button['btn_type'] : '';
                            $btn_style = isset($button['btn_style']) ? $button['btn_style'] : '';
                            $style_class = '';
                            if ($btn_style == 'bg_btn') {
                                $style_class = 'btn-white';
                            } elseif ($btn_style == 'transparent_btn') {
                                $style_class = 'btn-transparent';
                            }
                            if($btn_type=='theme_btn') {
                                if(!empty( $btn['title'] )) {
                                    ?>
                                    <a class="banner_btn <?php echo $style_class; ?>"
                                       href="<?php echo esc_url($btn['url']) ?>"
                                       target="<?php echo $btn['target']; ?>"> <?php echo $btn['title']; ?> </a>
                                    <?php
                                }
                            }else {
                                echo do_shortcode($button['btn_shortcode']);
                            }
                        }}
                    ?>
                </div>
                <div class="col-sm-5 col-md-offset-2 col-md-3 col-header-img right-padding <?php echo $is_fi_on_mobile; ?>">
                    <?php
                    if(isset($featured_image[0])) { ?>
                        <img src="<?php echo $featured_image[0]; ?>" alt="header-img" class="img-header-lg white-img" style="<?php echo $top . $right . $bottom . $left; ?>">
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</section>