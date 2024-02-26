<?php
    $title = get_sub_field('l_videos_title');
    $subtitle = get_sub_field('l_videos_subtitle');
    $switch = get_sub_field('l_videos_switch');
    $selectVideos = get_sub_field('select_videos');
?>

<section class="m-latest-videos">
    <div class="m-latest-videos__container container-big">
        <div class="m-latest-videos__heading">
            <h2 class="m-latest-videos__heading-title"><?php echo esc_html($title); ?></h2>
            <p class="m-latest-videos__heading-subtitle"><?php echo esc_html($subtitle); ?></p>
        </div>
        <div class="m-latest-videos__grid">
            <?php
                if ($switch) {
                    foreach ($selectVideos as $video) {
                        $args = [
                            'title' => $video->post_title,
                            'author' => get_author_name($video->post_author),
                            'avatar' => get_avatar_url($video->post_author, '32'),
                            'duration' => get_field('video_duration', $video->ID),
                            'specialty' => get_field('bb_specialties', 'user_' . $video->post_author)[0]['specialty'],
                            'thumbnail' => get_the_post_thumbnail_url($video->ID),
                            'permalink' => get_the_permalink($video->ID)
                        ];
                        get_template_part('template-parts/components/latest', 'videos', $args);
                    }
                    wp_reset_postdata();
                } else {
                    $args = array(
                        'post_type'      => 'videos',
                        'posts_per_page' => 6,
                    );
                    $loop = new WP_Query($args);
                    while ( $loop->have_posts() ) {
                        $loop->the_post();
                        $authorId = get_post_field('post_author', get_the_ID());
                        $args = [
                            'title' => get_the_title(),
                            'author' => get_the_author_meta('display_name', $authorId),
                            'avatar' => get_avatar_url($authorId, '32'),
                            'duration' => get_field('video_duration'),
                            'specialty' => get_field('bb_specialties', 'user_' . $authorId)[0]['specialty'],
                            'thumbnail' => get_the_post_thumbnail_url(),                            
                            'permalink' => get_the_permalink()
                        ];
                        get_template_part('template-parts/components/latest', 'videos', $args);
                    }
                    wp_reset_postdata();
                }
                ?>
        </div>
    </div>
</section>