/**
 * Active tabs in Authors
 * @param {tab_id} tab 
 */
function activeTab ( tab ) {

    $('.author__content-nav-item').each( function () {
        var id = $(this).attr('data-id');
        if (id == tab) {
            $(this).addClass('active');
        } else {
            $( this ).removeClass('active');
        }
    });

    $('.author__tabs-container__tab').each( function () {
        var id = $(this).attr('id');
        if (id == tab) {
            $( this ).removeClass('d-none');
        } else {
            $(this).addClass('d-none');
        }
    });
}

/**
 * Play podcast into box
 */
function playPodcast (id) {
    $('#js-play-button-' + id).addClass('d-none');
    $('#js-player-podcast-' + id).removeClass('d-none');
    $('#js-player-podcast-' + id + ' .mejs-play button').click();
}

/**
 * 
 * Open Modal Repost
 */
function repostModal (id) {
    $('#js-insert-repost').removeClass('d-none');
    $('#id_repost').val(id);
}

/**
 * Close Repost modal
 */
function CloseModalRespot() {
    $('#js-insert-repost').addClass('d-none');
    $('#js-repost-successful').addClass('d-none');
}

/**
 * Repost 
 */
function repostArticles() {

    var formData = new FormData();
    formData.append( 'action',  'repost' );
    formData.append(' post_id',  $('#id_repost').val() );
    formData.append( 'content',  $('#content_repost').val() );
    formData.append(' user', $( '#user_repost').val() );

    jQuery.ajax({
        cache: false,
        url: bms_vars.ajaxurl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#js-open-verified').attr('disabled', 'disabled');
        },
        success: function ( response ) {
            if ( response.data.status == 'success' ) {
                $('#js-repost-successful').removeClass('d-none');
                $('#js-insert-repost').addClass('d-none');
                //$( '#response_repost' ).html( '<p class="text-danger">' + response.data.message + '</p>' );
            } else {
                $( '#response_repost' ).html( '<p class="text-danger">' + response.data.message + '</p>' );
            }
        }
    });

    return false;
}

/**
 * Search Meta Data
 */
function get_site_og () {

    var obj_content = $('#publish_content').val();
    event.preventDefault();
    
    if (event.which == 13 && obj_content !== '') { 
    
        var formData = new FormData();
        formData.append( 'action',  'get_Site_OG' );
        formData.append('publish_content',  obj_content );

        jQuery.ajax({
            cache: false,
            url: bms_vars.ajaxurl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function ( response ) {
                if ( response.status == 'success' ) {
                    $( '#publish-content' ).html( '<div class="external-content-delete" onclick="delete_external_content_preview()"><img src="/wp-content/themes/doctorpedia/img/icons/share-repost-close.svg"></div>' + response.html );
                }
            }
        });
    }
    return false;
}

/**
 * Desktop
 */

function submit_profile_share () {

    var obj_content = $('#publish_content').val();

    if ( obj_content.trim() == '' ) return false;

    var preview = $('#publish-content').html();
    var formData = new FormData();
        formData.append( 'action',  'publish_external_blog' );
        formData.append( 'preview', preview );
        formData.append( 'content',  obj_content );

    jQuery.ajax({
        cache: false,
        url: bms_vars.ajaxurl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#js-shared-link').html('<i class="fas fa-spinner fa-pulse"></i>');
        },
        success: function ( response ) {
            if ( response.data.status == 'success' ) {
                $("#activity").load( location.href+" #activity>*","" );
                blur_profile_share();
            }
            $('#publish_content').val('');
            $('#publish-content').html('');
            $('#js-shared-link').html('Post');
        }
    });
}

/**
 * Mobile
 */
function submit_profile_share_mobile () {

    var obj_content = $('#publish_content_mobile').val();

    if ( obj_content.trim() == '' ) return false;

    var preview = $('#publish-content').html();
    var formData = new FormData();
        formData.append( 'action',  'publish_external_blog' );
        formData.append( 'preview', preview );
        formData.append( 'content',  obj_content );

    jQuery.ajax({
        cache: false,
        url: bms_vars.ajaxurl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('.js-save-animation').addClass('loading hiddenBtn').removeClass('done');
            activeTab('activity');
        },
        success: function ( response ) {
            $('.js-save-animation').removeClass('loading hiddenBtn').addClass('done');
            if ( response.data.status == 'success' ) {
                $("#activity").load( location.href+" #activity>*","" );
                blur_profile_share();
            }
            $('#publish_content_mobile').val('');
            $('#publish-content-mobile').html('');
        },
    });

    setTimeout( () => {
        activeTab('activity');
        $('.js-save-animation').removeClass('done');
        $('#js-modal-publication').addClass('d-none');
    }, 3000);
}

function focus_profile_share () {
  let body = document.querySelector('body');
  let textBox = document.querySelector('.text-box');
  let textBoxNav = document.querySelector('.text-box__nav');
  let textBoxActions = document.querySelectorAll('.text-box__action');

  body.classList.add('dimmed');
  textBox.classList.add('text-box--focused');
  textBoxNav.classList.add('text-box__nav--hidden');
  textBoxActions.forEach(action => action.classList.add('text-box__action--hidden'));
}

function blur_profile_share () {
  let body = document.querySelector('body');
  let textBox = document.querySelector('.text-box');
  let textBoxNav = document.querySelector('.text-box__nav');
  let textBoxActions = document.querySelectorAll('.text-box__action');

  body.classList.remove('dimmed');
  textBox.classList.remove('text-box--focused');
  textBoxNav.classList.remove('text-box__nav--hidden');
  textBoxActions.forEach(action => action.classList.remove('text-box__action--hidden'));
}

function delete_external_content_preview () {
    $( '#publish-content' ).html('');
}

(function(){
    var measurer = $('<span>', { style: "display:inline-block;word-break:break-word;visibility:hidden;white-space:pre-wrap;display:none;" })
        .appendTo('body');
    function initMeasurerFor(textarea){
      if(!textarea[0].originalOverflowY){
          textarea[0].originalOverflowY = textarea.css("overflow-y");    
      }  
      var maxWidth = textarea.css("max-width");
      measurer.text(textarea.text())
          .css('font',textarea.css('font'))
          .css('overflow-y', textarea.css('overflow-y'))
          .css("max-height", textarea.css("max-height"))
          .css("min-height", textarea.css("min-height"))
          .css("padding", textarea.css("padding"))
          .css("border", textarea.css("border"))
          .css("box-sizing", textarea.css("box-sizing"))
    }
    function updateTextAreaSize(textarea){
      textarea.height(measurer.height());
      var w = measurer.width();
      if(textarea[0].originalOverflowY == "auto"){
          var mw = textarea.css("max-width");
          if(mw != "none"){
            if(w == parseInt(mw)){
                textarea.css("overflow-y", "auto");
            } else {
                textarea.css("overflow-y", "hidden");
            }
          }
       }
    }
    $('textarea.autofit').on({
        input: function(){      
            var text = $(this).val();  
            if($(this).attr("preventEnter") == undefined){
                 text = text.replace(/[\n]/g, "<br>&#8203;");
            }
            measurer.html(text);                       
            updateTextAreaSize($(this));       
        },
        focus: function(){
         initMeasurerFor($(this));
        },
        keypress: function(e){
            if(e.which == 13 && $(this).attr("preventEnter") != undefined){
              e.preventDefault();
          }
        }
    });
})();

/**
 * Open Modal
 */
function openCetificationModal () {
    $('#js-modal-board-certification').removeClass('d-none');
}

function openEducationModal () {
    $('#js-modal-education').removeClass('d-none');
}

function openBioModal () {
    $('#js-modal-bio').removeClass('d-none');
}

function openLocationModal () {
    $('#js-modal-location').removeClass('d-none');
}

function openVideoModal () {
    $('#js-modal-video').removeClass('d-none');
}

function openVideoExampleModal () {
    $('#js-modal-video-example').removeClass('d-none');
}

function openExpertiseModal () {
    $('#js-modal-expertise').removeClass('d-none');
}

function openPublicationModal() {
    $('#js-modal-publication').removeClass('d-none');
    $('#publish_content_mobile').focus();
    document.getElementById("publish_content_mobile").focus().setSelectionRange(0, 999);
    setTimeout($('#publish_content_mobile').focus(), 1000);
}

/**
 * Add New Certification item html
 */
function addCertificationItemAlt () {

    let id = Math.floor(Math.random() * (99 - 0)) + 0;
    var html = '<div class="box-certification-items" id="'+id+'">';
        html += '<input type="text" name="user_certification[]" class="mr-0 certification-item" value="">';
        html += '<div onclick="deleteItemCertification('+id+')"><img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg" /></div>';
        html += '</div>';

    $('#js-certifications-items').append(html);
}

/**
 * Delete certification item
 */
function deleteItemCertification (id) {
    $('#'+id).remove();
}

/**
 * Load Sub Specialties select
 */
function saveBoardCertification () {

    $('.js-save-animation').addClass('loading hiddenBtn').removeClass('done');

    var certifications = [];

    $('.check_certification').each( function() {

        var certification = {
            certification: $(this).find('.item_certification').val(),
            subcertification: $(this).find('.item_subcertification').val(),
        }

        certifications.push( certification );
    });

    var formData = new FormData();
        formData.append( 'action',  'save_certifications' );
        formData.append( 'user_residency', $( '#user_residency').val() );
        formData.append( 'user_credential', $( '#user_credential').val() );
        formData.append( 'user_certification',  JSON.stringify(certifications) );

    jQuery.ajax({
        cache: false,
        url: pp_vars.ajaxurl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function ( response ) {
            $('.js-save-animation').removeClass('loading hiddenBtn').addClass('done');
            $('#js-certifications').load( $(location).attr('href') + ' #js-certifications' );
            closeModal()
        }
    });

    setTimeout( () => {
        $('.js-save-animation').removeClass('done');
    }, 3000);

}

/**
 * Active Board Certification
 */
let activeBoardModal = () => {
    
    document.getElementById("js-board").checked = true;
    document.getElementById("js-resident").checked = false;
    
    var board = document.getElementById('js-visible-certifications');
        board.classList.remove('d-none');
    
    var resident = document.getElementById('js-cta-resident');
        resident.classList.add('d-none');

    var credential = document.getElementById('js-visible-credential');
        credential.classList.add('d-none');

    var resident = document.getElementById('js-visible-resident');
        resident.classList.add('d-none');
}

/**
 * Active Resident
 */
let activeResidentModal = () => {
    
    var board = document.getElementById('js-visible-certifications');
        board.classList.add('d-none');
    
        document.getElementById("js-resident").checked = true;
        document.getElementById("js-board").checked = false;

    var resident = document.getElementById('js-cta-resident');
        resident.classList.remove('d-none');
}

/**
 * Active Resident Field
 */
let activeResidentFieldModal = () => {

    document.getElementById("js-resident-y").checked = true;
    document.getElementById("js-resident-x").checked = false;

    var resident = document.getElementById('js-visible-resident');
        resident.classList.remove('d-none');

    var credential = document.getElementById('js-visible-credential');
        credential.classList.add('d-none');
}

/**
 * Active Credential Field
 */
let activeCredentialFieldModal = () => {

    document.getElementById("js-resident-y").checked = false;
    document.getElementById("js-resident-x").checked = true;

    var credential = document.getElementById('js-visible-credential');
        credential.classList.remove('d-none');

    var resident = document.getElementById('js-visible-resident');
        resident.classList.add('d-none');
}

/**
 * Load Sub Specialties select Board Certification
 */
function loadSubCertification (value) {

    if ( !value ) return;

    var formData = new FormData();
        formData.append( 'action',  'load_subspecialties' );
        formData.append( 'user_specialty',  value );

    jQuery.ajax({
        cache: false,
        url: dd_vars.ajaxurl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function ( response ) {
            $( '#user_subcertification' ).html( '<option value="" selected disabled>loading...</option>' );
        },
        success: function ( response ) {
            $( '#user_subcertification' ).html( response.data );
        }
    });
    return false;
}

/**
 * Add bio specialties certification
 */
function addCertification () {
    var rand = Math.floor(Math.random() * (9999 - 9)) + 9;
    let certification = $('#user_certification').val();
    let certification_slug = certification.replace(/ /g, "-").replace(/["'()]/g, "") + rand;
    let subcertification = $('#user_subcertification').val();
    let subcertification_slug = subcertification.replace(/ /g, "-").replace(/["'()]/g, "") + rand;
    let html = '';

    if ( certification && certification !== 'none' &&  certification !== 'null' ) {
        //$("#user_certification option:selected").attr('disabled','disabled');
        html += '<li id="' + certification_slug + '"  class="d-flex flex-row check_certification">';
        html += '<div class="box-certification box-certification-purple d-flex flex-row">' + certification + '<input type="hidden" value="' + certification + '" class="item_certification"><div onclick="deleteItemcertification(this);"><img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg" /></div></div>';
    }
    if ( subcertification && subcertification !== 'none' && subcertification !== 'null' ) {
        //$("#user_subcertification option:selected").attr('disabled','disabled');
        html += '<div id="' + subcertification_slug + '"  class="box-certification box-certification-pink d-flex flex-row">' + subcertification + ' <input type="hidden" value="' + subcertification + '" class="item_subcertification"><div onclick="deleteItemSubcertification(this);"><img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg" /></div></div> ';
    }
    html += '</li>';

    $('#js-list-certification').append( html );
}

/**
 * Delete Item certification
 */
function deleteItemcertification (obj) {
    var elem = obj;
    $( elem ).parent().parent().remove();
    //$('#user_certification option[value="' + id + '"]').removeAttr('disabled');
}

function deleteItemSubcertification (obj) {
    var elem = obj;
    $( elem ).parent().parent().remove();
    //$('#user_subcertification option[value="' + id + '"]').removeAttr('disabled');
}

/**
 * Add Bio Education
 */
function addEducationItem () {

    let education = $('#user_education').val();
    let education_slug = education.replace(/ /g, "-").replace(/["'()]/g, "");
    let html = '';

    if ( education && education !== 'none' &&  education !== 'null' ) {
        html += '<li id="' + education_slug + '"  class="d-flex flex-row check_education">';
        html += '<div class="box-education box-education-purple d-flex flex-row">' + education + '<input type="hidden" value="' + education + '" class="item_education"><div onclick="deleteItemEducation(this);"><img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg" /></div></div>';
    }
    html += '</li>';

    $('#js-list-education').append( html );
    $('#user_education').val('');
}

function deleteItemEducation (obj) {
    var elem = obj;
    $( elem ).parent().parent().remove();
}

/**
 * Save Education
 */
function saveEducation () {

    var educations = [];
    
    $('.js-save-animation').addClass('loading hiddenBtn').removeClass('done');

    $('.check_education').each( function() {
        educations.push( $(this).find('.item_education').val() );
    });

    var formData = new FormData();
    formData.append( 'action',  'save_education' );
    formData.append( 'user_education', JSON.stringify(educations) );

    jQuery.ajax({
        cache: false,
        url: pp_vars.ajaxurl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function ( response ) {
            $('.js-save-animation').removeClass('loading hiddenBtn').addClass('done');
            $('#js-educations').load( $(location).attr('href') + ' #js-educations' );

            if ( response.data.length > 1 ) {
                $( '#js-educations' ).addClass('mb-4');
            } else{
                $( '#js-educations' ).removeClass('mb-4');
            }
            closeModal()
        }
    });

    setTimeout( () => {
        $('.js-save-animation').removeClass('done');
    }, 3000);

}

/**
 * Save Biography
 */
function saveBiography () {

    $('.js-save-animation').addClass('loading hiddenBtn').removeClass('done');

    var formData = new FormData();
    formData.append( 'action',  'save_biography' );
    formData.append( 'biography', $('#user_biography').val() );
    formData.append( 'biography_link', $('#user_biography_link').val() );

    jQuery.ajax({
        cache: false,
        url: pp_vars.ajaxurl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function ( response ) {
            $( '.js-save-animation' ).removeClass('loading hiddenBtn').addClass('done');
            $( '#js-author-profile-bio' ).html( response.data.data );

            if ( $('#user_biography').val().length > 1 ) {
                $( '#js-author-profile-bio' ).addClass('mb-4');
            } else{
                $( '#js-author-profile-bio' ).removeClass('mb-4');
            }
            closeModal()
        }
    });

    setTimeout( () => {
        $('.js-save-animation').removeClass('done');
    }, 3000);
}

/**
 * Save Location
 */
function saveLocation () {

    $('.js-save-animation').addClass('loading hiddenBtn').removeClass('done');

    var formData = new FormData();
        formData.append( 'action',  'save_location' );
        formData.append( 'clinic_lat',  $( '#latitud_prop' ).val() );
        formData.append( 'clinic_lng',  $( '#longitud_prop' ).val() );
        formData.append( 'clinic_name',  $( '#clinic_name' ).val() );
        formData.append( 'clinic_email',  $( '#clinic_email' ).val() );
        formData.append( 'clinic_open',  $( '#clinic_open' ).val() );
        formData.append( 'clinic_phone',  $( '#clinic_phone' ).val() );
        formData.append( 'clinic_web',  $( '#clinic_web' ).val() );
        formData.append( 'clinic_appointment',  $( '#clinic_appointment' ).val() );
        formData.append( 'clinic_location',  $( '#js-google-search' ).val() );
        formData.append( 'city',  $( '#city_prop' ).val() );
        formData.append( 'state',  $( '#state_prop' ).val() );
        formData.append( 'country',  $( '#country_prop' ).val() );

    jQuery.ajax({
        cache: false,
        url: pp_vars.ajaxurl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function ( response ) {
            $('.js-save-animation').removeClass('loading hiddenBtn').addClass('done');
            $("#js-first-column-premium").load( $(location).attr("href") + ' #js-first-column-premium' );
            closeModal()
        }
    });

    setTimeout( () => {
        $('.js-save-animation').removeClass('done');
    }, 3000);
}

/**
 * Save Expertise
 */
function saveExpertise () {

    var expertises = [];
    
    $('.js-save-animation').addClass('loading hiddenBtn').removeClass('done');

    $('.check_expertise').each( function() {
        expertises.push( $(this).find('.item_education').val() );
    });

    var formData = new FormData();
    formData.append( 'action',  'save_expertise' );
    formData.append( 'user_expertise', JSON.stringify(expertises) );

    jQuery.ajax({
        cache: false,
        url: pp_vars.ajaxurl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function ( response ) {
            $('.js-save-animation').removeClass('loading hiddenBtn').addClass('done');
            $('#js-expertises').load( $(location).attr('href') + ' #js-expertises' );

            if ( response.data.length > 1 ) {
                $( '#js-expertises' ).addClass('mb-4');
            } else{
                $( '#js-expertises' ).removeClass('mb-4');
            }
            closeModal()
        }
    });

    setTimeout( () => {
        $('.js-save-animation').removeClass('done');
    }, 3000);

}

/**
 * Map Clinic
 */
(function( $ ) {
    /**
     * initMap
     *
     * Renders a Google Map onto the selected jQuery element
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   jQuery $el The jQuery element.
     * @return  object The map instance.
     */
    function initMap( $el ) {
    
        // Find marker elements within map.
        var $markers = $el.find('.marker');
    
        // Create gerenic map.
        var mapArgs = {
            zoom        : $el.data('zoom') || 16,
            mapTypeId   : google.maps.MapTypeId.ROADMAP,
            panControl: false,
            mapTypeControl: false,
            streetViewControl: false,
            overviewMapControl: false,
            zoomControl: true,
            scaleControl: false,
            fullscreenControl: false,
            rotateControl: false
        };

        var map = new google.maps.Map( $el[0], mapArgs );
    
        // Add markers.
        map.markers = [];
        $markers.each(function(){
            initMarker( $(this), map );
        });
    
        // Center map based on markers.
        centerMap( map );

        // Search Input and push into map
        searchInput( map );
    
        // Return map instance.
        return map;
    }
    
    /**
     * initMarker
     *
     * Creates a marker for the given jQuery element and map.
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   jQuery $el The jQuery element.
     * @param   object The map instance.
     * @return  object The marker instance.
     */
    function initMarker( $marker, map ) {
    
        // Get position from marker.
        var lat = $marker.data('lat');
        var lng = $marker.data('lng');

        $("#latitud_prop").val(lat); //Set input lat
        $("#longitud_prop").val(lng); //Set input lng

        var latLng = {
            lat: parseFloat( lat ),
            lng: parseFloat( lng )
        };
    
        // Create marker instance.
        var marker = new google.maps.Marker({
            position : latLng,
            icon: "../../wp-content/themes/doctorpedia/img/authors/marker-premium.svg",
            map: map
        });
    
        // Append to reference for later use.
        map.markers.push( marker );
    
        // If marker contains HTML, add it to an infoWindow.
        if( $marker.html() ){
    
            // Create info window.
            var infowindow = new google.maps.InfoWindow({
                content: $marker.html()
            });
    
            // Show info window when marker is clicked.
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open( map, marker );
            });
        }
    }
    
    /**
     * centerMap
     *
     * Centers the map showing all markers in view.
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   object The map instance.
     * @return  void
     */
    function centerMap( map ) {
    
        // Create map boundaries from all map markers.
        var bounds = new google.maps.LatLngBounds();
        map.markers.forEach(function( marker ){
            bounds.extend({
                lat: marker.position.lat(),
                lng: marker.position.lng()
            });
        });
    
        // Case: Single marker.
        if( map.markers.length == 1 ){
            map.setCenter( bounds.getCenter() );
    
        // Case: Multiple markers.
        } else{
            map.fitBounds( bounds );
        }
    }


    function searchInput( map ) {
        
        var input = document.getElementById('js-google-search');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    
        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });
    
        var markers = [];
        // [START region_getplaces]
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
    
        if (places.length == 0) {
            return;
        }
    
        // Clear out the old markers.
        markers.forEach(function(marker) {
            marker.setMap(null);
        });
        markers = [];
    
        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
                
            // Create a marker for each place.
            markers.push(new google.maps.Marker({
                map: map,
                icon: "../../wp-content/themes/doctorpedia/img/authors/marker-premium.svg",
                title: place.name,
                position: place.geometry.location
            }));

            const componentForm = {
                street_number: "short_name",
                route: "long_name",
                locality: "long_name",
                administrative_area_level_1: "short_name",
                country: "long_name",
                postal_code: "short_name",
            };

            for (const component of place.address_components) {
                const addressType = component.types[0];
            
                if (componentForm[addressType]) {
                    const val = component[componentForm[addressType]];

                    if ( addressType == 'locality') {
                        $("#city_prop").val(val); //set input City
                    }
                    if ( addressType == 'administrative_area_level_1') {
                        $("#state_prop").val(val); //set input State
                    }
                    if ( addressType == 'country') {
                        $("#country_prop").val(val); //set input State
                    }
                }
            }

            $("#latitud_prop").val(place.geometry.location.lat); //set input lat
            $("#longitud_prop").val(place.geometry.location.lng); //set input lng
    
            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });

        map.fitBounds(bounds);

        });
    }
    
    // Render maps on page load.
    $(document).ready(function(){
        $('.acf-map').each(function(){
            var map = initMap( $(this) );
        });
    });
    
})(jQuery);

$('#js-google-search').keypress(function(e) { 
    return e.keyCode != 13;
});

/**
 * Active CTA posts
 */
let activeCTA = (elem) => {
    var cta = elem.nextSibling;
    cta.nextElementSibling.classList.toggle('d-none');
}

/**
 * Delete Post
 */
function deletePostProfile ( elem ) {
    $('#js-modal-delete-post').removeClass('d-none');
    $('#js-delete-verified').attr('data-id', $(elem).attr('data-id'));
}

/**
 * Delete Post
 */
$('#js-delete-verified').on('click', function() {

    var post_id = $(this).attr('data-id');
    $('#js-modal-delete-post').addClass('d-none');

    var formData = new FormData();
        formData.append( 'action',  'delete_post' );
        formData.append( 'post_id', post_id );

    jQuery.ajax({
        cache: false,
        url: pp_vars.ajaxurl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#js-cta-container').addClass('d-none');
            $('#post_' + post_id).css('background-color','rgba(255,0,0, 0.2)');
            $('#post_' + post_id).hide('slow');
        },
        success: function ( response ) {
            $('#post_' + post_id).remove();
        }
    });

});

/**
 * Cancel delet post
 */
function cancelDeletePost() {
    $('#js-modal-delete-post').addClass('d-none');
    $('#js-cta-container').addClass('d-none');
}

 /**
  * Feature post
  */
function featurePostProfile( elem ) {

    var post_id = $( elem ).attr('data-id');

    var formData = new FormData();
        formData.append( 'action',  'feature_post' );
        formData.append( 'post_id', post_id );

    jQuery.ajax({
        cache: false,
        url: pp_vars.ajaxurl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $(elem).css({'color':'#41b883'});
        },
        success: function ( response ) {
            $("#js-first-column-premium").load( $(location).attr("href") + ' #js-first-column-premium' );
        }
    });
}

/**
 * Copy post
 */
function copyPostProfile ( link ) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(link).attr('data-link')).select();
    $(link).css({'color':'#41b883'});
    $('.custom-item-copy').css({'background-color':'#41b883'}); // Single Videos Page
    $(".post-share-title").append(' <span class="text-success">Link copied!</span>');
    document.execCommand("copy");
    $temp.remove();
}

/**
 * Detect paste link
 */
$(document).ready(function() {
    $("#publish_content").bind({
        paste : function(){

            setTimeout(function(){
                var obj_content = $('#publish_content').val();
                if ( obj_content.trim() == '' ) {
                    return false;
                }
                
                var formData = new FormData();
                formData.append( 'action',  'get_Site_OG' );
                formData.append('publish_content',  obj_content );
    
                jQuery.ajax({
                    cache: false,
                    url: bms_vars.ajaxurl,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function ( response ) {
                        if ( response.status == 'success' ) {
                            $( '#publish-content' ).html( '<div class="external-content-delete" onclick="delete_external_content_preview()"><img src="/wp-content/themes/doctorpedia/img/icons/share-repost-close.svg"></div>' + response.html );
                        }
                    }
                });
            }, 1000);

        }
        /* copy : function(){
            alert('¡Has copiado!');
        },
        cut : function(){
            alert('¡Has cortado!');
        } */
    });
});

/**
 * Count Characters
 */
function countChars (obj) {
    var maxLength = 500;
    var strLength = obj.value.length;
    
    if ( strLength >= maxLength ) {
        document.getElementById("charNum").innerHTML = '<span class="text-danger text-min">'+strLength+' out of '+maxLength+' characters</span>';
        $(obj).val($(obj).val().substring(0,maxLength));
        return false;
    } else {
        document.getElementById("charNum").innerHTML = strLength+' out of '+maxLength+' characters';
    }

}

/**
 * Active Tabs by hashtag url
 */
jQuery( document ).ready( function() {

    let brand = false;
    if ( window.location.hash && ! brand ) {
        var hash = window.location.hash.replace('#','');
        var author_id = $("#js-author__nav").attr("data-id");
        activeTab(hash);
        $(window).scrollTop(0);
        brand = true;
        if (hash === "activity") return false;
        load_posts_categ(author_id, hash);
    }
    $(window).off('scroll');
});

/**
 * Add Area of Expertise
 */
function addExpertiseItem () {

    let expertise = $('#user_expertise').val();
    let expertise_slug = expertise.replace(/ /g, "-").replace(/["'()]/g, "");
    let html = '';

    if ( expertise && expertise !== 'none' &&  expertise !== 'null' ) {
        html += '<li id="' + expertise_slug + '"  class="d-flex flex-row check_expertise">';
        html += '<div class="box-education box-education-purple d-flex flex-row">' + expertise + '<input type="hidden" value="' + expertise + '" class="item_education"><div onclick="deleteExpertiseItem(this);"><img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg" /></div></div>';
    }
    html += '</li>';

    $('#js-list-expertise').append( html );
    $('#user_expertise').val('');
}

function deleteExpertiseItem (obj) {
    var elem = obj;
    $( elem ).parent().parent().remove();
}

/**
 * See more - Area of Expertise
 */
jQuery( document ).ready( function() {

    var items = $('#js-expertises ul li');

    if ($(window).width() > 768) {
        if ( items.length > 3 ) {
            showLessItems();
         }
    }
});
 
/**
 * Active last items - Area of Expertise
 */
function showMoreItems () {

    var items = $('#js-expertises ul li');
    
    $.each(items, function( index, value ) {
        $(this).removeClass('d-none');
    });

    $('#js-see-more-expertise').addClass('d-none');
    $('#js-see-less-expertise').removeClass('d-none');
}

/**
 * Active last items - Area of Expertise
 */
function showLessItems () {

    var items = $('#js-expertises ul li');
    
    $.each(items, function( index, value ) {
        if (index > 2) { 
            $(this).addClass('d-none'); 
        }
    });

    $('#js-see-more-expertise').removeClass('d-none');
    $('#js-see-less-expertise').addClass('d-none');
}

/**
 * Toggle Specialties - Public Profile
 */
function toggleSpecialtiesPopup () {
    $('.author__profile-container').toggle();
    $('#toggleImg').toggleClass('ToggleActive');
}

/**
 * Hide footbar on scroll final page
 */
$(document).ready(function(){
    $(window).on('scroll', function () { // Evento de Scroll
        if (($(window).scrollTop() + $(window).height()) == $(document).height()) { // Si estamos al final de la página
            $('.ocultar').stop(true).animate({ // Escondemos el div
                opacity: 0
            }, 50);
        } else { // Si no
            $('.ocultar').stop(true).animate({ // Mostramos el div
                opacity: 1
            }, 10);
        }
    });
});

/**
 * Load More Post Activity
 */
var ppp = 10;
var pageNumber = 1;

function load_posts(author_id) {
    pageNumber++;

    $('#more_posts').html('<i class="fa fa-spinner fa-spin"></i>');

    //Api rest call
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.open('GET', `${window.location.origin}/wp-json/doctorpedia/v2/profile-load-content?ppp=${ppp}&author_id=${author_id}&pageNumber=${pageNumber}`, true);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 200) {
                //Res content
                let obj = JSON.parse(xmlhttp.responseText);
                var data = obj.data.html;
                let count = obj.data.count;
                let total = obj.data.total;
                console.log(count, total);
                if(total !== 0){
                    $("#ajax-posts").append(data);
                    if (parseInt(count) == 10 && parseInt(total) > 10) {
                        $('#more_posts').html('Load More');
                    } else {
                        $('#more_posts').addClass('d-none');
                    }
                } else{
                    $('.spin-loader').addClass('d-none');
                    $('#more_posts').html('<i class="fa fa-check"></i>');
                    $('#more_posts').addClass('complete-pagination');
                    $('#more_posts').addClass('d-none');
                }

            }
        }
    };
    xmlhttp.send(null);
}

// Load More Activity Button Click Event
$("#more_posts").on("click",function(){ // When btn is pressed.
    var author_id = $("#js-author__nav").attr("data-id");
    load_posts(author_id);
});

/**
 * Load More Post Categories
 */
function load_posts_categ(author_id, category=false, pageNumberCategory=false) {

    if (!pageNumberCategory) {
        pageNumberCategory = 0;
    }
        
    $("#js-placeholder-"+category).addClass('d-none');
    if (pageNumberCategory > 0) {
        $("#ajax-posts-" + category).next().html('<i class="fa fa-spinner fa-spin"></i>');
    } else {
        $("#ajax-posts-" + category).html('<img src="/wp-content/themes/doctorpedia/img/Spin-1s-200px.gif" width="50px" class="spin-loader mb-5"><br>');
    }
    
    //Api rest call
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.open('GET', `${window.location.origin}/wp-json/doctorpedia/v2/profile-load-content?ppp=${ppp}&author_id=${author_id}&category=${category}&pageNumber=${pageNumberCategory}`, true);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 200) {
                //Res content
                let obj = JSON.parse(xmlhttp.responseText);
                var data = obj.data.html;
                let count = obj.data.count;
                let total = obj.data.total;
        
                if (total === 0 && pageNumberCategory === 0) {
                    $('.spin-loader').addClass('d-none');
                    $("#ajax-posts-" + category).append(data);
                }
                if(data !=="" && pageNumberCategory === 0){
                    $("#ajax-posts-" + category).html(data);
                    if (parseInt(count) == 10 && parseInt(total) > 10) {
                        $("#ajax-posts-" + category).next().html('Load More');
                        $("#ajax-posts-" + category).next().removeClass('d-none');
                    } else {
                        $("#ajax-posts-" + category).next().addClass('d-none');
                    }
                    $("#ajax-posts-" + category).next().attr('data-page', parseInt(pageNumberCategory)+1);
                } else if(data !== "" && pageNumberCategory > 0){
                    $("#ajax-posts-" + category).append(data);
                    if (parseInt(count) == 10 && parseInt(total) > 10) {
                        $("#ajax-posts-" + category).next().html('Load More');
                        $("#ajax-posts-" + category).next().removeClass('d-none');
                    } else {
                        $("#ajax-posts-" + category).next().addClass('d-none');
                    }
                    $("#ajax-posts-" + category).next().attr('data-page', parseInt(pageNumberCategory)+1);
                } else {
                    $("#ajax-posts-" + category).next().html('<i class="fa fa-check"></i>');
                    $("#ajax-posts-" + category).next().addClass('complete-pagination');
                    $('#more_posts').addClass('d-none');
                }
            }
        }
    };
    xmlhttp.send(null);
}


// Tab Content Click Event
$(".author__content-nav-item").on("click", function(){
    var author_id = $("#js-author__nav").attr("data-id");
    var category = $(this).attr("data-id");
    var page = $("#ajax-posts-" + category).next().attr("data-page");
    if (category === "activity" || page > 0) {
        return false;
    }
    load_posts_categ(author_id, category);
});

// Load More Categories Button Click Event
$(".more-posts").on("click", function(){
    var author_id = $("#js-author__nav").attr("data-id");
    var category = $(this).attr("data-id");
    var pageNumberCategory = $(this).attr("data-page");
    load_posts_categ(author_id, category, pageNumberCategory);
});