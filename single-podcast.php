<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package doctorpedia_theme
 */
?>
<?php get_header('2021'); ?>

<?php the_post(); ?>

<?php $post_ID = get_the_ID(); ?>

<style>
    .large-container,
    .single-app-review-navbar {
        background-color: #F2F2F2 !important;
        border-bottom: 0;
    }

    .large-container,
    .single-app-review-navbar .container {
        border-bottom: 1px solid #cccccc;
    }
</style>

<!-- Navbar -->
<div class="single-app-review-navbar">

    <div class="container">

        <?php if (get_field('source_link')) : ?>

            <h3><a href="<?php echo get_field('source_link')['url']; ?>" <?php echo get_field('source_link')['target']; ?>><?php echo get_field('source_link')['title']; ?></a> / </h3>

        <?php else : ?>

            <h3><a href="<?php echo esc_url(home_url('/podcast')); ?>">Podcast</a> / </h3>

        <?php endif; ?>

        <?php if (get_field('current_link')) : ?>

            <a href="<?php echo get_field('current_link')['url'] ?>" target="<?php echo get_field('current_link')['url']; ?>" class="styles-none"><?php echo (wp_is_mobile()) ? Cadena::corta(get_field('current_link')['title'], 25) : get_field('current_link')['title']; ?></a>

        <?php else : ?>

            <a href="<?php the_permalink() ?>" class="styles-none"><?php echo (wp_is_mobile()) ? Cadena::corta(get_the_title(), 25) : get_the_title(); ?></a>

        <?php endif; ?>

    </div>

</div>
<!-- End Navbar -->

<!-- Blog Post Layout-->
<div class="blog-post-container single-blog-page single-podcast-container">

    <div class="container">

        <div class="single-podcast-container__header" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>');">

            <div class="single-podcast-container__header__content">

                <h1><?php the_title(); ?></h1>

                <div class="single-podcast-container__header__content__cta">

                    <div class="cta-to-single">

                        <div id="js-player-podcast" class="box-player d-none">

                            <?php echo do_shortcode(get_field('podcast')); ?>

                        </div>

                        <a href="#" onclick="playPodcastSingle();" class="cta-play js-play-button"><img src="<?php echo IMAGES; ?>/icons/min-play-white.svg"> PLAY</a>

                        <div class="span js-play-button"><?php echo get_field('time'); ?></div>

                    </div>

                    <div class="cta-to-external">

                        <?php if (get_field('link_apple')) : ?>

                            <a href="<?php echo get_field('link_apple'); ?>" target="_blank"><img src="<?php echo IMAGES; ?>/icons/apple_podcast.svg" alt=""> Apple Podcast</a>

                        <?php endif; ?>

                        <?php if (get_field('link_spotify')) : ?>

                            <a href="<?php echo get_field('link_spotify'); ?>" target="_blank"><img src="<?php echo IMAGES; ?>/icons/spotify.svg" alt=""> Spotify</a>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="container single-blog-page-content">

        <div class="body">

            <div class="single-podcast-expert">

                <div class="single-podcast-expert__profile">

                    <img src="<?php echo get_field('profile')['url']; ?>">

                </div>

                <div class="single-podcast-expert__bio">

                    <?php if (get_field('expert_link')) : ?>

                        <a href="<?php echo get_field('expert_link')['url']; ?>" class="mt-0" target="<?php echo get_field('expert_link')['target']; ?>">
                            <h3><?php echo get_field('name'); ?></h3>
                        </a>

                    <?php else : ?>

                        <h3><?php echo get_field('name'); ?></h3>

                    <?php endif; ?>

                    <h4><?php echo get_field('specialty'); ?></h4>

                    <?php echo get_field('expert_bio'); ?>

                    <?php if (get_field('expert_link')) : ?>

                        <a href="<?php echo get_field('expert_link')['url']; ?>" class="link-bio" target="<?php echo get_field('expert_link')['target']; ?>"><?php echo get_field('expert_link')['title']; ?></a>

                    <?php endif; ?>

                </div>

            </div>

            <?php if (have_rows('co-authors')) : ?>

                <div class="co-authors">

                    <?php while (have_rows('co-authors')) : the_row(); ?>

                        <div class="single-podcast-expert">

                            <div class="single-podcast-expert__profile">

                                <img src="<?php echo get_sub_field('profile')['url']; ?>">

                            </div>

                            <div class="single-podcast-expert__bio">

                                <?php if (get_sub_field('expert_link')) : ?>

                                    <a href="<?php echo get_sub_field('expert_link')['url']; ?>" class="mt-0" target="<?php echo get_sub_field('expert_link')['target']; ?>">
                                        <h3><?php echo get_sub_field('name'); ?></h3>
                                    </a>

                                <?php else : ?>

                                    <h3><?php echo get_sub_field('name'); ?></h3>

                                <?php endif; ?>

                                <h4><?php echo get_sub_field('specialty'); ?></h4>

                                <?php echo get_sub_field('expert_bio'); ?>

                                <?php if (get_sub_field('expert_link')) : ?>

                                    <a href="<?php echo get_sub_field('expert_link')['url']; ?>" class="link-bio" target="<?php echo get_sub_field('expert_link')['target']; ?>"><?php echo get_sub_field('expert_link')['title']; ?></a>

                                <?php endif; ?>

                            </div>

                        </div>

                    <?php endwhile; ?>

                </div>

            <?php endif; ?>

            <div>
                <div class="shared-links">

                    <?php echo do_shortcode('[easy-social-share ukey="1571255022"]'); ?>

                </div>

                <?php the_content(); ?>

            </div>

        </div>

    </div>

</div>
<!-- End Blog Post -->

<?php require_once(__DIR__ . '/template-parts/authors/elements/author-repost-link.php'); ?>

<?php get_footer(); ?>