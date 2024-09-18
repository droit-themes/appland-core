<?php
add_shortcode('appland_videos', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'sec_padding' => '115px 0px 120px 0px',
        'sec_bg_color' => '#f8fafc',
        'title' => 'Video Features',
        'subtitle' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,<br> sed consequuntur magni dolores ratione voluptatem sequi nesciunt.',
        'is_br' => '',
        'title_weight' => '',
        'item_column' => '4'
    ),$atts);
    $videos = vc_param_group_parse_atts($content);
    $bg_color = !empty($atts['sec_bg_color']) ? 'background:'.$atts['sec_bg_color'].';' : '';
    wp_enqueue_style('magnific-popup');
    ?>

    <section class="video_features" style="padding: <?php echo $atts['sec_padding']; ?>; <?php echo $bg_color; ?>">
        <div class="container">
            <div class="sec_title_five text-center <?php echo ($atts['is_br'] != 'true') ? 'no-br' : ''; ?>">
                <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
                <?php if (!empty($atts['subtitle'])) { ?>
                    <p> <?php echo $atts['subtitle']; ?> </p>
                <?php } ?>
            </div>
            <div class="row">
                <?php
                if(is_array($videos)) {
                    foreach ($videos as $video) {
                        $preview = wp_get_attachment_image_src($video['preview'], 'full');
                        ?>
                        <div class="col-sm-<?php echo $atts['item_column'] ?>">
                            <div class="video">
                                <img src="<?php echo $preview[0]; ?>" alt="video">
                                <a href="<?php echo $video['video_url'] ?>" class="video_icon"><i class="fa fa-play"></i></a>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <?php
    $html = ob_get_clean();
    return $html;
});



// VC Config
add_action( 'vc_before_init', function() {
    if( function_exists('vc_map') ) {
        vc_map(array(
                'name'              => esc_html__('Multiple Videos', 'appland-core'),
                'description'       => esc_html__('Display multiple videos in grid layout.', 'appland-core'),
                'base'              => 'appland_videos',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'Video Features',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'subtitle',
                        'value' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,<br> sed consequuntur magni dolores ratione voluptatem sequi nesciunt.',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_br',
                        'heading' => esc_html__('Is border under title?', 'appland-core'),
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'column',
                        'heading' => esc_html__('Select Column', 'appland-core'),
                        'description' => esc_html__('Put the feature item in the column you desire.', 'appland-core'),
                        'value' => array(
                            '3/12' => '3',
                            '4/12' => '4',
                            '6/12' => '6',
                        ),
                        'std' => '4'
                    ),
                    array(
                        'type' => 'param_group',
                        'param_name' => 'content',
                        'heading' => esc_html__('Videos', 'appland-core'),
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'param_name' => 'video_url',
                                'heading' => esc_html__('Video URL', 'appland-core'),
                                'value' => 'https://www.youtube.com/watch?v=_L4IQoAWD9E'
                            ),
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'preview',
                                'heading' => esc_html__('Video preview image', 'appland-core'),
                            ),
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'sec_padding',
                        'heading' => esc_html__('Section padding', 'appland-core'),
                        'description' => 'Input the padding as clock wise (Top Right Bottom Left)',
                        'value' => '115px 0px 120px 0px',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'sec_bg_color',
                        'heading' => esc_html__('Section background color', 'appland-core'),
                        'value' => '#f8fafc',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'title_weight',
                        'heading' => esc_html__('Title font weight', 'appland-core'),
                        'value' => array(
                            'Normal' => 'normal',
                            'Lighter' => 'lighter',
                            'Bold'  => 'bold',
                            'Bolder'  => 'bolder'
                        ),
                        'std' => 'bold',
                        'group' => 'Styling'
                    ),
                ),
            )
        );

    }
});
