<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type"
	content="text/html";
	charset="UTF-8"/>
	<?php
	if ( function_exists('current_user_can') &&
	!current_user_can('kaartjes_overzicht') )
		die(__('Geen toestemming', 'tickeform'));

	// Include the Kaartje class from the model.
	require_once TICKEFORM_PLUGIN_MODEL_DIR.'/Kaartje.php';
	$kaartje = new Kaartje();

	// Get the list with the cards
	$kaartje_lijst = $kaartje->kaartjesSchema();

	// Set timezone default:
	date_default_timezone_set('Europe/Amsterdam');
	?>
</head>
<body>
<h1>Overzicht Kaartjes.</h1>
<?php
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