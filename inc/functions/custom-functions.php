<?php
/**
 * Return post ID by slug
 */
function getPostParentID( $postSlug ){
    $ID = url_to_postid( site_url( $postSlug ) );
    return $ID; 
}

/**
 * Return WP Site Title
 */
function getWPSiteTitle() {
    if( is_post_type_archive('doctors') ){ 
        $title =  __( 'Doctor Directory' ) . ' | ' . __( get_bloginfo('name') ); 
    }

    return $title;
}

/**
 * Register Menu
 */
add_action( 'after_setup_theme', 'register_custom_nav_menus' );

function register_custom_nav_menus() {
	register_nav_menus( array(
		'sidebar_menu_archive' => 'Doctorpedia Sidebar Menu Archive'
    ) );

    register_nav_menus( array(
		'top_big_menu' => 'Doctorpedia Big Menu'
    ) );

    register_nav_menus( array(
		'top_channels_menu' => 'Doctorpedia Channels Menu'
    ) );
}

/**
 * Trim text to especific character number
 */
class Cadena {

	public static function corta( $string, $max ) {

		$tok = strtok($string,' ');
		$sub = '';

		while( $tok !== false && mb_strlen($sub) < $max ) {
			if( strlen($sub) + mb_strlen($tok) <= $max ) {
				$sub .= $tok.' ';
			} else {
				break;
			}
			$tok = strtok(' ');
		}

		$sub = trim($sub);

		if( mb_strlen($sub) < mb_strlen($string) ) $sub .= '&hellip;';

		return $sub;
	}

}

/*
 * Return all posttypes
 */
function getAllPostTypes () {

    $args = array(
        'public'   => true,
        '_builtin' => false
    );
    
    $output = 'names'; // 'names' or 'objects' (default: 'names')
    $operator = 'and'; // 'and' or 'or' (default: 'and')
    
    $post_types = get_post_types( $args, $output, $operator );

    return $post_types;
}

/**
 * Return Site Condition
 */
function getCondition() {
    $name = get_bloginfo( 'name' );
    $cut = str_replace( 'pedia', '', $name );
    return ucfirst( $cut );
}

/**
* Removes or edits the 'Protected:' part from posts titles
*/
add_filter( 'protected_title_format', 'remove_protected_text' );
function remove_protected_text() {
    return __('%s');
}


/**
 * Get Playlist of Video PostType
 * @param none
 * @return array|null
 */
function getPlaylistVideoPostType() {

    $data = null;

    $result = new WP_Query( [
        'post_type' => 'videos',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key'     => 'show_playlist',
                'value'   => 'Yes',
                'compare' => 'LIKE'
            )
        )
    ]);
        
    if ( $result->have_posts() ):
        
        while( $result->have_posts() ) : $result->the_post();

            $data[] = array( 'title' => get_the_title(), 'url' => get_field('url_vimeo'), 'image' => get_the_post_thumbnail_url() );

        endwhile;
        
    endif;

    wp_reset_query();

    return $data;
}

/*
 * Set post views count using post meta
 */
function setPostViews($postID) {
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '0');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}

/**
 * Create Archive Articles Page
 */
function create_articles_page() {
  
    // Setup custom vars
    $author_id = 1;
    $slug = 'articles';
    $title = 'Articles Page';

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
            'page_template'         => 'archive-articles.php'
        );

        $post_id = wp_insert_post( $uploader_page );

        if ( !$post_id ) {
            
            wp_die( 'Error creating template page' );
            
        } else {

            update_post_meta( $post_id, '_wp_page_template', 'archive-articles.php' );

        }

    } // end check if

}
add_action( 'init', 'create_articles_page' );

/**
 * Create Single Article Page
 */
function create_single_article_page() {
  
    // Setup custom vars
    $author_id = 1;
    $slug = 'article';
    $title = 'Single Article';

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
            'page_template'         => 'single-article-multisite.php'
        );

        $post_id = wp_insert_post( $uploader_page );

        if ( !$post_id ) {
            
            wp_die( 'Error creating template page' );
            
        } else {

            update_post_meta( $post_id, '_wp_page_template', 'single-article-multisite.php' );

        }

    } // end check if

}
add_action( 'init', 'create_single_article_page' );

/**
 * Get If Have Posts
 */
function getIfHavePosts($taxonomy=null){
    
    $postType = array();
    $terms = get_terms( $taxonomy );
            
    if ( $terms && !is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            $postType[] = $term->name;
        }
    }

    if( count($postType) > 0 ){
        return $postType;
    }
    
    return false;
}

/**
 * Return time to posted
 */
function time_to_post($post = null) {

    $current_day = date('Y-m-d h:i:s');
    $post_day = ( $post ) ? get_the_time('Y-m-d h:i:s', $post) : get_the_time('Y-m-d h:i:s');
    
    $s_time = strtotime($current_day) - strtotime($post_day);
    $m_time = intval($s_time/60);
    $h_time = intval($s_time/3600);
    $d_time = intval($s_time/86400);
    
    if ($m_time < 1 ) {
        $time = 'a few seconds ago';
    } else {
        if ($h_time < 1 ) {
            $time = 'a few minutes ago';
        } else {
            if ($h_time == 1 ) {
                $time = $h_time.' hour ago';
            } else {
                if ( $h_time > 24 ) {
                    $day = intval($h_time / 24);
                    if ( $day == 1 ) {
                        $time = $day . ' day ago'; 
                    } else {
                        if ( $d_time > 30 ) {
                            $mount = intval($d_time / 30);
                            if ( $mount == 1 ) {
                                $time = $mount . ' month ago'; 
                            } else {
                                $time = $mount . ' months ago'; 
                            }
                        } else {
                            $time = $d_time.' days ago';
                        }
                    }
                } else {
                    $time = $h_time.' hours ago';
                }
            }
        }
    }
    return $time;
}

/**
 * Trim text, strip shortcodes and excerpt return 
 * 
 * @param Int $post - Post ID (optional)
 * @param String $text - Text or get_the_conten() (optional)
 * @param Int $words - Number of words to return
 * 
 * @return string - "Ex: This is my text trim and..."
 */
function custom_trim_excerpt ( $post = null, $text = null, $words = null ) {

    $content = '';

    if ( $post ) {
        $content = get_the_content('', false, $post);
    }

    if ( $text ) {
        $content = $text;
    }

    if ( $content == '' ) {
        return $content;
    }

    $content = excerpt_remove_blocks( $content );

    $content = apply_filters( 'the_content', $content);

    $content = strip_shortcodes( $content );

    $content = html_entity_decode( $content );

    $content = sanitize_text_field( $content );

    $content = str_replace( ']]>',']]&gt;', $content);
    
    $content = str_replace(['[vc_row]','[vc_column]','[vc_column_text]'],['','',''], $content);

    if ($words) {
        $content = wp_trim_words( $content, $words, '...' );
    }

    return $content;
}

/**
 * Get Link to Public Profile of Current User
 * @return string
 */
function get_user_permalink ( $user_id = null ) {

    if ( $user_id ) {

        $current_user = get_user_by('ID', $user_id );

        if ( in_array('blogger', $current_user->roles)) {   
            return esc_url( home_url( '/doctor-profile/' . $current_user->user_nicename ) );
        }
    }

    if (wp_get_current_user()) {

        $current_user = wp_get_current_user();

        if ( in_array('blogger', $current_user->roles)) { 
            return esc_url( home_url( '/doctor-profile/' . $current_user->user_nicename ) );
        }
    }

    return false;
}

/**
 * Allown subscribers users view private post and pages
 */
//$subRole = get_role( 'subscriber' ); 
//$subRole->add_cap( 'read_private_pages' );
//$subRole->add_cap( 'read_private_posts' );


/**
 * Get Specialties of Expert
 */
function get_specialties_expert ( $user_id ) {
    return get_field('bb_specialties', 'user_' . $user_id)[0]['specialty'];
}

/**
 * Fix link if do not contain protocol
 */
function normalize_link ( $weblink ) {

    if( $weblink !== '' && strpos($weblink, "https://") == false){  
        $weblink = "https://".$weblink; 
    }

    return $weblink;
}

/**
 * check page and return class css
 */
function class_body_content() {
    
	if (	is_page('my-articles')  ||
			is_page('article-edit') ||
			is_page('my-blogs')     ||
			is_page('blog-edit')	||
			is_page('videos')       ||
			is_page('video-edit')	||
			is_page('app-reviews')	||
			is_page('bio-edit') ) {
		 return 'large-dashboard--grey';
    }
    
    if (is_author()) {
        return 'large-container-authors container';
    }

    return 'large-container';
}

/**
 * Processing of the code invitation
 * @return json
 */
add_action('wp_ajax_validate_code', 'validate_code');
add_action( 'wp_ajax_nopriv_validate_code', 'validate_code' );

function validate_code () {

    if ( $inviteCode = $_POST['code'] ) {

        $brand = false;
    
        $codes = get_field('registration_codes', 'option');
    
        foreach ( $codes as $code ) {
    
            if ( $inviteCode === $code['code'] ) {
                $brand = true;
            }
        }
    
        if ( $brand ) {
    
            $data = array(
                'message' => '<p class="text-success">Code found</p>',
                'status' =>'success',
            );
    
        } else {
    
            $data = array(
                'message' => '<p class="text-danger">Code not found</p>',
                'status' => 'error'
            );
        }
    
    }

    wp_send_json_success($data);
}

/**
 * Add blogger role to user author list
 */
function wpdocs_add_subscribers_to_dropdown( $query_args, $r ) {
  
    $query_args['role__in'] = array('blogger','author','administrator');

    // Unset the 'who' as this defaults to the 'author' role
    unset( $query_args['who'] );

    return $query_args;
}
add_filter( 'wp_dropdown_users_args', 'wpdocs_add_subscribers_to_dropdown', 10, 2 );

/**
 * Remove authors from sitemap yoast seo plugin
 * define the wpseo_sitemap_exclude_author callback 
 */
function filter_wpseo_sitemap_exclude_author( $users ) { 
    foreach ( $users as $key => $user ) {
        if ( $user->roles[0] !== 'blogger' ) {
            unset( $users[$key] );
            continue;
        }

        if (get_user_meta( $user->id, 'hide_dd', true )) {
            unset( $users[$key] );
        }
    }
    return $users; 
};
add_filter( 'wpseo_sitemap_exclude_author', 'filter_wpseo_sitemap_exclude_author', 10, 1 ); 