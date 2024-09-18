<?php 


if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

function appland_register_widgets() {
	register_widget('Appland_About_Us');
    register_widget('Appland_Contact_Info');
    register_widget('Appland_Recent_Posts');
}
add_action( 'widgets_init', 'appland_register_widgets' );


// Require widget files
require APPLAND_CORE_FILE . 'inc/widgets/widget_about_us.php';
require APPLAND_CORE_FILE . 'inc/widgets/widget_contact_info.php' ;
require APPLAND_CORE_FILE . 'inc/widgets/widget-recent-posts.php';

