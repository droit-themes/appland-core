<?php
add_shortcode('appland_down_sec', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
	    'style' => 'style_01',
        'sec_padding' => '150px 0px 150px 0px',
        'title' => 'GET APP NOW!',
        'subtitle' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed consequuntur magni dolores ratione voluptatem sequi nesciunt.',
        // Featured image
        'featured_image' => '',
        'featured_img_top' => '',
        'featured_img_right' => '',
        'featured_img_btm' => '',
        'featured_image_width' => '100%',
        // Styling
        'overlay_type' => 'gradient',
        'mix_angle' => '0deg',
        'gradient_color_1' => '#4776e6',
        'gradient_color_2' => '#8e54e9',
        'overlay_solid' => '#4776e6',
        'is_br' => '',
        // Background
        'bg_img' => '',
        'bg_img_opacity' => '0.10',
        'title_weight' => 'bold',
        'icon_buttons' => '',
    ),$atts);
    $buttons = vc_param_group_parse_atts($content);
    $icon_buttons = vc_param_group_parse_atts($atts['icon_buttons']);
    if($atts['overlay_type']=='gradient') {
        $bg_color = "background-image: -webkit-linear-gradient({$atts['mix_angle']}, {$atts['gradient_color_1']} 0%, {$atts['gradient_color_2']} 100%) !important;";
    }elseif($atts['overlay_type']=='solid') {
        $bg_color = "background: {$atts['overlay_solid']} !important;";
    }
    $featured_image = wp_get_attachment_image_src($atts['featured_image'], 'full');
    $bg_image = Appland_get_image_src($atts, 'bg_img');
    ?>

    <?php
    if($atts['style']=='style_01') {
        ?>
        <section class="call-action-area voilat-bg-two" style="padding: <?php echo $atts['sec_padding'] . '; ' . $bg_color ?>">
            <?php if (!empty($bg_image)) { ?>
                <div class="video-bg" style="
                        background: url(<?php echo $bg_image; ?>) no-repeat scroll center center/cover;
                        opacity: <?php echo $atts['bg_img_opacity'] ?>;">
                </div>
            <?php } ?>
            <div class="container">
            <div class="row call-action3">
                <div class="col-sm-7">
                    <div class="call-text sec_title_five sec_five <?php echo $atts['is_br']=='true' ? 'has_br' : ''; ?>">
                        <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                        <?php if ($atts['is_br'] == 'true') { ?> <div class="br"></div> <?php } ?>
                        <?php if (!empty($atts['subtitle'])) { ?>
                            <p> <?php echo $atts['subtitle']; ?> </p>
                        <?php } ?>
                        <?php
                        if (is_array($buttons)) {
                            foreach ($buttons as $button) {
                                $btn_bg_color = !empty($button['bg_color']) ? 'background-color:' . $button['bg_color'] . ';' : '';
                                $btn_border_color = !empty($button['border_color']) ? 'border-color:' . $button['border_color'] . ';' : '';

                                if ($button['btn_style'] == 'apple') {
                                    ?>
                                    <a href="<?php echo $button['url'] ?>" class="app-btn"
                                       <?php if(!empty($button['bg_hover_color'])) : ?>
                                        onmouseenter="this.style.backgroundColor='<?php echo $button['bg_hover_color'] ?>'"
                                       <?php endif; ?>
                                       style="<?php echo $btn_bg_color . $btn_border_color; ?>">
                                        <img src="<?php echo plugin_dir_url(__FILE__) ?>images/apple-icon.png" alt="">
                                        <img src="<?php echo plugin_dir_url(__FILE__) ?>images/apple.png" alt="">
                                    </a>
                                    <?php
                                }
                                elseif ($button['btn_style'] == 'google_play') {
                                    ?>
                                    <a href="<?php echo $button['url'] ?>" class="app-btn"
                                        <?php if(!empty($button['bg_hover_color'])) : ?>
                                            onmouseenter="this.style.backgroundColor='<?php echo $button['bg_hover_color'] ?>'"
                                        <?php endif; ?>
                                       style="<?php echo $btn_bg_color . $btn_border_color; ?>">
                                        <img src="<?php echo plugin_dir_url(__FILE__) ?>images/google.png" alt="">
                                        <img src="<?php echo plugin_dir_url(__FILE__) ?>images/google-icon.png"
                                             alt="">
                                    </a>
                                    <?php
                                }
                                elseif ($button['btn_style'] == 'custom') {
                                    $btn_image = wp_get_attachment_image_src($button['btn_image'], 'full');
                                    $btn_hover_image = wp_get_attachment_image_src($button['btn_hover_image'], 'full');
                                    ?>
                                    <a href="<?php echo $button['url'] ?>" class="app-btn"
                                        <?php if(!empty($button['bg_hover_color'])) : ?>
                                            onmouseenter="this.style.backgroundColor='<?php echo $button['bg_hover_color'] ?>'"
                                        <?php endif; ?>
                                       onmouseleave="this.style.backgroundColor='<?php echo $button['bg_color'] ?>'"
                                       style="<?php echo $btn_bg_color . $btn_border_color; ?>">
                                        <img src="<?php echo $btn_image[0]; ?>" alt="">
                                        <img src="<?php echo $btn_hover_image[0] ?>" alt="">
                                    </a>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="call-mobile-img">
                        <?php if (isset($featured_image[0])) {
                            $featured_img_top = !empty($atts['featured_img_top']) ? "top: {$atts['featured_img_top']};" : "";
                            $featured_img_right = !empty($atts['featured_img_right']) ? "right: {$atts['featured_img_right']};" : "";
                            $featured_img_btm = !empty($atts['featured_img_btm']) ? "bottom: {$atts['featured_img_btm']};" : "";
                            $featured_img_position = $featured_img_top.$featured_img_right.$featured_img_btm;
                            ?>
                            <img class="img-responsive" style="<?php echo $featured_img_position; echo 'max-width: '.$atts['featured_image_width'].';'; ?>" src="<?php echo $featured_image[0] ?>" alt="<?php echo $atts['title']; ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <?php
    }

    elseif($atts['style']=='style_02') {
        ?>
        <section class="analysis_area analysis_area_three" style="padding: <?php echo $atts['sec_padding'] . '; ' . $bg_color ?>">
            <div class="container">
                <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                <?php if (!empty($atts['subtitle'])) { ?>
                    <p> <?php echo $atts['subtitle']; ?> </p>
                <?php } ?>
                <?php if (isset($featured_image[0])) { ?>
                    <img class="img-responsive" src="<?php echo $featured_image[0] ?>" alt="">
                <?php } ?>
                <div class="apps_button">
                    <?php
                    if (is_array($icon_buttons)) {
                        foreach ($icon_buttons as $icon_button) {
                            $link = vc_build_link($icon_button['link']);
                            ?>
                            <a href="<?php echo $link['url'] ?>" target="<?php echo str_replace(' ', '', $link['target']) ?>">
                                <i class="<?php echo $icon_button['icon'] ?>"></i>
                                <?php echo $link['title']; ?>
                            </a>
                            <?php
                        }
                    }
                    ?>
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
                'name'              => esc_html__('Download Section', 'appland-core'),
                'description'       => esc_html__('Present your download links with title, subtitle and featured images.', 'appland-core'),
                'base'              => 'appland_down_sec',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'style',
                        'heading' => esc_html__('Style', 'appland-core'),
                        'value' => array(
                            'Style one' => 'style_01',
                            'Style two' => 'style_02',
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_01',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/download1.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_02',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/download2.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'GET APP NOW!',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'subtitle',
                        'value' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed consequuntur magni dolores ratione voluptatem sequi nesciunt.',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'holder' => 'h2'
                    ),

                    // Group : Button
                    array(
                        'type' => 'param_group',
                        'param_name' => 'content',
                        'heading' => esc_html__('Create Buttons', 'appland-core'),
                        'group' => 'Button',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('style_01')
                        ),
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'param_name' => 'btn_style',
                                'heading' => 'Button Style',
                                'value' => array(
                                    'Apple Button' => 'apple',
                                    'Google Play Button' => 'google_play',
                                    'Custom button' => 'custom'
                                ),
                                'admin_label' => true
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'url',
                                'heading' => 'Button URL',
                                'value' => '#'
                            ),
                            array(
                                'type' => 'colorpicker',
                                'param_name' => 'bg_color',
                                'heading' => esc_html__('Background color', 'appland-core'),
                            ),
                            array(
                                'type' => 'colorpicker',
                                'param_name' => 'bg_hover_color',
                                'heading' => esc_html__('Background hover color', 'appland-core'),
                            ),
                            array(
                                'type' => 'colorpicker',
                                'param_name' => 'border_color',
                                'heading' => esc_html__('Border color', 'appland-core'),
                            ),
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'btn_image',
                                'heading' => 'Button image',
                                'description' => 'You can use here a transparent background png image',
                                'dependency' => array(
                                    'element' => 'btn_style',
                                    'value' => 'custom'
                                )
                            ),
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'btn_hover_image',
                                'heading' => 'Button hover image',
                                'description' => 'You can use here a transparent background png image',
                                'dependency' => array(
                                    'element' => 'btn_style',
                                    'value' => 'custom'
                                )
                            ),
                        )
                    ),
                    array(
                        'type' => 'param_group',
                        'param_name' => 'icon_buttons',
                        'heading' => esc_html__('Create Buttons', 'appland-core'),
                        'group' => 'Button',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('style_02')
                        ),
                        'params' => array(
                            array(
                                'type' => 'vc_link',
                                'param_name' => 'link',
                                'heading' => 'Set the button',
                            ),
                            array(
                                'type' => 'iconpicker',
                                'param_name' => 'icon',
                                'heading' => 'Button icon',
                                'settings' => array(
                                    'type' => 'fontawesome',
                                    'iconsPerPage' => 500,
                                    'emptyIcon' => false
                                ),
                            ),
                        )
                    ),

	                // Group : Featured image
	                array(
		                'type' => 'attach_image',
		                'param_name' => 'featured_image',
		                'heading' => esc_html__('Featured image', 'appland-core'),
		                'group' => esc_html__('Featured Image', 'appland-core')
	                ),
	                array(
		                'type' => 'textfield',
		                'param_name' => 'featured_img_top',
		                'heading' => esc_html__('Position from top', 'appland-core'),
		                'group' => esc_html__('Featured Image', 'appland-core')
	                ),
	                array(
		                'type' => 'textfield',
		                'param_name' => 'featured_img_right',
		                'heading' => esc_html__('Position from right', 'appland-core'),
		                'group' => esc_html__('Featured Image', 'appland-core')
	                ),
	                array(
		                'type' => 'textfield',
		                'param_name' => 'featured_img_btm',
		                'heading' => esc_html__('Position from bottom', 'appland-core'),
		                'group' => esc_html__('Featured Image', 'appland-core')
	                ),
	                array(
		                'type' => 'textfield',
		                'param_name' => 'featured_image_width',
		                'heading' => esc_html__('Image width', 'appland-core'),
		                'group' => esc_html__('Featured Image', 'appland-core'),
                        'value' => '100%'
	                ),

	                // Group : Background
	                array(
		                'type' => 'attach_image',
		                'param_name' => 'bg_img',
		                'heading' => esc_html__('Background image', 'appland-core'),
		                'dependency' => array(
			                'element' => 'style',
			                'value' => array('style_01')
		                ),
		                'group' => esc_html__('Background', 'appland-core')
	                ),
	                array(
		                'type' => 'textfield',
		                'param_name' => 'bg_img_opacity',
		                'heading' => esc_html__('Background image opacity', 'appland-core'),
		                'dependency' => array(
			                'element' => 'style',
			                'value' => array('style_01')
		                ),
		                'value' => '0.10',
		                'group' => esc_html__('Background', 'appland-core')
	                ),

                    // Group : Styling
	                array(
		                'type' => 'checkbox',
		                'param_name' => 'is_br',
		                'heading' => esc_html__('Show bottom line under the title?', 'appland-core'),
		                'dependency' => array(
			                'element' => 'style',
			                'value' => array('style_01')
		                ),
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
                        'type' => 'dropdown',
                        'param_name' => 'overlay_type',
                        'heading' => esc_html__('Overlay color type', 'appland-core'),
                        'value' => array(
                            'Gradient color' => 'gradient',
                            'Solid color' => 'solid',
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
