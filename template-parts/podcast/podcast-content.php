<div class="podcast-content">
    
    <div class="container">
        
        <div class="podcast-content__content">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'template-parts/podcast/elements/element', 'box-item' ); ?>

            <?php endwhile; ?>

            <?php wp_reset_query(); ?>

        </div>

    </div>

</div>