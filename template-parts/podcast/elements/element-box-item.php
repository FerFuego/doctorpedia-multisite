<div class="podcast-content__content__box">

    <div class="podcast-content__content__box__profile">

        <?php if ( get_field('profile') ) : ?>

            <h5><?php echo ( get_field('invited_expert') ) ? get_field('invited_expert') : 'Invited Expert'; ?></h5>

            <img src="<?php echo get_field('profile')['url']; ?>" alt="">

            <?php if ( get_field('expert_link') ) : ?>

                <a href="<?php echo get_field('expert_link')['url']; ?>" target="<?php echo get_field('expert_link')['target']; ?>"><h4><?php echo get_field('name'); ?></h4></a>

            <?php else : ?>

                <h4><?php echo get_field('name'); ?></h4>

            <?php endif; ?>

            <p><?php echo get_field('specialty'); ?></p>

        <?php endif; ?>

    </div>

    <div class="podcast-content__content__box__description">

        <div class="podcast-content__content__box__description__content">

            <span><?php echo get_the_date('M d, Y'); ?></span>

            <h2><?php the_title(); ?></h2>

            <p><?php echo get_field('short_description'); ?></p>

        </div>

        <div class="cta">

            <div class="cta-to-single">

                <a href="<?php the_permalink(); ?>"><?php echo ( get_field('link_cta') ) ? get_field('link_cta') : 'LISTEN PODCAST'; ?></a>

                <span><?php echo get_field('time'); ?></span>

            </div>

            <div class="cta-to-external">

            <?php if ( get_field('link_apple') ) : ?>

                <a href="<?php echo get_field('link_apple'); ?>" target="_blank"><img src="<?php echo IMAGES; ?>/icons/apple_podcast.svg" alt=""> Apple Podcast</a>

            <?php endif; ?>

            <?php if ( get_field('link_spotify') ) : ?>

                <a href="<?php echo get_field('link_spotify'); ?>" target="_blank"><img src="<?php echo IMAGES; ?>/icons/spotify.svg" alt=""> Spotify</a>

            <?php endif; ?>

            </div>
            
        </div>

    </div>

</div>