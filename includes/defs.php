<?php
/**
* Definitions needed in the plugin
*
* @author
* @version 1.0
*
* Version history
* 1.0 Initial version
*/
// De versie moet gelijk zijn met het versie nummer in de tickeform.php header
define( 'TICKEFORM_VERSION', '1.0' );
// Minimum required Wordpress version for this plugin
define( 'TICKEFORM_REQUIRED_WP_VERSION', '4.0');
define( 'TICKEFORM_PLUGIN_BASENAME', plugin_basename(TICKEFORM_PLUGIN));
define( 'TICKEFORM_PLUGIN_NAME', trim( dirname(TICKEFORM_PLUGIN_BASENAME ), '/'));
// Folder structure
define( 'TICKEFORM_PLUGIN_DIR', untrailingslashit( dirname(TICKEFORM_PLUGIN)));
define( 'TICKEFORM_PLUGIN_INCLUDES_DIR',TICKEFORM_PLUGIN_DIR . '/includes');
define(	'TICKEFORM_PLUGIN_INCLUDES_VIEWS_DIR',	TICKEFORM_PLUGIN_INCLUDES_DIR . '/views');
define( 'TICKEFORM_PLUGIN_MODEL_DIR',TICKEFORM_PLUGIN_INCLUDES_DIR . '/model');
define( 'TICKEFORM_PLUGIN_ADMIN_DIR',TICKEFORM_PLUGIN_DIR . '/admin');
define( 'TICKEFORM_PLUGIN_ADMIN_VIEWS_DIR',TICKEFORM_PLUGIN_ADMIN_DIR . '/views');
?>