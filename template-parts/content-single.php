<?php
/**
 * Template part for displaying single posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage OTM
 * @since 1.0
 * @version 1.0
 */

?>

<?php

	// Title
	the_title( '<h1>', '</h1>' );

	// Author
	printf( __( '<p>Written by %s</p>', 'otm' ), get_the_author() );

	// Date
	the_date('jS F Y');

	/* translators: %s: Name of current post */
	the_content( sprintf(
		__( 'Continue reading<span class="sr-only"> "%s"</span>', 'otm' ),
		get_the_title()
	) );

	// Show related solutions (custom taxonomy / ACF)
	otm_render_related_solutions();
?>

<?php 
	
	// Related Posts
	otm_related_posts();
?>

<?php get_footer();