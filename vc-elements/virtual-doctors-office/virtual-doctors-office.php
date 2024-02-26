<?php

//Register "container" content element. It will hold all your inner (child) content elements
vc_map(
    array(
        "name" => __("Virtual Doctors Office", "my-text-domain"),
        "base" => "vc_virtualDoctorsOffice",
        "as_parent" => array('only' => 'vc_virtualDoctorsOfficeItem'),
        'description' => __('Virtual Doctors Office Module', 'text-domain'),
        "content_element" => true,
        "show_settings_on_create" => false,
        "is_container" => true,
        'category' => __('DoctorPedia Elements', 'text-domain'),   
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
            )
        ),
    )
);

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_vc_virtualDoctorsOffice extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_vdo_output')){
    
    function wbc_vdo_output( $atts, $content = null){

        $slider_id = rand(999, 9999);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title' => '',
                ), 
                $atts
            )
        );

        return customVDOContainerHtml( $slider_id, $title, do_shortcode( $content ) );
    }
    add_shortcode( 'vc_virtualDoctorsOffice' , 'wbc_vdo_output' );

    function customVDOContainerHtml( $slider_id, $title, $data ){
        
        ob_start(); ?>
        
        <!-- CustomContainer Module VC -->

        <div class="image-slider featured-app-module virtual-doctors-office-container">

            <?php if ( $title ) : ?>

                <div class="container">

                    <div class="header">

                        <h2 class="title"><?php echo $title; ?></h2>

                    </div>

                </div>

            <?php endif; ?>

            <div class="image-slider__container container virtual-doctors-office-container__body">

                <!-- <img src="<?php //echo IMAGES ?>/icons/prev.svg" class="prev prev_<?php //echo $slider_id ?>"> -->

                <div class="image-slider__container slider_<?php echo $slider_id ?> virtual-doctors-office-container__body__slider" id="slider_<?php echo $slider_id ?>">

                    <?php echo $data; ?>

                </div>

                <!-- <img src="<?php //echo IMAGES ?>/icons/next.svg" class="next next_<?php //echo $slider_id ?>"> -->

            </div>
            
        </div>

        <script>   
            $("document").ready(function(){
                $("#slider_<?php echo $slider_id ?>").slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    arrows: true,
                    prevArrow: $(".prev_<?php echo $slider_id ?>"),
                    nextArrow: $(".next_<?php echo $slider_id ?>"),
                    responsive: [
                        {
                            breakpoint: 1930,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 4,
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
        
        <!-- End CustomContainer Module VC -->
    <?php
        return ob_get_clean();
    }
}

?>