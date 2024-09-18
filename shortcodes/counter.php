<?php
add_shortcode('appland_counter', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'style' => 'style_01',
        'bg_image' => '',
        'overlay_type' => 'gradient',
        'mix_angle' => '0deg',
        'gradient_color_1' => '#4776e6',
        'gradient_color_2' => '#8e54e9',
        'overlay_solid' => '#4776e6',
        'sec_padding' => '200px 0px 190px 0px',
    ),$atts);
    $counters = vc_param_group_parse_atts($content);
    $bg_image = wp_get_attachment_image_src($atts['bg_image'], 'full');
    $bg_image_src = isset($bg_image[0]) ? $bg_image[0] : '';
    if($atts['overlay_type']=='gradient') {
        $bg_color = "background-image: -webkit-linear-gradient({$atts['mix_angle']}, {$atts['gradient_color_1']} 0%, {$atts['gradient_color_2']} 100%) !important;";
    }elseif($atts['overlay_type']=='solid') {
        $bg_color = "background: {$atts['overlay_solid']} !important;";
    }
    // Style switcher
    switch ($atts['style']) {
        case 'style_01':
            $style = 'fun_fact_four voilat-bg-two';
            break;
        case 'style_02':
            $style = 'angle-bg angle_color angle-bg-two';
            break;
        default:
            $style = 'fun_fact_four voilat-bg-two';
    }
    ?>

    <section class="fun_fact_two <?php echo $style; ?>" style="padding: <?php echo $atts['sec_padding'].'; '.$bg_color ?>">
        <div class="video-bg" style="background: url(<?php echo $bg_image_src; ?>); background-size: cover; background-attachment: fixed;"></div>
        <div class="container">
            <div class="row">
                <?php
                foreach ($counters as $counter) {
                    $count_append = isset($counter['count_append']) ? $counter['count_append'] : '';
                    $count_label = isset($counter['count_label']) ? $counter['count_label'] : '';
                    ?>
                    <div class="col-sm-3">
                        <div class="fact_item">
                            <i class="<?php echo $counter['icon']; ?>"></i>
                            <h2><span class="counter"><?php echo $counter['count_to'] ?></span><?php echo $count_append; ?></h2>
                            <p> <?php echo $count_label; ?> </p>
                        </div>
                    </div>
                    <?php
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
                'name'              => esc_html__('Stats Counter', 'appland-core'),
                'description'       => esc_html__('Display your stats in different styled counter.', 'appland-core'),
                'base'              => 'appland_counter',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'content',
                        'heading' => esc_html__('Counters', 'appland-core'),
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'param_name' => 'count_to',
                                'heading' => esc_html__('Count to', 'appland-core'),
                                'description' => esc_html__('Input the value in numeric number', 'appland-core'),
                                'value' => '30'
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'count_append',
                                'heading' => esc_html__('Count append text', 'appland-core'),
                                'value' => 'k+'
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'count_label',
                                'heading' => esc_html__('Count title', 'appland-core'),
                                'value' => 'Users Subscribe',
                                'admin_label' => true
                            ),
                            array(
                                'type' => 'iconpicker',
                                'param_name' => 'icon',
                                'heading' => esc_html__('Icon', 'appland-core'),
                                'value' => 'ti-email',
                                'settings' => array(
                                    'type' => 'themify_icon',
                                    'iconsPerPage' => 200,
                                    'emptyIcon' => false
                                ),
                            ),
                        )
                    ),

                    // -------------------- Group : Styling -----------------------
                    array(
                        'type' => 'textfield',
                        'param_name' => 'sec_padding',
                        'heading' => esc_html__('Section padding', 'appland-core'),
                        'description' => 'Input the padding as clock wise (Top Right Bottom Left)',
                        'value' => '200px 0px 190px 0px',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'style',
                        'heading' => esc_html__('Section Style', 'appland-core'),
                        'admin_label' => true,
                        'value' => array(
                            'Style one' => 'style_01',
                            'Style two' => 'style_02',
                        ),
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_01',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/counter1.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_02',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/counter2.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        ),
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'bg_image',
                        'heading' => esc_html__('Background image', 'appland-core'),
                        'group' => 'Styling'
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
                        'heading' => esc_html__( 'Solid background color', 'appland-core' ),
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
                        'heading' => esc_html__( 'Gradient Color 1', 'appland-core' ),
                        'param_name' => 'gradient_color_1',
                        'description' => esc_html__( 'Select first color for gradient.', 'appland-core' ),
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
                        'heading' => esc_html__( 'Gradient Color 2', 'appland-core' ),
                        'param_name' => 'gradient_color_2',
                        'description' => esc_html__( 'Select second color for gradient.', 'appland-core' ),
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
                        'heading' => esc_html__( 'Color mix angle', 'appland-core' ),
                        'param_name' => 'mix_angle',
                        'description' => esc_html__( 'Enter the color mix angle in deg (Example: 10deg).', 'appland-core' ),
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
