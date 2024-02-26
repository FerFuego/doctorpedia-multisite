<div class="shadow doctors-shadow d-none" id="js-terms-conditions-form">

    <div class="doctors-terms-modal d-flex align-items-center">

        <!-- Pre-Publish -->
        <div class="modal-new_article__box d-flex flex-column align-items-center text-center position-relative js-confirm-modal">

            <h2 class="modal-new_article__box-title">Terms & Conditions</h2>

            <div class="box-text-content text-left">

                <?= get_field('terms_and_condicions', 'options') ?>

            </div>

            <div class="modal-new_article__box-cta-container d-flex justify-content-center">

                <a href="javascript:;" class="modal-new_article__box-cta" onclick="hide_terms_modal()">Accept</a>

            </div>

            <button type="button" onclick="closeTermsModal()" class="close-modal hide-modal position-absolute"> <img src="<?php echo WPBD_URL . 'assets/img/close-modal-black.svg'; ?>" alt=""></button>

        </div>

    </div>

</div>