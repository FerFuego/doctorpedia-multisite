<?php
$user_id = (isset($user->ID)) ? $user->ID : $user['ID'];

$metadata = get_user_meta($user_id);
$avatar = get_avatar_url($user_id, '32');
$name = @$metadata['nickname'][0];
$specialty = get_field('bb_specialties', 'user_' . $user_id)[0]['specialty'];
$nicename = (isset($user->user_nicename)) ? $user->user_nicename : $user['user_nicename'];
$link = esc_url(home_url('/doctor-profile/' . $nicename));
$docVideosUrl = esc_url(home_url('/doctor-profile/' . $nicename . '/#videos'));
$docReviewsUrl = esc_url(home_url('/doctor-profile/' . $nicename . '/#user-reviews'));
$docArticlesUrl = esc_url(home_url('/doctor-profile/' . $nicename . '/#article'));
$city = @$metadata['city'][0];
$state = @$metadata['state'][0];
$totalVideos = @$metadata['c_videos'][0];
$totalArticles = @$metadata['c_articles'][0];
$totalReviews = @$metadata['c_reviews'][0];
$totalFeatures = [$totalVideos, $totalArticles, $totalReviews];
$countFeatures = count(array_keys($totalFeatures, '0'));
?>

<article class="doctor-card">

    <a class="doctor-card__user" href="<?php echo $link; ?>">
        <img class="doctor-card__user-avatar" src="<?php echo esc_url($avatar); ?>" alt="Avatar">
        <div class="doctor-card__user-info">
            <p class="doctor-card__user-name"><?php echo esc_html($name); ?></p>
            <p class="doctor-card__user-specialty"><?php echo esc_html($specialty); ?></p>
        </div>
    </a>

    <?php
    if ($totalVideos || $totalArticles || $totalReviews) :
    ?>
        <div class="doctor-card__features <?php if ($countFeatures == 1) {
                                                echo 'double-columns';
                                            } elseif ($countFeatures == 2) {
                                                echo 'single-column';
                                            } ?>">

            <?php if ($totalVideos > 0) : ?>
                <a href="<?php echo $docVideosUrl; ?>">
                    <div class="doctor-card__features-info">
                        <p class="doctor-card__features-number"><?php echo esc_html($totalVideos); ?></p>
                        <p class="doctor-card__features-feature">Videos</p>
                    </div>
                </a>
            <?php endif; ?>

            <?php if ($totalArticles > 0) : ?>
                <a href="<?php echo $docArticlesUrl; ?>">
                    <div class="doctor-card__features-info">
                        <p class="doctor-card__features-number"><?php echo esc_html($totalArticles); ?></p>
                        <p class="doctor-card__features-feature">Articles</p>
                    </div>
                </a>
            <?php endif; ?>

            <?php if ($totalReviews > 0) : ?>
                <a href="<?php echo $docReviewsUrl; ?>">
                    <div class="doctor-card__features-info">
                        <p class="doctor-card__features-number"><?php echo esc_html($totalReviews); ?></p>
                        <p class="doctor-card__features-feature">Reviews</p>
                    </div>
                </a>
            <?php endif; ?>
        </div>

    <?php endif; ?>

    <ul class="doctor-card__videos">
        <?php
        $args = [
            'post_type' => 'videos',
            'author__in' => $user_id,
            'posts_per_page' => '2'
        ];

        $loop = new WP_Query($args);
        while ($loop->have_posts()) :
            $loop->the_post();
            $thumbnail = get_the_post_thumbnail_url();
            $duration = get_field('video_duration');
        ?>

            <li>
                <a href="<?php the_permalink(); ?>">
                    <div class="doctor-card__video">
                        <img class="doctor-card__video-thumbnail" src="<?php echo esc_url($thumbnail); ?>" alt="Video Thumbnail">
                        <img class="doctor-card__video-play-icon" src="<?php echo get_theme_file_uri('/img/icons/video-play.svg') ?>" alt="Play Icon">
                        <?php if ($duration) : ?>
                            <p class="doctor-card__video-duration"><?php echo esc_html($duration); ?></p>
                        <?php endif; ?>
                    </div>
                </a>
            </li>

        <?php endwhile;
        wp_reset_postdata();
        ?>
    </ul>

    <div class="doctor-card__profile">
        <a class="doctor-card__profile-cta" href="<?php echo $link; ?>">See Profile</a>
        <?php if ($city || $state) : ?>
            <p class="doctor-card__profile-location"><?php echo esc_html($city); ?>, <?php echo esc_html($state); ?></p>
        <?php endif; ?>
    </div>

</article>