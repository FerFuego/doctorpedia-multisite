<!-- Information Container -->
<div class="author__profile-wrapper">

    <!-- Social Media -->
    <?php get_template_part('template-parts/authors/elements/social-media');?>
    <!-- End Social Media -->

    <!-- Picture + Name -->
    <?php get_template_part('template-parts/authors/elements/picture-profile');?>
    <!-- End Picture + Name -->

    <!-- Bio -->
    <?php get_template_part('template-parts/authors/elements/biography');?>
    <!-- End Bio -->

    <!-- Education -->
    <?php get_template_part('template-parts/authors/elements/education');?>
    <!-- End Education -->

    <!-- Certification -->
    <?php get_template_part('template-parts/authors/elements/certification');?>
    <!-- End Certification -->

    <!-- Expertise -->
    <?php get_template_part('template-parts/authors/elements/area-expertise'); ?>
    <!-- End Expertise -->

    <?php if ( is_user_logged_in() && validate_user($author_id) ) : ?>

        <a href="<?php echo esc_url( home_url( 'doctor-platform/bio-edit' ) ); ?>" class="hidden-xs read-more-link text-center mt-5 mb-5">Edit Profile</a>

    <?php endif; ?>

</div>
<!-- End Informatio Container -->

<?php wp_reset_query();?>