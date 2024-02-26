<div class="podcast-hero" style="background-image: url('<?php echo IMAGES; ?>/podcast_bg.png');">

    <div class="container">

        <div class="podcast-hero__content">

            <?php if ( is_post_type_archive() ) : ?>

                <h1><?php echo ( get_field('hero_title', 'options') ) ? get_field('hero_title', 'options') : 'The Doctorpedia Podcast'; ?></h1>

                <h2><?php echo ( get_field('hero_text', 'options') ) ? get_field('hero_text', 'options') : 'Listen to interviews with the nation\'s top doctors and learn about their specialties, experience, and advice.';?></h2>

            <?php else : ?>

                <h1><?php echo get_term_meta( get_queried_object_id(), 'hero_title', true);?></h1>

                <h2><?php echo get_term_meta( get_queried_object_id(), 'hero_text', true); ?></h2>

            <?php endif; ?>

        </div>

    </div>

</div>