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

			get_template_part( 'template-parts/page/content', get_post_format() );

		endwhile; // End of the loop.
	?>
</main>

<?php
/* Detect whether post is one of the specfied below, and show some extra content if true */
/* 572 = Tech and Ops 2017 */
if ( is_page( 'mifid-ii-buy-side-impact' ) || is_page( 572 ) ) : ?>

	<div class="l-post-page-content">
		<span class="l-wrapper u-clearfix">	
			<h2 class="c-section-title">What we're saying on our blog</h2>

			<?php 
				if ( is_page( 'mifid-ii-buy-side-impact' ) ) :

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

			<?php
				elseif ( is_page( 572 ) ) :

					// Slug of target post
					$target_post_slugs = array(
						'consolidated-reporting-offers-path-happier-clients',
						'cloud-computing-still-wrestling-cybersecurity-fears',
						'best-breed-single-provider-satisfy-technology-needs',
						'outsourcing-under-the-microscope',
						'data-management-key-increased-profitability',
						'compliance-woes-weigh-even-heavier'
					);

					// Args for query
					$args = array(
						'post_type'			=> 'post',
						'post_status'		=> 'publish',
						'numberposts'		=> -1,
						'post_name__in' => $target_post_slugs
					);

					// Run query
					$my_query = new WP_Query( $args );

					if ( $my_query->have_posts() ) : ?>

						<aside id="related" role="complementary" class="c-carousel--related owl-carousel">

						<?php
							while ( $my_query->have_posts() ) : $my_query->the_post();
								get_template_part( 'template-parts/content-related' );
							endwhile; ?>

						</aside>

				<?php
					endif;

					// Reset query
					wp_reset_query(); ?>

			<?php
				endif; ?>

		</span><!-- / .l-wrapper -->
	</div><!-- / .l-post-page-content -->

<?php
endif; ?>

<?php get_footer();