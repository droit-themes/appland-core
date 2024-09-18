<?php
add_shortcode('appland_pricing', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title' => 'Pricing Table',
        'subtitle' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed consequuntur magni dolores ratione voluptatem sequi nesciunt.',
        'tab_items' => '',
        'sec_padding' => '150px 0px 150px 0px',
        'sec_bg_color' => '',
        'style' => 'style_01',
        'is_br' => '',
        'title_weight' => 'bold',
    ),$atts);
    $tab_items = vc_param_group_parse_atts($atts['tab_items']);
    $tab_contents = vc_param_group_parse_atts($content);
    $bg_color = !empty($atts['sec_bg_color']) ? 'background:'.$atts['sec_bg_color'].';' : '';
    ?>

    <section class="pricing_area_two sec-pad" style="padding: <?php echo $atts['sec_padding']; ?>; <?php echo $bg_color; ?>">
        <div class="container">
            <div class="section_title text-center">
                <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
                <?php if (!empty($atts['subtitle'])) { ?>
                    <p> <?php echo $atts['subtitle']; ?> </p>
                <?php } ?>
            </div>
            <ul class="nav nav-tabs price-tab" role="tablist">
                <?php
                $i = 0;
                if(is_array($tab_items)) {
                    foreach ($tab_items as $tab_item) {
                        $active = $i == 0 ? 'class="active"' : '';
                        ?>
                        <li role="presentation" <?php echo $active; ?>>
                            <a href="#<?php echo Appland_get_words_slug($tab_item['name']); ?>"
                               aria-controls="<?php echo Appland_get_words_slug($tab_item['name']); ?>" role="tab"
                               data-toggle="tab">
                                <?php echo $tab_item['name']; ?>
                            </a>
                        </li>
                        <?php
                        $i++;
                    }
                }
                ?>
            </ul>

            <div class="tab-content priceing-tab">
                <?php echo do_shortcode($content); ?>
            </div>
        </div>
    </section>

    <?php
    $html = ob_get_clean();
    return $html;
});



add_shortcode('appland_pricing_list', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'name' => 'Monthly',
    ),$atts);
    $tab_contents = vc_param_group_parse_atts($content);
    ?>

    <div role="tabpanel" class="row tab-pane" id="<?php echo Appland_get_words_slug($atts['name']); ?>">
        <?php
        if(is_array($tab_contents)) {
            foreach ($tab_contents as $tab_content) {
                $btn1 = !empty($tab_content['btn1']) ? vc_build_link($tab_content['btn1']) : '';
                $btn2 = !empty($tab_content['btn2']) ? vc_build_link($tab_content['btn2']) : '';
                ?>
                <div class="col-md-4 col-sm-4 price">
                    <div class="pricing-box">
                        <div class="pricing-header">
                            <h2><?php echo $tab_content['table-name'] ?></h2>
                            <h3 class="packeg_typ">
                                <span> <?php echo $tab_content['currency'] ?> </span>
                                <?php echo str_replace(' ', '', $tab_content['price']) ?>
                                <small> <?php echo str_replace(' ', '',$tab_content['duration']) ?> </small>
                            </h3>
                        </div>
                        <?php if(!empty($tab_content['tab_content'])) : ?>
                            <ul class="list-unstyled plan-lists">
                                <?php echo $tab_content['tab_content']; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if (!empty($btn1['title'])) { ?>
                            <a href="<?php echo $btn1['url'] ?>" class="try"
                               target="<?php echo str_replace(' ', '', $btn1['target']); ?>"> <?php echo $btn1['title']; ?> </a>
                        <?php } ?>
                        <?php if (!empty($btn2['title'])) { ?>
                            <a href="<?php echo $btn2['url'] ?>" class="purchase-btn"
                               target="<?php echo str_replace(' ', '', $btn2['target']); ?>"> <?php echo $btn2['title']; ?> </a>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <?php
    $html = ob_get_clean();
    return $html;
});



// VC Config
add_action( 'vc_before_init', function() {
    if( function_exists('vc_map') ) {

        vc_map(array(
                'name'              => esc_html__('Pricing Table with Tab', 'appland-core'),
                'description'       => esc_html__('Create & display your pricing options with tab.', 'appland-core'),
                'base'              => 'appland_pricing',
                'category'          => esc_html__('Appland', 'appland-core'),
                "as_parent"         => array('only' => 'appland_pricing_list'),
                "content_element"   => true,
                "show_settings_on_create" => false,
                "is_container"      => true,
                "js_view"           => "VcColumnView",
                'params'            => array(
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'value' => 'Pricing Table',
                        'holder' => 'div'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'subtitle',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'value' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed consequuntur magni dolores ratione voluptatem sequi nesciunt.'
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_br',
                        'heading' => esc_html__('Is bottom line?', 'appland-core'),
                    ),
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'tab_items',
                        'heading' => esc_html__('Tab items', 'appland-core'),
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'param_name' => 'name',
                                'heading' => esc_html__('Tab Name', 'appland-core'),
                                'description' => esc_html__('Tab name is the pricing name.', 'appland-core'),
                                'value' => 'Monthly',
                                'admin_label' => true
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
                        'param_name' => 'sec_bg_color',
                        'heading' => esc_html__('Section background color', 'appland-core'),
                        'value' => '#f8f8f8',
                        'group' => 'Styling'
                    ),
                ),
            )
        );

        // Pricing lists
        vc_map(array(
            'name'              => esc_html__('Pricing list', 'appland-core'),
            'base'              => 'appland_pricing_list',
            'category'          => esc_html__('Appland', 'appland-core'),
            "content_element"   => true,
            "as_child"          => array('only' => 'appland_pricing'),
            'params'            => array(
                array(
                    'type' => 'textfield',
                    'param_name' => 'name',
                    'heading' => esc_html__('Tab Name', 'appland-core'),
                    'description' => esc_html__('Input the price name as same as the Tab items name you entered in the the parent container.', 'appland-core'),
                    'value' => 'Monthly',
                    'holder' => 'h2'
                ),
                array(
                    'type' => 'param_group',
                    'value' => '',
                    'param_name' => 'content',
                    'heading' => esc_html__('Create pricing table', 'appland-core'),
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'param_name' => 'table-name',
                            'heading' => esc_html__('Pricing name', 'appland-core'),
                            'value' => 'FREE',
                            'admin_label' => true
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'currency',
                            'heading' => esc_html__('Currency', 'appland-core'),
                            'description' => esc_html__('Enter the currency symbol', 'appland-core'),
                            'value' => '$'
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'price',
                            'heading' => esc_html__('Price', 'appland-core'),
                            'value' => '0'
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'duration',
                            'heading' => esc_html__('Duration', 'appland-core'),
                            'value' => 'lifetime'
                        ),
                        array(
                            'type' => 'textarea',
                            'param_name' => 'tab_content',
                            'heading' => esc_html__('List items', 'appland-core'),
                            'description' => esc_html__('Wrap up every list item with li tag (<li>some content</li>)', 'appland-core'),
                            'value' => '<li>One User</li>
                                        <li>1000 ui elements</li>
                                        <li>E-mail support</li>'
                        ),
                        array(
                            'type' => 'vc_link',
                            'param_name' => 'btn1',
                            'heading' => esc_html__('Small Button', 'appland-core'),
                        ),
                        array(
                            'type' => 'vc_link',
                            'param_name' => 'btn2',
                            'heading' => esc_html__('Big Button', 'appland-core'),
                        ),
                    )
                )
            )
        ));

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_appland_pricing extends WPBakeryShortCodesContainer {
            }
        }
        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_appland_pricing_list extends WPBakeryShortCode {
            }
        }
    }
});
