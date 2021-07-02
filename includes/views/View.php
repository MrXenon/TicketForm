<?php
/**
* Description of KaartjesView class
* All program functionality for the KaartjesView.
*
* @author Jeffrey Scheffers
*/
require_once TICKEFORM_PLUGIN_MODEL_DIR .'/Kaartje.php';

class KaartjesView {
	
	private $kaartje;
	
	public function __construct() {
	 $this->kaartje = new Kaartje();
	}
	
	public function getGetValues(){
	 // Define the check for params
	 $get_check_array = array (
	 // submit action
	 'link' => array('filter' => FILTER_SANITIZE_STRING )
	 );
	 // Get filtered input:
	 return filter_input_array( INPUT_GET, $get_check_array );

	 }
	 
	public function getPostValues(){
	 // Define the check for params
	 $post_check_array = array (

	 // Add kaartje form
	 // submit action
	 'add_ticket' => array('filter' => FILTER_SANITIZE_STRING ),

	 // Naam
	 'naam' => array('filter' => FILTER_SANITIZE_STRING ),

	 // Kaartje nummer
	 'kaartje' => array('filter' => FILTER_SANITIZE_NUMBER_INT ),

	 // Email
	 'email' => array('filter' => FILTER_SANITIZE_STRING ),
	 
	 // Adres
	 'adres' => array('filter' => FILTER_SANITIZE_STRING ),
	 
	 // Woonplaats
	 'woonplaats' => array('filter' => FILTER_SANITIZE_STRING ),
	 
	 // Postcode
	 'postcode' => array('filter' => FILTER_SANITIZE_STRING ),

	 // Calendar info
	 'datum' => array('filter' => FILTER_SANITIZE_STRING ),

	 	 // userid info
		  'userid' => array('filter' => FILTER_SANITIZE_STRING )
	 );
	 // Get filtered input:
	 $post_inputs = filter_input_array( INPUT_POST, $post_check_array );


	 return $post_inputs;
	 }
	 
	 public function is_submit_add_form( $post_inputs ){
	 if (!is_null($post_inputs['add_ticket'])) return TRUE;

	 return FALSE;
	 }
	 
	 public function check_save_form ( &$post_inputs ){

	 // Special wordpress error class
	 $errors = new WP_Error();

	 // Naam
	 try {
	 $this->kaartje->checkNaam($post_inputs['naam']);
	 } catch (Exception $exc) {
	 $errors->add('naam', $exc->getMessage());
	 }

	 // Kaartje
	 try {
	 $this->kaartje->checkKaartje($post_inputs['kaartje']);
	 } catch (Exception $exc) {
	 $errors->add('kaartje', $exc->getMessage());
	 }

	 // Email
	 try {
	 $this->kaartje->checkEmail($post_inputs['email']);
	 } catch (Exception $exc) {
	 $errors->add('email', $exc->getMessage());
	 }
	 
	 // Adres
	 try {
	 $this->kaartje->checkAdres($post_inputs['adres']);
	 } catch (Exception $exc) {
	 $errors->add('adres', $exc->getMessage());
	 }
	 
	 // Woonplaats
	 try {
	 $this->kaartje->checkWoonplaats($post_inputs['woonplaats']);
	 } catch (Exception $exc) {
	 $errors->add('woonplaats', $exc->getMessage());
	 }
	 
	 // Postcode
	 try {
	 $this->kaartje->checkPostcode($post_inputs['postcode']);
	 } catch (Exception $exc) {
	 $errors->add('postcode', $exc->getMessage());
	 }
	 
	 
	 
	 // Check all date's
	 $dates = array( 'datum');
	 foreach( $dates as $date_field ){
	 try {
	 // End date might be empty
	 $date_empty = !($date_field == 'datum');
	 $this->kaartje->checkDate($post_inputs[$date_field],
	$date_empty);
	 // If empty date equals 0000-00-00 change to ''
	 if (!$date_empty && (strcmp($post_inputs[$date_field] ,'0000-
	00-00') == 0 )){
	 $post_inputs[$date_field] = '';
	 }

	 } catch (Exception $exc) {
	 $errors->add($date_field, $exc->getMessage());
	 }
	 }

	 // Check for errors before saving the date
	 if ($errors->get_error_code()) return $errors;
	 return TRUE; // return the real result
	 }
	 
}
?>