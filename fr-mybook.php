<?php 
/**
 * @package MyBook
 * @version 1.1
*/
/*
 /**
* Plugin Name: My Book
* Plugin URI: 
* Description: Test plugin-wp-mybook
* Version: 1.0
* Author: phamthanhnghia
* Author URI: https://github.com/phamthanhnghia
* Text Domain: top-bar
* Domain Path: /lang/
* License: GPL2
 */
 
register_activation_hook(__FILE__, 'fr_mybook_active');


function fr_mybook_active()
{
    $fr_mybook_version = '1.1';
    add_option('_fr_mybook_version', $fr_mybook_version, '', 'yes');
    // update_option('_fr_mybook_version', $fr_mybook_version, '', 'yes');
}

register_activation_hook(__FILE__, 'fr_mybook_install_database');

function fr_mybook_install_database()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'fr_mybook_book'; 

    $sql = "CREATE TABLE " . $table_name . " (
      id int(11) NOT NULL AUTO_INCREMENT,
      name VARCHAR (50) NOT NULL,
      PRIMARY KEY  (id)
    );";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}


function fr_mybook_admin_menu()
{
    add_menu_page('MyBook','MyBook', 'activate_plugins', 'mybook', 'fr_mybook_page_header');
}

add_action('admin_menu', 'fr_mybook_admin_menu');

function fr_mybook_page_header(){
  include(dirname(__FILE__)."\includes\index.php");
}

/* --- Enqueue plugin stylsheet --- */
add_action( 'admin_enqueue_scripts', 'add_admin_fr_mybook_style' );
function add_admin_fr_mybook_style() {
  wp_enqueue_style( 'mybook', plugins_url('css/bootstrap.min.css', __FILE__));
}