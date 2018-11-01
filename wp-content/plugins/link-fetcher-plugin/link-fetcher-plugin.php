<?php
/**
 * Link Fetcher Plugin
 *
 * @package   LinkFetcherPlugin
 * @author    Lachezar Gadzhev
 * @copyright 2018 Lachezar Gadzhev
 *
 * @wordpress-plugin
 * Plugin Name: Link Fetcher Plugin
 *
 * Description: Link fetcher plugin.
 *
 * Version:     1.0.0
 * Author:      Lachezar Gadzhev
 * Author URI:  https://github.com/lgadzhev-devrix
 * Text Domain: link-fetcher-plugin
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 */

defined( 'ABSPATH' ) or die( "You can't access this file!" );

require plugin_dir_path( __FILE__ ) . 'includes/LinkFetcherPlugin.php';
if ( class_exists( 'LinkFetcherPlugin' ) ) {
    $linkFetcherPlugin = new LinkFetcherPlugin();
}
register_activation_hook( __FILE__, array( $linkFetcherPlugin, 'activate' ) );
register_deactivation_hook( __FILE__, array( $linkFetcherPlugin, 'deactivate' ) );