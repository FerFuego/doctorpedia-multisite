<!-- Categories Post Preview -->

<?php $categories = wp_get_post_terms( get_the_ID(), 'categories-category' );?>

<div class="blog-post-preview">

    <a href="<?php the_permalink() ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>)" class="trim"></a>
                                    
    <div class="content">

        <a href="<?php the_permalink() ?>">

            <h3><?php echo $categories[0]->name; ?></h3>

            <h2 class="pb-25"><?php the_title() ?></h2>

        </a>

        <?php if ( get_field('short_description') ) : ?>
        
            <p><?php echo get_field('short_description'); ?></p>

        <?php endif; ?>

    </div>

</div>
<!-- End Categories Post Preview -->