<?php

class MyOnboardingPlugin
{
    function __construct()
    {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
        add_action('admin_menu', array($this, 'my_onboarding_submenu'));
    }

    /**
     * Activates the plugin
     */
    function activate()
    {
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
        add_submenu_page('options-general.php',
            'My Onboarding',
            'My Onboarding',
            'manage_options',
            'my_onboarding',
            'my_onboarding_page');
    }

    function my_onboarding_page()
    {

    }
}