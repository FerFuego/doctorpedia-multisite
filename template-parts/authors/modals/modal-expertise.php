<div class="shadow doctors-shadow d-none" id="js-modal-expertise">

    <div class="doctors-expertise-modal">

        <div class="doctors-expertise-modal__container">

            <div class="expertise__box">

                <img src="<?php echo IMAGES . '/public-profile/area-of-expertise.svg'; ?>" class=""/>

                <h2>Areas of Expertise</h2>

                <h3>Here is where you can list your areas of interest, the conditions you treat, the procedures you perform, the services you provide - anything that you'd like to be known for to help users find your profile.</h3>

                <div class="form-group form-group--mtop">

                    <div class="doctor-dashboard__bio-edit-sub-group d-flex flex-column form-group">

                        <input type="text" name="user_expertise" id="user_expertise" placeholder="e.g. Kidney Health, Diabetes, Colonoscopy, Bariatric Surgery, etc." class="mr-0 certification-item">

                        <div class="group-certification-cta">

                            <a href="javascript:;" onclick="addExpertiseItem();">Add +</a>

                        </div>

                        <ul class="doctor-dashboard__bio-edit-sub-group d-flex flex-column" id="js-list-expertise">

                            <?php if ( get_user_blog_data()['acf']['expertise'] ) : ?>

                                <?php foreach( get_user_blog_data()['acf']['expertise'] as $key => $c ) : ?>

                                    <li id="<?php echo str_replace(' ', '-', $c['expertise']); ?>" class="d-flex flex-row check_expertise">

                                        <div class="box-education box-education-purple d-flex flex-row">

                                            <?php echo $c['expertise']; ?>

                                            <input type="hidden" value="<?php echo $c['expertise']; ?>" class="item_education">

                                            <div onclick="deleteExpertiseItem(this);">

                                                <img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg">

                                            </div>

                                        </div>
                                    
                                    </li>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </ul>

                    </div>

                </div>

                <a href="javascript:;" onclick="saveExpertise()" class="expertise__save btn-save js-save-animation">Save Changes</a>

            </div>
    
        </div>

        <button type="button" onClick="closeModal()" class="close-modal hide-modal position-absolute"> <img src="<?php echo IMAGES; ?>/icons/close-modal-black.svg" alt=""></button>

    </div>

</div>