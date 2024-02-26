<div class="single-team container">
    
    <div class="single-team__wrapper">
            
        <div class="single-team__wrapper__body">

            <div class="single-team__bio d-flex flex-row flex-wrap" id="js-bios-filters">

                <div class="single-team__bio-content d-flex">

                    <!-- Avatar Column -->
                    <div class="single-team__bio-avatar-container">

                        <div class="single-team__bio-avatar" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>')"></div>

                        <div class="single-team__bio-social d-flex flex-wrap justify-content-center">
                            <!-- Social Link 1 -->
                            <?php if( get_field('web') ) : ?>
                                <a href="<?php echo get_field('web'); ?>" class="single-team__bio-social-link" target="_blank">
                                    <img src="<?php echo IMAGES; ?>/icons/doctor-profile/click.svg" alt="" class="single-team__bio-social-icon"/>
                                </a>
                            <?php endif; ?>
                            
                            <!-- Mail -->
                            <?php if( get_field('email') ) : ?>
                                <a href="mailto:<?php echo get_field('email'); ?>" target="_blank" class="single-team__bio-social-link">
                                    <img src="<?php echo IMAGES; ?>/icons/doctor-profile/mail.svg" alt="" class="single-team__bio-social-icon"/>
                                </a>               
                            <?php endif; ?>

                            <!-- Linkedin -->
                            <?php if( get_field('linkedin') ) : ?>
                                <a href="<?php echo get_field('linkedin'); ?>" class="single-team__bio-social-link" target="_blank">
                                    <img src="<?php echo IMAGES; ?>/icons/doctor-profile/linkedin.svg" alt="" class="single-team__bio-social-icon"/>
                                </a>
                            <?php endif; ?>
                            
                            <!-- Twitter -->
                            <?php if( get_field('twitter') ) : ?>
                                <a href="<?php echo get_field('twitter'); ?>" class="single-team__bio-social-link" target="_blank">
                                    <img src="<?php echo IMAGES; ?>/icons/doctor-profile/twitter.svg" alt="" class="single-team__bio-social-icon"/>
                                </a>
                            <?php endif; ?>

                        </div>

                    </div>

                    <!-- Description Column -->
                    <div class="single-team__bio-description">

                        <!-- Author Name -->
                        <h2 class="single-team__bio-description-title"><?php the_title(); ?></h2>
                        
                        <!-- Author Category -->
                        <?php if (get_field('specialty')) : ?>
                            <h3 class="single-team__bio-description-subtitle"><?php echo get_field('specialty'); ?></h3>
                        <?php endif; ?>
                        
                        <!-- Author Description -->
                        <div class="single-team__bio-description-copy">

                            <!-- Full Biography -->
                            <?php the_content(); ?>
                            
                        </div>
                        
                    </div>

                </div>

            </div>
            
        </div>

    </div>

</div>