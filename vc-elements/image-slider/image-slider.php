<?php

//Register "container" content element. It will hold all your inner (child) content elements
vc_map(
    array(
        "name" => __("Image Slider", "my-text-domain"),
        "base" => "vc_imageSlider",
        "as_parent" => array('only' => 'vc_imageSliderItem'),
        'description' => __('Image Slider Module', 'text-domain'),
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
            ),
        ),
    )
);

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_vc_imageSlider extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_item_output')){
    
    function wbc_item_output( $atts, $content = null){

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

        return customContainerHtml($slider_id, $title, do_shortcode( $content ));
    }
    add_shortcode( 'vc_imageSlider' , 'wbc_item_output' );

    function customContainerHtml($slider_id, $title, $data){
        ob_start(); ?>
        
        <!-- CustomContainer Module VC -->
        <div class="image-slider">
            <?php if( $title ): ?>
                <div class="container">
                    <h2 class="title"><?php echo $title; ?></h2>
                </div>
            <?php endif; ?>
            <div class="image-slider__container container">

                <img src="<?php echo IMAGES ?>/icons/prev.svg" class="prev prev_<?php echo $slider_id ?>">

                <div class="image-slider__container slider_<?php echo $slider_id ?>" id="slider_<?php echo $slider_id ?>">
                    <?php echo $data; ?>
                </div>

                <img src="<?php echo IMAGES ?>/icons/next.svg" class="next next_<?php echo $slider_id ?>">

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
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2,
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