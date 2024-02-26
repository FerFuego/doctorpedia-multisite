<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package doctorpedia_theme
 */

get_header('2021');

$author_id = (get_query_var('author') !== 1) ? get_query_var('author') : null;
$avatar = get_avatar_url(get_the_author_meta('ID', $author_id), '200');

set_query_var('author_id', $author_id);
set_query_var('avatar', $avatar);

// Redirect if no Blogger user or hide DD
if ( !validate_blogger($author_id) ) : 
    wp_redirect( esc_url(home_url('/')) ); exit();
endif; ?>

<?php if ( is_user_logged_in() ) : ?>

    <div class="doctor-dashboard__navbar">
        <?php get_template_part('template-parts/authors/navbar');?>
    </div>

<?php endif; ?>

<!-- Page Container -->
<div class="author__container <?php echo ( is_user_logged_in() && !wp_is_mobile() ) ? 'author__container--active' : ''; ?>">

    <!-- First Column Container -->
    <div id="js-author__profile" class="author__profile">
        <?php get_template_part('template-parts/authors/left-column');?>
    </div>

    <!-- End First Column -->

    <!-- Center Column Container -->
    <div id="js-author__content" class="author__content-container">

        <!-- Center Column -->
        <div class="author__content">
            <?php get_template_part('template-parts/authors/center-column');?>
        </div>
        <!-- End Center Column -->

    </div>
    
    <!-- Third Column Show only +1200px -->
    <div class="author__featured" id="js-first-column-premium">

        <div class="author__featured__stiky">

            <!-- Video Presentation  -->
            <?php get_template_part('template-parts/authors/video-presentation');?>

            <!-- Map -->
            <?php get_template_part('template-parts/authors/map');?>

            <!-- Feature Article -->
            <?php get_template_part('template-parts/authors/feature-article');?>

        </div>

    </div>
    <!-- End Third Column -->

</div>
<!-- End Page -->

<!-- Modals -->
<?php if ( is_user_logged_in() && validate_user($author_id)) :
    get_template_part('template-parts/authors/modals/modal', 'bio');
    get_template_part('template-parts/authors/modals/modal', 'education');
    get_template_part('template-parts/authors/modals/modal', 'board-certification');
    get_template_part('template-parts/authors/modals/modal', 'video-example');
    get_template_part('template-parts/authors/modals/modal', 'video-presentation');
    get_template_part('template-parts/authors/modals/modal', 'map-location');
    get_template_part('template-parts/authors/modals/modal', 'expertise');
    get_template_part('template-parts/authors/modals/modal', 'publication-mobile');
    get_template_part('template-parts/authors/modals/modal', 'delete-post');    
endif; ?>

<?php if ( is_user_logged_in() ) :
    get_template_part('template-parts/modals/modal', 'repost');
    get_template_part('template-parts/modals/modal', 'repost-successful');
endif; ?>
<!-- End Modals -->

<?php get_footer();?>