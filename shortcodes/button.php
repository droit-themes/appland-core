<?php
add_shortcode('appland_btn', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'btn'           => '',
        'bg_color'      => '#ef494d',
        'color'         => '#ffffff',
        'text_align'    => 'center',
        'border_radius' => '50px',
        'font_size'     => '14px',
        'font_weight'   => 'normal',
        'padding'       => '15px 40px 15px',
        'letter_spacing'=> '1.4px',
        'line_height'   => '30px',
        'css_edit'      => '',
        'hover_bg_color'    => '#ef494d',
        'hover_color'       => '#ffffff',
        'hover_border_color'=> '#ffffff',
    ),$atts);
    $btn = vc_build_link($atts['btn']);
    $css = "line-height:{$atts['line_height']}; letter-spacing: {$atts['letter_spacing']}; border-radius: {$atts['border_radius']}; 
    background: {$atts['bg_color']} !important; color: {$atts['color']}; float: {$atts['text_align']}; padding: {$atts['padding']}; font-weight:{$atts['font_weight']}; font-size: {$atts['font_size']};";
    ?>

    <a style="position: static; <?php echo $css; ?>" href="<?php echo esc_url($btn['url']); ?>" target="<?php echo $btn['target']; ?>" class="appland_btn btn learn_btn">
        <?php echo esc_html($btn['title']); ?>
    </a>

    <?php
    $html = ob_get_clean();
    return $html;
});



// VC Config
add_action( 'vc_before_init', function() {
    if( function_exists('vc_map') ) {
        vc_map(array(
                'name'              => esc_html__('Appland Button', 'appland-core'),
                'description'       => esc_html__('Create button using appland.', 'appland-core'),
                'base'              => 'appland_btn',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'vc_link',
                        'param_name' => 'btn',
                        'heading' => esc_html__('Set the button', 'appland-core'),
                        'holder' => 'h2'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'bg_color',
                        'heading' => esc_html__('Background Color', 'appland-core'),
                        'value' => '#ef494d'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'padding',
                        'heading' => esc_html__('Padding', 'appland-core'),
                        'description' => esc_html__('Padding around the button. Input the padding as clock wise.', 'appland-core'),
                        'value' => '15px 40px 15px'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'border_radius',
                        'heading' => esc_html__('Border radius', 'appland-core'),
                        'value' => '50px'
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'text_align',
                        'heading' => esc_html__('Button align', 'appland-core'),
                        'value' => array(
                            'Left'   => 'left',
                            'Right'  => 'right'
                        ),
                    ),
                    // Group : Font styling
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'color',
                        'heading' => esc_html__('Font Color', 'appland-core'),
                        'value' => '#ffffff'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'font_size',
                        'heading' => esc_html__('Font size', 'appland-core'),
                        'value' => '14px',
                        'group' => 'Font Styling'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'letter_spacing',
                        'heading' => esc_html__('Latter spacing', 'appland-core'),
                        'value' => '1.4px',
                        'group' => 'Font Styling'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'line_height',
                        'heading' => esc_html__('Line height', 'appland-core'),
                        'value' => '30px',
                        'group' => 'Font Styling'
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'font_weight',
                        'heading' => esc_html__('Font weight', 'appland-core'),
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
                        'group' => 'Font Styling'
                    ),
                ),
            )
        );

    }
});
