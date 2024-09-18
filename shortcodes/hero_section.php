<?php
add_shortcode('appland_hero_sec', function($atts, $content) {
    ob_start();

    $atts = shortcode_atts(array(
        // Background
        'background_shape' => 'shape1',
        'bg_type' => 'gradient',
        'bg_image' => '',
        'shape_image' => '',
        'gradient_mix_angle' => '145deg',
        'gradient_color1' => '#4776e6',
        'gradient_color2' => '#8e54e9',
        'bg_gradient_angle' => '0deg',
        'bg_solid' => '#4776e6',
        'is_wave' => '',
        'overlay_opacity' => '',
        // Content
        'title' => 'The |perfect| app landing page for your app',
        'subtitle' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit proin leo leo ornare nec vulputate tempus velit nam id purus tellus hendrerit mi dapibus.',
        'title_color' => '',
        'subtitle_color' => '',
        'title_size' => '',
        'subtitle_size' => '',
        // Featured image
        'featured_images' => '',
        'slide_image' => '',
        'featured_image2' => '',
        'is_fi_on_mobile' => '',
        'fi_top' => '',
        'fi_right' => '',
        'fi_bottom' => '',
        'fi_left' => '',
        'background_images' => '',
        'video_url' => '',
        'video_features' => '',
        // Icon Buttons
        'icon_buttons' => 'icon_buttons'
    ),$atts);


    $bg_image = wp_get_attachment_image_src($atts['bg_image'], 'full');
    $icon_buttons = vc_param_group_parse_atts($atts['icon_buttons']);

    $buttons = vc_param_group_parse_atts($content);
    $featured_image = wp_get_attachment_image_src($atts['slide_image'], 'full');
    // Background color conditon
    $bg_color = '';
    if($atts['bg_type']=='gradient') {
        $bg_color = "background-image: -webkit-linear-gradient({$atts['gradient_mix_angle']}, {$atts['gradient_color1']} 0%, {$atts['gradient_color2']} 100%) !important;";
    }
    elseif($atts['bg_type']=='solid') {
        $bg_color = "background: {$atts['bg_solid']} !important;";
    }
    // Background shape style
    switch ($atts['background_shape']) {
        case 'shape1':
            $background_shape = 'home-four';
            break;
        case 'shape2':
            $background_shape = 'header-home-two';
            break;
        case 'shape3':
            $background_shape = 'home-three';
            break;
        case 'shape4':
            $background_shape = '';
            break;
    }
    $top = !empty($atts['fi_top']) ? 'top:'.$atts['fi_top'].';' : '';
    $right = !empty($atts['fi_right']) ? 'right:'.$atts['fi_right'].';' : '';
    $bottom = !empty($atts['fi_bottom']) ? 'bottom:'.$atts['fi_bottom'].';' : '';
    $left = !empty($atts['fi_left']) ? 'left:'.$atts['fi_left'].';' : '';
	$is_fi_on_mobile = $atts['is_fi_on_mobile']!='true' ? 'hidden-xs' : '';

	$title_color = Appland_shortcode_style('color', $atts, 'title_color', 0);
	$subtitle_color = Appland_shortcode_style('color', $atts, 'subtitle_color', 0);
	$title_size = Appland_shortcode_style('font-size', $atts, 'title_size', 0);
	$subtitle_size = Appland_shortcode_style('font-size', $atts, 'subtitle_size', 0);
    ?>

    <?php
    if($atts['background_shape']=='shape1' || $atts['background_shape']=='shape2' || $atts['background_shape']=='shape3' || $atts['background_shape']=='shape4') {
        if(!empty($atts['bg_solid'])) { ?>
            <style>
                .header-overlay:before {
                    content: "";
                    width: 100%;
                    height: 100%;
                    top: 0;
                    left: 0;
                    background: <?php echo $atts['bg_solid']; ?>;
                    opacity: 0.75;
                    z-index: -1;
                    position: absolute;
                }
            </style>
            <?php
        }
        ?>
        <section class="header-home <?php echo $background_shape; ?>" style="<?php echo $bg_color; ?>">
            <?php if ($atts['is_wave'] == 'true') { ?>
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
                    <div class="col-sm-8 col-header-text lr-padding <?php if($is_fi_on_mobile=='hidden-xs') echo 'xs-padding'; ?>">
                        <h1> <?php appland_spanTag($atts['title']); ?> </h1>
                        <?php if(!empty($atts['subtitle'])) { ?> <p> <?php echo $atts['subtitle']; ?> </p> <?php } ?>
                        <?php
                        if (is_array($buttons)) {
                        foreach ($buttons as $button) {
                            $btn = !empty($button['btn']) ? vc_build_link($button['btn']) : '';
                            $btn_type = !empty($button['btn_type']) ? $button['btn_type'] : '';
                            $style_class = '';
                            if ($button['btn_style'] == 'bg_btn') {
                                $style_class = 'btn-white';
                            } elseif ($button['btn_style'] == 'transparent_btn') {
                                $style_class = 'btn-transparent';
                            }
                            if($btn_type == 'theme_btn' & !empty($btn['title'])) { ?>
                                <a class="banner_btn <?php echo $style_class; ?>" href="<?php echo $btn['url'] ?>"
                                   target="<?php echo $btn['target']; ?>"> <?php echo $btn['title']; ?> </a>
                                <?php
                            }elseif($btn_type == 'btn_shortcode') {
                                echo do_shortcode($button['btn_shortcode']);
                            }
                        }}
                        ?>
                    </div>
                    <div class="col-sm-4 col-md-offset-1 col-md-3 col-header-img right-padding <?php echo $is_fi_on_mobile; ?>">
                        <?php
                        if(isset($featured_image[0])) { ?>
                        <img src="<?php echo $featured_image[0]; ?>" alt="header-img" class="img-header-lg" style="<?php echo $top . $right . $bottom . $left; ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    elseif($atts['background_shape'] == 'shape5') {
        require_once plugin_dir_path(__FILE__) . 'hero_sections/hero5.php';
    }

    elseif($atts['background_shape'] == 'Background_image_slider') {
        require_once plugin_dir_path(__FILE__) . 'hero_sections/hero6.php';
    }

    elseif($atts['background_shape'] == 'Background_videos') {
        require_once plugin_dir_path(__FILE__) . 'hero_sections/hero7.php';
    }

    elseif($atts['background_shape'] == 'app_screens') {
        require_once plugin_dir_path(__FILE__) . 'hero_sections/hero8.php';
    }
    
    elseif($atts['background_shape'] == 'app_screens2') {
        require_once plugin_dir_path(__FILE__) . 'hero_sections/hero9.php';
    }

    elseif($atts['background_shape'] == 'shape10') {
        require_once plugin_dir_path(__FILE__) . 'hero_sections/hero10.php';
    }

    $html = ob_get_clean();
    return $html;
});



// VC Config
add_action( 'vc_before_init', function() {
    if( function_exists('vc_map') ) {
        vc_map(array(
                'name'              => esc_html__('Hero Section', 'appland-core'),
                'description'       => esc_html__('Create Hero Section', 'appland-core'),
                'base'              => 'appland_hero_sec',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(

                    // Background
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'background_shape',
                        'heading' => esc_html__('Background Shape Style', 'appland-core'),
                        'description' => esc_html__('Select a background shape style.', 'appland-core'),
                        'value' => array(
                            'Shape one' => 'shape1',
                            'Shape two' => 'shape2',
                            'Shape three' => 'shape3',
                            'Shape four' => 'shape4',
                            'Shape five' => 'shape5',
                            'Shape six (Background image slides)' => 'Background_image_slider',
                            'Shape seven (Video Background)' => 'Background_videos',
                            'Shape eight (app screens)' => 'app_screens',
                            'Shape Nine (app screens)' => 'app_screens2',
                            'Shape Ten' => 'shape10',
                        ),
                        'std' => 'shape1',
                        'group' => 'Background'
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'shape1',
                        'heading' => esc_html__('Shape one', 'appland-core'),
                        'group' => 'Background',
                        'value' => plugin_dir_url(__FILE__).'images/hero1.jpg',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'shape1'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'shape2',
                        'heading' => esc_html__('Shape two', 'appland-core'),
                        'group' => 'Background',
                        'value' => plugin_dir_url(__FILE__).'images/hero2.jpg',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'shape2'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'shape3',
                        'heading' => esc_html__('Shape three', 'appland-core'),
                        'group' => 'Background',
                        'value' => plugin_dir_url(__FILE__).'images/hero3.jpg',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'shape3'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'shape4',
                        'heading' => esc_html__('Shape four', 'appland-core'),
                        'group' => 'Background',
                        'value' => plugin_dir_url(__FILE__).'images/hero4.jpg',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'shape4'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'shape5',
                        'heading' => esc_html__('Shape five', 'appland-core'),
                        'group' => 'Background',
                        'value' => plugin_dir_url(__FILE__).'images/hero5.jpg',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'shape5'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'shape6',
                        'heading' => esc_html__('Shape six', 'appland-core'),
                        'group' => 'Background',
                        'value' => plugin_dir_url(__FILE__).'images/hero6.jpg',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'shape6'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'shape7',
                        'heading' => esc_html__('Shape seven', 'appland-core'),
                        'group' => 'Background',
                        'value' => plugin_dir_url(__FILE__).'images/hero7.jpg',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'Background_videos'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'shape8',
                        'heading' => esc_html__('Shape eight (app screens)', 'appland-core'),
                        'group' => 'Background',
                        'value' => plugin_dir_url(__FILE__).'images/hero8.jpg',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'app_screens'
                        ),
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'shape_image',
                        'heading' => esc_html__('Shape image', 'appland-core'),
                        'description' => esc_html__('Change the default shape image', 'appland-core'),
                        'group' => 'Background',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'app_screens'
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'video_url',
                        'heading' => esc_html__('Video URL', 'appland-core'),
                        'description' => esc_html__('.mp4, .webm, youtube, vimeo\'s video supported.', 'appland-core'),
                        'group' => 'Background',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'Background_videos'
                        ),
                    ),
                    array(
                        'type' => 'param_group',
                        'param_name' => 'video_features',
                        'heading' => esc_html__('Features', 'appland-core'),
                        'description' => esc_html__('Features will show on the Video Hero Section (the last style) only.', 'appland-core'),
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'Background_videos'
                        ),
                        'group' => 'Content',
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'param_name' => 'title',
                                'heading' => esc_html__('Title', 'appland-core'),
                                'admin_label' => true,
                                'value' => 'Awesome design',
                            ),
                            array(
                                'type' => 'textarea',
                                'param_name' => 'subtitle',
                                'heading' => esc_html__('Subtitle', 'appland-core'),
                                'value' => 'Consectetur adipiscing elit donec tempus pellentesque dui.'
                            ),
                            array(
                                'type' => 'iconpicker',
                                'param_name' => 'icon',
                                'heading' => esc_html__('Icon', 'appland-core'),
                                'value' => 'ti-vector',
                                'settings' => array(
                                    'type' => 'themify_icon',
                                    'iconsPerPage' => 200,
                                    'emptyIcon' => false
                                ),
                            ),
                        )
                    ),
                    array(
                        'type' => 'attach_images',
                        'param_name' => 'background_images',
                        'heading' => esc_html__('Background Images', 'appland-core'),
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'Background_image_slider'
                        ),
                        'group' => 'Background'
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'bg_type',
                        'heading' => esc_html__('Background style', 'appland-core'),
                        'value' => array(
                            'Gradient color' => 'gradient',
                            'Solid color' => 'solid',
                        ),
                        'std' => 'gradient',
                        'group' => 'Background',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => array('shape1', 'shape2', 'shape3', 'shape4', 'shape5', 'Background_image_slider', 'Background_videos', 'app_screens2', 'shape10')
                        )
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'bg_image',
                        'heading' => esc_html__('Background Image', 'appland-core'),
                        'dependency' => array(
                            'element' => 'bg_type',
                            'value' => 'image'
                        ),
                        'group' => 'Background'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => __( 'Solid background color', 'appland-core' ),
                        'param_name' => 'bg_solid',
                        'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                        'value' => '#4776e6',
                        'dependency' => array(
                            'element' => 'bg_type',
                            'value' => array( 'solid' ),
                        ),
                        'edit_field_class' => 'vc_col-sm-4',
                        'group' => 'Background'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => __( 'Gradient Color 1', 'appland-core' ),
                        'param_name' => 'gradient_color1',
                        'description' => __( 'Select first color for gradient.', 'appland-core' ),
                        'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                        'value' => '#4776e6',
                        'dependency' => array(
                            'element' => 'bg_type',
                            'value' => array( 'gradient' ),
                        ),
                        'edit_field_class' => 'vc_col-sm-4',
                        'group' => 'Background'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => __( 'Gradient Color 2', 'appland-core' ),
                        'param_name' => 'gradient_color2',
                        'description' => __( 'Select second color for gradient.', 'appland-core' ),
                        'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                        'value' => '#8e54e9',
                        'dependency' => array(
                            'element' => 'bg_type',
                            'value' => array( 'gradient' ),
                        ),
                        'edit_field_class' => 'vc_col-sm-4',
                        'group' => 'Background'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Color mix angle', 'appland-core' ),
                        'param_name' => 'mix_angle',
                        'description' => __( 'Enter the color mix angle in deg (Example: 10deg).', 'appland-core' ),
                        'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                        'value' => '0deg',
                        'dependency' => array(
                            'element' => 'bg_type',
                            'value' => array( 'gradient' ),
                        ),
                        'edit_field_class' => 'vc_col-sm-4',
                        'group' => 'Background'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'overlay_opacity',
                        'heading' => esc_html__('Overlay Color Opacity', 'appland-core'),
                        'group' => 'Background',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => array('Background_image_slider')
                        )
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_wave',
                        'heading' => esc_html__('Use wav effect in background.', 'appland-core'),
                        'group' => 'Background',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => array('shape1', 'shape2', 'shape3', 'shape4', 'shape5')
                        )
                    ),

                    /**
                     * Content
                     */
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'The |perfect| app landing page for your app',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'description' => esc_html__('Wrap up the bold text with this "|" symbol (Example: |Bold Text|). Use <br> tag for line breaking', 'appland-core'),
                        'admin_label' => true,
                        'group' => 'Content'
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'subtitle',
                        'value' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit proin leo leo ornare nec vulputate tempus velit nam id purus tellus hendrerit mi dapibus.',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'description' => esc_html__('Use <br> tag for line breaking', 'appland-core'),
                        'admin_label' => true,
                        'group' => 'Content'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'title_color',
                        'heading' => esc_html__('Title color', 'appland-core'),
                        'group' => 'Content'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title_size',
                        'heading' => esc_html__('Title Font Size', 'appland-core'),
                        'description' => esc_html__('Input the Title Font Size with including the measure unit (Eg. 45px)', 'appland-core'),
                        'group' => 'Content',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'subtitle_color',
                        'heading' => esc_html__('Subtitle color', 'appland-core'),
                        'group' => 'Content',
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'subtitle_size',
                        'heading' => esc_html__('Subtitle Font Size', 'appland-core'),
                        'description' => esc_html__('Input the Title Font Size with including the measure unit (Eg. 16px)', 'appland-core'),
                        'group' => 'Content',
                    ),

                    /**
                     * Featured image
                     */

                    array(
                        'type' => 'param_group',
                        'param_name' => 'featured_images',
                        'heading' => esc_html__('Featured images', 'appland-core'),
                        'group' => 'Featured Image',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'app_screens'
                        ),
                        'params' => array(
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'featured_image',
                                'heading' => esc_html__('Featured Image', 'appland-core'),
                            ),
                            array(
                                'type' => 'checkbox',
                                'param_name' => 'is_fi_on_mobile',
                                'heading' => esc_html__('Show on mobile?', 'appland-core'),
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'fi_alt_text',
                                'heading' => esc_html__('Image alter text', 'appland-core'),
                                'description' => esc_html__('This text will show instead of the the image if in case the image is not load.', 'appland-core'),
                                'admin_label' => true,
                                'value' => get_bloginfo('name').' app screenshot'
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'animation_delay',
                                'heading' => esc_html__('Animation delay', 'appland-core'),
                                'description' => esc_html__('Input the animation delay time in second', 'appland-core'),
                                'value' => '0.8'
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'fi_top',
                                'heading' => esc_html__('Position from top', 'appland-core'),
                            ),array(
                                'type' => 'textfield',
                                'param_name' => 'fi_right',
                                'heading' => esc_html__('Position from right', 'appland-core'),
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'fi_bottom',
                                'heading' => esc_html__('Position from bottom', 'appland-core'),
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'fi_left',
                                'heading' => esc_html__('Position from left', 'appland-core'),
                            ),
                        ),
                    ),

                    array(
                        'type' => 'attach_image',
                        'param_name' => 'slide_image',
                        'heading' => esc_html__('Featured Image', 'appland-core'),
                        'group' => 'Featured Image',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => array('shape1', 'shape2', 'shape3', 'shape4', 'shape5', 'Background_image_slider', 'app_screens2', 'shape10')
                        )
                    ),

                    array(
                        'type' => 'attach_image',
                        'param_name' => 'featured_image2',
                        'heading' => esc_html__('Second Featured Image', 'appland-core'),
                        'group' => 'Featured Image',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'app_screens2'
                        )
                    ),

                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_fi_on_mobile',
                        'heading' => esc_html__('Show on mobile?', 'appland-core'),
                        'group' => 'Featured Image',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => array('shape1', 'shape2', 'shape3', 'shape4', 'shape5', 'Background_image_slider', 'shape10')
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'fi_top',
                        'value' => '',
                        'heading' => esc_html__('Position from top', 'appland-core'),
                        'description' => esc_html__('Leave this field empty or "auto" if you use the Position from bottom', 'appland-core'),
                        'group' => 'Featured Image',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => array('shape1', 'shape2', 'shape3', 'shape4', 'shape5', 'Background_image_slider', 'shape10')
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'fi_right',
                        'value' => '',
                        'heading' => esc_html__('Position from right', 'appland-core'),
                        'description' => esc_html__('Leave this field empty or "auto" if you use the Position from left', 'appland-core'),
                        'group' => 'Featured Image',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => array('shape1', 'shape2', 'shape3', 'shape4', 'shape5', 'Background_image_slider','shape10')
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'fi_bottom',
                        'heading' => esc_html__('Position from bottom', 'appland-core'),
                        'description' => esc_html__('Leave this field empty or "auto" if you use the Position from bottom', 'appland-core'),
                        'group' => 'Featured Image',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => array('shape1', 'shape2', 'shape3', 'shape4', 'shape5', 'Background_image_slider', 'shape10')
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'fi_left',
                        'heading' => esc_html__('Position from left', 'appland-core'),
                        'description' => esc_html__('Leave this field empty or "auto" if you use the Position from right', 'appland-core'),
                        'group' => 'Featured Image',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => array('shape1', 'shape2', 'shape3', 'shape4', 'shape5', 'Background_image_slider', 'shape10')
                        )
                    ),


                    /**
                     * Buttons
                     */
                    array(
                        'type' => 'param_group',
                        'param_name' => 'content',
                        'heading' => esc_html__('Create Buttons', 'appland-core'),
                        'group' => 'Buttons',
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'param_name' => 'btn_type',
                                'heading' => esc_html__('Button type', 'appland-core'),
                                'value' => array(
                                    "Theme's button" => 'theme_btn',
                                    'Custom shortcode button' => 'btn_shortcode',
                                ),
                                'admin_label' => true
                            ),
                            array(
                                'type' => 'dropdown',
                                'param_name' => 'btn_style',
                                'heading' => esc_html__('Button style', 'appland-core'),
                                'admin_label' => true,
                                'value' => array(
                                    "Background filled" => 'bg_btn',
                                    'Background transparent' => 'transparent_btn',
                                ),
                                'dependency' => array(
                                    'element' => 'btn_type',
                                    'value' => 'theme_btn',
                                )
                            ),
                            array(
                                'type' => 'vc_link',
                                'param_name' => 'btn',
                                'heading' => esc_html__('Set Button', 'appland-core'),
                                'description' => esc_html__('Set the button label with URL', 'appland-core'),
                                'dependency' => array(
                                    'element' => 'btn_type',
                                    'value' => 'theme_btn',
                                )
                            ),
                            array(
                                'type' => 'textarea',
                                'param_name' => 'btn_shortcode',
                                'heading' => esc_html__('Button shortcode', 'appland-core'),
                                'description' => esc_html__('Enter here the custom button shortcode.', 'appland-core'),
                                'dependency' => array(
                                    'element' => 'btn_type',
                                    'value' => 'btn_shortcode'
                                )
                            ),
                        )
                    ),

                    // Icon Buttons
                    /*array(
                        'type' => 'param_group',
                        'param_name' => 'icon_buttons',
                        'heading' => esc_html__('Icon Buttons', 'appland-core'),
                        'group' => 'Buttons',
                        'dependency' => array(
                            'element' => 'background_shape',
                            'value' => 'shape10'
                        ),
                        'params' => array(
                            array(
                                'type' => 'iconpicker',
                                'param_name' => 'icon',
                                'heading' => esc_html__('Icon', 'appland-core'),
                                'value' => 'fa fa-apple',
                                'settings' => array(
                                    'type' => 'fontawesome',
                                    'iconsPerPage' => 200,
                                    'emptyIcon' => false
                                ),
                                'admin_label' => true
                            ),
                            array(
                                'type' => 'vc_link',
                                'param_name' => 'btn',
                                'heading' => esc_html__('Set Button', 'appland-core'),
                                'description' => esc_html__('Set the button label with URL', 'appland-core'),
                                'dependency' => array(
                                    'element' => 'btn_type',
                                    'value' => 'theme_btn',
                                )
                            ),
                            array(
                                'type' => 'colorpicker',
                                'param_name' => 'color',
                                'heading' => esc_html__('Icon Color', 'appland-core'),
                            ),
                        )
                    ),*/

                ),
            )
        );

    }
});
