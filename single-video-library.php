<?php /* Template Name: Video Library Catagory */?>

<?php get_header('2021'); ?>

<?php the_post();?>

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
                    $vimeo_id = get_field('vimeo_video_id');
                    $vimeo = 'https://player.vimeo.com/video/'. $vimeo_id .'?autoplay=0'; 
                    $url_placeholder = ( get_the_post_thumbnail_url( get_the_ID() , 'full') ) ? get_the_post_thumbnail_url( get_the_ID() , 'full') : null;
                ?>

                <!-- Video Player -->
                
                <iframe class="video" id="principal_iframe" src=<?php echo "$vimeo"; ?> frameborder="0" allow="autoplay"></iframe>
                <!-- End Video Player -->

                <!-- Video Placeholder -->
                <?php if ( $url_placeholder ) : ?>

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
                <?php  $transcript = get_field('transcript');

                if ( $transcript ) : ?>
                    <h2>Transcript</h2>
                    <p><?php echo html_entity_decode($transcript); ?></p>
                <?php else : ?>
                    <!-- Content -->
                    <?php the_content(); ?>  
                    <!-- End Content -->
                <?php endif; ?>
                <!-- End Transcript -->
            </div>

             <!-- Grid Videos -->
             <?php if( have_rows('library') ): ?>
                <div class="grid">
                    <div class="container">
                        <div class="header">
                            <h1>All Videos</h1>
                        </div>
                        <div class="grid-container">
                            <?php  while ( have_rows('library') ) : the_row(); ?>
                                <div class="grid-thumbnail">
                                    <a href="javascript:void(0)" class="play">
                                        <div class="trim">
                                            <img src="<?php the_sub_field('background')?>" alt="">
                                        </div>
                                        <button class="play-video-btn">
                                            <div class="video" videourl="<?php the_sub_field('url_video')?>"></div>
                                            <img class="icon-play"  src="<?php echo IMAGES ?>/icons/play-button.svg" alt=""> 
                                        </button>
                                        <h1><?php the_sub_field('title') ?></h1>
                                    </a>
                                </div>
                            <?php endwhile; ?>  
                        </div>
                    </div>    
                </div>
            <?php endif; ?>
            <!-- End Grid Videos -->
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
    $("document").ready(function(){
        var iframe_section = document.getElementById('principal_iframe');
        var player = new Vimeo.Player(iframe_section);
    
        $('.video-player__placeholder .play-video-btn').click(function(){
            $(this).parent().fadeOut("slow");
            $(this).parent().siblings(".video-wrapper-section").children( "iframe" ).click();
            player.play();
        })

        $('.play').click(function(){
            var src = $(this).children('.play-video-btn').children('.video').attr('videourl');
            $('.video-placeholder-section').fadeOut("slow");
            $('#principal_iframe').attr('src', src);
            $('.video-wrapper-section').parent().siblings(".video-wrapper-section").children( "iframe" ).click();
            $("html, body").animate({ scrollTop: 180 }, "slow");
            setTimeout(function(){ player.play(); }, 100);
        })
    })
</script>

<?php endif; ?>
<!-- End Script Video Player -->

<?php get_footer(); ?>