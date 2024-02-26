<?php if ( get_the_author_meta('bb_expertise', $author_id) || validate_user($author_id) ) : ?>

    <div class="author__profile-line"></div>

    <div class="author__profile-expertise">

        <!-- Titles -->
        <div class="author__profile-bio-container">

            <h3 class="author__profile-education-title author__profile-title">Areas of Expertise</h3>

            <?php if ( is_user_logged_in() && validate_user($author_id) ) : ?>
                <img src="<?php echo (get_the_author_meta('bb_certification', $author_id)) ? IMAGES .'/public-profile/btn-edit.svg' : IMAGES .'/public-profile/add-more.svg'; ?>" class="author__profile-img" onclick="openExpertiseModal()">
            <?php endif; ?>

        </div>

        <div id="js-expertises" class="<?php echo (get_the_author_meta('bb_expertise', $author_id)) ? 'mb-4' : ''; ?>">
            <?php if (get_field( 'bb_expertise', 'user_' . $author_id )) : ?>
                <ul>
                    <?php foreach( get_field( 'bb_expertise', 'user_' . $author_id ) as $c ) : ?>
                        <li><p><?php echo $c['expertise']; ?></p></li>
                    <?php endforeach; ?>
                </ul>
                <a id="js-see-more-expertise" href="javascript:void(0)" onclick="showMoreItems()" class="read-more-expertise mt-3 d-none">See More</a>
                <a id="js-see-less-expertise" href="javascript:void(0)" onclick="showLessItems()" class="read-less-expertise mt-3 d-none">See Less</a>
            <?php endif; ?>
        </div>

    </div>

<?php endif; ?>