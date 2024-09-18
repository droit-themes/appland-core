<?php
add_shortcode('appland_latest_posts', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title'         => 'latest post',
        'subtitle'      => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
        'ppp'           => 4,
        'read_more'     => 'Read More',
        'order'         => 'ASC',
        'cats'          => '',
        'style'         => 'style_01',
        'sec_padding'   => '150px 0px 100px 0px',
        'is_carousel'   => 'true',
        'is_br'         => '',
        'title_weight' => '',
    ),$atts);

    $posts = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => $atts['ppp'],
        'order' => $atts['order'],
        'category_name' => $atts['cats']
    ));
    ?>
    <?php
    if($atts['style']=='style_01') {
        ?>
        <section class="blog_area_two" style="padding: <?php echo $atts['sec_padding'];?>">
            <div class="section_title text-center <?php echo ($atts['is_br'] != 'true') ? 'no-br' : ''; ?>">
                <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
                <?php if (!empty($atts['subtitle'])) { ?>
                    <p> <?php echo $atts['subtitle']; ?> </p>
                <?php } ?>
            </div>
            <?php
            while($posts->have_posts()) : $posts->the_post();
                ?>
                <div class="row post_box post_box_four">
                    <div class="col-md-6">
                        <?php the_post_thumbnail('appland_570x340', array('class' => 'img-responsive')); ?>
                    </div>
                    <div class="col-md-6">
                        <div class="blog-text">
                            <ul class="date">
                                <li><?php esc_html_e('Posted By -', 'appland-core'); ?>
                                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')) ?>">
                                        <?php echo get_the_author_meta('display_name'); ?>
                                    </a>
                                </li>
                                <li><?php esc_html_e('Date - ', 'appland-core'); ?> <?php the_time(get_option('date_format')) ?> </li>
                            </ul>
                            <a href="<?php the_permalink(); ?>"><h3 class="title"> <?php the_title(); ?> </h3></a>
                            <p> <?php echo wp_trim_words(get_the_content(), 23, ''); ?> </p>
                            <a href="<?php the_permalink(); ?>" class="read_btn"> <?php echo $atts['read_more']; ?> <span class="lnr lnr-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </section>
        <?php
    }

    if($atts['style']=='style_02') {
        if($atts['is_carousel']=='true') {
            ?>
            <section class="blog_area" style="padding: <?php echo $atts['sec_padding']; ?>">
                <div class="container">
                    <div class="section_title text-center <?php echo ($atts['is_br'] != 'true') ? 'no-br' : ''; ?>">
                        <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                        <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
                        <?php if (!empty($atts['subtitle'])) { ?>
                            <p> <?php echo $atts['subtitle']; ?> </p>
                        <?php } ?>
                    </div>
                    <div id="blog-slider" class="blog-slider owl-carousel">
                        <?php
                        while ($posts->have_posts()) : $posts->the_post();
                            ?>
                            <div class="thumbnail-blog">
                                <div class="thumbnail-img">
                                    <?php the_post_thumbnail('appland_370x280', array('class' => 'img-responsive')); ?>
                                </div>
                                <div class="content">
                                    <h6> <?php the_time(get_option('date_format')) ?> </h6>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <h5> <?php echo wp_trim_words(get_the_title(), 9, '') ?> </h5></a>
                                    <p> <?php echo wp_trim_words(get_the_content(), 15, ''); ?> </p>
                                    <a href="<?php the_permalink(); ?>"> <?php echo $atts['read_more']; ?> <i
                                                class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
            <?php
        }else {
            ?>
            <section class="blog_area_three">
                <div class="container">
                    <div class="sec_title_five text-center <?php echo ($atts['is_br'] != 'true') ? 'no-br' : ''; ?>">
                        <h2 style="<?php Appland_FontWeight($atts, 'title_weight'); ?>"> <?php echo $atts['title']; ?> </h2>
                        <?php if($atts['is_br']=='true') { ?> <div class="br"></div> <?php } ?>
                        <?php if (!empty($atts['subtitle'])) { ?>
                            <p> <?php echo $atts['subtitle']; ?> </p>
                        <?php } ?>
                    </div>
                    <div class="row blog-slider">
                        <?php
                        while ($posts->have_posts()) : $posts->the_post();
                            ?>
                            <div class="col-md-4">
                                <div class="thumbnail-blog">
                                    <div class="thumbnail-img">
                                        <?php the_post_thumbnail('appland_370x280', array('class' => 'img-responsive')); ?>
                                    </div>
                                    <div class="content">
                                        <h6> <?php the_time(get_option('date_format')) ?> </h6>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <h5> <?php echo wp_trim_words(get_the_title(), 9, '') ?> </h5></a>
                                        <p> <?php echo wp_trim_words(get_the_content(), 15, ''); ?> </p>
                                        <a href="<?php the_permalink(); ?>"> <?php echo $atts['read_more']; ?> <i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
            <?php
        }
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
                'name'              => esc_html__('Blog Posts', 'appland-core'),
                'description'       => esc_html__('Display blog posts', 'appland-core'),
                'base'              => 'appland_latest_posts',
                'category'          => esc_html__('Appland', 'appland-core'),
                'params'            => array(
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'heading' => esc_html__('Title', 'appland-core'),
                        'value' => 'latest post',
                        'holder' => 'h2',
                        'group' => esc_html__('Title', 'appland-core')
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'subtitle',
                        'heading' => esc_html__('Subtitle', 'appland-core'),
                        'value' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
                        'admin_label' => true,
                        'group' => esc_html__('Title', 'appland-core')
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_br',
                        'heading' => esc_html__('Is bottom line?', 'appland-core'),
                        'group' => esc_html__('Title', 'appland-core')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'ppp',
                        'heading' => esc_html__('Post show count', 'appland-core'),
                        'value' => 4,
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'order',
                        'heading' => esc_html__('Post order', 'appland-core'),
                        'value' => array(
                            'Ascending' => 'ASC',
                            'Descending ' => 'DESC',
                        )
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'cats',
                        'heading' => esc_html__('Category', 'appland-core'),
                        'description' => esc_html__('Filter posts by category.', 'appland-core'),
                        'value' => Appland_cat_array()
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'read_more',
                        'heading' => esc_html__('Read more link label', 'appland-core'),
                        'value' => 'Read More'
                    ),
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
                        'value' => plugin_dir_url(__FILE__).'images/latest-posts1.jpg',
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
                        'value' => plugin_dir_url(__FILE__).'images/latest-posts2.jpg',
                        'group' => 'Styling',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        ),
                    ),
                    array(
                        'type' => 'checkbox',
                        'param_name' => 'is_carousel',
                        'heading' => esc_html__('Show Carousel indicator?', 'appland-core'),
                        'group' => 'Styling',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => 'style_02'
                        ),
                        'value' => 'true'
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'sec_padding',
                        'heading' => esc_html__('Section padding', 'appland-core'),
                        'description' => 'Input the padding as clock wise (Top Right Bottom Left)',
                        'value' => '150px 0px 100px 0px',
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
