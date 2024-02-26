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

<!-- Breadcrumbs -->
<?php require_once(  __DIR__ . '/template-parts/team/breadcrumbs.php' ); ?>

<!-- Blog Post Layout-->
<div class="blog-post-container single-blog-page" id="post-preview" >
    
    <!-- Profile -->
    <?php require_once(  __DIR__ . '/template-parts/team/profile.php' ); ?>
    
</div>
<!-- End Blog Post -->

<?php get_footer(); ?>