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
?>

<?php $img = get_field('featured_image'); ?>

<article class="c-content-block c-content-block--<?php echo $category_slug; ?> l-col-12 u-clearfix">
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

	<!-- <p><a class="share" data-url="<?php the_permalink(); ?>">Share</a></p> -->
</article>