<?php
// About us
class Appland_About_Us extends WP_Widget {
    public function __construct()  { // 'About us' Widget Defined
        parent::__construct('about_us', esc_html__('(Theme) About us', 'appland'), array(
            'description'   => esc_html__('About us widget by Appland', 'appland'),
            'classname'     => 'widget1 about_us_widget'
        ));
    }

    // Front End
    public function widget($args, $instance) {
        extract( $args );
        $logo = isset($instance['logo']) ? $instance['logo'] : '';
        $content = isset($instance['content']) ? $instance['content'] : '';
        $is_social_links = isset($instance['is_social_links']) ? $instance['is_social_links'] : '';
        $allowed_tags = array(
            'div' => array(
                'class' =>array(),
                'id' => array()
            ),
            'h4' => array(
                'class' =>array(),
                'id' => array()
            ),
            'h2' => array(
                'class' =>array(),
                'id' => array()
            ),
        );
        echo wp_kses($args['before_widget'], $allowed_tags);
        ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
            <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('name') ?>">
        </a>
        <p> <?php echo esc_html($content) ?> </p>
        <?php if($is_social_links=='1') { ?>
            <ul class="nav social_icon row m0">
                <?php Appland_social_links(); ?>
            </ul>
            <?php
        }
        echo wp_kses($args['after_widget'], $allowed_tags);
    }

    // Backend
    function form( $instance ) {

        //
        // set defaults
        // -------------------------------------------------
        $instance   = wp_parse_args( $instance, array(
            'logo'              => '',
            'is_social_links'   => '',
            'content'           => '',
        ));

        //
        // upload field example
        // -------------------------------------------------
        $upload_value = esc_attr( $instance['logo'] );
        $upload_field = array(
            'id'    => $this->get_field_name('logo'),
            'name'  => $this->get_field_name('logo'),
            'type'  => 'upload',
            'title' => esc_html__('Logo', 'appland'),
            'desc'  => esc_html__('Upload here a image the About us widget logo.', 'appland'),
        );
        echo cs_add_element( $upload_field, $upload_value );

        //
        // image field example
        // -------------------------------------------------
        $switcher_value = esc_attr( $instance['is_social_links'] );
        $switcher_field = array(
            'id'    => $this->get_field_name('is_social_links'),
            'name'  => $this->get_field_name('is_social_links'),
            'type'  => 'switcher',
            'title' => esc_html__('Show/hide social icons', 'appland'),
            'info'  => esc_html__('Are you want to show the Social links?', 'appland')
        );
        echo cs_add_element( $switcher_field, $switcher_value );

        //
        // textarea field example
        // -------------------------------------------------
        $textarea_value = esc_attr( $instance['content'] );
        $textarea_field = array(
            'id'    => $this->get_field_name('content'),
            'name'  => $this->get_field_name('content'),
            'type'  => 'textarea',
            'title' => esc_html__('Content', 'appland'),
            'info'  => esc_html__('Write here some description text.', 'appland')
        );
        echo cs_add_element( $textarea_field, $textarea_value );

    }

    // Update Data
    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['content'] = $new_instance['content'];
        $instance['logo'] = $new_instance['logo'];
        $instance['is_social_links'] = $new_instance['is_social_links'];

        return $instance;
    }

}