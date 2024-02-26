<?php  while ( have_posts() ) : the_post(); $count++; ?>
    <div class="blog-post-preview">
        <a
            href="<?php echo get_the_permalink(); ?>"
            target="_blank"
            class="trim"
            <?php if ( get_the_post_thumbnail_url(get_the_ID(), 'medium') ) : ?>
                style="background-image:url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>)"
            <?php else: $count <= 6 ?: $count=1; ?>
                style="background-image:url('/wp-content/themes/doctorpedia/img/<?php echo strtolower(get_queried_object()->name); ?>/<?php echo $count; ?>.jpg')"
            <?php endif; ?>
        ></a>

        <div class="content">
            <h2><?php echo get_the_title() ?></h2>
        </div>

        <div class="footer external-link">
            <a href="<?php echo get_the_permalink(); ?>" target="_blank">View more</a>
        </div>
    </div>
<?php endwhile; ?>

<?php wp_reset_query(); ?>