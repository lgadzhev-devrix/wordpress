<?php

/*
 * Template Name: Custom Page
 */

get_header();

if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) : the_post(); ?>

        <h3><?php the_title() ?></h3>

        <p><?php the_content() ?></p>

        <p><?php the_date() ?></p>

	<?php endwhile;
endif;

get_footer();