<?php

add_shortcode('appland_pricing_table', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title'         => 'Pricing table',
        'subtitle'   => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
        'name' => 'Monthly',
        'sec_padding' => '150px 0px 150px 0px',
        'style' => 'style_01'
    ),$atts);
    $tab_contents = vc_param_group_parse_atts($content);
    $style = $atts['style']=='style_01' ? 'pricing_area_three sec-pad' : 'sec-pricing';
    $style_btn = $atts['style']=='style_01' ? 'screenshot-btn' : 'learn_btn';
    ?>

    <section class="<?php echo $style; ?>" style="padding: <?php echo $atts['sec_padding'];?>">
        <div class="container">
            <div class="section_title">
                <h2> <?php echo $atts['title']; ?> </h2>
                <?php if(!empty($atts['subtitle'])) { ?>
                    <p> <?php echo $atts['subtitle']; ?> </p>
                <?php } ?>
            </div>
            <div class="row price_table">
                <?php
                if(is_array($tab_contents)) {
                    foreach ($tab_contents as $tab_content) {
                        $btn = vc_build_link($tab_content['btn']);
                        $is_highlighted = isset($tab_content['is_highlighted']) ? $tab_content['is_highlighted'] : '';
                        ?>
                        <div class="col-sm-4 <?php echo $is_highlighted=='true' ? 'highlighted' : ''; ?>">
                            <div class="price_box">
                                <div class="price_head">
                                    <?php echo $is_highlighted=='true' ? '<span class="best-label">'.$tab_content['highlight_txt'].'</span>' : ''; ?>
                                    <h3><?php echo $tab_content['table-name'] ?></h3>
                                </div>
                                <ul class="list-unstyled plan-lists">
                                    <?php echo $tab_content['tab_content']; ?>
                                </ul>
                                <h2> <span> <?php echo $tab_content['currency'] ?> </span> <?php echo $tab_content['price'] ?> <span>/ <?php echo $tab_content['duration']; ?> </span></h2>
                                <?php if(!empty($btn['title'])) : ?>
                                    <a href="<?php echo esc_url($btn['url']); ?>" class="btn <?php echo $style_btn; ?>" target="<?php echo $btn['target']; ?>">
                                        <?php echo $btn['title']; ?>
                                    </a>
                                <?php endif; ?>
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
    $html = ob_get_clean();
    return $html;
});

// VC Config
add_action( 'vc_before_init', function() {
    if( function_exists('vc_map') ) {

        vc_map(array(
                'name'              => esc_html__('Pricing Table', 'appland-core'),
                'description'       => esc_html__('Create and display your pricing options.', 'appland-core'),
                'base'              => 'appland_pricing_table',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'value' => 'Pricing Table',
                        'admin_label' => true
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'subtitle',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'value' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed consequuntur magni dolores ratione voluptatem sequi nesciunt.'
                    ),
                    array(
                        'type' => 'param_group',
                        'param_name' => 'content',
                        'heading' => esc_html__('Create pricing tables', 'appland-core'),
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
                                'param_name' => 'btn',
                                'heading' => esc_html__('Button', 'appland-core'),
                            ),
                            array(
                                'type' => 'checkbox',
                                'param_name' => 'is_highlighted',
                                'heading' => esc_html__('Is highlighted', 'appland-core'),
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'highlight_txt',
                                'heading' => esc_html__('Highlight text', 'appland-core'),
                                'value' => 'Best Value',
                                'dependency' => array(
                                    'element' => 'is_highlighted',
                                    'value' => 'true'
                                )
                            ),
                        )
                    ),

                    // 'group' => 'Styling'
                    array(
                        'type' => 'textfield',
                        'param_name' => 'sec_padding',
                        'heading' => esc_html__('Section padding', 'appland-core'),
                        'description' => 'Input the padding as clock wise (Top Right Bottom Left)',
                        'value' => '150px 0px 150px 0px',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'custom_radio',
                        'param_name' => 'style',
                        'heading' => esc_html__('Section Style', 'appland-core'),
                        'description' => esc_html__('Select a style from here.', 'appland-core'),
                        'value' => array(
                            plugin_dir_url(__FILE__).'images/pricing_table1.png'  => 'style_01',
                            plugin_dir_url(__FILE__).'images/pricing_table2.png' => 'style_02',
                        ),
                        'group' => 'Styling'
                    ),
                ),
            )
        );
    }
});
