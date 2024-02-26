<?php
/**
 * Return Featured User Reviewed
 */
function getFeaturedUserReviewed( $categoryID ){

    $interest = null;

    $args = array(
        'post_type' => 'user-reviews',
        'tax_query' => array(
            array(
                'taxonomy' => 'user-reviews-category',
                'field' => 'term_id',
                'terms' => $categoryID
            )
        ), 
        'meta_query'    => array(
            array(
                'key' => 'interest',
                'compare' => 'EXISTS'
            ),
        ), 
        'orderby'   => 'rand',
        'order'     => 'ASC',
        'posts_per_page' => 1
    );

    $loop = new WP_Query( $args );

    if ( $loop->have_posts() ) : 

        while ( $loop->have_posts() ) : $loop->the_post();

            $rows = get_field( 'personal' );

            $user = ( $rows['private'] ) ? 'Anonymous' : get_the_title();

            $interest .= '<span>' . Cadena::corta( get_field( 'comment' ), 200) . '</span> <br> <div class="user-name">- ' . $user . '</div>';

        endwhile;

    endif;

    wp_reset_query();

    return $interest;
}

/**
 * Calculate Gral Rating
 */
function calcGralRating( $categoryID ){

    $rating = array();
    $ease   = array();
    $money  = array();
    $features = array();
    $support = array();

    $args = array(
        'post_type' => 'user-reviews',
        'tax_query' => array(
            array(
                'taxonomy' => 'user-reviews-category',
                'field' => 'term_id',
                'terms' => $categoryID
            )
        ), 
        'orderby'   => 'date',
        'order'     => 'DESC',
    );

    $loop = new WP_Query( $args );

    if ( $loop->have_posts() ) : 
        while ( $loop->have_posts() ) : $loop->the_post();

            $rows = get_field('ratings');

            $rating[]   = $rows['overall_ranking'];
            $ease[]     = $rows['ease_use'];
            $money[]    = $rows['value_money'];
            $features[] = $rows['features'];
            $support[] = $rows['support'];

        endwhile;
    endif;

    wp_reset_query();

    if( !$rating )
        return 0;

    $total = array(
        'rating'    => array_sum( $rating ) / count( $rating ),
        'ease'      => array_sum( $ease )   / count( $ease ),
        'money'     => array_sum( $money )  / count( $money ),
        'features'  => array_sum( $features ) / count( $features ),
        'support'   => array_sum( $support ) / count( $support ),
    );

    return $total;
}

/**
 * Pagination Init (Fix 404)
 */
/* function custom_posts_per_page( $query ) {
    if ( $query->is_archive('project') ) {
        set_query_var('posts_per_page', -1);
    }
}
add_action( 'pre_get_posts', 'custom_posts_per_page' ); */

/**
 * Pagination Users Reviews
 */
function paginationReviews() {
    global $wp_query;
 
    $totalPages = $wp_query->max_num_pages;
 
    if ($totalPages > 1){
        $currentPage = max( 1, get_query_var( 'paged' ) );
 
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => 'page/%#%',
            'prev_text' => __('<< Previous'),
            'next_text' => __('Next >>'),
            'current' => $currentPage,
            'total' => $totalPages,
        ));
    }
}

/**
 * Pagination Apps Categories
 */
function paginationApp( $postsPerPage ) {
 
    // This counts the total number terms in the taxonomy with a function)
    $totalPages = count( get_terms( 'user-reviews-category', array(
            'hide_empty' => false,
        ) 
    ) ); 
 
    if ( $totalPages > 1 ){
        $currentPage = max( 1, get_query_var( 'paged' ) );

        echo paginate_links( array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => 'page/%#%',
            'prev_text' => __('<< Previous'),
            'next_text' => __('Next >>'),
            'current' => $currentPage,
            'total'   => ceil( $totalPages / $postsPerPage )
        ));
    }
}

/**
 * Add choices to select (user-reviews-categories)
 */
function acfLoadField( $field ) {

    $taxonomytype = get_queried_object();

    $name = @$taxonomytype->name;

    $categ = array();
        
    $categories = get_categories( 
        array( 
            'taxonomy' => 'user-reviews-category',
            'hide_empty' => 0,
        ) 
    );

    if( $categories ){

        if ( $name && $name != 'user-reviews' ) {
            $categ[ $name ] = $name;
        } else {
            $categ[null] = 'Select App';
        }
        
        foreach( $categories as $cat ){
            $categ[ $cat->name ] = $cat->name;
        }
    }
	
    $field['choices'] = $categ;

    return $field;
}
add_filter('acf/load_field/key=field_5d64629ede297', 'acfLoadField');

/**
 * Insert New Reviews
 */
add_filter('acf/pre_save_post', 'insertNewReview');

function insertNewReview( $post_id) {

    $taxonomytype = 'user-reviews-category';
	
    // bail early if not a contact_form post
	if( $post_id != 'new' ) {
		return  $post_id;
	}
		
	$post = array(
        'post_title'    => wp_strip_all_tags( $_POST['acf']['field_5d645ddc0ab2c']['group_rip522322'] ), 
        'post_type'     => 'user-reviews', 
        'post_status'   => 'pending',
    );

    $post_id = wp_insert_post( $post );

    update_post_meta( $post_id, 'fullname', $_POST['acf']['field_5d645ddc0ab2c']['group_rip522322'] );
    update_post_meta( $post_id, 'email', $_POST['acf']['field_5d645ddc0ab2c']['group_rip54322'] );
    update_post_meta( $post_id, 'private', $_POST['acf']['field_5d645ddc0ab2c']['group_rip54312'] );
    update_post_meta( $post_id, 'ease_use', $_POST['acf']['field_5d64533dc0ab2c']['field_app22c07ea20cf9'] );
    update_post_meta( $post_id, 'value_money', $_POST['acf']['field_5d64533dc0ab2c']['field_app1w1c7ea20cf9'] );
    update_post_meta( $post_id, 'features', $_POST['acf']['field_5d64533dc0ab2c']['field_app3w307ea20cf9'] );
    update_post_meta( $post_id, 'support', $_POST['acf']['field_5d64533dc0ab2c']['field_app3red7ea20cf9'] );
    update_post_meta( $post_id, 'comment', $_POST['acf']['group_rip54323'] );
    update_post_meta( $post_id, 'pros', $_POST['acf']['group_rip54324'] );
    update_post_meta( $post_id, 'cons', $_POST['acf']['group_rip54325'] );
    update_post_meta( $post_id, 'which_app_are_you_reviewing', $_POST['acf']['field_5d64629ede297'] );

    $app = get_term_by( 'name', $_POST['acf']['field_5d64629ede297'], $taxonomytype, OBJECT );
    if( !$app ) {
        $app = wp_insert_term( $_POST['acf']['field_5d64629ede297'], $taxonomytype);
    }
    wp_set_post_terms( $post_id, $app->term_id, $taxonomytype, true );

    do_action( 'acf/save_post', $post_id);

    return $post_id;
}

/**
 * Verify if the site is in array of sites allowed
 */
function is_current_blog( $current_site, $sites_allowed ) {

    if ( $current_site == get_bloginfo(1) ) return true;

    if( $sites_allowed ) {
        
        foreach( $sites_allowed as $row ) {

           if ( $row['site'] == $current_site ) return true;

        }

    }

    return false;
}

/**
 * Create Single User Reviews Page
 */
function create_single_user_reviews_page() {
  
    // Setup custom vars
    $author_id = 1;
    $slug = 'single-user-reviews';
    $title = 'Single User Reviews';

    // Check if page exists, if not create it
    if ( null == get_page_by_title( $title ) ) {

        $uploader_page = array(
            'comment_status'        => 'closed',
            'ping_status'           => 'closed',
            'post_author'           => $author_id,
            'post_name'             => $slug,
            'post_title'            => $title,
            'post_status'           => 'publish',
            'post_type'             => 'page',
            'post_parent'           => false,
            'hierarchical '         => true,
            'page_template'         => 'single-user-reviews-multisite.php'
        );

        $post_id = wp_insert_post( $uploader_page );

        if ( !$post_id ) {
            
            wp_die( 'Error creating template page' );
            
        } else {

            update_post_meta( $post_id, '_wp_page_template', 'single-user-reviews-multisite.php' );

        }

    } // end check if

}
add_action( 'init', 'create_single_user_reviews_page' );
?>