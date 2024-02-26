<?php $rand_id = rand(); ?>

<!-- Video -->
<div class="video-profile" id="post_<?php the_ID(); ?>">
        
    <!-- Video Head -->
    <div class="video-profile__head">

        <!-- Doctor Image -->
        <a href="<?php echo get_user_permalink( $author_id ); ?>">
            <div class="video-profile__avatar" style="background-image: url(<?php echo $avatar; ?>);"></div>
        </a>

        <div class="video-profile__data">

            <div>
                <!-- Doctor Name -->
                <a  class="video-profile__name" href="<?php echo get_user_permalink( $author_id ); ?>" class="author__content-doctor-name"><?php the_author_meta('display_name', $author_id );?></a>
            </div>

            <?php 
                if ( is_user_logged_in() && validate_user($author_id) ) :

                    /* Options personal posts */
                    get_template_part( 'template-parts/authors/elements/post', 'cta' );

                else :
                    /* Share Button */
                    get_template_part( 'template-parts/authors/elements/post', 'share' );

            endif; ?>


        </div>

    </div>
    <!-- End Video Head -->

    <!-- Video Image -->
    <div class="video-profile__image video-profile__image--video">

        <?php if ( strpos(get_field('video_link_premium'), 'youtube') || strpos(get_field('video_link_premium'), 'youtu') ) : 

            echo do_shortcode('[video src="' . get_field('video_link_premium') . '" id="js-video-post-'. get_the_ID() .'" height="331px"]');

        elseif ( strpos(get_field('video_link_premium'), 'vimeo') ) : ?>

            <iframe src="<?php echo get_field('video_link_premium'); ?>" id="<?php echo 'js-video-post-' . $rand_id; ?>" frameborder="0" height="331px" width="100%" mozallowfullscreen webkitallowfullscreen allowfullscreen></iframe>

        <?php else :  ?>

            <video width="100%" height="331" controls>
                <source src="<?php echo get_field('video_link_premium'); ?>" type="video/mp4">
                <source src="<?php echo get_field('video_link_premium'); ?>" type="video/ogg">
                <source src="<?php echo get_field('video_link_premium'); ?>" type="video/mov">
                Your browser does not support the video tag.
            </video>

        <?php endif; ?>
            
    </div>
    <!-- End Video Image -->

    <!-- Video body -->
    <div class="video-profile__body">

        <p class="video-profile__body-type"><?php echo ucfirst($posttype); ?></p>

        <h2 class="video-profile__body-title"><?php the_title() ?></h2>
            
        <p class="video-profile__body-description"><?php echo custom_trim_excerpt(null, get_field('transcript'), 35); ?></p>

        <a class="video-profile__body-cta" href="<?php echo get_the_permalink(); ?>" target="_blank">Watch and Share</a>

    </div>
    <!-- End Video Body -->

</div>
<!-- End Video -->