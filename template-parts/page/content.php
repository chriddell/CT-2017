<?php
/**
 * The template for displaying page content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage OTM
 * @since 1.0
 * @version 1.0
 */
?>

<?php 
$img = get_field('featured_image'); ?>

<div class="l-hero l-hero--single c-hero c-hero--single" id="hero" style="background-image: url( <?php echo $img['url'] ?> );"></div>

<div class="l-page-content c-page-content u-bg-white u-pos-rel" id="main-content">
	<span class="l-wrapper u-pos-rel u-clearfix">
		<article class="l-main l-col-12 l-col-sml-8 l-col-med-9 u-clearfix c-article">

			<header class="c-article__header">
				<?php
				the_title( '<h1 class="c-article-title c-section-title c-article__title">', '</h1>' ); ?>
			</header>

			<?php
			/* Loop ACF repeater */
			if ( have_rows( 'acf_repeater_block' ) ) : ?>

				<div class="c-article__main c-wyswiyg-content u-clearfix u-no-borders">

					<?php
					while ( have_rows( 'acf_repeater_block' ) ) : the_row(); 

						// ACF
						$repeater_image 	= get_sub_field( 'acf_repeater_block_image' ); ?>

						<section class="c-repeater-block l-col-12">

							<?php
							/* If has image */
							if ( !empty( $repeater_image ) ) : ?>

								<span class="c-repeater-block__main l-col-12 l-col-med-6">

							<?php endif; ?>

							<h2 class="c-repeater-block__title"><?php the_sub_field( 'acf_repeater_block_heading' ); ?></h2>
							<span class="c-wysiwyg-content c-repeater-block__body u-block">
								<?php the_sub_field( 'acf_repeater_block_main' ); ?>
							</span>

							<?php
							/* If has button/link */
							if ( !empty( get_sub_field( 'acf_repeater_block_button_url' ) ) ) : ?>

								<a class="c-repeater-block__button c-btn c-read-more c-read-more--smaller"  href="<?php the_sub_field( 'acf_repeater_block_button_url' ); ?>" target="_blank"><?php the_sub_field( 'acf_repeater_block_button_text' ); ?></a>

							<?php endif; ?>

							<?php
							/* If has image */
							if ( !empty( $repeater_image ) ) : ?>

								</span><!-- / .l-col-6 -->

								<span class="l-col-12 l-col-med-6-last">
									<img class="c-repeater-block__image" src="<?php echo $repeater_image['url']; ?>"/>
								</span>

							<?php endif; ?>

						</section>

					<?php
					endwhile;
			else : ?>

				<div class="c-article__main c-wyswiyg-content u-clearfix">
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading<span class="sr-only"> "%s"</span>', 'otm' ),
						get_the_title()
					) );
				?>

			<?php
			endif; ?>
			</div>

		</article>

		<aside class="l-sidebar l-sidebar--article c-sidebar c-article__sidebar l-col-sml-4-last l-col-med-3-last">
			<div class="c-share c-article__share" id="social-share">
				<h4 class="c-aside-title">Share: </h4>
				<a href="#0" class="c-share__elem c-share__square c-share__square--fb c-share--fb" data-url="<?php the_permalink(); ?>"><span class="u-sr-only">Share to Facebook</span></a>
				<a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo urlencode( get_permalink() ); ?>" class="c-share__elem c-share__square c-share__square--tw c-share--tw"><span class="u-sr-only">Share to Twitter</span></a>
				<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink() ); ?>&title=<?php the_title(); ?>&source=SS%26C%20Advent" class="c-share__elem c-share__square c-share__square--li c-share--li"><span class="u-sr-only">Share to LinkedIn</span></a>
			</div><!-- / #social-share -->
		</aside><!-- / .l-sidebar -->

	</span><!-- / .l-wrapper -->
</div><!-- / #main-content -->