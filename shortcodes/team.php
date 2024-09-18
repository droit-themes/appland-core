<?php
add_shortcode('appland_team', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'sec_padding' => '150px 0px 150px 0px',
        'style' => 'style_01',
        'title' => 'Our Team',
        'subtitle' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
        'bg_image' => '',
        'overlay_type' => 'gradient',
        'mix_angle' => '0deg',
        'gradient_color_1' => '#4776e6',
        'gradient_color_2' => '#8e54e9',
        'overlay_solid' => '#4776e6',
        'title_color' => '#404040',
        'subtitle_color' => '#747474',
        'is_br' => '',
        'title_weight' => 'bold',
    ),$atts);
    $members = vc_param_group_parse_atts($content);
    $bg_image = wp_get_attachment_image_src($atts['bg_image'], 'full');
    if($atts['overlay_type']=='gradient') {
        $bg_color = "background-image: -webkit-linear-gradient({$atts['mix_angle']}, {$atts['gradient_color_1']} 0%, {$atts['gradient_color_2']} 100%) !important; z-index:1; position:relative;";
    }elseif($atts['overlay_type']=='solid') {
        $bg_color = !empty($atts['overlay_solid']) ? "background: {$atts['overlay_solid']}; z-index:1; position:relative;" : '';
    }
    $title_color = !empty($atts['title_color']) ? 'color:'.$atts['title_color'].';' : '';
    $subtitle_color = !empty($atts['subtitle_color']) ? 'color:'.$atts['subtitle_color'].';' : '';
    ?>
    <section class="team_area_four sec-pad" style="padding: <?php echo $atts['sec_padding'].'; '.$bg_color ?>">
        <div class="container">
        <div class="section_title text-center">
            <h2 style="<?php echo $title_color; Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
            <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
            <?php if(!empty($atts['subtitle'])) { ?>
                <p style="<?php echo $subtitle_color; ?>"> <?php echo $atts['subtitle']; ?> </p>
            <?php } ?>
        </div>
        <div class="row">
        <?php
        foreach($members as $member) {
            $profile_pic = wp_get_attachment_image_src($member['image'], 'full');
            ?>
            <div class="col-sm-<?php echo $member['column'] ?>">
                <div class="team_member">
                    <img src="<?php echo $profile_pic[0]; ?>" alt="<?php echo $member['name'] ?>">
                    <div class="content" style="padding: <?php echo $member['padding'] ?>;">
                        <h2><?php echo $member['name'] ?></h2>
                        <h6><?php echo $member['designation']; ?></h6>
                        <?php if(!empty($member['desc'])) { ?>
                        <p> <?php echo $member['desc']; ?> </p>
                        <?php } ?>
                        <div class="social">
                            <?php
                            if(!empty($member['fb'])) echo '<a href="'.$member['fb'].'" class="tran3s"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
                            if(!empty($member['twitter'])) echo '<a href="'.$member['twitter'].'" class="tran3s"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
                            if(!empty($member['dribbble'])) echo '<a href="'.$member['dribbble'].'" class="tran3s"><i class="fa fa-dribbble" aria-hidden="true"></i></a>';
                            if(!empty($member['google-plus'])) echo '<a href="'.$member['google-plus'].'" class="tran3s"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';
                            if(!empty($member['linkedin'])) echo '<a href="'.$member['linkedin'].'" class="tran3s"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';
                            if(!empty($member['instagram'])) echo '<a href="'.$member['instagram'].'" class="tran3s"><i class="fa fa-instagram" aria-hidden="true"></i></a>';
                            ?>
                        </div>
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
    if(isset($bg_image[0])) { ?>
        <style>
            .team_area_four:before {
                content: "";
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                position: absolute;
                opacity: 0.06;
                z-index: -1;
                background: url(<?php echo $bg_image[0] ?>) no-repeat scroll center 0;
                background-size: cover;
                background-attachment: fixed;
            }
        </style>
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
                'name'              => esc_html__('Team', 'appland-core'),
                'description'       => esc_html__('Create team section with title, subtitle and members', 'appland-core'),
                'base'              => 'appland_team',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'Our Team',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'subtitle',
                        'value' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'holder' => 'h2'
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_br',
                        'heading' => esc_html__('Is bottom line?', 'appland-core'),
                    ),
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'content',
                        'heading' => esc_html__('Members', 'appland-core'),
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'param_name' => 'column',
                                'heading' => esc_html__('Column', 'appland-core'),
                                'description' => esc_html__('Put the team member in column.', 'appland-core'),
                                'value' => array(
                                    '3/12' => '3',
                                    '4/12' => '4',
                                    '6/12' => '6',
                                ),
                                'std' => '4'
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'padding',
                                'heading' => esc_html__('Padding around content', 'appland-core'),
                                'description' => esc_html__('Input the padding as clock wise (Top Right Bottom Left)', 'appland-core'),
                                'value' => '36px 56px 30px 56px'
                            ),
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'image',
                                'heading' => esc_html__('Profile picture', 'appland-core'),
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'name',
                                'heading' => esc_html__('Name', 'appland-core'),
                                'admin_label' => true
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'designation',
                                'heading' => esc_html__('Designation', 'appland-core'),
                            ),
                            array(
                                'type' => 'textarea',
                                'param_name' => 'desc',
                                'heading' => esc_html__('About', 'appland-core'),
                                'description' => esc_html__('Write something about the team member.', 'appland-core'),
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'fb',
                                'heading' => esc_html__('Facebook link', 'appland-core'),
                                'value' => '#'
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'twitter',
                                'heading' => esc_html__('Twitter link', 'appland-core'),
                                'value' => '#'
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'dribbble',
                                'heading' => esc_html__('Dribbble link', 'appland-core'),
                                'value' => '#'
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'google-plus',
                                'heading' => esc_html__('Google plus link', 'appland-core'),
                                'value' => '#'
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'linkedin',
                                'heading' => esc_html__('Linkedin link', 'appland-core'),
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'instagram',
                                'heading' => esc_html__('Instagram link', 'appland-core'),
                            ),
                        )
                    ),
                    
                    // 'group' => 'Styling'
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
                        'type' => 'colorpicker',
                        'param_name' => 'title_color',
                        'heading' => esc_html__('Title color', 'appland-core'),
                        'value' => '#404040',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'subtitle_color',
                        'heading' => esc_html__('Subtitle color', 'appland-core'),
                        'value' => '#747474',
                        'group' => 'Styling'
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
                        'heading' => esc_html__('Background color type', 'appland-core'),
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
