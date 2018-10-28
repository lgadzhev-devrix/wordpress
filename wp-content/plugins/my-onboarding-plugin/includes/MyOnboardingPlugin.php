<?php

class MyOnboardingPlugin
{
    function __construct()
    {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    /**
     * Activates the plugin
     */
    function activate()
    {
        $this->enqueue();
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
}