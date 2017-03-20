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

<footer class="l-footer c-site-footer" id="footer" role="footer">
	<div class="l-site-wrapper">
		<p class="c-site-footer__legal u-float-left">SS&amp;C Advent &copy; <?php echo get_the_date('Y'); ?></p>
		<span class="c-site-logo c-site-logo--white c-site-footer__logo u-float-right"></span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>