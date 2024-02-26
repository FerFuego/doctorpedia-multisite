<?php get_header(); ?>

<?php the_post();?>

<div class="video-library">
    <div class="videohub-page-header container">
        <h1 class="title"><?php the_title(); ?></h1>
        <!-- Video Module -->
        <div class="video-module blog-post-page-header">
        
            <!-- Video Wrapper Module -->
            <div class="video-wrapper video-wrapper-hub">
                <?php $vimeo = get_field('link_video'); ?>
                <iframe id="iframe_hub" class="video" src=<?php echo "$vimeo"; ?> frameborder="0" allow="autoplay"></iframe>
                <button class="close-video-btn">
                    <img class="icon-close"  src="<?php print IMAGES ?>/icons/pause-button.svg" alt=""> 
                </button>
            </div>
            <!-- End Video Wrapper Module -->
            <div class="video-placeholder video-placeholder-hub" style="background-image:url(<?php the_field('background_image') ?>)">
                <button class="play-video-btn">
                    <img src="<?php print IMAGES ?>/icons/play-button.svg" alt="Play Button">
                </button>
                <div class="description">
                    <div class="centering">
                        <h2><?php the_field('subtitle_video_hub') ?></h2>
                        <h1><?php the_field('principal_title') ?></h1>
                        <a href="<?php the_field('post_link')?>" class="link-view-all">View All</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Video Module -->
    </div>

    <div class="thumb-slider">
        <div class="container">
            <div class="slider-container">
                <?php if(count(get_field('videos_slide')) > 4): ?>
                    <img src="<?php print IMAGES ?>/icons/prev.svg" alt="" class="prev">
                <?php endif ?>
                
                <div id="slider_video_header" class="slider_video_header slides">
                    <?php  foreach(get_field('videos_slide') as $v): ?>
                        <div class="slider-single-item">
                            <div class="trim" style="background-image: url(<?php echo $v['image']?>)">
                                <div class="video" videourl="<?php echo $v['video_link'] ?>" ></div>
                                <button class="play-video-btn d-none d-lg-flex">
                                    <img src="<?php print IMAGES; ?>/icons/play-button.svg" alt="Play Button">
                                </button>
                            </div>
                            <div class="slider-single-item-content">
                                <h3><a href="<?php echo (!empty($v['page_link'])) ? $v['page_link']:'';?>"><?php echo $v['video_title']?></a></h3>
                                <h2><?php  echo $v['video_subtitle'] ?></h2>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <?php if(count(get_field('videos_slide')) > 4): ?>
                    <img src="<?php print IMAGES ?>/icons/next.svg" alt="" class="next">
                <?php endif ?>
            </div> 
        </div>    
    </div>

    <script>   
        $('document').ready(function(){
            $("#slider_video_header").slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 4,
                dots: false,
                arrows: true,
                prevArrow: $(".prev"),
                nextArrow: $(".next"),
                responsive: [
                    {
                        breakpoint: 1025,
                        settings: {
                            dots: true,
                        },
                    },

                    {
                        breakpoint: 768,
                        settings: {
                            dots: true,
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            arrows: false,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: "unslick"
                        
                    }

                ]
            })
        });
    </script>

    <script>
        $('document').ready(function(){
            $('.video-wrapper-hub .close-video-btn').fadeOut();
            var iframe_header = $('.video-wrapper-hub iframe')[0];
            var player_header = new Vimeo.Player(iframe_header);

            $('.video-placeholder-hub .play-video-btn').click(function(){
                $(this).parent().fadeOut('slow');
                $('#iframe_hub').click();
                setTimeout(function(){ player_header.play(); }, 1000);
            })  

            $('.slider-single-item').click(function(){
                var src = $(this).children().children('.video').attr('videourl');
                $('#iframe_hub').attr('src', src);
                $('#iframe_hub').click();
                $('.video-placeholder-hub').fadeOut();
                setTimeout(function(){ player_header.play(); }, 1000);  
            })
        })
    </script>

    <?php the_content() ?>

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