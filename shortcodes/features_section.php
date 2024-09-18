<?php
add_shortcode('appland_feature', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title' => 'EXCLUSIVE FEATURES',
        'subtitle' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
        'sec_padding' => '150px 0px 70px',
        'color_scheme' => 'gradient',
        'mix_angle' => '0deg',
        'gradient_color_1' => '#4776e6',
        'gradient_color_2' => '#8e54e9',
        'solid' => '#4776e6',
        'style' => 'style_01',
        'title_font_size' => '20px',
        'icon_size' => '60px',
        'is_br' => '',
        'title_weight' => 'bold',
        'column' => '4',
        'background_shape' => '',
    ),$atts);
    $features = vc_param_group_parse_atts($content);
    ?>

    <?php
    if($atts['style']=='style_01') {
        ?>
        <section class="more_feature_area more_features_four" style="padding: <?php echo $atts['sec_padding']; ?>;">
            <div class="container">
                <div class="section_title text-center <?php echo ($atts['is_br'] != 'true') ? 'no-br' : ''; ?>">
                    <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                    <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
                    <?php if (!empty($atts['subtitle'])) { ?>
                        <p> <?php echo $atts['subtitle']; ?> </p>
                    <?php } ?>
                </div>
                <div class="row more_features exclusive_features-two">
                    <?php
                    foreach ($features as $feature) {
                        $icon_type = isset($feature['icon_type']) ? $feature['icon_type'] : '';
                        ?>
                        <div class="col-md-<?php echo $atts['column'] ?> col-sm-6">
                            <div class="media">
                                <div class="media-left">
                                    <?php if($icon_type=='icon_font') { ?>
                                        <i style="<?php echo Appland_FontSize( $atts, 'icon_size' ); ?>"
                                           class="<?php echo $feature['icon']; ?>"></i>
	                                    <?php
                                    }elseif($icon_type=='image_icon') {
	                                    $image_icon = wp_get_attachment_image_src($feature['image_icon'], 'full');
	                                    $image_icon = isset($image_icon[0]) ? $image_icon[0] : '';
	                                    echo "<img src='{$image_icon}' alt=''>";
                                    }
                                    ?>
                                </div>
                                <div class="media-body">
                                    <h2 style="<?php echo Appland_FontSize($atts, 'title_font_size'); ?>"> <?php echo esc_html($feature['title']) ?> </h2>
                                    <?php if (!empty($feature['subtitle'])) { ?>
                                        <p> <?php echo $feature['subtitle']; ?> </p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }

    elseif($atts['style']=='style_02') {
        ?>
        <section class="overview_area" style="padding: <?php echo $atts['sec_padding']; ?>;">
            <div class="container">
                <div class="row">
                    <?php
                    foreach ($features as $feature) {
	                    $icon_type = isset($feature['icon_type']) ? $feature['icon_type'] : '';
                        ?>
                        <div class="col-md-<?php echo $atts['column'] ?> col-sm-6">
                            <div class="overview_item">
	                            <?php if($icon_type=='icon_font') { ?>
                                    <i style="<?php echo Appland_FontSize( $atts, 'icon_size' ); ?>" class="<?php echo $feature['icon']; ?>"></i>
		                            <?php
	                            }elseif($icon_type=='image_icon') {
	                                $image_icon = wp_get_attachment_image_src($feature['image_icon'], 'full');
	                                $image_icon = isset($image_icon[0]) ? $image_icon[0] : '';
		                            echo "<img src='{$image_icon}' alt=''>";
	                            }
	                            ?>
                                <h2 class="title"><?php echo esc_html($feature['title']) ?></h2>
                                <?php if (!empty($feature['subtitle'])) { ?>
                                    <p> <?php echo $feature['subtitle']; ?> </p>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
    elseif($atts['style']=='style_03') {
        $background_shape = wp_get_attachment_image_src($atts['background_shape'], 'full');
        $background_shape = !empty($background_shape[0]) ? $background_shape[0] : plugin_dir_url(__FILE__).'images/new-app/shape_bg_02.png';
        ?>
        <section class="new_exclusive_features_area">
            <img class="triangle_shape" src="<?php echo $background_shape; ?>" alt="triangle">
            <div class="features_container" style="padding: <?php echo $atts['sec_padding']; ?>;">
            <div class="container">
                <div class="new_section_heading text-center">
                    <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                    <?php if (!empty($atts['subtitle'])) { ?>
                        <p class="p_font"> <?php echo $atts['subtitle']; ?> </p>
                    <?php } ?>
                </div>
                <div class="row">
                    <?php
                    foreach ($features as $feature) {
                        $icon_type = isset($feature['icon_type']) ? $feature['icon_type'] : '';
                        $bg_image = !empty($feature['bg_image']) ? wp_get_attachment_image_url($feature['bg_image'],'full') : plugin_dir_url(__FILE__).'images/new-app/features_icon_s.png';
                        $icon_color = !empty($feature['icon_color']) ? 'color:'.$feature['icon_color'].';' : '';
                        ?>
                        <div class="col-md-<?php echo $atts['column'] ?>">
                        <div class="new_ex_features_item text-center">
                            <div class="new_features_icon">
                                <img class="wow slideInDown" src="<?php echo esc_url($bg_image) ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                                <?php if($icon_type == 'icon_font') { ?>
                                    <i style="<?php echo Appland_FontSize( $atts, 'icon_size' ).$icon_color; ?>" class="<?php echo $feature['icon']; ?> wow fadeIn"></i>
                                    <?php
                                }elseif($icon_type == 'image_icon') {
                                    $image_icon = wp_get_attachment_image_src($feature['image_icon'], 'full');
                                    $image_icon = isset($image_icon[0]) ? $image_icon[0] : '';
                                    echo "<img src='{$image_icon}' alt=''>";
                                }
                                ?>
                            </div>
                            <h3 class="title_h3 wow fadeInLeft" style="<?php echo Appland_FontSize($atts, 'title_font_size'); ?>"> <?php echo esc_html($feature['title']) ?> </h3>
                            <?php if (!empty($feature['subtitle'])) { ?>
                                <p class="p_font wow fadeInUp" data-wow-delay="0.3s"> <?php echo $feature['subtitle']; ?> </p>
                            <?php } ?>
                        </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            </div>
        </section>
        <?php

        }
        elseif($atts['style']=='style_04') {
        ?>
        <section class="overview_area" style="padding: <?php echo $atts['sec_padding']; ?>;">
            <div class="container">
             <div class="new_section_heading text-center">
                        <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                        <?php if (!empty($atts['subtitle'])) { ?>
                            <p class="p_font"> <?php echo $atts['subtitle']; ?> </p>
                        <?php } ?>
                    </div>
                 <div class="row">
                        <?php
                        foreach ($features as $feature) {
                            $icon_type = isset($feature['icon_type']) ? $feature['icon_type'] : '';
                            ?>
                            <div class="col-md-<?php echo $atts['column'] ?>">
                                <div class="new_ex_features_item text-center">
                                    <div class="new_features_icon">
                                        <img class="wow slideInDown" src="<?php echo plugin_dir_url(__FILE__) ?>images/new-app/features_icon_s.png" alt="app">
                                        <?php if($icon_type=='icon_font') { ?>
                                            <i style="<?php echo Appland_FontSize( $atts, 'icon_size' ); ?>" class="<?php echo $feature['icon']; ?> wow fadeIn"></i>
                                            <?php
                                        }elseif($icon_type=='image_icon') {
                                            $image_icon = wp_get_attachment_image_src($feature['image_icon'], 'full');
                                            $image_icon = isset($image_icon[0]) ? $image_icon[0] : '';
                                            echo "<img src='{$image_icon}' alt=''>";
                                        }
                                        ?>
                                    </div>
                                    <h3 class="title_h3 wow fadeInLeft" style="<?php echo Appland_FontSize($atts, 'title_font_size'); ?>"> <?php echo esc_html($feature['title']) ?> </h3>
                                    <?php if (!empty($feature['subtitle'])) { ?>
                                        <p class="p_font wow fadeInUp" data-wow-delay="0.3s"> <?php echo $feature['subtitle']; ?> </p>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
            </div>
        </section>
        <?php
    }

    $html = ob_get_clean();
    return $html;
});



// VC Config
add_action( 'vc_before_init', function() {

    if( function_exists('vc_map') ) {
        vc_map(array(
                'name'              => esc_html__('Features Section', 'appland-core'),
                'description'       => esc_html__('Display a feature items with title and subtitle.', 'appland-core'),
                'base'              => 'appland_feature',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'style',
                        'heading' => esc_html__('Style', 'appland-core'),
                        'value' => array(
                           'Style One' => 'style_01',
                           'Style Two' => 'style_02',
                           'Style Three' => 'style_03',
                           'Style Four' => 'style_04',
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_01',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/features1.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_02',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/features2.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_03',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/features3.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_03'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_04',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/features4.png',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_04'
                        ),
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'background_shape',
                        'heading' => esc_html__('Background shape image', 'appland-core'),
                        'description' => esc_html__('Upload here your background shape image if your want to use your own shape instead of the default.', 'appland-core'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_03'
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'column',
                        'heading' => esc_html__('Select Column', 'appland-core'),
                        'description' => esc_html__('Choose the every column measurement.', 'appland-core'),
                        'value' => array(
                            '3/12' => '3',
                            '4/12' => '4',
                            '6/12' => '6',
                        ),
                        'std' => '4'
                    ),

                    // Contents
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'EXCLUSIVE FEATURES',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'admin_label' => true,
                        'group' => esc_html__('Title', 'appland-core')
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'subtitle',
                        'value' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'admin_label' => true,
                        'group' => esc_html__('Title', 'appland-core')
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_br',
                        'heading' => esc_html__('Is bottom line under the title?', 'appland-core'),
                        'group' => esc_html__('Title', 'appland-core'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        ),
                    ),

                    // Features
                    array(
                        'type' => 'param_group',
                        'param_name' => 'content',
                        'heading' => esc_html__('Create Features', 'appland-core'),
                        'group' => esc_html__('Features', 'appland-core'),
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
                            ),
                            array(
                                'type' => 'dropdown',
                                'param_name' => 'icon_type',
                                'heading' => esc_html__('Icon type', 'appland-core'),
                                'value' => array(
                                    esc_html__('Icon font', 'appland-core') => 'icon_font',
                                    esc_html__('Image icon', 'appland-core') => 'image_icon'
                                )
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
                                'dependency' => array(
                                    'element' => 'icon_type',
                                    'value' => 'icon_font'
                                )
                            ),
                            array(
                                'type' => 'colorpicker',
                                'param_name' => 'icon_color',
                                'heading' => esc_html__('Icon Color', 'appland-core'),
                                'dependency' => array(
                                    'element' => 'icon_type',
                                    'value' => 'icon_font'
                                )
                            ),
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'image_icon',
                                'heading' => esc_html__('Image icon', 'appland-core'),
                                'dependency' => array(
	                                'element' => 'icon_type',
	                                'value' => 'image_icon'
                                )
                            ),
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'bg_image',
                                'heading' => esc_html__('Background Image', 'appland-core'),
                            ),
                        )
                    ),

                    // --------------------------- Group : Styling -----------------------------
                    array(
                        'type' => 'textfield',
                        'param_name' => 'sec_padding',
                        'heading' => esc_html__('Section padding', 'appland-core'),
                        'description' => 'Input the padding as clock wise (Top Right Bottom Left)',
                        'value' => '150px 0px 70px',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'icon_size',
                        'heading' => esc_html__('Feature item icon font size', 'appland-core'),
                        'value' => '60px',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title_font_size',
                        'heading' => esc_html__('Feature item title font size', 'appland-core'),
                        'value' => '20px',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'title_weight',
                        'heading' => esc_html__('Title font weight', 'appland-core'),
                        'std' => 'bold',
                        'value' => array(
                            'Normal' => 'normal',
                            'Lighter' => 'lighter',
                            'Bold'  => 'bold',
                            'Bolder'  => 'bolder'
                        ),
                        'group' => 'Styling'
                    ),
                ),
            )
        );

    }
});
