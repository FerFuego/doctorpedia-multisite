<?php get_header('2021'); ?>

<div class="simple-page podcast-taxonomy-container">

    <?php get_template_part( 'template-parts/podcast/podcast', 'hero' ); ?>

    <div class="blog-posts-page-container">

        <?php get_template_part( 'template-parts/podcast/podcast', 'header' ); ?>

        <?php get_template_part( 'template-parts/podcast/podcast', 'content' ); ?>

    </div>

</div>

<?php get_footer(); ?>