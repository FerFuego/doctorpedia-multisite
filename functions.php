<?php

/**
 * doctorpedia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package doctorpedia
 */

/*------------------------------------*\
        Custom Global Variables
\*------------------------------------*/

define('TEMPPATH', get_bloginfo('stylesheet_directory'));
define('IMAGES', TEMPPATH . "/img");
define('VIDEOS', TEMPPATH . "/videos");
define('RESOURCES', TEMPPATH . "/resources");
define('CONTACT', TEMPPATH . "/contactform");
define('JSON', TEMPPATH . '/json');
define('FONTS', TEMPPATH . "/fonts");
define('PHP', TEMPPATH . "/php");
define('CSS', TEMPPATH . "/css");
define('LIB', TEMPPATH . "/lib");
define('JS', TEMPPATH . "/js");
define('GMAPS_API_KEY', 'AIzaSyAb9BnTXMbH-Eg7s_5dMPe9IqELKVUyMoQ');

/*------------------------------------*\
        Mothership Theme Settings
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/theme-settings.php');

/*------------------------------------*\
             Custom Scripts
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/enqueue-scripts.php');

/*------------------------------------*\
    Custom Taxonomies Filter WP Dash
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/custom-taxonomy-filter-wordpress-dashboard.php');

/*------------------------------------*\
            Custom Post Type
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/custom-post-types.php');

/*------------------------------------*\
            Custom Taxonomies
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/custom-taxonomies.php');

/*------------------------------------*\
               Filters
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/custom-filters.php');

/*------------------------------------*\
            Doctor Directory
\*------------------------------------*/

require_once(__DIR__ . '/inc/doctor-directory/functions.php');

/*------------------------------------*\
        Custom Functions
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/custom-functions.php');

/*------------------------------------*\
        Custom Functions Taxonomies
\*------------------------------------*/

require_once(__DIR__ . '/template-parts/taxonomies/custom-taxonomy-functions.php');

/*------------------------------------*\
        Custom ACF Forms
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/custom-acf-forms.php');

/*------------------------------------*\
        Discover Health
\*------------------------------------*/

//require_once(__DIR__ . '/inc/discover-health/custom-functions.php');

/*------------------------------------*\
        Channels Register Sidebar
\*------------------------------------*/

require_once(__DIR__ . '/inc/categories/register-widget.php');

/*------------------------------------*\
        Channels Register Shortcode
\*------------------------------------*/

require_once(__DIR__ . '/inc/categories/custom-shortcode.php');

/*------------------------------------*\
        Channels Register Page
\*------------------------------------*/

require_once(__DIR__ . '/inc/categories/register-page.php');

/*------------------------------------*\
        Add ACF to Admin Columns
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/add-acf-to-admin-columns.php');

/*------------------------------------*\
        Shortcodes
\*------------------------------------*/

require_once(__DIR__ . '/inc/shortcodes/get-sites.php');


/*------------------------------------*\
                Author
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/custom-author.php');


/*------------------------------------*\
           Sites to Select
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/custom-add-sites-to-select.php');

/*------------------------------------*\
        Public Profile Functions
\*------------------------------------*/

require_once(__DIR__ . '/template-parts/authors/functions/profile-functions.php');

/*------------------------------------*\
        Big Menu Functions
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/class-big-menu.php');

/*------------------------------------*\
        Register Roles
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/register-roles.php');

/*------------------------------------*\
        Custom Wysiwyg Editor
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/custom-wysiwyg-editor.php');

/*------------------------------------*\
        Image Compression
\*------------------------------------*/

add_filter('jpeg_quality', function ($arg) {
        return 75;
});
add_filter('jpg_quality', function ($arg) {
        return 75;
});
add_filter('png_quality', function ($arg) {
        return 75;
});
add_filter('wp_editor_set_quality', function ($arg) {
        return 75;
});
add_filter('show_admin_bar', '__return_false');

/*------------------------------------*\
        SMTP Configuration
\*------------------------------------*/

require_once(__DIR__ . '/inc/functions/smtp-config.php');

/*------------------------------------*\
        Hacks to fix performance
\*------------------------------------*/
/** Stop heartbeat (disables admin-ajax.php autosave) */

add_action('init', 'stop_heartbeat', 1);
function stop_heartbeat()
{
        wp_deregister_script('heartbeat');
}


/**
 * Disable updates
 */
add_filter('pre_site_transient_update_core', 'remove_core_updates');
add_filter('pre_site_transient_update_plugins', 'remove_core_updates');
add_filter('pre_site_transient_update_themes', 'remove_core_updates');
function remove_core_updates()
{
        global $wp_version;
        return (object) array('last_checked' => time(), 'version_checked' => $wp_version);
}


/**
 * Disable all https request of update check
 */
add_filter('http_request_args', 'wpse_102554_deny_plugin_updates', 5, 2);
function wpse_102554_deny_plugin_updates($r, $url)
{
        if (0 !== strpos($url, 'https://api.wordpress.org/plugins/update-check')) {
                return $r;
        }
        $plugins = @unserialize($r['body']['plugins']);
        if ($plugins) {
                unset(
                        $plugins->plugins[plugin_basename(__FILE__)],
                        $plugins->active[array_search(plugin_basename(__FILE__), $plugins->active)]
                );
        }
        $r['body']['plugins'] = serialize($plugins);
        return $r;
}

/*------------------------------------*\
                API
\*------------------------------------*/

require_once( __DIR__ . '/inc/api/load-more-public-profile.php');

require_once( __DIR__ . '/inc/api/channels-taxonomy.php');

require_once( __DIR__ . '/inc/api/search-hero.php');

/*------------------------------------*\
  Adds patient-journey seo to main xml
\*------------------------------------*/
require_once( __DIR__ . '/inc/functions/custom-add-sitemap.php');

/*------------------------------------*\
  SVG Importer
\*------------------------------------*/
require_once( __DIR__ . '/inc/functions/get-svg.php');

/*------------------------------------*\
  Vimeo Stats class
\*------------------------------------*/
require_once( __DIR__ . '/inc/functions/vimeo-stats.php');

require_once(__DIR__ . '/inc/functions/custom-taxonomy-acf.php');