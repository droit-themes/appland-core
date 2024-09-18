<?php
add_shortcode('appland_two_column_row', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title' => 'Major Functionalities',
        'subtitle' => 'Enhance Your Brand Potential With Giant Advertising Blimps',
        'title_weight' => 'bold',
        'title_size' => '36px',
        'title_color' => '#282835',
        'subtitle_size' => '16px',
        'subtitle_color' => '#797988',
        'sec_padding' => ''
    ),$atts);
    $rows = vc_param_group_parse_atts($content)
    ?>
    <section class="major_function_area" <?php if(!empty($atts['sec_padding'])) : ?> style="padding: <?php echo $atts['sec_padding'] ?>;" <?php endif; ?>>
        <div class="container">
            <div class="new_section_heading text-center">
                <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); Appland_FontSize($atts, 'title_size'); ?> color: <?php echo $atts['title_color']; ?>"> <?php echo $atts['title']; ?> </h2>
                <?php if(!empty($atts['subtitle'])) : ?>
                <p style="<?php Appland_FontWeight($atts, 'subtitle_weight'); Appland_FontSize($atts, 'subtitle_size'); ?> color: <?php echo $atts['subtitle_color']; ?>" class="p_font"> <?php echo esc_html($atts['subtitle']); ?> </p>
                <?php endif; ?>
            </div>
            <?php
            $i = 0;
            foreach ($rows as $row) {
                $featured_image = wp_get_attachment_image_src($row['featured_image'], 'full');
                $featured_image = !empty($featured_image[0]) ? $featured_image[0] : plugin_dir_url(__FILE__);
                $fi_margin = !empty($row['fi_margin']) ? "style='margin: {$row['fi_margin']};'" : '';
                $featured_image_bg = wp_get_attachment_image_src($row['featured_image_bg'], 'full');
                $featured_image_bg = !empty($featured_image_bg[0]) ? $featured_image_bg[0] : plugin_dir_url(__FILE__).'images/new-app/shape_bg_03.jpg';
                $btn = vc_build_link($row['btn']);
                $margin = $i!=0 ? ' pt_100' : '';
                $is_reverse_row = !empty($row['is_reverse_row']) ? $row['is_reverse_row'] : '';
                $is_box_shadow = !empty($row['is_box_shadow']) ? $row['is_box_shadow'] : '';
                $is_box_shadow = $is_box_shadow=='true' ? 'app_mockpu_box_shadow' : '';
                $padding_top = !empty($row['padding_top']) ? 'style="padding-top:'.$row['padding_top'].';"' : '';

                $top = !empty($row['bg_top']) ? 'top:'.$row['bg_top'].';' : '';
                $right = !empty($row['bg_right']) ? 'right:'.$row['bg_right'].';' : '';
                $bottom = !empty($row['bg_bottom']) ? 'bottom:'.$row['bg_bottom'].';' : '';
                $left = !empty($row['bg_left']) ? 'left:'.$row['bg_left'].';' : '';
                $bg_position = "style='$top $right $bottom $left'"
                ?>
                <div class="row  <?php echo $is_reverse_row == 'true' ? 'row-reverse' : ''; echo $margin; ?>  d_flex" <?php echo $padding_top; ?>>
                    <div class="col-md-7 <?php echo $i%2==0 ? 'text-center' : '' ?>">
                        <div class="new_app_mockup <?php echo $i%2!=0 ? 'new_app_mockup_left small_shap' : 'new_app_mockup_right' ?>">
                            <img class="back_img" <?php echo $bg_position; ?> src="<?php echo $featured_image_bg; ?>" alt="app">
                            <div class="app_mockup wow slideInUp <?php echo esc_attr($is_box_shadow) ?>">
                                <img src="<?php echo esc_url($featured_image); ?>" <?php echo $fi_margin; ?> alt="app">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d_flex">
                        <div class="mojar_function_content <?php echo $i%2==0 ? 'pd_right' : 'pd_left' ?> flex">
                            <?php if($row['select_font']=='linearicon') { ?>
                                <i class="<?php echo $row['lnr_icon'] ?> icon"></i>
                            <?php }elseif($row['select_font']=='themify_icon') { ?>
                                <i class="<?php echo $row['icon'] ?> icon"></i>
                            <?php } elseif($row['select_font']=='image_icon') {
                                $image_icon = wp_get_attachment_image_src($row['image_icon'], 'full'); ?>
                                <img src="<?php echo $image_icon[0] ?>" alt="<?php echo esc_attr($row['title']); ?>">
                            <?php } ?>
                            <h3 class="title_h3"> <?php echo esc_html($row['title']) ?> </h3>
                            <?php if(!empty($row['subtitle'])) { ?> <p class="p_font"> <?php echo esc_html($row['subtitle']) ?> </p> <?php } ?>
                            <a href="<?php echo esc_url($btn['url']) ?>" target="<?php echo esc_attr($btn['target']) ?>" class="app_banner_btn_two"> <?php echo esc_html($btn['title']) ?> </a>
                        </div>
                    </div>
                </div>
                <?php
                ++$i;
            }
            ?>
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
                'name'              => esc_html__('Two column info', 'appland-core'),
                'description'       => esc_html__('Display your info in two column rows', 'appland-core'),
                'base'              => 'appland_two_column_row',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(

                    // General things
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'Major Functionalities',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'subtitle',
                        'value' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'show_the_design',
                        'heading' => 'Display the design',
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_01',
                        'heading' => 'See the section design',
                        'value' => plugin_dir_url(__FILE__).'images/two_clumn_info.jpg',
                        'dependency' => array(
                            'element' => 'show_the_design',
                            'value' => 'true'
                        )
                    ),

                    // Rows
                    array(
                        'type' => 'param_group',
                        'param_name' => 'content',
                        'heading' => esc_html__('Rows', 'appland-core'),
                        'description' => esc_html__('Create rows with two column. One contain image and another contain contents', 'appland-core'),
                        'group' => esc_html__('Rows', 'appland-core'),
                        'params' => array(
                            array(
                                'type' => 'checkbox',
                                'param_name' => 'is_reverse_row',
                                'heading' => esc_html__('Reverse row', 'appland-core'),
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'title',
                                'heading' => esc_html__('Title', 'appland-core'),
                                'admin_label' => true,
                                'value' => 'Promotional Advertising Specialty You Ve Waited Long Enough',
                            ),
                            array(
                                'type' => 'textarea',
                                'param_name' => 'subtitle',
                                'heading' => esc_html__('Subtitle', 'appland-core'),
                            ),
                            array(
                                'type' => 'vc_link',
                                'param_name' => 'btn',
                                'heading' => esc_html__('Button', 'appland-core'),
                                'description' => esc_html__('Set the button with label and URL.', 'appland-core'),
                            ),
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'featured_image',
                                'heading' => esc_html__('The featured image', 'appland-core'),
                                'description' => esc_html__('Set here the featured image for this row.', 'appland-core'),
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'fi_margin',
                                'heading' => esc_html__('Margin Around the Featured Image', 'appland-core'),
                                'description' => esc_html__('Input the margin as clock wise (Top Right Bottom Left)', 'appland-core'),
                            ),
                            array(
                                'type' => 'checkbox',
                                'param_name' => 'is_box_shadow',
                                'heading' => esc_html__('Box shadow', 'appland-core'),
                                'description' => esc_html__('Show/hide the box shadow around the featured image.', 'appland-core'),
                            ),
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'featured_image_bg',
                                'heading' => esc_html__('Background shape', 'appland-core'),
                                'description' => esc_html__('Set here the the featured image background shape.', 'appland-core'),
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'bg_top',
                                'heading' => esc_html__('Position from top', 'appland-core'),
                                'dependency' => array(
                                    'element' => 'featured_image_bg',
                                    'not_empty' => true
                                )
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'bg_right',
                                'heading' => esc_html__('Position from right', 'appland-core'),
                                'dependency' => array(
                                    'element' => 'featured_image_bg',
                                    'not_empty' => true
                                )
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'bg_bottom',
                                'heading' => esc_html__('Position from bottom', 'appland-core'),
                                'dependency' => array(
                                    'element' => 'featured_image_bg',
                                    'not_empty' => true
                                )
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'bg_left',
                                'heading' => esc_html__('Position from left', 'appland-core'),
                                'dependency' => array(
                                    'element' => 'featured_image_bg',
                                    'not_empty' => true
                                )
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
                                'std' => 'image_icon'
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
                                'type' => 'textfield',
                                'param_name' => 'padding_top',
                                'heading' => esc_html__('Row Padding Top', 'appland-core'),
                                'description' => 'Input the measurement in pixel unit (Eg. 100px)',
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
                        'description' => 'Input the padding as clock wise (Top Right Bottom Left) and input the measurement in pixel unit (Eg. 150px 0px 150px 0px)',
                        'group' => 'Styling'
                    ),
                ),
            )
        );

    }
});