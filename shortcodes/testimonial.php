<?php
add_shortcode('appland_testimonial', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'sec_padding' => '150px 0px 150px 0px',
        'item_bg_color' => '#f8f8f8',
        'style' => 'style_01',
        'title' => 'Testimonials',
        'subtitle' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
        'bg_image' => '',
        'is_br' => '',
        'title_weight' => ''
    ),$atts);
    $quotes = vc_param_group_parse_atts($content);
    ?>

    <?php
    if($atts['style']=='style_01') {
        ?>
        <section class="testimonial_area_four bg-color" style="padding: <?php echo $atts['sec_padding']; ?>;">
        <div class="container">
            <div id="test-carousel-three" class="test-carousel-three owl-carousel">
                <?php
                if (is_array($quotes)) {
                foreach ($quotes as $quote) { ?>
                    <div class="item">
                        <div class="icon">
                            <i class="fa fa-quote-left"></i>
                        </div>
                        <div class="content">
                            <p> <?php echo $quote['quote'] ?> </p>
                            <a class="quote_author" href="<?php echo $quote['author_url']; ?>"> <?php echo $quote['author_name']; ?> </a>
                            <?php if(!empty($quote['author_designation'])) { ?>
                                <h5 class="author_designation"><?php echo $quote['author_designation'] ?></h5>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                }}
                ?>
            </div>
        </div>
        </section>
        <?php
    }

    elseif($atts['style']=='style_02') {
        ?>
        <section class="testimonial_area_two" style="padding: <?php echo $atts['sec_padding']; ?>;">
        <div class="container">
            <div class="section_title text-center <?php echo ($atts['is_br'] != 'true') ? 'no-br' : ''; ?>">
                <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
                <?php if (!empty($atts['subtitle'])) { ?>
                    <p> <?php echo $atts['subtitle']; ?> </p>
                <?php } ?>
            </div>
            <div class="row">
                <div id="test_c_six" class="testimonial_carousel_two owl-carousel">
                    <?php
                    if (is_array($quotes)) {
                    foreach ($quotes as $quote) {
                        $author_image = isset($quote['author_image']) ? wp_get_attachment_image_src($quote['author_image'], 'appland_80x80') : '';
                        ?>
                        <div class="item">
                            <div class="testimonial_item" style="<?php Appland_BgColor($atts, 'item_bg_color') ?>">
                                <div class="icon">
                                    <img src="<?php echo plugin_dir_url(__FILE__).'images/quote.png' ?>" alt="">
                                </div>
                                <p><?php echo $quote['quote'] ?></p>
                                <div class="media">
                                    <?php
                                    if (isset($author_image[0])) { ?>
                                        <div class="media-left">
                                            <img class="img-circle" src="<?php echo $author_image[0]; ?>" alt="<?php echo $quote['author_name']; ?>">
                                        </div>
                                    <?php } ?>
                                    <div class="media-body">
                                        <h2> <a href="<?php echo esc_url($quote['author_url']); ?>"><?php echo $quote['author_name']; ?></a> </h2>
                                        <?php if(!empty($quote['author_designation'])) : ?>
                                            <h6> <?php echo $quote['author_designation']; ?></h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
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

    elseif($atts['style']=='style_03') {
        $bg_image = '';
        if(!empty($atts['bg_image'])) {
            $bg_image = wp_get_attachment_image_src($atts['bg_image'], 'full');
            $bg_image = "style=\"background: url({$bg_image[0]}) center/cover no-repeat;\"";
        }
        ?>
        <section class="testimonial_area_three sec-pad" style="padding: <?php echo $atts['sec_padding']; ?>;">
            <div class="video-bg" <?php echo $bg_image; ?>></div>
            <div class="container">
                <div class="test-carousel-three owl-carousel">
                    <?php
                    if (is_array($quotes)) {
                        foreach ($quotes as $quote) { ?>
                            <div class="item">
                                <div class="icon">
                                    <i class="fa fa-quote-left"></i>
                                </div>
                                <div class="content">
                                    <p> <?php echo $quote['quote'] ?> </p>
                                    <?php if(!empty($quote['author_name'])) : ?>
                                        <a class="quote_author" href="<?php echo $quote['author_url']; ?>">
                                            <?php echo $quote['author_name']; ?>
                                        </a>
                                    <?php endif; ?>
	                                <?php if(!empty($quote['author_designation'])) { ?>
                                        <h5 class="author_designation"><?php echo $quote['author_designation'] ?></h5>
	                                <?php } ?>
                                </div>
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

    elseif($atts['style']=='style_04') {
        ?>
        <section class="testimonial-area bg-color <?php echo ($atts['is_br'] != 'true') ? 'no-br' : ''; ?>" style="padding: <?php echo $atts['sec_padding']; ?>;">
            <div class="container">
                <div class="section_title text-center">
                    <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                    <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
                    <?php if (!empty($atts['subtitle'])) { ?>
                        <p> <?php echo $atts['subtitle']; ?> </p>
                    <?php } ?>
                </div>
                <div id="testimonial_carousel" class="testimonial_carousel owl-carousel">
                    <?php
                    if (is_array($quotes)) {
                        foreach ($quotes as $quote) {
                            $author_image = !empty($quote['author_image']) ? wp_get_attachment_image_src($quote['author_image'], 'appland_80x80') : '';
                            ?>
                            <div class="item <?php echo empty($quote['author_image']) ? 'no-author-image' : ''; ?>">
                                <div class="testimonial_item">
                                    <div class="author">
                                        <?php
                                        if (!empty($author_image[0])) { ?>
                                            <img class="img-circle" src="<?php echo $author_image[0]; ?>" alt="<?php echo $quote['author_name']; ?>">
                                        <?php } ?>
                                        <h2><?php echo $quote['author_name']; ?></h2>
                                        <?php if(!empty($quote['author_designation'])) : ?>
                                            <h6> <?php echo $quote['author_designation']; ?></h6>
                                        <?php endif; ?>
                                    </div>
                                    <p> <?php echo $quote['quote'] ?> </p>
                                </div>
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

    elseif($atts['style']=='style_05') {
        ?>
        <section class="testimonial_area_two testimonial_area_05" style="padding: <?php echo $atts['sec_padding']; ?>;">
            <div class="container">
                <div class="section_title text-center <?php echo ($atts['is_br'] != 'true') ? 'no-br' : ''; ?>">
                    <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                    <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
                    <?php if (!empty($atts['subtitle'])) { ?>
                        <p> <?php echo $atts['subtitle']; ?> </p>
                    <?php } ?>
                </div>
                <div class="row">
                    <div id="test_c_five" class="testimonial_carousel_two owl-carousel">
                        <?php
                        if (is_array($quotes)) {
                            foreach ($quotes as $quote) {
                                $author_image = isset($quote['author_image']) ? wp_get_attachment_image_src($quote['author_image'], 'appland_50x50') : '';
                                ?>
                                <div class="item">
                                <div class="testimonial_item" style="<?php Appland_BgColor($atts, 'item_bg_color') ?>">
                                    <p><?php echo $quote['quote'] ?></p>
                                    <div class="media">
                                        <?php
                                        if (isset($author_image[0])) { ?>
                                            <div class="media-left">
                                                <img class="img-circle" src="<?php echo $author_image[0]; ?>" alt="<?php echo $quote['author_name']; ?>">
                                            </div>
                                        <?php } ?>
                                        <div class="media-body">
                                            <h2> <a href="<?php echo $quote['author_url']; ?>"> <?php echo $quote['author_name']; ?></a> </h2>
                                            <?php if(!empty($quote['author_designation'])) : ?>
                                                <h6> <?php echo $quote['author_designation']; ?></h6>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
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
    ?>

    <?php
    $html = ob_get_clean();
    return $html;
});



// VC Config
add_action( 'vc_before_init', function() {
    if( function_exists('vc_map') ) {
        vc_map(array(
                'name'              => esc_html__('Testimonial', 'appland-core'),
                'description'       => esc_html__('Display testimonials in different styles. Full width section.', 'appland-core'),
                'base'              => 'appland_testimonial',
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
                            'Style Five' => 'style_05',
                        ),
                        'admin_label' => true
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_01',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/testimonial1.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_02',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/testimonial2.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_03',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/testimonial3.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_03'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_04',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/testimonial4.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_04'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_05',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/testimonial5.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_05'
                        ),
                    ),

                    // Group : Title
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'Testimonials',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'admin_label' => true,
                        'group' => 'Title'
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'subtitle',
                        'value' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'admin_label' => true,
                        'group' => 'Title'
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_br',
                        'heading' => esc_html__('Show bottom line under the title?', 'appland-core'),
                        'group' => 'Title'
                    ),

                    // Group : Testimonials
                    array(
                        'type' => 'param_group',
                        'param_name' => 'content',
                        'heading' => esc_html__('Testimonials', 'appland-core'),
                        'group' => 'Testimonials',
                        'params' => array(
                            array(
                                'type' => 'textarea',
                                'param_name' => 'quote',
                                'heading' => esc_html__('Quote Text', 'appland-core'),
                                'value' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices'
                            ),
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'author_image',
                                'heading' => esc_html__('Quote Author image', 'appland-core'),
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'author_name',
                                'heading' => esc_html__('Quote Author Name', 'appland-core'),
                                'value' => 'Eh Jewel',
                                'admin_label' => true
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'author_url',
                                'heading' => esc_html__('Quote Author URL', 'appland-core'),
                                'value' => '#',
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'author_designation',
                                'heading' => esc_html__('Author Designation', 'appland-core'),
                                'value' => 'Programmer @ DroitLab'
                            ),
                        )
                    ),

                    // 'group' => 'Styling'
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'bg_image',
                        'heading' => esc_html__('Background image', 'appland-core'),
                        'group' => 'Styling',
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
                        'param_name' => 'item_bg_color',
                        'heading' => esc_html__('Testimonial item background color', 'appland-core'),
                        'value' => '#f8f8f8',
                        'group' => 'Styling',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'sec_bg_color',
                        'heading' => esc_html__('Section background color', 'appland-core'),
                        'value' => '#f8f8f8',
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
                ),
            )
        );

    }
});
