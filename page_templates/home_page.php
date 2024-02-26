<?php /* Template Name: Home Page */?>

<?php get_header(); ?>

<?php if ( !post_password_required() ) : ?>

<?php the_post();?>

<?php the_content() ?>

<?php else: ?>

<!-- Form Password Protector -->
<div class="form-password-protector">
    <form method="post" action="<?php echo esc_url( home_url( '/' ) ) . 'wp-login.php?action=postpass'; ?>">
        <p>This post is password protected. To view it please enter your password below:</p><br>
        <p><label for="pwbox-531">Password:<br/>
        <input type="password" size="20" id="pwbox-531" name="post_password"/></label><br/>
        <input type="submit" value="Submit" name="Submit"/></p>
    </form>
</div>
<!-- End Form Password Protector -->

<?php endif; ?>

<?php get_footer(); ?>
