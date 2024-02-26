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

	<?php if ( $a = get_query_var('author') ) :
		$author_id = ($a !== 1) ? $a : null;
		$avatar = get_avatar_url($author_id, '200'); ?>
		<!-- Open Graph data -->
		<meta property="og:title" content="<?php echo get_the_author_meta('display_name', $author_id);?>" />
		<meta property="og:type" content="Doctor Profile" />
		<meta property="og:url" content="<?php echo get_user_permalink( $author_id ); ?>" />
		<meta property="og:image" content="<?php echo $avatar; ?>" />
		<meta property="og:description" content="" />
		<meta property="og:site_name" content="Doctorpedia" />
		<meta property="og:price:amount" content="" />
		<meta property="og:price:currency" content="" />
	<?php endif; ?>

	<!-- ###################################### -->
	<?php echo get_field('tracking_codes', 'option'); ?>
	<!-- ###################################### -->
</head>

<body class="homepage">
	<!-- ###################################### -->
	<?php echo get_field('tracking_codes_body', 'option'); ?>
	<!-- ###################################### -->

	<!-- Navbar -->
	<nav>
		<div class="container nav-container">

			<!-- HAMBURGER MENU -->
			<div class="hamburger-menu-container">
				<svg class="hamburger-menu" width="25px" height="18px" viewBox="0 0 25 18" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
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
			</div>

			<img class="close-btn" src="<?php echo IMAGES; ?>/icons/close.svg" alt="">

			<!-- LOGO -->
			<a href="<?php echo esc_url( home_url('/') ); ?> " class="d-none d-sm-block nav-logo">
				<?php
					$desktop = get_field( 'logo_desktop', 'option' );
					echo wp_get_attachment_image( $desktop['ID'], 'medium', false, [ 'class' => 'logo', 'loading' => false ] );
				?>
			</a>
			<!-- End LOGO -->

			<a href="<?php echo esc_url( home_url('/') ); ?> " class="d-block d-md-none">
				<?php
					$desktop = get_field( 'logo_mobile', 'option' );
					echo wp_get_attachment_image( $desktop['ID'], 'medium', false, [ 'class' => 'logo', 'loading' => false ] );
				?>
			</a>

			<!-- WIDGET ARES-->
			<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Slider Categories')): ?>

				<div class="search-button">
					<svg class="search-icon  open-search" onclick="window.location.replace('<?php echo esc_url(home_url('/'))?>search')" width="31px" height="32px" viewBox="0 0 31 32" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
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

			<?php endif; ?>

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
			<!-- Begin Mailchimp Signup Form -->
			<form action="https://doctorpedia.us20.list-manage.com/subscribe/post?u=f85fcca7f131032b9d3ae6e08&amp;id=bfb910e08a" method="post" class="validate" target="_blank" name="header" novalidate>
				<input type="email" value="" name="EMAIL" class="email mce_EMAIL" id="mce-EMAIL" placeholder="Email Address" required>
				<input type="hidden" name="b_f85fcca7f131032b9d3ae6e08_bfb910e08a" tabindex="-1" value="">
				<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" onclick="ValidateNewsletterEmail(document.header.EMAIL)" class="btn button">
			</form>
			<!--End mc_embed_signup-->
		</div>
	</div>
	<!-- End SideBar -->

	<div class="large-container">
	