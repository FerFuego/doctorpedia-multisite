<?php get_header('2021'); ?>

<?php the_post();?>

<!-- User Reviews Layout -->

<!-- Secondary Header Module -->
<div class="secondary-header">
    <div class="container">
        <img src="<?php echo ( get_field( 'option_icon', 'option' ) ) ? get_field( 'option_icon', 'option' ) : IMAGES . '/clipboard icon.svg'; ?>" alt="">
        <div class="page-title">
            <h1><?php echo ( get_field( 'option_title', 'option' ) ) ? get_field( 'option_title', 'option' ) : 'User Reviews'; ?></h1>
            <p><?php the_field( 'option_text', 'option' ); ?></p>
        </div>
    </div>
</div>
<!-- Secondary Header Module -->

<section class="app-review">
    <div class="container">
        <div class="app-review__head d-flex flex-md-row justify-content-between">
            <h1 class="app-review__title">
                <?php echo ( get_field( 'option_subtitle', 'option' ) ) ? get_field( 'option_subtitle', 'option' ) : 'Apps Reviewed by Users'; ?>
            </h1>
            <div class="app-review__group app-review__review-btn-parent d-flex justify-content-end align-items-start">
                <button type="button" onclick="showModal()" class="btn-download btn-download--teal">Add Review</button>
            </div>
        </div>       
        <!-- START APPS -->
        <?php require(  __DIR__ . '/template-parts/taxonomies/user-reviews/apps.php' ); ?>
        <!-- END APPS -->
    </div>
</section>

<!-- START MODAL -->
<?php require_once(  __DIR__ . '/template-parts/taxonomies/user-reviews/modal.php' ); ?>
<!-- END MODAL -->

<?php the_content() ?>

<?php get_footer(); ?>


 