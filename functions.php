<?php
/**
 * Functions & Definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage OTM
 * @since OTM 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function otm_setup() {

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 51,
		'flex-width'	=> true,
	) );
}
add_action( 'after_setup_theme', 'otm_setup' );

/**
 * Enqueue scripts and styles
 */
function otm_scripts() {

	/* Styles
	 ========================================================================== */
	 wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/style.css' );

	 /* Scripts
	 ========================================================================== */

	 // Enqueue modernizr separately b/c faster
	 wp_enqueue_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', '3.3.1', true );

	 // Enqueue built versions of app and vendor scripts
	 wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/app/built/app.min.js', array( 'jquery' ), '1.0.0', true );
	 wp_enqueue_script( 'lib', get_template_directory_uri() . '/assets/js/lib/built/lib.min.js', '', '1.0.0', true );

	 // Enqueue social SDKs
	 wp_enqueue_script( 'social-twitter', 'https://platform.twitter.com/widgets.js', '', '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'otm_scripts' );

/**
 * Render all tags as a list
 *
 */
function otm_render_global_tags() {

	// Parameters
	$args = array(
		'hide_empty' => false
	);

	$tags = get_tags( $args );

	// If we have tags
	if ( $tags ) :

		// Render title
		printf( '<h3 class="c-section-title">%s</h3>', __( 'Tags', 'otm' ) );

		// Start a list
		echo '<ul class="c-menu c-tag-list">';

		// Render each tag
		foreach ( $tags as $tag ) {
			echo '<li class="c-menu__item c-tag-list__item c-read-more c-content-filter__input js-no-menu-toggle" data-tag="' . $tag->slug . '">' . $tag->name . '</li>';
		}
	endif;
}

/**
 * Get & render related posts
 * based on post_tags
 *
 */
function otm_show_related_posts() {

	global $post;
	$orig_post = $post;
	$tags = wp_get_post_tags($post->ID);

	// If there are tags on the post
	// (in our $tags array)
	if ( $tags ) {

		// For loop to add term ids to array for query
		$tag_ids = array();
		foreach ( $tags as $tag ) $tag_ids[] = $tag->term_id;

		// Arguments for loop
		$args = array(
			'tag__in'						=> $tag_ids,
			'post__not_in'			=> array( $post->ID ),
			'posts_per_page'		=> 5 // no. of posts to display
		);

		// Query posts with our tags
		$my_query = new wp_query( $args );

		// If posts
		if ( $my_query->have_posts() ) :

			// Print a title
			printf( '<h2 class="c-section-title">%s</h2>', __( 'Related content', 'otm' ) );

			// Markup
			echo '<aside id="related" role="complementary" class="c-carousel--related owl-carousel">';
				// Loop
				while ( $my_query->have_posts() ) : $my_query->the_post();

					// Get the template for the post content
					get_template_part( 'template-parts/content-related' );
				endwhile;
			echo '</aside>';

		endif;
	}

	// Reset global $post and query
	$post = $orig_post;
	wp_reset_query();
}

/**
 * Custom Taxonomy:
 * Solutions
 *
 */
function otm_solutions_tax_init() {

	// labels across the admin
	$labels = array(
		'name'              => 'Related Solutions',
		'singular_name'     => 'Solution',
		'search_items'      => 'Search Solutions',
		'all_items'         => 'All Solutions',
		'parent_item'       => 'Parent Solution',
		'parent_item_colon' => 'Parent Solution:',
		'edit_item'         => 'Edit Solution',
		'update_item'       => 'Update Solution',
		'add_new_item'      => 'Add New Solution',
		'new_item_name'     => 'New Solution Name',
		'menu_name'         => 'Solutions'
	);

	// create a new taxonomy
	register_taxonomy(
		'solutions',
		'post',

		// list it's capabilites
		array(

			'labels' => $labels,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => 'solutions' ),
			'capabilities'      => array(
				'manage_terms'  => 'edit_posts', 
				'edit_terms'    => 'edit_posts',
				'delete_terms'  => 'edit_posts',
				'assign_terms'  => 'edit_posts'  // means administrator', 'editor', 'author', 'contributor'
			)
		)
	);
}
add_action( 'init', 'otm_solutions_tax_init' );

/**
 * Show the related solutions (custom taxonomy)
 * of a post
 */
function otm_show_related_solutions() {

	global $post;

	// Get taxonomy terms
	$related_solutions = get_the_terms( $post->ID, 'solutions' );

	if ( $related_solutions ) :

		// Title
		echo '<div class="c-article__meta">';
		echo '<h3 class="c-menu-title">' . __( 'Related Solutions: ', 'otm' ) . '</h3>';
		echo '<ul class="c-menu">';

		// Loop taxonomy terms
		foreach ( $related_solutions as $solution ) {

			// Render
			echo '<li class="c-menu__item">' . '<a href="//' . get_field( 'external_url', $solution ) . '" target="_blank" class="c-read-more">' . $solution->name . '</a>' . '</li>';
		}

		echo '</ul>';
		echo '</div>';
	endif;

	// Reset post
	wp_reset_query();
}

/**
 * Get and set post views
 */
function otm_get_post_views( $postID ) {

	$count_key = 'post_views_count';
	$count = get_post_meta( $postID, $count_key, true );

	if ( $count === '' ) :

		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
		return '0 views';

	endif;

	return $count . ' views';
}
function otm_set_post_views( $postID ) {

	$count_key = 'post_views_count';
	$count = get_post_meta( $postID, $count_key, true );

	if ( $count == '' ) :

		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );

	else :

		$count++;
		update_post_meta( $postID, $count_key, $count );

	endif;
}
// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

/**
 * Show featured posts (based on boolean ACF)
 */
function otm_show_featured_posts() {

	$my_query = new WP_Query( array( 
		'meta_key' 				=> 'is_featured',
		'post_type'				=> 'post',
		'meta_value'			=> true,
		'numberposts' 		=> 3
	) );

	// If our query has posts
	if ( $my_query->have_posts() ) :
		while ( $my_query->have_posts() ) : $my_query->the_post();

			// Get specific template-part
			get_template_part( 'template-parts/content-featured' );

		endwhile;
	endif;

	wp_reset_query();
}

/**
 * Find if there are featured posts
 */
function otm_get_featured_posts() {

	$my_query = new WP_Query( array( 
		'meta_key' 				=> 'is_featured',
		'post_type'				=> 'post',
		'meta_value'			=> true,
		'numberposts' 		=> 3
	) );

	// If our query has posts
	if ( $my_query->have_posts() ) :
		return true;
		wp_reset_query();
	else :
		wp_reset_query();
		return;
	endif;
}
