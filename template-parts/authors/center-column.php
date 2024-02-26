<?php get_template_part('template-parts/authors/share-content'); ?>

<div class="author__tabs-container <?php echo ( !wp_is_mobile() && !validate_user($author_id)) ? 'mt-4':''; ?>" id="js-center-column-content">

    <!-- Center Navigation -->
    <div id="js-author__nav" class="author__content-nav-wrapper" data-id="<?php echo $author_id; ?>">

        <div>

            <ul class="author__content-nav">

                <?php if ( wp_is_mobile() ) : ?>

                    <li class="author__content-nav-item active" data-id="about-me" onclick="activeTab('about-me');">ABOUT ME</li>

                <?php endif; ?>

                <li class="author__content-nav-item" data-id="activity" onclick="activeTab('activity');">LATEST ACTIVITY</li>

                <?php if (get_the_author_meta('is_doctor_premium', $author_id, false)): ?>

                    <li class="author__content-nav-item" data-id="videos" onclick="activeTab('videos');">VIDEOS</li>

                <?php endif;?>

                <li class="author__content-nav-item" data-id="article" onclick="activeTab('article');">ARTICLES</li>

                <li class="author__content-nav-item" data-id="user-reviews" onclick="activeTab('user-reviews');">APP REVIEWS</li>

                <li class="author__content-nav-item" data-id="blog" onclick="activeTab('blog');">BLOG</li>

                <?php if (get_the_author_meta('is_doctor_premium', $author_id, false)): ?>

                    <li class="author__content-nav-item" id="tab-podcast" data-id="podcast" onclick="activeTab('podcast');">PODCASTS</li>

                <?php endif;?>

            </ul>

        </div>

    </div>
    <!-- End Navigation -->

    <?php if ( wp_is_mobile() ) : ?>

        <div class="author__tabs-container__tab -about-me" id="about-me">
            <?php get_template_part('template-parts/authors/about-me')?>
        </div>

    <?php endif; ?>

    <div class="author__tabs-container__tab pb-5 -activity <?php echo (wp_is_mobile() )? 'd-none':'';?>" id="activity" data-category="">
        <?php get_template_part('template-parts/authors/activity')?>
    </div>

    <?php if (get_the_author_meta('is_doctor_premium', $author_id, false)): ?>

        <div class="author__tabs-container__tab pb-5 -videos d-none" id="videos">
            <div class="d-flex flex-row flex-wrap author-posts-container" id="ajax-posts-videos">
                <?php get_template_part('template-parts/authors/videos')?>
            </div>
            <div class="more-posts doctor-profile-load-more d-none" data-page="0" data-id="videos">Load More</div>
        </div>

    <?php endif;?>

    <div class="author__tabs-container__tab pb-5 -article d-none" id="article">
        <div class="d-flex flex-row flex-wrap author-posts-container" id="ajax-posts-article">
            <?php get_template_part('template-parts/authors/articles')?>
        </div>
        <div class="more-posts doctor-profile-load-more d-none" data-page="0" data-id="article">Load More</div>
    </div>

    <div class="author__tabs-container__tab pb-5 -user-reviews d-none" id="user-reviews">
        <div class="d-flex flex-row flex-wrap author-posts-container" id="ajax-posts-user-reviews">
            <?php get_template_part('template-parts/authors/app-reviews')?>
        </div>
        <div class="more-posts doctor-profile-load-more d-none" data-page="0" data-id="user-reviews">Load More</div>
    </div>

    <div class="author__tabs-container__tab pb-5 -blog d-none" id="blog">
        <div class="d-flex flex-row flex-wrap author-posts-container" id="ajax-posts-blog">
            <?php get_template_part('template-parts/authors/blogs')?>
        </div>
        <div class="more-posts doctor-profile-load-more d-none" data-page="0" data-id="blog">Load More</div>
    </div>

    <?php if (get_the_author_meta('is_doctor_premium', $author_id, false)): ?>

        <div class="author__tabs-container__tab pb-5 -podcast d-none" id="podcast">
            <div class="d-flex flex-row flex-wrap author-posts-container" id="ajax-posts-podcast">
                <?php get_template_part('template-parts/authors/podcast')?>
            </div>
            <div class="more-posts doctor-profile-load-more d-none" data-page="0" data-id="podcast">Load More</div>
        </div>

    <?php endif;?>

</div>