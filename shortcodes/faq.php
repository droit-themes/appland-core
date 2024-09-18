<?php
add_shortcode('appland_faq', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'id' => 'first-question',
        'title' => 'Faq',
        'subtitle' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut <br>fugit, sed consequuntur magni dolores ratione voluptatem sequi nesciunt.',
        'item_bg_color' => '#ffffff',
        'sec_padding' => '102px 0px 118px 0px',
        'sec_bg_color' => '#f8f8f8',
        'is_br' => '',
        'right_image' => '',
        'title_weight' => '',
    ),$atts);
    $faqs = vc_param_group_parse_atts($content);
    $image_src = Appland_get_image_src($atts, 'right_image');
    ?>

    <section class="faq-area-2" style="<?php Appland_Padding($atts, 'sec_padding'); Appland_BgColor($atts, 'sec_bg_color'); ?>">
        <div class="container">
            <div class="sec_title_five text-center">
                <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
                <?php if (!empty($atts['subtitle'])) { ?>
                    <p> <?php echo $atts['subtitle']; ?> </p>
                <?php } ?>
            </div>
            <div class="row">
                <div class="<?php echo !empty($image_src) ? 'col-lg-6 col-md-7' : 'col-md-8 col-md-offset-2'; ?>">
                    <div class="panel-group faq-inner-accordion <?php echo !empty($image_src) ? 'faq_accordian_two' : ''; ?>" id="accordion" role="tablist">
                        <?php
                        if(is_array($faqs)) {
                            $i = 1;
                            foreach ($faqs as $faq) {
                                $id = !empty($atts['id']) ? $atts['id'] : 'collapse';
                                ?>
                                <div class="panel panel-default" style="<?php Appland_BgColor($atts, 'item_bg_color') ?>">
                                    <div class="panel-heading" role="tab">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                               href="#<?php echo $id.'-'.$i ?>" class="btn-accordion <?php echo $i != 1 ? 'collapsed' : ''; ?>"
                                               aria-expanded="<?php echo $i==1 ? true : 'false'; ?>" role="button">
                                                <i class="ti-plus plus"></i>
                                                <i class="ti-minus minus"></i>
                                                <?php echo $faq['title']; ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?php echo $id.'-'.$i ?>" class="panel-collapse collapse <?php echo $i==1 ? 'in' : ''; ?>" aria-expanded="true" role="tabpanel">
                                        <div class="panel-body"> <?php echo $faq['content']; ?> </div>
                                    </div>
                                </div>
                                <?php
                                ++$i;
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
                if(!empty($image_src)) { ?>
                    <div class="col-lg-6 col-md-5">
                        <div class="faq-img">
                            <img class="img-responsive" src="<?php echo $image_src ?>" alt="">
                        </div>
                    </div>
                <?php } ?>
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
                'name'              => esc_html__('Appland FAQs', 'appland-core'),
                'description'       => esc_html__('Create FAQs with accordion style', 'appland-core'),
                'base'              => 'appland_faq',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'textfield',
                        'param_name' => 'id',
                        'heading' => esc_html__('ID', 'appland-core'),
                        'description' => esc_html__('Give a unique ID for this section.', 'appland-core'),
                        'value' => 'first-question',
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'value' => 'Faq',
                        'holder' => 'div'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'subtitle',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'value' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut <br>fugit, sed consequuntur magni dolores ratione voluptatem sequi nesciunt.'
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_br',
                        'heading' => esc_html__('Is bottom line?', 'appland-core'),
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'right_image',
                        'heading' => esc_html__('Right column image', 'appland-core'),
                    ),

                    array(
                        'type' => 'param_group',
                        'param_name' => 'content',
                        'heading' => esc_html__('Create FAQs', 'appland-core'),
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'param_name' => 'title',
                                'heading' => esc_html__('Title', 'appland-core'),
                                'value' => 'Aspernatur remaining essentially unchanged?',
                                'admin_label' => true
                            ),
                            array(
                                'type' => 'textarea',
                                'param_name' => 'content',
                                'heading' => esc_html__('Content', 'appland-core'),
                                'value' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.',
                            ),
                        )
                    ),

                    // Group: Styling
                    array(
                        'type' => 'textfield',
                        'param_name' => 'sec_padding',
                        'heading' => esc_html__('Section padding', 'appland-core'),
                        'description' => 'Input the padding as clock wise (Top Right Bottom Left)',
                        'value' => '102px 0px 118px 0px',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'sec_bg_color',
                        'heading' => esc_html__('Section background color', 'appland-core'),
                        'value' => '#f8f8f8',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'item_bg_color',
                        'value' => '#ffffff',
                        'heading' => esc_html__('FAQ Item background color', 'appland-core'),
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