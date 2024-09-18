<?php
add_shortcode('appland_screenshots', function($atts, $content) {
    ob_start();

    $atts = shortcode_atts(array(
        'style' => 'style_01',
        'sec_padding' => '150px 0px 135px 0px',
        'btn' => '',
        'title' => 'SCREEN SHOTS',
        'subtitle' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
        'mockup' => '',
        'is_br' => '',
        'title_weight' => 'bold',
    ),$atts);
    $images = explode(',', $content);
    $btn = vc_build_link($atts['btn']);
    ?>

    <?php
    if($atts['style']=='style_01') {
        wp_enqueue_style('swiper');
        ?>
        <section class="screenshot_area_four" style="padding: <?php echo $atts['sec_padding']; ?>;">
            <div class="container">
                <div class="section_title">
                    <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                    <?php if (!empty($atts['subtitle'])) { ?>
                        <p> <?php echo $atts['subtitle']; ?> </p>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php
                                foreach ($images as $image) {
                                    $image_src = wp_get_attachment_image_src($image, 'full'); ?>
                                    <div class="swiper-slide">
                                        <img class="img-responsive" src="<?php echo $image_src[0]; ?>" alt="">
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="swiper-pagination color-p"></div>
                        </div>
                        <div class="swiper-button-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
                        <div class="swiper-button-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            function getSlide() {
                var wW=jQuery(window).width();
                if(wW<601) {
                    return 1
                }
                return 3
            }
            jQuery('.swiper-container').swiper( {
                    mode:'horizontal',
                    autoplay:3000,
                    loop:!0,
                    speed:500,
                    effect:'coverflow',
                    slidesPerView:getSlide(),
                    grabCursor:!0,
                    nextButton:'.swiper-button-next',
                    prevButton:'.swiper-button-prev',
                    keyboardControl:!0,
                    pagination:'.swiper-pagination',
                    paginationClickable:!0,
                    coverflow: {
                        rotate: 0, stretch: 0, depth: 150, modifier: 1, slideShadows: !1
                    }
                }
            );
        </script>
        <?php
    }

    elseif($atts['style']=='style_02') {
        ?>
        <section class="screenshot_area_two" style="padding: <?php echo $atts['sec_padding']; ?>;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="section_title sec_title_two">
                            <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                            <?php if (!empty($atts['subtitle'])) { ?>
                                <p> <?php echo $atts['subtitle']; ?> </p>
                            <?php } ?>
                            <?php
                            if(!empty($btn['title'])) {
                                ?> <a href="<?php echo $btn['url'] ?>" target="<?php echo $btn['target']; ?>" class="screenshot-btn"> <?php echo $btn['title'] ?> </a> <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php
                                foreach ($images as $image) {
                                    $image_src = wp_get_attachment_image_src($image, 'full'); ?>
                                    <div class="swiper-slide">
                                        <img class="img-responsive" src="<?php echo $image_src[0]; ?>" alt="">
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    elseif($atts['style']=='style_03') {
        wp_enqueue_style('magnific-popup');
        ?>
        <section class="screenshot_area screenshot-area-two" style="padding: <?php echo $atts['sec_padding']; ?>;">
            <div class="container">
                <div class="section_title">
                    <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                    <?php if (!empty($atts['subtitle'])) { ?>
                        <p> <?php echo $atts['subtitle']; ?> </p>
                    <?php } ?>
                </div>
                <div id="screen-shot2" class="screenshot_carousel s-carousel-two owl-carousel">
                    <?php
                    foreach ($images as $image) {
                        $image_src = wp_get_attachment_image_src($image, 'full'); ?>
                        <div class="item">
                            <a href="<?php echo $image_src[0]; ?>" class="work-popup">
                                <img src="<?php echo $image_src[0]; ?>" alt="">
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }

    elseif($atts['style']=='style_04') {
        /*$select_mockup = isset($atts['mockup']) ? $atts['mockup'] : '';
        if($select_mockup=='iphone_mockup') {
            $mockup = plugin_dir_url(__FILE__) . 'images/mockup-iphone.png';
        }elseif($select_mockup=='iphonex_mockup'){
	        $mockup = plugin_dir_url(__FILE__) . 'images/mockup-iphonex.png';
        }else {
            $mockup = plugin_dir_url(__FILE__).'images/mockup-android.png';
        }*/
        ?>
        <section class="screenshot_area" style="padding: <?php echo $atts['sec_padding']; ?>;">
            <div class="container">
                <div class="section_title">
                    <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                    <?php if (!empty($atts['subtitle'])) { ?>
                        <p> <?php echo $atts['subtitle']; ?> </p>
                    <?php } ?>
                </div>
                <div class="screenshot">
                    <!--<div class="carousel-decoration" style="background-image:url(<?php /*echo $mockup; */?>)"></div>-->
                    <div id="screen-shot" class="screenshot_carousel owl-carousel">
                        <?php
                        foreach ($images as $image) {
                            $image_src = wp_get_attachment_image_src($image, 'full'); ?>
                            <div class="item">
                                <a href="<?php echo $image_src[0]; ?>" class="work-popup">
                                    <img src="<?php echo $image_src[0]; ?>" alt="">
                                </a>
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


    elseif($atts['style']=='style_05') {
        wp_enqueue_style('magnific-popup');
        ?>
        <section class="screenshots-area-three">
            <div class="container">
                <div class="section_title text-center">
                    <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                    <div class="br"></div>
                    <?php if (!empty($atts['subtitle'])) { ?>
                        <p> <?php echo $atts['subtitle']; ?> </p>
                    <?php } ?>
                </div>
                <div class="screenshots-slider owl-carousel">
                    <?php
                    foreach ($images as $image) {
                        $image_src = wp_get_attachment_image_src($image, 'full'); ?>
                        <div class="item">
                            <a href="<?php echo $image_src[0]; ?>" class="screenshot popup">
                                <img src="<?php echo $image_src[0]; ?>" alt="">
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }

    elseif($atts['style']=='style_06') {
        ?>
        <section class="screenshot_area_three" style="<?php Appland_Padding($atts, 'sec_padding') ?>;">
            <div class="container-fluid">
                <div class="row display_table">
                    <div class="col-md-6 screenshot_left table_cell">
                        <div class="content">
                            <div class="sec_title_five sec_five">
                                <h2> <?php echo $atts['title']; ?> </h2>
                                <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
                            </div>
                            <?php if (!empty($atts['subtitle'])) { ?>
                                <p> <?php echo $atts['subtitle']; ?> </p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-6 screenshot_right table_cell">
                        <?php
                        foreach ($images as $image) {
                            $image_src = wp_get_attachment_image_src($image, 'appland_228x405'); ?>
                            <div class="sc_item">
                                <img src="<?php echo $image_src[0]; ?>" alt="">
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
    ?>

    <?php
    $html = ob_get_clean();
    return $html;
});



// VC Config
add_action( 'vc_before_init', function() {
    if( function_exists('vc_map') ) {
        vc_map(array(
                'name'              => esc_html__('App Screenshots', 'appland-core'),
                'description'       => esc_html__("Display your app screenshots with many beautiful ways. Full width section", 'appland-core'),
                'base'              => 'appland_screenshots',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'style',
                        'heading' => esc_html__('Section Style', 'appland-core'),
                        'description' => esc_html__('Select a style screenshot section style and see the style screenshot bellow.', 'appland-core'),
                        'value' => array(
                            'Style one'  => 'style_01',
                            'Style two' => 'style_02',
                            'Style three'=> 'style_03',
                            'Style four' => 'style_04',
                            'Style five'=> 'style_05',
                            'Style six' => 'style_06',
                        ),
                        'admin_label' => true
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_01',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/screenshot_carousel1.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_02',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/screenshot_carousel2.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_03',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/screenshot_carousel3.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_03'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_04',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/screenshot_carousel4.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_04'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_05',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/screenshot_carousel5.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_05'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_06',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/screenshot_carousel6.jpg',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_06'
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'SCREEN SHOTS',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'admin_label' => true,
                        'group' => 'Title'
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_br',
                        'heading' => esc_html__('Is bottom line under the title?', 'appland-core'),
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
                        'type' => 'attach_images',
                        'param_name' => 'content',
                        'heading' => esc_html__('Screenshots', 'appland-core'),
                        'description' => esc_html__('You can attach here multiple images.', 'appland-core'),
                        'group' => 'Screenshoots'
                    ),/*
                    array(
                        'type' => 'custom_radio',
                        'param_name' => 'mockup',
                        'heading' => esc_html__('Phone mock-up', 'appland-core'),
                        'description' => esc_html__('Select the phone mock-up for style 04 only.', 'appland-core'),
                        'value' => array(
	                        plugin_dir_url(__FILE__).'images/mockup-iphonex.png'  => 'iphonex_mockup',
                            plugin_dir_url(__FILE__).'images/mockup-iphone.png'  => 'iphone_mockup',
                            plugin_dir_url(__FILE__).'images/mockup-android.png' => 'android_mockup',
                        ),
                    ),*/
                    array(
                        'type' => 'vc_link',
                        'param_name' => 'btn',
                        'heading' => esc_html__('Button', 'appland-core'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        )
                    ),

                    /*
                     * 'group' => 'Styling'
                     * *********************************************************************
                     */
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
                        'value' => '150px 0px 135px 0px',
                        'group' => 'Styling'
                    ),
                ),
            )
        );

    }
});
