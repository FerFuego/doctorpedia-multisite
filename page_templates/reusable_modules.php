<?php /* Template Name: Reusable Modules */ ?>

<?php if (get_field('page_header') == 'true') :
        get_header('landing');
    else : 
        get_header('2021');
    endif;
?>

<div class="reusable-modules mt-5">
    <?php if ( have_rows( 'reusable-modules_flexible-content' ) ) :
        while ( have_rows('reusable-modules_flexible-content' ) ) : the_row(); 
            // Modules
            if ( get_row_layout() == 'affiliate_hero') :
                include( get_template_directory().'/partials/module-begin.php' );
                get_template_part('template-parts/modules/module','affiliate-hero');
                include( get_template_directory().'/partials/module-end.php' );
            elseif( get_row_layout() == 'left_right'):
                include( get_template_directory().'/partials/module-begin.php' );
                get_template_part('template-parts/modules/module','left-right');
                include( get_template_directory().'/partials/module-end.php' );
            elseif( get_row_layout() == 'icon_repeater'):
                include( get_template_directory().'/partials/module-begin.php' );
                get_template_part('template-parts/modules/module','icon-repeater');
                include( get_template_directory().'/partials/module-end.php' );
            elseif ( get_row_layout() == 'icon_text_button') :
                include( get_template_directory().'/partials/module-begin.php' );
                get_template_part('template-parts/modules/module','landing-cta');
                include( get_template_directory().'/partials/module-end.php' );
            elseif ( get_row_layout() == 'text_video') :
                include( get_template_directory().'/partials/module-begin.php' );
                get_template_part('template-parts/modules/module','landing-video');
                include( get_template_directory().'/partials/module-end.php' );
            elseif ( get_row_layout() == 'faqs') :
                include( get_template_directory().'/partials/module-begin.php' );
                get_template_part('template-parts/modules/module','dd-seo-faqs');
                include( get_template_directory().'/partials/module-end.php' );
            elseif ( get_row_layout() == 'featured_videos') :
                include( get_template_directory().'/partials/module-begin.php' );
                get_template_part('template-parts/modules/module','featured_videos');
                include( get_template_directory().'/partials/module-end.php' );
            elseif ( get_row_layout() == 'featured_blogs') :
                include( get_template_directory().'/partials/module-begin.php' );
                get_template_part('template-parts/modules/module','featured_blogs');
                include( get_template_directory().'/partials/module-end.php' );
            elseif ( get_row_layout() == 'channels_specialist' ) :
                include( get_template_directory().'/partials/module-begin.php' );
                get_template_part( 'template-parts/taxonomies/channels/channels-doctors' );
                include( get_template_directory().'/partials/module-end.php' );
            endif;
        endwhile;
    endif; ?>
</div>

<?php get_footer();?>



