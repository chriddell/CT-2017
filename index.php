<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage OTM
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php if ( !empty( otm_get_featured_posts() ) ) : ?>
	<!-- #featured -->
 	<div class="l-pre-main c-featured-carousel" id="featured">
 		<?php otm_show_featured_posts(); ?>
	</div>
	<!-- / #featured -->
<?php endif; ?>

<div class="l-site-wrapper u-pos-rel u-clearfix">
	<header class="c-content-filter u-border-bottom l-page-header">
		<p>Currently showing latest content from <span class="u-bold">All topics <!-- List all categories here --></span></p>
	</header>

	<span class="l-main-container u-clearfix u-block">
		<main id="main" role="main" class="l-main l-main--has-sidebar l-col-12 l-col-sml-7 l-col-med-8 u-clearfix">

			<?php
				if ( have_posts() ) :

					// Render title
					echo '<h2 class="c-section-title">' . __('Latest') . '</h2>';

					// Modify the query
					query_posts( 'posts_per_page=5' );

					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

				endif;
			?>

			<?php
				/* Ajax Load More */
				echo do_shortcode( '[ajax_load_more id="1" container_type="div" post_type="post" offset="5" pause="true" scroll="false" transition="fade" images_loaded="true" button_label="Load 5 more" button_loading_label="Loading..."]' );
			?>
		</main>

		<span class="l-col-12 l-col-sml-push-7 l-col-med-push-8 l-col-sml-1-last c-sidebar-border u-hidden-mobile"><!-- Used to hold border --></span>

		<aside class="l-sidebar c-sidebar l-col-sml-4-last l-col-med-3-last">
			<?php get_template_part( 'template-parts/sidebar' ); ?>
		</aside>
	</span>
</div>

<?php get_footer();