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

$img = get_field('featured_image');

/**
 * Get the category of the post.
 * This will return only ONE category,
 * because we're using radio-buttons-for-taxonomies
 * plugin (https://en-gb.wordpress.org/plugins/radio-buttons-for-taxonomies/)
 *
 */
$categories = get_the_category();
$category_slug = '';
if ( !empty( $categories ) ) : 
	$category_name = esc_html( $categories[0]->name );
	$category_slug = $categories[0]->slug;
endif;

?>

<div class="l-hero l-hero--single c-hero c-hero--single" id="hero" style="background-image: url(<?php echo $img['url']; ?>);"></div>

<div class="l-page-content c-page-content u-bg-white u-pos-rel" id="main-content">
	<span class="l-wrapper u-pos-rel u-clearfix">
		<article class="l-main l-col-12 l-col-sml-8 l-col-med-9 u-clearfix c-article c-article--<?php echo $category_slug; ?>">
			<header class="c-article__header">
				<?php
					// Title
					the_title( '<h1 class="c-article-title c-section-title c-article__title">', '</h1>' );
				?>
				<span class="c-article__meta u-block u-clearfix">
					<?php
					// Show author if category is Expert Insights
					if ( $category_slug == 'insights' ) :
						// Author
						printf( __( '<p class="c-article__author c-article__meta-item l-col-12 l-col-sml-8">Written by %s</p>', 'otm' ), get_the_author() );
						?>
						<p class="c-article__date c-article__meta-item l-col-12 l-col-sml-4-last u-med-text-right"><?php the_date('jS F Y'); ?></p>
					<?php else : ?>	
						<p class="c-article__date c-article__meta-item l-col-12"><?php the_date('jS F Y'); ?></p
					<?php endif; ?>
				</span>
			</header>

			<div class="c-article__main c-wyswiyg-content">
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading<span class="sr-only"> "%s"</span>', 'otm' ),
						get_the_title()
					) );
				?>
			</div>
			<?php
				if ( get_field( 'cta_url' ) ) : ?>
					<a href="<?php the_field('cta_url'); ?>" class="c-article__cta c-btn c-read-more c-read-more--smaller" target="_blank">
					<?php 
						// Alternative copy dependent on
						// post category
						switch ($category_slug) {
							case 'reports':
								_e( 'Read the report', 'otm' );
								break;
							case 'infographic':
								_e( 'View the infographic', 'otm' );
								break;
							case 'whitepaper':
								_e( 'Read the whitepaper', 'otm' );
								break;
							default:
								_e( 'Learn more', 'otm' );
						}
					?>
					</a>
			<?php 
				endif; ?>
		</article>
		<aside class="l-sidebar l-sidebar--article c-sidebar c-article__sidebar l-col-sml-4-last l-col-med-3-last">

			<!-- #social-share -->
			<div class="c-share c-article__share" id="social-share">

				<h4 class="c-aside-title">Share: </h4>

				<!-- FB is share using the Javascript SDK https://developers.facebook.com/docs/sharing/reference/share-dialog#jssdk -->
				<a href="#0" class="c-share__elem c-share__square c-share__square--fb c-share--fb" data-url="<?php the_permalink(); ?>"><span class="u-sr-only">Share to Facebook</span></a>

				<!-- Twitter is share using Web Intents https://dev.twitter.com/web/intents  -->
				<a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo urlencode( get_permalink() ); ?>" class="c-share__elem c-share__square c-share__square--tw c-share--tw"><span class="u-sr-only">Share to Twitter</span></a>

				<!-- LinkedIn is shared using Web Intents but we have custom JS to open as pop-up -->
				<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink() ); ?>&title=<?php the_title(); ?>&source=SS%26C%20Advent" class="c-share__elem c-share__square c-share__square--li c-share--li"><span class="u-sr-only">Share to LinkedIn</span></a>
			</div>
			<!-- / #social-share -->

			<?php otm_show_related_solutions(); ?>

		</aside>
	</span>
</div>
	
<div class="l-post-page-content">
	<span class="l-wrapper u-clearfix">	
		<?php otm_show_related_posts(); ?>
	</span>
</div>

<?php get_template_part( 'template-parts/pre-footer' ); ?>

<?php get_footer();