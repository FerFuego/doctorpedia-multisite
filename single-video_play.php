<?php /* Template Name: Single Video Playlist */?>

<?php get_header('2021'); ?>

<?php the_post(); ?>

<?php $author = array();  $i = 0; ?>

<div class="video-playlist-container container" >

    <h1 class="title"><?php the_title(); ?></h1>
   
    <!-- Video Header -->
    <div class="video-module blog-post-page-header">
        <div class="video-wrapper video-wrapper-hub <?php echo (have_rows('call_to_action', 'option')) ? 'video-wrapper-limit-width video-module--state-play' : null; ?>">
            
            <?php $principal = get_field('principal_video');?>
            <?php query_posts('p='.$principal[0].'&post_type=videos&posts_per_page=1'); ?>
            <?php if(have_posts()):  the_post();  ?>
                <?php $vimeo = get_field('url_vimeo'); ?>
                <iframe id="iframe_principal" class="video" src=<?php echo "$vimeo"; ?> data-id="<?php echo end( explode("/", get_field('url_vimeo') ) ); ?>" frameborder="0" allow="autoplay"></iframe>
            <?php endif; ?>
            <?php wp_reset_query()?>

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
        </div>
        <?php 
            $post_thumbnail_id = get_post_thumbnail_id($v['video']);
            $url = wp_get_attachment_url( $post_thumbnail_id ); 
        ?>
        <div class="video-placeholder <?php echo (have_rows('call_to_action', 'option')) ? 'video-placeholder-limit' : null; ?>" style="background-image:url(<?php echo $url ?>)">
            <button class="play-video-btn">
                <img src="<?php print IMAGES; ?>/icons/play-button.svg" alt="Play Button">
            </button>
            <div class="description">
                <h2><?php the_field('subtitle_video_play') ?></h2>
                <h1><?php the_title() ?></h1>
            </div>
        </div>
    </div>
    <!-- End Video Header -->
    
    <!-- Video Transcript -->
    <div class="container">
        <div id="video-trascript">
            <?php $principal = get_field('principal_video');?>
            <?php query_posts('p='.$principal[0].'&post_type=videos&posts_per_page=1');
                if(have_posts()):  the_post();  ?>
                    
                <h1>
                    <?php the_title() ?>
                    <div id="transcript"><span>Transcript</span></div>
                </h1>
                <div id="tanscription">
                    <p><?php the_field('transcript') ?></p>
                </div>
                <?php $author[] = get_field('author')?>

            <?php endif; ?>
            <?php wp_reset_query()?>
        </div>
    </div>
    <!-- End Video Transcript -->
    
    <!-- Thumb Slider -->
    <div class="thumb-slider slider-pages">
        <div class="container">
            <div class="slider-container">
                <h2>Related Videos</h2>
                <?php  
                    if(!empty(get_field('playlist'))):
                        $count = count(get_field('playlist')) + 1;
                        if($count > 4){
                            echo '<img src="'.IMAGES.'/icons/prev.svg" alt="" class="prev">';
                        } ?>
                        <div id="slider_video_header" class="slider_video_header slides slides_grid">

                        <?php $principal = get_field('principal_video');?>
                        <?php query_posts('p='.$principal[0].'&post_type=videos&posts_per_page=1'); ?>
                        <?php if(have_posts()):  the_post(); 
                                $i++;
                                $post_thumbnail_id = get_post_thumbnail_id($v['video']);
                                $url = wp_get_attachment_url( $post_thumbnail_id ); 
                                $js_list[] = get_field('url_vimeo'); ?>
                                <div class="slider-single-item" id="<?php echo end( explode("/", get_field('url_vimeo') ) ); ?>" data-index="0">
                                    <div class="trim" style="background-image: url(<?php echo $url?>)">
                                        <div class="video" urlvideo="<?php the_field('url_vimeo') ?>" author="<?php echo $i?>"></div>
                                        <button class="play-video-btn">
                                            <img src="<?php print IMAGES; ?>/icons/play-button.svg" alt="Play Button">
                                        </button>
                                    </div>
                                    <div class="slider-single-item-content">
                                        <h2 class="slider-single-title"><?php the_title() ?></h2>
                                        <p class="hidden"><?php the_field('transcript') ?></p>
                                    </div>
                                    <?php $author[] = get_field('author')?>
                                </div>
                        <?php endif; ?>
                        <?php wp_reset_query()?>

                        <?php 
                            $z=1;
                            foreach(get_field('playlist') as $v):
                                $i++;
                                    query_posts('p='.$v['video'].'&post_type=videos&posts_per_page=1');
                                    if(have_posts()):  the_post(); 
                                        $post_thumbnail_id = get_post_thumbnail_id($v['video']);
                                        $url = wp_get_attachment_url( $post_thumbnail_id ); 
                                        $js_list[] = get_field('url_vimeo'); ?>
                                        <div class="slider-single-item" id="<?php echo end( explode("/", get_field('url_vimeo') ) ); ?>" data-index="<?php echo $z; ?>">
                                            <div class="trim" style="background-image: url(<?php echo $url?>)">
                                                <div class="video" urlvideo="<?php the_field('url_vimeo') ?>" author="<?php echo $i?>"></div>
                                                <button class="play-video-btn">
                                                    <img src="<?php print IMAGES; ?>/icons/play-button.svg" alt="Play Button">
                                                </button>
                                            </div>
                                            <div class="slider-single-item-content">
                                                <h2 class="slider-single-title"><?php the_title() ?></h2>
                                                <p class="hidden"><?php the_field('transcript') ?></p>
                                            </div>
                                            <?php $author[] = get_field('author')?>
                                        </div>
                                    <?php endif;
                                $z++;
                            endforeach;
                        echo '</div>';
                        if($count > 4){
                            echo '<img src="'.IMAGES.'/icons/next.svg" alt="" class="next">';
                        }
                        wp_reset_query();
                    endif;
                ?>
            </div>
        </div>    
    </div>
    <script>   
        $('document').ready(function(){
            $("#slider_video_header").slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 4,
                prevArrow: $(".prev"),
                nextArrow: $(".next"),
                responsive: [
                    {
                    breakpoint: 768,
                    settings: "unslick",
                    }
                ]
            });
        });
    </script>
    <!-- End Thumb Slider -->
</div>

<!-- Doctor Profile Module -->
<div class="doctor-profile-container pb-0">
    <div class="container doctor-grey-mobile">
        <?php 
            $i = 0;
            foreach($author as $a): 
                query_posts('p='.$a[0].'&post_type=bios&posts_per_page=1');
                if(have_posts()):  the_post(); ?>
                    <div class="doctor-profile author-video-play" id="author-<?php echo $i?>">
                        <div class="selfie">
                            <img src="<?php the_field('selfie')?>" alt="Doctor Profile">
                            <div class="networks">
                                <ul>
                                    <?php if(!empty(get_field('link_website')))  echo '<li><a href="'.get_field('link_website').'" target="_blank"><img src="'.IMAGES.'/icons/doctor-profile/click.svg"></a></li>'; ?>
                                    <?php if(!empty(get_field('link_email')))   echo '<li><a href="mailto:'.get_field('link_email').'" target="_blank"><img src="'.IMAGES.'/icons/doctor-profile/mail.svg"></a></li>'; ?>
                                    <?php if(!empty(get_field('link_facebook'))) echo '<li><a href="'.get_field('link_facebook').'" target="_blank"><img src="'.IMAGES.'/icons/doctor-profile/facebook.svg"></a></li>'; ?>
                                    <?php if(!empty(get_field('link_linkedin'))) echo '<li><a href="'.get_field('link_linkedin').'" target="_blank"><img src="'.IMAGES.'/icons/doctor-profile/linkedin.svg"></a></li>'; ?>
                                    <?php if(!empty(get_field('link_twitter')))  echo '<li><a href="'.get_field('link_twitter').'" target="_blank"><img src="'.IMAGES.'/icons/doctor-profile/twitter.svg"></a></li>'; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="dc-details">
                            <h1><?php the_field('name')?></h1>
                            <h2><?php the_field('position')?></h2>
                            <p><?php the_field('bio')?></p>
                            <div class="call-to-action">
                                <?php if(!empty(get_field('link_bio'))) echo '<a href="'.get_field('link_bio').'">View Full Bio</a>'; ?>
                                <?php if(!empty(get_field('link_video'))) echo '<a href="'.get_field('link_video').'">View All Videos</a>'; ?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            <?php $i++; ?>
        <?php endforeach ?>
        <?php wp_reset_query(); ?>
    </div>
</div>
<!-- End Doctor Profile Module -->

<?php if( have_rows('faqs') ): ?>
    <div class="container">
        <div class="faqs-section">
            <div class="faqs-navbar">
                <h2><?php the_field('title_faqs')?></h2>
            </div>
            <?php while ( have_rows('faqs') ) : the_row(); ?>
                <div class="question row">
                    <div class="col-lg-4 col-md-12">
                        <h2><?php the_sub_field('question')?></h2>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <p><?php the_sub_field('answers')?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif;?>

<?php the_content() ?>

<div class="vc_row wpb_row vc_row-fluid" style='background-color: #F2F2F2;'>
    <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="wpb_text_column wpb_content_element">
                    <div class="wpb_wrapper">
                        <p style='text-align: center;'>
                            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script id="js-playlist">
    $('document').ready(function(){
        var i = 0;
        var skip = 5;
        var iframe = document.getElementById('iframe_principal');
        var player = new Vimeo.Player(iframe);
        var playlist = [
            <?php foreach($js_list as $list) {
                echo "'" . end(explode("/",$list)) . "', \n\r";
            }?>
        ];

        //Show first author (Principal Video)
        $('#author-0').css({"display":"flex"});

        // First play button
        $('.video-module .play-video-btn').click(function(){
            $(this).parent().fadeOut('slow');
            $('#video-trascript').fadeIn();
            $(this).parent().siblings('.video-wrapper').children( 'iframe' ).click();
            $('#js-share-call-to-action').removeClass('d-none');
            $('#js-skip-intro').removeClass('d-none');
            setTimeout(function(){ player.play(); }, 1000);

            $('#transcript').click(function(){
                $('#tanscription').slideToggle('fast');
                $('#transcript span').toggleClass('inactive');
            });

            var width = $('#iframe_principal').width();
            $('#js-share-call-to-action').css({'width':width+'px'});
            $('#js-skip-intro').css({'width':width+'px'});

            $('.slider-single-item').css({'opacity':'0.6'});

            var item = $('#iframe_principal').attr('data-id');
            $('#' + item).css({'opacity':'1'});

            i++;
        });

        //Play slider item
        $('.slider-single-item').click(function(){

            $('.video-module .play-video-btn').parent().fadeOut('slow');

            $("html, body").animate({
                scrollTop: 0
            }, 1000);

            $('.slider-single-item').css({'opacity':'0.6'});

            i = $( this ).attr('data-index');

            if( playlist[i] ){
                player.loadVideo( playlist[i] ).then(function( id = playlist[i] ) {
                    $('#js-skip-intro').show('slow');
                    sliderItemsPlay( id );
                }).catch(function(error) {
                    console.log( error.name );
                });
                setTimeout(function(){ player.play(); }, 1000);
            }

            i++;

        });

        //Btn pause
        $('.video-module .close-video-btn').click(function(){
            $('.video-module .play-video-btn').parent().fadeIn('slow');
            $('#video-trascript').hide('slow');
            $( this ).parent().siblings( '.video-wrapper-section' ).children( 'iframe' ).click();
            player.pause();
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

        //Finish function
        player.on('ended', function() {

            $('.slider-single-item').css({'opacity':'0.6'});

            if( playlist[i] ){
                player.loadVideo( playlist[i] ).then( function( id = playlist[i] ) {
                    $('#js-skip-intro').show('slow');
                    sliderItemsPlay( id );
                }).catch(function(error) {
                    console.log( error.name );
                });
                setTimeout(function(){ player.play(); }, 1000);
                i++;
            }
        });

        function sliderItemsPlay( item ) {
            var author = $('#' + item).children('.trim').children('div').attr('author');
            var title = $('#' + item).children('.slider-single-item-content').children('h2').clone();
            var text = $('#' + item).children('.slider-single-item-content').children('p').clone();

            $('#video-trascript h1').replaceWith('<h1>'+ title[0].innerText +'<div id="transcript"><span>Transcript</span></div></h1>');
            $('#video-trascript #tanscription').replaceWith('<div id="tanscription">'+ text[0].innerText+'</div>');
            $('#video-trascript').fadeIn();
            $('.author-video-play').css({"display":"none"});
            $('#author-'+ author).css({"display":"flex"});

            $('#js-share-call-to-action').removeClass('d-none');
            $('#js-skip-intro').removeClass('d-none');
            $('#js-skip-intro').show('slow');

            $('#transcript').click(function(){
                $('#tanscription').slideToggle('fast');
                $('#transcript span').toggleClass('inactive');
            });

            var width = $('#iframe_principal').width();
            $('#js-share-call-to-action').css({'width':width+'px'});
            $('#js-skip-intro').css({'width':width+'px'});

            $('#' + item).css({'opacity':'1'});
        }
    });
</script>

<?php get_footer(); ?>