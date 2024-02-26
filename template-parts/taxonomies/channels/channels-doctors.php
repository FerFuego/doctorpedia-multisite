<!-- Channels Doctors Template Parts -->
<?php $slider_id = rand(); ?>

<div class="container-fluid channels-specialists">

    <div class="container">

        <?php if ( get_sub_field('specialty_title') ) : ?>

            <div class="header-specialist">

                <h2 class="title"><?php echo get_sub_field('specialty_title'); ?></h2>

            </div>

        <?php endif; ?>

        <?php if( have_rows('specialist') ) : ?>

            <?php $j=0; ?>

            <img src="<?php echo IMAGES; ?>/icons/prev.svg" alt="" class="d-none d-xl-block arrows prev prev_<?php echo $slider_id ?>" id="btn-prev">

            <div class="channels_doctors" id="channels_doctors_<?php echo $slider_id ?>">

                <?php while ( have_rows('specialist') ) : the_row(); ?>

                    <!-- Tab content -->
                    <div class="tabcontent active" >

                        <div class="doctor-profile">

                            <div class="col-md-4 pl-md-0">

                                <img src="<?php echo get_sub_field('image')['url']?>" alt="Doctor Profile">

                            </div>

                            <div class="col-md-8 pr-md-0 doc-mobile">

                                <h3><?php the_sub_field('name')?></h3>

                                <h4><?php the_sub_field('specialty')?></h4>

                                <ul>

                                    <?php while ( have_rows('items') ) : the_row(); ?>

                                        <li><?php echo get_sub_field('item'); ?></li>
                                    
                                    <?php endwhile; ?>

                                </ul>

                                <p><?php the_sub_field('bio') ?></p>

                                <?php if ( get_sub_field('link')) : ?>

                                    <div class="call-to-action">

                                        <a href="<?php echo get_sub_field('link')['url']?>" target="<?php echo get_sub_field('link')['target']; ?>"><?php echo (get_sub_field('link')) ? get_sub_field('link')['title'] : 'View Full Bio'; ?></a>

                                    </div>

                                <?php endif; ?>

                            </div>

                        </div>
                        
                    </div>
                    <!-- End Tab content -->

                    <?php $j++; ?>

                <?php endwhile; ?>

            </div>

            <img src="<?php echo IMAGES ?>/icons/next.svg" alt="" class="d-none d-xl-block arrows next next_<?php echo $slider_id ?>" id="btn-next">

        <?php endif; ?>

    </div>

</div>

<script>   
    $(document).ready(function(){
        $("#channels_doctors_<?php echo $slider_id ?>").slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: $(".prev_<?php echo $slider_id ?>"),
            nextArrow: $(".next_<?php echo $slider_id ?>"),
            dots: <?php echo ( $j > 1 ) ? 'true' : 'false'; ?>
        });
        
        let items = '<?php echo $j; ?>';
        if ( items <= 1 ) {
            $('.arrows').remove();
        }
    });
    $(window).on("resize", function() {
        $(".channels_doctors").not(".slick-initialized").slick("resize");
    });
</script>
<!-- End Channels Doctors Template Parts -->