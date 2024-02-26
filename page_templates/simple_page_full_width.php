<?php /* Template Name: Simple Full Width */?>

<?php get_header('secondary'); ?>

<?php the_post();?>

<!-- Simple Layout-->
<div class="simple-post-container" id="post-<?php the_ID(); ?>" >
    <div class="container-fluid">
        <div class="header">
            <h1><?php the_title() ?></h1>
        </div>
    </div>
    <div class="container-fluid">
        <div class="body">
            <?php the_content() ?>  
        </div>
    </div>

</div>

<?php get_footer(); ?>