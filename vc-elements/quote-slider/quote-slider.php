<?php

//Register "container" content element. It will hold all your inner (child) content elements
vc_map(
    array(
        "name" => __("Quote Slider", "my-text-domain"),
        "base" => "vc_quote_slider",
        "as_parent" => array('only' => 'vc_singleQuote'),
        'description' => __('Quote Slider Module', 'text-domain'),
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
	class WPBakeryShortCode_vc_quote_slider extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_quote_slider_output')){
    
    function wbc_quote_slider_output( $atts, $content = null){

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title' => '',
                ), 
                $atts
            )
        );

        $slider_id = rand();

        return customQuote_sliderHtml( $title, $slider_id, do_shortcode( $content ));
    }
    add_shortcode( 'vc_quote_slider' , 'wbc_quote_slider_output' );

    function customQuote_sliderHtml($title, $slider_id, $data){
        ob_start(); ?>
        
        <!-- Quote Slider Module VC -->
        <div class="quote-slider">

            <div class="container">

                <?php if ( $title ) : ?>

                    <div class="quote-slider__header">

                        <h2 class="title"><?php echo $title; ?></h2>

                    </div>

                <?php endif; ?>

                <div class="quote-slider__float">

                    <img src="<?php echo IMAGES; ?>/quotes.svg">
                    
                </div>
                    
                <div class="quote-slider__content" id="slider_<?php echo $slider_id ?>">

                    <?php echo $data; ?>

                </div>

            </div>
            
        </div>

        <script>   
            $("document").ready(function(){

                $("#slider_<?php echo $slider_id ?>").slick({
                    autoplay: true,
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: true,
                });
            });
        </script>     
        <!-- End Quote Slider Module VC -->
       
    <?php
        return ob_get_clean();
    }
}

?>