<?php

class MyOnboardingPlugin
{
    function __construct()
    {
        add_action( 'wp_ajax_change_filter', array( $this, 'change_filter_option' ));
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
        add_action('admin_menu', array($this, 'my_onboarding_submenu'));
    }

    /**
     * Activates the plugin
     */
    function activate()
    {
        add_option( 'my_onboarding_filter', '1' );
        flush_rewrite_rules();
    }
    /**
     * Deactivates the plugin
     */
    function deactivate()
    {
        flush_rewrite_rules();
    }

    function enqueue()
    {
        wp_enqueue_script( 'mypluginscript', plugins_url( '../assets/script.js', __FILE__ ), array( 'jquery' ) );
    }

    function my_onboarding_submenu()
    {
        add_menu_page("My Onboarding Page",
            "Onboarding",
            "manage_options",
            "my_onboarding",
            array( $this, 'my_onboarding_page' ));

        add_submenu_page('my_onboarding',
            'My Onboarding',
            'My Onboarding',
            'manage_options',
            'my_onboarding',
            array( $this, 'my_onboarding_page' ));
    }

    function my_onboarding_page()
    {
        require_once ( 'templates/my-onboarding.php');
    }

    function change_filter_option()
    {
        update_option( 'my_onboarding_filter', intval( $_POST['filters_enabled']) );
        wp_die();
    }
}