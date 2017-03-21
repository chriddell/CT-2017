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

	/**
	 * Get the tags of this post.
	 *
	 */
	$tagObjects = wp_get_post_tags($post->ID);
	$tags = 'all ';
	foreach ( $tagObjects as $tag ) {
		$tags = $tags . $tag->slug . ' ';
	}
?>

<?php $img = get_field('featured_image'); ?>

<article class="c-content-block c-content-block--<?php echo $category_slug; ?> l-col-12 u-clearfix filterable" data-tag="<?php echo $tags; ?>">
	<a href="<?php echo get_permalink(); ?>" class="u-cover-link c-content-block__cover-link"></a>

	<span class="l-col-12 l-col-sml-6 c-content-block__side">
		<span class="c-content-block__img" style="background-image: url(<?php echo $img['url'] ?>);"></span>
	</span>

	<span class="l-col-12 l-col-sml-6-last c-content-block__main">
		<?php 

			// Title
			the_title( '<h3 class="c-content-block__title">', '</h3>' ); 

			// Category
			if ( !empty( $categories ) ) : 
				echo '<p class="c-content-block__meta">' . $category_name . '</p>';
			endif;

			// Read more
			echo '<a href="' . get_permalink() . '" ' . ' class="c-read-more c-content-block__read-more">' . __( 'Read more', 'otm' ) . '</a>';
		?>
	</span>

	<aside class="c-share c-content-block__share">
		<span class="c-share__trigger" data-url="<?php the_permalink(); ?>">Share</a>
		<!-- FB is share using the Javascript SDK https://developers.facebook.com/docs/sharing/reference/share-dialog#jssdk -->
		<a href="#0" class="c-share__fb c-share__elem" data-url="<?php the_permalink(); ?>">FB</a>

		<!-- Twitter is share using Web Intents https://dev.twitter.com/web/intents  -->
		<a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo urlencode( get_permalink() ); ?>" class="c-share__tw c-share__elem">TW</a>

		<!-- LinkedIn is shared using Web Intents but we have custom JS to open as pop-up -->
		<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink() ); ?>&title=<?php the_title(); ?>&source=SS%26C%20Advent" class="c-share__li c-share__elem">LI</a>
	</aside>
</article>