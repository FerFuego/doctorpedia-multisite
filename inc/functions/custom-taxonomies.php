<?php

/*------------------------------------*\
            Custom Taxonomies
\*------------------------------------*/

function create_my_taxonomy() {

    // Video Library category
	register_taxonomy(
		'video-library-category',
		'video-library',
		array(
            'label' => __( 'Categories' ),
            'rewrite' => array( 'slug' => 'video-library-category' ),
            'hierarchical' => true,
		)
	);

    // Faqs category
	register_taxonomy(
		'faqs-category',
		'faqs_type',
		array(
            'label' => __( 'Categories' ),
            'rewrite' => array( 'slug' => 'faqs-category' ),
            'hierarchical' => true,
		)
	);

    // Vl category category
	register_taxonomy(
		'vl_category-category',
		'vl_category',
		array(
            'label' => __( 'Categories' ),
            'rewrite' => array( 'slug' => 'vl_category-category' ),
            'hierarchical' => true,
		)
	);
	
	// New User reviews
	register_taxonomy(
		'user-reviews-category',
		'user-reviews',
		array(
            'label' => __( 'Apps' ),
            'rewrite' => array( 'slug' => 'user-reviews-category' ),
            'hierarchical' => true,
		)
	);

	// Team Category
	register_taxonomy(
		'area',
		'team',
		array(
            'label' => __( 'Area' ),
            'rewrite' => array( 'slug' => 'area' ),
            'hierarchical' => true,
		)
	);

	// Podcast Category
	register_taxonomy(
		'podcasts',
		'podcast',
		array(
            'label' => __( 'Categories' ),
            'rewrite' => array( 'slug' => 'podcasts' ),
            'hierarchical' => true,
		)
	);
    
}
add_action( 'init', 'create_my_taxonomy' );

function taxonomies() {
	$taxonomies = array();

	$taxonomies['categories-category'] = array(
		  'hierarchical'  => true,
		  'query_var'     => 'categories-category',
		  'rewrite'       => array(
				'slug'      => 'channel',
				'hierarchical' => true, 
				'with_front' => false
		  ),
		  'labels'            => array(
				'name'          => 'Channel',
				'singular_name' => 'Channel',
				'edit_item'     => 'Edit Channel',
				'update_item'   => 'Update Channel',
				'add_new_item'  => 'Add Channel',
				'new_item_name' => 'Add New Channel',
				'all_items'     => 'All Channel',
				'search_items'  => 'Search Channel',
				'popular_items' => 'Popular Channel',
				'separate_items_with_commas' => 'Separate Dishes Categories with Commas',
				'add_or_remove_items' => 'Add or Remove Dishes Categories',
				'choose_from_most_used' => 'Choose from most used categories',
		  ),
		  'show_admin_column' => true
	);

	flush_rewrite_rules();

	foreach( $taxonomies as $name => $args ) {
		register_taxonomy( $name, array( 'categories' ), $args );
	}
}
add_action( 'init', 'taxonomies' );

function tags_support_video_play() {
	register_taxonomy_for_object_type('post_tag', 'video_play');
}
add_action('init', 'tags_support_video_play');


function tags_support_faqs_type() {
	register_taxonomy_for_object_type('post_tag', 'faqs_type');
}
add_action('init', 'tags_support_faqs_type');


function tags_support_vl_category() {
	register_taxonomy_for_object_type('post_tag', 'vl_category');
}
add_action('init', 'tags_support_vl_category');