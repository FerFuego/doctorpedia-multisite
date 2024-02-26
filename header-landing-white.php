<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package doctorpedia_theme
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="icon" type="image/png" href="<?php echo IMAGES ?>/favicon.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo IMAGES ?>/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES ?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo IMAGES ?>/favicon-16x16.png">
	<link rel="manifest" href="<?php echo IMAGES ?>/site.webmanifest">
	<link rel="mask-icon" href="<?php echo IMAGES ?>/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<link rel="preload" href="<?php echo FONTS .'/neufile/neufile-grotesk-light.otf'; ?>" as="font" type="font/otf" crossorigin>
    <link rel="preload" href="<?php echo FONTS .'/neufile/neufile-grotesk-regular.otf'; ?>" as="font" type="font/otf" crossorigin>
    <link rel="preload" href="<?php echo FONTS .'/neufile/neufile-grotesk-medium.otf'; ?>" as="font" type="font/otf" crossorigin>
    <link rel="preload" href="<?php echo FONTS .'/neufile/neufile-grotesk-semibold.otf'; ?>" as="font" type="font/otf" crossorigin>
    <link rel="preload" href="<?php echo FONTS .'/visby/visby-medium.otf'; ?>" as="font" type="font/otf" crossorigin>
    <link rel="preload" href="<?php echo FONTS .'/neufile/Neufile-Grotesk-Bold.otf'; ?>" as="font" type="font/otf" crossorigin>
    <link rel="preload" href="<?php echo FONTS .'/neufile/Neufile-Grotesk-Light-Italic.otf'; ?>" as="font" type="font/otf" crossorigin>
    <link rel="preload" href="<?php echo FONTS .'/roboto/Roboto-Regular.ttf'; ?>" as="font" type="font/ttf" crossorigin>
	<?php wp_head(); ?>

	<?php if ( get_query_var('author') ) :
		$author_id = (get_query_var('author') !== 1) ? get_query_var('author') : null;
		$avatar = get_avatar_url(get_the_author_meta('ID', $author_id), '200'); ?>
		<!-- Open Graph data -->
		<meta property="og:title" content="<?php echo get_the_author_meta('display_name', $author_id);?>" />
		<meta property="og:type" content="Doctor Profile" />
		<meta property="og:url" content="<?php echo get_user_permalink( $author_id ); ?>" />
		<meta property="og:image" content="<?php echo $avatar; ?>" />
		<meta property="og:description" content="<?php //echo get_the_author_meta('biography', $author_id); ?>" />
		<meta property="og:site_name" content="Doctorpedia" />
		<meta property="og:price:amount" content="" />
		<meta property="og:price:currency" content="" />
	<?php endif; ?>

	<!-- Marquiz script start --> 
	<script> (function(w, d, s, o){ var j = d.createElement(s); j.async = true; j.src = '//script.marquiz.io/v2.js';j.onload = function() { if (document.readyState !== 'loading') Marquiz.init(o); else document.addEventListener("DOMContentLoaded", function() { Marquiz.init(o); }); }; d.head.insertBefore(j, d.head.firstElementChild); })(window, document, 'script', { host: '//quiz.marquiz.io', region: 'us', id: '60a952196447190026470137', autoOpen: false, autoOpenFreq: 'once', openOnExit: false, disableOnMobile: false } ); </script> 
	<!-- Marquiz script end -->
</head>

<body class="doctor-platform-landing-page">

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WM9VVR4" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header id="masthead" class="site-header" style="<?php echo ( is_page('channels') ) ? 'z-index:2030;': '';?>">
	<div class="container d-flex px-0">
		
		<!-- Site Navigation -->
		<div class="site-navigation" id="site-navigation">

			<!-- Logo -->
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home" class="logo-desktop">
					<?php
						$desktop = get_field( 'logo_desktop', 'option' );
						echo wp_get_attachment_image( $desktop['ID'], 'medium', false, [ 'class' => 'logo', 'loading' => false ] );
					?>
				</a>

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home" class="logo-mobile">
					<?php
						$desktop = get_field( 'logo_mobile', 'option' );
						echo wp_get_attachment_image( $desktop['ID'], 'medium', false, [ 'class' => 'logo', 'loading' => false ] );
					?>
				</a>
			</div>

			<!-- Menu -->
			<div class="main-navigation" style="<?php //echo wp_is_mobile() ? 'display:none' : ''; ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'top_big_menu',
						'menu_id'        => 'top_big_menu',
						'depth' => 1,
					) );
				?>
			</div>

			<!-- CTA Crowdfunding -->
			<div class="secondary-navigation">
				<a href="/doctor-platform-landing-page/" class="btn btn-header full-width"> Are you a Doctor? <img src="<?php echo IMAGES .'/modules/webcast/single-right-arrow-white.svg'; ?>"></a>
			</div>

		</div><!-- #site-navigation -->

		<!-- Hamburger Mobile -->
		<div class="hamburger-button" id="js-hamburger-button">
			<div></div>
			<div></div>
			<div></div>
		</div>
		
	</div>
	
</header><!-- #masthead -->

<div class="<?php echo	class_body_content(); ?>">