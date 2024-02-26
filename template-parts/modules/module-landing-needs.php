<?php $slider_id = rand(0,999999); ?>

<section class="m-landing-needs">
    <div class="m-landing-needs__primary_box container">
        <h3 class="m-landing-needs__title"><?php echo get_sub_field('m-landing-needs__title');?></h3>
        <div class="m-landing-needs__copy"><?php echo get_sub_field('m-landing-needs__copy');?></div>
    </div>

    <div class="m-landing-needs__slider container">
        <?php get_template_part( 'partials/featured-webs');?>
    </div>

    <span class="square" index="1"></span>
    <span class="square" index="3"></span>
    <span class="square" index="2"></span>
</section>