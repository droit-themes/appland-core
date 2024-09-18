<?php
add_shortcode('appland_single_feature', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title' => 'Flexible to Use',
        'subtitle' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
        'bg_image' => '',
        'icon' => '',
        'lnr_icon' => 'lnr lnr-smartphone',
        'ti_icon' => 'ti-vector',
        'select_icon' => '',
        'image_icon' => '',
        'bg_color' => ''
    ),$atts);
    $icon = $atts['select_icon']=='themify_icon' ? $atts['ti_icon'] : $atts['lnr_icon'];
    $bg_image = wp_get_attachment_image_src($atts['bg_image'], 'full');
    $bg_image = isset($bg_image[0]) ? $bg_image[0] : '';
    ?>
    <div class="app-features-item app_f_one" style="<?php Appland_shortcode_style('background-color', $atts, 'bg_color') ?>">
        <img class="app-bg" src="<?php echo $bg_image; ?>" alt="">
        <div class="content">
            <?php
            if($atts['select_icon'] == 'image_icon') { ?>
                <?php echo wp_get_attachment_image($atts['image_icon'], 'full'); ?>
            <?php
            } else { ?>
                <i class="<?php echo $icon; ?>"></i>
            <?php } ?>
            <h3> <?php echo $atts['title']; ?> </h3>
            <?php if(!empty($atts['subtitle'])) { ?>
                <p> <?php echo $atts['subtitle']; ?> </p>
            <?php } ?>
        </div>
    </div>

    <?php
    $html = ob_get_clean();
    return $html;
});



// VC Config
add_action( 'vc_before_init', function() {
    if( function_exists('vc_map') ) {
        vc_map(array(
                'name'              => esc_html__('Single feature', 'appland-core'),
                'description'       => esc_html__('Display single feature with title, subtitle and background image.', 'appland-core'),
                'base'              => 'appland_single_feature',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'Flexible to Use',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'subtitle',
                        'value' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'holder' => 'h2'
                    ),

                    array(
                        'type' => 'attach_image',
                        'param_name' => 'bg_image',
                        'heading' => esc_html__('Background image', 'appland-core'),
                    ),

                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'bg_color',
                        'heading' => esc_html__('Background Overlay Color', 'appland-core'),
                    ),

                    array(
                        'type' => 'dropdown',
                        'param_name' => 'select_icon',
                        'heading' => esc_html__('Icon Type', 'appland-core'),
                        'value' => array(
                            'Linear icons' => 'linearicon',
                            'Themify icons' => 'themify_icon',
                            'Image icon' => 'image_icon',
                        )
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
                            'element' => 'select_icon',
                            'value' => 'linearicon'
                        )
                    ),
                    array(
                        'type' => 'iconpicker',
                        'param_name' => 'ti_icon',
                        'heading' => esc_html__('Themify Icon', 'appland-core'),
                        'value' => 'ti-vector',
                        'settings' => array(
                            'type' => 'themify_icon',
                            'iconsPerPage' => 300,
                            'emptyIcon' => false
                        ),
                        'dependency' => array(
                            'element' => 'select_icon',
                            'value' => 'themify_icon'
                        )
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'image_icon',
                        'heading' => esc_html__('Image icon', 'appland-core'),
                        'dependency' => array(
                            'element' => 'select_icon',
                            'value' => 'image_icon'
                        )
                    ),
                ),
            )
        );

    }
});
