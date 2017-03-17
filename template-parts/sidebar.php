<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage OTM
 * @since 1.0
 * @version 1.0
 */
?>

<aside role="complementary">
	<div id="related">
		<?php

		/**
		 * Get 'Most Popular' posts based on
		 * meta_value
		 */

		// Set up our query
		$my_query = new WP_Query( array( 
			'meta_key' 				=> 'post_views_count',
			'orderby'					=> 'meta_value',
			'posts_per_page' 	=> 5
		) );

		// If our query has posts
		if ( $my_query->have_posts() ) :

			// Section Title
			printf( '<h2>%s</h2>', __('Most popular', 'otm' ) );

			while ( $my_query->have_posts() ) : $my_query->the_post(); 

				// Title
				the_title('<h3>', '</h3>');

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

				// Views (for dev purposes)
				echo '<p>' . otm_get_post_views( get_the_ID() ) . '</p>';

			endwhile;
		endif;

		?>
	</div>

	<?php otm_render_global_tags(); ?>
	
</aside>
