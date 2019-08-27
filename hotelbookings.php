<?php /*
  Plugin Name: Hotel Bookings
  Description: Plugin to Book hotels
  Author: Eyeworx
  Author URI:
  Version: 1.0
 */

/*Plugin PATH*/
define( 'HB_PLUGIN_PATH', plugin_dir_path( __FILE__) );
define( 'HB_PLUGIN_URL', plugin_dir_url(__FILE__) );
//echo HB_PLUGIN_PATH;

// Define path and URL to the ACF plugin.
define( 'HB_ACF_PATH', HB_PLUGIN_PATH . 'includes/acf/' );
define( 'HB_ACF_URL', HB_PLUGIN_PATH . 'includes/acf/' );
define( 'HB_RACF_PATH', HB_PLUGIN_PATH . 'includes/acf-repeater/' );
define( 'HB_MDACF_PATH', HB_PLUGIN_PATH . 'includes/acf-multi-dates-picker/' );

// Define path and URL to the ACF repeater plugin.

// Include the ACF plugin.
require_once( HB_ACF_PATH . 'acf.php' );
require_once( HB_RACF_PATH . 'acf-repeater.php' );
require_once( HB_PLUGIN_PATH . 'acf-fields.php' );
require_once( HB_MDACF_PATH . 'acf-multi-dates-picker.php' );

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}


add_action('admin_menu','load_hotelbooking_menu');

function load_hotelbooking_menu() {
	add_menu_page( 'Hotel Bookings','Hotel Bookings','manage_options','hotel_booking','main_page','dashicons-building',18);
	add_submenu_page( 'hotel_booking','Email Template','Email Template','manage_options','email_template','email_template');
	add_submenu_page( 'hotel_booking','Settings','Settings','manage_options','booking_settings','booking_settings');
}



function main_page(){
    echo HB_PLUGIN_PATH;
}


function email_template(){
    include_once('email-template.php');
}
function booking_settings(){
    include_once('settings-template.php');
}
//creating posts for hotel bookins
require_once('post-types.php');
require_once('functions.php');