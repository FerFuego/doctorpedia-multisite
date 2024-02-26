<?php /* Template Name: Doctor Affiliate Landing Page */ ?>

<?php get_header('landing');?>

<div class="affiliate-page">

    <?php if ( have_rows( 'affiliate_flexible-content' ) ) :
        while ( have_rows('affiliate_flexible-content' ) ) : the_row(); 
            // Modules
            if ( get_row_layout() == 'affiliate_hero') :
                get_template_part('template-parts/modules/module','affiliate-hero');
            elseif ( get_row_layout() == 'landing_services') :
                get_template_part('template-parts/modules/module','landing-services');
            elseif ( get_row_layout() == 'landing_testimonials') :
                get_template_part('template-parts/modules/module','landing-testimonials');
            elseif ( get_row_layout() == 'affiliate_cta') :
                get_template_part('template-parts/modules/module','affiliate-be-part');
            endif;
        endwhile;
    endif; ?>

    <img src="<?php echo IMAGES .'/affiliate/rectangle-left.svg';?>" class="affiliate-page__rectangle-left">
    <img src="<?php echo IMAGES .'/affiliate/rectangle-center.svg';?>" class="affiliate-page__rectangle-center">
    <img src="<?php echo IMAGES .'/affiliate/rectangle-right.svg';?>" class="affiliate-page__rectangle-right">

</div>

<?php get_footer();?>

<script>
/**
 * Event scroll white header
 */
$(document).ready(function(){
    $(window).on('scroll', function () {
        console.log($(window).scrollTop())
        if ( $(window).scrollTop() > 10 ) {
            $('.site-header').css('background-color','#fff')
        } else { // Si no
            $('.site-header').css('background-color','transparent')
        }
    });
});
</script>