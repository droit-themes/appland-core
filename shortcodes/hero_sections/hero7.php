<?php
wp_enqueue_style('YTPlayer');
?>
<section class="header-home-seven" style="<?php echo $bg_color; ?>">
    <?php
    if(!empty($atts['video_url'])) {
        ?>
        <div class="video-background">
            <?php if(strpos($atts['video_url'], 'youtube') == true) : ?>
                <div id="bgndVideo" class="player" data-property="{videoURL:'<?php echo $atts['video_url'] ?>', containment:'#home', showControls:false, autoPlay:true, loop:true, mute:true, startAt:0, opacity:0.3, addRaster:true, quality:'default'}"></div>
            <?php else : ?>
                <video id="bgvid" loop autoplay muted>
                    <source src="<?php echo esc_url($atts['video_url']) ?>" type="video/mp4">
                </video>
            <?php endif; ?>
        </div>
    <?php } ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="hero-contents text-right">

                    <?php if(!empty($atts['subtitle'])) { ?>
                        <h4 style="<?php echo $subtitle_color . $subtitle_size; ?>"> <?php echo $atts['subtitle']; ?> </h4>
                    <?php } ?>
                    <?php if(!empty($atts['title'])) { ?>
                        <h2> <?php appland_spanTag($atts['title']); ?> </h2>
                    <?php } ?>

                    <?php
                    if (is_array($buttons)) {
                        $i = 1;
                        foreach ($buttons as $button) {
                            $btn_style = isset($button['btn_style']) ? $button['btn_style'] : '';
                            if ($btn_style == 'white') {
                                $style_class = 'btn-white';
                            } elseif ($btn_style == 'transparent') {
                                $style_class = 'btn-transparent';
                            }
                            $btn_color = !empty($button['btn_color']) ? $button['btn_color'] : '';
                            $btn_bg_color = !empty($button['btn_bg_color']) ? $button['btn_bg_color'] : '';
                            $btn_border_color = !empty($button['border_color']) ? $button['border_color'] : '';
                            $btn_css = "style='background: {$btn_bg_color}; color: {$btn_color}; border-color: {$btn_border_color};'";

                            if($btn_style == 'white' || $btn_style == 'transparent' || $btn_style == 'custom') {
                                $btn = vc_build_link($button['btn']); ?>
                                <a class="banner_btn <?php echo $style_class; ?>" href="<?php echo $btn['url'] ?>"
                                   target="<?php echo $btn['target']; ?>"> <?php echo $btn['title']; ?> </a>
                                <?php
                            }
                            if($btn_style == 'icon') {
                                if($i==1) echo '<div class="hero-app-icon">'; ?>
                                <a href="<?php echo $button['btn_url'] ?>" class="app-icon"><i class="<?php echo $button['icon'] ?>"></i></a> <?php
                                if($i==1) echo '</div>';
                            }
                            ++$i;
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="hero-contents">
                    <?php
                    $video_features = vc_param_group_parse_atts($atts['video_features']);
                    if(is_array($video_features)) {
                        foreach ($video_features as $video_feature) {
                            ?>
                            <div class="media">
                                <div class="media-left">
                                    <i class="<?php echo $video_feature['icon']; ?>"></i>
                                </div>
                                <div class="media-body">
                                    <h3> <?php echo esc_html($video_feature['title']) ?> </h3>
                                    <?php if (!empty($video_feature['subtitle'])) { ?>
                                        <p> <?php echo $video_feature['subtitle']; ?> </p>
                                    <?php } ?>
                                </div>
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