<div class="author__profile-main">

    <div class="author__profile-picture"  style="background-image: url('<?php echo $avatar; ?>')">

        <?php if ( get_the_author_meta('feature_video', $author_id, true) ) : ?>

            <a class="m-video__url video-modal-open js-videos-iframe author__profile-play" href="<?php echo get_the_author_meta('feature_video', $author_id, true); ?>">
                <img src="<?php echo get_template_directory_uri() . '/img/public-profile/mini_video_play.svg'; ?>" alt="play">
            </a>

        <?php endif; ?>

    </div>

    <div class="author__profile-data">
        
        <h1 class="author__profile-name"><?php the_author_meta('display_name', $author_id);?></h1>

        <?php if (get_field('bb_specialties', 'user_' . $author_id)): ?>

            <div class="d-flex align-items-start justify-content-center mb-2">
                <h2 class="author__profile-principal mr-2">
                    <?php 
                        echo get_field('bb_specialties', 'user_' . $author_id)[0]['specialty'];   
                                                
                        if ( count( get_field('bb_specialties', 'user_' . $author_id) ) <= 1 ) :
                            echo ( get_field('bb_specialties', 'user_' . $author_id)[0]['subspecialty'] ) ? '<br>' . get_field('bb_specialties', 'user_' . $author_id)[0]['subspecialty'] : '';
                        endif;
                    ?>
                </h2>
                <?php if ( count( get_field('bb_specialties', 'user_' . $author_id) ) > 1 ) : ?>
                    <img src="<?php echo IMAGES . '/public-profile/dropdown.svg'; ?>" alt="dropdown" id="toggleImg" width="16px" height="10px" onclick="toggleSpecialtiesPopup();">
                <?php endif; ?>
            </div>

            <div class="author__profile-container">
                <?php foreach (get_field('bb_specialties', 'user_' . $author_id) as $specialty): ?>
                    <h2 class="author__profile-area">
                        <?php 
                            echo $specialty['specialty'];
                            echo ( $specialty['subspecialty'] ) ? '<br>' . $specialty['subspecialty'] : ''; 
                        ?>
                    </h2>
                <?php endforeach;?>
            </div>

        <?php endif;?>

        <?php if (get_the_author_meta('location', $author_id)) : ?>
            <a href="http://maps.google.com/maps?q=<?php echo urlencode( get_the_author_meta('location', $author_id)['address']); ?>" target="_blank">
                <p class="author__profile-location"><?php echo get_the_author_meta('location', $author_id)['address']; ?></p>
            </a>
        <?php endif; ?>

    </div>

    <?php if ( is_user_logged_in() && validate_user($author_id) ) : ?>
        
        <a href="<?php echo esc_url( home_url( 'doctor-platform/bio-edit' ) ); ?>" class="author__profile-edit">
            <img src="<?php echo IMAGES .'/public-profile/btn-edit.svg'; ?>" class="author__profile-img">
        </a>

    <?php endif; ?>

</div>

<!-- Make Appointment Mobile -->
<?php if ( get_the_author_meta('clinic_appointment', $author_id) ) : ?>
    <a href="<?php echo esc_url( get_the_author_meta('clinic_appointment', $author_id) ); ?>" target="_blank" class="author__profile-appointment">Make an Appointment</a>
<?php endif; ?>