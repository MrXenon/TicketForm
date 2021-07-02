<?php
/**
* Description of Kaartje
*
* @author Jeffrey Scheffers
*/
require_once TICKEFORM_PLUGIN_MODEL_DIR.'/KaartjeAanmaak.php';
class Kaartje {
/**
 *
 * @return type array of KaartjeAanmaak
 */
 public function getCardList(){

 return $this->kaartje_aanmaak->getCardList();
 }
  public function kaartjesSchema(){

 return $this->kaartje_aanmaak2->kaartjesSchema();
 }
   public function bestellingSchema(){

 return $this->kaartjes->bestellingSchema();
 }
 /**
 *
 * @var type KaartjeAanmaak
 */
 private $kaartje_aanmaak = null;
 private $kaartje_aanmaak2 = null;
 private $kaartjes = null;

 public function __construct() {

 // Init the card
 $this->kaartje_aanmaak = new KaartjeAanmaak();
 $this->kaartje_aanmaak2 = new KaartjeAanmaak();
 $this->kaartjes = new KaartjeAanmaak();
 }
 
 public function checkNaam($naam){

 if (!is_string($naam)) throw new Exception ( __('Tekst invullen') );

 if (empty($naam)) throw new Exception ( __('Verplicht veld!' ));

 }
 
 public function checkKaartje($kaartje){
 if( !is_numeric($kaartje)) throw new Exception( __('Kaartje link incorrect'));

 if( strlen($kaartje) < 1 ) throw new Exception ( __('Verplicht veld!') );

 }

 public function checkEmail($email){

 if (!is_string($email)) throw new Exception ( __('Tekst invullen') );

 if (empty($email)) throw new Exception ( __('Verplicht veld!' ));

 }
 
  public function checkAdres($adres){

 if (!is_string($adres)) throw new Exception ( __('Tekst invullen') );

 if (empty($adres)) throw new Exception ( __('Verplicht veld!' ));

 }
 
  public function checkWoonplaats($woonplaats){

 if (!is_string($woonplaats)) throw new Exception ( __('Tekst invullen') );

 if (empty($woonplaats)) throw new Exception ( __('Verplicht veld!' ));

 }
 
  public function checkPostcode($postcode){

 if (!is_string($postcode)) throw new Exception ( __('Tekst invullen') );

 if (empty($postcode)) throw new Exception ( __('Verplicht veld!' ));

 }

 public function checkDate( $date , $empty = FALSE){

 if ( !$empty && strlen($date) < 1 ) throw new Exception( __('Verplicht
veld') );
 if (!is_string($date)) throw new Exception ( __('Datum tekst formaat
yyyy-mm-dd') );
 // @todo check date format
 }

 public function checkUserid($userid){

  if (!is_string($userid)) throw new Exception ( __('Tekst invullen') );
 
  if (empty($userid)) throw new Exception ( __('Verplicht veld!' ));
 
  }

 private function getKaartjeTableName(){
  return $table = 'tf_kaartjes';
}
 
 
 /**
 *
 * @global WPDB $wpdb Wordpress database class
 * @param string $naam
 * @param int $kaartje -> id
 * @param string $email
 * @param string $adres
 * @param string $woonplaats
 * @param string $postcode
 * @param date $datum
 * @return boolean
 */
 function save($naam, $kaartje, $email, $adres, $woonplaats, $postcode, $datum, $userid){

 global $wpdb;
 $error = new WP_Error();

 try {
 $this->checkNaam($naam);
 $this->checkKaartje($kaartje);
 $this->checkEmail($email);
 $this->checkAdres($adres);
 $this->checkWoonplaats($woonplaats);
 $this->checkPostcode($postcode);
 $this->checkDate($datum);
 } catch (Exception $exc) {
 $error->add('save', $exc->getMessage());
 }

 // Check on found errors if none save data
 if ( count( $error->get_error_messages() ) < 1 ) {

 $sql = $wpdb->prepare("INSERT INTO `". $wpdb->prefix . $this->getKaartjeTableName() ."`
".
 "( `naam`, `kaartje`, ".
 "`email`, `adres`, `woonplaats`, `postcode`, `datum`, `userid`)".
 " VALUES ( '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%d'".
 ");",
 $naam, $kaartje, $email, $adres, $woonplaats, $postcode, $datum, $userid);
 /*
// Check your SQL by adding an additional slash before the ‘/*’
 echo '<pre>';
 var_dump($sql);
 echo '</pre>';
 //*/

 $wpdb->query($sql );

 // Error on save ? It's in there:
 if ( !empty($wpdb->last_error) ){
 $this->last_error = $wpdb->last_error;
 $error->get_error_message($this->last_error);

return $error;
 }

 } else {

 // Some WP_ERROR on input vars
 var_dump($error);
 return $error;
 }

 // Return the last inserted id (Id from the newly created card)
 return $wpdb->insert_id;
 }
 
 
 
}
?>