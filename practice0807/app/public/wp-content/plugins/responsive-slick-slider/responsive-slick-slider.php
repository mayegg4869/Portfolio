<?php
// Exit if accessed directly
if(!defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * @link              https://wordpress.org/plugins/responsive-slick-slider/
 * @since             1.0.0
 * @package           responsive-slick-slider
 *
 * @wordpress-plugin
 * Plugin Name:       Responsive Slick Slider
 * Plugin URI:        https://wordpress.org/plugins/responsive-slick-slider/
 * Description:       Responsive Slick Slider is built on the top of slick js with support to unlimited banner images, text layers and videos(YouTube, Mp4, HTML5 and Vimeo).
 * Version:           1.4
 * Author:            Vsourz Digital
 * Author URI:        https://www.vsourz.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       vsz_responsive_slick
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-responsive-slick-slider-activator.php
 */
function activate_responsive_slick_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-responsive-slick-slider-activator.php';
	responsive_slick_slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-responsive-slick-slider-deactivator.php
 */
function deactivate_responsive_slick_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-responsive-slick-slider-deactivator.php';
	responsive_slick_slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_responsive_slick_slider' );
register_deactivation_hook( __FILE__, 'deactivate_responsive_slick_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-responsive-slick-slider.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_responsive_slick_slider() {

	$plugin = new responsive_slick_slider();
	$plugin->run();

}
run_responsive_slick_slider();
