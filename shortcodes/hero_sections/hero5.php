<section class="header-home-five header-overlay" style="<?php echo $bg_color; ?>">
    <?php
    if ($atts['is_wave'] == 'true') { ?>
        <div id="scene" class="scene borders" data-input-element="#scene-input">
            <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave">
                <title>Wave</title>
                <defs></defs>
                <path id="feel-the-wave" d=""/>
            </svg>
            <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave">
                <title>Wave</title>
                <defs></defs>
                <path id="feel-the-wave-two" d=""/>
            </svg>
            <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave">
                <title>Wave</title>
                <defs></defs>
                <path id="feel-the-wave-three" d=""/>
            </svg>
        </div>
    <?php } ?>
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
                    if(!empty($button['btn'])) {
                        $btn = vc_build_link($button['btn']);
                        $btn_type = isset($button['btn_type']) ? $button['btn_type'] : '';
                        $btn_style = isset($button['btn_style']) ? $button['btn_style'] : '';
                        $style_class = '';
                        if ($btn_style == 'bg_btn') {
                            $style_class = 'btn-white';
                        } elseif ($btn_style == 'transparent_btn') {
                            $style_class = 'btn-transparent';
                        }
                        if ($btn_type == 'theme_btn') {
                            ?>
                            <a class="banner_btn <?php echo $style_class; ?>" href="<?php echo esc_url($btn['url']) ?>"
                               target="<?php echo $btn['target']; ?>"> <?php echo $btn['title']; ?> </a>
                            <?php
                        } else {
                            echo do_shortcode($button['btn_shortcode']);
                        }
                    }
                }}
                ?>
            </div>
            <div class="col-sm-5 col-md-offset-2 col-md-3 col-header-img right-padding <?php echo $is_fi_on_mobile; ?>">
                <?php
                if(isset($featured_image[0])) { ?>
                    <img src="<?php echo $featured_image[0]; ?>" alt="header-img" class="img-header-lg" style="<?php echo $top . $right . $bottom . $left; ?>">
                <?php } ?>
            </div>
        </div>
    </div>
</section>