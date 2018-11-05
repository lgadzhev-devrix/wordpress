<?php

/**
 * Class MyOnboardingPlugin
 */
class MyOnboardingPlugin {
	/**
	 * MyOnboardingPlugin constructor.
	 */
	function __construct() {
		add_action( 'init', array( $this, 'custom_post_type' ) );
		add_filter( 'archive_template', array( $this, 'filter_archive_page' ) );
		add_action( 'wp_ajax_change_filter', array( $this, 'change_filter_option' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'admin_menu', array( $this, 'my_onboarding_submenu' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_student_info_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'student_city_country_save' ), 1, 2 );
	}

	/**
	 *  Activates the plugin
	 */
	function activate() {
		add_option( 'my_onboarding_filter', '1' );
		flush_rewrite_rules();
	}

	/**
	 * Deactivates the plugin
	 */
	function deactivate() {
		flush_rewrite_rules();
	}

	/**
	 * Enqueue script
	 */
	function enqueue() {
		wp_enqueue_script( 'mypluginscript', plugins_url( '../assets/script.js', __FILE__ ), array( 'jquery' ) );
	}

	/**
	 * Add menus
	 */
	function my_onboarding_submenu() {
		add_menu_page( "My Onboarding Page",
			"Onboarding",
			"manage_options",
			"my_onboarding",
			array( $this, 'my_onboarding_page' ) );

		add_submenu_page( 'my_onboarding',
			'My Onboarding',
			'My Onboarding',
			'manage_options',
			'my_onboarding',
			array( $this, 'my_onboarding_page' ) );
	}

	/**
	 * Include template
	 */
	function my_onboarding_page() {
		require_once( 'templates/my-onboarding.php' );
	}

	/**
	 * Filter the output
	 */
	function change_filter_option() {
		update_option( 'my_onboarding_filter', intval( $_POST['filters_enabled'] ) );
		wp_die();
	}

	/**
	 *  Register the custom post type
	 */
	function custom_post_type() {
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
				'revisions'
			),
			'taxonomies'          => array( 'category', 'post_tag' ),
			'menu_position'       => 0,
			'exclude_from_search' => false,
		);
		register_post_type( 'student', $args );
	}

	/**
	 * Filter the archive page with custom one
	 *
	 * @param $archive_template
	 *
	 * @return string
	 */
	function filter_archive_page( $archive_template ) {
		global $post;

		if ( is_post_type_archive( 'student' ) ) {
			$archive_template = dirname( __FILE__ ) . '/templates/archive-student.php';
		}

		return $archive_template;
	}

	/**
	 * Add meta boxes for our CPT
	 */
	function add_student_info_meta_boxes() {

		//Country City meta box
		add_meta_box(
			'student_city_country',
			'Lives In (Country, City)',
			array( $this, 'student_city_country' ),
			'student',
			'normal',
			'default'
		);

		//Address meta box
		add_meta_box(
			'student_address',
			'Address',
			array( $this, 'student_address' ),
			'student',
			'normal',
			'default'
		);

		//Birth Date meta box
		add_meta_box(
			'student_birth_date',
			'Birth Date',
			array( $this, 'student_birth_date' ),
			'student',
			'normal',
			'default'
		);

		//Class / Grade
		add_meta_box(
			'student_class_grade',
			'Class / Grade',
			array( $this, 'student_class_grade' ),
			'student',
			'normal',
			'default'
		);
	}

	/**
	 * Create the markup
	 */
	function student_city_country() {
		global $post;

		// Get the location data if it's already been entered
		$student_city_country = get_post_meta( $post->ID, 'student_city_country', true );
		// Output the field
		echo '<input type="text" name="student_city_country" value="' . esc_textarea( $student_city_country ) . '" class="widefat">';
	}


	/**
	 * Create the markup
	 */
	function student_address() {
		global $post;

		// Get the location data if it's already been entered
		$student_address = get_post_meta( $post->ID, 'student_address', true );
		// Output the field
		echo '<input type="text" name="student_address" value="' . esc_textarea( $student_address ) . '" class="widefat">';
	}

	/**
	 * Create the markup
	 */
	function student_birth_date() {
		global $post;

		// Get the location data if it's already been entered
		$student_birth_date = get_post_meta( $post->ID, 'student_birth_date', true );
		// Output the field
		echo '<input type="text" name="student_birth_date" value="' . esc_textarea( $student_birth_date ) . '" class="widefat">';
	}

	/**
	 * Create the markup
	 */
	function student_class_grade() {
		global $post;

		// Get the location data if it's already been entered
		$student_class_grade = get_post_meta( $post->ID, 'student_class_grade', true );
		// Output the field
		echo '<input type="text" name="student_class_grade" value="' . esc_textarea( $student_class_grade ) . '" class="widefat">';
	}


	/**
	 * Save the meta boxes's values
	 *
	 * @param $post_id
	 * @param $post
	 */
	function student_city_country_save( $post_id, $post ) {

		// Return if the user doesn't have edit permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
		// Verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times.
		if ( ! isset( $_POST['student_city_country'] ) ||
		     ! isset( $_POST['student_address'] ) ||
		     ! isset( $_POST['student_birth_date'] ) ||
		     ! isset( $_POST['student_class_grade'] ) ) {
			return $post_id;
		}

		$student_meta['student_city_country'] = sanitize_text_field( $_POST['student_city_country'] );
		$student_meta['student_address']      = sanitize_text_field( $_POST['student_address'] );
		$student_meta['student_birth_date']   = sanitize_text_field( $_POST['student_birth_date'] );
		$student_meta['student_class_grade']  = sanitize_text_field( $_POST['student_class_grade'] );

		foreach ( $student_meta as $key => $value ) :
			// Don't store custom data twice
			if ( 'revision' === $post->post_type ) {
				return;
			}
			if ( get_post_meta( $post_id, $key, false ) ) {
				// If the custom field already has a value, update it.
				update_post_meta( $post_id, $key, $value );
			} else {
				// If the custom field doesn't have a value, add it.
				add_post_meta( $post_id, $key, $value );
			}
			if ( ! $value ) {
				// Delete the meta key if there's no value
				delete_post_meta( $post_id, $key );
			}
		endforeach;
	}

}