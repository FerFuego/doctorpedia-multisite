<?php

//Register "container" content element. It will hold all your inner (child) content elements
vc_map(
    array(
        "name" => __("Non-Profit Map", "my-text-domain"),
        "base" => "vc_nonProfit",
        "as_parent" => array('only' => 'vc_nonProfitPoint, vc_doctorPoint'),
        'description' => __('Non-Profit Module', 'text-domain'),
        "content_element" => true,
        "show_settings_on_create" => false,
        "is_container" => true,
        'category' => __('DoctorPedia Elements', 'text-domain'),   
        'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
        "js_view" => 'VcColumnView',
        'params' => array(
            array(
                'type' => 'textfield',
                'class' => 'title-class',
                'heading' => __( 'Title', 'text-domain' ),
                'param_name' => 'title',
                'value' => __( '', 'text-domain' ),
                'description' => __( '', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
            ),
        ),
    )
);

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_vc_nonProfit extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_map_output')){
    
    function wbc_map_output( $atts, $content = null){

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title' => '',
                ), 
                $atts
            )
        );   

        return customMapContainerHtml( $title, do_shortcode( $content ));
    }
    add_shortcode( 'vc_nonProfit' , 'wbc_map_output' );
    add_shortcode( 'vc_doctorPoint', 'wbc_map_output' );

    function customMapContainerHtml($title, $data){
        ob_start(); ?>
         <!-- Map Module VC -->
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo GMAPS_API_KEY ?>"></script>

        <script type="text/javascript">
        
            google.maps.event.addDomListener(window, "load", init);

            // Rendered points on the map
            function init() {
                var mapOptions = {
                    zoom: 4.5,
                    scrollwheel: false,
                    center: new google.maps.LatLng('40.3295695','-98.6569538'), // Kansas City, Mi
                };

                if ($(window).width() < 768) {
                    var mapOptions = {
                        zoom: 2.8,
                        scrollwheel: false,
                        center: new google.maps.LatLng('40.3295695','-98.6569538'), // Kansas City, Mi
                    };
                }

                var mapElement = document.getElementById("map");
                var map = new google.maps.Map(mapElement, mapOptions);
                var infoWindow = new google.maps.InfoWindow(), marker, i;

                var markerList = '[<?php echo str_replace( '}{','},{', $data ); ?>]';

                $.each( JSON.parse( markerList ), function( key, value ) {

                    var show_key = key + 1;

                    var template = ['<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42 42" width="42px" height="42px" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><g id="All" fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g id="Desktop-Condition-specific-Home-Copy-7" transform="translate(-388 -332)"><g id="Find-a-Clinic" transform="translate(0 132)"><g id="Group" transform="translate(388 200)"><circle id="Oval-Copy-80" fill="#df054e" cx="21" cy="21" r="21" /><text id="1-copy-18" font-family="Helvetica" font-size="20px" font-weight="normal" fill="#ffffff"><tspan x="15" y="27">' + show_key + '</tspan></text></g></g></g></g></svg>'].join("\n");
                            
                    marker = new google.maps.Marker({
                        position: {lat: parseFloat(value.lat_vc), lng: parseFloat(value.long_vc) },
                        map: map,
                        animation: google.maps.Animation.DROP,
                        title: value.name,
                        icon: { url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(template), scaledSize: new google.maps.Size(30, 30) },
                    });

                    google.maps.event.addListener(marker, "click", (function(marker, i) {
                        return function() {
                            descriptionPop( key, value.name, value.address, value.phone, value.link_web, value.specialty, value.link_bio, value.open, value.type);
                        }
                    })(marker, i));
                    
                });
 
            }//end init
            
            // Relocate on the map
            function relocate(mark){
                var id_point    = document.getElementById(mark).getAttribute("data-id"),
                    num         = document.getElementById(mark).getAttribute("data-num"),
                    lat         = document.getElementById(mark).getAttribute("data-lat"),
                    lng         = document.getElementById(mark).getAttribute("data-lng"),
                    title       = document.getElementById(mark).getAttribute("data-title"),
                    address     = document.getElementById(mark).getAttribute("data-address"),
                    phone       = document.getElementById(mark).getAttribute("data-phone"),
                    website     = document.getElementById(mark).getAttribute("data-web"),
                    position    = document.getElementById(mark).getAttribute("data-position"),
                    fullbios    = document.getElementById(mark).getAttribute("data-link"),
                    open        = document.getElementById(mark).getAttribute("data-open"),
                    type        = document.getElementById(mark).getAttribute("data-type");

                descriptionPop(id_point, title, address, phone, website, position, fullbios, open, type);

                var mapOptions = {
                    zoom: 12,
                    scrollwheel: false,
                    center: new google.maps.LatLng(lat,lng), // marker
                };

                var mapElement = document.getElementById("map");
                var map = new google.maps.Map(mapElement, mapOptions);
                var infoWindow = new google.maps.InfoWindow(), marker, i;

                // Render select point
                var template = ['<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42 42" width="42px" height="42px" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><g id="All" fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g id="Desktop-Condition-specific-Home-Copy-7" transform="translate(-388 -332)"><g id="Find-a-Clinic" transform="translate(0 132)"><g id="Group" transform="translate(388 200)"><circle id="Oval-Copy-80" fill="#df054e" cx="21" cy="21" r="21" /><text id="1-copy-18" font-family="Helvetica" font-size="20px" font-weight="normal" fill="#ffffff"><tspan x="15" y="27"> ' + num + '</tspan></text></g></g></g></g></svg>'].join("\n");
                var latlng = new google.maps.LatLng(lat, lng);
                var marker = new google.maps.Marker({
                    position  : latlng,
                    map     : map,
                    title : title,
                    animation: google.maps.Animation.DROP,
                    icon: { url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(template), scaledSize: new google.maps.Size(30, 30) },
                });

                google.maps.event.addListener(marker, "click", (function(marker, i) {
                    return function() {
                        descriptionPop(id_point, title, address, phone, website, position, fullbios, open, type);
                    }
                })(marker, i));

                var markerList = '[<?php echo str_replace( '}{','},{', $data ); ?>]';

                //Render the rest of the points
                $.each( JSON.parse( markerList ), function( key, value ) {

                    var show_key = key + 1;

                    var template = ['<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42 42" width="42px" height="42px" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><g id="All" fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g id="Desktop-Condition-specific-Home-Copy-7" transform="translate(-388 -332)"><g id="Find-a-Clinic" transform="translate(0 132)"><g id="Group" transform="translate(388 200)"><circle id="Oval-Copy-80" fill="#df054e" cx="21" cy="21" r="21" /><text id="1-copy-18" font-family="Helvetica" font-size="20px" font-weight="normal" fill="#ffffff"><tspan x="15" y="27">' + show_key + '</tspan></text></g></g></g></g></svg>'].join("\n");
                            
                    marker = new google.maps.Marker({
                        position: {lat: parseFloat(value.lat_vc), lng: parseFloat(value.long_vc) },
                        map: map,
                        animation: google.maps.Animation.DROP,
                        title: value.name,
                        icon: { url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(template), scaledSize: new google.maps.Size(30, 30) },
                    });

                    google.maps.event.addListener(marker, "click", (function(marker, i) {
                        return function() {
                            descriptionPop( key, value.name, value.address, value.phone, value.link_web, value.specialty, value.link_bio, value.open, value.type);
                        }
                    })(marker, i));

                });
            }

            // Description Box
            function descriptionPop(id_point, title, address, phone, website, specialty, fullbios, open, type){
                //No Mobile
                if ($(window).width() > 1025) {
                    $(".location-description #clinic_name").replaceWith("<h1 id=\'clinic_name\'>"+ title +"</h1>");
                    $(".location-description #position").replaceWith("<p id=\'position\'>"+ specialty + "</p>");
                    $(".location-description #full_address").replaceWith("<p id=\'full_address\'>"+ address +"</p>");
                    $(".location-description #phone").replaceWith("<p id=\'phone\'>"+ phone +"</p>");

                    if ( type === 'non-profit') {
                        $(".location-description #open").replaceWith("<p id=\'open\'>"+ open +"</p>");
                        $(".location-description #fullbios").css({"display":"none"});
                    } else {
                        $(".location-description #open").css({"display":"none"});
                        $(".location-description #fullbios").replaceWith("<a target=\'_blank\' href=\'"+ fullbios +"'\ id=\'fullbios\'>View Full Bio</a>");
                    }

                    if(website === undefined || website === null || website === ""){
                        $(".location-description #website_link").css({"display":"none"});
                    }else{
                        $(".location-description #website_link").replaceWith("<a target=\'_blank\' id=\'website_link\' href=\'"+ website +"\'>Visit Website</a>");
                    }
                    
                    $(".location-description").css("display", "block");
                }

                $(".locations .location").each(function(){     
                    $(this).removeClass("active");
                });

                $("#" + id_point).addClass("active");
            }

            function scrollToMap() {
                $('html, body').animate({
                    scrollTop: $("#map").offset().top - 100
                }, 1000);
            }
            
        </script>

        <div class="map-container map-container-non-profit row">
            
            <!-- Title Header -->
            <div class="container-header row">

                <div class="container">

                    <h1><?php echo $title ?></h1>

                </div>

            </div>

            <!-- Render Map -->
            <div class="map" id="map"></div>

            <!-- Location Description PopUp -->
            <div class="location-description">

                <img src="<?php echo IMAGES ?>/icons/close.svg" alt="Close Icon" id="close-map">

                <div class="header">

                    <h1 id="clinic_name"></h1>

                    <p id="position"></p>

                    <p id="full_address"></p>

                    <p id="phone"></p>

                    <p id="open"></p>

                </div>

                <div class="call-to-actions">

                    <a id="fullbios">View Full Bio</a>

                    <a id="website_link">Visit Website</a>

                </div>

            </div>

            <!-- MarkerList -->
            <div class="locations container" id="point-list">

                <div class="row index pt-4 pb-4">

                    <?php $pointList = json_decode( '['.str_replace( '}{','},{', $data ).']' ); ?>

                    <?php foreach( $pointList as $key => $value ) : ?>

                        <?php $show_key = $key + 1; ?>

                        <div class="col-sm-12 col-lg-6 locations__content" id="<?php echo $key ?>">

                            <div class="row doctor-container-module border-bottom ">

                                <?php if ( $value->type === 'doctor' ) : ?> <!-- Doctor -->

                                    <div class="col-3 col-sm-2 d-flex justify-content-md-start justify-content-center" onclick="scrollToMap()">

                                        <div class="img-module mouse-pointer" onclick="relocate('marker<?php echo $key; ?>')">

                                            <img src="<?php echo ( $value->image[0] ) ? $value->image[0] : get_template_directory_uri() . '/img/icons/doctors-archive/directory-basic.svg'; ?>" class="img-module-round" />

                                        </div>

                                    </div>

                                    <div class="col-9 col-sm-8 info-module__container p-0">

                                        <div class="info-module d-md-flex d-lg-block flex-column" id="marker<?php echo $key; ?>" data-id="<?php echo $key; ?>" data-num="<?php echo $key ?>" data-lat="<?php echo $value->lat_vc; ?>" data-lng="<?php echo $value->long_vc; ?>" data-title="<?php echo $value->name; ?>" data-address="<?php echo $value->address; ?>" data-phone="<?php echo $value->phone; ?>" data-web="<?php echo $value->link_web; ?>" data-position="<?php echo $value->specialty; ?>" data-link="<?php echo $value->link_bio; ?>" data-open="<?php echo $value->open; ?>" data-type="<?php echo $value->type; ?>" onclick="relocate(this.id)">

                                            <div class="content col-12 col-md-6 col-lg-12" onclick="scrollToMap()">

                                                <h3 class="name mouse-pointer" onclick="scrollToMap()"><?php echo $value->name; ?></h3>

                                                <h4 class="category"><?php echo $value->specialty; ?></h4>

                                                <p class="address"><?php echo $value->address; ?></p>

                                                <a href="tel:<?php echo $value->phone; ?>" class="phone phone--hide-desktop">Phone: <?php echo $value->phone; ?></a>
                                                
                                                <p class="open open--hide-desktop"><?php echo $value->open; ?></p>

                                            </div>

                                            <div class="actions col-12 col-md-6 col-lg-12 d-md-flex d-lg-block justify-content-start">

                                                <a href="<?php echo $value->link_bio; ?>" class="mr-4">View Full Bio</a>

                                                <?php if( $value->link_web ): ?>

                                                    <a href="<?php echo $value->link_web; ?>" target="_blank">Visit Site</a>

                                                <?php endif; ?>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-2 d-none d-sm-block">

                                        <div class="stars text-right">

                                            <?php if( $value->phone ) : ?>

                                                <a href="tel:<?php echo $value->phone; ?>">

                                                    <img src="<?php echo get_template_directory_uri() . '/img/icons/doctors-archive/phone.svg'; ?>" alt="Phone">

                                                </a>

                                            <?php endif; ?>

                                        </div>

                                    </div>

                                <?php else : ?> <!-- Non-Profit -->

                                    <div class="col-3 col-sm-2 d-flex justify-content-md-start justify-content-center" onclick="scrollToMap()">

                                        <div class="round-module mouse-pointer" onclick="relocate('marker<?php echo $key; ?>')">

                                            <?php echo $show_key; ?>

                                        </div>

                                    </div>

                                    <div class="col-9 col-sm-10 p-0">

                                        <div class="info-module d-md-flex d-lg-block justify-content-md-between flex-column" id="marker<?php echo $key; ?>" data-id="<?php echo $key; ?>" data-num="<?php echo $show_key ?>" data-lat="<?php echo $value->lat_vc; ?>" data-lng="<?php echo $value->long_vc; ?>" data-title="<?php echo $value->name; ?>" data-address="<?php echo $value->address; ?>" data-phone="<?php echo $value->phone; ?>" data-web="<?php echo $value->link_web; ?>" data-position="<?php echo $value->specialty; ?>" data-link="<?php echo $value->link_bio; ?>" data-open="<?php echo $value->open; ?>" data-type="<?php echo $value->type; ?>" onclick="relocate(this.id)">

                                            <div class="content col-12 col-md-6 col-lg-12"onclick="scrollToMap()">

                                                <h3 class="name mouse-pointer name-non-profit" onclick="scrollToMap()"><?php echo $value->name; ?></h3>

                                                <h4 class="category"><?php echo $value->specialty; ?></h4>

                                                <p class="address"><?php echo $value->address; ?></p>

                                                <a href="tel:<?php echo $value->phone; ?>" class="phone phone--hide-desktop">Phone: <?php echo $value->phone; ?></a>

                                                <p class="open open--hide-desktop"><?php echo $value->open; ?></p>

                                            </div>

                                            <div class="actions actions-non-profit-link col-12 col-md-6 col-lg-12 d-md-flex d-lg-block justify-content-start">

                                                <?php if( $value->link_web ): ?>

                                                    <a href="<?php echo $value->link_web; ?>" target="_blank">Visit Site</a>

                                                <?php endif; ?>

                                            </div>

                                        </div>

                                    </div>

                                <?php endif; ?>

                            </div>

                        </div>

                    <?php endforeach; ?>
                </div>

            </div>

        </div>

        <script>
            // /* Relocate map fisrt time */
            // if ($(window).width() > 768) {
            //     $( document ).ready(function() {
            //         setTimeout(() => {
            //             $('.info-module')[0].click();
            //         }, 2000);
            //     });
            // }
        </script>
        <!-- End Map Module
        
       
    <?php
        return ob_get_clean();
    }
}

?>