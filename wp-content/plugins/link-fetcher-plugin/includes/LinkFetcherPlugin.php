<?php

class LinkFetcherPlugin
{
    function __construct()
    {
        add_action( 'wp_ajax_fetch_uri', array( $this, 'fetch_uri' ));
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
        add_action('admin_menu', array($this, 'link_fetcher_menu'));
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

    function admin_enqueue()
    {
        wp_enqueue_script( 'link_fetcher_script', plugins_url( '../assets/admin_script.js', __FILE__ ), array( 'jquery' ) );
    }

    function link_fetcher_menu()
    {
        add_menu_page("Link Fetcher",
            "Link Fetcher",
            "manage_options",
            "link_fetcher",
            array( $this, 'link_fetcher_page' ));

        add_submenu_page('link_fetcher',
            'Link Fetcher',
            'Link Fetcher',
            'manage_options',
            'link_fetcher',
            array( $this, 'link_fetcher_page' ));
    }

    function link_fetcher_page()
    {
        require_once ( 'templates/link-fetcher.php');
    }

    function fetch_uri()
    {
        $response =  wp_remote_get( esc_url( $_POST['fetch_uri'] ) );

        echo $response['body'];

        wp_die();
    }
}