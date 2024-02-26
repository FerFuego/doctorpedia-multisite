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

<?php setPostViews( $post_ID ); ?><!-- Count Visit Post -->

<div class="single-blogging-page">

    <!-- Navbar -->
    <div class="single-app-review-navbar">

        <div class="container">

           <h2>Leading Voices</h2>

        </div>

    </div>
    <!-- End Navbar -->

    <!-- Blog Post Layout-->
    <div class="blog-post-container single-blog-page single-blogging-page__container" id="post-<?php echo $post_ID; ?>" >

        <div class="container">

            <div class="header position-relative">

                <?php require_once( __DIR__ .'/template-parts/authors/elements/author-repost-link.php' ); ?>

                <a href="<?php echo esc_url( home_url('/blogs') ); ?>"><img src="<?php echo IMAGES; ?>/arrow-left-min.svg" alt=""> Back to Blog Homepage</a>

                <h1 class="mt-3"><?php the_title() ?></h1>

                <?php if ( get_field('subtitle') ) : ?>
        
                    <h2 class="pt-2 mt-0"><?php echo get_field('subtitle'); ?></h2>

                <?php endif; ?>

                <div class="details d-sm-flex justify-content-between align-items-center <?php echo wp_is_mobile() ? 'flex-column':''; ?>">

                    <div class="<?php echo ( ! get_field('display_author') ) ? 'author-avatar' : ''; ?>">

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
                        <p class="post-share-title d-block <?php echo wp_is_mobile() ? 'text-center':'text-right'; ?> mb-2">Share on:</p>
                        <?php echo do_shortcode('[easy-social-share]'); ?>
                    </div>

                </div>

            </div>

            <img class="main-post-img" src="<?php echo get_the_post_thumbnail_url( get_the_ID() , 'full'); ?>" >

            <div class="container single-blog-page-content single-blogging-page__container__content">

                <div class="body">

                    <?php the_content(); ?>  

                    <script>
                        var images = document.querySelectorAll(".body img");
                        for (var i = 0; i < images.length; i++) {
                            var image = images[i];
                            var src = image.getAttribute('src');
                            var new_src = 'data:' + src;
                            image.setAttribute('src', new_src);
                        }

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
                    </script>

                </div>

            </div>

        </div>

    </div>
    <!-- End Blog Post -->

    <?php require_once( __DIR__ .'/template-parts/singles/popular-articles.php' ); ?>

</div>

<?php get_footer(); ?>
