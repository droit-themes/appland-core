<?php

class VcCustomParams {

    public function __construct() {
        add_action('vc_load_default_params', array(
            $this,
            'vc_load_vc_custom_radio_param',
        ));
        add_action('vc_load_default_params', array(
            $this,
            'vc_load_vc_custom_input_image_param',
        ));
    }

    public function vc_enqueue_editor_scripts_be() {
        wp_enqueue_script('vc-custom-params-be', preg_replace('/\s/', '%20', plugins_url('assets/vc-custom-params.js', vc_custom_params_path())));
        wp_enqueue_style('vc-custom-params-be-style', preg_replace('/\s/', '%20', plugins_url('assets/vc-custom-style.css', vc_custom_params_path())));
    }

    public function vc_enqueue_editor_scripts_fe() {
        wp_enqueue_script('vc-custom-params-fe', preg_replace('/\s/', '%20', plugins_url('assets/vc-custom-params.js', vc_custom_params_path())));
        wp_enqueue_style('vc-custom-params-fe-style', preg_replace('/\s/', '%20', plugins_url('assets/vc-custom-style.css', vc_custom_params_path())));
    }

    /**
     * Add custom param to system
     */
    public function vc_load_vc_custom_radio_param() {
        vc_add_shortcode_param('custom_radio', array($this, 'render',));
        vc_add_shortcode_param('custom_input_image', array($this, 'custom_input_image',));
    }

    /**
     * Radio shortcode attribute type.
     *
     * @param $settings
     * @param string $value
     *
     * @return string - html string.
     */
    public function render($settings, $value) {
        $output = '';
        $current_value = is_string($value) ? ( strlen($value) > 0 ? explode(',', $value) : array() ) : (array) $value;
        $values = isset($settings['value']) && is_array($settings['value']) ? $settings['value'] : array(__('Yes') => 'true');
        if (!empty($values)) {
            foreach ($values as $label => $v) {
                $checked = count($current_value) > 0 && in_array($v, $current_value) ? ' checked' : '';
                $output .= ' <label class="vc_radio-label"><input style="width:auto" id="' . $settings['param_name'] . '-' . $v . '" value="' . $v . '" class="wpb_vc_param_value ' . $settings['param_name'] . ' ' . $settings['type'] . '" type="radio" name="' . $settings['param_name'] . '"' . $checked . '> <img src="' . esc_url($label) . '" alt="' . $v . '" title="' . $v . '"> </label>';
            }
        }
        return $output;
    }

    // Function for registering the custom_input_image custom param type
    function custom_input_image($settings, $value) {
        ob_start();
        ?>

        <div class="custom_input_image_param_block">
            <input name="<?php echo esc_attr($settings['param_name']); ?>" class="wpb_vc_param_value wpb-textinput <?php echo esc_attr($settings['param_name']) . ' ' . esc_attr($settings['type']); ?>_field" type="hidden" value="<?php echo esc_attr($value); ?>" />
            <img style="max-width: 600px;" src="<?php echo esc_attr($value); ?>" class="vc-custom-param-image">
        </div>

        <?php
        return ob_get_clean();
    }
}
