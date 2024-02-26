<?php

/*------------------------------------*\
            Custom Post Type
\*------------------------------------*/
function create_post_type() {
    
    // Video Play
	register_post_type( 'video_play',
        array(
            'labels' => array(
            'name' => __( 'Video Playback' ),
            'singular_name' => __( 'Video Playback' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'thumbnail', 'title', 'editor', 'author'),
            'taxonomies' => array( 'category' ),
            'menu_icon'   => 'dashicons-format-video'
        )
	);
    
    // Faqs type
	register_post_type( 'faqs_type',
        array(
            'labels' => array(
                'name' => __( 'Faqs' ),
                'singular_name' => __( 'Faqs' )
            ),
            'public' => true,
            'has_archive' => false,
            'show_in_nav_menus' => false,
            'publicly_queryable'  => false, // disable single and archive and search
            'exclude_from_search' => true,
            'menu_icon' => 'dashicons-format-status'
        )
	);

    // VL category
	register_post_type( 'video-library',
        array(
            'labels' => array(
                'name' => __( 'Video Library' ),
                'singular_name' => __( 'Video Library' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'thumbnail', 'title', 'editor', 'author'),
            'taxonomies' => array( 'video-library-category' ),
            'menu_icon'   => 'dashicons-playlist-video'
        )
    );
    
    // Video
    register_post_type( 'videos',
        array(
            'labels' => array(
                'name' => __( 'Platform Videos' ),
                'singular_name' => __( 'Videos' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'thumbnail', 'title', 'editor', 'author' ),
            'menu_icon' => 'dashicons-video-alt'
        )
	);
    
    // Categories
    register_post_type( 'categories',
        array(
            'labels' => array(
                'name' => __( 'Channels' ),
                'singular_name' => __( 'Channel' )
            ),
            'public' => true,
            'rewrite' => array( 
                'slug' => '/channels'
            ),
            'has_archive' => true,
            'publicly_queryable' => true,
            'supports' => array( 'thumbnail', 'title', 'editor', 'author', 'excerpt'),
            'menu_icon' => 'dashicons-schedule'
        )

        
    );

    // user-reviews
    register_post_type( 'user-reviews',
        array(
            'labels' => array(
                'name' => __( 'User-reviews' ),
                'singular_name' => __( 'User-reviews' )
            ),
            'public' => true,
            'has_archive' => false,
            'show_in_nav_menus' => false,
            'publicly_queryable'  => false, // disable single and archive and search
            'exclude_from_search' => true,
            'supports' => array( 'title', 'author' ),
            'menu_icon' => 'dashicons-controls-play'
        )
    );

    // Team
    register_post_type( 'team',
        array(
            'labels' => array(
                'name' => __( 'Team' ),
                'singular_name' => __( 'Team' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title','editor','thumbnail' ),
            'menu_icon' => 'dashicons-universal-access-alt'
        )
    );

    // Podcast
    register_post_type( 'podcast',
        array(
            'labels' => array(
                'name' => __( 'Podcast' ),
                'singular_name' => __( 'Podcast' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title','editor','thumbnail','author' ),
            'menu_icon' => 'dashicons-controls-play'
        )
    );

     // Sites
     register_post_type( 'sites',
        array(
            'labels' => array(
                'name' => __( 'Sites' ),
                'singular_name' => __( 'Sites' )
            ),
            'public' => true,
            'has_archive' => false,
            'publicly_queryable'  => false, // disable single and archive and search
            'supports' => array( 'title','editor','custom-fields','thumbnail' ),
            'menu_icon' => 'dashicons-networking'
        )
    );

    // Webcast
    register_post_type( 'webcast',
        array(
            'labels' => array(
                'name' => __( 'Webcast' ),
                'singular_name' => __( 'Webcast' )
            ),
            'public' => true,
            'has_archive' => false,
            'supports' => array( 'title','editor','thumbnail','author' ),
            'menu_icon' => 'dashicons-controls-play'
        )
    );

}
add_action( 'init', 'create_post_type' );


/*------------------------------------*\
            ACF Custom Fields
\*------------------------------------*/

if ( function_exists( 'acf_add_options_sub_page' )) {
    
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Setting Doctorpedia',
        'menu_title'	=> 'Setting Doctorpedia',
        'menu_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Tracking Codes',
        'menu_title'	=> 'Tracking Codes',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Links',
        'menu_title'	=> 'Links',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'User Reviews',
        'menu_title'	=> 'User Reviews',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Ads Settings',
        'menu_title'	=> 'Ads Settings',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Podcast Settings',
        'menu_title'	=> 'Podcast Settings',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Video Settings',
        'menu_title'	=> 'Video Settings',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'API Vimeo',
        'menu_title'	=> 'API Vimeo',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Video Presentation Profile',
        'menu_title'	=> 'Video Presentation Profile',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Doctor Directory',
        'menu_title'	=> 'Doctor Directory',
        'parent_slug' 	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Doctor Platform',
        'menu_title'	=> 'Doctor Platform',
        'parent_slug' 	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Notifications',
        'menu_title'	=> 'Notifications',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Upload Video Method',
        'menu_title'	=> 'Upload Video Method',
        'parent_slug'	=> 'theme-general-settings',
    ));
}