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

<!-- Navbar -->
<div class="single-app-review-navbar">

    <div class="container">

        <?php if ( get_field('source_link') ) : ?>

            <h3><a href="<?php echo get_field('source_link')['url']; ?>" <?php echo get_field('source_link')['target']; ?>><?php echo get_field('source_link')['title']; ?></a> / </h3>

        <?php else: ?>

            <h3><a href="<?php echo esc_url( home_url('/') ); ?>articles">Articles</a> / </h3>

        <?php endif; ?>

        <?php if ( get_field('current_link') ) : ?>

            <a href="<?php echo get_field('current_link')['url']?>" target="<?php echo get_field('current_link')['url']; ?>" class="styles-none"><?php echo ( wp_is_mobile() ) ? Cadena::corta( get_field('current_link')['title'], 25 ) : get_field('current_link')['title']; ?></a>

        <?php else: ?>

            <a href="<?php the_permalink()?>" class="styles-none"><?php echo ( wp_is_mobile() ) ? Cadena::corta( get_the_title(), 25 ) : get_the_title(); ?></a>

        <?php endif; ?>


    </div>

</div>
<!-- End Navbar -->

<!-- Blog Post Layout-->
<div class="blog-post-container single-blog-page" id="post-<?php the_ID(); ?>" >

    <div class="container">

        <div class="header position-relative pt-4">
            
            <?php require_once( __DIR__ .'/template-parts/authors/elements/author-repost-link.php' ); ?>

            <?php if ( get_field('subtitle') ) : ?>
                
                <h2 class="mt-0"><?php echo get_field('subtitle'); ?></h2>

            <?php endif; ?>

            <h1 class="<?php echo ( get_field('subtitle') ) ? 'pt-1' : ''; ?>"><?php the_title() ?></h1>
                
            <?php require_once(  __DIR__ . '/template-parts/singles/ads.php' ); ?>

            <div class="details d-sm-flex justify-content-between align-items-center <?php echo wp_is_mobile() ? 'flex-column':''; ?>">

                <div class="<?php echo ( ! get_field('display_author') ) ? 'author author-avatar' : ''; ?>">

                    <?php if(!get_field('display_author') && get_user_permalink( get_queried_object()->post_author )): ?>

                        <?php if ( get_user_permalink( get_queried_object()->post_author )) : ?>
                            <a href="<?php echo get_user_permalink( get_queried_object()->post_author ); ?>" class="d-flex post-author-hover">
                        <?php else : ?>
                            <div class="d-flex">
                        <?php endif; ?>

                                <?php echo get_avatar(get_the_author_meta('email'), '32') ?>
                                
                                <span class="author"><?php echo get_the_author_meta('display_name'); ?> </span>
                            
                        <?php if ( get_user_permalink( get_queried_object()->post_author )) : ?>
                            </a>
                        <?php else : ?>
                            </div>
                        <?php endif; ?>

                    <?php endif ?>

                    <span class="date"><?php  the_time('F j, Y') ?></span>

                </div>

                <div class="social-media <?php echo wp_is_mobile() ? 'mt-5':''; ?>">
                    <p class="post-share-title d-block <?php echo wp_is_mobile() ? 'text-center':'text-right'; ?>">Share on:</p>
                    <?php echo do_shortcode('[easy-social-share]'); ?>
                </div>

            </div>

        </div>

    </div>
    
    <img class="main-post-img" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?>" alt="">

    <div class="container single-blog-page-content">

        <div class="body single-article">

            <?php the_content(); ?>

        </div>

    </div>

    <?php require_once( __DIR__ .'/template-parts/authors/elements/author-repost-link.php' ); ?>

</div>
<!-- End Blog Post -->

<?php get_footer(); ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        /* var images = document.querySelectorAll(".body img");
        for (var i = 0; i < images.length; i++) {
            var image = images[i];
            var src = image.getAttribute('src');
            var new_src = 'data:' + src;
            image.setAttribute('src', new_src);
        } */
        var links = document.querySelectorAll(".body a");
        for (var x = 0; x < links.length; x++) {
            var link = links[x];
            var href = link.getAttribute('href');
            var n = href.search("http");
            if ( n == '-1') {
                var new_href = 'https://' + href;
                link.setAttribute('href', new_href);
            }
        }
    });
</script>