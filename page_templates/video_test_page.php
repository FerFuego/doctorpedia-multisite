<?php /* Template Name: Custom Video Template */?>
<?php get_header();?>

<div class="video-playlist-container container pb-5 mb-5" >

    <h1 class="title"><?php the_title(); ?></h1>
   
    <!-- Video Header -->
    <div class="video-module blog-post-page-header ">

        <div class="video-wrapper video-wrapper-hub">

                <iframe src="https://player.vimeo.com/video/443132273?title=0&controls=0" id="myvideo" width="640" height="480" class="video" controls style="background:black" allow="autoplay"></iframe>
  
            <button class="close-video-btn">
                <img class="icon-close"  src="<?php print IMAGES; ?>/icons/pause-button.svg" alt="">
            </button>

            <div class="network-share-call-to-action d-none" id="js-share-call-to-action">
                <img class="icon-open"  src="<?php print IMAGES; ?>/icons/share-video.svg" alt="">
            </div>

            <div class="network-skip-intro d-none" id="js-skip-intro">
                <button class="skip-intro" id="js-skip-intro">Skip Intro</button>
            </div>

            <div class="network-share" id="js-network-share">
                <div class="network-share__social-media d-none" id="js-social-media">
                    <img class="icon-close" id="js-close-share" src="<?php print IMAGES; ?>/icons/close-share.svg" alt="">
                    <div class="network-share__social-media__content">
                        <h3 class="text-white">Share This Video</h3>
                        <hr>
                        <?php echo do_shortcode('[easy-social-share]'); ?>
                    </div>
                </div>
            </div>

        </div>
     
        <div class="video-placeholder <?php echo (have_rows('call_to_action', 'option')) ? 'video-placeholder-limit' : null; ?>">
            <button class="play-video-btn">
                <img src="<?php print IMAGES; ?>/icons/play-button.svg" alt="Play Button">
            </button>
            <div class="description">
                <h2>Doctorpedia</h2>
                <h1>Carpal Tunnel Syndrome</h1>
            </div>
        </div>
    </div>
    <!-- End Video Header -->

    <script id="js-playlist">
        $('document').ready(function(){
            var i = 0;
            var skip = 5;
            var iframe = document.getElementById('myvideo');
            var player = new Vimeo.Player(iframe);
            var playlist = [
            "https://player.vimeo.com/video/443132273",
            "https://player.vimeo.com/video/443400694" 
                <?php /*foreach($js_list as $list) {
                    echo "'" . end(explode("/",$list)) . "', \n\r";
                }*/?>
            ];

            // First play button
            $('.video-module .play-video-btn').click(function(){
                $(this).parent().fadeOut('slow');
                $(this).parent().siblings('.video-wrapper').children( 'iframe' ).click();
                $('#video-trascript').fadeIn();
                setTimeout(function(){ player.play(); }, 1000);
                i++;
            });

            //Finish function
            player.on('ended', function() {

                if( playlist[i] ){
                    player.loadVideo( playlist[i] ).then( function( id = playlist[i] ) {
                        //do something
                    }).catch(function(error) {
                        console.log( error.name );
                    });
                    setTimeout(function(){ player.play(); }, 1000);
                    i++;
                }
            });

        });
    </script>
</div>

<?php get_footer();?>