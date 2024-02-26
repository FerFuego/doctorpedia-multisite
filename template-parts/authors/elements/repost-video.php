<?php $rand_id = rand(); ?>

<!-- Articles -->
<div class="author__content-post" id="post_<?php echo $repost->ID; ?>">
        
    <!-- Article Head -->
    <div class="author__content-post-head">

        <!-- Doctor -->
        <div class="author__content-doctor">

            <!-- Doctor Image -->
            <a href="<?php echo get_user_permalink( $repost->post_author ); ?>">
                <div class="author__content-doctor-image" style="background-image: url(<?php echo get_avatar_url(get_the_author_meta('ID', $repost->post_author), '200'); ?>);"></div>
            </a>

            <div class="author__content-doctor-text">

                <div>
                    <!-- Doctor Name -->
                    <a href="<?php echo get_user_permalink( $repost->post_author ); ?>" class="author__content-doctor-name"><?php the_author_meta('display_name', $repost->post_author );?></a>
                </div>

                <?php if ( is_user_logged_in() && validate_user($author_id) ) :

                    get_template_part( 'template-parts/authors/elements/post', 'cta' );

                endif; ?>

            </div>

        </div>

    </div>
    <!-- End Article Head -->

    <!-- Article Image -->
    <div class="author__content-post-image author__content-post-image--video">

        <?php if ( strpos(get_field('video_link_premium', $repost->ID), 'youtube') || strpos(get_field('video_link_premium', $repost->ID), 'youtu') ) : 

            echo do_shortcode('[video src="' . get_field('video_link_premium', $repost->ID) . '" id="js-video-post-'. get_the_ID() .'" height="331px"]');

        elseif ( strpos(get_field('video_link_premium', $repost->ID), 'vimeo') ) : ?>

            <iframe src="<?php echo get_field('video_link_premium', $repost->ID); ?>" id="<?php echo 'js-video-post-' . $rand_id; ?>" frameborder="0" height="331px" width="100%" mozallowfullscreen webkitallowfullscreen allowfullscreen></iframe>

        <?php else :  ?>

            <video width="100%" height="331" controls>
                <source src="<?php echo get_field('video_link_premium'); ?>" type="video/mp4">
                <source src="<?php echo get_field('video_link_premium'); ?>" type="video/ogg">
                <source src="<?php echo get_field('video_link_premium'); ?>" type="video/mov">
                Your browser does not support the video tag.
            </video>

        <?php endif; ?>
            
    </div>
    <!-- End Article Image -->

    <!-- Article body -->
    <div class="author__content-post-body">

        <p class="author__content-type"><?php echo ucfirst($repost->post_type); ?></p>

        <h2 class="author__content-title"><?php echo $repost->post_title; ?></h2>
            
        <p class="author__content-description"><?php echo custom_trim_excerpt(null, $repost->post_content, 35); ?></p>

        <a class="video-profile__body-cta" href="<?php echo get_the_permalink($repost->ID); ?>" href="_blank">Watch and Share</a>

    </div>
    <!-- End Article Body -->

</div>
<!-- End Articles -->