<div id="js-video-presentation-container">

    <?php if (get_the_author_meta('feature_video', $author_id, true)): ?>

        <div class="author__video-presentation">

            <div class="author__video-presentation-wrapper">

                <div class="author__video-presentation-photo">

                    <!-- Video Presentation  -->
                    <?php echo do_shortcode('[video src="' . get_the_author_meta('feature_video', $author_id, true) . '" width="273px" height="160px"]'); ?>

                </div>

                <div class="author__video-presentation-container">

                    <h3>Meet Dr. <?php the_author_meta('first_name', $author_id );?> <?php the_author_meta('last_name', $author_id );?></h3>

                </div>

            </div>

        </div>

    <?php else : ?>

        <?php if ( is_user_logged_in() && validate_user($author_id)) : ?>

            <div class="author__video-empty">

                <div class="author__video-empty-wrapper">

                    <div class="author__video-empty-wrapper__header">

                        <img src="<?php echo IMAGES .'/icons/profile-empty-video.svg'; ?>" alt="Doctorpedia icon video">

                    </div>

                    <div class="author__video-empty-wrapper__body">

                        <h3>NEW</h3>

                        <h2>Video Business Card</h2>
                        
                        <p>Introduce yourself in a more personal way with the <strong>Video Business Card</strong> feature.</p>

                        <?php if ( get_field('video_presentation_example', 'option') ) : ?>
                        
                            <a class="m-video__url video-modal-open js-videos-iframe" href="<?php echo get_field('video_presentation_example', 'option'); ?>">See Sample</a>

                        <?php endif; ?>

                    </div>

                </div>

            </div> 
            
        <?php endif; ?>

    <?php endif; ?>

</div>