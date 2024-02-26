<?php
$title = $args['title'];
$authorName = $args['author'];
$avatar = $args['avatar'];
$duration = $args['duration'];
$specialty = $args['specialty'];
$thumbnail = $args['thumbnail'];
$permalink = $args['permalink'];
?>

<article class="m-latest-videos__video">
    <div class="m-latest-videos__video-container">
        <div class="m-latest-videos__thumbnail">
            <a href="<?php echo esc_url($permalink); ?>">
                <div class="m-latest-videos__thumbnail-img">
                    <img class="m-latest-videos__thumbnail-bg" src="<?= $thumbnail ? $thumbnail : get_template_directory_uri() . '/img/placeholders/slider-2/img-3.png'; ?>" alt="img">
                    <img class="m-latest-videos__thumbnail-icon" src="<?php echo get_theme_file_uri('/img/icons/play-btn-latestvideos.svg'); ?>" alt="Play Icon">
                </div>

                <?php if ($duration) : ?><span class="m-latest-videos__thumbnail-duration"><?php echo esc_html($duration); ?></span><?php endif; ?>
                <a class="m-latest-videos__thumbnail-author" href="<?php echo esc_url($permalink); ?>">
                    <img class="m-latest-videos__thumbnail-author-avatar" src="<?php echo $avatar; ?>" alt="<?php echo $authorName; ?>">
                    <div class="m-latest-videos__thumbnail-author-data">
                        <p class="m-latest-videos__thumbnail-author-name"><?php echo esc_html($authorName); ?></p>
                        <p class="m-latest-videos__thumbnail-author-spec"><?php echo esc_html($specialty); ?></p>
                    </div>
                </a>
            </a>
        </div>
        <a class="m-latest-videos__title" href="<?php echo esc_url($permalink); ?>">
            <h3 class="m-latest-videos__title-text">
                <?php
                echo mb_strimwidth($title, 0, 83, '...');
                ?>
            </h3>
        </a>
    </div>
</article>