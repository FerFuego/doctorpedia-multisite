<?php if ( get_the_author_meta('feature_article', $author_id) ) :

    $args = array(
        'post_type' => array('repost','blog', 'article', 'user-reviews', 'videos', 'podcast'),
        'post__in' => array( get_the_author_meta('feature_article', $author_id) ),
        'author' => $author_id,
        'post_status' => 'publish',
        'posts_per_page' => 1
    );

    $query = new WP_Query($args);

    if ( $query->have_posts() ) : ?>

        <div class="author__featured-article mt-5 mb-5">

            <h3 class="author__featured-title">Featured Article</h3>

            <div class="author__featured-aricle-wrapper">

                <div class="d-flex flex-row flex-wrap author-posts-container">

                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                        <?php $bgImage = ( get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ) ? get_the_post_thumbnail_url( get_the_ID(), 'medium') : IMAGES . '/bg-empty.png'; ?>

                        <div class="author__featured-article-photo" style="background-image: url('<?php echo $bgImage; ?>');"></div>

                        <div class="author__featured-text-container">

                            <div class="author__featured-doctor-container">

                                <div class="author__featured-doctor-image" style="background-image: url(<?php echo $avatar; ?>);"></div>

                                <div class="author__featured-doctor-info">

                                    <h3 class="author__featured-doctor-name"><?php the_author_meta('display_name', $author_id );?></h3>

                                    <p class="author__featured-doctor-date"><?php echo get_the_date(); ?></p>

                                </div>

                            </div>

                            <h2 class="author__featured-acticle-description"><?php the_title(); ?></h2>

                            <a href="<?php the_permalink(); ?>" class="author__featured-article-cta">Read Article</a>

                        </div>

                    
                    <?php endwhile; ?>

                </div>
                
            </div>
            
        </div>
        
    <?php endif;

endif;

wp_reset_query(); ?>