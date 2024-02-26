<?php

//Register "container" content element. It will hold all your inner (child) content elements
vc_map(
    array(
        "name" => __("Blogging Slider - Container", "my-text-domain"),
        "base" => "vc_blogging",
        "as_parent" => array('only' => 'vc_singleBlogging'),
        'description' => __('Blogging Module', 'text-domain'),
        "content_element" => true,
        "show_settings_on_create" => false,
        "is_container" => true,
        'category' => __('DoctorPedia Blogging', 'text-domain'),   
        'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
        "js_view" => 'VcColumnView',
        'params' => array(
            array(
                'type' => 'textfield',
                'class' => 'title-class',
                'heading' => __( 'Title', 'text-domain' ),
                'param_name' => 'title',
                'value' => __( '', 'text-domain' ),
                'description' => __( '', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
            ),
            array(
                'type' => 'vc_link',
                'class' => 'title-class',
                'heading' => __( 'Link', 'text-domain' ),
                'param_name' => 'link',
                'value' => __( '', 'text-domain' ),
                'description' => __( '', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
            ),
        ),
    )
);

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_vc_blogging extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_blogging_output')){
    
    function wbc_blogging_output( $atts, $content = null){

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title' => 'Blogging',
                    'link'  => '/blogs',
                ), 
                $atts
            )
        );

        $slider_id = rand();

        $link = explode('|', $link);

        return customBloggingHtml( $title, $slider_id, $link, do_shortcode( $content ));
    }
    add_shortcode( 'vc_blogging' , 'wbc_blogging_output' );

    function customBloggingHtml($title, $slider_id, $link, $data){
        ob_start(); ?>
        
        <!-- Blogging Slider - Container Module VC -->

        <div class="image-slider featured-app-module blogging-slider-container">

            <div class="container">

                <?php if ( $title ) : ?>

                    <div class="header">

                        <h2 class="title"><?php echo $title; ?></h2>

                        <?php if ( $link ) :?>

                            <a href="<?php echo urldecode(str_replace('url:','', $link[0])) ?>" target="<?php echo urldecode(str_replace('target:','', $link[2])) ?>"><?php echo urldecode(str_replace('title:','', $link[1])) ?></a>

                        <?php endif; ?>

                    </div>

                <?php endif; ?>

                <div class="image-slider__container">
                    
                    <img src="<?php echo IMAGES ?>/icons/stroke-prev.svg" class="prev prev_<?php echo $slider_id ?>">

                    <div class="image-slider__container slider_<?php echo $slider_id ?>" id="slider_<?php echo $slider_id ?>">

                        <?php echo $data; ?>

                    </div>
                
                    <img src="<?php echo IMAGES ?>/icons/stroke-next.svg" class="next next_<?php echo $slider_id ?>">

                </div>

            </div>
            
        </div>

        <script>   
            $("document").ready(function(){
                var divs = document.getElementsByClassName("single-blogging-item-container").length;

                if (divs <= 4 ) {
                    $('.next_<?php echo $slider_id ?>').remove();
                    $('.prev_<?php echo $slider_id ?>').remove();
                }

                $("#slider_<?php echo $slider_id ?>").slick({
                    infinite: true,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    prevArrow: $(".prev_<?php echo $slider_id ?>"),
                    nextArrow: $(".next_<?php echo $slider_id ?>"),
                    dots: (divs > 4 ) ? true : ( $(window).width() < 769 ) ? true : false,
                    responsive: [
                        {
                            breakpoint: 1930,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 450,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                            }
                        },
                    ]
                });
            });
            
            $(window).on("resize", function() {
                $("#slider_<?php echo $slider_id ?>").not(".slick-initialized").slick("resize");
            });
        </script>
        
        <!-- End Blogging Slider - Container Module VC -->
       
    <?php
        return ob_get_clean();
    }
}

?>