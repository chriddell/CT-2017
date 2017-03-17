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

<article>
	<?php 

		// Featured Image (ACF)
		$img = get_field('featured_image');
		echo '<img src="' . $img['url'] . '" width="250"/>';

		// Title
		the_title( '<h3>', '</h3>' ); 

		// Category
		$categories = get_the_category();
		if ( !empty( $categories ) ) : 
			/**
			 * Return first category in array of all
			 * categories. There should be only one
			 * returned anyway b/c we're using radio
			 * buttons for category selection in admin
			 */
			echo esc_html( $categories[0]->name );
		endif;

		// Read more
		echo '<p><a href="' . get_permalink() . '">' . __( 'Read more', 'otm' ) . '</a></p>';
	?>

	<p><a class="share" data-url="<?php the_permalink(); ?>">Share</a></p>
</article>