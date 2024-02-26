<?php /* Template Name: Leverage Growth */ ?>

<?php get_header('leverage');?>

<div class="reusable-modules leverage-growth">
    <?php if ( have_rows( 'reusable-modules_flexible-content' ) ) :
        while ( have_rows('reusable-modules_flexible-content' ) ) : the_row(); 
            // Modules
            if ( get_row_layout() == 'affiliate_hero') :
                include( get_template_directory().'/partials/module-begin.php' );
                get_template_part('template-parts/modules/module','affiliate-hero');
                include( get_template_directory().'/partials/module-end.php' );
                get_template_part('template-parts/modals/modal','terms&conditions' );
                get_template_part('template-parts/modals/modal','form-register' );
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
            endif;
        endwhile;
    endif; ?>

</div>

<?php get_footer();?>

