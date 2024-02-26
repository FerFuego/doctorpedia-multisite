<?php /* Template Name: Simple */?>

<?php get_header('2021'); ?>

<?php the_post();?>

<!-- Simple Layout-->
<div class="simple-post-container" id="post-<?php the_ID(); ?>" style="<?php echo ( get_field('background_color')[0] == 'White' ) ? 'margin-top: -24px;' : ''; ?>">

    <div class="container <?php echo ( get_field('background_color')[0] == 'White' ) ? 'bg-white' : ''; ?>">

        <div class="header simple-inner-container">

            <h1><?php the_title() ?></h1>

        </div>

    </div>

    <div class="container <?php echo ( get_field('background_color')[0] == 'White' ) ? 'bg-white' : ''; ?>">

        <div class="body simple-inner-container simple-template">

            <?php the_content() ?> 

        </div>

    </div>

</div>

<?php get_footer(); ?>