<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage OTM
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<main id="main" role="main" class="u-clearfix">
	<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

			// Set page views
			otm_set_post_views( get_the_ID() );

			if ( is_single() ) :
				get_template_part( 'template-parts/content-single', get_post_format() );
			else :
				get_template_part( 'template-parts/content', get_post_format() );
			endif;

		endwhile; // End of the loop.
	?>
</main>