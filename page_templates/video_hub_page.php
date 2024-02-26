<?php /* Template Name: Video Hub */?>

<?php get_header(); ?>

<?php the_post();?>

<div class="video-hub-page">
    <div class="videohub-page-header">
        <!-- Video Module -->
        <div class="video-module blog-post-page-header">
            <!-- Video Wrapper Module -->
            <div class="video-wrapper video-wrapper-hub <?php echo (have_rows('call_to_action', 'option')) ? 'video-wrapper-limit-width video-module--state-play' : null; ?>">
                
                <?php $vimeo = get_field('link_video'); ?>
                <iframe id="iframe_hub" class="video" src=<?php echo "$vimeo"; ?> frameborder="0" allow="autoplay"></iframe>

                <button class="close-video-btn" id="close-video-btn-header">
                    <img class="icon-close"  src="<?php print IMAGES ?>/icons/pause-button.svg" alt=""> 
                </button>

                <?php if( have_rows('call_to_action', 'option') ): ?>
                    <div class="video-wrapper-section__sidebar">
                        <?php while( have_rows('call_to_action', 'option') ): the_row(); ?>
                            <div class="video-wrapper-section__sidebar__box">
                                <p><?php the_sub_field('title'); ?></p>
                                <a href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>"><?php echo get_sub_field('link')['title']; ?></a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                
                <input type="hidden" id="old_data" old_data="<?php the_field('link_video') ?>">
                <div class="video-placeholder video-placeholder-hub <?php echo (have_rows('call_to_action', 'option')) ? 'video-placeholder-limit' : null; ?>" style="background-image:url(<?php the_field('background_image') ?>)">
                    <button class="play-video-btn">
                        <img src="<?php print IMAGES ?>/icons/play-button.svg" alt="Play Button">
                    </button>
                </div>
            </div>
            <!-- End Video Wrapper Module -->
            <div class="description">
                <div class="centering">
                    <h2><?php the_field('subtitle_video_hub') ?></h2>
                    <h1><?php the_field('principal_title') ?></h1>
                </div>
            </div>
        </div>
        <!-- End Video Module -->
    </div>
    
    <div class="thumb-slider main-slider">
        <div class="container">
            <h1 class="title"><?php the_field('videos_title');?></h1>
            <div class="slider-container">
                <?php if(count(get_field('videos_slide')) > 4): ?>
                <img src="<?php print IMAGES ?>/icons/prev.svg" alt="" class="prev">
                <?php endif ?>
                
                <div id="slider_video_header" class="slider_video_header slides">
    
                    <?php  foreach(get_field('videos_slide') as $v): ?>
                        <div class="slider-single-item thumbnail-header">
                            <div class="trim" style="background-image: url(<?php echo $v['image']?>)">
                                <div class="video" videourl="<?php echo $v['video_link'] ?>?autoplay=1" ></div>
                                <button class="play-video-btn">
                                    <img src="<?php print IMAGES; ?>/icons/play-button.svg" alt="Play Button">
                                </button>
                            </div>
                            <div class="slider-single-item-content">
                                <h2 class="slider-single-title"><?php  echo $v['video_title'] ?></h2>
                            </div>
                        </div>
                    <?php endforeach; ?>
    
                </div>
                
                <?php if(count(get_field('videos_slide')) > 4): ?>
                <img src="<?php print IMAGES ?>/icons/next.svg" alt="" class="next">
                <?php endif ?>
            </div>
            <hr>  
        </div>    
    </div>
    <script>   
        $(document).ready(function() {
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

        $('document').ready(function(){
            $('.video-placeholder-hub .play-video-btn').fadeOut();
            $('.video-wrapper-hub .close-video-btn').fadeOut();
            var iframe = $('.video-wrapper-hub iframe')[0];
            var player = new Vimeo.Player(iframe);

            $('.video-placeholder-hub .play-video-btn').click(function(){
                $(this).parent().fadeOut('slow');
                $(this).parent().siblings('.video-wrapper-hub').children( 'iframe' ).click();
                player.play();
                if($(window).width() > 767){
                    $('.videohub-page-header .video-module .description').fadeOut('slow');
                }
            })  

            $('.thumbnail-header').click(function(){
                var src = $(this).children('.trim').children('div').attr('videourl');
                $('#iframe_hub').attr('src', src);
                $('.video-placeholder-hub').fadeOut();
                $('.videohub-page-header .video-module .description').fadeOut('slow');
                $('.thumbnail-header .play-video-btn').siblings('.video-wrapper-hub').children( 'iframe' ).click();
                player.play();

                $("html, body").animate({
                    scrollTop: 0
                }, 1000);
            })

            $('#close-video-btn-header').click(function(){

                var links = $('#close-video-btn-header').children('img').attr('src');
                var result = links.split('/').pop();
                
                if($('#close-video-btn-header').attr('data-action') == 'reactive'){
                    $('#close-video-btn-header').children('img').attr('src', window.location.origin + window.location.pathname + 'wp-content/themes/doctorpedia_theme/img/icons/pause-button.svg');
                    $('#close-video-btn-header').attr('data-action', 'pause');
                    $( this ).parent().siblings( '.video-wrapper-hub' ).children( 'iframe' ).click();
                    player.play();
                }else{
                    $('#close-video-btn-header').children('img').attr('src', window.location.origin + window.location.pathname + 'wp-content/themes/doctorpedia_theme/img/icons/play-button.svg');
                    $('#close-video-btn-header').attr('data-action', 'reactive');
                    $( this ).parent().siblings( '.video-wrapper-hub' ).children( 'iframe' ).click();
                    player.pause();
                }

            });

            var countSliderChilds = $('#slider_video_header').children().length;
            if( countSliderChilds % 2 != 0 ) {
                $('#slider_video_header .blog-thumbnail:last-child').css('margin', '0 auto');
            }

        })
    </script>

    <?php if(get_field('playlist')): ?>
        <!-- Related Posts -->
        <div class="featured-posts-preview-container">            
            <div class="container">
                <div class="header">
                    <h1><?php the_field('section_title') ?></h1>
                </div>
                <div class="slider-container">
                    <?php $rand_0 = rand(999, 9999) ?>
                    <div class="featured-article slick_<?php echo $rand_0; ?>">
                        <?php foreach(get_field('playlist') as $list): ?>
                            <?php $i++; ?>
                            <?php query_posts('p='.$list['video'].'&post_type=video_play&posts_per_page=1'); ?>
                            <?php if(have_posts()):  the_post(); ?>
                                
                                <div class="blog-post-preview">
                                    <a href="<?php the_permalink() ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>);" class="trim"></a>
                                    <div class="content">
                                        <a href="<?php the_permalink()?>"><h2><?php the_title()?></h2></a>
                                    </div>
                                    <?php if( !empty((get_avatar(get_the_author_meta('email'), '32')) ) )  {?>
                                    <div class="footer">
                                        <div class="post-author"><?php echo get_avatar(get_the_author_meta('email'), '32'); ?></div>
                                        <span> <?php echo get_the_author(); ?></span>
                                    </div>
                                    <?php }?>
                                </div>
                                
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <script>   
        $(document).ready(function() {
            $(".slick_<?php echo $rand_0;?>").slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3,
                arrows: false,
                dots: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: "unslick",
                    }
                ]
            });
            $(".slider-videos").slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3,
                prevArrow: $(".search-page-videos-slider .prev"),
                nextArrow: $(".search-page-videos-slider .next"),
                dots: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: "unslick",
                    }
                ]
            });

            $(".slider-app-review").slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3,
                prevArrow: $(".app-review-container .prev"),
                nextArrow: $(".app-review-container .next"),
                dots: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: "unslick",
                    }
                ]
            });
        });
        </script>
        <!-- End Related Post -->
    <?php endif; ?>

    <?php the_content() ?>

    <?php get_footer(); ?>
</div>