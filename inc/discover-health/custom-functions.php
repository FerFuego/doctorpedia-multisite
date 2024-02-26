<?php

/**
 * Return all publications of sites by search var
 */
function custom_get_sites()
{

    global $wpdb;

    $posts = [];

    $params = sanitize_text_field(sanitize_input($_POST['search']));

    $posttypes = "( 'videos', 'resources', 'categories', 'post', 'mobile-apps' )";

    $filters = explode(',', $_POST['filters']);

    $sql_where_1 = $sql_where_2 = $sql_where_3 = $sql_where_4 = $sql_where_5 = [];

    $tmp = explode(' ', $params);

    foreach ($tmp as $param) {

        if (strlen(trim($param)) < 3) continue;

        $sql_where_1[] = "$wpdb->posts.post_title LIKE '%$param%'";

        $sql_where_2[] = "$wpdb->posts.post_content LIKE '%$param%'";

        $sql_where_3[] = "IF( $wpdb->posts.post_content LIKE '%Exclusion Criteria%', 
                                INSTR( SUBSTRING_INDEX( SUBSTRING_INDEX( $wpdb->posts.post_content, 'Exclusion Criteria', -1), '</ul>', 1), '$param') = 0, 
                                '1=1' 
                            )";

        $sql_where_4[] = "( $wpdb->postmeta.meta_key = 'transcript' AND $wpdb->postmeta.meta_value LIKE '%$param%' )";

        $sql_where_5[] = "( $wpdb->postmeta.meta_key = 'keywords' AND $wpdb->postmeta.meta_value LIKE '%$param%' )";
    }

    $query = "  SELECT  $wpdb->posts.ID
                FROM    $wpdb->posts
                WHERE   $wpdb->posts.post_type 
                IN      $posttypes
                AND    (" . implode($sql_where_1, ' AND ') . ")
                AND     $wpdb->posts.post_status = 'publish'
                GROUP BY $wpdb->posts.ID
                ORDER BY $wpdb->posts.post_title";

    $q1 = $wpdb->get_results($query, OBJECT);


    $query = "  SELECT  $wpdb->posts.ID
                FROM    $wpdb->posts
                WHERE   $wpdb->posts.post_type 
                IN      $posttypes
                AND     (" . implode($sql_where_2, ' AND ') . ")
                AND     (" . implode($sql_where_3, ' AND ') . ")
                AND     $wpdb->posts.post_status = 'publish'
                GROUP BY $wpdb->posts.ID
                ORDER BY $wpdb->posts.post_title";

    $q2 = $wpdb->get_results($query, OBJECT);


    $query = "  SELECT  $wpdb->posts.ID 
                FROM    $wpdb->posts  
                INNER JOIN $wpdb->postmeta 
                ON      ( $wpdb->posts.ID = $wpdb->postmeta.post_id ) 
                WHERE   $wpdb->posts.post_type 
                IN      $posttypes
                AND     (" . implode($sql_where_4, ' AND ') . ")
                OR      (" . implode($sql_where_5, ' AND ') . ")
                AND     $wpdb->posts.post_status = 'publish'
                GROUP BY $wpdb->posts.ID 
                ORDER BY $wpdb->posts.menu_order , $wpdb->posts.post_date 
                DESC";

    $q3 = $wpdb->get_results($query, OBJECT);

    $result = new WP_Query();

    $q1_q2 = array_unique(array_merge($q1, $q2), SORT_REGULAR);

    $result->posts = array_unique(array_merge($q1_q2, $q3), SORT_REGULAR);

    $result->posts = array_unique(array_column($result->posts, 'ID'), SORT_REGULAR);

    $result->post_count = count($result->posts);

    if (!empty($result)) :

        foreach ($result->posts as $r) :

            $p = get_post($r, ARRAY_A);

            if (!get_the_post_thumbnail_url($p['ID'])) continue;

            $posts[] = [
                $p['post_type'] => $p,
                'blog' => 1
            ];

        endforeach;

    endif;

    wp_send_json_success([
        'sites'      => [],
        'videos'     => getVideos($posts, $filters),
        'appReviews' => getAppReviews($posts, $filters),
        'reviews'    => getReviews($posts, $filters),
        'articles'   => getArticles($posts, $filters),
        'resources'  => [],
        'channels'   => getChannels($posts, $filters),
        'search'     => $params
    ]);
}

add_action('wp_ajax_nopriv_custom_get_sites', 'custom_get_sites');
add_action('wp_ajax_custom_get_sites', 'custom_get_sites');

/**
 * Return all publications of sites filtered per post type Reviews
 */
function getReviews($posts, $filters)
{

    global $wp_query;

    if (!evalFilter('Reviews', $filters)) return false;

    $posts = array_filter($posts, function ($e) {

        return $e['reviews'];
    });

    foreach ($posts as $reviews) :

        $post = get_post($reviews['reviews']['ID']);

        $data[] = getPostHtml($reviews['blog'], $post, 'reviews');

    endforeach;

    return $data;
}

/**
 * Return all publications of sites filtered per post type Post
 */
function getArticles($posts, $filters)
{

    global $wp_query;

    if (!evalFilter('Articles', $filters)) return false;

    $posts = array_filter($posts, function ($e) {

        return $e['post'];
    });

    foreach ($posts as $article) :

        $post = get_post($article['post']['ID']);

        $data[] = getPostHtml($article['blog'], $post, 'article');

    endforeach;

    return $data;
}

/**
 * Return all publications of sites filtered per post type Categories
 */
function getChannels($posts, $filters)
{

    global $wp_query;

    if (!evalFilter('Categories', $filters)) return false;

    $posts = array_filter($posts, function ($e) {

        return $e['categories'];
    });

    foreach ($posts as $categories) :

        $post = get_post($categories['categories']['ID']);

        $data[] = getPostHtml($categories['blog'], $post, null);

    endforeach;

    return $data;
}

/**
 * Return all publications of sites filtered per post type App-Reviews
 */
function getAppReviews($posts, $filters)
{

    global $wp_query;

    if (!evalFilter('App', $filters)) return false;

    $posts = array_filter($posts, function ($e) {

        return $e['mobile-apps'];
    });

    foreach ($posts as $mobile_apps) :

        $post = get_post($mobile_apps['mobile-apps']['ID']);

        $data[] = getPostHtml($mobile_apps['blog'], $post, 'mobile-apps');

    endforeach;

    return $data;
}

/**
 * Return all publications of sites filtered per post type Videos
 */
function getVideos($posts, $filters)
{

    global $wp_query;

    if (!evalFilter('Videos', $filters)) return false;

    $posts = array_filter($posts, function ($e) {

        return $e['videos'];
    });

    foreach ($posts as $videos) :

        $post = get_post($videos['videos']['ID']);

        $data[] = getPostHtml($videos['blog'], $post, 'videos');

    endforeach;

    return $data;
}

/**
 * Return Post Template
 */
function getPostHtml($categories = null, $post, $hash = null, $tax = null)
{

    //$meta = get_post_meta( $post->ID );

    $bgImage = (get_the_post_thumbnail_url($post->ID, 'medium')) ? get_the_post_thumbnail_url($post->ID, 'medium') : IMAGES . '/bg-empty.png';
    $authorId = get_post_field('post_author', $post->ID);
    $authorName = get_the_author_meta('display_name', $authorId);
    $authorAvatar = get_avatar_url($authorId, '32');

    $box = '<div class="blog-post-preview" data-blog="' . (($categories) ? $categories : '') . '" data-categ="all ' . (($tax) ? implode(" ", $tax) : '') . '">
    <a target="_blank" href="' . get_the_permalink($post->ID) . '"" class="trim">
        <img src="'.$bgImage.'" alt="img" class="trim__bg">
        <div class="trim__user">
            <img src="' . $authorAvatar . '" alt="' . $authorName . '">
            <h5>' . $authorName . '</h5>
        </div>
    </a>
    <div class="content">
        <a target="_blank" href="' . get_the_permalink($post->ID) . '">
        
            <h3>' . get_bloginfo('name') . '</h3>
            
            <h2 style="-webkit-box-orient: vertical;">' . $post->post_title . '</h2>
        </a>
        </div>
        <div class="footer">';

    if ($hash) {
        $box .= '<span class="text-pink">#' . $hash . '</a> &nbsp;';
    }

    foreach (wp_get_post_terms($post->ID, array()) as $c) :

        $box .= '<span class="text-pink">#' . get_category($c)->name . '</span> &nbsp;';

    endforeach;

    $box .= '</div>
    </div>';

    return $box;
}

/**
 * Evaluate filters
 */
function evalFilter($param, $filters)
{

    if (in_array('All', $filters)) {
        return true;
    }

    if (in_array($param, $filters)) {
        return true;
    }

    return false;
}

/**
 * Sanitize Input
 */
function sanitize_input($str)
{
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
    $str = str_replace(array('"', '”', '“', '=', '/', '|', ':', '(', ')', ';', 'javascript', 'void', '{', '}', '.', '\'', 'alert', 'script', 'select', 'SELECT', '*', 'insert', 'INSERT', 'DELETE', 'delete', 'UPDATE', 'update', 'FROM', 'WHERE', 'information_schematables', '!', '?', '¿', '%'), array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''), $str);
    return $str;
}

/**
 * Add Culumns to admin
 */
function add_sites_columns($columns)
{
    return array_merge($columns, array(
        'blog_type'  => __('Blog Type')
    ));
}
add_filter('manage_sites_posts_columns', 'add_sites_columns');


function sites_custom_column($column, $post_id)
{
    switch ($column) {
        case 'blog_type':
            echo get_post_meta($post_id, 'blog_type', true);
            break;
    }
}
add_action('manage_sites_posts_custom_column', 'sites_custom_column', 10, 2);

/**
 * Add filter to Admin Menu
 */
add_filter('parse_query', 'acf_admin_posts_filter');
add_action('restrict_manage_posts', 'acf_admin_posts_filter_restrict_manage_posts');

function acf_admin_posts_filter($query)
{
    global $pagenow;

    if (isset($_GET['post_type']) && post_type_exists($_GET['post_type']) && in_array(strtolower($_GET['post_type']), array('sites', 'sites_2'))) {

        if (isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != '') {
            $query->query_vars['meta_key'] = $_GET['ADMIN_FILTER_FIELD_NAME'];
            $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
        }
    }
}

function acf_admin_posts_filter_restrict_manage_posts()
{

    if (isset($_GET['post_type']) && post_type_exists($_GET['post_type']) && in_array(strtolower($_GET['post_type']), array('sites', 'sites_2'))) :  ?>

        <input type="hidden" name="ADMIN_FILTER_FIELD_NAME" value="blog_type" />
        <select name="ADMIN_FILTER_FIELD_VALUE">
            <option value=""><?php _e('Filter by Blog Type', 'baapf'); ?></option>
            <option value="">All</option>
            <option value="lightsite">lightsite</option>
            <option value="fullsite">fullsite</option>
        </select>
<?php
    endif;
}
