<?php
add_shortcode('appland_c2a', function($atts, $content) {
    ob_start();

    $atts = shortcode_atts(array(
        'title' => 'Exdended features that makes it advanced',
        'subtitle' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur.',
        'btn' => '',
        'image' => '',
        'bg_img' => '',
        'title_sec_padding' => '30px 35px 0px 15px',
        'sec_padding' => '150px 0px 150px 0px',
        'sec_bg_color' => '',
        'style' => 'style_01',
        'title_weight' => ''
    ),$atts);
    $image = wp_get_attachment_image_src($atts['image'], 'full');
    $image_src = isset($image[0]) ? $image[0] : '';
    $bg_image = wp_get_attachment_image_src($atts['bg_img'], 'full');
    $bg_image_src = isset($bg_image[0]) ? "url({$bg_image[0]}) no-repeat center center" : '';
    $btn = vc_build_link($atts['btn']);
    $bg_color = !empty($atts['sec_bg_color']) ? 'background:'.$atts['sec_bg_color'].';' : '';
    ?>

    <?php
    if($atts['style']=='style_01') {
        ?>
        <section class="ex_features_one_area" style="padding: <?php echo $atts['sec_padding']; ?>; <?php echo $bg_color; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 features_content" style="padding: <?php echo $atts['title_sec_padding'] ?>;">
                        <h2> <?php echo $atts['title']; ?> </h2>
                        <p> <?php echo $atts['subtitle']; ?> </p>
                        <?php if (!empty($btn['title'])) { ?>
                            <a href="<?php echo $btn['url'] ?>" target="<?php echo $btn['target'] ?>"
                               class="btn learn_btn color_v"> <?php echo $btn['title']; ?> </a>
                        <?php } ?>
                    </div>
                    <div class="col-md-6 f_img text-center">
                        <img src="<?php echo $image_src; ?>" alt="<?php echo $atts['title']; ?>">
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    elseif($atts['style']=='style_02') {
        ?>
        <section class="more_text_area" style="padding: <?php echo $atts['sec_padding']; ?>; <?php echo $bg_color; ?>">
            <div class="container">
                <div class="more_content">
                    <h3> <?php echo $atts['title'] ?> </h3>
                </div>
                <a href="<?php echo $btn['url'] ?>" class="btn more_btn" target="<?php echo $btn['target'] ?>"> <?php echo $btn['title']; ?> </a>
                <hr class="border">
            </div>
        </section>
        <?php
    }

    elseif($atts['style']=='style_03') {
        ?>
        <section class="get_area" style="padding: <?php echo $atts['sec_padding']; ?>; <?php echo $bg_color; ?>">
            <div class="video-bg" style="background: url(<?php echo Appland_get_image_src($atts, 'bg_img'); ?>) no-repeat; background-position: bottom"></div>
            <div class="container">
                <div class="">
                    <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                    <p> <?php echo $atts['subtitle'] ?> </p>
                    <a href="<?php echo $btn['url'] ?>" class="btn more_btn" target="<?php echo $btn['target'] ?>"> <?php echo $btn['title']; ?> </a>
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
                'name'              => esc_html__('Call to Action', 'appland-core'),
                'description'       => esc_html__('Call to action section with title, subtitle, image and button.', 'appland-core'),
                'base'              => 'appland_c2a',
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
                        ),
                        'std' => 'style_01'
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_01',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/c2a1.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_02',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/c2a2.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_03',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/c2a3.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_03'
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'Exdended features that makes it advanced',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'subtitle',
                        'value' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur.',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('style_01', 'style_03')
                        )
                    ),
                    array(
                        'type' => 'vc_link',
                        'param_name' => 'btn',
                        'heading' => esc_html__('Button', 'appland-core'),
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'heading' => esc_html__('Featured Image', 'appland-core'),
                        'description' => esc_html__('Attach here the Featured image that will show on the right column.', 'appland-core'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('style_01')
                        ),
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'bg_img',
                        'heading' => esc_html__('Background image', 'appland-core'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('style_02', 'style_03')
                        ),
                    ),
                    // ----------------------- Group : Styling ------------------------
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
                        'param_name' => 'sec_padding',
                        'heading' => esc_html__('Section padding', 'appland-core'),
                        'description' => 'Input the padding as clock wise (Top Right Bottom Left)',
                        'value' => '150px 0px 150px 0px',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title_sec_padding',
                        'heading' => esc_html__('Padding around title section', 'appland-core'),
                        'description' => 'Input the padding as clock wise (Top Right Bottom Left)',
                        'value' => '30px 35px 0px 15px',
                        'group' => 'Styling',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('style_01', 'style_02')
                        ),
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'sec_bg_color',
                        'heading' => esc_html__('Section background color', 'appland-core'),
                        'group' => 'Styling'
                    ),
                ),
            )
        );

    }
});
