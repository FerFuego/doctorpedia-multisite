<div class="d-flex flex-row flex-wrap author-reviews-container" id="js-placeholder-user-reviews">

    <?php if ( is_user_logged_in() && validate_user($author_id) ) : ?>

        <!-- Reviews -->
        <div class="author__content-post author-post-welcome">

            <img src="<?php echo IMAGES . '/welcome-profile-reviews.svg'; ?>" alt="welcome" class="align_icon_review">

            <h2>Nothing yet..</h2>

            <p>Check out our curated health and wellness apps and leave your reviews and ratings. <br>When you review an app, it will show up here.</p>

            <a href="<?php echo esc_url( home_url('/doctor-platform/app-reviews/')); ?>" class="btn-cta-video">Write Your First Review</a>

        </div>

    <?php else : ?>

        <!-- Article -->
        <div class="author__content-post author-post-welcome">

            <img src="<?php echo IMAGES . '/welcome-profile-reviews.svg'; ?>" alt="welcome" class="align_icon_review">

            <h2>Nothing yet..</h2>

            <p>This doctor has not yet uploaded content to this section</p>

        </div>

    <?php endif; ?>

</div>