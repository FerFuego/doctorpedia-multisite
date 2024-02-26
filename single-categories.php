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

        <?php if ( get_field('source_link')['url'] ) : ?>

            <h3><a href="<?php echo get_field('source_link')['url']; ?>" <?php echo get_field('source_link')['target']; ?>><?php echo get_field('source_link')['title']; ?></a> / </h3>

        <?php else: ?>

            <h3><a href="<?php echo esc_url( home_url('/') ); ?>">Home</a> / <a href="<?php echo esc_url( home_url('/') ); ?>channels">Channels</a> / </h3>

        <?php endif; ?>

        <?php if ( get_field('current_link')['url'] ) : ?>

            <a href="<?php echo get_field('current_link')['url']?>" target="<?php echo get_field('current_link')['url']; ?>" class="styles-none"><?php echo ( wp_is_mobile() ) ? Cadena::corta( get_field('current_link')['title'], 25 ) : get_field('current_link')['title']; ?></a>

        <?php else: ?>

            <a href="<?php the_permalink()?>" class="styles-none"><?php echo ( wp_is_mobile() ) ? Cadena::corta( get_the_title(), 25 ) : get_the_title(); ?></a>

        <?php endif; ?>

    </div>

</div>
<!-- End Navbar -->

<!-- Blog Post Layout-->
<div class="blog-post-container single-blog-page highlight-single-channels-container" id="post-<?php the_ID(); ?>" >

    <div class="container">

        <div class="header position-relative">

            
            <h1>
                
                <div class="pt-3"><?php require_once( __DIR__ .'/template-parts/authors/elements/author-repost-link.php' ); ?></div>
                
                <?php the_title() ?>

            </h1>
                
            <?php require_once(  __DIR__ . '/template-parts/singles/ads.php' ); ?>

            <div class="details d-flex justify-content-between align-items-center">

                <div class="<?php echo ( ! get_field('display_author') ) ? 'author author-avatar' : ''; ?>">

                    <?php if(!get_field('display_author')): ?>
                            
                        <?php echo get_avatar(get_the_author_meta('email'), '32') ?>
                        
                        <span class="author"><?php the_author() ?> </span>

                    <?php endif ?>

                        <span class="date"><?php  the_time('F j, Y') ?></span>

                </div>

                <div class="social-media">

                    <?php echo do_shortcode('[easy-social-share]'); ?>

                </div>

            </div>

        </div>
    
        <?php $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() ); ?>

        <?php $url = wp_get_attachment_url( $post_thumbnail_id );  ?>

        <?php $single_cat_post_id = get_the_ID(); // NO DELETE ?>
    
        <div class="hero-image-container" style="background-image:url(<?php echo $url ?>);">
            
        </div>                        

    </div>
    

    <div class="container single-blog-page-content">

        <div class="body">

            <?php the_content(); ?>  

        </div>

    </div>


</div>

<!-- Related Articles of Category -->

<?php if ( get_field('enable_module', $term->taxonomy.'_'.$term->term_id )[0] !== 'No') : ?>

    <?php require_once( __DIR__ .'/template-parts/taxonomies/channels/related-articles.php' ); ?>

<?php endif; ?>

<div class="container highlight-single-channels-footer">

    <p class="link-to-home">
    
        <a href="<?php echo esc_url( home_url( '/channels' ) ); ?>">Back To Channels</a>
    
    </p>

</div>

<!-- End Blog Post -->

<?php get_footer(); ?>
