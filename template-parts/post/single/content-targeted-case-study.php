<?php
/**
 * Template part for displaying single posts
 * of the post-type 'targeted-case-study'
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage OTM
 * @since 1.0
 * @version 1.0
 */

$img = get_field( 'featured_image' );

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

<div class="l-hero l-hero--single c-hero c-hero--single" id="hero" style="background-image: url(<?php echo $img['url']; ?>);">
	<div class="l-wrapper u-pos-rel u-clearfix">
		<h1 class="c-hero__title u-normal-weight"><?php the_field( 'acf_title' ); ?></h1>
		<h2 class="c-hero__subtitle u-normal-weight"><?php the_field( 'acf_sub_title' ); ?></h2>
	</div>
</div>

<div class="l-page-content c-page-content u-bg-white u-pos-rel" id="main-content">
	<span class="l-wrapper u-pos-rel u-clearfix">
		<article class="l-main l-col-12 l-col-sml-8 l-col-med-9 u-clearfix c-article">

			<div class="c-article__main c-wyswiyg-content u-clearfix">
				<p class="c-title c-case-study-title u-bold"><?php the_field( 'acf_case-study_title' ); ?></p>
				<?php
					if ( have_rows( 'acf_bullet_table_repeater' ) ) : ?>

					<ul class="c-tick-list">
						<h2 class="u-normal-weight"><?php the_field( 'acf_bullet_table_intro_text' ); ?></h2>
						<?php
							while ( have_rows( 'acf_bullet_table_repeater' ) ) : the_row(); ?>
								<li class="c-tick-list__item u-pos-rel"><?php the_sub_field( 'acf_bullet_table_bullet' ); ?></li>
						<?php 
							endwhile; ?>
					</ul>
						<p class="c-tick-list__footer u-bold"><?php the_field( 'acf_bullets_date' ); ?></p>
				<?php
					endif; ?>

				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading<span class="sr-only"> "%s"</span>', 'otm' ),
						get_the_title()
					) ); ?>
			</div>

			<?php
				/**
				 * Embed Marketo form using ACF value
				 * and <script>, <form> tags exported
				 * from Marketo.
				 */
				if ( get_field( 'acf_mkto_form_id' ) ) : ?>

					<aside class="c-article__in-page-form">
						<p>Please enter your details for access to this detailed case study.</p>
						<script src="//app-ab17.marketo.com/js/forms2/js/forms2.min.js"></script>
						<form id="mktoForm_<?php the_field( 'acf_mkto_form_id' ); ?>" class="u-marketo c-form c-form--marketo c-form--in-page u-marketo"></form>
						<script>MktoForms2.loadForm("//app-ab17.marketo.com", "694-KCV-926", <?php the_field( 'acf_mkto_form_id' ); ?>);</script>
					</aside>

			<?php 
				endif; ?>
		</article>
	</span>
</div>

<?php get_template_part( 'template-parts/pre-footer' ); ?>

<?php get_footer();