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
function otm_enqueue_scripts() {

	/* Styles
	 ========================================================================== */
	 wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/style.css' );

	/* Scripts
	========================================================================== */

	// Enqueue modernizr separately b/c faster
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/lib/modernizr-custom-3.5.0.min.js', '3.5.0', true );

	// Enqueue built versions of app and vendor scripts
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/app/built/app.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'lib', get_template_directory_uri() . '/assets/js/lib/built/lib.min.js', '', '1.0.0', true );

	// Enqueue Load More (ajax)
	wp_enqueue_script( 'ajax-load-more', get_template_directory_uri() . '/assets/js/app/ajax-load-more.js', array( 'jquery' ), '1.0.0', true );

	// Enqueue social SDKs
	wp_enqueue_script( 'social-twitter', 'https://platform.twitter.com/widgets.js', '', '1.0.0', true );

	// Localize AJAX
	wp_localize_script( 'ajax-load-more', 'wp_ajax', array(
		'url'         => admin_url( 'admin-ajax.php' )
	));
}
add_action( 'wp_enqueue_scripts', 'otm_enqueue_scripts' );

/**
 * Render all tags as a list
 *
 */
function otm_render_global_tags() {

	$tags = get_tags();

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
			'posts_per_page'		=> 5, // no. of posts to display
			'orderby'						=> 'rand'
		);

		// Query posts with our tags
		$my_query = new wp_query( $args );

		// If posts
		if ( $my_query->have_posts() ) :

			echo '<div class="l-post-page-content">';
				echo '<span class="l-wrapper u-clearfix">';

					// Print a title
					printf( '<h2 class="c-section-title">%s</h2>', __( 'Related content', 'otm' ) );

					// Markup
					echo '<aside id="related" role="complementary" class="c-carousel--related owl-carousel">';
						// Loop
						while ( $my_query->have_posts() ) : $my_query->the_post();

							// Get the template for the post content
							get_template_part( 'template-parts/post/content-related' );

						endwhile;
					echo '</aside>';
					
				echo '</span>';
			echo '</div>';

		endif;
	}

	// Reset global $post and query
	$post = $orig_post;
	wp_reset_query();
}

/**
 * Custom post-type:
 * Case Study
 *
 */
function otm_targeted_case_study_init() {

	// labels across the admin
	$labels = array(

		'name'              => 'Case Studies',
		'singular_name'     => 'Case Study',
		'search_items'      => 'Search Case Studies',
		'all_items'         => 'All Case Studies',
		'parent_item'       => 'Parent Case Study',
		'parent_item_colon' => 'Parent Case Study:',
		'edit_item'         => 'Edit Case Study',
		'update_item'       => 'Update Case Study',
		'add_new_item'      => 'Add New Case Study',
		'new_item_name'     => 'New Case Study',
		'menu_name'         => 'Case Studies'
	);

	register_post_type( 'targeted-case-study',

		array(

			'labels' 				=> $labels,
			'public'        => true,
			'has_archive'   => false,
			'menu_icon'     => 'dashicons-media-text',
			'rewrite'				=> array( 'slug' => 'case-study', 'with_front' => false )
		)
	);
}
add_action( 'init', 'otm_targeted_case_study_init' );

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

	delete_post_meta( $postID, $count_key );

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
			get_template_part( 'template-parts/post/content-featured' );

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

/**
 * Return posts to AJAX request
 */
function otm_ajax_return_posts() {

  // Get requested tag and page
  // from AJAX request data
  $tag    = $_GET['tag']; 			// requested taxonomy term provided by AJAX
  $page   = (int)$_GET['page']; // offset provided by AJAX

  /**
   * Set up arguments for WP_Query
   * based on whether we need to return
   * all posts, or posts with a specific
   * tag
   *
   */
  if ( $tag !== 'all' ) {

    // Arguments for WP_Query
    $args = array(
    	'post_type'				=> 'post',
    	'post_status'			=> 'publish',
      'tag'             => $tag, // requested taxonomy term provided by AJAX
      'posts_per_page'  => 5,
      'paged'						=> $page // offset provided by AJAX
    );
  }

  // Else we want all posts
  else {

    // Arguments for WP_Query
    $args = array(
    	'post_type'				=> 'post',
    	'post_status'			=> 'publish',
      'posts_per_page'  => 5,
      'paged'						=> $page // offset provided by AJAX
    );
  }

  // Set up our query with $args
  $my_query = new WP_Query( $args );

  // If no posts
  if ( ! $my_query->have_posts() ) {

  	echo json_encode( array( 'postcount' => 0 ) );

  	// End
    die();
  }

  // If posts
  else {

  	// index
  	$i = 0;

  	// Empty string to hold markup
  	$all_posts_markup = '';

  	// Start the loop
    while ( $my_query->have_posts() ) {

    	// increment index
    	$i++;

    	// Set up postdata
    	$my_query->the_post();

    	// store markup for post in var
    	$post_markup = load_template_part( 'template-parts/post/content' );

    	// add markup for this post to all_post_markup
      $all_posts_markup = $all_posts_markup . ' ' . $post_markup;
    }

    echo json_encode( array( 'postcount' => $i, 'html' => $all_posts_markup ) );
  }

  die();
}
add_action( 'wp_ajax_nopriv_otm_ajax_return_posts', 'otm_ajax_return_posts' );
add_action( 'wp_ajax_otm_ajax_return_posts', 'otm_ajax_return_posts' );

/**
 * Load Template Part
 * from: http://stackoverflow.com/questions/5817726/wordpress-save-get-template-part-to-variable
 * 
 * Loads a template-part (similar to
 * get_template_part), however it doesn't
 * automatically print the result. Means we can
 * store returned content to variable
 */
function load_template_part( $template_name, $part_name=null ) {

	ob_start();
	get_template_part($template_name, $part_name);
	$var = ob_get_contents();
	ob_end_clean();
	return $var;
}

/**
 * Use ACF field as og:image
 * Overwrites Yoast SEO.
 */
function otm_custom_og_image() {

	global $post;

	$og_img = get_field( 'featured_image', $post );

	if ( is_single() ) {
		echo '<meta property="og:image" content="' . $og_img['url'] . '"/>';
	}

	else {
		return;
	}
}
add_action( 'wp_head', 'otm_custom_og_image', 5 );

/**
 * ACF Admin style hacks
 */
function otm_custom_admin_css() {
	echo '<style>
		.acf_postbox .field_type-message p.label {
			display: block !important;
		}

		.acf_postbox .field textarea {
			min-height: 0;
		}
	</style>';
}
add_action( 'admin_head', 'otm_custom_admin_css' );
