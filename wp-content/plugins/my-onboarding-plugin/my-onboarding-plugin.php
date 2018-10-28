<?php
/**
 * My Onboarding Plugin
 *
 * @package   MyOnboardingPlugin
 * @author    Lachezar Gadzhev
 * @copyright 2018 Lachezar Gadzhev
 *
 * @wordpress-plugin
 * Plugin Name: My Onboarding Plugin
 *
 * Description: My onboarding plugin.
 *
 * Version:     1.0.0
 * Author:      Lachezar Gadzhev
 * Author URI:  https://github.com/lgadzhev
 * Text Domain: my-onboarding-plugin
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 */

defined( 'ABSPATH' ) or die( "You can't access this file!" );

require plugin_dir_path( __FILE__ ) . 'includes/MyOnboardingPlugin.php';
if ( class_exists( 'MyOnboardingPlugin' ) ) {
    $myOnboardingPlugin = new MyOnboardingPlugin();
}
register_activation_hook( __FILE__, array( $myOnboardingPlugin, 'activate' ) );
register_deactivation_hook( __FILE__, array( $myOnboardingPlugin, 'deactivate' ) );