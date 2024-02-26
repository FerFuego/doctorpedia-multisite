<?php /* Template Name: Doctor Directory */ ?>

<?php get_header('2021');?>

<div class="doctor-directory-page">

    <?php if ( have_rows( 'dd_flexible-content' ) ) :

        while ( have_rows('dd_flexible-content' ) ) : the_row(); 

            if ( get_row_layout() == 'directory_content' ) :
                
                get_template_part( 'template-parts/modules/module','hero' );
                
                if ( get_sub_field('show_search') ) :
                    get_template_part( 'partials/animations-header' );
                    get_template_part( 'partials/experts-grid' );
                else :
                    echo "<script>$('.doctor-directory-page').addClass('doctor-directory-landing');</script>";
                    get_template_part( 'template-parts/modules/module','experts-grid' );
                endif;

            elseif ( get_row_layout() == 'dd_seo_items_rows') :
                get_template_part('template-parts/modules/module','dd-seo-rows');

            elseif ( get_row_layout() == 'dd_seo_find_doctors') :
                get_template_part('template-parts/modules/module','dd-seo-find-doctor');
                
            elseif ( get_row_layout() == 'dd_seo_faqs') :
                get_template_part('template-parts/modules/module','dd-seo-faqs');

            endif;

        endwhile;

    endif; ?>

    <?php get_template_part( 'partials/animations-footer' ); ?>

</div>

<?php get_footer();?>