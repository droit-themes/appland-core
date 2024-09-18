<?php
add_shortcode('appland_screen_features', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'is_title' => '',
        'is_btm_line' => '',
        'title_position' => 'top',
        'title' => 'Exclusive Features',
        'subtitle' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',

        'sec_padding' => '150px 0px 150px 0px',
        'the_image' => '',
        'left_items' => '',
        'right_items' => '',
        'style' => 'style_01',

        'title_weight' => 'bold',
        'title_size' => '24px',
        'title_color' => '#606060',

        'subtitle_size' => '16px',
        'subtitle_color' => '#666666',

        'style5_bg_image' => '',
        'featured_image2' => '',
        'fi2_top' => '',
        'fi2_right' => '',
        'fi2_bottom' => '',
        'fi2_left' => '',

        'features3' => '',

        'bg_color' => '',
    ),$atts);
    $features = vc_param_group_parse_atts($content);
    $left_items = vc_param_group_parse_atts($atts['left_items']);
    $right_items = vc_param_group_parse_atts($atts['right_items']);
    $the_image = wp_get_attachment_image_src($atts['the_image'], 'full');
    $the_image_src = isset($the_image[0]) ? $the_image[0] : '';

    $bg_color = !empty($atts['bg_color']) ? "background-color: {$atts['bg_color']};" : '';
    ?>

    <?php
    if($atts['style'] == 'style_01') { ?>
        <section class="f_images_area f_image_area_two bg-color screen-feature-1" style="padding: <?php echo $atts['sec_padding']; ?>;">
        <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <?php
                if (is_array($left_items)) {
                foreach ($left_items as $left_item) {
                    ?>
                    <div class="sec_features_item">
                        <i class="<?php echo $left_item['icon'] ?> icon"></i>
                        <h5 class="title" style="<?php echo Appland_FontSize($atts, 'title_size'); ?> color: <?php echo $atts['title_color'] ?>"> <?php echo $left_item['title'] ?> </h5>
                        <p style="<?php echo Appland_FontSize($atts, 'subtitle_size'); ?> color: <?php echo $atts['subtitle_color'] ?>"> <?php echo $left_item['subtitle'] ?> </p>
                    </div>
                    <?php
                }}
                ?>
            </div>
            <div class="col-sm-4 f_img_two text-center">
                <img src="<?php echo $the_image_src; ?>" alt="">
            </div>
            <div class="col-sm-4">
                <?php
                if (is_array($right_items)) {
                foreach ($right_items as $right_item) {
                    ?>
                    <div class="sec_features_item">
                        <i class="<?php echo $right_item['icon'] ?> icon"></i>
                        <h5 class="title" style="<?php echo Appland_FontSize($atts, 'title_size'); ?>"> <?php echo $right_item['title'] ?> </h5>
                        <p style="<?php echo Appland_FontSize($atts, 'subtitle_size'); ?>"> <?php echo $right_item['subtitle'] ?> </p>
                    </div>
                    <?php
                }}
                ?>
            </div>
        </div>
        </div>
        </section>
        <?php
    }

    elseif ($atts['style'] == 'style_02') { ?>
        <section class="sec-features screen-feature-2">
            <div class="container">
                <?php
                if($atts['is_title'] == 'true') { ?>
                    <div class="section_title <?php echo ($atts['is_btm_line'] != 'true') ? 'no_btm_line' : ''; ?>">
                        <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                        <?php if($atts['is_btm_line'] == 'true') : ?>
                            <div class="br"></div>
                        <?php endif; ?>
                        <?php if (!empty($atts['subtitle'])) { ?>
                            <p> <?php echo $atts['subtitle']; ?> </p>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12 col-sm-10 col-sm-offset-1 container-acting">
                        <div class="row">
                            <?php
                            $i = 1;
                            if(!empty($atts['features3'])) {
                            foreach (vc_param_group_parse_atts($atts['features3']) as $feature) {
                                if(!empty($feature['icon_color'])) :
                                    ?>
                                    <style>
                                        .screen-feature-2 .sec_features_item.<?php echo 'f_item'.$i; ?>:hover .icon {
                                            background-color: <?php echo $feature['icon_color']; ?>;
                                            border-color: <?php echo $feature['icon_color']; ?>;
                                            color: #fff !important;
                                        }
                                        .screen-feature-2 .sec_features_item.<?php echo 'f_item'.$i; ?>:hover .title {
                                            <?php echo "color: {$feature['icon_color']};"; ?>
                                        }
                                        .screen-feature-2 .sec_features_item.<?php echo 'f_item'.$i; ?> .icon {
                                            <?php echo "color: {$feature['icon_color']}; border-color: {$feature['icon_color']};"; ?>
                                        }
                                    </style>
                                    <?php
                                endif;
                                switch ($i) {
                                    case 1:
                                        $position = 'feat-top-left';
                                        break;
                                    case 2:
                                        $position = 'feat-top-right';
                                        break;
                                    case 3:
                                        $position = 'feat-bottom-left';
                                        break;
                                    case 4:
                                        $position = 'feat-bottom-right';
                                        break;
                                    default:
                                        $position = '';
                                }
                                ?>
                                <div class="col-sm-6 col-md-4 col-lg-3 sec_features_item <?php echo 'f_item'.$i; ?> <?php echo $position; ?>">
                                    <?php if($feature['select_font']=='linearicon') { ?>
                                        <i class="<?php echo $feature['lnr_icon'] ?> icon"></i>
                                    <?php }elseif($feature['select_font']=='themify_icon') { ?>
                                        <i class="<?php echo $feature['icon'] ?> icon"></i>
                                    <?php } elseif($feature['select_font']=='image_icon') {
                                        $image_icon = wp_get_attachment_image_src($feature['image_icon'], 'full'); ?>
                                        <img src="<?php echo $image_icon[0] ?>" alt="">
                                    <?php } ?>
                                    <h5 class="title"> <?php echo $feature['title'] ?> </h5>
                                    <?php if(!empty($feature['subtitle'])) : ?>
                                        <p> <?php echo $feature['subtitle'] ?> </p>
                                    <?php endif; ?>
                                </div>
                                <?php
                                ++$i;
                            }}
                            ?>
                        </div>
                        <img class="img-responsive" src="<?php echo $the_image_src; ?>" alt="featured">
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    elseif($atts['style'] == 'style_03') { ?>
        <section class="f_images_area screen-feature-3">
        <div class="container">
        <div class="row">
            <?php if($the_image_src) : ?>
                <div class="col-sm-5 text-center">
                    <img src="<?php echo $the_image_src; ?>" alt="">
                </div>
            <?php endif; ?>
            <div class="col-sm-7">
                <div class="row">
                    <?php
                    if(!empty($atts['features3'])) {
                    foreach (vc_param_group_parse_atts($atts['features3']) as $i => $feature) {
                        $icon_color = !empty($feature['icon_color']) ? "style='color: {$feature['icon_color']}; border-color: {$feature['icon_color']};'" : '';
                        if(!empty($feature['icon_color'])) :
                        ?>
                        <style>
                            .screen-feature-3 .sec_features_item.<?php echo 'f_item'.$i; ?>:hover .icon {
                                background-color: <?php echo $feature['icon_color']; ?>;
                                border-color: <?php echo $feature['icon_color']; ?>;
                                color: #fff !important;
                            }
                        </style>
                        <?php endif; ?>
                        <div class="col-sm-6 sec_features_item <?php echo 'f_item'.$i; ?>">
                            <?php if($feature['select_font'] == 'linearicon') { ?>
                                <i class="<?php echo $feature['lnr_icon'] ?> icon" <?php echo $icon_color; ?>></i>
                            <?php }elseif($feature['select_font'] == 'themify_icon') { ?>
                                <i class="<?php echo $feature['icon'] ?> icon" <?php echo $icon_color; ?>></i>
                            <?php } elseif($feature['select_font'] == 'image_icon') {
                                $image_icon = wp_get_attachment_image_src($feature['image_icon'], 'full'); ?>
                                <img src="<?php echo $image_icon[0] ?>" alt="<?php echo $feature['title'] ?>">
                            <?php } ?>
                            <h5 class="title" style="<?php echo Appland_FontSize($atts, 'title_size'); ?>"> <?php echo $feature['title'] ?> </h5>
                            <?php if(!empty($feature['subtitle'])) : ?>
                                <p style="<?php echo Appland_FontSize($atts, 'subtitle_size'); ?>"> <?php echo $feature['subtitle'] ?> </p>
                            <?php endif; ?>
                        </div>
                        <?php
                    }}
                    ?>
                </div>
            </div>
        </div>
        </div>
        </section>
        <?php
    }

    elseif($atts['style'] == 'style_04') {
        $title_position = $atts['title_position'] == 'right' ? 'title_right' : '';
        ?>
        <section class="power_features_area_two screen-feature-4 <?php echo esc_attr($title_position); ?>"
                 style="padding: <?php echo $atts['sec_padding']; ?>; <?php echo $bg_color; ?>">
            <div class="container">
                <?php
                if($atts['title_position'] == 'top') {
                    if($atts['is_title'] == 'true') { ?>
                        <div class="sec_title_five text-center <?php echo ($atts['is_btm_line'] != 'true') ? 'no_btm_line' : ''; ?>">
                            <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                            <?php if($atts['is_btm_line'] == 'true') : ?>
                                <div class="br"></div>
                            <?php endif; ?>
                            <?php if (!empty($atts['subtitle'])) { ?>
                                <p> <?php echo $atts['subtitle']; ?> </p>
                            <?php } ?>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="row">
                    <div class="col-md-5 col-sm-12 p_f_img">
                        <?php if($the_image_src) : ?>
                            <img src="<?php echo $the_image_src; ?>" alt="<?php echo $atts['title']; ?>">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <div class="row">

                            <?php
                            if($atts['title_position'] == 'right') {
                                if($atts['is_title'] == 'true') { ?>
                                    <div class="sec_title_five text-center title-right <?php echo ($atts['is_btm_line'] != 'true') ? 'no_btm_line' : ''; ?>" style="margin-top: 70px;">
                                        <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                                        <?php if($atts['is_btm_line'] == 'true') : ?>
                                            <div class="br"></div>
                                        <?php endif; ?>
                                        <?php if (!empty($atts['subtitle'])) { ?>
                                            <p> <?php echo $atts['subtitle']; ?> </p>
                                        <?php } ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <?php
                            $i = 1;
                            if(!empty($atts['features3'])) {
                            foreach (vc_param_group_parse_atts($atts['features3']) as $feature) {
                                if(!empty($feature['icon_color'])) :
                                    ?>
                                    <style>
                                        .screen-feature-4 .power_features_item.<?php echo 'f_item'.$i; ?>:hover .title {
                                        <?php echo "color: {$feature['icon_color']};"; ?>
                                        }
                                        .screen-feature-4 .power_features_item.<?php echo 'f_item'.$i; ?> i {
                                        <?php echo "color: {$feature['icon_color']}; border-color: {$feature['icon_color']};"; ?>
                                        }
                                    </style>
                                    <?php
                                endif;
                                ?>
                                <div class="col-sm-6">
                                    <div class="power_features_item <?php echo 'f_item'.$i; ?>">
                                        <?php
                                        if($feature['select_font']== 'linearicon') { ?>
                                            <i class="<?php echo $feature['lnr_icon'] ?>"></i>
                                        <?php }elseif($feature['select_font']=='themify_icon') { ?>
                                            <i class="<?php echo $feature['icon'] ?>"></i>
                                        <?php } elseif($feature['select_font']=='image_icon') {
                                            $image_icon = wp_get_attachment_image_src($feature['image_icon'], 'full'); ?>
                                            <img src="<?php echo $image_icon[0] ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                                        <?php } ?>
                                        <h5 class="title"> <?php echo $feature['title'] ?> </h5>
                                        <?php echo !empty($feature['subtitle']) ? wpautop($feature['subtitle']) : ''; ?>
                                    </div>
                                </div>
                                <?php
                                ++$i;
                            }}
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    elseif($atts['style'] == 'style_05') {
        $style5_bg_image = wp_get_attachment_image_src($atts['style5_bg_image'], 'full');
        $style5_bg_image = isset($style5_bg_image[0]) ? $style5_bg_image[0] : plugin_dir_url(__FILE__).'images/new-app/round.png';
        $featured_image2 = wp_get_attachment_image_src($atts['featured_image2'], 'full');
        $fi2_top = !empty($atts['fi2_top']) ? 'top:'.$atts['fi2_top'].';' : '';
        $fi2_right = !empty($atts['fi2_right']) ? 'right:'.$atts['fi2_right'].';' : '';
        $fi2_bottom = !empty($atts['fi2_bottom']) ? 'bottom:'.$atts['fi2_bottom'].';' : '';
        $fi2_left = !empty($atts['fi2_left']) ? 'left:'.$atts['fi2_left'].';' : '';
        $fi2_position = $fi2_top.$fi2_right.$fi2_bottom.$fi2_left.$fi2_left;
        ?>
        <section class="new_awesome_features_area"
                 style="padding: <?php echo $atts['sec_padding']; ?>; <?php echo $bg_color; ?>">
            <img class="round_shape" src="<?php echo $style5_bg_image; ?>" alt="app">
            <div class="container">
                <?php if($atts['is_title'] == 'true') { ?>
                    <div class="new_section_heading sec_title_five text-center <?php echo ($atts['is_btm_line'] != 'true') ? 'no_btm_line' : ''; ?>">
                        <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                        <?php if($atts['is_btm_line'] == 'true') : ?>
                            <div class="br"></div>
                        <?php endif; ?>
                        <?php if (!empty($atts['subtitle'])) { ?>
                            <p class="p_font"> <?php echo $atts['subtitle']; ?> </p>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="row d_flex">
                    <div class="col-md-7 features_item_info">
                        <div class="row ">
                        <?php
                        $i = 1;
                        foreach ($features as $feature) {
                            $icon = $feature['select_font'] == 'themify_icon' ? $feature['icon'] : $feature['lnr_icon'];
                            $offset = $i%2 ? '' : 'col-md-offset-1';
                            ?>
                            <div class="col-md-5 col-xs-6 <?php echo $offset ?> n_features_item wow fadeInUp" data-wow-delay="0.3s">
                                <div class="f_icon nill" style="background-color: <?php echo $feature['background_color']; ?>;">
                                    <?php
                                    if($feature['select_font'] == 'linearicon') { ?>
                                        <i class="<?php echo $feature['lnr_icon'] ?>"></i>
                                    <?php }elseif($feature['select_font'] == 'themify_icon') { ?>
                                        <i class="<?php echo $feature['icon'] ?>"></i>
                                    <?php } elseif($feature['select_font'] == 'image_icon') {
                                        $image_icon = wp_get_attachment_image_src($feature['image_icon'], 'full'); ?>
                                        <img src="<?php echo $image_icon[0] ?>" alt="<?php echo $feature['title'] ?>">
                                    <?php } ?>
                                </div>
                                <h3 class="title_h3"> <?php echo $feature['title'] ?> </h3>
                                <p class="p_font"> <?php echo $feature['subtitle'] ?> </p>
                            </div>
                            <?php
                            ++$i;
                        }
                        ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="new_features_app">
                            <?php if(!empty($the_image_src)) : ?>
                                <div class="wow fadeInUp f_app f_app_one"  data-wow-delay="1.3s">
                                    <img src="<?php echo $the_image_src; ?>" alt="<?php echo $feature['title'] ?>">
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($featured_image2[0])) : ?>
                                <style>
                                    .new_features_app .f_app.f_app_two {
                                        <?php echo $fi2_position; ?>
                                    }
                                </style>
                                <img class="f_app f_app_two wow fadeInDown" data-wow-delay="0.8s" src="<?php echo $featured_image2[0]; ?>" alt="app">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
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
                'name'              => esc_html__('Screen Features', 'appland-core'),
                'description'       => esc_html__('Display features of a specific screen image of your App.', 'appland-core'),
                'base'              => 'appland_screen_features',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'style',
                        'heading' => esc_html__('Style', 'appland-core'),
                        'value' => array(
                            'Style one' => 'style_01',
                            'Style two' => 'style_02',
                            'Style three' => 'style_03',
                            'Style four' => 'style_04',
                            'Style five' => 'style_05',
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_01',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/screen_features1.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_02',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/screen_features2.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_03',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/screen_features3.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_03'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_04',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/screen_features4.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_04'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_05',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/screen_features5.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_05'
                        ),
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'style5_bg_image',
                        'heading' => esc_html__('Background shape image', 'appland-core'),
                        'description' => esc_html__('Upload here your background shape image if your want to use your own shape instead of the default.', 'appland-core'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_05'
                        ),
                    ),

                    // Title Group
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_title',
                        'heading' => esc_html__('Show Title Area', 'appland-core'),
                        'group' => 'Title',
                        'value' => 'true',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('style_02', 'style_04', 'style_05')
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'title_position',
                        'heading' => esc_html__('Title Position', 'appland-core'),
                        'group' => 'Title',
                        'value' => array(
                            'Top' => 'top',
                            'Right' => 'right'
                        ),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_04'
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'Exclusive Features',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'admin_label' => true,
                        'group' => 'Title',
                        'dependency' => array(
                            'element' => 'is_title',
                            'value' => 'true',
                        )
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_btm_line',
                        'heading' => esc_html__('Title Bottom Line', 'appland-core'),
                        'group' => 'Title',
                        'dependency' => array(
                            'element' => 'is_title',
                            'value' => 'true',
                        )
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'subtitle',
                        'value' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'admin_label' => true,
                        'group' => 'Title',
                        'dependency' => array(
                            'element' => 'is_title',
                            'value' => 'true',
                        )
                    ),

                    // Featured image
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'the_image',
                        'heading' => esc_html__('The featured image', 'appland-core'),
                        'description' => 'Upload here the featured image',
                        'group' => 'Featured image',
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'featured_image2',
                        'heading' => esc_html__('Second featured image', 'appland-core'),
                        'group' => 'Featured image',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_05'
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'fi2_top',
                        'heading' => esc_html__('Second image position from top', 'appland-core'),
                        'description' => esc_html__('Input the measurement in pixel unit. Negative value is allowed here. (Eg. -150px)', 'appland-core'),
                        'group' => 'Featured image',
                        'dependency' => array(
                            'element' => 'featured_image2',
                            'not_empty' => true
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'fi2_right',
                        'heading' => esc_html__('Second image position from right', 'appland-core'),
                        'group' => 'Featured image',
                        'dependency' => array(
                            'element' => 'featured_image2',
                            'not_empty' => true
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'fi2_bottom',
                        'heading' => esc_html__('Second image position from bottom', 'appland-core'),
                        'group' => 'Featured image',
                        'dependency' => array(
                            'element' => 'featured_image2',
                            'not_empty' => true
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'fi2_left',
                        'heading' => esc_html__('Second image position from left', 'appland-core'),
                        'group' => 'Featured image',
                        'dependency' => array(
                            'element' => 'featured_image2',
                            'not_empty' => true
                        )
                    ),


                    // Feature items
                    array(
                        'type' => 'param_group',
                        'param_name' => 'features3',
                        'heading' => esc_html__('Feature items', 'appland-core'),
                        'group' => esc_html__('Features', 'appland-core'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('style_02', 'style_03', 'style_04')
                        ),
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'param_name' => 'title',
                                'heading' => esc_html__('Title', 'appland-core'),
                                'admin_label' => true,
                                'value' => 'Unique Design',
                            ),
                            array(
                                'type' => 'textarea',
                                'param_name' => 'subtitle',
                                'heading' => esc_html__('Subtitle', 'appland-core'),
                                'value' => 'Integer quis mollis lacus maecenas in ornare ex sed scelerisque nec elit nec vehicula duis pretium libero'
                            ),
                            array(
                                'type' => 'dropdown',
                                'param_name' => 'select_font',
                                'heading' => esc_html__('Select the icon type', 'appland-core'),
                                'value' => array(
                                    'Linear icons' => 'linearicon',
                                    'Themify icons' => 'themify_icon',
                                    'Image icon' => 'image_icon',
                                ),
                                'std' => 'themify_icon'
                            ),
                            array(
                                'type' => 'iconpicker',
                                'param_name' => 'lnr_icon',
                                'heading' => esc_html__('Linear Icon', 'appland-core'),
                                'value' => 'lnr lnr-diamond',
                                'settings' => array(
                                    'type' => 'linearicons',
                                    'iconsPerPage' => 300,
                                    'emptyIcon' => false
                                ),
                                'dependency' => array(
                                    'element' => 'select_font',
                                    'value' => 'linearicon'
                                )
                            ),
                            array(
                                'type' => 'iconpicker',
                                'param_name' => 'icon',
                                'heading' => esc_html__('Themify Icon', 'appland-core'),
                                'value' => 'ti-vector',
                                'settings' => array(
                                    'type' => 'themify_icon',
                                    'iconsPerPage' => 300,
                                    'emptyIcon' => false
                                ),
                                'dependency' => array(
                                    'element' => 'select_font',
                                    'value' => 'themify_icon'
                                )
                            ),
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'image_icon',
                                'heading' => esc_html__('Image icon', 'appland-core'),
                                'dependency' => array(
                                    'element' => 'select_font',
                                    'value' => 'image_icon'
                                )
                            ),
                            array(
                                'type' => 'colorpicker',
                                'param_name' => 'icon_color',
                                'heading' => esc_html__('Color', 'appland-core'),
                                'dependency' => array(
                                    'element' => 'select_font',
                                    'value' => array('linearicon', 'themify_icon')
                                )
                            ),
                        )
                    ),

                    // Feature items
                    array(
                        'type' => 'param_group',
                        'param_name' => 'content',
                        'heading' => esc_html__('Feature items', 'appland-core'),
                        'group' => esc_html__('Features', 'appland-core'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('style_05')
                        ),
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'param_name' => 'title',
                                'heading' => esc_html__('Title', 'appland-core'),
                                'admin_label' => true,
                                'value' => 'Unique Design',
                            ),
                            array(
                                'type' => 'textarea',
                                'param_name' => 'subtitle',
                                'heading' => esc_html__('Subtitle', 'appland-core'),
                                'value' => 'Integer quis mollis lacus maecenas in ornare ex sed scelerisque nec elit nec vehicula duis pretium libero'
                            ),
                            array(
                                'type' => 'dropdown',
                                'param_name' => 'select_font',
                                'heading' => esc_html__('Select the icon type', 'appland-core'),
                                'value' => array(
                                    'Linear icons' => 'linearicon',
                                    'Themify icons' => 'themify_icon',
                                    'Image icon' => 'image_icon',
                                ),
                                'std' => 'themify_icon'
                            ),
                            array(
                                'type' => 'iconpicker',
                                'param_name' => 'lnr_icon',
                                'heading' => esc_html__('Linear Icon', 'appland-core'),
                                'value' => 'lnr lnr-diamond',
                                'settings' => array(
                                    'type' => 'linearicons',
                                    'iconsPerPage' => 300,
                                    'emptyIcon' => false
                                ),
                                'dependency' => array(
                                    'element' => 'select_font',
                                    'value' => 'linearicon'
                                )
                            ),
                            array(
                                'type' => 'iconpicker',
                                'param_name' => 'icon',
                                'heading' => esc_html__('Themify Icon', 'appland-core'),
                                'value' => 'ti-vector',
                                'settings' => array(
                                    'type' => 'themify_icon',
                                    'iconsPerPage' => 300,
                                    'emptyIcon' => false
                                ),
                                'dependency' => array(
                                    'element' => 'select_font',
                                    'value' => 'themify_icon'
                                )
                            ),
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'image_icon',
                                'heading' => esc_html__('Image icon', 'appland-core'),
                                'dependency' => array(
	                                'element' => 'select_font',
	                                'value' => 'image_icon'
                                )
                            ),
                            array(
                                'type' => 'colorpicker',
                                'param_name' => 'background_color',
                                'heading' => esc_html__('Background color', 'appland-core'),
                                'value' => '#5d58f7',
                            ),
                        )
                    ),

                    // Left items
                    array(
                        'type' => 'param_group',
                        'param_name' => 'left_items',
                        'heading' => esc_html__('Left feature items', 'appland-core'),
                        'group' => esc_html__('Features', 'appland-core'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('style_01')
                        ),
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'param_name' => 'title',
                                'heading' => esc_html__('Title', 'appland-core'),
                                'admin_label' => true,
                                'value' => 'Unique Design',
                            ),
                            array(
                                'type' => 'textarea',
                                'param_name' => 'subtitle',
                                'heading' => esc_html__('Subtitle', 'appland-core'),
                                'value' => 'Integer quis mollis lacus maecenas in ornare ex sed scelerisque nec elit nec vehicula duis pretium libero'
                            ),
                            array(
                                'type' => 'iconpicker',
                                'param_name' => 'icon',
                                'heading' => esc_html__('Icon', 'appland-core'),
                                'value' => 'lnr lnr-diamond',
                                'settings' => array(
                                    'type' => 'linearicons',
                                    'iconsPerPage' => 200,
                                    'emptyIcon' => false
                                ),
                            ),
                        )
                    ),
                    // Right items
                    array(
                        'type' => 'param_group',
                        'param_name' => 'right_items',
                        'heading' => esc_html__('Right feature items', 'appland-core'),
                        'group' => esc_html__('Features', 'appland-core'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('style_01')
                        ),
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'param_name' => 'title',
                                'heading' => esc_html__('Title', 'appland-core'),
                                'admin_label' => true,
                                'value' => 'RETINA READY',
                            ),
                            array(
                                'type' => 'textarea',
                                'param_name' => 'subtitle',
                                'heading' => esc_html__('Subtitle', 'appland-core'),
                                'value' => 'Integer quis mollis lacus maecenas in ornare ex sed scelerisque nec elit nec vehicula duis pretium libero'
                            ),
                            array(
                                'type' => 'iconpicker',
                                'param_name' => 'icon',
                                'heading' => esc_html__('Icon', 'appland-core'),
                                'value' => 'lnr lnr-smartphone',
                                'settings' => array(
                                    'type' => 'linearicons',
                                    'iconsPerPage' => 200,
                                    'emptyIcon' => false
                                ),
                            ),
                        )
                    ),

                    // Group : Styling
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
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title_size',
                        'heading' => esc_html__('Title font size', 'appland-core'),
                        'value' => '24px',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'title_color',
                        'heading' => esc_html__('Title font color', 'appland-core'),
                        'value' => '#606060',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'subtitle_size',
                        'heading' => esc_html__('Subtitle font size', 'appland-core'),
                        'value' => '16px',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'subtitle_color',
                        'heading' => esc_html__('Subtitle font color', 'appland-core'),
                        'value' => '#666666',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'sec_padding',
                        'heading' => esc_html__('Section padding', 'appland-core'),
                        'description' => 'Input the padding as clock wise (Top Right Bottom Left)',
                        'value' => '150px 0px 150px 0px',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'bg_color',
                        'heading' => esc_html__('Section Background Color', 'appland-core'),
                        'group' => 'Styling',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('style_05')
                        ),
                    ),
                ),
            )
        );

    }
});
