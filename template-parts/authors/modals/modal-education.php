<div class="shadow doctors-shadow d-none" id="js-modal-education">

    <div class="doctors-educations-modal">

        <div class="doctors-educations-modal__container">

            <div class="educations__box">

                <img src="<?php echo IMAGES . '/public-profile/education.svg'; ?>" class=""/>

                <h2>Education</h2>

                <h3>Add educational institutions in which you are certified</h3>

                <div class="form-group form-group--mtop education-mobile">

                    <div class="doctor-dashboard__bio-edit-sub-group d-flex flex-column form-group">

                        <input type="text" name="user_education" id="user_education" class="mr-0 certification-item">

                        <div class="group-certification-cta">

                            <a href="javascript:;" onclick="addEducationItem();">Add +</a>

                        </div>

                        <ul class="doctor-dashboard__bio-edit-sub-group d-flex flex-column" id="js-list-education">

                            <?php if ( get_user_blog_data()['acf']['education'] ) : ?>

                                <?php foreach( get_user_blog_data()['acf']['education'] as $key => $c ) : ?>

                                    <li id="<?php echo str_replace(' ', '-', $c['education']); ?>" class="d-flex flex-row check_education">

                                        <div class="box-education box-education-purple d-flex flex-row">

                                            <?php echo $c['education']; ?>

                                            <input type="hidden" value="<?php echo $c['education']; ?>" class="item_education">

                                            <div onclick="deleteItemEducation(this)">

                                                <img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg">

                                            </div>

                                        </div>
                                    
                                    </li>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </ul>

                    </div>

                </div>

                <a href="javascript:;" onclick="saveEducation()" class="educations__save btn-save js-save-animation">Save Changes</a>

            </div>
    
        </div>

        <button type="button" onClick="closeModal()" class="close-modal hide-modal position-absolute"> <img src="<?php echo IMAGES; ?>/icons/close-modal-black.svg" alt=""></button>

    </div>

</div>