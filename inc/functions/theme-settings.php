<?php

if ( ! function_exists( 'doctorpedia_setup' ) ) :
    
    /**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function doctorpedia_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on doctorpedia, use a find and replace
		 * to change 'doctorpedia' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'doctorpedia', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'doctorpedia' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'doctorpedia_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
    }
    
endif;
add_action( 'after_setup_theme', 'doctorpedia_setup' );


function doctorpedia_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'doctorpedia_content_width', 640 );
}
add_action( 'after_setup_theme', 'doctorpedia_content_width', 0 );


function doctorpedia_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'doctorpedia' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'doctorpedia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'doctorpedia_widgets_init' );


// Before VC Init
function vc_before_init_actions() { 
    // Require new custom Element
	require_once( get_template_directory().'/vc-elements/text-block/text-block.php');
	require_once( get_template_directory().'/vc-elements/header-section/header-section-element.php' );
	require_once( get_template_directory().'/vc-elements/doctor-profile/doctor-profile-element.php' );
	require_once( get_template_directory().'/vc-elements/doctor-expert/doctor-expert.php' );
	require_once( get_template_directory().'/vc-elements/featured-articles/featured-articles.php' );
	require_once( get_template_directory().'/vc-elements/post-slider/post-slider-element.php' );
	require_once( get_template_directory().'/vc-elements/interactive-map/interactive-map.php' );
	require_once( get_template_directory().'/vc-elements/featured-faqs/featured-faqs.php' );
	require_once( get_template_directory().'/vc-elements/newsletter/newsletter.php' );
	require_once( get_template_directory().'/vc-elements/sponsor-module/sponsor-module.php' );
	require_once( get_template_directory().'/vc-elements/video-section/video-section-element.php' );
	require_once( get_template_directory().'/vc-elements/video-playlist/video-playlist.php' );
	require_once( get_template_directory().'/vc-elements/video-grid/video-grid.php' );
	require_once( get_template_directory().'/vc-elements/faqs-section/faqs-section.php' );
	require_once( get_template_directory().'/vc-elements/personal-comment/personal-comment.php' );
	require_once( get_template_directory().'/vc-elements/single-image/single-image.php' );
	require_once( get_template_directory().'/vc-elements/separator-hr/separator-hr.php' );
	require_once( get_template_directory().'/vc-elements/utilities-tools/utilities-tools.php' );
	require_once( get_template_directory().'/vc-elements/featured-video/featured-video-element.php');
	require_once( get_template_directory().'/vc-elements/more-info/more-info.php');
	require_once( get_template_directory().'/vc-elements/all-topics/all-topics.php');
	require_once( get_template_directory().'/vc-elements/custom-button/custom-button.php');
	require_once( get_template_directory().'/vc-elements/product-review/product-review.php' );
	require_once( get_template_directory().'/vc-elements/featured-collection/featured-collection.php' );
	require_once( get_template_directory().'/vc-elements/video-popup/video-popup.php' );
	require_once( get_template_directory().'/vc-elements/image-slider/image-slider.php' );
	require_once( get_template_directory().'/vc-elements/image-slider/image-slider-item/image-slider-item.php' );
	require_once( get_template_directory().'/vc-elements/connatix-player/connatix-player.php' );
	require_once( get_template_directory().'/vc-elements/vr-experience-iframe/vr-experience.php' );
	require_once( get_template_directory().'/vc-elements/video-share/video-share.php' );
	require_once( get_template_directory().'/vc-elements/archive-buttons/archive-buttons.php' );
	require_once( get_template_directory().'/vc-elements/ads-section/ads-section.php' );
	require_once( get_template_directory().'/vc-elements/non-profit-map/non-profit-map.php' );
	require_once( get_template_directory().'/vc-elements/non-profit-map/points/non-profit-point.php' );
	require_once( get_template_directory().'/vc-elements/non-profit-map/points/doctors-point.php' );
	require_once( get_template_directory().'/vc-elements/search-resources/search-resources.php' );
	require_once( get_template_directory().'/vc-elements/featured-apps/featured-apps.php');
	require_once( get_template_directory().'/vc-elements/featured-apps/featured-app-item/featured-app-item.php');
	require_once( get_template_directory().'/vc-elements/featured-apps/featured-app-item/featured-app-item-manual.php');
	require_once( get_template_directory().'/vc-elements/virtual-doctors-office/virtual-doctors-office.php');
	require_once( get_template_directory().'/vc-elements/virtual-doctors-office/virtual-doctors-office-item/virtual-doctors-office-item.php');
	require_once( get_template_directory().'/vc-elements/channels/channels.php');
	require_once( get_template_directory().'/vc-elements/channels/channel/singleChannel.php');
	require_once( get_template_directory().'/vc-elements/channels-featured-articles/featured-article.php');
	require_once( get_template_directory().'/vc-elements/channels-highlight-articles/highlight-article.php');
	require_once( get_template_directory().'/vc-elements/channels-highlight-articles/single-article/single-article.php');
	require_once( get_template_directory().'/vc-elements/channels-grid/channels-grid.php');
	require_once( get_template_directory().'/vc-elements/channels-grid/single-article/single-article.php');
	require_once( get_template_directory().'/vc-elements/channels-news/channels-news.php');
	require_once( get_template_directory().'/vc-elements/channels-news/single-article/single-article.php');
	require_once( get_template_directory().'/vc-elements/video-slider-popup/video-slider-popup.php');
	require_once( get_template_directory().'/vc-elements/video-slider-popup/single-video/single-video.php');
	require_once( get_template_directory().'/vc-elements/iframe-module/iframe-module.php');
	require_once( get_template_directory().'/vc-elements/team/team.php');
	require_once( get_template_directory().'/vc-elements/personal-comment/personal-comment-10.php' );
	require_once( get_template_directory().'/vc-elements/blogging-slider/blogging.php' );
	require_once( get_template_directory().'/vc-elements/blogging-slider/single/single.php' );
	require_once( get_template_directory().'/vc-elements/blogging-header/blogging-header.php' );
	require_once( get_template_directory().'/vc-elements/blogging-grid/blogging-grid.php' ); //68
	require_once( get_template_directory().'/vc-elements/blogging-grid/single-article/single-article.php' );
	require_once( get_template_directory().'/vc-elements/blogging-vertical/blogging-vertical.php' );
	require_once( get_template_directory().'/vc-elements/blogging-vertical/single-article/single-article.php' );
	require_once( get_template_directory().'/vc-elements/blogging-profile/profile.php' );
	require_once( get_template_directory().'/vc-elements/blogging-profile/single/single.php' );
	require_once( get_template_directory().'/vc-elements/video-playlist-infinite/video-playlist.php' );
	require_once( get_template_directory().'/vc-elements/video-playlist-infinite/single/single.php' );
	require_once( get_template_directory().'/vc-elements/quote-slider/quote-slider.php' );
	require_once( get_template_directory().'/vc-elements/quote-slider/single/single.php' );

}
add_action( 'vc_before_init', 'vc_before_init_actions' );


function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
   
   
function my_acf_init() {
	acf_update_setting('google_api_key', GMAPS_API_KEY);
}
add_action('acf/init', 'my_acf_init');


register_nav_menus( array(
	'top' 	 => __( 'Top Menu', 'theme_doctorpedia' ),
	'footer' => __( 'footer', 'theme_doctorpedia' ),
) );

// Theme supports thumbnails
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 300, 250 );


/* Error COOKIES */
setcookie(TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN);
if ( SITECOOKIEPATH != COOKIEPATH ) setcookie(TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN);