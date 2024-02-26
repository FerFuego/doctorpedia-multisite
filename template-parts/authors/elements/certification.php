<?php if ( get_the_author_meta('bb_certification', $author_id) || get_the_author_meta('residency', $author_id) || validate_user($author_id) ): ?>

    
    <div class="author__profile-certification">

        <div class="author__profile-line"></div>

        <!-- Titles -->
        <div class="author__profile-bio-container">

            <h3 class="author__profile-education-title author__profile-title">Board Certifications</h3>

            <?php if ( is_user_logged_in() && validate_user($author_id) ) : ?>
                <img src="<?php echo (get_the_author_meta('bb_certification', $author_id)) ? IMAGES .'/public-profile/btn-edit.svg' : IMAGES .'/public-profile/add-more.svg'; ?>" class="author__profile-img" onclick="openCetificationModal()">
            <?php endif; ?>

        </div>
        
        <!-- Certification -->
        <div id="js-certifications" class="<?php echo (get_the_author_meta('bb_certification', $author_id) && !wp_is_mobile()) ? 'mb-4' : ''; ?>">

            <?php if ( get_the_author_meta('bb_certification', $author_id) ): ?>

                <ul class="doctor-dashboard__bio-edit-sub-group d-flex flex-column">

                    <?php if ( get_field( 'bb_certification', 'user_' . $author_id ) ) :

                        foreach( get_field( 'bb_certification', 'user_' . $author_id ) as $c ) : ?>

                            <li>
                                <p class="author__profile-education-description author__profile-description d-flex">
                                    <?php echo $c['certification']; ?>
                                    <?php echo ( $c['subcertification'] ) ? '- ' . $c['subcertification'] : '' ?>
                                </p>
                            </li>
                            
                        <?php endforeach;

                    endif;?>

                </ul>

            <?php elseif ( get_the_author_meta('residency', $author_id) ) : ?>

                <p>Residency: <?php echo get_the_author_meta('residency', $author_id); ?></p>

            <?php endif;?>

        </div>

    </div>

<?php endif; ?>