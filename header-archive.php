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
</head>

<body>

<!-- ###################################### -->
<?php the_field('tracking_codes_body', 'option'); ?>
<!-- ###################################### -->

<!-- Navbar -->
<nav class="secondary-nav">
	<div class="container nav-container multisite-header archives-header">	

		<?php if( getIfHavePosts() ): ?>
			<!-- HAMBURGER MENU -->
			<svg class="hamburger-menu" width="25px" height="18px" viewBox="0 0 25 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
		<?php endif; ?>
			
		<!-- LOGO -->
		<a href="<?php echo esc_url( home_url('/') ); ?> " class="d-none d-sm-block">
			<?php
				$desktop = get_field( 'logo_desktop', 'option' );
				echo wp_get_attachment_image( $desktop['ID'], 'medium', false, [ 'class' => 'logo', 'loading' => false ] );
			?>
		</a>

		<a href="<?php echo esc_url( home_url('/') ); ?>" class="d-block d-md-none">
			<?php
				$desktop = get_field( 'logo_mobile', 'option' );
				echo wp_get_attachment_image( $desktop['ID'], 'medium', false, [ 'class' => 'logo', 'loading' => false ] );
			?>
		</a>

		<?php if( getIfHavePosts() ): ?>
			<div></div>
		<?php endif; ?>

	</div>
</nav>
<!-- End Navbar -->

<!-- SideBar -->

<div class="side-nav">

	<img class="close-btn" src="<?php echo IMAGES; ?>/icons/close.svg" alt="">

	<div class="menu-sidebar-container">

		<?php if ( has_nav_menu( 'sidebar_menu_archive' ) ) : ?>

			<?php wp_nav_menu( array( 'theme_location' => 'sidebar_menu_archive' ) ); ?>

		<?php elseif ( getIfHavePosts() ) : ?>

			<?php $posts = getIfHavePosts(); ?>

			<ul id="primary-menu" class="menu">

				<?php foreach ($posts as $post ) : ?>

					<li id="menu-item-834" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-834"><a href="/<?php echo $post; ?>"><?php echo str_replace( 'pedia', '', get_bloginfo('name') ) . ' ' . ucfirst( $post ); ?></a></li>

				<?php endforeach; ?>

			</ul>

		<?php endif; ?>

	</div>

</div>

<!-- End SideBar -->
