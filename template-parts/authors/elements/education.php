<?php if ( get_the_author_meta('bb_education', $author_id) || validate_user($author_id) ) : ?>

    
    <div class="author__profile-education">

        <div class="author__profile-line"></div>

        <!-- Titles -->
        <div class="author__profile-bio-container">

            <h3 class="author__profile-education-title author__profile-title">Education</h3>

            <?php if ( is_user_logged_in() && validate_user($author_id) ) : ?>
                <img src="<?php echo (get_the_author_meta('bb_education', $author_id)) ? IMAGES .'/public-profile/btn-edit.svg' : IMAGES .'/public-profile/add-more.svg'; ?>" class="author__profile-img" onclick="openEducationModal()">
            <?php endif; ?>

        </div>

        <div id="js-educations" class="<?php echo (get_the_author_meta('bb_education', $author_id) && !wp_is_mobile()) ? 'mb-4' : ''; ?>">
            <?php if (get_field( 'bb_education', 'user_' . $author_id )) : ?>
                <ul>
                    <?php foreach( get_field( 'bb_education', 'user_' . $author_id ) as $c ) : ?>
                        <li><p><?php echo $c['education']; ?></p></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

    </div>

<?php endif; ?>