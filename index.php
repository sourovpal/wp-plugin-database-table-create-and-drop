register_activation_hook( __FILE__, 'my_plugin_create_db' );
function my_plugin_create_db() {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'my_analysis';

	$sql = "CREATE TABLE my_tbl_sourov (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		views smallint(5) NOT NULL,
		clicks smallint(5) NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}




function my_plugin_remove_database() {
   global $wpdb;
   // $table_name = $wpdb->prefix . 'my_analysis';
   // $table_name = "NestoNovo";
   $sql = "DROP TABLE IF EXISTS my_tbl_sourov;";
   $wpdb->query($sql);
   delete_option("my_plugin_db_version");
}    
register_deactivation_hook( __FILE__, 'my_plugin_remove_database' );
