<section class="m-landing-hero">
<div calss="container">
</div>
    <div class="m-landing-hero__primary_box container">
        <h1 class="m-landing-hero__title"><?php echo get_sub_field('m-landing-hero__title');?></h1>
        <div class="m-landing-hero__copy"><?php echo get_sub_field('m-landing-hero__copy');?></div>
    </div>

    <div class="m-landing-hero__seconday_box container">
        <img src="<?php echo ( get_sub_field('m-landing-hero__principal-image') ) ? get_sub_field('m-landing-hero__principal-image')['url'] : IMAGES . '/landing/hero.png'; ?>" alt="example-doctor" class="m-landing-hero__example">
        <div class="doctor-gif" style="background-image: url('<?php echo get_sub_field('m-landing-hero__gif')['url']; ?>');">
            <button class="play-video-btn">
                <img class="icon-play" src="<?php echo IMAGES . '/icons/play-button.svg'; ?>" alt="play"> 
            </button>
        </div>

        <div  class="green-doctor">
            <?php if ( get_sub_field('m-landing-hero__doc-image-1') ) : ?>
                <video muted autoplay>
                    <source src="<?php echo get_sub_field('m-landing-hero__doc-image-1').'?autoplay=1';?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php else : ?>
                <img src="<?php echo IMAGES .'/landing/green-doc.png'; ?>" alt="doctor">
            <?php endif; ?>
        </div>
        <div class="blue-doctor">
            <img src="<?php echo ( get_sub_field('m-landing-hero__doc-image-2') ) ? get_sub_field('m-landing-hero__doc-image-2')['url'] : IMAGES .'/landing/blue-doc.png'; ?>" alt="doctor">
        </div>
        <div class="yellow-doctor">
            <img src="<?php echo ( get_sub_field('m-landing-hero__doc-image-3') ) ? get_sub_field('m-landing-hero__doc-image-3')['url'] : IMAGES .'/landing/yellow-doc.png'; ?>" alt="doctor">
        </div>
        <div class="pink-doctor">
            <img src="<?php echo ( get_sub_field('m-landing-hero__doc-image-4') ) ? get_sub_field('m-landing-hero__doc-image-4')['url'] : IMAGES .'/landing/pink-doc.png'; ?>" alt="doctor">
        </div>
    </div>

    <a href="#" class="m-landing-hero__keep-reading">Keep Reading <img src="<?php echo IMAGES . '/modules/search/down-arrow-red.svg'; ?>" alt="arrow"></a>
</section>

<script>
    /**
     * Loop videos landing page
     */
    $('video').on('ended', function () {
        this.load();
        this.play();      
    })

    setTimeout(() => {
       $('.play-video-btn').animate({
           opacity: 0
       }, 1000) 
    }, 3000);
</script>