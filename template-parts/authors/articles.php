<?php if ( is_user_logged_in() && validate_user($author_id) ) : ?>

    <div class="d-flex flex-row flex-wrap author-posts-container" id="js-placeholder-article">
        <!-- Article -->
        <div class="author__content-post author-post-welcome">

            <img src="<?php echo IMAGES . '/welcome-profile-articles.svg'; ?>" alt="welcome" class="align_icon_article">

            <h2>Nothing yet..</h2>

            <p>Try our easy-to-use publishing tools to share articles. When they are completed and reviewed, they will show up here.</p>

            <a href="<?php echo esc_url( home_url('/doctor-platform/article-edit/')); ?>" class="btn-cta-video">Write Your First Article</a>

        </div>
        
    </div>

<?php else : ?>

    <div class="d-flex flex-row flex-wrap author-posts-container" id="js-placeholder-article">
        <!-- Article -->
        <div class="author__content-post author-post-welcome">

            <img src="<?php echo IMAGES . '/welcome-profile-articles.svg'; ?>" alt="welcome" class="align_icon_article">

            <h2>Nothing yet..</h2>

            <p>This doctor has not yet uploaded content to this section</p>

        </div>
        
    </div>

<?php endif; ?>