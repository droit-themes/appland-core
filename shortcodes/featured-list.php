<?php
add_shortcode('appland_featured_list', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title' => 'Data Analytics',
        'subtitle' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
        'list_items' => '',
        'title_weight' => 'normal',
        'item_weight' => 'bold',
        'is_br' => ''
    ),$atts);
    $list_items = vc_param_group_parse_atts($atts['list_items']);
    ?>

    <div class="features_content_three">
        <div class="sec_title_five sec_five">
            <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
            <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
        </div>
        <div class="sec_content">
            <?php echo $content; ?>
        </div>
        <?php
        if(is_array($list_items)) {
        foreach ($list_items as $item) {
            $icon = wp_get_attachment_image_src($item['icon'], 'full');
            ?>
            <div class="media">
                <div class="media-left">
                    <div class="icon">
                        <img src="<?php echo $icon[0]; ?>" alt="<?php echo esc_attr($item['title']) ?>">
                    </div>
                </div>
                <div class="media-body" style="<?php Appland_FontWeight($atts, 'item_weight') ?>"> <?php echo $item['title'] ?> </div>
            </div>
            <?php
        }}
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
                'name'              => esc_html__('Featured list', 'appland-core'),
                'description'       => esc_html__('Display your featured list items.', 'appland-core'),
                'base'              => 'appland_featured_list',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'Data Analytics',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'heading' => esc_html__('Content', 'appland-core'),
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_br',
                        'heading' => esc_html__('Show bottom line under the title?', 'appland-core'),
                    ),
                    array(
                        'type' => 'param_group',
                        'param_name' => 'list_items',
                        'heading' => esc_html__('Feature list items', 'appland-core'),
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'param_name' => 'title',
                                'value' => 'Enterprise Reporting with Tiered Access',
                                'heading' => esc_html__('Title', 'appland-core'),
                                'admin_label' => true,
                            ),
                            array(
                                'type' => 'attach_image',
                                'param_name' => 'icon',
                                'heading' => esc_html__('Icon image', 'appland-core'),
                                'description' => esc_html__('Max icon size is 24x24 (px)', 'appland-core'),
                            ),
                        )
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
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'item_weight',
                        'heading' => esc_html__('List item font weight', 'appland-core'),
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
