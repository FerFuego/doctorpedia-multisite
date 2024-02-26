<section class="m-landing-services">
    <h2 class="m-landing-services__title container"><?php echo get_sub_field('m-landing-services__title');?></h2>
    <div class="m-landing-services__services ">
        <div class="m-landing-services__slider">
            <?php 
            if ( have_rows( 'm-landing-services__services' ) ) :
                while ( have_rows('m-landing-services__services' ) ) : the_row(); 
                
                $active = get_sub_field('m-landing-services__active_service')['url'];
                $unactive = get_sub_field('m-landing-services__unactive_service')['url'];
                ?>

                <div class="slider-item-container">
                    <div class="unactive-service">
                        <img src="<?php echo $unactive;?>" alt="service">
                    </div>
                    <div class="active-service">
                        <img src="<?php echo $active; ?>" alt="service">
                    </div>
                </div>
            <?php 
                endwhile;
            endif; ?>
        </div>
        
        <div class="prev_service arrow_services">
          <img src="<?php echo IMAGES . '/landing/prev.svg'; ?>" alt="">
        </div>
        <div class="next_service arrow_services">
          <img src="<?php echo IMAGES . '/landing/next.svg'; ?>" alt="">
        </div>
    </div>
</section>

<script>

    $(document).ready(function(){
      
        $('.m-landing-services__slider').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: $(".prev_service"),
            nextArrow: $(".next_service"),
            centerMode: true,
            centerPadding: '40%',
            adaptiveHeight: true,
            responsive: [
              {
                breakpoint: 900,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerPadding: '35%',
                }
              },
              {
                breakpoint: 768,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerPadding: '35%',
                  dots: true
                }
              },
              {
                breakpoint: 415,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerPadding: '65px',
                  dots: true
                }
              }
        ]
        });

      //---------------------
      // Slider servides (Landing) - Arrows z-index
      //---------------------

      $('.arrow_services').click(()=>{
          $('.arrow_services').css('z-index', '0');
          setTimeout(() => {
              $('.arrow_services').css('z-index', '2');
          }, 500);
      })
    });

          /**
       * FIX JUMPING ANIMATION
       * Set special animation class on first or last clone.
       */
      $('.m-landing-services__slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
          var 
              direction,
              slideCountZeroBased = slick.slideCount - 1;

          if (nextSlide == currentSlide) {
              direction = "same";

          } else if (Math.abs(nextSlide - currentSlide) == 1) {
              direction = (nextSlide - currentSlide > 0) ? "right" : "left";

          } else {
              direction = (nextSlide - currentSlide > 0) ? "left" : "right";
          }

          // Add a temp CSS class for the slide animation (.slick-current-clone-animate)
          if (direction == 'right') {
              $('.slick-cloned[data-slick-index="' + (nextSlide + slideCountZeroBased + 1) + '"]', $('.m-landing-services__slider')).addClass('slick-current-clone-animate');
          }

          if (direction == 'left') {
              $('.slick-cloned[data-slick-index="' + (nextSlide - slideCountZeroBased - 1) + '"]', $('.m-landing-services__slider')).addClass('slick-current-clone-animate');
          }
      });

      $('.m-landing-services__slider').on('afterChange', function (event, slick, currentSlide, nextSlide) {
          $('.slick-current-clone-animate', $('.m-landing-services__slider')).removeClass('slick-current-clone-animate');
          $('.slick-current-clone-animate', $('.m-landing-services__slider')).removeClass('slick-current-clone-animate');
      });
</script>