<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage OTM
 * @since 1.0
 * @version 1.0
 */
?>

<footer class="l-footer c-site-footer" id="site-footer" role="footer">
	<div class="c-site-footer__section c-dual-footer">
		<div class="l-wrapper u-clearfix">
			<a class="c-block-link c-dual-footer__link c-read-more__parent l-col-12 l-col-sml-4 l-col-med-4 u-no-hover" href="http://investmentmanagement.tech/">
				<h4 class="c-block-link__title c-dual-footer__link-title c-read-more">Investment Management</h4>
				<p class="c-block-link__copy c-dual-footer__link-copy">Our solutions and services</p>
			</a>
			<a class="c-block-link c-dual-footer__link c-read-more__parent l-col-12 l-col-sml-4 l-col-med-4 u-no-hover" href="<?php echo site_url('/'); ?>">
				<h4 class="c-block-link__title c-dual-footer__link-title c-read-more">Capital Trends</h4>
				<p class="c-block-link__copy c-dual-footer__link-copy">Industry insights</p>
			</a>
			<span class="l-col-12 l-col-sml-4-last l-col-med-3-last">
				<span class="c-site-logo c-site-logo--white c-site-footer__logo u-float-right"></span>
			</span>
		</div>
	</div>
	<div class="c-site-footer__section c-legal-footer">
		<div class="l-wrapper">
			<p class="c-legal-footer__copy">SS&amp;C Advent &copy; <?php echo get_the_date('Y'); ?></p>
		</div>
	</div>
</footer>

<a class="c-back-to-top" href="#top">
	<span class="u-abs-centered">
		<span class="c-back-to-top__icon">&laquo;</span>
		<span class="c-back-to-top__text">Top</span>
	</span>
</a>

<?php wp_footer(); ?>
</body>
</html>