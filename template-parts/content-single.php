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

?>

<div class="l-hero l-hero--single c-hero c-hero--single" id="hero" style="background-image: url(<?php echo $img['url']; ?>);"></div>

<div class="l-page-content c-page-content u-bg-white u-pos-rel" id="main-content">
	<span class="l-site-wrapper u-pos-rel u-clearfix">
		<article class="l-main l-col-12 l-col-sml-7 l-col-med-8 u-clearfix c-article">
			<?php

				// Title
				the_title( '<h1 class="c-article-title c-section-title">', '</h1>' );

				// Author
				printf( __( '<p>Written by %s</p>', 'otm' ), get_the_author() );

				// Date
				the_date('jS F Y');

				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Continue reading<span class="sr-only"> "%s"</span>', 'otm' ),
					get_the_title()
				) );
			?>
		</article>
		<aside class="l-sidebar c-sidebar l-col-sml-4-last l-col-med-3-last">
			<?php otm_render_related_solutions(); ?>
		</aside>
	</span>
</div>
	
<div class="l-post-page-content">
	<span class="l-site-wrapper u-clearfix">	
		<?php otm_related_posts(); ?>
	</span>
</div>

<?php get_footer();