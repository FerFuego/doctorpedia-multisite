<?php get_header('2021'); ?>

<?php the_post();?>

    <div id="single-library-page">

        <!-- BreadCrumb -->
        <div class="single-app-review-navbar">
            <div class="container">
                <h3><a href="<?php echo esc_url(home_url('/')) ?>health-library">Health Library</a> / </h3>
                <a href="#" class="styles-none"><?php the_field('title') ?><?php echo get_queried_object()->name; ?></a>
            </div>
        </div>
        <!-- End BreadCrumb -->

        <div class="container">
            <div class="full-title">
                <h1><?php echo get_queried_object()->name; ?></h1>
                <ul class="social-media d-none d-md-flex">
                    <?php echo do_shortcode('[easy-social-share ukey="1571255022"]'); ?>
                </ul>
            </div>

            <?php 
                //------------------------------------------------------ 
                //  Get Taxonomy ACF to be displayed in the main video.
                //------------------------------------------------------ 

                // get the current taxonomy term
                $term = get_queried_object();

                // Get Taxonomy data. 
                $video_title = get_field('video_title', $term);
                $vimeo_id = get_field('vimeo_video_id', $term);
                $video_cover = get_field('video_cover', $term);
                $video_description = get_queried_object()->description;  
                $video_author = get_field('doctor', $term);
                $video_author_img =isset( $video_author[ 'user_avatar' ] ) && !empty($video_author[ 'user_avatar' ]) ? simplexml_load_string( $video_author[ 'user_avatar' ] )->attributes()->src : null;
            ?>

            <div class="video-container">
                <!-- Video Module -->
                <?php
                //------------------------------------------------------------------------------------------------------------------------------------------------------------
                //  When the page is loaded it displays the info from the Taxonomy. (Vimeo ID, Video Cover, Video Description). When the user click's a video it replaces 
                //  the data using JS. 
                //------------------------------------------------------------------------------------------------------------------------------------------------------------
                ?>
                <div class="video-module">
                    <!-- Video Wrapper Module -->
                    <div class="video-wrapper video-wrapper-section">
                        <?php $vimeo = 'https://player.vimeo.com/video/'. $vimeo_id .'?autoplay=0'; ?>
                        <iframe class="video" id="principal_iframe" src=<?php echo "$vimeo"; ?> frameborder="0" allow="autoplay"></iframe>
                        <button class="close-video-btn">
                            <img class="icon-close"  src="<?php echo IMAGES?>/icons/pause-button.svg" alt=""> 
                        </button>
                    </div>
                    <!-- End Video Wrapper Module -->
                    <div class="video-placeholder video-placeholder-section" style="background-image:url(<?php echo $video_cover ?>)">
                        <button class="play-video-btn mmmmmmmmmmmmmm">
                            <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                        </button>
                    </div>
                </div>

                <h2 id="js-video-title"><?php echo $video_title ?></h2>
                <hr>

                <div class="content-description">
                    <div class="text-description">
                        <p id="js-video-description"><?php echo $video_description ?></p>
                    </div>
                    <div class="text-profile d-none d-lg-block">
                        <div class="profile">
                            <img id="js-video-author-img" src="<?php echo $video_author_img; ?> " alt="">
                        </div>
                        <div class="data">
                            <h4 id="js-video-author-name"><?php echo $video_author[ 'nickname' ];?></h4>
                            <?php if(get_field('link_bio')): ?>
                                <a href="<?php the_field('link_bio')?>">View Full Bio</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- End Video Module -->
            </div><!--End Container-->
        </div>



        <!-- Grid Videos -->
        <div class="grid">
            <div class="container">
                <div class="header">
                    <h1>All Videos</h1>
                </div>
                <div class="grid-container">
                <?php 
                    while ( have_posts() ) : the_post(); ?>
                        <div class="grid-thumbnail">
                            <a href="javascript:void(0)" class="play">
                                <div class="trim">
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                                </div>
                                <button class="play-video-btn fix-index-btn">
                                    <div class="video" videourl="https://player.vimeo.com/video/<?php the_field('vimeo_video_id')?>?autoplay=1"></div>
                                    <img class="icon-play"  src="<?php echo IMAGES ?>/icons/play-button.svg" alt=""> 
                                </button>
                                <h1 class="js-video-title"><?php the_title();?></h1>
                                
                                <?php 
                                //----------------------------------------------------------------------------------------------------
                                // Get the post content, author name and img to be displayed with JS in the main video when clicked. 
                                //----------------------------------------------------------------------------------------------------
                                ?>
                                <div style="display:none;" class="js-video-description"><?php the_content();?></div>
                                <div style="display:none;" class="js-video-author-name"><?php the_author();?></div>
                                <div style="display:none;" class="js-video-author-img"><?php echo get_avatar(get_the_author_meta('ID')); ?></div>
                            </a>
                        </div>
                        <?php  
                    endwhile; ?>
                </div>
            </div>    
        </div>

        <script>
            $("document").ready(function(){

                //------------------------------------------------------------------
                //Replace Main video info with the info of a particular video post. 
                //------------------------------------------------------------------
                var iframe = $(".video-wrapper-section iframe")[0];
                var player = new Vimeo.Player(iframe);

                $('.play').click(function(){
                    var src = $(this).children('.play-video-btn').children('.video').attr('videourl');
                    var videoTitle = $(this).children('.js-video-title').text();
                    var videoDescription = $(this).children('.js-video-description').children('p').text();
                    var videoAuthorName = $(this).children('.js-video-author-name').text();
                    var videoAuthorImg = $(this).children('.js-video-author-img').children('img').attr('src');
                    
                    $('#js-video-title').text(videoTitle);
                    $('#js-video-description').text(videoDescription);
                    $('#js-video-author-name').text(videoAuthorName);
                    $('#js-video-author-img').attr('src', videoAuthorImg);

                    $('.video-placeholder-section').fadeOut("slow");
                    $('#principal_iframe').attr('src', src);
                    $("html, body").animate({ scrollTop: 180 }, "slow");
                });


                //------------------------------------------------------------------
                // Main Video Play Button: When clicked fade out the backgorund img
                // and plays the vidmeo iframe.  
                //------------------------------------------------------------------
            
                $(".video-placeholder-section .play-video-btn").click(function(){
                    $(this).parent().fadeOut("slow");
                    $(this).parent().siblings(".video-wrapper-section").children( "iframe" ).click();
                    player.play();
                })  
            
                $(".video-wrapper-section .close-video-btn").click(function(){
                    $(".video-placeholder-section .play-video-btn").parent().fadeIn("slow");
                    $( this ).parent().siblings( ".video-wrapper-section" ).children( "iframe" ).click();
                    player.pause();
                })
            })
        </script>
        <!-- End Grid Videos -->

        <div class="footer-navbar">
            <div class="container">
                <div class="box-container">
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer',
                        ) );
                    ?>
                </div>
            </div>
        </div>

    </div>

<?php get_footer(); ?>