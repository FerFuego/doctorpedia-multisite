<?php /* Template Name: Homepage Doctorpedia */ ?>

<?php get_header('2021');?>

<div class="homepage_doctorpedia">

<?php if ( have_rows( 'home_flexible-content' ) ) :

    while ( have_rows('home_flexible-content' ) ) : the_row(); 

        $module = get_row_layout();

        if ( $module == 'header_search' ) :
            get_template_part('template-parts/modules/module','search');
            
        elseif ( $module == 'our_experts') :
            get_template_part('template-parts/modules/module','our_experts');

        elseif ( $module == 'featured_webcast') :
            get_template_part('template-parts/modules/module','featured_webcast');

        elseif ( $module == 'featured_channels') :
            get_template_part('template-parts/modules/module','featured_channels');

        elseif ( $module == 'featured_videos') :
            get_template_part('template-parts/modules/module','featured_videos');
            
        elseif ( $module == 'featured_mobile_apps') :
            get_template_part('template-parts/modules/module','featured_mobile_apps');

        elseif ( $module == 'featured_sites') :
            get_template_part('template-parts/modules/module','featured_sites');

        elseif ( $module == 'featured_blogs') :
            get_template_part('template-parts/modules/module','featured_blogs');

        elseif ( $module == 'newsletter') :
            get_template_part('template-parts/modules/module','newsletter');
        
        elseif ( get_row_layout() == 'explore') :
            get_template_part('template-parts/modules/module','explore');

        elseif ( get_row_layout() == 'profile_promotion') :
            get_template_part('template-parts/modules/module','profile-promotion');
            
        elseif ( get_row_layout() == 'interest_channels') :
            get_template_part('template-parts/modules/module','interest-channels');

        elseif ( get_row_layout() == 'latest_videos') :
            get_template_part('template-parts/modules/module','latest_videos');
    
        elseif ( get_row_layout() == 'meet_our_doctors') :
            get_template_part('template-parts/modules/module','meet-our-doctors');

        endif;
        
    endwhile;

endif; ?>

</div>

<?php get_footer();?>