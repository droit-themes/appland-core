<?php
add_shortcode('appland_video', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title' => 'VIDEO DEMO APP',
        'subtitle' => 'Vestibulum tempus vel est ut tempus quisque tempus',
        'style' => 'style_01',
        // Video
        'video_url' => '',
        'video_type' => 'youtube',
        'video_id' => '',
        'play_btn_title' => 'Play the video',

        // Background
        'bg_image' => '',
        'overlay_type' => 'gradient',
        'mix_angle' => '0deg',
        'gradient_color_1' => '#4776e6',
        'gradient_color_2' => '#8e54e9',
        'overlay_solid' => '#4776e6',
        'sec_padding' => '410px 0px 420px 0px',
        'is_switch_column' => ''
    ),$atts);

    $bg_image = wp_get_attachment_image_src($atts['bg_image'], 'full');
    $bg_image_src = isset($bg_image[0]) ? $bg_image[0] : '';

    $bg_color = '';
    if($atts['overlay_type'] == 'gradient') {
        $bg_color = "background-image: -webkit-linear-gradient({$atts['mix_angle']}, {$atts['gradient_color_1']} 0%, {$atts['gradient_color_2']} 100%) !important;";
    }elseif($atts['overlay_type'] == 'solid') {
        $bg_color = "background: {$atts['overlay_solid']};";
    }
    ?>

    <style>
        .video_area_two .videoWrapper .videoPoster:after {
        <?php echo $bg_color; ?>
        }
        .video_area_three .videoWrapper .videoPoster:after {
        <?php echo $bg_color; ?>
        }
    </style>

    <?php
    if($atts['style']=='style_01') {
        wp_enqueue_style('magnific-popup');
        ?>
        <section class="video-area_two angle-bg angle-bg-two" style="padding: <?php echo $atts['sec_padding'] . '; ' . $bg_color ?>">
            <div class="video-bg" style="background: url(<?php echo $bg_image_src; ?>); background-size: cover; background-attachment: fixed;"></div>
            <div class="container">
                <div class="wrapper-video">
                    <a id="video-item" class="youtube-popup" href="<?php echo $atts['video_url']; ?>">
                        <i class="fa fa-play" aria-hidden="true"></i>
                    </a>
                    <h3> <?php echo $atts['title']; ?> </h3>
                    <?php if (!empty($atts['subtitle'])) { ?>
                        <p> <?php echo $atts['subtitle']; ?> </p>
                    <?php } ?>
                </div>
            </div>
        </section>
        <?php
    }

    elseif($atts['style']=='style_02') {
        if($atts['is_switch_column']=='') { ?>
            <section class="video_area video_area_two" style="padding: <?php echo $atts['sec_padding'] ?>">
                <div class="video-left">
                    <div class="video-inner">
                        <div class="section_title">
                            <?php if(!empty($atts['title'])) : ?>
                                <h2> <?php echo $atts['title']; ?> </h2>
                            <?php endif; ?>
                            <?php if(!empty($atts['subtitle'])) { ?>
                                <p> <?php echo $atts['subtitle']; ?> </p>
                            <?php } ?>
                        </div>
                        <?php if(!empty($atts['play_btn_title'])) : ?>
                            <button class="play-btn"> <?php echo $atts['play_btn_title']; ?> </button>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="video-right">
                    <div class="videoWrapper videoWrapper169 js-videoWrapper">
                        <?php
                        if($atts['video_type'] == 'youtube') {
                            echo '<iframe class="videoIframe js-videoIframe" data-src="https://www.youtube.com/embed/'.esc_attr($atts['video_id']).'?autoplay=1& modestbranding=1&rel=0&hl=sv"></iframe>';
                        }elseif($atts['video_type'] == 'self_hosted') {
                            echo '<iframe class="videoIframe js-videoIframe" data-src="'.esc_url($atts['video_url']).'?autoplay=1& modestbranding=1&rel=0&hl=sv"></iframe>';
                        }
                        ?>
                        <button class="videoPoster js-videoPoster" style="background: url(<?php echo $bg_image_src; ?>) no-repeat scroll center 0/cover; background-position: 0 50%;"></button>
                    </div>
                </div>
            </section>
            <?php
        }
        elseif($atts['is_switch_column'] == 'true') {
            ?>
            <section class="video_area_three">
                <div class="video-left">
                    <div class="videoWrapper videoWrapper169 js-videoWrapper" style="background: url(<?php echo $bg_image_src; ?>) no-repeat scroll center 0/cover;">
                        <?php
                        if($atts['video_type'] == 'youtube') {
                            echo '<iframe class="videoIframe js-videoIframe" data-src="https://www.youtube.com/embed/'.esc_attr($atts['video_id']).'?autoplay=1& modestbranding=1&rel=0&hl=sv"></iframe>';
                        }elseif($atts['video_type'] == 'self_hosted') {
                            echo '<iframe class="videoIframe js-videoIframe" data-src="'.esc_url($atts['video_url']).'?autoplay=1& modestbranding=1&rel=0&hl=sv"></iframe>';
                        }
                        ?>
                        <button class="videoPoster js-videoPoster" style="background: url(<?php echo $bg_image_src; ?>) no-repeat scroll center 0/cover; background-position: 0 50%;"></button>
                    </div>
                </div>
                <div class="video-right">
                    <div class="video-inner">
                        <div class="sec_title_five sec_five">
                            <h2> <?php echo $atts['title']; ?> </h2>
                            <div class="br"></div>
                        </div>
                        <?php if(!empty($atts['subtitle'])) { ?>
                            <p> <?php echo $atts['subtitle']; ?> </p>
                        <?php } ?>
                        <button class="play-btn"> <?php echo $atts['play_btn_title']; ?> </button>
                    </div>
                </div>
            </section>
            <?php
        }
    }
    ?>

    <?php
    $html = ob_get_clean();
    return $html;
});



// VC Config
add_action( 'vc_before_init', function() {
    if( function_exists('vc_map') ) {
        vc_map(array(
                'name'              => esc_html__('Video Section', 'appland-core'),
                'description'       => esc_html__('Display a video with title and subtitle.', 'appland-core'),
                'base'              => 'appland_video',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'style',
                        'heading' => esc_html__('Section Style', 'appland-core'),
                        'value' => array(
                            'Style one' => 'style_01',
                            'Style two' => 'style_02',
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_01',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/video1.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_02',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/video2.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        ),
                    ),

                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'VIDEO DEMO APP',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'subtitle',
                        'value' => 'Vestibulum tempus vel est ut tempus quisque tempus',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_switch_column',
                        'heading' => esc_html__('Is column switch?', 'appland-core'),
                        'description' => esc_html__('Check this checkbox checked in if you want to switch revert the column.', 'appland-core'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        )
                    ),

                    // Video Group
                    array(
                        'type' => 'textfield',
                        'param_name' => 'play_btn_title',
                        'heading' => esc_html__('Play Button Title', 'appland-core'),
                        'value' => 'Play the video',
                        'group' => 'Video',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        )
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'video_type',
                        'heading' => esc_html__('Video Type', 'appland-core'),
                        'group' => 'Video',
                        'value' => array(
                            esc_html__('Self Hosted Video', 'appland-core') => 'self_hosted',
                            esc_html__('YouTube', 'appland-core') => 'youtube',
                        ),
                        'std' => 'youtube',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'video_url',
                        'heading' => esc_html__('Video URL.', 'appland-core'),
                        'group' => 'Video',
                        'dependency' => array(
                            'element' => 'video_type',
                            'value' => 'self_hosted'
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'video_id',
                        'heading' => esc_html__('Video ID', 'appland-core'),
                        'description' => __('Enter your YouTube Video ID here. <a href="https://docs.joeworkman.net/rapidweaver/stacks/youtube/video-id" target="_blank"> How to find Video ID?</a>', 'appland-core'),
                        'group' => 'Video',
                        'dependency' => array(
                            'element' => 'video_type',
                            'value' => 'youtube'
                        )
                    ),

                    // 'group' => 'Styling',
                    array(
                        'type' => 'textfield',
                        'param_name' => 'sec_padding',
                        'heading' => esc_html__('Section padding', 'appland-core'),
                        'description' => 'Input the padding as clock wise (Top Right Bottom Left)',
                        'value' => '410px 0px 420px 0px',
                        'group' => 'Styling',
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'bg_image',
                        'heading' => esc_html__('Background image', 'appland-core'),
                        'group' => 'Styling',
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'overlay_type',
                        'heading' => esc_html__('Overlay color type', 'appland-core'),
                        'value' => array(
                            'Gradient' => 'gradient',
                            'Solid' => 'solid',
                        ),
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => __( 'Solid background color', 'appland-core' ),
                        'param_name' => 'overlay_solid',
                        'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                        'value' => '#4776e6',
                        'dependency' => array(
                            'element' => 'overlay_type',
                            'value' => array( 'solid' ),
                        ),
                        'edit_field_class' => 'vc_col-sm-4',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => __( 'Gradient Color 1', 'appland-core' ),
                        'param_name' => 'gradient_color_1',
                        'description' => __( 'Select first color for gradient.', 'appland-core' ),
                        'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                        'value' => '#4776e6',
                        'dependency' => array(
                            'element' => 'overlay_type',
                            'value' => array( 'gradient' ),
                        ),
                        'edit_field_class' => 'vc_col-sm-4',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => __( 'Gradient Color 2', 'appland-core' ),
                        'param_name' => 'gradient_color_2',
                        'description' => __( 'Select second color for gradient.', 'appland-core' ),
                        'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                        'value' => '#8e54e9',
                        'dependency' => array(
                            'element' => 'overlay_type',
                            'value' => array( 'gradient' ),
                        ),
                        'edit_field_class' => 'vc_col-sm-4',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Color mix angle', 'appland-core' ),
                        'param_name' => 'mix_angle',
                        'description' => __( 'Enter the color mix angle in deg (Example: 10deg).', 'appland-core' ),
                        'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                        'value' => '0deg',
                        'dependency' => array(
                            'element' => 'overlay_type',
                            'value' => array( 'gradient' ),
                        ),
                        'edit_field_class' => 'vc_col-sm-4',
                        'group' => 'Styling'
                    ),
                ),
            )
        );

    }
});
