<!-- Channels Videos Module ACF -->

<?php $rand = rand(); ?>

<div class="playlist-container channels-playlist-container <?php echo ( get_sub_field('video_background_color') ) ? 'bg-grey':''; ?>">

    <div class="container">

        <?php if ( get_sub_field('video_title') ) : ?>

            <div class="header-news">

                <h2><?php echo get_sub_field('video_title'); ?></h2>

            </div>

        <?php endif; ?>

        <?php $post_obj_video = get_sub_field('video'); ?>

        <div class="sponsors video-playlist">

            <div class="video-bg">

                <div class="video-module video-module-playlist">

                    <div class="video-wrapper-playlist video-wrapper-playlist-<?php echo $rand; ?>">

                        <?php $vimeo = get_post_meta( $post_obj_video->ID, 'url_vimeo', true); ?>

                        <iframe id="playlist_principal_<?php echo $rand; ?>" class="video" src=<?php echo "$vimeo"; ?> frameborder="0" allow="autoplay"></iframe>

                    </div>
                
                    <div class="network-share-call-to-action d-none" id="js-share-call-to-action-playlist-<?php echo $rand; ?>">

                        <img class="icon-open icon-share-playlist"  src="<?php print IMAGES; ?>/icons/share-video.svg" alt="">

                    </div>

                    <div class="network-skip-intro d-none" id="js-skip-intro-playlist-<?php echo $rand; ?>">

                        <button class="skip-intro" id="js-skip-intro-playlist-<?php echo $rand; ?>">Skip Intro</button>

                    </div>

                    <div class="network-share" id="js-network-share-playlist-<?php echo $rand; ?>">

                        <div class="network-share__social-media d-none" id="js-social-media-playlist-<?php echo $rand; ?>">

                            <img class="icon-close icon-close-playlist" id="js-close-share-playlist-<?php echo $rand; ?>" src="<?php print IMAGES; ?>/icons/close-share.svg" alt="">

                            <div class="network-share__social-media__content">

                                <h3 class="text-white">Share This Video</h3>

                                <hr>

                                <?php echo do_shortcode('[easy-social-share]'); ?>

                            </div>

                        </div>

                    </div>

                    <div class="video-placeholder video-placeholder-playlist video-placeholder-playlist_<?php echo $rand; ?>" style="background-image:url(<?php echo get_sub_field('image')['url']; ?>)">

                        <button class="play-video-btn play-video-btn-<?php echo $rand; ?>">

                            <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">

                        </button>

                    </div>

                    <?php 
                        $video_subtitle = get_sub_field('video_subtitle');
                        
                        if ( $video_subtitle ) : ?>

                        <div class="video-channels-subtitle" id="js-video-subtitle">

                            <?php echo $video_subtitle; ?>

                        </div>

                    <?php endif; ?>

                </div>
                
            </div>

        </div>

    </div>

    <?php 
        $extra_info = get_sub_field('extra_info');
        
        if ( $extra_info ) : ?>

        <div class="container video-extra-info">

            <?php echo $extra_info; ?>

        </div>

    <?php endif; ?>

    <?php wp_reset_postdata() ?>

    <?php 
        $playlist = array(); 
        $i=1;
        $obj_plylist = get_sub_field('video_playlist');
    
    if ( $obj_plylist ) : ?>

        <div class="video-playlist-module-slider">

            <div class="container">

                <div class="slider-container">

                    <img src="<?php echo IMAGES ?>/icons/prev.svg" class="arrow prev prev_<?php echo $rand ?>">

                    <div id="slider_video_playlist_<?php echo $rand ?>" class="slider_video_playlist slides slides_grid">

                        <?php foreach ( $obj_plylist as $obj_item ) : 
                                $obj_item = $obj_item['video'];
                                $url_vimeo = get_post_meta( $obj_item->ID, 'url_vimeo', true); 
                                $playlist[$i] = $url_vimeo;
                            ?>
                                                    
                            <div class="slider-single-item slider-single-item_<?php echo $rand ?>" id="video_slider_<?php echo $rand . '_' . $i; ?>">

                                <div class="trim" style="background-image: url(<?php echo get_the_post_thumbnail_url( $obj_item->ID, 'large'); ?>)">

                                    <div class="video" videourl="<?php echo $url_vimeo; ?>" ></div>

                                    <button class="play-video-btn play-video-btn-<?php echo $rand; ?>">
                                    
                                        <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">

                                    </button>

                                </div>

                                <div class="slider-single-item-content">

                                    <h3><?php echo $obj_item->post_title; ?></h3>

                                </div>

                            </div>

                            <?php $i++; ?>

                        <?php endforeach; ?>

                    </div>
                    
                    <img src="<?php echo IMAGES ?>/icons/next.svg" class="arrow next next_<?php echo $rand ?>">

                </div>

            </div>   

        </div>

    <?php endif; ?>

</div>

<script>   
    $(window).on("resize", function() {
        $("#slider_video_playlist_<?php echo $rand ?>").not(".slick-initialized").slick("resize");
    });

    $('.slider-single-item').css({'opacity':'0.6'});

    $(document).ready( function () {
        
        $("#slider_video_playlist_<?php echo $rand ?>").slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            prevArrow: $(".prev_<?php echo $rand ?>"),
            nextArrow: $(".next_<?php echo $rand ?>"),
            dots: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    dots: true
                }
            }]
        });
        
        var count_slides = $("#slider_video_playlist_<?php echo $rand ?> .slider-single-item").length;

        if ( 5 > count_slides ) {
            $(".prev_<?php echo $rand ?>").remove();
            $(".next_<?php echo $rand ?>").remove();
        }
    });
</script>

<script>
    $(document).ready(function(){

        var iframe_playlist = $(".video-wrapper-playlist-<?php echo $rand; ?> iframe")[0];
        var player = new Vimeo.Player(iframe_playlist);
        var i = 0;
        var skip = 5;

        var playlist = [
            <?php 
                foreach ( $playlist as $key => $value ) :
                    echo '"'. $value.'",';
                endforeach; 
            ?>
        ];

        // Big Play Button
        $(".video-placeholder-playlist_<?php echo $rand; ?> .play-video-btn-<?php echo $rand; ?>").click(function(){
            $(this).parent().fadeOut("slow");
            $(this).parent().siblings(".video-wrapper-playlist-<?php echo $rand; ?>").children( "iframe" ).click();
        
            $('#js-share-call-to-action-playlist-<?php echo $rand; ?>').removeClass('d-none');
            $('#js-skip-intro-playlist-<?php echo $rand; ?>').removeClass('d-none');
            $("#js-skip-intro-playlist-<?php echo $rand; ?>").css("display", "");
            $('#js-skip-intro-playlist-<?php echo $rand; ?>').show('slow');
            
            setTimeout(function() { player.play(); }, 1000);

            $('#transcript').click(function(){
                $('#tanscription').slideToggle('fast');
                $('#transcript span').toggleClass('inactive');
            });

            var width = $('#playlist_principal_<?php echo $rand; ?>').width();
            $('#js-share-call-to-action-playlist-<?php echo $rand; ?>').css({'width':width+'px'});
            $('#js-skip-intro-playlist-<?php echo $rand; ?>').css({'width':width+'px'});

            $('.slider-single-item_<?php echo $rand ?>').css({'opacity':'0.6'});
            $('#js-video-subtitle').css({'display':'none'});

        })  

        // Slider Items
        $(".slider-single-item_<?php echo $rand ?>").click(function(){
            var src = $(this).children(".trim").children(".video").attr("videourl");
            var title = $(".slider-single-item-content", this).children("h3").clone();
            var text = $(".slider-single-item-content", this).children("p").clone();
            var id = $(this).attr("id");
            $("#playlist_principal_<?php echo $rand; ?>").attr("src", src);
            $(".video-placeholder-playlist_<?php echo $rand; ?>").fadeOut("slow");
            
            $(this).parent().siblings(".video-wrapper-playlist-<?php echo $rand; ?>").children( "iframe" ).click();
            setTimeout(function(){ player.play(); }, 1000);

            $('#js-share-call-to-action-playlist-<?php echo $rand; ?>').removeClass('d-none');
            $('#js-skip-intro-playlist-<?php echo $rand; ?>').removeClass('d-none');
            $("#js-skip-intro-playlist-<?php echo $rand; ?>").css("display", "");
            var width = $('#playlist_principal_<?php echo $rand; ?>').width();
            $('#js-share-call-to-action-playlist-<?php echo $rand; ?>').css({'width':width+'px'});
            $('#js-skip-intro-playlist-<?php echo $rand; ?>').css({'width':width+'px'});

            $('.slider-single-item_<?php echo $rand ?>').css({'opacity':'0.6'});
            $(this).css({'opacity':'1'});

            /* Remove Share screen */
            $('#js-social-media-playlist-<?php echo $rand; ?>').addClass('d-none');
            $('#js-share-call-to-action-playlist-<?php echo $rand; ?>').removeClass('d-none');
        })  

        // Close Btn Share Screen
        $(".video-wrapper-playlist-<?php echo $rand; ?> .close-video-btn").click(function(){
            $(".video-placeholder-playlist_<?php echo $rand; ?>").fadeIn("slow");
            $( this ).parent().siblings( ".video-wrapper-playlist-<?php echo $rand; ?>" ).children( "iframe" ).click();
            player.pause();
        });

        //Btn pause - not used
        $('.video-module .close-video-btn').click(function(){
            $('.video-module .play-video-btn-<?php echo $rand; ?>').parent().fadeIn('slow');
            $('#video-trascript').hide('slow');
            $( this ).parent().siblings( '.video-wrapper-section' ).children( 'iframe' ).click();
            player.pause();
        });

        // open network-share 
        $('#js-share-call-to-action-playlist-<?php echo $rand; ?>').click( function() {
            $('#js-share-call-to-action-playlist-<?php echo $rand; ?>').addClass('d-none');
            $('#js-social-media-playlist-<?php echo $rand; ?>').removeClass('d-none');
            var width = $('#playlist_principal_<?php echo $rand; ?>').width();
            var height = $('#playlist_principal_<?php echo $rand; ?>').height();
            $('#js-social-media-playlist-<?php echo $rand; ?>').css({'width':width+'px', 'height':height+'px'});
            player.pause();
        });

        // close network-share
        $('#js-close-share-playlist-<?php echo $rand; ?>').click( function() {
            $('#js-social-media-playlist-<?php echo $rand; ?>').addClass('d-none');
            $('#js-share-call-to-action-playlist-<?php echo $rand; ?>').removeClass('d-none');
            player.play();
        });

        //Skip intro
        $('#js-skip-intro-playlist-<?php echo $rand; ?>').click( function () {
            //set time in 5 seg to skip intro
            player.setCurrentTime( skip ).then( function (seconds) {
                $('#js-skip-intro-playlist-<?php echo $rand; ?>').hide('slow');
            });
        });

        $('#js-social-media-playlist-<?php echo $rand; ?>').click(function(e) {
            if(e.target !== this) {
                return;
            }
            $('#js-social-media-playlist-<?php echo $rand; ?>').addClass('d-none');
            $('#js-share-call-to-action-playlist-<?php echo $rand; ?>').removeClass('d-none');
            player.play();
        });

        // Event Play
        player.on('play', function() {
            $('#js-social-media-playlist-<?php echo $rand; ?>').addClass('d-none');
            $('#js-share-call-to-action-playlist-<?php echo $rand; ?>').removeClass('d-none');
        });

        // Event Pause
        player.on('pause', function() {
            $('#js-share-call-to-action-playlist-<?php echo $rand; ?>').addClass('d-none');
            $('#js-social-media-playlist-<?php echo $rand; ?>').removeClass('d-none');
            var width = $('#playlist_principal_<?php echo $rand; ?>').width();
            var height = $('#playlist_principal_<?php echo $rand; ?>').height();
            $('#js-social-media-playlist-<?php echo $rand; ?>').css({'width':width+'px', 'height':height+'px'});
        });

        // Event Progress
        player.on('progress', function( data ) {
            player.getCurrentTime().then(function(seconds) {
                if( seconds > 5 ) {
                    $('#js-skip-intro-playlist-<?php echo $rand; ?>').hide('slow');
                }
            });
        });

        //Event Finish
        player.on('ended', function() {

            $('.slider-single-item').css({'opacity':'0.6'});

            if( playlist[i] ){
                player.loadVideo(playlist[i]).then(function(id) {
                    $('#js-skip-intro-playlist-<?php echo $rand; ?>').show('slow');
                    sliderItemsPlay( i );
                }).catch(function(error) {
                    console.log( error.name);
                });
                setTimeout(function(){ player.play(); }, 1000);
                i++;
            }
        });

        // Function on finish
        function sliderItemsPlay( id ) { 

            var title = $('#video_slider_<?php echo $rand; ?>_' + id).children('.slider-single-item-content').children('h3').clone()
            var description = $('#video_slider_<?php echo $rand; ?>_' + id).children('.slider-single-item-content').children('p').clone();
            $('#video_slider_<?php echo $rand; ?>_' + id).css({'opacity':'1'});

            $('#js-share-call-to-action-playlist-<?php echo $rand; ?>').removeClass('d-none');
            $('#js-skip-intro-playlist-<?php echo $rand; ?>').removeClass('d-none');
            $("#js-skip-intro-playlist-<?php echo $rand; ?>").css("display", "");
            $('#js-skip-intro-playlist-<?php echo $rand; ?>').show('slow');

            var width = $('#playlist_principal_<?php echo $rand; ?>').width();
            $('#js-share-call-to-action-playlist-<?php echo $rand; ?>').css({'width':width+'px'});
            $('#js-skip-intro-playlist-<?php echo $rand; ?>').css({'width':width+'px'});
        }

    })
</script>

<!-- End Channels Videos Module ACF -->