<?php
add_shortcode('appland_subscribe', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title' => 'Subscribe Our Newsletter',
        'subtitle' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
        'btn_title' => 'Subscribe Now',
        'input_placeholder' => 'Enter your email',
        'action_url' => 'https://droitlab.us17.list-manage.com/subscribe/post?u=76b0fef40e7828eb4ff8eb754&id=fbff4a1aff',
        'bg_image' => '',
        'overlay_type' => 'gradient',
        'mix_angle' => '0deg',
        'gradient_color_1' => '#4776e6',
        'gradient_color_2' => '#8e54e9',
        'overlay_solid' => '#4776e6',
        'sec_padding' => '150px 0px 150px 0px',
        'style' => 'style_01',
        'before_color' => '#ffffff',
        'after_color' => '#ffffff',
    ),$atts);
    $bg_image = wp_get_attachment_image_src($atts['bg_image'], 'full');
    $bg_image_src = isset($bg_image[0]) ? $bg_image[0] : '';
    if($atts['overlay_type']=='gradient') {
        $bg_color = "background-image: -webkit-linear-gradient({$atts['mix_angle']}, {$atts['gradient_color_1']} 0%, {$atts['gradient_color_2']} 100%) !important;";
    }elseif($atts['overlay_type']=='solid') {
        $bg_color = "background: {$atts['overlay_solid']} !important;";
    }
    $style = $atts['style']=='style_01' ? 'sec-pad voilat-bg-two' : 'angle-bg angle-bg-two';
    ?>

    <?php if(!empty($atts['before_color'])) { ?>
        <style>
            .subcribe_area.angle-bg:before {
                background-color: <?php echo $atts['before_color']; ?> !important;
            }
            .subcribe_area.angle-bg:after {
                background-color: <?php echo $atts['after_color']; ?> !important;
            }
        </style>
    <?php } ?>

    <section class="subcribe_area <?php echo $style; ?>" style="padding: <?php echo $atts['sec_padding'].'; '.$bg_color ?>">
        <div class="video-bg" style="background: url(<?php echo $bg_image_src; ?>) no-repeat scroll center 0/cover; background-attachment: fixed;"></div>
        <div class="container">
            <div class="section_title color_w">
                <h2> <?php echo $atts['title']; ?> </h2>
                <?php if(!empty($atts['subtitle'])) { ?>
                    <p> <?php echo $atts['subtitle']; ?> </p>
                <?php } ?>
            </div>
            <form class="mailchimp" method="post" novalidate="">
                <div class="input-group  subcribes">
                    <input type="email" name="EMAIL" class="form-control memail" placeholder="<?php echo $atts['input_placeholder'] ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-submit color_v" type="submit"> <?php echo $atts['btn_title']; ?> </button>
                    </span>
                </div>
                <p class="mchimp-errmessage"></p>
                <p class="mchimp-sucmessage"></p>
            </form>
        </div>
    </section>

    <script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__).'js/plugins.js' ?>"></script>
    <!--<script type="text/javascript" src="<?php /*echo plugin_dir_url(__FILE__).'js/jquery.ajaxchimp.langs.js' */?>"></script>-->
    <script>
        if (jQuery(".mailchimp").length > 0)
        {
            jQuery(".mailchimp").ajaxChimp({
                language: 'en',
                callback: mailchimpCallback,
                url: "<?php echo $atts['action_url']; ?>",
            });
        }
        jQuery(".memail").on("focus", function ()
        {
            jQuery(".mchimp-errmessage").fadeOut();
            jQuery(".mchimp-sucmessage").fadeOut();
        });
        jQuery(".memail").on("keydown", function ()
        {
            jQuery(".mchimp-errmessage").fadeOut();
            jQuery(".mchimp-sucmessage").fadeOut();
        });
        jQuery(".memail").on("click", function ()
        {
            jQuery(".memail").val("");
        });
        function mailchimpCallback(resp)
        {
            if (resp.result === "success") {
                jQuery(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
                jQuery(".mchimp-sucmessage").fadeOut(500);
            } else if (resp.result === "error") {
                jQuery(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
            }
        }
    </script>

    <?php
    $html = ob_get_clean();
    return $html;
});



// VC Config
add_action( 'vc_before_init', function() {
    if( function_exists('vc_map') ) {
        vc_map(array(
                'name'              => esc_html__('Subscribe form', 'appland-core'),
                'description'       => esc_html__('Mailchimp subscription form with title and subtitle.', 'appland-core'),
                'base'              => 'appland_subscribe',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => 'Subscribe Our Newsletter',
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
                        'type' => 'textfield',
                        'param_name' => 'btn_title',
                        'value' => 'Subscribe Now',
                        'heading' => esc_html__('Button title', 'appland-core'),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'input_placeholder',
                        'value' => 'Enter your email',
                        'heading' => esc_html__('Input field placeholder', 'appland-core'),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'action_url',
                        'value' => 'https://droitlab.us17.list-manage.com/subscribe/post?u=76b0fef40e7828eb4ff8eb754&id=fbff4a1aff',
                        'heading' => esc_html__('MailChimp form action URL', 'appland-core'),
                        'description' => 'Replace this with your own mailchimp post action URL. Please follow <a href="https://goo.gl/MFB6FD" target="_blank">this guide</a> to find your Mailchimp form action URL',
                    ),

                    /*array(
                        'type' => 'dropdown',
                        'param_name' => 'error_lang',
                        'heading' => esc_html__('Error Language', 'appland-core'),
                        'description' => esc_html__('Display the translation of the Error Messages in your language.', 'appland-core'),
                        'value' => array(
                            'English' => 'en',
                            'French' => 'fr',
                        ),
                    ),*/

                    // ------------------------ Group : Styling ----------------------------
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'style',
                        'heading' => esc_html__('Section Style', 'appland-core'),
                        'group' => 'Styling',
                        'value' => array(
                            'Style one' => 'style_01',
                            'Style two' => 'style_02',
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_01',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/subscribe1.jpg',
                        'group' => 'Styling',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_01'
                        ),
                    ),
                    array(
                        'type' => 'custom_input_image',
                        'param_name' => 'style_02',
                        'heading' => '',
                        'value' => plugin_dir_url(__FILE__).'images/subscribe2.jpg',
                        'group' => 'Styling',
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
                        'type' => 'colorpicker',
                        'param_name' => 'before_color',
                        'heading' => esc_html__('Before color', 'appland-core'),
                        'value' => '#ffffff',
                        'group' => 'Styling',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        )
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'after_color',
                        'heading' => esc_html__('After color', 'appland-core'),
                        'value' => '#ffffff',
                        'group' => 'Styling',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        )
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'bg_image',
                        'heading' => esc_html__('Background image', 'appland-core'),
                        'group' => 'Styling'
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'overlay_type',
                        'heading' => esc_html__('Overlay color type', 'appland-core'),
                        'value' => array(
                            'Gradient color' => 'gradient',
                            'Solid color' => 'solid',
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
