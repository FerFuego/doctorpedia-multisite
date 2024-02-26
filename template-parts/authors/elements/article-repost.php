<!-- Articles -->
<div class="author__content-post <?php echo ( get_field('share_external_link') || get_field('share_blog') ) ? 'author-repost': 'author-comment'; ?>" id="post_<?php the_ID(); ?>">
    
    <!-- Article Head -->
    <div class="author__content-post-head author-repost__head">

        <!-- Doctor -->
        <div class="author__content-doctor">

            <!-- Doctor Image -->
            <a href="<?php echo get_user_permalink( $author_id ); ?>">
                <div class="author__content-doctor-image" style="background-image: url(<?php echo $avatar; ?>);"></div>
            </a>

            <div class="author__content-doctor-text">

                <div>
                    <!-- Doctor Name -->
                    <a href="<?php echo get_user_permalink( $author_id ); ?>" class="author__content-doctor-name"><?php the_author_meta('display_name', $author_id );?></a>
                </div>

                <?php if ( is_user_logged_in() && validate_user($author_id) ) :

                    get_template_part( 'template-parts/authors/elements/post', 'cta' );

                endif; ?>

            </div>

        </div>

    </div>
    <!-- End Article Head -->

    <!-- Article body -->
    <div class="author__content-post-body author-repost__body">
            
        <p class="author__content-description"><?php echo get_the_content(); ?></p>

    </div>
    <!-- End Article Body -->

    <?php if ( get_field('share_external_link') ) : ?>

        <div class="author-repost__original-author">

            <?php require ( __DIR__ . '/repost-external.php' ); ?>

        </div>
        
    <?php elseif ( get_field('share_blog') ) : ?>

        <div class="author-repost__original-author">

            <?php $repost = get_post( get_field('share_blog'), OBJECT );
            
            switch ( $repost->post_type ) :
            
                case 'videos': require ( __DIR__ . '/repost-video.php' );  break;
            
                default: require ( __DIR__ . '/repost-articles.php' );  break;
            
            endswitch; ?>
        
        </div>

    <?php endif; ?>

</div>
<!-- End Articles -->