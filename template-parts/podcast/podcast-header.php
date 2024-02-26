<div class="podcast-header">

    <div class="container">

        <div class="podcast-header__content">

            <?php if ( is_post_type_archive() ) : ?>

                <h2><?php echo (  get_field('header_title', 'options') ) ? get_field('header_title', 'options') : 'Leading Voices';?></h2>
                
                <p><?php echo ( get_field('header_text', 'options') ) ? get_field('header_text', 'options') : 'With the Doctorpedia Podcast, you can learn about health and wellness on-the-go-the 40-60 minute episodes are perfect for your commute or as a wind-down before bed. Invited Expert';?></p>

            <?php else : ?>

                <h2><?php echo get_term_meta( get_queried_object_id(), 'header_title', true);?></h2>

                <p><?php echo get_term_meta( get_queried_object_id(), 'header_text', true);?></p>

            <?php endif; ?>

        </div>

    </div>

</div>