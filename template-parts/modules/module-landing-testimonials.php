<section class="m-landing-testimonials">
    <div class="m-landing-testimonials__primary_box container">
        <h3 class="m-landing-testimonials__title"><?php echo get_sub_field('m-doctor_testimonial__title') ;?></h3>
        <p class="m-landing-testimonials__copy"><?php echo get_sub_field('m-doctor_testimonial__copy'); ?></p>
    </div>

    <div class="m-landing-testimonials__cards container">
      <div class="m-landing-testimonials__slider">
        <?php if ( have_rows( 'm-doctor_testimonial__testimonials' ) ) : 
                  while ( have_rows('m-doctor_testimonial__testimonials' ) ) : the_row();
                      $expert = get_sub_field('m-doctor_testimonial__doctor');
                      $testimonial = get_sub_field('m-doctor_testimonial__testimonial');
                      set_query_var( 'user', $expert );
                      set_query_var( 'testimonial', $testimonial );
                      get_template_part( 'partials/expert-card');
                  endwhile;
              endif; ?>
      </div>
    </div>

    <a href="<?php echo esc_url(home_url('/meet-our-doctors/')); ?>" class="btn-rounded">Meet Our Doctors <img src="<?php echo get_template_directory_uri(); ?>/img/modules/webcast/single-right-arrow-white.svg" alt></a>
    <img src="<?php echo get_template_directory_uri(); ?>/img/landing/comas.svg" alt="" class="m-landing-testimonials__asset">
</section>