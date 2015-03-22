<?php 
/**
 * Plugin Name: Simple Alert Boxes
 * Plugin URI: http://www.rafael.mardojai.com/simple-alert-boxes-plugin
 * Description: Use responsives alert boxes with shortcodes.
 * Version: 1.0
 * Author: Rafael Mardojai C.M.
 * Author URI: http://www.rafael.mardojai.com
  * License: A short license name. Example: GPL2
 */

/*  Copyright 2015 Rafael Mardojai C.M.  (email : mardojai.cardenas@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
function wpsab_scripts() {
	wp_enqueue_style( 'simple-alert-boxes', plugins_url( 'css/style.css', __FILE__ )  );	
    wp_enqueue_style( 'simple-alert-boxes-icons', plugins_url( 'css/font-awesome.min.css', __FILE__ )  );	
}
add_action( 'wp_enqueue_scripts', 'wpsab_scripts' );
function random_alert($atts) {
   extract(shortcode_atts(array(
      'type' => '',
      'text' => '',
   ), $atts));
return '<div class="alert ' . $type . '"><p>' . $text . '</p></div>';
}
add_shortcode('alert', 'random_alert');
?>