<div class="shadow d-none" id="js-insert-review-modal">
    <div class="add-review-modal mb-5">
        <div class="add-review-modal__header d-flex justify-content-between align-items-center pl-lg-5 pr-lg-5">
            <h1 class="add-review-modal__title">Add Review</h1>
            <button type="button" onclick="hideModal()" class="close-modal"> <img src="<?php echo IMAGES; ?>/icons/close-modal.svg" alt=""></button>
        </div>
        <div class="add-review-modal__box">
            <?php acf_form_head(); ?>
            <?php acf_form('new-user-review'); ?>
        </div>
    </div>
</div>

<?php if( $_GET['updated'] ): ?>
    <div class="acf-notice acf-success-message -dismiss -success" id="js-app-reviewed-success">
        <p>Submit Review</p>
        <a href="#" id="js-app-reviewed-cancel" class="acf-notice-dismiss acf-icon -cancel small"></a>
    </div>
<?php endif; ?>
