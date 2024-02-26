<div class="shadow doctors-shadow author-repost-modal d-none" id="js-repost-successful">

    <div class="doctors-add-review-modal modal-new_article d-flex align-items-center">

        <!-- Pre-Publish -->
        <div class="modal-new_article__box d-flex flex-column align-items-center text-center position-relative js-confirm-modal">

            <img src="<?php echo IMAGES; ?>/icons/share-successful-icon.svg" alt="" class="modal-new_article__box-icon"/>

            <h2 class="modal-new_article__box-title author-repost-successful">Successfully Shared!</h3>

            <div class="modal-new_article__box-cta-container d-flex justify-content-center">

                <a href="<?php echo get_user_permalink(); ?>" class="modal-new_article__box-cta">View on my Profile</a>

                <button type="button" onClick="CloseModalRespot()" class="modal-new_article__box-cta hide-modal">Back to Article</button>

            </div>

            <button type="button" onClick="CloseModalRespot()" class="close-modal hide-modal position-absolute"> <img src="<?php echo IMAGES; ?>/icons/share-repost-close.svg" alt=""></button>

        </div>

    </div>

</div>