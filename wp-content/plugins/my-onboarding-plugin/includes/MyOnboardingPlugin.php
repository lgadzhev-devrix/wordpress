<?php

class MyOnboardingPlugin
{
    function __construct()
    {
        add_action( 'init', array( $this, 'custom_post_type' ) );
        add_action( 'wp_ajax_change_filter', array( $this, 'change_filter_option' ));
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
        add_action( 'admin_menu', array($this, 'my_onboarding_submenu'));

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

    /**
     *  Register the custom post type
     */
    function custom_post_type()
    {
        $labels = array(
            'name'               => 'Students',
            'singular_name'      => 'Student',
            'add_new'            => 'Add Student',
            'all_items'          => 'All Students',
            'add_new_item'       => 'Add Student',
            'edit_item'          => 'Edit Student',
            'new_item'           => 'New Student',
            'view_item'          => 'View Student',
            'search_item'        => 'Search Student',
            'not_found'          => 'No student found',
            'not_found_in_trash' => 'No student found in trash',
            'parent_item_colon'  => 'Parent Student'
        );
        $args   = array(
            'labels'              => $labels,
            'public'              => true,
            'has_archive'         => true,
            'publicly_queryable'  => true,
            'query_var'           => true,
            'rewrite'             => true,
            'capability_type'     => 'post',
            'hierarchical'        => false,
            'supports'            => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'revisions',
                'custom-fields'
            ),
            'taxonomies'          => array( 'category', 'post_tag' ),
            'menu_position'       => 0,
            'exclude_from_search' => false,
        );
        register_post_type( 'student', $args );
    }
}