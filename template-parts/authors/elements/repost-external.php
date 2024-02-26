<?php $data = get_external_data( get_field('share_external_link') ); ?>

<a href="<?php echo get_field('share_external_link'); ?>" target="_blank">
    <!-- Article Image -->
    <div class="author__content-post-image" style="background-image:url(<?php echo ( $data ) ? $data['image'] : IMAGES . '/bg-empty.png'; ?>); background-position: center center;"></div>
    <!-- End Article Image -->

    <!-- Article body -->
    <div class="author__content-post-body repost-external_link">
        <h2 class="author__content-title"><?php echo $data['title']; ?></h2>
        <p class="author__content-description"><?php echo custom_trim_excerpt('', $data['description'], 35); ?></p>
        <a href="<?php echo get_field('share_external_link'); ?>" target="_blank" class="author__content-cta">View Link</a>
    </div>
</a>
<!-- End Article Body -->