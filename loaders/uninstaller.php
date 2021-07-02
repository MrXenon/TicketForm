<?php

function uninstall_tables() {
     global $wpdb;
     $table_name = $wpdb->prefix . 'tf_kaartjes';
     $table_name1 = $wpdb->prefix . 'tf_kaartjes_aanmaak';
     $sql = "DROP TABLE IF EXISTS $table_name";
     $sql1 = "DROP TABLE IF EXISTS $table_name1";
     $wpdb->query($sql);
     $wpdb->query($sql1);
}   


?>