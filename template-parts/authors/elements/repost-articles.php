<!-- Article Head -->
<div class="author__content-post-head" id="post_<?php echo $repost->ID; ?>">

    <!-- Doctor -->
    <div class="author__content-doctor">

        <!-- Doctor Image -->
        <a href="<?php echo get_user_permalink( $repost->post_author ); ?>">
            <div class="author__content-doctor-image" style="background-image: url(<?php echo get_avatar_url(get_the_author_meta('ID', $repost->post_author), '200'); ?>);"></div>
        </a>

        <div class="author__content-doctor-text">
            <!-- Doctor Name -->
            <a href="<?php echo get_user_permalink( $repost->post_author ); ?>" class="author__content-doctor-name"><?php the_author_meta('display_name', $repost->post_author );?></a>
        </div>

    </div>

</div>
<!-- End Article Head -->

<!-- Article Image -->
<div class="author__content-post-image" style="background-image:url(<?php echo ( get_the_post_thumbnail_url( $repost->ID ) ) ? get_the_post_thumbnail_url( $repost->ID, 'large') : IMAGES . '/bg-empty.png'; ?>);"></div>
<!-- End Article Image -->

<!-- Article body -->
<div class="author__content-post-body">

    <p class="author__content-type"><?php echo ($repost->post_type == "article") ? "Article" : "Blog"; ?></p>

    <h2 class="author__content-title"><?php echo $repost->post_title; ?></h2>
        
    <p class="author__content-description"><?php echo custom_trim_excerpt('', $repost->post_content, 35); ?></p>

    <a href="<?php echo get_the_permalink($repost->ID); ?>" target="_blank" class="author__content-cta">Read Article</a>

</div>
<!-- End Article Body -->