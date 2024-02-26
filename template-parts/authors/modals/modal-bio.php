<div class="shadow doctors-shadow d-none" id="js-modal-bio">

    <div class="doctors-bio-modal d-flex align-items-center">

        <div class="educations__box">

            <img src="<?php echo IMAGES . '/public-profile/modal-bio.svg'; ?>" class=""/>

            <h2>Bio</h2>

            <h3>Write a short bio that will be featured on your public profile</h3>


            <div class="form-group form-group--mtop">
                
                <span id="charNum" class="text-min text-right d-block w-100 pb-1">0 out of 500 characters</span> 

                <textarea name="user_biography" id="user_biography" onkeyup="countChars(this);" placeholder="E.g. MD: Harvard University BS: UCLA Residency: Stanford University Fellowship: University of Michigan"><?php echo (get_user_blog_data()['acf']['biography']) ? get_user_blog_data()['acf']['biography'] : ''; ?></textarea>
    
            </div>

            <div class="form-group d-flex flex-column mb-5">

                <label class="mb-1" for="user_biography_link">External Link Bio</label>

                <input type="text" name="user_biography_link" id="user_biography_link" class="mr-0 certification-item" placeholder="E.g. https://my-web.com" value="<?php echo get_user_blog_data()['acf']['biography_link']; ?>">

            </div>

            <a href="javascript:;" onclick="saveBiography()" class="educations__save btn-save js-save-animation">Save Changes</a>

        </div>

        <button type="button" onClick="closeModal()" class="close-modal hide-modal position-absolute"> <img src="<?php echo IMAGES; ?>/icons/close-modal-black.svg" alt=""></button>

    </div>

</div>