<?php $user_data = get_user_blog_data(); ?>

<div class="shadow doctors-shadow d-none" id="js-modal-location">

    <div class="doctors-location-modal d-flex align-items-center">

        <div class="doctors-location-modal__container">

            <div class="location__box">
    
                <img src="<?php echo IMAGES . '/public-profile/modal-map.svg'; ?>" class=""/>
    
                <h2>Location & Map</h2>
    
                <h3>Add Your Clinic Location to your Profile</h3>
    
                <!-- Group Clinic-->
                <div class="doctors-location-modal-group group-networks">
    
                    <!-- Subgroup -->
                    <div class="doctor-dashboard__bio-edit-sub-group d-flex">
    
                        <div class="d-flex flex-column form-group">
    
                            <label for="clinic_name" class="form-group__title">Clinic Name</label>
    
                            <input class="fix-input" type="text" name="clinic_name" id="clinic_name" placeholder="E.g. Yale New Haven Hospital" value="<?php echo ($user_data['profile']->clinic_name) ? $user_data['profile']->clinic_name : ''; ?>">
    
                        </div>
    
                        <div class="d-flex flex-column form-group">
    
                            <label for="clinic_email" class="form-group__title">Clinic Email <span id="js-message-email" class="ml-2"></span></label>
    
                            <input class="" type="text" name="clinic_email" id="clinic_email"  placeholder="E.g. clinic-email@clinic.com" onkeypress="return runCheckEmail(this.value)" value="<?php echo ($user_data['profile']->clinic_email) ? $user_data['profile']->clinic_email : ''; ?>">
    
                        </div>
    
                    </div>
    
                </div>
    
                <!-- Group Clinic-->
                <div class="doctors-location-modal-group group-networks">
    
                    <div class="doctor-dashboard__bio-edit-sub-group d-flex">
    
                        <div class="d-flex flex-column form-group">
    
                            <label for="clinic_open" class="form-group__title">Open Time</label>
    
                            <input class="fix-input" type="text" name="clinic_open" id="clinic_open" value="<?php echo ($user_data['acf']['clinic_open']) ? $user_data['acf']['clinic_open'] : ''; ?>" placeholder="E.g. Monday to Friday from 10am to 10pm">
    
                        </div>
    
                        <div class="d-flex flex-column form-group">
    
                            <label for="clinic_phone" class="form-group__title">Clinic Phone</label>
    
                            <input type="text" name="clinic_phone" id="clinic_phone" placeholder="E.g. 1-0500-011-1234" onkeypress="return runCheckPhone(event)" value="<?php echo ($user_data['acf']['clinic_phone']) ? $user_data['acf']['clinic_phone'] : ''; ?>">
    
                        </div>
    
                    </div>
    
                </div>
    
                <!-- Group Clinic-->
                <div class="doctors-location-modal-group group-networks group-networks-items">
    
                    <div class="doctor-dashboard__bio-edit-sub-group d-flex">
    
                        <div class="d-flex flex-column form-group">
    
                            <label for="clinic_web" class="form-group__title">Clinic Website</label>
    
                            <input class="fix-input" type="text" name="clinic_web" id="clinic_web" placeholder="E.g. https://my-site.com" value="<?php echo ($user_data['acf']['clinic_website']) ? $user_data['acf']['clinic_website']: ''; ?>">
    
                        </div>
    
    
                        <div class="d-flex flex-column form-group">
                        
                            <label for="clinic_appointment" class="form-group__title">Clinic Appointment</label>
    
                            <input type="text" name="clinic_appointment" id="clinic_appointment" value="<?php echo ($user_data['acf']['clinic_appointment']) ? $user_data['acf']['clinic_appointment']: ''; ?>" placeholder="E.g. https://my-site.com">
    
                        </div>
    
                    </div>
    
                </div>
    
                <div class="doctors-location-modal-group d-flex">
    
                    <div class="d-flex flex-column form-group">
    
                        <input id="latitud_prop" name="latitud" value="0" hidden>
                        <input id="longitud_prop" name="longitud" value="0" hidden>
                        <input id="city_prop" placeholder="city" name="city" value="" hidden>
                        <input id="state_prop" placeholder="state" name="state" value="" hidden>
                        <input id="country_prop" placeholder="country" name="country" value="" hidden>
    
                        <input id="js-google-search" type="text" name="clinic_location" class="mb-0 search-input-map" value="<?php echo ($user_data['acf']['clinic_location']) ? $user_data['acf']['clinic_location']['address'] : ''; ?>" size="50" placeholder="Enter a location">
    
                        <div class="acf-map" id="map" data-zoom="16">
    
                            <?php $location = $user_data['acf']['clinic_location']; ?>
    
                            <?php if ( $location ) : ?>
    
                                <div class="marker" data-lat="<?php echo esc_attr( $location['lat'] ); ?>" data-lng="<?php echo esc_attr( $location['lng'] ); ?>"></div>
                                
                            <?php else: ?>
    
                                <div class="marker" data-lat="40.71427" data-lng="-74.00597"></div>
                            
                            <?php endif; ?>
    
                        </div>
    
                    </div>
    
                </div>
    
                <a href="javascript:;" onclick="saveLocation()" class="location__save btn-save js-save-animation">Save Changes</a>
    
            </div>

        </div>

        <button type="button" onClick="closeModal()" class="close-modal hide-modal position-absolute"> <img src="<?php echo IMAGES; ?>/icons/close-modal-black.svg" alt=""></button>

    </div>

</div>