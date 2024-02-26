<?php /* Template Name: Doctor Platform */?>

<?php get_header('secondary'); ?>

<?php the_post();?>
<div class="landing-container">

<?php if( have_rows('doctor_platform')): ?>
        <?php while( have_rows('doctor_platform') ): the_row(); ?>
            <?php if ( get_row_layout() == 'section_header' ) : ?>
                <?php  get_template_part( 'template-parts/doctor-platform/section_header' ); ?>
            <?php endif; ?>
        <?php endwhile; ?>
<?php endif; ?>


  <!-- Landing Public Profile -->
  <section class="landing-public-profile">
    <h2 class="landing-public-profile__title">Public Profile</h2>
    <img src="<?php echo IMAGES; ?>/video-mobile.png" 
         alt="Picture of DrPedia website video" 
         class="landing-public-profile__img--mobile"> <!-- Mobile only -->
    <h2 class="landing-public-profile__subtitle">
      Build and customize your unique innovative profile to showcase your expertise, qualifications, and personality.
    </h2>
    <img src="<?php echo IMAGES; ?>/drpedia-home.jpg" 
         alt="Picture of DrPedia website" 
         class="landing-public-profile__img">
  </section>

  <!-- Landing tools block -->
  <section class="landing-tools landing-tools--mobile">
    <div class="landing-tools__images-left">
      <img src="<?php echo IMAGES; ?>/article-screen.png" 
      alt="Screenshot of an article" 
      class="landing-tools__images-left--1">
    </div>
    <div class="landing-tools-info landing-tools-info--right">
      <h3 class="landing-tools-info__title">
        <hr class="landing-tools__dotted-line">
        Write Articles
      </h3>
      <img src="<?php echo IMAGES; ?>/article-mobile.png" 
           alt="Screenshot of an article" 
           class="landing-tools__images-left landing-tools__images-left--mobile1"> <!-- Mobile only -->
      <p class="landing-tools-info__description">
        Share your research with the world by writing an article for
        <span class="landing-tools-info__description--bold">Doctorpedia</span> 
        to review and add to relevantwebsites..
      </p>
      <a href="#" class="landing-tools-info__button">
        Write an Article
      </a>
    </div>
  </section>

  <!-- Landing tools block -->
  <section class="landing-tools">
    <div class="landing-tools-info__left">
      <h3 class="landing-tools-info__title">Post Blogs</h3>
      <img src="<?php echo IMAGES; ?>/blogs-doctors.png" 
           alt="Screenshot of an article" 
           class="landing-tools__images-right landing-tools__images-right--mobile1"> <!-- Mobile only -->
      <p class="landing-tools-info__description landing-tools-info__description--blog">
        Share your personal and professional experiences and advice on our Blogging Platform.
      </p>
      <a href="#" class="landing-tools-info__button">
        Write a Blog
      </a>
    </div>
    <div class="landing-tools__images-right">
      <img src="<?php echo IMAGES; ?>/post-blog-1.png" 
           alt="Screenshot of a blog post" 
           class="landing-tools__images-right-1">
    </div>
  </section>

  <!-- Landing tools block -->
  <section class="landing-tools landing-tools--mobile">
    <div class="landing-tools__images-left">
      <img src="<?php echo IMAGES; ?>/produce-videos.png" 
           alt="Image of a video window" 
           class="landing-tools__images-left--3">
    </div>
    <div class="landing-tools-info landing-tools-info--big-margin landing-tools-info--right">
      <h3 class="landing-tools-info__title">
        <hr class="landing-tools__dotted-line">
        Produce Videos
      </h3>
      <img src="<?php echo IMAGES; ?>/produce-videos.png" 
           alt="Image of a video window"
           class="landing-tools__images-left--3 landing-tools__images-left--mobile3"> <!-- Mobile only -->
      <p class="landing-tools-info__description">
        Upload and share video content to showcase your expertise on the Doctorpedia Platform.
      </p>
      <a href="#" class="landing-tools-info__button">
        Upload Video
      </a>
    </div>
  </section>

  <!-- Landing tools block -->
  <section class="landing-tools landing-tools--big-padding">
    <div class="landing-tools-info__left">
      <h3 class="landing-tools-info__title">Review Apps</h3>
      <img src="<?php echo IMAGES; ?>/review-apps-mobile.png" 
           alt="Screenshot of the app review section" 
           class="landing-tools__images-right-2 landing-tools__images-right--mobile2"> <!-- Mobile only -->
      <p class="landing-tools-info__description landing-tools-info__description--app">
        Review and rate the latest mobile apps by condition or topic.
      </p>
      <a href="#" class="landing-tools-info__button">
        Review Apps
      </a>
    </div>
    <div class="landing-tools__images-right">
      <img src="<?php echo IMAGES; ?>/review-apps.png" 
           alt="Screenshot of the app review section" 
           class="landing-tools__images-right-2">
    </div>
  </section>

  <!-- Landing footer -->
  <section class="landing-footer">
    <img src="<?php echo IMAGES; ?>/smiley1.png" 
         alt="Smiley Image" 
         class="landing-footer__image">
    <h2 class="landing-footer__title">Let's Get Started</h2>
    <p class="landing-footer__subtitle">
      Explore the doctor platform and start sharing your expertise with the world
    </p>
    <a href="#" class="landing-footer__button">
        Sign Up Now
    </a>
  </section>
</div>

<?php get_footer(); ?>



