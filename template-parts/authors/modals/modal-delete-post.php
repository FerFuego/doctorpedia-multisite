<div class="shadow doctors-shadow author-repost-modal d-none" id="js-modal-delete-post">

    <div class="doctors-add-review-modal modal-new_article d-flex align-items-center">

        <!-- Pre-Publish -->
        <div class="modal-new_article__box d-flex flex-column align-items-center text-center position-relative js-confirm-modal">

            <img src="<?php echo IMAGES; ?>/public-profile/error.svg" width="70px" class="modal-new_article__box-icon"/>

            <h2 class="modal-new_article__box-title mb-5">Are you sure you want to permanently delete this post?</h2>

            <div class="modal-new_article__box-cta-container d-flex justify-content-center">

                <button type="button" onclick="cancelDeletePost()" class="modal-new_article__box-cta hide-modal">Cancel</button>
                
                <button type="button" class="modal-new_article__box-cta" id="js-delete-verified" data-id="">Delete</button>

            </div>

        </div>

    </div>

</div>