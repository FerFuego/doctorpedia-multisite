<div class="author__profile-bio">

    <!-- Video Presentation Mobile -->
    <?php if ( get_the_author_meta('feature_video', $author_id, true) && wp_is_mobile() ) : ?>

        <div class="author__profile-bio-video-presentation">

            <?php echo do_shortcode('[video src="' . get_the_author_meta('feature_video', $author_id, true) . '" width="273px" height="160px"]'); ?>

        </div>

    <?php endif; ?>

    <!-- Bio Cta Mobile -->
    <div class="author__profile-bio-container">

        <h3 class="author__profile-bio-title author__profile-title"><?php echo ( wp_is_mobile() ) ? 'Bio' : 'Doctorpedia Profile'; ?></h3>

        <?php if ( is_user_logged_in() && validate_user($author_id) ) : ?>
        
            <img src="<?php echo (get_the_author_meta('biography', $author_id)) ? IMAGES .'/public-profile/btn-edit.svg' : IMAGES .'/public-profile/add-more.svg'; ?>" class="author__profile-img" onclick="openBioModal()">

        <?php endif; ?>
        
    </div>

    <!-- Bio Tab Mobile -->
    <?php if (get_the_author_meta('biography', $author_id) || validate_user($author_id) ): ?>

        <div id="js-author-profile-bio" class="<?php echo (get_the_author_meta('biography', $author_id)) ? 'bio-margin' : ''; ?>">
            <p>
                <?php echo html_entity_decode(nl2br(str_replace('&nbsp;', ' ', get_the_author_meta('biography', $author_id)))); ?>

                <?php if (get_the_author_meta('biography_link', $author_id) || validate_user($author_id) ): ?>
                    <a href="<?php echo get_the_author_meta('biography_link', $author_id); ?>" target="_blank"><?php echo get_the_author_meta('biography_link', $author_id); ?></a>
                <?php endif;?>
            </p>
        </div>

    <?php endif;?>

    
</div>