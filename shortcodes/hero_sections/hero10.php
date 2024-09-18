<section class="banner_ten header-home" style="<?php echo $bg_color; ?>">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-header-text lr-padding <?php if($is_fi_on_mobile=='hidden-xs') echo 'xs-padding'; ?>">

                <?php if(!empty($atts['title'])) : ?>
                    <h1 style="<?php echo $title_size.$title_color; ?>">
                        <?php appland_spanTag($atts['title']); ?>
                    </h1>
                <?php endif; ?>
                <?php if(!empty($atts['subtitle'])) { ?>
                    <p style="<?php echo $subtitle_size.$subtitle_color; ?>"> <?php echo $atts['subtitle']; ?> </p>
                <?php } ?>

                <?php
                if (is_array($buttons)) {
                foreach ($buttons as $button) {
                    $btn = !empty($button['btn']) ? vc_build_link($button['btn']) : '';
                    $style_class = '';
                    if ($button['btn_style'] == 'bg_btn') {
                        $style_class = 'btn-white';
                    } elseif ($button['btn_style'] == 'transparent_btn') {
                        $style_class = 'btn-transparent';
                    }
                    if($button['btn_type']=='theme_btn' & !empty($btn['title'])) { ?>
                        <a class="banner_btn <?php echo $style_class; ?>" href="<?php echo $btn['url'] ?>"
                           target="<?php echo $btn['target']; ?>"> <?php echo esc_html($btn['title']); ?> </a>
                        <?php
                    }
                    elseif($button['btn_type']=='btn_shortcode') {
                        echo do_shortcode($button['btn_shortcode']);
                    }
                }}
                ?>
            </div>
            <div class="col-sm-6 col-md-6 col-header-img <?php echo $is_fi_on_mobile; ?>">
                <?php
                if(isset($featured_image[0])) { ?>
                    <img src="<?php echo $featured_image[0]; ?>" alt="header-img" class="img-header-lg" style="<?php echo $top . $right . $bottom . $left; ?>">
                <?php } ?>
            </div>
        </div>
    </div>
</section>