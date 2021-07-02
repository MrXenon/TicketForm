<?php
/**
*	Description	of	view_shortcodes.php
*
*	@author	Jeffrey Scheffers
*/
//	Add	the	main	view	shortcode
add_shortcode(	'tickeform_main_view',	'load_main_view');

function load_main_view( $atts, $content = NULL){

 // Include the main view
 include TICKEFORM_PLUGIN_INCLUDES_VIEWS_DIR.
'/tickeform_main_view.php';

}
?>