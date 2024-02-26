jQuery( document ).ready( function () {

    /**
     * Send Form button Network
     */
    $('#js-discover-health').click( function(){

        if ( $('#js-search-condition').val() == '' ) {
            $('#js-search-condition').css({'border':'2px solid red'});
            return;
        }

        if ( $('#js-search-condition').val().length  < 3 ) {
            $('#js-search-condition').css({'border':'2px solid red'});
            return;
        }

        $(this).addClass('loading hiddenBtn').removeClass('done');

        if( !validateInput() ) {
            $( '#js-discover-search-resources' ).removeClass('d-none');
            $( '#js-sr-form-discover-health-label').removeClass('d-none');
            $( '#js-sr-form-discover-health-checkbox').removeClass('d-none');
            $( '#js-discover-health').removeClass('loading hiddenBtn');
            return false;
        }

    });

    /**
     * Send Form button Local
     */
    $('#js-discover-health-local').click( function(){

        if ( $('#js-search-condition').val() == '' ) {
            $('#js-search-condition').css({'border':'2px solid red'});
            return;
        }

        if ( $('#js-search-condition').val().length  < 3 ) {
            $('#js-search-condition').css({'border':'2px solid red'});
            return;
        }

        $(this).addClass('loading hiddenBtn').removeClass('done');

        if( !validateInput() ) {
            $( '#js-discover-search-resources' ).removeClass('d-none');
            $( '#js-sr-form-discover-health-label').removeClass('d-none');
            $( '#js-sr-form-discover-health-checkbox').removeClass('d-none');
            $( '#js-discover-health-local').removeClass('loading hiddenBtn');
            return false;
        }

    });

    /**
     * Default Send Form Button
     */
    $('input').keypress(function() {
        $( '#js-discover-health' ).removeClass('done');
    });

    /**
     * Input Validation
     */
    $("#js-search-condition").bind('keypress', function(event) {
        var regex = new RegExp("^[a-zA-Z0-9 -]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
          event.preventDefault();
          return false;
       }
    });

    /**
     * Filter LightSites
     */
    $("#js-light-sites-header").on( "click", "h5", function( event ) {

        var filter = $(this).attr('data-categ');

        $("#js-light-sites-header h5").removeClass('active');

        $(this).addClass('active');

        $('#js-light-sites-body .blog-post-preview').each( function() {

            var elem = $(this).attr('data-categ');

            if ( elem.includes( filter ) ) {

                $(this).addClass('d-flex').removeClass('d-none');
                
            }else {

                $(this).addClass('d-none').removeClass('d-flex');

            }

        });

    });

    /**
     * Filter Resources
     */
    $("#js-resources-header").on( "click", "h5", function( event ) {

        var filter = $(this).attr('data-categ');

        $("#js-resources-header h5").removeClass('active');

        $(this).addClass('active');

        $('#js-resources-body .blog-post-preview').each( function() {

            var elem = $(this).attr('data-categ');

            if ( elem.includes( filter ) ) {

                $(this).addClass('d-flex').removeClass('d-none');
                
            }else {

                $(this).addClass('d-none').removeClass('d-flex');

            }

        });

    });

});

/**
 * Validate input
 */
function validateInput() {
    var regex = new RegExp("^[a-zA-Z0-9 -]+$");
    if ( !regex.test( $("#js-search-condition").val() ) ) {
        $("#js-search-condition").val('invalid search');
        return false;
    }
    return true;
}

/**
 * Disable copy-paste
 */
window.onload = function() {
    var myInput = document.getElementById('js-search-condition');
    myInput.onpaste = function(e) {
      e.preventDefault();
      alert("this action is prohibited");
    }
    
    myInput.oncopy = function(e) {
      e.preventDefault();
      alert("this action is prohibited");
    }
}

/**
 * Remove Item from Array checkbox
 */
function removeItemFromArr ( arr, item ) {
    
    $( 'input[type="checkbox"]:checked' ).map(function() {
        if ( $( this ).val() == 'All' ) {
            $( this ).prop("checked", false);
        }
    }).get();

    var i = arr.indexOf( item );
    
    if ( i !== -1 ) {
        arr.splice( i, 1 );
    }
}

/**
 * Remove Items from top filters
 */
function switchFiltersCategory ( filter ) {

    if ( filter === 'all') {

        $( '#js-sr-form-discover-health' ).submit();

        if ( $('#js-search-condition').val() == '' ) {
            $('#js-search-condition').css({'border':'2px solid red'});
            return;
        }

        if ( $('#js-search-condition').val().length  < 3 ) {
            $('#js-search-condition').css({'border':'2px solid red'});
            return;
        }

        $('#js-discover-health').addClass('loading hiddenBtn').removeClass('done');

    } else {

        $( '#js-featured-app' ).parent().addClass('d-none');
        $( '#js-light-sites-header' ).parent().addClass('d-none');
        $( '#js-light-sites-body' ).parent().addClass('d-none');
        $( '#js-app-reviews' ).parent().addClass('d-none');
        $( '#js-reviews' ).parent().addClass('d-none');
        $( '#js-articles' ).parent().addClass('d-none');
        $( '#js-channels' ).parent().addClass('d-none');
        $( '#js-videos' ).parent().addClass('d-none');
        $( '#js-resources-header' ).parent().addClass('d-none');
        $( '#js-resources-body' ).parent().addClass('d-none');
        
    }

    $( '#js-top-elements-filters a' ).each( function ( ) {
        $( this ).removeClass('active');
    });

}

/**
 * Active Elements - DOM
 */
function activeElements ( response ) {

    var total = 0;

    if ( response.data.FeaturedApp.body ) {
        $( '#js-count-featured-app' ).html( response.data.FeaturedApp.body.length );
        $( '#js-featured-app' ).parent().removeClass('d-none');
        $( '#js-featured-app' ).html( response.data.FeaturedApp.body );
        total = total + response.data.FeaturedApp.body.length;
    } else {
        $( '#js-count-featured-app' ).html( '0' );
        $( '#js-featured-app' ).parent().addClass('d-none');
    }

    if ( response.data.lightSites.body ) {
        $( '#js-count-light-sites' ).html( response.data.lightSites.body.length );
        $( '#js-light-sites-header' ).parent().removeClass('d-none');
        $( '#js-light-sites-body' ).parent().removeClass('d-none');
        $( '#js-light-sites-header' ).html( response.data.lightSites.header );
        $( '#js-light-sites-body' ).html( response.data.lightSites.body );
        //$( '#js-top-elements-filters' ).removeClass('d-flex').addClass('d-none');
        total = total + response.data.lightSites.body.length;
    } else {
        //$( '#js-top-elements-filters' ).removeClass('d-none').addClass('d-flex');
        $( '#js-count-light-sites' ).html( '0' );
        $( '#js-light-sites-header' ).parent().addClass('d-none');
        $( '#js-light-sites-body' ).parent().addClass('d-none');
    }
        
    if ( response.data.appReviews ) {
        $( '#js-count-app' ).html( response.data.appReviews.length );
        $( '#js-app-reviews' ).parent().removeClass('d-none');
        $( '#js-app-reviews' ).html( response.data.appReviews );
        total = total + response.data.appReviews.length;
    } else {
        $( '#js-count-app' ).html( '0' );
        $( '#js-app-reviews' ).parent().addClass('d-none');
    }

    if ( response.data.channels ) {
        $( '#js-count-channels' ).html( response.data.channels.length );
        $( '#js-channels' ).parent().removeClass('d-none');
        $( '#js-channels' ).html( response.data.channels );
        total = total + response.data.channels.length;
    } else {
        $( '#js-count-channels' ).html( '0' );
        $( '#js-channels' ).parent().addClass('d-none');
    }

    if ( response.data.reviews ) {
        $( '#js-count-reviews' ).html(response.data.reviews.length );
        $( '#js-reviews' ).parent().removeClass('d-none');
        $( '#js-reviews' ).html( response.data.reviews );
        total = total + response.data.reviews.length;
    } else {
        $( '#js-count-reviews' ).html( '0' );
        $( '#js-reviews' ).parent().addClass('d-none');
    }

    if ( response.data.articles ) {
        $( '#js-count-articles' ).html(response.data.articles.length );
        $( '#js-articles' ).parent().removeClass('d-none');
        $( '#js-articles' ).html( response.data.articles );
        total = total + response.data.articles.length;
    } else {
        $( '#js-count-articles' ).html( '0' );
        $( '#js-articles' ).parent().addClass('d-none');
    }

    if ( response.data.videos ) {
        $( '#js-count-videos' ).html(response.data.videos.length );
        $( '#js-videos' ).parent().removeClass('d-none');
        $( '#js-videos' ).html( response.data.videos );
        total = total + response.data.videos.length;
    } else {
        $( '#js-count-videos' ).html( '0' );
        $( '#js-videos' ).parent().addClass('d-none');
    }

    if ( response.data.resources.body ) {
        $( '#js-count-resources' ).html(response.data.resources.body.length );
        $( '#js-resources-header' ).parent().removeClass('d-none');
        $( '#js-resources-body' ).parent().removeClass('d-none');
        $( '#js-resources-header' ).html( response.data.resources.header );
        $( '#js-resources-body' ).html( response.data.resources.body );
        total = total + response.data.resources.body.length;
    } else {
        $( '#js-count-resources' ).html( '0' );
        $( '#js-resources-header' ).parent().addClass('d-none');
        $( '#js-resources-body' ).parent().addClass('d-none');
    }

    return total;
}

/**
 * Clean Page
 */
function clean_page() {
    event.preventDefault();
    $( '#js-featured-app' ).empty();
    $( '#js-light-sites-header' ).empty();
    $( '#js-light-sites-body' ).empty();
    $( '#js-app-reviews' ).empty();
    $( '#js-reviews' ).empty();
    $( '#js-videos' ).empty();
    $( '#js-articles' ).empty();
    $( '#js-channels' ).empty();
    $( '#js-resources-header' ).empty();
    $( '#js-resources-body' ).empty();
    $( '#js-var-to-search' ).html('');
    $( '#js-top-elements-filters' ).removeClass('d-flex');
    $( '#sub-menu' ).removeClass('d-none');
    $( '#js-clean-page' ).addClass('d-none');
    $( '#js-discover-search-resources' ).addClass('d-none');
    $( '#js-discover-health' ).removeClass('done');
    $( '#js-search-condition').val('');
    $( '#js-search-top-menu' ).removeClass('d-none');
    $( '.hide-on-search' ).show();
}

jQuery( document ).ready( function() {

    let brand = false;
    if ( window.location.hash && ! brand ) {
        var hash = window.location.hash.replace('#','');
        $( '#js-search-condition' ).val(atob(hash));
        setTimeout(function(){
            $( '#js-discover-health' ).click();
         }, 3000);
        brand = true;
    }
    
    /**
     * Ajax Network Submit
     */
    jQuery( '#js-sr-form-discover-health' ).submit( function ( event ) {

            event.preventDefault();

            brand = true;

            var serialize = $( this ).serializeArray();
            
            var checks = $( 'input[type="checkbox"]:checked' ).map(function() {
                return $( this ).val();
            }).get();

            if( checks.length == 0 ) {

                $( '#js-sr-form-discover-health-checkbox label' ).css({'color':'red'});
                return;

            }else if ( checks.length > 1 ){

                $( '#js-sr-form-discover-health-checkbox label' ).css({'color':'black'});
                removeItemFromArr( checks, 'All' );
            }

            if ( checks.length >= 1 ){
                $( '#js-sr-form-discover-health-checkbox label' ).css({'color':'black'});
            }

            if ( $('#js-search-condition').val() == '' ) {
                return;
            } else {
                $('#js-search-condition').css({'border':'1px solid #cccccc'});
            }

            window.location.hash = btoa(serialize[ 0 ].value); //hash the search base64
            
            var formData = new FormData();

            formData.append('action',  'custom_get_sites' );

            formData.append('search',  serialize[ 0 ].value );

            formData.append('filters',  checks );

            jQuery.ajax({
                cache: false,
                url: $( '#js-sr-form-discover-health' ).attr( 'action' ),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $( '#js-featured-app' ).empty();
                    $( '#js-light-sites-header' ).empty();
                    $( '#js-light-sites-body' ).empty();
                    $( '#js-app-reviews' ).empty();
                    $( '#js-reviews' ).empty();
                    $( '#js-videos' ).empty();
                    $( '#js-resources-header' ).empty();
                    $( '#js-resources-body' ).empty();
                    $( '#js-channels' ).empty();
                    $( '#js-articles' ).empty();
                    $( '#js-clean-page' ).removeClass('d-none');
                    $( '#sub-menu' ).addClass('d-none');
                    $( '#js-search-top-menu' ).addClass('d-none');
                },
                success: function ( response ) {
                    //$( '#js-discover-search-resources' ).addClass('d-block');
                    $( '#js-top-elements-filters' ).addClass('d-flex');
                    $( '#js-var-to-search' ).html( activeElements(response) + ' Doctor-vetted results for "' + response.data.search + '"' );
                    $( '#light-site-title' ).html( 'Discover ' + response.data.search + ' resources' );
                },
                complete: function () {
                    $( '#js-discover-search-resources' ).removeClass('d-none');
                    $( '#js-sr-form-discover-health-label').removeClass('d-none');
                    $( '#js-sr-form-discover-health-checkbox').removeClass('d-none');
                    $( '#js-discover-health').removeClass('loading hiddenBtn').addClass('done');
                    $( '.hide-on-search' ).hide(); // hide rest of content
                    $( '#js-doctor-directory-module-vc' ).hide(); //hide doctor directory module
                }
            });

            return false;
    });


    /**
     * Ajax Local Submit
     */
    jQuery( '#js-discover-health-local' ).on( 'click', function ( event ) {

        event.preventDefault();
        
        var checks = $( 'input[type="checkbox"]:checked' ).map(function() {
            return $( this ).val();
        }).get();

        if( checks.length == 0 ) {

            $( '#js-sr-form-discover-health-checkbox label' ).css({'color':'red'});
            return;

        }else if ( checks.length > 1 ){

            $( '#js-sr-form-discover-health-checkbox label' ).css({'color':'black'});
            removeItemFromArr( checks, 'All' );
        }

        if ( checks.length >= 1 ){
            $( '#js-sr-form-discover-health-checkbox label' ).css({'color':'black'});
        }

        if ( $('#js-search-condition').val() == '' ) {
            return;
        } else {
            $('#js-search-condition').css({'border':'1px solid #cccccc'});
        }

        window.setTimeout(function(){
            $('#js-discover-health-local').removeClass('loading hiddenBtn').addClass('done');
        }, 2000);

        window.location = $('#js-sr-form-discover-health').attr('data-action') + '?search=' + $('#js-search-condition').val() + '&selection=' + checks;
        
    });

});

