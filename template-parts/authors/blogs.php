<?php if ( is_user_logged_in() && validate_user($author_id) ) : ?>

    <div class="d-flex flex-row flex-wrap author-posts-container" id="js-placeholder-blog">
        <!-- Blog -->
        <div class="author__content-post author-post-welcome">

            <img src="<?php echo IMAGES . '/welcome-profile-blog.svg'; ?>" alt="welcome">

            <h2>Nothing yet..</h2>

            <p>Try our easy-to-use publishing tools to share blogs about your personal and professional experience.<br> When they are completed and reviewed, they will show up here.</p>

            <a href="<?php echo esc_url( home_url('/doctor-platform/blog-edit/')); ?>" class="btn-cta-video">Write Your First Blog</a>

        </div>
        
    </div>

<?php else : ?>

    <div class="d-flex flex-row flex-wrap author-posts-container" id="js-placeholder-blog">
        <!-- Article -->
        <div class="author__content-post author-post-welcome">

            <img src="<?php echo IMAGES . '/welcome-profile-blog.svg'; ?>" alt="welcome">

            <h2>Nothing yet..</h2>

            <p>This doctor has not yet uploaded content to this section</p>

        </div>
        
    </div>

<?php endif; ?>