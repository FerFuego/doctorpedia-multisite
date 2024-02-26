<?php /* Template Name: Resources */?>

<?php get_header('secondary'); ?>

<?php the_post();?>

<!-- Secondary Header Module -->
<div class="secondary-header">

    <div class="container">

        <img src="<?php echo IMAGES; ?>/clipboard icon.svg" alt="">

        <div class="page-title">

            <h1><?php the_field('title_section')?></h1>

            <p><?php the_field('description_section')?></p>

        </div>

    </div>

</div>
<!-- Secondary Header Module -->

<div class="large-container">

<?php the_content() ?>

<?php get_footer(); ?>
