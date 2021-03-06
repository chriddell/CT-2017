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

<?php 
$img = get_field('featured_image'); ?>

<article class="c-content-block c-content-block--<?php echo $category_slug; ?> c-content-block--related c-read-more__parent l-col-12 l-col-med-8 u-clearfix filterable" data-tag="<?php echo $tags; ?>">

	<?php
		// Use custom URL if post_category is 'campaigns'
		if ( $category_slug == 'campaigns' ) {
			printf( '<a href="%s" class="u-cover-link c-content-block__cover-link" target="_blank"></a>', get_field( 'campaign_url' ) );
		}

		else {
			printf( '<a href="%s" class="u-cover-link c-content-block__cover-link"></a>', get_permalink() );
		}
	?>

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