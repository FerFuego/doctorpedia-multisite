<?php /* Template Name: Channels */ ?>

<?php get_header('2021'); ?>

<?php the_post();?>

<div class="doctorpedia-channels-pro">

    <?php if ( !post_password_required() ): ?>
    
        <div class="featured-article-container fix-header-fixed">
    
            <?php the_content(); ?>
            
        </div>
        <!-- End Categories Page Container Module -->
    
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

</div>


<?php get_footer(); ?>