<?php
add_shortcode('appland_logo_carousel', function($atts, $content) {
    ob_start();

    $atts = shortcode_atts(array(
        'title' => 'Trusted By Great Team',
        'subtitle' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
        'style' => 'style_01',
        'sec_padding' => '150px 0px 150px 0px',
        'is_br' => '',
        'title_weight' => 'bold',
    ),$atts);
    $logos = vc_param_group_parse_atts($content);
    ?>

    <?php
    if($atts['style']=='style_01') {
        ?>
        <section class="clients-logo-one sec-pad" style="padding: <?php echo $atts['sec_padding']; ?>">
            <div class="container">
                <div class="section_title text-center">
                    <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                    <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
                    <?php if(!empty($atts['subtitle'])) { ?>
                        <p> <?php echo $atts['subtitle']; ?> </p>
                    <?php } ?>
                </div>
                <div class="clients-lg-slider owl-carousel">
                    <?php
                    if(is_array($logos)) {
                    foreach ($logos as $logo) {
                        $image = wp_get_attachment_image_src($logo['image'], 'full');
                        ?>
                        <div class="item">
                            <a href="<?php echo $logo['url']; ?>">
                                <img src="<?php echo $image[0]; ?>" alt="<?php echo $logo['title'] ?>" title="<?php echo $logo['title'] ?>">
                            </a>
                        </div>
                        <?php
                    }
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }

    elseif($atts['style']=='style_02') {
        ?>
        <section class="partner_logo_area" style="<?php Appland_Padding($atts, 'sec_padding') ?>">
            <div class="container">
                <div class="row">
                    <?php
                    if(is_array($logos)) {
                        foreach ($logos as $logo) {
                            $image = wp_get_attachment_image_src($logo['image'], 'full');
                            ?>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <a href="<?php echo $logo['url']; ?>"><img src="<?php echo $image[0]; ?>" alt="<?php echo $logo['title'] ?>"></a>
                            </div>
                            <?php
                        }
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
                'name'              => esc_html__('Logo Carousel', 'appland-core'),
                'description'       => esc_html__('Client logo carousel section with title and subtitle.', 'appland-core'),
                'base'              => 'appland_logo_carousel',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'style',
                        'heading' => esc_html__('Style', 'appland-core'),
                        'value' => array(
                            'Style one' => 'style_01',
                            'Style two' => 'style_02',
                        )
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_01',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/logos1.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_02',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/logos2.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'sec_padding',
                        'heading' => esc_html__('Section padding', 'appland-core'),
                        'description' => 'Input the padding as clock wise (Top Right Bottom Left)',
                        'value' => '150px 0px 150px 0px',
                        'group' => 'Styling',
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
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'value' => 'Trusted By Great Team',
                        'admin_label' => true,
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        )
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_br',
                        'heading' => esc_html__('Show the title bottom line?', 'appland-core'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'subtitle',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'value' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        )
                    ),
                    array(
                        'type' => 'param_group',
                        'param_name' => 'content',
                        'heading' => esc_html__('Carousel Logos', 'appland-core'),
                        'params' => array(
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'image',
                                'heading' => esc_html__('Logo image', 'appland-core'),
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'url',
                                'heading' => esc_html__('Logo URL', 'appland-core'),
                                'value' => '#'
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'title',
                                'heading' => esc_html__('Logo Name', 'appland-core'),
                                'value' => 'Company Name',
                                'admin_label' => true
                            ),
                        )
                    )
                ),
            )
        );

    }
});
