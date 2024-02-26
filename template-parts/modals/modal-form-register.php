<div class="shadow doctor-modal-form-register d-none" id="js-register-form">

    <div class="doctor-modal-form-register__container">

        <button type="button" onclick="CloseModalRegister()" class="doctor-modal-form-register__close-modal hide-modal position-absolute"> <img src="<?php echo IMAGES; ?>/icons/share-repost-close.svg" alt=""></button>

        <!-- Register Form -->
        <form id="js-form-register"  class="doctor-modal-form-register__form" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" autocomplete="off">

            <h2 class="doctor-modal-form-register__title">Complete your registration</h2>
            <p class="doctor-modal-form-register__copy">Doctorpedia is building a community of physician specialists. Once we have confirmed your qualifications, we will email you that your profile is live.</p>

            <div class="doctor-modal-form-register__group-doble">
                <div class="doctor-modal-form-register__input">
                    <label class="doctor-modal-form-register__label" for="user_fistname">First Name</label>
                    <input type="text" name="user_fistname" id="user_fistname" autocomplete="off">
                </div>
                <div class="doctor-modal-form-register__input">
                    <label class="doctor-modal-form-register__label" for="user_lastname">Last Name</label>
                    <input type="text" name="user_lastname" id="user_lastname" autocomplete="off">
                </div>
            </div>

            <div class="doctor-modal-form-register__group-single">
                <label class="doctor-modal-form-register__label" for="user_email">Email</label>
                <input type="email" name="user_email" id="user_email" autocomplete="off">
            </div>

            <div class="doctor-modal-form-register__group-doble">
                <div class="doctor-modal-form-register__input">
                    <label class="doctor-modal-form-register__label" for="user_pass">Password</label>
                    <input type="password" name="user_pass" id="user_pass" autocomplete="off">
                    <i class="fa fa-eye" onclick="showPassword(this, 'user_pass')"></i>
                </div>
                <div class="doctor-modal-form-register__input">
                    <label class="doctor-modal-form-register__label" for="user_repass">Confirm Password</label>
                    <input type="password" name="user_repass" id="user_repass" autocomplete="off">
                    <i class="fa fa-eye" onclick="showPassword(this, 'user_repass')"></i>
                </div>
            </div>

            <div class="doctor-modal-form-register__footer">
                <div>
                    <label class="doctor-modal-form-register__terms" for="terms"><input type="checkbox" name="terms" id="terms" value="accept"> I agree to the <a href="javascript:;" class="register-terms-conditions" onclick="open_modal_terms_form()">Terms & Conditions</a></label>
                    <div class="messageform" id="js-register-messageForm"></div>
                </div>
                <input type="submit" name="wp-submit" id="js-register-submit" class="button doctor-modal-form-register__submit" value="Register">
            </div>

            
            <div class="doctor-modal-form-rgister__sponsor">
                <?php if ( get_sub_field('sponsor__image_cta') && get_sub_field('sponsor__text_cta') ) : ?>
                    <div class="affiliate-hero__sponsor">
                        <img src="<?php echo get_sub_field('sponsor__image_cta')['url']; ?>" alt="sponsor">
                        <p><?php echo get_sub_field('sponsor__text_cta'); ?></p>
                    </div>
                <?php endif; ?>
            </div>

        </form>

    </div>

</div>

<?php //require_once( __DIR__ .'/parts/modal-terms&conditions.php' ); ?>