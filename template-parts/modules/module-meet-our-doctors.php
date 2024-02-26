<?php
    $title = get_sub_field('meet_doctors_title');
    $lcMessage = get_sub_field('meet_doctors_message');
    $lcCopy = get_sub_field('meet_doctors_copy');
    $ctaLink = get_sub_field('meet_doctors_cta');
    $mobileCtaText = get_sub_field('meet_doctors_mobile_cta');
?>

<section class="m-meet-our-doctors">

    <div class="m-meet-our-doctors__container container-big">

        <h2 class="m-meet-our-doctors__title"><?php echo esc_html($title); ?></h2>

        <div class="m-meet-our-doctors__doctors js-doctors">
            
            <?php 
            if (have_rows('select_featured_doctors')) : 
                while (have_rows('select_featured_doctors')) : the_row();
                    $doctor = get_sub_field('meet_doctor');
                    set_query_var( 'user', $doctor );
                    get_template_part( 'partials/meet-doctor-card' );
                endwhile;
            endif; 
            ?>

            <div class="doctor-card m-meet-our-doctors__doctors-lastcard">

                <p class="m-meet-our-doctors__doctors-lastcard-message"><?php echo esc_html($lcMessage); ?></p>
                <p class="m-meet-our-doctors__doctors-lastcard-copy"><?php echo esc_html($lcCopy); ?></p>
                <a class="m-meet-our-doctors__doctors-lastcard-cta" href="<?php echo esc_url($ctaLink['url']); ?>"><?php echo esc_html($ctaLink['title']); ?></a>

            </div>

        </div>

        <a class="m-meet-our-doctors__doctors-mobileCTA" href="<?php echo esc_url($ctaLink['url']); ?>"><?php echo esc_html($mobileCtaText); ?></a>

    </div>
    
</section>