<?php
/*
 * Plugin Name: LeadBoxer
 * Plugin URI: https://wordpress.org/plugins/leadboxer/
 * Description: LeadBoxer Plugin
 * Version: 1.2
 * Author: LeadBoxer
 * Author URI:  https://wordpress.org/plugins/leadboxer/
 * Text Domain: leadboxer-en
 * Domain Path: /languages/
 * Copyright 2015  Elena Karaush

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'WPINC' ) ) {
    die;
}
/**
defines
*/
require_once ('init.php');

/**
main plug-in class
*/
require_once plugin_dir_path( __FILE__ ) . 'leadboxer.class.php';

register_activation_hook( __FILE__, 'leadboxer_activate');
register_deactivation_hook( __FILE__, 'leadboxer_deactivate');
register_uninstall_hook( __FILE__, 'leadboxer_uninstall');

//Call the Main class of the  LeadBoxer Plug-in
$otApplication = new LeadBoxer();
$otApplication->run();

/**
Plugin Install Functions
*/

function leadboxer_activate() {
	add_option( 'leadboxer_dataset', 'dataset','','yes');

}

function leadboxer_deactivate() {
       delete_option('leadboxer_dataset');
}

function leadboxer_uninstall() {
      delete_option('leadboxer_dataset');
}


function leadboxer_settings_link($links) {

$settings_link = '<a href=' . admin_url("admin.php?page=leadboxer>Settings") . '</a>';
  array_unshift($links, $settings_link);
  return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'leadboxer_settings_link' );

?>