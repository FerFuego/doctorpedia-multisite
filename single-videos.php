<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package doctorpedia_theme
 */
?>
<?php get_header('2021'); ?>

<?php the_post(); ?>

<div class="single-videos">

    <div class="container" id="post-<?php the_ID(); ?>">

        <div class="single-videos__header">

            <?php require_once( __DIR__ .'/template-parts/authors/elements/author-repost-link.php' ); ?>

            <a class="single-videos__header-goback" href="<?php echo esc_url( home_url('/') ); ?>"><img src="<?php echo IMAGES; ?>/arrow-left-min.svg" alt=""> Back to Homepage</a>

            <h1 class="single-videos__header-title"><?php the_title() ?></h1>

            <div class="single-videos__header-details">

                <div class="<?php echo ( ! get_field('display_author') ) ? 'single-videos__author-avatar' : ''; ?>">

                    <?php if(!get_field('display_author') && get_user_permalink( get_queried_object()->post_author )): ?>

                        <?php if ( get_user_permalink( get_queried_object()->post_author )) : ?>
                            <a href="<?php echo get_user_permalink( get_queried_object()->post_author ); ?>" class="d-flex post-author-hover">
                        <?php endif; ?>
                            <?php echo get_avatar(get_the_author_meta('email'), '32') ?>
                            <span class="author"><?php echo get_the_author_meta('display_name'); ?> </span>
                        <?php if ( get_user_permalink( get_queried_object()->post_author )) : ?>
                            </a>
                        <?php endif; ?>

                    <?php endif ?>

                    <span class="single-videos__date"><?php  the_time('F j, Y') ?></span>
                </div>

                <div class="single-videos__social-media">
                    <p class="post-share-title d-block text-right">Share on:</p>
                    <?php echo do_shortcode('[easy-social-share]'); ?>
                    <a href="javascript:;" title="Copy Link" class="custom-item-copy" onclick="copyPostProfile(this)" data-link="<?php echo get_the_permalink(); ?>"><img src="<?php echo IMAGES . '/cta-clipboad-white.svg'; ?>" alt="clipboard"></a>
                </div>

            </div>

        </div>

        <div class="single-videos__content">

            <div class="video-player">

                <?php 
                    if ( get_field('url_vimeo') ) : 
                        $url_video = get_field('url_vimeo');
                    else :
                        $url_video = ( get_field('video_link_premium') ) ? get_field('video_link_premium') : null;
                    endif;
                    $url_placeholder = ( get_the_post_thumbnail_url( get_the_ID() , 'full') ) ? get_the_post_thumbnail_url( get_the_ID() , 'full') : null;
                ?>

                <!-- Video Player -->
                <?php if ( stripos($url_video, 'youtube') || stripos($url_video, 'youtu') ) : 

                    echo do_shortcode('[video src="'. $url_video .'"]');

                elseif ( stripos($url_video, 'vimeo') ) : ?>

                    <iframe id="iframe_principal" class="video" src=<?php echo "$url_video"; ?> frameborder="0" mozallowfullscreen webkitallowfullscreen allowfullscreen allow="autoplay"></iframe>

                <?php else : ?>

                    <video controls>
                        <source src=<?php echo $url_video; ?> type="video/mp4">
                        <source src=<?php echo $url_video; ?> type="video/ogg">
                        <source src=<?php echo $url_video; ?> type="video/mov">
                        Your browser does not support the video tag.
                    </video>

                <?php endif; ?>
                <!-- End Video Player -->

                <!-- Video Placeholder -->
                <?php if ( $url_placeholder ) : ?>

                    <div class="network-share-call-to-action d-none" id="js-share-call-to-action">
                        <img class="icon-open"  src="<?php print IMAGES; ?>/icons/share-video.svg" alt="share">
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

                    <div class="video-player__placeholder" style="background-image:url(<?php echo $url_placeholder; ?>)">
                        <button class="play-video-btn">
                            <img src="<?php print IMAGES; ?>/icons/play-button.svg" alt="Play Button">
                        </button>
                    </div>

                <?php endif; ?>
                <!-- End Video Placeholder -->

            </div>

            <div class="body">
                <!-- Transcript -->
                <?php if ( get_field('transcript') ) : ?>
                    <h2>Transcript</h2>
                    <p><?php echo html_entity_decode(get_field('transcript')); ?></p>
                <?php else : ?>
                    <!-- Content -->
                    <?php the_content(); ?>  
                    <!-- End Content -->
                <?php endif; ?>
                <!-- End Transcript -->

            </div>
        </div>
    </div>
</div>

<!-- Script content -->
<script>
    var images = document.querySelectorAll(".body img");
    for (var i = 0; i < images.length; i++) {
        var image = images[i];
        var src = image.getAttribute('src');
        var new_src = 'data:' + src;
        image.setAttribute('src', new_src);
    }

    var links = document.querySelectorAll(".body a");
    for (var x = 0; x < links.length; x++) {
        var link = links[x];
        var href = link.getAttribute('href');
        var n = href.search("http");
        if ( n == '-1') {
            var new_href = 'https://' + href;
            link.setAttribute('href', new_href);
        }
    }
</script>
<!-- End Script content -->

<!-- Script video player -->
<?php if ( $url_placeholder ) : ?>

<script>
    $('document').ready(function(){
        var i = 0;
        var skip = 5;
        var iframe = document.getElementById('iframe_principal');
        var player = new Vimeo.Player(iframe);

        //Show first author (Principal Video)
        $('#author-0').css({"display":"flex"});

        // First play button
        $('.video-player__placeholder .play-video-btn').click(function(){
            player.play();
            $(this).parent().fadeOut('slow');
            $('#video-trascript').fadeIn();
            $(this).parent().siblings('.video-wrapper').children( 'iframe' ).click();
            $('#js-share-call-to-action').removeClass('d-none');
            $('#js-skip-intro').removeClass('d-none');
            setTimeout(function(){ player.play(); }, 3000);
            $('h2').removeClass('d-none');
            $('.video').removeClass('d-none');

            var width = $('#iframe_principal').width();
            $('#js-share-call-to-action').css({'width':width+'px'});
            $('#js-skip-intro').css({'width':width+'px'});

            $('#transcript').click(function(){
                $('#tanscription').slideToggle('fast');
                $('#transcript span').toggleClass('inactive');
            });
                
        });

        // open network-share 
        $('#js-share-call-to-action').click( function() {
            $('#js-share-call-to-action').addClass('d-none');
            $('#js-social-media').removeClass('d-none');
            var width = $('#iframe_principal').width();
            var height = $('#iframe_principal').height();
            $('#js-social-media').css({'width':width+'px', 'height':height+'px'});
            player.pause();
        });

        // close network-share
        $('#js-close-share').click( function() {
            $('#js-social-media').addClass('d-none');
            $('#js-share-call-to-action').removeClass('d-none');
            player.play();
        });

        //Skip intro
        $('#js-skip-intro').click( function () {
            //set time in 5 seg to skip intro
            player.setCurrentTime( skip ).then( function (seconds) {
                $('#js-skip-intro').hide('slow');
            });
        });

        $('#js-social-media').click(function(e) {
            if(e.target !== this) {
                return;
            }
            $('#js-social-media').addClass('d-none');
            $('#js-share-call-to-action').removeClass('d-none');
            player.play();
        });

        player.on('play', function() {
            $('#js-social-media').addClass('d-none');
            $('#js-share-call-to-action').removeClass('d-none');
        });

        player.on('pause', function() {
            $('#js-share-call-to-action').addClass('d-none');
            $('#js-social-media').removeClass('d-none');
            var width = $('#iframe_principal').width();
            var height = $('#iframe_principal').height();
            $('#js-social-media').css({'width':width+'px', 'height':height+'px'});
        });

        player.on('progress', function( data ) {
            player.getCurrentTime().then(function(seconds) {
                if( seconds > 5 ) {
                    $('#js-skip-intro').hide('slow');
                }
            });
        });
        
    });
</script>

<?php endif; ?>
<!-- End Script Video Player -->

<?php get_footer(); ?>