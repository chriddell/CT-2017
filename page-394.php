<?php
/**
 * The template for displaying the page
 * with ID 394
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

			get_template_part( 'template-parts/page/content', get_post_format() );

		endwhile; // End of the loop.
	?>
</main>

<div class="l-post-page-content">
	<span class="l-wrapper u-clearfix">	
		<h2 class="c-section-title">What we're saying on our blog</h2>

		<?php 
			// Slug of target post
			$target_post_slug = 'mifid-ii-brings-world-change-buy-side-not-just-europe'; 

			// Args for query
			$args = array(
				'name'				=> $target_post_slug,
				'post_type'		=> 'post',
				'post_status'	=> 'publish',
				'numberposts'	=> 1
			);

			// Run query
			$my_query = new WP_Query( $args );

			if ( $my_query->have_posts() ) :
				while ( $my_query->have_posts() ) : $my_query->the_post();
					get_template_part( 'template-parts/content-related' );
				endwhile;
			endif;

			// Reset query
			wp_reset_query(); ?>

	</span><!-- / .l-wrapper -->
</div><!-- / .l-post-page-content -->

<?php get_footer();