<?php 

// if uninstall.php is not called by WordPress, die

if (!defined('WP_UNINSTALL_PLUGIN')) {

    die;

}



$page_cat_id = get_option('local_creator_page_cat_id');

wp_delete_post($page_cat_id);



$seconpage =   get_option('local_creator_business_page');



wp_delete_post($seconpage);

 

$option_name_first = 'local_creator_business_page';



$option_name_second = 'local_creator_page_cat_id';

 

delete_option($option_name_first);

 

// for site options in Multisite

delete_site_option($option_name_first);



delete_option($option_name_second);

 

// for site options in Multisite

delete_site_option($option_name_second);

 

    global $wpdb;
    $table_name = $wpdb->prefix . 'tmj_services';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");	$table_name = $wpdb->prefix . 'feature_bus_listing';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");	$table_name = $wpdb->prefix . 'business_cities';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");	$table_name = $wpdb->prefix . 'city_states_templates';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
    delete_option("import_db_version");

?>