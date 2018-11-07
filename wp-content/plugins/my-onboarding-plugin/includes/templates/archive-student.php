<?php
/**
 * Template Name: Archive Student
 */
get_header();

$limitToFour = new WP_Query( array(
	'post_type'      => 'student',
	'posts_per_page' => 4,
	'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
	'meta_query' => array(
		array(
			'key'     => 'disabled_student',
			'value'   => 'false',
		),
	),
) );

if ( $limitToFour->have_posts() ) : ?>
	<?php
	/* Start the Loop */
	while ( $limitToFour->have_posts() ) : $limitToFour->the_post();
		get_template_part( 'template-parts/post/content', get_post_format() );
	endwhile;

	?>
	<div class="pagination">
    <?php
        echo paginate_links( array(
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'total'        => $limitToFour->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Posts', 'text-domain' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Posts', 'text-domain' ) ),
            'add_args'     => false,
            'add_fragment' => '',
        ) );
    ?>
</div>
<?php

	wp_reset_postdata();
else :

	get_template_part( 'template-parts/post/content', 'none' );

endif;
get_footer();
