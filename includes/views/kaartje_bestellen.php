
<?php
/*if ( function_exists('current_user_can') &&
!current_user_can('kaartjes_bestellen') )
	die(__('Geen toestemming', 'tickeform'));*/

// Include the Kaartje class from the model.
require_once TICKEFORM_PLUGIN_MODEL_DIR.'/Kaartje.php';
$kaartje = new Kaartje();

// Get the list with the cards
$kaartje_lijst = $kaartje->getCardList();

// Set timezone default:
date_default_timezone_set('Europe/Amsterdam');

?>

<h2><?= __('Kaartjes Bestellen')?></h2>
<p />
<form action="<?= $file_base_url; ?>" method="post">
 <table>
 <?php 
 $user = wp_get_current_user();
 $name = $user->user_nicename;
 $email = $user->user_email;
 ?>
 <tr><td><?= __('Naam:');?></td><td><input type="text" maxlength=32 placeholder="John van den Berg" name="naam" value="<?= $name;?>"/></td></tr>
 <tr><td><?= __('Email:');?></td><td><input type="email" maxlength=50 placeholder="john@gmail.com" name="email" value="<?= $email;?>"/></td></tr>
 <tr><td><?= __('Adres:');?></td><td><input type="text" maxlength=30 placeholder="Straatnaam 10" name="adres" value=""/></td></tr>
 <tr><td><?= __('Woonplaats:');?></td><td><input type="text" maxlength=20 placeholder="Amsterdam" name="woonplaats" value=""/></td></tr>
 <tr><td><?= __('Postcode:');?></td><td><input type="text" maxlength=6 placeholder="0000XX" name="postcode" value=""/></td></tr>
 <tr><td><?= __('Datum vandaag:<br />');?></td><td><input type="date" name="datum" value=""></input>
 <tr><input type="hidden" name="userid" value="<?= get_current_user_id(); ?>"></tr>
<span class="error">
<?= $form_result->get_error_message('datum');?></span></td></tr> 
 <tr><td><?= __('Selecteer kaartje:');?></td><td><select name="kaartje"><?php
 foreach ($kaartje_lijst as $kaartje_object){
 ?>
 <option value="<?= $kaartje_object->getId();?>"><?php
echo $kaartje_object->getKaartjeNaam();
echo"&nbsp;&nbsp;&nbsp;";
echo $kaartje_object->getBeschrijving();?></option>
<?php }
 ?></select></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="add_ticket" value="<?= __('Aanmaken');?>" /></td></tr>
</table>
</form>