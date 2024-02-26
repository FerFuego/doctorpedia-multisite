<?php

//Register "container" content element. It will hold all your inner (child) content elements
vc_map(
    array(
        "name" => __("Featured Apps", "my-text-domain"),
        "base" => "vc_featuredApps",
        "as_parent" => array('only' => 'vc_featuredAppsItem, vc_featuredAppsItemManual'),
        'description' => __('Featured Apps Module', 'text-domain'),
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
	class WPBakeryShortCode_vc_featuredApps extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_app_output')){
    
    function wbc_app_output( $atts, $content = null){

        $slider_id = rand(999, 9999);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title' => '',
                    'link'  => '',
                ), 
                $atts
            )
        );
        
        $link = explode('|', $link);

        return customAppsContainerHtml( $slider_id, $title, $link, do_shortcode( $content ) );
    }
    add_shortcode( 'vc_featuredApps' , 'wbc_app_output' );
    add_shortcode( 'vc_featuredAppsItemManual' , 'wbc_app_output' );

    function customAppsContainerHtml( $slider_id, $title, $link, $data ){
        
        ob_start(); ?>
        
        <!-- Feature Apps Module VC -->

        <div class="image-slider featured-app-module">

            <?php if ( $title ) : ?>

                <div class="container">

                    <div class="header">

                        <h2 class="title"><?php echo $title; ?></h2>

                        <a href="<?php echo urldecode(str_replace('url:','', $link[0])) ?>" target="<?php echo urldecode(str_replace('target:','', $link[0])) ?>"><?php echo urldecode(str_replace('title:','', $link[1])) ?></a>

                    </div>

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

                var divs = document.getElementsByClassName("featured-app-item").length;

                if (divs <= 4 ) {
                    $('.next_<?php echo $slider_id ?>').remove();
                    $('.prev_<?php echo $slider_id ?>').remove();
                    if ( divs < 4) {
                        $('.featured-app-item .img-app ').css({'height':'345px'});
                    }
                }

                $("#slider_<?php echo $slider_id ?>").slick({
                    infinite: true,
                    slidesToShow: ( divs < 4 ) ? 3 : 4,
                    slidesToScroll: ( divs < 4 ) ? 3 : 4,
                    arrows: true,
                    prevArrow: $(".prev_<?php echo $slider_id ?>"),
                    nextArrow: $(".next_<?php echo $slider_id ?>"),
                    dots: <?php echo ( wp_is_mobile() ) ? 'true' : 'false'; ?>,
                    responsive: [
                        {
                            breakpoint: 1930,
                            settings: {
                                slidesToShow: ( divs < 4 ) ? 3 : 4,
                                slidesToScroll: ( divs < 4 ) ? 3 : 4,
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
        
        <!-- End Feature Apps Module VC -->
    <?php
        return ob_get_clean();
    }
}

?>