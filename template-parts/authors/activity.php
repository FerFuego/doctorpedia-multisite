<?php 
if (get_the_author_meta('is_doctor_premium', $author_id, false)) {
    $posttypes = "('repost','blog', 'article', 'user-reviews', 'videos', 'podcast','categories')";
} else {
    $posttypes = "('repost', 'blog', 'article', 'user-reviews')";
}

global $wpdb;
$posts_per_page = 10;
        
$results = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*
            FROM $wpdb->posts
            WHERE 1=1 
            AND $wpdb->posts.post_type IN $posttypes
            AND $wpdb->posts.post_author IN ($author_id)  
            AND ($wpdb->posts.post_status = 'publish' OR $wpdb->posts.post_status = 'acf-disabled')  
            ORDER BY $wpdb->posts.post_date 
            DESC LIMIT 0, $posts_per_page", OBJECT );

if ( $results ) : ?>

    <div class="d-flex flex-row flex-wrap author-posts-container" id="ajax-posts">

        <?php foreach ( $results as $post ) : setup_postdata($post);

            $posttype = ( $post->post_type == 'post' ) ? 'Article' : $post->post_type;

            set_query_var('posttype', $posttype);

            switch ($posttype) {

                case 'repost': get_template_part('template-parts/authors/elements/article','repost');  break;

                case 'blog': get_template_part('template-parts/authors/elements/article','blog'); break;

                case 'videos': get_template_part('template-parts/authors/elements/article','video');  break;

                case 'podcast': 
                    set_query_var('article_id', get_the_ID());
                    get_template_part('template-parts/authors/elements/article','podcast');  
                break;

                case 'user-reviews': get_template_part('template-parts/authors/elements/article','user-reviews');  break;

                default: get_template_part('template-parts/authors/elements/article','blog');  break;

            }

            wp_reset_postdata();
        
        endforeach; ?>

    </div>

    <?php if (count($results) == 10) : ?>

    <div id="more_posts" class="doctor-profile-load-more">Load More</div>

    <?php endif; ?>

<?php else : ?>

    <?php if ( is_user_logged_in() && validate_user($author_id) ) : ?>

        <div class="d-flex flex-row flex-wrap author-posts-container">
            <!-- Articles -->
            <div class="author__content-post author-post-welcome">

                <img src="<?php echo IMAGES . '/welcome-profile-icon.svg'; ?>" alt="welcome" class="mb-4" width="50%">

                <h2>Welcome to your profile, Dr. <?php the_author_meta('user_lastname', $author_id);?>!</h2>

                <p>Once you start sharing posts, articles, app reviews, blogs, and videos with the <strong>Doctorpedia community</strong>, they will show up here.</p>

            </div>
            
        </div>

    <?php else : ?>

        <div class="d-flex flex-row flex-wrap author-posts-container">
            <!-- Article -->
            <div class="author__content-post author-post-welcome">

                <img src="<?php echo IMAGES . '/welcome-profile-icon.svg'; ?>" alt="welcome" class="mb-4" width="50%">

                <h2>Nothing yet..</h2>

                <p>This doctor has not yet uploaded content to this section</p>

            </div>
            
        </div>

    <?php endif; ?>

<?php endif; ?>

<?php wp_reset_query(); ?>