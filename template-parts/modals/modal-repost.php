<div class="shadow doctors-shadow author-repost-modal d-none" id="js-insert-repost">

    <div class="doctors-add-review-modal modal-new_article d-flex align-items-center">

        <!-- Pre-Publish -->
        <div class="modal-new_article__box d-flex flex-column align-items-center text-center position-relative js-confirm-modal">

            <img src="<?php echo IMAGES; ?>/icons/share-repost-modal.svg" alt="" class="modal-new_article__box-icon"/>

            <h2 class="modal-new_article__box-title">Share this post on your profile with a comment of your own:</h2>

            <form>

                <textarea name="content_repost" id="content_repost" cols="100" rows="10" class="mb-5" placeholder="Write what you think about this post..."></textarea>

                <input type="hidden" name="id_repost" id="id_repost">

                <div class="modal-new_article__box-cta-container d-flex justify-content-center">

                    <button type="button" onClick="repostArticles()" class="modal-new_article__box-cta" id="js-open-verified">Share on my Profile</button>

                    <button type="button" onClick="CloseModalRespot()" class="modal-new_article__box-cta hide-modal">Cancel</button>

                </div>
                
            </form>
        
            <button type="button" onClick="CloseModalRespot()" class="close-modal hide-modal position-absolute"> <img src="<?php echo IMAGES; ?>/icons/share-repost-close.svg" alt=""></button>

        </div>

    </div>

</div>