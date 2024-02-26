 <!-- Landing hero -->
 <section class="landing-hero" style="">
    <div class="landing-hero-text">
      <h1 class="landing-hero-text__title">
        <?php //echo get_sub_field('section_header_title'); ?>
        Doctor <span class="landing-hero-text__title--strong">Platform</span>
      </h1>
      <h4 class="landing-hero-text__subtitle">
        <?php echo get_sub_field('section_header_text'); ?> 
        <!-- Easily create and distribute content through your 
        Doctorpedia Profile and across our network of websites. -->
      </h4>
      <a href="<?php echo get_sub_field('section_header_button')['url']; ?>" 
         class="landing-hero-text__signup"
         target="<?php echo get_sub_field('section_header_button')['target']; ?>">
        <?php echo get_sub_field('section_header_button')['title']; ?>
      </a>
    </div>

    <div class="landing-hero-elipses">
      <div class="landing-hero-elipses__big"></div>
      <div class="landing-hero-elipses__small"></div>
      <img src="<?php echo IMAGES; ?>/drmobile1.jpg" 
           alt="Image of a phone" 
           class="landing-hero-elipses__img1">
      <hr class="landing-hero-elipses__dotted-line"> <!--  mobile -->
      <img src="<?php  echo IMAGES; ?>/drmobile2.jpg" 
           alt="Image of a small phone" 
           class="landing-hero-elipses__img2">
    </div>
  </section>