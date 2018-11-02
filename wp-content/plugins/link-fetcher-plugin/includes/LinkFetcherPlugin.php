<?php

class LinkFetcherPlugin
{
    public function __construct()
    {
        add_action( 'wp_ajax_fetch_uri', array( $this, 'fetch_uri' ));
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
        add_action('admin_menu', array($this, 'link_fetcher_menu'));
    }

    /**
     * Activates the plugin
     */
    public function activate()
    {
        flush_rewrite_rules();
    }
    /**
     * Deactivates the plugin
     */
    public function deactivate()
    {
        flush_rewrite_rules();
    }

    public function admin_enqueue()
    {
        wp_enqueue_script( 'link_fetcher_script', plugins_url( '../assets/admin_script.js', __FILE__ ), array( 'jquery' ) );
    }

    public function link_fetcher_menu()
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

    public function link_fetcher_page()
    {
        require_once ( 'templates/link-fetcher.php');
    }

    public function fetch_uri()
    {
        $uri = esc_url( $_POST['fetch_uri'] );
        $duration = intval( $_POST['cache_duration']);

        $response =  $this->transient_request($uri, $duration);

        echo $response;

        wp_die();
    }

    protected function transient_request($uri, $duration)
    {
        $transient_string = get_transient( $uri . '-cache' );

        if ( false === $transient_string ) {
            $content = wp_remote_get( $uri )['body'];
            set_transient($uri . '-cache', $content, $duration * MINUTE_IN_SECONDS );
            $transient_string = get_transient( $uri . '-cache' );
        }

        return $transient_string;
    }
}