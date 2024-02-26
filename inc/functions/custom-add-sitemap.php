<?php

add_filter('wpseo_sitemap_index', 'add_sitemap_custom_items');

function add_sitemap_custom_items($sitemap_custom_items)
{
    /** Patient journey xmls */
    $sitemap_custom_items .= '
        <sitemap>
            <loc>' . get_site_url() . '/patient-journey/sitemap.xml</loc>
            <lastmod>' . date('c') . '</lastmod>
        </sitemap>';

    return $sitemap_custom_items;
}
