<?php

/**
 *
 * @link              https://www.upwork.com/fl/anushkakrajasingha
 * @since             1.0.0
 * @package           Efbreadcrumb
 *
 * @wordpress-plugin
 * Plugin Name:       EFBreadcrumb
 * Plugin URI:        https://github.com/AnushkaKRajasingha/efbreadcrumb
 * Description:       This is a plugin to achive breadcrumb menu capability in a wordpress website - As a test of efutures
 * Version:           1.0.0
 * Author:            Anushka Rajasingha
 * Author URI:        https://www.upwork.com/fl/anushkakrajasingha
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       efbreadcrumb
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'EFBREADCRUMB_VERSION', '1.0.0' );
define( 'EFBREADCRUMB_NAMETITLE', 'EFBreadcrumb' );
define( 'EFBREADCRUMB_VARPREFIX', 'efb_' );

/**
 * Activation hook
 */
function activate_efbreadcrumb() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-efbreadcrumb-activator.php';
	Efbreadcrumb_Activator::activate();
}

/**
 * deactivation hook
 */
function deactivate_efbreadcrumb() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-efbreadcrumb-deactivator.php';
	Efbreadcrumb_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_efbreadcrumb' );
register_deactivation_hook( __FILE__, 'deactivate_efbreadcrumb' );

require plugin_dir_path( __FILE__ ) . 'includes/class-efbreadcrumb.php';

function run_efbreadcrumb() {

	$plugin = new Efbreadcrumb();
	$plugin->run();

}
run_efbreadcrumb();
