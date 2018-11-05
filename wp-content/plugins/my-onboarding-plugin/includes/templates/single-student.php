<?php

get_header(); ?>

    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					?>
                    <div><?php the_title() ?></div><br><br>
                    <label>Lives In (Country, City): </label>
                    <div><?php echo get_post_meta( $post->ID, 'student_city_country', true ); ?></div>
                    <label>Address: </label>
                    <div><?php echo get_post_meta( $post->ID, 'student_address', true ); ?></div>
                    <label>Birth Date: </label>
                    <div><?php echo get_post_meta( $post->ID, 'student_birth_date', true ); ?></div>
                    <label>Class / Grade: </label>
                    <div><?php echo get_post_meta( $post->ID, 'student_class_grade', true ); ?></div>
				<?php

				endwhile; // End of the loop.
				?>

            </main><!-- #main -->
        </div><!-- #primary -->
		<?php get_sidebar(); ?>
    </div><!-- .wrap -->

<?php get_footer();
