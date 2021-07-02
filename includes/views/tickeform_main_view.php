<?php
// Set base url and add page specific vars
$base_url = get_permalink();

// Include the kaartje class from the VIEW.
require_once TICKEFORM_PLUGIN_INCLUDES_VIEWS_DIR.'/View.php';

$kaartjes_view = new KaartjesView();

// Get the getters
$get_inputs = $kaartjes_view->getGetValues();

// Get form vars
$post_inputs = $kaartjes_view->getPostValues();

// If provided set current file based on the provided link
$current_file = (!empty($get_inputs['link']) ?
TICKEFORM_PLUGIN_INCLUDES_VIEWS_DIR. '/'. $get_inputs['link'].'.php' :
'');
// Add the current page link get param.
if (!empty($get_inputs['link'])){
 $params = array( 'link' => $get_inputs['link']);
 $file_base_url = add_query_arg( $params, $base_url );

} else {
 // Or stick to base url
 $file_base_url = $base_url;
}

$form_result = new WP_Error();


// Check add form kaartje :
if ( $kaartjes_view->is_submit_add_form($post_inputs) ){
	
 // Check add form submission :
 $form_result = $kaartjes_view->check_save_form( $post_inputs );

 if ( !is_bool($form_result) && get_class($form_result) == 'WP_Error'){

 // Reshow the form again.
 } else{

 echo "Het is opgeslagen in de database!<br />";

 // Check on error
 if ( !($form_result instanceof WP_Error )){

 $form_result = new WP_Error();
 }

 // Create instance of kaartje class
 $kaartje = new Kaartje();

 // Save the card
 $return = $kaartje->save(
 $post_inputs['naam'],
 $post_inputs['kaartje'],
 $post_inputs['email'],
 $post_inputs['adres'],
 $post_inputs['woonplaats'],
 $post_inputs['postcode'],
 $post_inputs['datum'],
 $post_inputs['userid']);

 if ( ! ($return instanceof WP_Error)) {
 // Do not show the kaartje input file again : Show main page
 $current_file = '';
 }
 
 }
}

if (!empty($current_file) && file_exists( $current_file)){

 // Include the link file and show that page.
 include $current_file;
 } //*
else if (!empty($current_file) && !file_exists($current_file)){
 // Linked file not found!
 echo '<span style="color:red">Main view error: FILE NOT FOUND ['.
$current_file .']</span>';

} //*/
else {

echo '<span style="font-size:22px;color:blue">Main View</span><br>';
?>
<br>
<?php
 // Create add link
 $params = array( 'link' => 'kaartje_bestellen');
 // Add params to base url update link
 $link = add_query_arg( $params, $base_url );
?>
<p><a id='button' href="<?php echo $link;?>">Kaartje bestellen </a><br>

<?php
//}
if (current_user_can('bestelling_overzicht')){
 // Create list link
 $params = array( 'link' => 'bestellingen_lijst');
 // Add params to base url link
 $link = add_query_arg( $params, $base_url );
?>
<a id='button' href="<?php echo $link;?>">Bestellings lijst </a><br>

<?php
}
if (current_user_can('kaartjes_overzicht')){
 // Create list link
 $params = array( 'link' => 'overzichtkaarten');
 // Add params to base url link
 $link = add_query_arg( $params, $base_url );
?>
<a id='button' href="<?php echo $link;?>">Kaartjes overzicht </a><br></p>
<?php
    
}	
}
?>
<br>