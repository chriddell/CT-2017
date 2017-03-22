<?php
/**
 * The template for displaying all single posts which are
 * featured (boolean ACF). Display inside a carousel.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage OTM
 * @since 1.0
 * @version 1.0
 */
?>

<?php

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

<?php $img = get_field('featured_image'); ?>

<article class="c-featured-item" style="background-image: url(<?php echo $img['url'] ?>);">
	<span class="l-site-wrapper u-pos-rel u-100-height">
		<span class="c-featured-item__main l-col-12 l-col-sml-8">
			<?php 

				printf( '<a href="%s" class="u-cover-link"></a>', get_permalink() );

				// Title
				the_title( '<h3 class="c-featured-item__title c-section-title">', '</h3>' );

				// Read more
				echo '<a href="' . get_permalink() . '" ' . ' class="c-featured-item__read-more c-read-more">' . __( 'Read more', 'otm' ) . '</a>';
			?>

			<!-- #social-share -->
			<aside class="c-share c-content-block__share" id="social-share">
				<h4 class="c-share__elem c-share__trigger"><span class="u-sr-only">Share</span></h4>
				<!-- FB is share using the Javascript SDK https://developers.facebook.com/docs/sharing/reference/share-dialog#jssdk -->
				<a href="#0" class="c-share__circle--fb c-share__circle c-share--fb" data-url="<?php the_permalink(); ?>"><span class="u-sr-only">Share to Facebook</span></a>

				<!-- Twitter is share using Web Intents https://dev.twitter.com/web/intents  -->
				<a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo urlencode( get_permalink() ); ?>" class="c-share__elem c-share__circle--tw c-share__circle c-share--tw"><span class="u-sr-only">Share to Twitter</span></a>

				<!-- LinkedIn is shared using Web Intents but we have custom JS to open as pop-up -->
				<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink() ); ?>&title=<?php the_title(); ?>&source=SS%26C%20Advent" class="c-share__elem c-share__circle--li c-share__circle c-share--li"><span class="u-sr-only">Share to LinkedIn</span></a>
			</aside>
			<!-- / #social-share -->
		</span>
	</span>
	<!-- <p><a class="share" data-url="<?php the_permalink(); ?>">Share</a></p> -->
</article>