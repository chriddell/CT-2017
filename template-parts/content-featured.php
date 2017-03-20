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
		</span>
	</span>
	<!-- <p><a class="share" data-url="<?php the_permalink(); ?>">Share</a></p> -->
</article>