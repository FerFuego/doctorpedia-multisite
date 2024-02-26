<?php if (get_the_author_meta('location', $author_id)): ?>

    <?php $rand = rand(); ?>

    <script type="text/javascript">

        google.maps.event.addDomListener(window, 'load', init);

        // Rendered points on the map
        function init() {

            <?php $location = get_the_author_meta('location', $author_id);?>

            var mapOptions = {
                zoom: 12,
                scrollwheel: false,
                center: new google.maps.LatLng(<?php echo $location['lat']; ?>,<?php echo $location['lng']; ?>),
            };

            var mapElement = document.getElementById('map-<?php echo $rand; ?>');
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

    <div class="author__map-location">

        <?php /*
        <div class="author__featured-doctor-cta">

            <a href="#">Video Call with Dr. <?php echo get_the_author_meta('last_name', $author_id); ?></a>

        </div> */?>

        <div class="author__map-location-wrapper">

            <div class="d-flex flex-row flex-wrap author-posts-container">

                <div class="author__map-location-photo" id="map-<?php echo $rand; ?>"></div>

                <div class="author__featured-text-container">

                    <div class="author__featured-doctor-container">

                        <?php if ( get_the_author_meta('location', $author_id) ) : ?>

                            <div class="author__featured-doctor-info">

                                <!-- <h3><?php //the_author_meta('clinic_name', $author_id);?> </h3> -->

                                <p class="author__featured-doctor-location"><?php echo get_the_author_meta('location', $author_id)['address']; ?></p>

                                <p class="author__featured-doctor-location"><?php the_author_meta('clinic_phone', $author_id);?></p>

                                <p class="author__featured-doctor-location"><?php the_author_meta('clinic_open', $author_id);?></p>

                            </div>

                        <?php endif; ?>

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

<?php endif;?>