<?php
add_shortcode('appland_title', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title' => 'EXCLUSIVE FEATURES',
        'subtitle' => 'No need for a  Wi-Fi network or mobile data plan. The choice of OVER 1 billion users.',
        'is_br' => '',
        'text_align' => 'center',
        'title_color' => '#404040',
        'title_weight' => 'bold',
        'title_size' => '36px',
        'subtitle_size' => '18px',
        'margin'      => '0px auto 75px',
        'padding' => '0',
        'subtitle_margin' => '30px 0px 45px'
    ),$atts);
    $global_css = "text-align: {$atts['text_align']}; margin: {$atts['margin']}; padding: {$atts['padding']};";
    $title_css = "font-size:{$atts['title_size']}; color: {$atts['title_color']}; font-weight: {$atts['title_weight']};";
    ?>

    <div class="section_title" style="<?php echo $global_css; ?>">
        <h2 style="<?php echo $title_css; ?>"> <?php echo $atts['title']; ?> </h2>
        <?php if($atts['is_br'] == 'true') { ?> <div class="br" style="<?php echo ($atts['text_align']=='center') ? "margin: 0 auto;" : ''; ?>"></div> <?php } ?>
        <?php if(!empty($content)) { ?>
            <div class="subtitle" style="font-size: <?php echo $atts['subtitle_size']; ?>; <?php Appland_Margin($atts, 'subtitle_margin') ?>">
                <?php echo wpautop($content); ?>
            </div>
        <?php } ?>
    </div>

    <?php
    $html = ob_get_clean();
    return $html;
});



// VC Config
add_action( 'vc_before_init', function() {
    if( function_exists('vc_map') ) {
        vc_map(array(
                'name'              => esc_html__('Appland Title', 'appland-core'),
                'description'       => esc_html__('Create title with subtitle text.', 'appland-core'),
                'base'              => 'appland_title',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'EXCLUSIVE FEATURES',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'content',
                        'value' => 'No need for a  Wi-Fi network or mobile data plan. The choice of OVER 1 billion users.',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'holder' => 'h2'
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_br',
                        'heading' => esc_html__('Is bottom line?', 'appland-core'),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'margin',
                        'heading' => esc_html__('Margin', 'appland-core'),
                        'description' => esc_html__('Margin around the section. Input the margin as clock wise (Top Right Bottom Left)', 'appland-core'),
                        'value' => '0px auto 75px',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'padding',
                        'heading' => esc_html__('Padding', 'appland-core'),
                        'description' => esc_html__('Padding around the section. Input the padding as clock wise (Top Right Bottom Left)', 'appland-core'),
                        'value' => '0',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'subtitle_margin',
                        'heading' => esc_html__('Margin around the subtitle', 'appland-core'),
                        'description' => esc_html__('Input the padding as clock wise (Top Right Bottom Left)', 'appland-core'),
                        'value' => '30px 0px 45px 0px',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'text_align',
                        'heading' => esc_html__('Text align', 'appland-core'),
                        'value' => array(
                            'Center' => 'center',
                            'Left'   => 'left',
                            'Right'  => 'right'
                        ),
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'title_color',
                        'heading' => esc_html__('Title font color', 'appland-core'),
                        'value' => '#404040',
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title_size',
                        'heading' => esc_html__('Title font size', 'appland-core'),
                        'value' => '36px',
                        'group' => 'Styling',
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'subtitle_size',
                        'heading' => esc_html__('Subtitle font size', 'appland-core'),
                        'group' => 'Styling',
                        'value' => '18px'
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'title_weight',
                        'heading' => esc_html__('Title font weight', 'appland-core'),
                        'value' => array(
                            'Normal' => 'normal',
                            'Lighter' => 'lighter',
                            'Bold'  => 'bold',
                            'Bolder'  => 'bolder',
                            '300'  => '300',
                            '400'  => '400',
                            '500'  => '500',
                            '600'  => '600',
                            '700'  => '700',
                            '800'  => '800',
                            '900'  => '900',
                        ),
                        'std' => 'bold',
                        'styling' => 'Styling'
                    ),
                ),
            )
        );

    }
});
