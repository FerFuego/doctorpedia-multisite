<div id="js-map-location-container">

    <?php if ( !empty( get_the_author_meta('location', $author_id)['address'] ) ) : ?>

        <?php $rand = rand(); ?>

        <div class="author__map-location">

            <?php /*
            <div class="author__featured-doctor-cta">

                <a href="#">Video Call with Dr. <?php echo get_the_author_meta('last_name', $author_id); ?></a>

            </div> */?>

            <div class="author__map-location-wrapper">

                <div class="d-flex flex-row flex-wrap author-posts-container">

                    <div class="author__map-location-photo" id="map_<?php echo $rand; ?>"></div>

                    <div class="author__featured-text-container">

                        <div class="author__featured-doctor-container">

                            <div class="author__featured-doctor-info">

                                <p class="author__featured-doctor-location"><?php echo get_the_author_meta('location', $author_id)['address']; ?></p>

                                <p class="author__featured-doctor-location"><?php the_author_meta('clinic_phone', $author_id);?></p>

                                <p class="author__featured-doctor-location"><?php the_author_meta('clinic_open', $author_id);?></p>

                            </div>

                            <?php if ( get_the_author_meta('clinic_appointment', $author_id) ) : ?>

                                <a href="<?php echo esc_url( get_the_author_meta('clinic_appointment', $author_id) ); ?>" target="_blank">
                                    <div class="author__featured-doctor-appointment">
                                        Make an Appointment
                                    </div>
                                </a>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <script type="text/javascript">
            // Rendered points on the map
            function initMap() {
                
                <?php $location = get_the_author_meta('location', $author_id);?>

                var mapOptions = {
                    zoom: 12,
                    scrollwheel: false,
                    center: new google.maps.LatLng(<?php echo $location['lat']; ?>,<?php echo $location['lng']; ?>),
                };

                var mapElement = document.getElementById("map_<?php echo $rand; ?>");
                var map = new google.maps.Map(mapElement, mapOptions);
                var infoWindow = new google.maps.InfoWindow(), marker, i;

                marker = new google.maps.Marker({
                    position: {lat: <?php echo $location['lat']; ?>, lng: <?php echo $location['lng']; ?>},
                    map: map,
                    animation: google.maps.Animation.DROP,
                    title: "<?php echo get_the_author_meta('clinic_name', $author_id); ?>",
                    icon: "<?php echo get_template_directory_uri() ?>/img/authors/marker-premium.svg",
                });

                google.maps.event.addListener(marker, "click", (function(marker, i) {
                    return function() {

                        $("#bio-clinic").addClass("active");

                    }
                })(marker, i));
            }//end init

        </script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo GMAPS_API_KEY; ?>&libraries=places&callback=initMap"></script>

    <?php else : ?>

        <?php if ( is_user_logged_in() && validate_user($author_id)) : ?>

            <div class="author__map-empty" id="js-author-profile-location">

                <div class="author__map-empty-wrapper">

                    <div class="author__map-empty-wrapper__header">

                        <img src="<?php echo IMAGES .'/icons/map-pointer-empty.svg'; ?>" alt="Doctorpedia icon map">

                    </div>

                    <div class="author__map-empty-wrapper__body">

                        <h2>Location & Map</h2>
                        
                        <p>Add your clinic information to your public profile.</p>

                        <a href="javascript:;" onclick="openLocationModal()" class="cta-upload-video">Add Location</a>

                    </div>

                </div>

            </div>

        <?php endif;?>

    <?php endif;?>

</div>