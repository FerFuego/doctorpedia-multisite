<!-- Highlight Article Category Template Part -->

<?php     
    $terms = wp_get_post_terms( $single_cat_post_id, 'categories-category' );

    // Filter Subchannel to work
    $term = array_filter( $terms, function ($e) {
        if( $e->parent > 0 ) {
            return $e;
        }
    }); 

    // Else use first channel to work
    if ( !$term ) {
        $term = reset($terms);
    } else {
        $term = reset($term);
    }
?>

<div class="blog-posts-preview-container highlight-single-channels">

    <div class="bg-white"></div>

    <div class="container">

        <div class="header">

            <h2>Related Articles</h2>

        </div>

        <div class="body featured-article">

            <?php $args = array(
                'post_type' => 'categories',
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'categories-category',
                        'field'    => 'id',
                        'terms'    => $term->term_id,
                    ),
                ),
                'showposts' => 3,
                'post__not_in' => array( $single_cat_post_id ),
                'orderby' => 'rand'
            );
            query_posts( $args ); ?>

            <?php while( have_posts() ) : the_post(); ?>

                <div class="blog-post-preview" data-slug="<?php echo get_permalink(); ?>">
        
                    <a href="<?php echo get_permalink(); ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium'); ?>)" class="trim lazy"></a>
                
                    <div class="content">
                
                        <a href="<?php echo get_permalink(); ?>">
                
                            <h3><?php echo $term->name; ?></h3>
                
                            <h2 class="pb-25"><?php the_title(); ?></h2>
                
                        </a>

                        <?php if ( get_field( 'short_description') ) : ?>
                        
                            <p><?php echo get_field('short_description'); ?></p>

                        <?php endif; ?>

                
                    </div>
                
                </div>


            <?php endwhile; ?>
            
            <?php wp_reset_postdata() ?>
            
        </div>

    </div>

</div>

<!-- End Highlight Article Category Template Part -->