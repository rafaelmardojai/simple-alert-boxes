<?php
/**
 * Simple Alert Boxes Plugin
 *
 * @package    simple-alert-boxes
 * @author     Rafael Mardojai CM <mardojai.cardenas@gmail.com>
 * @link       http://www.rafael.mardojai.com/simple-alert-boxes-plugin/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Plugin Name: Simple Alert Boxes
 * Plugin URI: http://www.rafael.mardojai.com/simple-alert-boxes-plugin
 * Description: Use responsives alert boxes with shortcodes.
 * Version: 1.4.0
 * Author: Rafael Mardojai CM
 * Author URI: http://www.rafael.mardojai.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

/*  Copyright 2016 Rafael Mardojai CM  (email : mardojai.cardenas@gmail.com)

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

/**
 * Styles enqueue
 *
 * @since 1.0.0
 */
function simple_alert_boxes_styles() {
	$options = get_option( 'sab_options' );

	wp_enqueue_style( 'simple-alert-boxes', plugins_url( 'css/simple-alert-boxes.css', __FILE__ ), array(), '1.4', 'all' );
	wp_enqueue_style( 'sab-fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'simple_alert_boxes_styles' );

/**
 * Admin styles enqueue
 *
 * @since 1.3.0
 */
function simple_alert_boxes_admin_styles() {
	wp_enqueue_style( 'simple-alert-boxes-tinymce', plugins_url( 'css/simple-alert-boxes-tinymce.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'simple_alert_boxes_admin_styles' );

/**
 * Shortcode
 * [alert type=the-box-type icon-size=the-icon-size]the content[/alert]
 *
 * @since 1.0.0
 *
 * @param array $atts Shortcode atts.
 * @param string $content Shortcode content.
 * @return string Shortcode HTML.
 */
function simple_alert_boxes_output( $atts, $content = null) {
    $atts = shortcode_atts( array(
        'type'      => 'info', // set type attr and defaults
		'icon-size' => 'normal', // set icon-size attr and defaults
		'text'      => '' // 1.0.0 $content
    ), $atts );

	$options = get_option( 'sab_options' );
	$classes = array();
	$classes[] = $atts['type'];
	$classes[] = $atts['icon-size'];

	ob_start();
	?>
	<div class="simple-alert-boxes <?php foreach( $classes as $class ) { echo 'sab_' . $class . ' '; }?>">
		<?php echo $atts['text']; echo do_shortcode( $content ); ?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'alert', 'simple_alert_boxes_output' );

/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.3.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function sab_empty_paragraph_fix( $content ) {

    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );
    return strtr( $content, $array );

}
add_filter( 'the_content', 'sab_empty_paragraph_fix' );

/**
 * Register TinyMCE plugin
 *
 * @since 1.2.0
 */
function simple_alert_boxes_tinymce() {
    add_filter( 'mce_external_plugins', 'sab_add_tinymce_plugin' );
    add_filter( 'mce_buttons', 'sab_add_tinymce_button' );
}
add_action( 'admin_head', 'simple_alert_boxes_tinymce' );

/**
 * Add TinyMCE plugin
 *
 * @since 1.2.0
 *
 * @param array $plugin_array TinyMCE plugins list
 */
function sab_add_tinymce_plugin( $plugin_array ) {
    $plugin_array['simple_alert_boxes'] = plugins_url( '/js/plugin.js', __FILE__ );
    return $plugin_array;
}

/**
 * Add TinyMCE plugin button
 *
 * @since 1.2.0
 */
function sab_add_tinymce_button( $buttons ) {
    array_push( $buttons, 'alert_boxes_button_key' );
    return $buttons;
}
