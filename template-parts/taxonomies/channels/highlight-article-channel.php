<!-- Highlight Template Part -->
<?php $rand = rand(); ?>

<div class="blog-posts-preview-container highlight-channels">   

    <div class="container">

        <div class="header-hightlight">

            <h2><?php echo get_sub_field('title_high'); ?></h2>

        </div>

        <div class="body featured-article slick-features-<?php echo $rand; ?>">

            <?php while( have_rows('article') ) : the_row(); ?>

                <?php $post = get_sub_field('post');?>

                <?php $categories = wp_get_post_terms( $post->ID, 'categories-category' );?>

                <div class="blog-post-preview" data-slug="<?php echo get_post_permalink( $post->ID ); ?>">
        
                    <a href="<?php echo get_post_permalink( $post->ID ); ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post->ID, 'medium'); ?>)" class="trim lazy"></a>
                
                    <div class="content">
                
                        <a href="<?php echo get_post_permalink( $post->ID ); ?>">
                
                            <h3><?php echo $categories[0]->name; ?></h3>
                
                            <h2 class="pb-25"><?php echo $post->post_title; ?></h2>
                
                        </a>

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

<!-- End Highlight Template Part -->