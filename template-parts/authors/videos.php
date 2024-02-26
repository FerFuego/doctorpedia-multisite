<?php if ( is_user_logged_in() && validate_user($author_id) ) : ?>

    <div class="d-flex flex-row flex-wrap author-posts-container" id="js-placeholder-videos">
        <!-- Video -->
        <div class="author__content-post author-post-welcome">

            <img src="<?php echo IMAGES . '/welcome-profile-video.svg'; ?>" alt="welcome" class="align_icon_video">

            <h2>Nothing yet..</h2>

            <p>Try our easy-to-use video uploading tools.<br> When they are completed and reviewed, they will show up here.</p>

            <a href="<?php echo esc_url( home_url('/doctor-platform/video-edit/')); ?>" class="btn-cta-video">Upload Your First Video</a>

        </div>

    </div>

<?php else : ?>

    <div class="d-flex flex-row flex-wrap author-posts-container" id="js-placeholder-videos">
        <!-- Article -->
        <div class="author__content-post author-post-welcome">

            <img src="<?php echo IMAGES . '/welcome-profile-video.svg'; ?>" alt="welcome" class="align_icon_video">

            <h2>Nothing yet..</h2>

            <p>This doctor has not yet uploaded content to this section</p>

        </div>
        
    </div>

<?php endif; ?>