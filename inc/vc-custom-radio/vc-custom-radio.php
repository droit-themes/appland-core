<?php

if ( ! defined( 'ABSPATH' ) ) {
    die( '' ); // Don't call directly
}

add_action( 'vc_build_admin_page', 'vc_custom_radio_init' );

function vc_custom_radio_init() {
    require_once 'param/class-vc-custom-radio.php';
    new VcCustomParams();
}

function vc_custom_radio_path() {
    return __FILE__;
}