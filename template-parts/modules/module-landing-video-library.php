<section class="m-video-library">
    <div class="m-video-library__primary_box container">
        <h3 class="m-video-library__title"><?php echo get_sub_field('m-video-library__title');?></h3>
        <p class="m-video-library__copy"><?php echo get_sub_field('m-video-library__copy');?></p>
    </div>

    <div class="m-video-library__secondary_box container">
        <img class="image-video-library" src="<?php echo get_template_directory_uri(); ?>/img/landing/video-library.png" alt="">
        <div class="m-video-library__gif_container" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/landing/video-library.png')">
            <div class="m-video-library__gif" style="background-image: url('<?php echo get_sub_field('m-video-library__gif')['url']; ?>')">
                <div class="fake-play-button">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/icons/play-button.svg" alt="play">
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        //---------------------
        // Video animation play button (Landing)
        //---------------------
        $(window).scroll(function () {
            var hT = $('.m-video-library').offset().top,
                hH = $('.m-video-library').outerHeight(),
                wH = $(window).height(),
                wS = $(this).scrollTop();
            if (wS > (hT + hH - wH)) {
                setTimeout(function() {
                    $('.fake-play-button').animate({
                        opacity: 0
                    }, 500); 
                }, 1500);
            }
        });
    })
</script>