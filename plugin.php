<?php 
/**
 * Plugin Name: Simple Alert Boxes
 * Plugin URI: http://www.rafael.mardojai.com/simple-alert-boxes-plugin
 * Description: Use responsives alert boxes with shortcodes.
 * Version: 1.2
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

/** Head Enqueue **/
function simple_alert_boxes_scripts() {
	wp_enqueue_style( 'simple-alert-boxes', plugins_url( 'css/simple-alert-boxes.css', __FILE__ )  );	
}
add_action( 'wp_enqueue_scripts', 'simple_alert_boxes_scripts' );

/** ShortCode **/
add_shortcode( 'alert', 'alert_output' );
function alert_output( $atts, $content ) {
    $atts = shortcode_atts( array(
        'type' => '',
        'text' => ''
    ), $atts );
    return '<div class="alert ' . $atts['type'] . '"><p>' . $atts['text'] . '' . $content . '</p></div>';
}

/** TinyMCE Plugin **/
function alert_boxes_tinymce() {

    add_filter( 'mce_external_plugins', 'fb_add_tinymce_plugin' );    
    add_filter( 'mce_buttons', 'fb_add_tinymce_button' );
}
add_action( 'admin_head', 'alert_boxes_tinymce' );

function fb_add_tinymce_plugin( $plugin_array ) {
    $plugin_array['simple_alert_boxes'] = plugins_url( '/js/plugin.js', __FILE__ );    
    return $plugin_array;
}

function fb_add_tinymce_button( $buttons ) {
    array_push( $buttons, 'alert_boxes_button_key' );    
    return $buttons;
}
?>
