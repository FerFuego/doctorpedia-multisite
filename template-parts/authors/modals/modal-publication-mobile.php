<div class="shadow doctors-shadow d-none" id="js-modal-publication">

    <div class="doctors-publication-modal d-flex align-items-center">

        <div class="educations__box">

            <h2>New Publication</h2>

            <h3></h3>

            <div class="form-group form-group--mtop">
                
                <div class="d-flex flex-row">

                    <div class="text-box__drpicture" style="background-image: url(<?php echo $avatar; ?>);"></div>
                    
                    <div class="text-box__placeholder-text">

                        <textarea  name="publish_content" id="publish_content_mobile" class="text-box__content autofit" onkeyup="get_site_og()" placeholder="Post something, Dr. <?php the_author_meta('user_lastname', $author_id); ?>..."></textarea>
                    
                        <div id="publish-content-mobile"></div>

                    </div>

                </div>

            </div>

            <a href="javascript:;" onclick="submit_profile_share_mobile();" class="educations__save btn-save js-save-animation">Publish</a>

        </div>

        <button type="button" onClick="closeModal()" class="close-modal hide-modal position-absolute"> <img src="<?php echo IMAGES; ?>/icons/close-modal-black.svg" alt=""></button>

    </div>

</div>