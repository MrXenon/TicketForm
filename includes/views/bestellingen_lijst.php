<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type"
	content="text/html";
	charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
		<?php include 'style.css'; ?>
	</style>
	<?php
	if ( function_exists('current_user_can') &&
	!current_user_can('bestelling_overzicht') )
		die(__('Geen toestemming', 'tickeform'));

	// Include the Kaartje class from the model.
	require_once TICKEFORM_PLUGIN_MODEL_DIR.'/Kaartje.php';
	$kaartje = new Kaartje();
	$kaartje2 = new Kaartje();

	// Get the list kaartjesSchema
	$kaartje_lijst = $kaartje->kaartjesSchema();
	
	
	// Get the list bestellingSchema
	$kaartje_lijst2 = $kaartje2->bestellingSchema();

	// Set timezone default:
	date_default_timezone_set('Europe/Amsterdam');

	?>
</head>
<body>
<h1>Overzicht Bestellingen.</h1>
<?php
	echo "<table id='tabel'>
			<th>Naam</th>
			<th>Kaartje ID</th>
			<th>Email</th>
			<th>Adres</th>
			<th>Woonplaats</th>
			<th>Postcode</th>
			<th>Datum</th>";
	foreach ($kaartje_lijst2 as $kaartje_object2){
	echo "<tr>";
	echo "<td>".$kaartje_object2->getNaam();"&nbsp;&nbsp; </td>";
	echo "<td>".
	$kaartje_object2->getKaartjeId();
	"&nbsp;&nbsp; </td>";
	echo "<td>".$kaartje_object2->getEmail();"&nbsp;&nbsp; </td>";
	echo "<td>".$kaartje_object2->getAdres();"&nbsp;&nbsp; </td>";
	echo "<td>".$kaartje_object2->getWoonplaats();"&nbsp;&nbsp; </td>";
	echo "<td>".$kaartje_object2->getPostcode();"&nbsp;&nbsp; </td>";
	echo "<td>".$kaartje_object2->getDatum();"&nbsp;&nbsp; </td></tr>";
	}
	echo "</table>";

	echo "<h3>Alle kaartjes</h3><table id='tabel'>
	<th>Kaartje ID</th>
	<th>Naam</th>
	<th>Beschrijving</th>";
	foreach ($kaartje_lijst as $kaartje_object){
	echo "<tr><td>".$kaartje_object->getId(); "&nbsp;&nbsp; </td>";
	echo "<td>".$kaartje_object->getKaartjeNaam();"&nbsp;&nbsp; </td>";
	echo "<td>".$kaartje_object->getBeschrijving();"&nbsp;&nbsp; </td></tr>";
	}
	echo "</table>";
	
?>
</body>
</html>