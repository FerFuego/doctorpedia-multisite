<?php $user_data = get_user_blog_data(); ?>

<div class="shadow doctors-shadow d-none" id="js-modal-board-certification">

    <div class="doctors-board-certifications-modal">

        <div class="doctors-board-certifications-modal__container">

            <div class="board-certifications__box">

                <img src="<?php echo IMAGES . '/public-profile/board-certification.svg'; ?>">

                <h2>Board Certification(s)</h2>

                <h3>Add your board certifications</h3>

                <div class="doctor-dashboard__bio-edit-sub-group">

                    <div class="doctor-dashboard__bio-edit-group group-specialties d-flex flex-column">

                        <!-- Subgroup -->
                        <div class="doctor-dashboard__bio-edit-sub-group group-specialties-sub doctor-board-certification">

                            <div class="group-bios__header group-bios__header-certification">

                                <div class="d-flex justify-content-between">
                                    <p>Are you Board Certified?</p>
                                    <label><input type="checkbox" name="certification" id="js-board" onclick="activeBoardModal()" value="yes" <?php echo ( $user_data['acf']['certification'] ) ? 'checked' : ''; ?>> Yes</label>
                                    <label><input type="checkbox" name="certification" id="js-resident" onclick="activeResidentModal()" value="no" <?php echo ( $user_data['acf']['residency'] ) ? 'checked' : ''; ?>> No</label>
                                </div>

                                <div class="d-flex justify-content-between d-none" id="js-cta-resident">
                                    <p>Are you Board Resident?</p>
                                    <label><input type="checkbox" name="certification" id="js-resident-y" onclick="activeResidentFieldModal()" value="yes" <?php echo ( $user_data['acf']['residency'] ) ? 'checked' : ''; ?>> Yes</label>
                                    <label><input type="checkbox" name="certification" id="js-resident-x" onclick="activeCredentialFieldModal()" value="no" <?php echo ( $user_data['acf']['credential'] ) ? 'checked' : ''; ?>> No</label>
                                </div>

                            </div>

                            <div class="group-bios__header group-bios__header-content-certification <?php echo ( $user_data['acf']['certification'] ) ? '' : 'd-none'; ?>" id="js-visible-certifications">

                                <h3>Select your Board Certification</h3>
                                
                                <!-- Subgroup -->
                                <div class="doctor-dashboard__bio-edit-sub-group group-specialties-sub group-specialties-mobile d-flex">

                                    <div class="d-flex flex-column form-group">

                                        <label for="title" class="form-group__title">Specialty</label>

                                        <select class="form-group__select" id="user_certification" onchange="loadSubCertification( this.value );">
                                            <option value="">Select Specialty</option>
                                            <?php foreach (Blog_BioEdit::get_specialties() as $specialty): ?>
                                                <option value="<?php echo $specialty; ?>"><?php echo $specialty; ?></option>
                                            <?php endforeach;?>
                                        </select>

                                    </div>

                                    <div class="d-flex flex-column form-group">
                                        <label for="title" class="form-group__title">Sub Specialty</label>
                                        <select class="form-group__select" id="user_subcertification" onchange="addCertification();"></select>
                                    </div>

                                    <div class="cta-add-specialties">
                                        <a href="javascript:;" onclick="addCertification();">Add +</a>
                                    </div>

                                </div>

                                <ul class="doctor-dashboard__bio-edit-sub-group d-flex flex-column list-specialties-mobile" id="js-list-certification">

                                    <?php if ( $user_data['acf']['certification'] ) : ?>

                                        <?php foreach ( $user_data['acf']['certification'] as $c ) : ?>

                                            <li id="<?php echo str_replace(' ', '-', $c['certification']); ?>" class="d-flex flex-row check_certification">

                                                <div class="box-certification box-certification-purple d-flex flex-row">

                                                    <?php echo $c['certification']; ?>

                                                    <input type="hidden" value="<?php echo $c['certification']; ?>" class="item_certification">

                                                    <div onclick="deleteItemcertification(this)">

                                                        <img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg">

                                                    </div>

                                                </div>

                                                <?php if ( $c['subcertification'] ) : ?>

                                                    <div id="<?php echo str_replace(' ', '-', $c['subcertification']); ?>" class="box-certification box-certification-pink d-flex flex-row">

                                                        <?php echo $c['subcertification']; ?>

                                                        <input type="hidden" value="<?php echo $c['subcertification']; ?>" class="item_subcertification">

                                                        <div onclick="deleteItemSubcertification(this)">

                                                            <img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg">

                                                        </div>

                                                    </div>

                                                <?php endif; ?>

                                            </li>

                                        <?php endforeach; ?>

                                    <?php endif;?>

                                </ul>

                            </div>

                            <div class="group-bios__header group-bios__header-content-certification other-certification-mobile <?php echo ( $user_data['acf']['residency'] ) ? '' : 'd-none'; ?>" id="js-visible-resident">

                                <h3>Fill in your residency program:</h3>

                                <input type="text" name="user_residency" id="user_residency" class="w-100" value="<?php echo ( $user_data['acf']['residency'] ) ? $user_data['acf']['residency'] : ''; ?>" placeholder="IE. Yale New Haven Hospital">                    

                            </div>

                            <div class="group-bios__header group-bios__header-content-certification other-certification-mobile <?php echo ( $user_data['acf']['credential'] ) ? '' : 'd-none'; ?>" id="js-visible-credential">

                                <h3>Please list your credentials:</h3>

                                <input type="text" name="user_credential" id="user_credential" class="w-100" value="<?php echo ( $user_data['acf']['credential'] ) ? $user_data['acf']['credential'] : ''; ?>" placeholder="IE. Certified physician assistant">                    

                            </div>

                        </div>

                    </div>

                </div>

                <a href="javascript:;" onclick="saveBoardCertification()" class="board-certifications__save btn-save js-save-animation">Save Changes</a>

            </div>

        </div>

        <button type="button" onClick="closeModal()" class="close-modal hide-modal position-absolute"> <img src="<?php echo IMAGES; ?>/icons/close-modal-black.svg" alt=""></button>
    
    </div>

</div>