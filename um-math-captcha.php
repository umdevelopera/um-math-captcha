<?php
/**
 * Plugin Name: Ultimate Member - Math Captcha
 * Plugin URI:  https://github.com/umdevelopera/um-math-captcha
 * Description: Adds the Math Captcha field to the registration form
 * Author:      umdevelopera
 * Author URI:  https://github.com/umdevelopera
 * Text Domain: um-math-captcha
 * Domain Path: /languages
 *
 * Requires at least: 6.5
 * Requires PHP: 7.4
 * UM version: 2.9.0
 * Version: 1.1.1
 *
 * @package um_ext\um_math_captcha
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once ABSPATH . 'wp-admin/includes/plugin.php';

$plugin_data = get_plugin_data( __FILE__, true, false );

define( 'um_math_captcha_url', plugin_dir_url( __FILE__ ) );
define( 'um_math_captcha_path', plugin_dir_path( __FILE__ ) );
define( 'um_math_captcha_plugin', plugin_basename( __FILE__ ) );
define( 'um_math_captcha_extension', $plugin_data['Name'] );
define( 'um_math_captcha_version', $plugin_data['Version'] );
define( 'um_math_captcha_textdomain', 'um-math-captcha' );


// Check dependencies.
if ( ! function_exists( 'um_math_captcha_check_dependencies' ) ) {
	function um_math_captcha_check_dependencies() {
		if ( ! defined( 'um_path' ) || ! function_exists( 'UM' ) || ! UM()->dependencies()->ultimatemember_active_check() ) {
			// Ultimate Member is not active.
			add_action(
				'admin_notices',
				function () {
					// translators: %s - plugin name.
					echo '<div class="error"><p>' . wp_kses_post( sprintf( __( 'The <strong>%s</strong> extension requires the Ultimate Member plugin to be activated to work properly. You can download it <a href="https://wordpress.org/plugins/ultimate-member">here</a>', 'um-math-captcha' ), um_math_captcha_extension ) ) . '</p></div>';
				}
			);
		} else {
			require_once 'includes/class-um-math-captcha.php';
			UM()->set_class( 'Math_Captcha', true );
		}
	}
}
add_action( 'plugins_loaded', 'um_math_captcha_check_dependencies', 2 );
