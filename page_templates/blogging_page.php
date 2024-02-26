<?php /* Template Name: Blogging */ ?>

<?php get_header('2021'); ?>

<?php the_post();?>

<div class="doctorpedia-channels-pro blogging-page">

    <div class="blogging-header__channel-header fix-header-blogging">

        <div class="blogging-header__channel-header-container container">

            <h1>Leading Voices</h1>

        </div>

    </div>

    <?php the_content(); ?>
    
</div>

<?php get_footer(); ?>