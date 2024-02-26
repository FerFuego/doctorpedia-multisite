<?php
$bg_color = get_sub_field('bg_color');
$cta = get_sub_field('call_to_action');
$webcast = get_sub_field('webcast');
$subtitle = get_field('subtitle', $webcast->ID);
$vimeo_url = get_field('vimeo_video_url', $webcast->ID);
$rand = rand(66,9999);
?>
<section class="webcast" id="js-featuredWebcastModule" style="background-color: <?php echo $bg_color ?>">

    <div class="container">

        <div class="webcast__body">

            <div class="description">
                <h2><?php echo $webcast->post_title; ?></h2>
                <h3><?php echo $subtitle; ?></h3>
                <p><?php echo custom_trim_excerpt(null, $webcast->post_content, 100); ?></p>
            </div>

            <div class="video">

                <div class="video-module video-module-playlist">

                    <div class="video-wrapper-playlist">
                        <?php if ($vimeo_url) : ?>
                            <iframe id="playlist_principal_<?php echo $rand; ?>" class="video" src=<?php echo "$vimeo_url"; ?> frameborder="0" allow="autoplay"></iframe>
                        <?php endif; ?>
                    </div>

                    <div class="video-placeholder video-placeholder-playlist" style="background-image:url(<?php echo get_the_post_thumbnail_url( $webcast->ID, 'large'); ?>)">
                        <button class="play-video-btn">
                            <img src="<?php echo IMAGES; ?>/icons/play-button.svg" alt="Play Button">
                        </button>
                    </div>

                </div>

            </div>

        </div>

        <div class="webcast__footer">
            <?php if ( $cta ) : ?>
                <a href="<?php echo $cta['url']; ?>" target="<?php echo $cta['target']; ?>" class="btn-rounded"><?php echo $cta['title']; ?> <img src="<?php echo IMAGES . '/modules/webcast/single-right-arrow-white.svg'; ?>" alt></a>
            <?php endif; ?>
        </div>

    </div>

    <script>
        $(document).ready(function(){
            var iframe_playlist = $(".video-wrapper-playlist iframe")[0];
            var player = new Vimeo.Player(iframe_playlist);

            $(".video-placeholder-playlist .play-video-btn").click(function(){
                $(this).parent().fadeOut("slow");
                $(this).parent().siblings(".video-wrapper-playlist").children( "iframe" ).click();                
                setTimeout(function() { player.play(); }, 1000);
                var width = $('#playlist_principal').width();
                $('#js-share-call-to-action-playlist').css({'width':width+'px'});
                $('#js-skip-intro-playlist').css({'width':width+'px'});
            })   
        })
    </script>

</section>