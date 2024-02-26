$(document).ready(function() {

    // add autocomplete off inputs
    $.each($('.affiliate-form').serializeArray(), function(i, field) {
        $('input[name="'+ field.name +'"]').attr('autocomplete','off');
    });

    if (document.querySelector('.input__code') !== null) {
        $(".input__code .medium").parent().append('<div class="text-danger js-gf-message-4"></div>');
        $(".input__code .medium").parent().append('<div class="text-danger js-gf-loader"></div>');
        $('.gform_button').attr('disabled', true);
        $('.affiliate-form').attr('autocomplete','off');
    
        // listener for GET vars
        var code = getQueryVariable('code');
    
        if ( code ) {
            $(".input__code .medium").val(code);
            $('.gform_button').removeAttr('disabled');
        }
    
        // listener form affiliate - input code 
        $(".input__code .medium").keyup(function(){
    
            var input__code = $(this);
    
            var formData = new FormData();
                formData.append('action',ajax_var.action);
                formData.append('code', input__code.val() );
                formData.append('nonce', ajax_var.nonce)
        
            jQuery.ajax({
                cache: false,
                url: ajax_var.url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.js-gf-loader').html('<img src="/wp-content/themes/doctorpedia/img/Spin-1s-200px.gif" width="15px">');
                },
                success: function (response) {
                    $('.js-gf-loader').html('');
                    if(response.data.status == 'error'){
                        input__code.css('border','1px solid red');
                        $('.js-gf-message-4').html('Invalid Code');
                        $('.gform_button').attr('disabled', true);
                    }else{
                        input__code.css('border','1px solid green');
                        $('.js-gf-message-4').html('');
                        $('.gform_button').removeAttr('disabled');
                    }
                }
            })
        })
    }

    /* Form Gravity */
    $('#gform_submit_button_6').click(()=> {
       $('#js-register-form').removeClass('d-none');
       var email = $('#input_6_1').val();
       $('#user_email').val(email);
    });

    /* Form Register */
    jQuery( '#js-form-register' ).submit( function ( event ) {

       event.preventDefault();

       if ( $('#user_fistname').val() == '' ) {
           $("#js-register-messageForm").html('<p class="text-danger">Please complete Fist Name</p>');
           return;
       }
       if ( $('#user_lastname').val() == '' ) {
           $("#js-register-messageForm").html('<p class="text-danger">Please complete Last Name</p>');
           return;
       }
       if ( $('#user_email').val() == '' ) {
           $("#js-register-messageForm").html('<p class="text-danger">Please complete Email</p>');
           return;
       }
       if ( $('#user_pass').val() == '' ) {
           $("#js-register-messageForm").html('<p class="text-danger">Please complete Password</p>');
           return;
       }
       if ( $('#user_repass').val() == '' ) {
           $("#js-register-messageForm").html('<p class="text-danger">Please complete Confirm Password</p>');
           return;
       }
       if ( $('#user_repass').val() !== $('#user_pass').val()) {
           $("#js-register-messageForm").html('<p class="text-danger">Passwords don\'t match</p>');
           return;
       }

       if ( $('#terms').is(':checked') ) {

       } else {
           $("#js-register-messageForm").html('<p class="text-danger">Please Accept Terms & Conditions</p>');
           return;
       }
               
       var formData = new FormData();
       formData.append('action', 'blogging_Register' );
       formData.append('user_fistname',  $('#user_fistname').val() );
       formData.append('user_lastname', $('#user_lastname').val() );
       formData.append('user_email', $('#user_email').val() );
       formData.append('user_pass', $('#user_pass').val() );

       jQuery.ajax({
           cache: false,
           url: $( '#js-form-register' ).attr( 'action' ),
           type: 'POST',
           data: formData,
           contentType: false,
           processData: false,
           beforeSend: function () {
               $("#js-register-messageForm").fadeIn('fast');
               $("#js-register-messageForm").html('<p class="text-info">Sending....</p>');
           },
           success: function ( response ) {
               if ( response.success == true ) {
                   $("#js-register-messageForm").html('<p class="text-success">Your registration has been successful! redirecting...</p>');
                   $("#js-register-submit").attr('disabled:disabled');
                   $(location).attr('href', '/doctor-platform/complete-bio/');
               } else {
                   $("#js-register-messageForm").html('<p class="text-danger">' + response.data + '</p>');
               }
           }
       });
       return false;
    });

});



// search var from url
function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable) {
            return pair[1];
        }
    }
    return false;
 }

 /**
 * Open modal terms
 */
function open_modal_terms_form() {
    $('#js-terms-conditions-form').removeClass('d-none'); 
}

function closeTermsModal() {
    $('#js-terms-conditions-form').addClass('d-none');
}
function hide_terms_modal() {
    $('#terms').prop( "checked", true );
    $('#js-terms-conditions-form').addClass('d-none');
}

 /**
 * Close Repost modal
 */
function CloseModalRegister() {
    $('#js-register-form').addClass('d-none');
}