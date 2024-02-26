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
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo IMAGES ?>/apple-touch-icon.png">
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
</head>

<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WM9VVR4" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Navbar -->
<nav class="secondary-nav">
	<div class="container">
		<!-- HAMBURGER MENU -->
		<svg class="hamburger-menu" width="25px" height="18px" viewBox="0 0 25 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
			<g id="Navigation" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				<g id="hamburger-icon" transform="translate(-143.000000, -36.000000)" fill="#FFFFFF">
					<g id="Top-Nav-Bar" transform="translate(0.000000, 1.000000)">
						<g id="Group" transform="translate(143.000000, 35.000000)">
							<path d="M0,16 L25,16 L25,18 L0,18 L0,16 Z M0,8 L25,8 L25,10 L0,10 L0,8 Z M0,0 L25,0 L25,2 L0,2 L0,0 Z" id="Combined-Shape"></path>
						</g>
					</g>
				</g>
			</g>
		</svg>

		<img class="close-btn" src="<?php echo IMAGES; ?>/icons/close.svg" alt="">

		<!-- LOGO -->
		<a href="<?php echo esc_url( home_url('/') ); ?> " class="d-none d-sm-block nav-logo">
			<?php
				$desktop = get_field( 'logo_desktop', 'option' );
				echo wp_get_attachment_image( $desktop['ID'], 'medium', false, [ 'class' => 'logo', 'loading' => false ] );
			?>
		</a>
		<!-- End LOGO -->
		
		<a href="<?php echo esc_url( home_url('/') ); ?>" class="d-block d-md-none">
			<?php
				$desktop = get_field( 'logo_mobile', 'option' );
				echo wp_get_attachment_image( $desktop['ID'], 'medium', false, [ 'class' => 'logo', 'loading' => false ] );
			?>
		</a>

		<!-- SEARCH -->
		<svg class="search-icon  open-search" onclick="window.location.replace('<?php echo esc_url(home_url('/'))?>search')" width="31px" height="32px" viewBox="0 0 31 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round">
				<g id="Magnify" transform="translate(-1272.000000, -24.000000)" stroke="#FFFFFF" stroke-width="2">
					<g id="Maginfigying-Glass" transform="translate(1225.000000, 11.000000)">
						<circle id="Oval-2" cx="65" cy="26" r="12"></circle>
						<path d="M56.25,35.75 L48.6014707,43.3985293" id="Glass" fill="#D8D8D8"></path>
					</g>
				</g>
			</g>
		</svg>
	</div>
</nav>
<!-- End Navbar -->

<!-- SideBar -->
<div class="side-nav">

	<img class="close-btn" src="<?php echo IMAGES; ?>/icons/close.svg" alt="">

	<?php
		wp_nav_menu( array(
			'theme_location' => 'menu-1',
			'menu_id'        => 'primary-menu',
		) );
	?>

	<div class="newsletter-nav text-center">
		<img src="<?php the_field('sidebar__icon','option'); ?>" alt="Doctorpedia">
		<h1><?php the_field('sidebar__title', 'option'); ?></h1>
		<p><?php the_field('sidebar__copy'); ?></p>
		<form action="https://facebook.us7.list-manage.com/subscribe/post?u=dffeeb9ac807dbf92acb9be32&amp;id=6469b5c270" method="post" class="validate" target="_blank" name="header_secoundary" novalidate>
			<input type="email" value="" name="EMAIL" class="email mce_EMAIL" id="mce-EMAIL" placeholder="Email Address" required>
			<input type="hidden" name="b_dffeeb9ac807dbf92acb9be32_6469b5c270" tabindex="-1" value="">
			<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" onclick="ValidateNewsletterEmail(document.header_secoundary.EMAIL)" class="btn button">
		</form>
	</div>
</div>
<!-- End SideBar -->