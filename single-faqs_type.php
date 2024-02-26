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

<!-- Navbar -->
<div class="single-app-review-navbar">

    <div class="container">

        <?php if ( get_field('source_link')['url'] ) : ?>

            <h3><a href="<?php echo get_field('source_link')['url']; ?>" <?php echo get_field('source_link')['target']; ?>><?php echo get_field('source_link')['title']; ?></a> / </h3>

            <a href="<?php echo get_field('current_link')['url']?>" target="<?php echo get_field('current_link')['url']; ?>" class="styles-none"><?php echo ( wp_is_mobile() ) ? Cadena::corta( get_field('current_link')['title'], 25 ) : get_field('current_link')['title']; ?></a>

        <?php else: ?>

            <h3><a href="<?php echo esc_url( home_url('/') ); ?>faqs">FAQ's</a> / </h3>

            <a href="<?php the_permalink()?>" class="styles-none"><?php echo ( wp_is_mobile() ) ? Cadena::corta( get_the_title(), 25 ) : get_the_title(); ?></a>

        <?php endif; ?>

    </div>

</div>
<!-- End Navbar -->

<!-- Blog Post Layout-->
<div class="blog-post-container single-blog-page" id="post-<?php the_ID(); ?>" >

    <div class="container">

        <div class="header">

            <h1><?php the_title() ?></h1>

            <div class="details d-flex justify-content-between align-items-center">

                <div></div>

                <div class="social-media">

                    <?php echo do_shortcode('[easy-social-share]'); ?>

                </div>

            </div>

        </div>
    
        <?php $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() ); ?>

        <?php $url = wp_get_attachment_url( $post_thumbnail_id );  ?>

    </div>
    
    <img class="main-post-img" src="<?php echo $url ?>" alt="">

    <div class="container single-blog-page-content">

        <div class="body">

            <?php the_content(); ?>  

            <div class="navigation">

                <?php previous_post_link('<div class="navigation__link"><img src="'. IMAGES .'/icons/prev.svg"> %link</div>'); ?>    
                
                <?php next_post_link('<div class="navigation__link">%link <img src="'. IMAGES .'/icons/next.svg"></div>'); ?>

            </div>

        </div>

    </div>

    <?php $post_ID = get_the_ID(); ?>

</div>
<!-- End Blog Post -->

<?php get_footer(); ?>
