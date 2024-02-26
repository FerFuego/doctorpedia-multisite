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
	<!-- ###################################### -->
	<?php the_field('tracking_codes', 'option'); ?>
	<!-- ###################################### -->
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

<body class="doctor-platform-landing-page">

<!-- ###################################### -->
<?php the_field('tracking_codes_body', 'option'); ?>
<!-- ###################################### -->

<header id="masthead" class="site-header" style="<?php echo ( is_page('channels') ) ? 'z-index:2030;': '';?> <?php echo ( is_page_template('page_templates/affiliate_page.php') ) ? 'background-color: transparent;': '';?>">
	<div class="container d-flex px-0 <?php echo ( is_page_template('page_templates/landing_page.php') ) ? 'custom-landing-menu': '';?>">
		
		<!-- Site Navigation -->
		<div class="site-navigation" id="site-navigation">

			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home" class="logo-desktop">
					<?php
						$desktop = get_field( 'logo_desktop', 'option' );
						echo wp_get_attachment_image( $desktop['ID'], 'medium', false, [ 'class' => 'logo', 'loading' => false ] );
					?>
				</a>

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home" class="logo-mobile">
					<?php
						$mobile = get_field( 'logo_mobile', 'option' );
						echo wp_get_attachment_image( $mobile['ID'], 'medium', false, [ 'class' => 'logo', 'loading' => false ] );
					?>
                </a>

			</div><!-- .site-branding -->
			
			<div class="secondary-navigation aling-navigation-landing">
                <a href="<?php echo esc_url( home_url('/platform-login')); ?>" class="btn-header-landing"> Log In </a>
				<a href="<?php echo esc_url(home_url('/platform-register')); ?>" class="btn btn-header full-width"> Build Your Profile <img src="<?php echo IMAGES .'/modules/webcast/single-right-arrow-white.svg'; ?>" alt></a>
			</div>

		</div><!-- #site-navigation -->

</header><!-- #masthead -->

<div class="large-container">
	