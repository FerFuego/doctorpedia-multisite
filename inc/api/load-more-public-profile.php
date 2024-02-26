<?php

add_action('rest_api_init', 'doctorpediaLoadMore');

function doctorpediaLoadMore() {
    register_rest_route('doctorpedia/v2', 'profile-load-content', [
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'more_post_api'
    ]);
}

function more_post_api(){
    $x=0;
    $html = '';
    $ppp = (isset($_GET["ppp"])) ? $_GET["ppp"] : 10;
    $page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;
    $offset = $page * $ppp;
    $author_id = (isset($_GET["author_id"])) ? $_GET["author_id"] : '';
    $category = (isset($_GET["category"])) ? $_GET["category"] : null;
    $posttypes = array('repost', 'blog', 'article', 'user-reviews');
    $avatar = get_avatar_url(get_the_author_meta('ID', $author_id), '200');

    if (get_the_author_meta('is_doctor_premium', $author_id, false)) {
        $posttypes = array('repost', 'blog', 'article', 'user-reviews', 'videos', 'podcast','categories');
    }

    if (isset($category) && $category != null && $category != false && $category != 'false') {
        $posttypes = array($category);
        $posttype = $category;
    }

    if ($category == 'article') {
        $posttypes = array($category,'categories');
    }

    $args = array(
        'post_type' => $posttypes,
        'post_status' => 'publish',
        'author'    => $author_id,
        'posts_per_page' => $ppp,
        'offset' => $offset,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    
    $query = new WP_Query($args);

    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post(); $x++;
            ob_start();
            set_query_var('author_id', $author_id);
            set_query_var('avatar', $avatar);
            if ($posttype) {
                set_query_var('posttype', $posttype);
            } else {
                set_query_var('posttype', get_post_type());
            }
            switch (get_post_type()) {
                case 'repost': 
                    get_template_part('template-parts/authors/elements/article','repost');
                break;
                case 'blog': 
                    get_template_part('template-parts/authors/elements/article','blog');
                break;
                case 'categories': 
                    set_query_var('posttype', 'categories');
                    get_template_part('template-parts/authors/elements/article','blog');
                break;
                case 'videos': 
                    get_template_part('template-parts/authors/elements/article','video');
                break;
                case 'podcast': 
                    set_query_var('article_id', get_the_ID());
                    get_template_part('template-parts/authors/elements/article','podcast');  
                break;
                case 'user-reviews': 
                    get_template_part('template-parts/authors/elements/article','user-reviews');
                break;
                default: 
                    get_template_part('template-parts/authors/elements/article','blog');
                break;
            }
            
            wp_reset_postdata();
            
            $html .= ob_get_contents();
            ob_end_clean();

        endwhile;
    else :
        ob_start();
        switch ($category) {
            case 'article': 
                get_template_part('template-parts/authors/articles');
            break;
            case 'blog': 
                get_template_part('template-parts/authors/blogs');
            break;
            case 'videos': 
                get_template_part('template-parts/authors/videos');
            break;
            case 'podcast': 
                get_template_part('template-parts/authors/podcast');  
            break;
            case 'user-reviews': 
                get_template_part('template-parts/authors/app-reviews');
            break;
            default: 
                get_template_part('template-parts/authors/blogs');
            break;
        }
        $html .= ob_get_contents();
        ob_end_clean();
    endif;
    
    wp_send_json_success([
        'html'  => $html,
        'count' => $x,
        'total' => $query->found_posts,
    ]);
}