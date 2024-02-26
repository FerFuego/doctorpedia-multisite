<!-- Grid Channels Module VC -->
<div class="blog-posts-preview-container grid-channel-container">   

<div class="container">

    <div class="header_grid">

        <?php if ( get_sub_field( 'title_grid' ) ) : ?>

            <h2><?php echo get_sub_field( 'title_grid' ); ?></h2>

        <?php endif; ?>

    </div>

    <div class="body body-fix featured-article slick-features-<?php echo $rand; ?>">

        <?php while ( have_rows('articles_grid') ) : the_row(); ?>

            <?php $post = get_sub_field('post');?>

            <?php $categories = wp_get_post_terms( $post->ID, 'categories-category' );?>
                                        
            <div class="blog-post-preview-grid" data-slug="<?php echo get_post_permalink( $post->ID ); ?>">
            
                <a href="<?php echo get_post_permalink( $post->ID ); ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post->ID, 'large'); ?>)" class="trim lazy"></a>
            
                <div class="content">
            
                    <a href="<?php echo get_post_permalink( $post->ID ); ?>">
            
                        <h2><?php echo $post->post_title; ?></h2>
            
                    </a>
    
                    <h4><?php echo get_the_date('', $post->ID ); ?></h4>
    
                    <?php if ( get_post_meta( $post->ID, 'short_description', true) ) : ?>
                    
                        <p><?php echo get_post_meta( $post->ID, 'short_description', true); ?></p>
    
                    <?php endif; ?>
            
                </div>
            
            </div>

            <?php wp_reset_postdata() ?>

        <?php endwhile; ?>
        
    </div>

</div>

</div>

<!-- End Grid Channels Module VC -->