<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="main-content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage OTM
 * @since 1.0
 * @version 1.0
 */

?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<a class="skip-link u-sr-only" href="#main-content"><?php _e( 'Skip to content', 'otm' ); ?></a>

	<header role="banner" class="c-site-header">
		<div class="l-site-wrapper">
			<h1 class="c-site-title c-site-header__title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?>	</a>
			</h1>

			<span class="c-site-logo c-site-header__logo">
				<h2 class="u-sr-only">SS&amp;C Advent</h2>
			</span>
		</div>
	</header>

	<div id="main-content">