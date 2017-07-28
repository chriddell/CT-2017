<?php
/**
 * The template for displaying a page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#page
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

			// Check if child of 'case-studies' page
			if ( $post->post_parent !== 0 && get_post( $post->post_parent )->post_name === 'case-study' ) :

				get_template_part( 'template-parts/page/content', 'case-study' );

			else :

				get_template_part( 'template-parts/page/content', get_post_format() );

			endif;

		endwhile; // End of the loop.
	?>
</main>

<?php get_footer();