<?php /* Template Name: Crowdfunding */ ?>

<?php get_header('2021');?>

<div class="crowdfunding-page">

    <?php get_template_part('template-parts/modules/module','cf-hero'); ?>

    <?php get_template_part('template-parts/modules/module','cf-mission'); ?>

    <?php get_template_part('template-parts/modules/module','cf-marquee'); ?>

    <?php get_template_part('template-parts/modules/module','cf-video-popup'); ?>

    <?php get_template_part('template-parts/modules/module','cf-invest'); ?>

    <?php get_template_part('template-parts/modules/module','cf-register'); ?>

    <?php get_template_part('template-parts/modules/module','cf-faqs'); ?>

    <?php get_template_part('template-parts/modules/module','cf-contact-us'); ?>

</div>

<?php get_footer();?>