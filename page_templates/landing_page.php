<?php /* Template Name: Doctor Platform Landing Page */ ?>

<?php get_header('landing');?>

<div class="landing-page" style="position: relative;">

    <?php get_template_part('template-parts/modules/module','pre-register'); ?>

    <?php if ( have_rows( 'landing_flexible-content' ) ) :

        while ( have_rows('landing_flexible-content' ) ) : the_row(); 

            if ( get_row_layout() == 'landing_hero' ) :
                get_template_part('template-parts/modules/module','landing-hero');
                
            elseif ( get_row_layout() == 'landing_plataform') :
                get_template_part('template-parts/modules/module','landing-plataform');

            elseif ( get_row_layout() == 'landing_video_library') :
                get_template_part('template-parts/modules/module','landing-video-library');

            elseif ( get_row_layout() == 'landing_services') :
                get_template_part('template-parts/modules/module','landing-services');

            elseif ( get_row_layout() == 'landing_testimonials') :
                get_template_part('template-parts/modules/module','landing-testimonials');

            elseif ( get_row_layout() == 'landing_needs') :
                get_template_part('template-parts/modules/module','landing-needs');

            elseif ( get_row_layout() == 'landing_video') :
                get_template_part('template-parts/modules/module','landing-video');

            elseif ( get_row_layout() == 'landing_slide_doctors') :
                get_template_part('template-parts/modules/module','landing-marquee');

            elseif ( get_row_layout() == 'landing_text_image') :
                get_template_part('template-parts/modules/module','landing-text-image');

            elseif ( get_row_layout() == 'landing_cta') :
                get_template_part('template-parts/modules/module','landing-cta');

            elseif ( get_row_layout() == 'dd_seo_items_rows') :
                get_template_part('template-parts/modules/module','dd-seo-rows');

            elseif ( get_row_layout() == 'dd_seo_find_doctors') :
                get_template_part('template-parts/modules/module','dd-seo-find-doctor');
                
            elseif ( get_row_layout() == 'dd_seo_faqs') :
                get_template_part('template-parts/modules/module','dd-seo-faqs');
                
            elseif ( get_row_layout() == 'featured_videos') :
                get_template_part('template-parts/modules/module','featured_videos');

            endif;
            
        endwhile;

    endif; ?>

</div>

<?php get_footer();?>