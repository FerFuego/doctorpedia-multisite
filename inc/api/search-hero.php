<?php

new SearchAPIREST();

class SearchAPIREST
{
    function __construct()
    {
        add_action('rest_api_init', array($this, 'searchByApi'));
    }

    /**
     * API Endpoint register
     */
    public function searchByApi()
    {
        register_rest_route('doctorpedia/v2', 'search', [
            'methods' => WP_REST_SERVER::READABLE,
            'callback' => array($this, 'getResults'),
            'permission_callback' => '__return_true'
        ]);
    }

    /**
     * Public response
     */
    public function getResults($data)
    {
        //User keyword
        $keyword = $data['s'];
        $postTypes = explode(", ", $data['postTypes']);
        $page = $data['page'] ?: 1;
        $results = array();
        $totalResults = 0;

        foreach ($postTypes as $postType) {
            $postData = $this->getPosts($keyword, $postType, $page);
            array_push(
                $results,
                array(
                    'posttype' => $postType,
                    'postsdata' => $postData
                )
            );

            $totalResults = $totalResults + $postData['postsfound'];
        }

        return array(
            'results' => $results,
            'total_results_message' => "$totalResults Doctor-vetted results for \"$keyword\"",
            'total_results' => $totalResults
        );
    }

    /**
     * Return all posts from a CPT
     */
    protected function getPosts($keyword, $postType, $page = 1)
    {
        global $wpdb;
        $page = ($page - 1) * 9;

        $keyword = esc_sql("%$keyword%");
        $postType = esc_sql($postType);
        $page = esc_sql($page);
        //COUNT
        $countQuery = $wpdb->prepare(
            "
            SELECT COUNT(*) as found_posts
            FROM wp_posts 
            WHERE wp_posts.post_status = 'publish' 
                AND wp_posts.post_type = '$postType'
                AND wp_posts.post_title LIKE '$keyword'
            "
        );
        $count = intval($wpdb->get_results($countQuery)[0]->found_posts);

        //ID query
        $idQuery = $wpdb->prepare(
            "
            SELECT coalesce(wp_postmeta.meta_value, 0) as important, wp_posts.ID
            FROM wp_posts 
            LEFT JOIN wp_postmeta ON wp_postmeta.post_id = wp_posts.id and wp_postmeta.meta_key = 'important_post'
            WHERE wp_posts.post_status = 'publish' 
            AND wp_posts.post_type = '$postType'
            AND wp_posts.post_title LIKE '%$keyword%' 
            ORDER BY important DESC, wp_posts.post_date DESC
            LIMIT 9 OFFSET $page;
            "
        );

        $posts = (object) array(
            'posts' => $wpdb->get_results($idQuery),
            'found_posts' => $count,
            'max_num_pages' =>  ceil($count / 9),
        );


        $postsHTML = '';
        foreach ($posts->posts as $post) {
            $postsHTML .= $this->getPostHtml(null, $post->ID, $postType, null);
        }

        return array(
            'postsfound' => $posts->found_posts,
            'html' => $postsHTML,
            'pages' => $posts->max_num_pages
        );
    }


    /**
     * Return Post Template
     */
    protected function getPostHtml($categories = null, $post, $hash = null, $tax = null)
    {

        //$meta = get_post_meta( $post->ID );

        $bgImage = (get_the_post_thumbnail_url($post, 'medium')) ? get_the_post_thumbnail_url($post, 'medium') : IMAGES . '/bg-empty.png';
        $authorId = get_post_field('post_author', $post);
        $authorName = get_the_author_meta('display_name', $authorId);
        $authorAvatar = get_avatar_url($authorId, '32');

        $box = '<div class="blog-post-preview" data-blog="' . (($categories) ? $categories : '') . '" data-categ="all ' . (($tax) ? implode(" ", $tax) : '') . '">
    <a target="_blank" href="' . get_the_permalink($post) . '" class="trim">
        <img src="' . $bgImage . '" alt="img" class="trim__bg">
        <div class="trim__user">
            <img src="' . $authorAvatar . '" alt="' . $authorName . '">
            <h5>' . $authorName . '</h5>
        </div>
    </a>
    <div class="content">
        <a target="_blank" href="' . get_the_permalink($post) . '">
        
            <h3>' . get_bloginfo('name') . '</h3>
            
            <h2 style="-webkit-box-orient: vertical;">' . get_the_title($post) . '</h2>
        </a>
        </div>
        <div class="footer">';

        if ($hash) {
            $box .= '<span class="text-pink">#' . $hash . '</a> &nbsp;';
        }

        foreach (wp_get_post_terms($post, array()) as $c) :

            $box .= '<span class="text-pink">#' . get_category($c)->name . '</span> &nbsp;';

        endforeach;

        $box .= '</div>
    </div>';

        return $box;
    }
}