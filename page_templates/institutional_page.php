<?php /* Template Name: Institutional */?>

<?php get_header('2021'); ?>

<?php the_post() ?>

<div class="institutional-page"> 

    <img class="main-post-img" src="<?php the_field('header_image') ?>" alt="">

    <?php if(get_field('text')): ?>
        <div class="block-principal">
            <h3><?php the_field('text')?></h3>
        </div>
    <?php endif; ?>
    
    <div class="body blog-inner-container">
        <?php the_content() ?>  
    </div>

</div>

<?php get_footer() ?>