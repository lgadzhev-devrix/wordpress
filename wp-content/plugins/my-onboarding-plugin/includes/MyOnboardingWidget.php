<?php


/**
 * Class MyOnboardingWidget
 */
class MyOnboardingWidget extends WP_Widget {


	/**
	 * MyOnboardingWidget constructor.
	 */
	public function __construct() {
		parent::__construct( 'my_onboarding_widget', 'My Onboarding Widget',
			array( 'customize_selective_refresh' => true, )
		);
	}


	/**
	 * Display the widget
	 *
	 * @param array $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {


		// Set widget defaults
		$defaults = array(
			'posts_per_page' => '',
			'select'         => false,
		);

		// Parse current settings with defaults
		extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>">Posts Per Page: </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'posts_per_page' ) ); ?>" type="number"
                   value="<?php echo esc_attr( $posts_per_page ); ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'select' ); ?>">Students Status: </label>
            <select name="<?php echo $this->get_field_name( 'select' ); ?>"
                    id="<?php echo $this->get_field_id( 'select' ); ?>" class="widefat">
				<?php
				// Your options array
				$options = array(
					''      => 'Select',
					'false' => 'Active',
					'true'  => 'Inactive',
				);

				// Loop through options and add each one to the select dropdown
				foreach ( $options as $key => $name ) {
					echo '<option value="' . esc_attr( $key ) . '" id=my_onboarding_widget-value-"' . esc_attr( $key ) . '" ' . selected( $select, $key, false ) . '>' . $name . '</option>';

				} ?>
            </select>
        </p>

		<?php
	}


	/**
	 * Update widget settings
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array|void
	 */
	public function update( $new_instance, $old_instance ) {

		$instance                   = $old_instance;
		$instance['posts_per_page'] = isset( $new_instance['posts_per_page'] ) ? wp_strip_all_tags( $new_instance['posts_per_page'] ) : '';
		$instance['select']         = isset( $new_instance['select'] ) ? wp_strip_all_tags( $new_instance['select'] ) : '';

		return $instance;
	}


	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		extract( $args );

		// Check the widget options
		$post_per_page = isset( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : '';
		$status        = isset( $instance['select'] ) ? $instance['select'] : false;

		$limitPosts = new WP_Query( array(
			'post_type'      => 'student',
			'posts_per_page' => $post_per_page,
			'meta_query'     => array(
				array(
					'key'   => 'disabled_student',
					'value' => $status,
				),
			),
		) );

		// Before widget
		echo $before_widget;

		// Display the widget
		echo '<div class="widget-text wp_widget_plugin_box">';

		if ( $limitPosts->have_posts() ) :

			/* Start the Loop */
			while ( $limitPosts->have_posts() ) : $limitPosts->the_post();
				the_title(
				        '<h6 class="entry-title"><a href="' .
                        esc_url( get_permalink() ) .
                        '" rel="bookmark">', '</a></h6>' );
			endwhile;
		endif;

		echo '</div>';

		// End widget
		echo $after_widget;
	}

}