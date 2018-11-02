<?php
/**
 * Template Name: Archive Student
 */
get_header();

$limitToFour = new WP_Query( array(
	'post_type'      => 'student',
	'posts_per_page' => 4,
) );

if ( $limitToFour->have_posts() ) : ?>
	<?php
	/* Start the Loop */
	while ( $limitToFour->have_posts() ) : $limitToFour->the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		get_template_part( 'template-parts/post/content', get_post_format() );
	endwhile;
	wp_reset_postdata();
else :

	get_template_part( 'template-parts/post/content', 'none' );

endif;
get_footer();
