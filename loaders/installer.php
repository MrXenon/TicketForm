<?php

// function to create the DB / Options / Defaults					
function install_tables() {
	
   	global $wpdb;
  	global $tblname;
	$tblname = $wpdb->prefix . 'tf_kaartjes';
	$tblname1 = $wpdb->prefix . 'tf_kaartjes_aanmaak';
	// create the ECPT metabox database table
	if($wpdb->get_var("show tables like '$tblname'") != $tblname) 
	{
		$sql = "CREATE TABLE " . $tblname . " (
		`id_kaart` bigint(10) NOT NULL AUTO_INCREMENT,
		`naam` varchar(64) NOT NULL,
		`kaartje` bigint(10) NOT NULL,
		`email` varchar(64) NOT NULL,
		`adres` varchar(64) NOT NULL,
		`woonplaats` varchar(64) NOT NULL,
		`postcode` varchar(11) NULL,
		`datum` date NULL,
		PRIMARY KEY id_kaart (id_kaart)
		);";
		
		$sql1 = "CREATE TABLE " . $tblname1 . " (
		`id_kaartje` bigint(10) NOT NULL AUTO_INCREMENT,
		`kaartjenaam` varchar(32) NOT NULL,
		`beschrijving` varchar(1024) NOT NULL,
		PRIMARY KEY id_kaartje (id_kaartje),
		UNIQUE KEY kaartjenaam (kaartjenaam)
		);";
 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		dbDelta($sql1);
	}
 
}

?>