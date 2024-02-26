<div class="author__social-media">

    <?php if ( get_the_author_meta('clinic_email', $author_id ) ) : ?>

        <div class="author__social-icon">

            <a href="mailto:<?php echo get_the_author_meta('clinic_email', $author_id ); ?>" target="_blank" class="author-dashboard__bio-social-link">

                <img src="<?php echo IMAGES; ?>/authors/author-email.svg" alt="" width="24px" height="24px" class="author-dashboard__bio-social-icon"/>

            </a>

        </div>
        
    <?php endif; ?>

    <?php if (get_the_author_meta('facebook', $author_id)): ?>

        <div class="author__social-icon">

            <a href="<?php echo esc_url(get_the_author_meta('facebook', $author_id)); ?>" class="author-dashboard__bio-social-link" target="_blank">

                <img src="<?php echo IMAGES; ?>/authors/author-facebook.svg" alt="" width="24px" height="24px" class="author-dashboard__bio-social-icon"/>

            </a>

        </div>

    <?php endif;?>

    <?php if (get_the_author_meta('twitter', $author_id)): ?>

        <div class="author__social-icon">

            <a href="<?php echo esc_url(get_the_author_meta('twitter', $author_id)); ?>" class="author-dashboard__bio-social-link" target="_blank">

                <img src="<?php echo IMAGES; ?>/authors/author-twitter.svg" alt="" width="24px" height="24px" class="author-dashboard__bio-social-icon"/>

            </a>

        </div>

    <?php endif;?>

    <?php if (get_the_author_meta('instagram', $author_id)): ?>

        <div class="author__social-icon">

            <a href="<?php echo esc_url(get_the_author_meta('instagram', $author_id)); ?>" class="author-dashboard__bio-social-link" target="_blank">

                <img src="<?php echo IMAGES; ?>/authors/author-instagram.svg" alt="" width="24px" height="24px" class="author-dashboard__bio-social-icon"/>

            </a>

        </div>

    <?php endif;?>

    <?php if (get_the_author_meta('linkedin', $author_id)): ?>

        <div class="author__social-icon">

            <a href="<?php echo esc_url(get_the_author_meta('linkedin', $author_id)); ?>" class="author-dashboard__bio-social-link" target="_blank">

                <img src="<?php echo IMAGES; ?>/authors/author-linkedin.svg" alt="" width="24px" height="24px" class="author-dashboard__bio-social-icon"/>

            </a>

        </div>

    <?php endif;?>

    <?php if (get_the_author_meta('user_url', $author_id)): ?>

        <div class="author__social-icon">

            <a href="<?php the_author_meta('user_url', $author_id);?>" class="author-dashboard__bio-social-link" target="_blank">

                <img src="<?php echo IMAGES; ?>/authors/author-website.svg" alt="" width="24px" height="24px" class="author-dashboard__bio-social-icon"/>

            </a>

        </div>

    <?php endif;?>

</div>