<?php
/* Element Description: VC interactiveMap*/
 
// Element Class 
class vcinteractiveMap extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_interactiveMap_mapping' ) );
        add_shortcode( 'vc_interactiveMap', array( $this, 'vc_interactiveMap_html' ) );
    }
     
    // Element Mapping
    public function vc_interactiveMap_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Interactive Map', 'text-domain'),
                'base' => 'vc_interactiveMap',
                'description' => __('Interactive Map Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',     
                'params' => array(  
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'title',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                    ),

                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Lat', 'text-domain' ),
                        'param_name' => 'lat_vc',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Long', 'text-domain' ),
                        'param_name' => 'long_vc',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                    ),
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_interactiveMap_html( $atts ) {

        extract(
            shortcode_atts(
                array(
                    'title'   => '',                    
                    'lat_vc'   => '37.747081',                    
                    'long_vc'   => '-122.444815',                    
                ), 
                $atts
            )
        );

        return $this->BlockHTML($title, $lat_vc, $long_vc);
    } 

    public function BlockHTML($title, $lat_vc, $long_vc){
        ob_start(); ?>
            <!-- Map Module VC -->
            <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo GMAPS_API_KEY ?>"></script>
            <script type="text/javascript">
                google.maps.event.addDomListener(window, "load", init);
                // Rendered points on the map
                function init() {
                    var mapOptions = {
                        zoom: 12,
                        scrollwheel: false,
                        center: new google.maps.LatLng(<?php echo $lat_vc; ?>,<?php echo $long_vc; ?>), // San Francisco CA
                    };

                    var mapElement = document.getElementById("map");
                    var map = new google.maps.Map(mapElement, mapOptions);
                    var infoWindow = new google.maps.InfoWindow(), marker, i;
                    <?php
                        $i = 1;
                        $loop = new WP_Query( array(
                            'post_type' => 'bios',
                            'meta_query' => array(
                                array(
                                    'key'       => 'display_map',
                                    'compare'   => '=',
                                    'value'     => null,
                                ),
                            ),
                        ));
                        while ( $loop -> have_posts()) : $loop->the_post(); ?>
                            <?php $row = get_field("location"); ?>
                                
                                var template = ['<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42 42" width="42px" height="42px" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><g id="All" fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g id="Desktop-Condition-specific-Home-Copy-7" transform="translate(-388 -332)"><g id="Find-a-Clinic" transform="translate(0 132)"><g id="Group" transform="translate(388 200)"><circle id="Oval-Copy-80" fill="#df054e" cx="21" cy="21" r="21" /><text id="1-copy-18" font-family="Helvetica" font-size="20px" font-weight="normal" fill="#ffffff"><tspan x="15" y="27"><?php echo $i ?></tspan></text></g></g></g></g></svg>'].join("\n");
                                
                                marker = new google.maps.Marker({
                                    position: {lat: <?php echo $row["lat"] ?>, lng: <?php echo $row["lng"] ?>},
                                    map: map,
                                    animation: google.maps.Animation.DROP,
                                    title: "<?php echo get_the_title() ?>",
                                    icon: { url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(template), scaledSize: new google.maps.Size(30, 30) },
                                });

                                google.maps.event.addListener(marker, "click", (function(marker, i) {
                                    return function() {
                                        descriptionPop('<?php echo get_the_ID()?>', '<?php echo get_the_title() ?>', '<?php echo get_field('complete_address') ?>', '<?php echo get_field('phone') ?>', '<?php echo get_field('link_email') ?>', '<?php echo get_field('link_website') ?>', '<?php echo get_field('position')?>', '<?php echo get_the_permalink() ?>');
                                    }
                                })(marker, i));
                        <?php $i++; ?>
                        <?php endwhile; ?>   
                }//end init
                
                // Relocate on the map
                function relocate(mark){
                    var id_point = document.getElementById(mark).getAttribute("data-id");
                    var num = document.getElementById(mark).getAttribute("data-num");
                    var lat = document.getElementById(mark).getAttribute("data-lat");
                    var lng = document.getElementById(mark).getAttribute("data-lng");
                    var title = document.getElementById(mark).getAttribute("data-title");
                    var address = document.getElementById(mark).getAttribute("data-address");
                    var phone = document.getElementById(mark).getAttribute("data-phone");
                    var hours = document.getElementById(mark).getAttribute("data-hs");
                    var website = document.getElementById(mark).getAttribute("data-web");
                    var position = document.getElementById(mark).getAttribute("data-position");
                    var fullbios = document.getElementById(mark).getAttribute("data-link");

                    descriptionPop(id_point, title, address, phone, hours, website, position, fullbios);

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
                            descriptionPop(id_point, title, address, phone, hours, website, position, fullbios);
                        }
                    })(marker, i));

                    //Render the rest of the points
                    <?php
                    $i=1;
                    $loop = new WP_Query( array(
                        'post_type' => 'bios',
                        'meta_query' => array(
                            array(
                                'key'       => 'display_map',
                                'compare'   => '=',
                                'value'     => null,
                            ),
                        ),
                    ));
                    while ( $loop -> have_posts()) : $loop->the_post(); ?>
                            <?php $row = get_field("location"); ?>
                                if(<?php echo get_the_ID() ?> != id_point && <?php echo $i ?> != num){
                                    var template_grey = ['<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42 42" width="42px" height="42px" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><g id="All" fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g id="Desktop-Condition-specific-Home-Copy-7" transform="translate(-286 -423)"><g id="Find-a-Clinic" transform="translate(0 132)"><g id="Group-2" transform="translate(286 291)"><circle id="Oval-Copy-81" fill="#9b9b9b" cx="21" cy="21" r="21" /><text id="2-copy-6" font-family="Helvetica" font-size="20px" font-weight="normal" fill="#ffffff"><tspan x="15" y="27"><?php echo $i ?></tspan></text></g></g></g></g></svg>'].join("\n");
                                    marker = new google.maps.Marker({
                                        position: {lat: <?php echo $row["lat"] ?>, lng: <?php echo $row["lng"] ?>},
                                        map: map,
                                        animation: google.maps.Animation.DROP,
                                        title: "<?php echo get_the_title() ?>",
                                        icon: { url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(template_grey), scaledSize: new google.maps.Size(30, 30) },
                                    });

                                    google.maps.event.addListener(marker, "click", (function(marker, i) {
                                        return function() {
                                            descriptionPop('<?php echo get_the_ID() ?>', '<?php echo get_the_title()?>', '<?php echo get_field('complete_address')?>', '<?php echo get_field('phone')?>', '<?php echo get_field('link_email') ?>', '<?php echo get_field('link_website')?>', '<?php echo get_field('position')?>', '<?php echo get_the_permalink() ?>');
                                        }
                                    })(marker, i));
                                }
                        <?php $i++; ?>
                    <?php endwhile; ?>
                }
                // Description Box
                function descriptionPop(id_point, title, address, phone, hours, website, position, fullbios){
                    //No Mobile
                    if ($(window).width() > 1025) {
                        $(".location-description #clinic_name").replaceWith("<h1 id=\'clinic_name\'>"+ title +"</h1>");
                        $(".location-description #position").replaceWith("<p id=\'position\'>"+ position + "</p>");
                        $(".location-description #full_address").replaceWith("<p id=\'full_address\'>"+ address +"</p>");
                        $(".location-description #phone").replaceWith("<p id=\'phone\'>"+ phone +"</p>");
                        $(".location-description #open").replaceWith("<p id=\'open\'>"+ hours +"</p>");
                        $(".location-description #fullbios").replaceWith("<a target=\'_blank\' href=\'"+ fullbios +"'\ id=\'fullbios\'>View Full Bio</a>");


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

                //google.maps.event.addDomListener(window, "load", SearchMap);

                // Search Map
                function SearchMap(elem=null, address=null){
                    
                    var geocoder = new google.maps.Geocoder();

                    var map = new google.maps.Map(document.getElementById(elem), {
                        zoom: 12,
                        scrollwheel: false,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });
                    
                    geocoder.geocode({"address": address}, function(results, status) {
                        if (status === "OK") {
                            var resultados = results[0].geometry.location,
                                resultados_lat = resultados.lat(),
                                resultados_long = resultados.lng();
                                                    
                            map.setCenter(results[0].geometry.location);
                        
                            //Render the rest of the points
                            var infoWindow = new google.maps.InfoWindow(), marker, i;
                            
                            <?php 
                                $i=1;
                                $loop = new WP_Query( array(
                                    'post_type' => 'bios',
                                    'meta_query' => array(
                                        array(
                                            'key'       => 'display_map',
                                            'compare'   => '=',
                                            'value'     => null,
                                        ),
                                    ),
                                ));
                                while ( $loop -> have_posts()) : $loop->the_post(); ?>
                                <?php $row = get_field("location"); ?>
                                    var template = ['<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42 42" width="42px" height="42px" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><g id="All" fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g id="Desktop-Condition-specific-Home-Copy-7" transform="translate(-388 -332)"><g id="Find-a-Clinic" transform="translate(0 132)"><g id="Group" transform="translate(388 200)"><circle id="Oval-Copy-80" fill="#df054e" cx="21" cy="21" r="21" /><text id="1-copy-18" font-family="Helvetica" font-size="20px" font-weight="normal" fill="#ffffff"><tspan x="15" y="27"><?php echo $i ?></tspan></text></g></g></g></g></svg>'].join("\n");
                                    marker = new google.maps.Marker({
                                        position: {lat: <?php echo $row["lat"] ?>, lng: <?php echo $row["lng"] ?>},
                                        map: map,
                                        animation: google.maps.Animation.DROP,
                                        title: "<?php echo get_the_title()?>",
                                        icon: { url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(template), scaledSize: new google.maps.Size(30, 30) },
                                    });

                                    google.maps.event.addListener(marker, "click", (function(marker, i) {
                                        return function() {
                                            descriptionPop('<?php echo get_the_ID()?>', '<?php echo get_the_title()?>', '<?php echo get_field('complete_address')?>', 'BIOS', '<?php echo get_field('phone')?>', '<?php echo get_field('link_email')?>', '<?php echo get_field('link_website')?>');
                                        }
                                    })(marker, i));
                                <?php $i++; ?>
                            <?php endwhile; ?>
                        }
                    }); //END GEOCODER

                    //hide point list
                    $("#point-list .location").each(function(){
                        var link_address = $(this).children("a").attr("data-address");
                        
                        if(link_address.indexOf(address) > -1){
                            $(this).children("a").removeClass("invisible");
                        }else{
                            $(this).children("a").addClass("invisible");
                        }
                    });
                }

                function scrollToMap() {
                $('html, body').animate({
                    scrollTop: $("#map").offset().top - 100
                }, 1000);
            }
            </script>
            
        <?php
            $loop = new WP_Query( array(
                'post_type' => 'bios',
                'meta_query' => array(
                    array(
                        'key'       => 'display_map',
                        'compare'   => '=',
                        'value'     => null,
                    ),
                ),
            ));
            $array = array();
            while ( $loop -> have_posts()) : $loop->the_post();
                $rows = get_categories( array('taxonomy' => 'bios-category') );
                foreach($rows as $row){
                    $array[] = $row->name;
                }
            endwhile; ?>
            <script>
                $( document ).ready(function() {
                    $('.info-module')[0].click();
                });
            </script>
            <div class="map-container row">
                <div class="container-header row">
                    <div class="container">
                        <h1><?php echo $title ?></h1>
                    </div>
                </div>

                <div class="map" id="map"></div>

                <!-- Location Description -->
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
                <!-- End Location Description -->
                <div class="locations container" id="point-list">
                    <div class="row index pt-4 pb-4">
                        <?php 
                            $i = 1;
                            $loop = new WP_Query( array(
                                'post_type' => 'bios',
                                'meta_query' => array(
                                    array(
                                        'key'       => 'display_map',
                                        'compare'   => '=',
                                        'value'     => null,
                                    ),
                                ),
                            ));
                            while ( $loop -> have_posts()) : $loop->the_post(); ?>
                                <?php $row = get_field("location"); ?>

                                    <div class="col-sm-12 col-lg-6 locations__content" id="<?php get_the_ID() ?>">

                                        <div class="row doctor-container-module border-bottom">

                                            <div class="col-3 col-sm-2" <?php echo ($key >= 1) ? 'onclick="scrollToMap()" ' : '' ?>>
                                                <div class="img-module">
                                                    <img src="<?php echo ( get_field('selfie')) ? get_field('selfie') : get_template_directory_uri() . '/img/icons/doctors-archive/directory-basic.svg'; ?>">
                                                </div>
                                            </div>

                                            <div class="col-9 col-sm-8">
                                                <div class="info-module d-md-flex d-lg-block justify-content-md-between" id="marker<?php echo get_the_ID()?>" data-id="<?php echo get_the_ID()?>" data-num="<?php echo $i ?>" data-lat="<?php echo $row['lat']?>" data-lng="<?php echo $row['lng']?>" data-title="<?php echo get_the_title()?>" data-address="<?php echo get_field('complete_address')?>" data-phone="<?php echo get_field('phone')?>" data-hs="<?php echo get_field('link_email')?>" data-web="<?php echo get_field('link_website')?>" data-position="<?php echo get_field('position')?>" data-link="<?php echo get_the_permalink() ?>" onclick="relocate(this.id)">
                                                    <div class="content col-12 col-md-6 col-lg-12" <?php echo ($key >= 1) ? 'onclick="scrollToMap()" ' : '' ?>>
                                                        <h3 class="name"><?php echo get_the_title(); ?></h3>
                                                        <h4 class="category"><?php echo get_field('position'); ?></h4>
                                                        <p class="address"><?php echo get_field('complete_address') ?></p>
                                                    </div>
                                                    <?php //if($doctor['profile'] == 'premium'): ?>
                                                        <div class="actions col-12 col-md-6 col-lg-12 d-md-flex d-lg-block justify-content-md-end align-items-md-end">
                                                            <a href="<?php echo get_the_permalink(); ?>" class="mr-4">View Full Bio</a>
                                                            <?php if(get_field('link_website')): ?>
                                                                <a href="<?php echo get_field('link_website'); ?>" target="_blank">Visit Site</a>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php //endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-sm-2 d-none d-sm-block">
                                                <div class="stars text-right">
                                                    <?php if(get_field('phone')): ?>
                                                        <a href="tel:<?php echo get_field('phone'); ?>">
                                                            <img src="<?php echo get_template_directory_uri() . '/img/icons/doctors-archive/phone.svg'; ?>" alt="Phone">
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php $i++; ?>
                            <?php endwhile; ?>
                    </div>
                    <div class="row pagination">
                        <div class="col-sm-12">
                            <?php echo get_the_posts_pagination( array( 'mid_size' => 5, 'prev_text' => false, 'next_text' => false, 'screen_reader_text' => '' ) ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                /* Relocate map fisrt time */
                $( document ).ready(function() {
                    setTimeout(() => {
                        $('.info-module')[0].click();
                    }, 2000);
                });
            </script>
            <!-- End Map Module -->
        <?php
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcInteractiveMap();

?>