<?php $rand = rand(); ?>
<!-- Podcast -->
<div class="podcast-profile" id="post_<?php echo $article_id; ?>">
    
    <!-- podcast Head -->
    <div class="podcast-profile__head">

        <!-- Doctor Image -->
        <a href="<?php echo get_user_permalink( $author_id ); ?>">
            <div class="podcast-profile__avatar" style="background-image: url(<?php echo $avatar; ?>);"></div>
        </a>

        <div class="podcast-profile__data">

            <div>
                <!-- Doctor Name -->
                <a class="podcast-profile__name" href="<?php echo get_user_permalink( $author_id ); ?>"><?php the_author_meta('display_name', $author_id );?></a>
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
    <!-- End podcast Head -->

    <!-- podcast Image -->
    <div class="podcast-profile__image" style="background-image:url(<?php echo ( get_the_post_thumbnail_url( get_the_ID()) ) ? get_the_post_thumbnail_url( get_the_ID(), 'large') : IMAGES . '/bg-empty.png'; ?>);">

        <div class="podcast-image">

            <div class="podcast-image__cta-to-single">

                <div class="podcast-image__box-player d-none" id="js-player-podcast-<?php echo $rand; ?>">

                    <?php echo do_shortcode(get_field('podcast'));?>

                </div>
                
                <a class="podcast-image__cta-play js-play-button" href="#" onclick="playPodcast(<?php echo $rand; ?>);" id="js-play-button-<?php echo $rand; ?>">
                    <img src="<?php echo IMAGES; ?>/icons/min-play-white.svg" width="12px" height="15px"> PLAY</a>

            </div>

            <div class="podcast-image__cta-to-external">
                                    
                <a href="<?php echo get_field('link_apple'); ?>" target="_blank"><img src="<?php echo IMAGES .'/icons/apple_podcast.svg';?>" width="26px" height="26px" alt="podcast">&nbsp;Apple Podcast</a>

                <a href="<?php echo get_field('link_spotify'); ?>" target="_blank"><img src="<?php echo IMAGES .'/icons/spotify.svg'; ?>" width="26px" height="26px" alt="spotify">&nbsp;Spotify</a>

            </div>
            
        </div>

    </div>
    <!-- End podcast Image -->

    <!-- podcast body -->
    <div class="podcast-profile__body">

        <p class="podcast-profile__body-type"><?php echo ucfirst($posttype); ?></p>

        <h2 class="podcast-profile__body-title"><?php the_title() ?></h2>

        <a class="podcast-profile__body-cta" href="<?php echo get_the_permalink($article_id); ?>" target="_blank">View Complete Podcast</a>

    </div>
    <!-- End Podcast Body -->

</div>
<!-- End Podcast -->