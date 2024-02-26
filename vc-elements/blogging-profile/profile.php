<?php

//Register "container" content element. It will hold all your inner (child) content elements
vc_map(
    array(
        "name" => __("Blogging Profiles Slider - Container", "my-text-domain"),
        "base" => "vc_bloggingProfile",
        "as_parent" => array('only' => 'vc_singleProfile'),
        'description' => __('Blogging Profiles Module ', 'text-domain'),
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
            array(
                'type' => 'dropdown',
                'holder' => 'p',
                'class' => 'title-class',
                'heading' => __( 'Slides to show', 'text-domain' ),
                'param_name' => 'slides',
                'description' => __( '', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
                'value' => array(
                    __('Select the amount of slides'),
                    __('3'),
                    __('4'),
                ),
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => __(''),
                'param_name'  => 'background',
                'admin_label' => false,
                'value'       => array(
                    'Background Grey'=>'enable',
                ),
                'std' => ' ',
                'description' => __('Default White'),
                'group' => 'General',
            ),
        ),
    )
);

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_vc_bloggingProfile extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_bloggingProfile_output')){
    
    function wbc_bloggingProfile_output( $atts, $content = null){

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title' => '',
                    'link' => '',
                    'slides' => '',
                    'background' => ''
                ), 
                $atts
            )
        );

        $link = explode('|', $link);

        $rand = rand();

        return customBloggingProfileHtml( $title, $rand, $background, $slides, $link, do_shortcode( $content ));
    }
    add_shortcode( 'vc_bloggingProfile' , 'wbc_bloggingProfile_output' );

    function customBloggingProfileHtml($title, $rand, $background, $slides, $link, $data){
        ob_start(); ?>

        <!-- Blogging Profiles Slider - Container Module VC -->
        <div class="container-fluid bg-profile-container <?php echo ( $background ) ? 'bg-profile-bg-grey' : ''; ?>">
        
            <div class="container header-bg-profile">

                <h2><?php echo $title; ?></h2>

                <?php if ( $link ) : ?>

                    <a href="<?php echo urldecode(str_replace('url:','', $link[0])) ?>"><?php echo urldecode(str_replace('title:','', $link[1])) ?></a>

                <?php endif; ?>

            </div>

            <div class="slider-container container body-bg-profile-container">

                <img src="<?php echo IMAGES ?>/arrow-left.svg" class="prev prev_<?php echo $rand ?>">

                <div id="slider_<?php echo $rand ?>" class="slider_<?php echo $rand ?> slides">

                    <?php echo $data; ?>

                </div>

                <img src="<?php echo IMAGES ?>/arrow-right.svg" class="next next_<?php echo $rand ?>">

            </div>

        </div>

        <script>   
            $("document").ready(function(){
                var divs = document.getElementsByClassName("slider-single-item").length;

                if ( divs <= 4 || $(window).width() < 769 ) {
                    $('.next_<?php echo $rand; ?>').remove();
                    $('.prev_<?php echo $rand; ?>').remove();
                }

                $("#slider_<?php echo $rand; ?>").slick({
                    infinite: true,
                    slidesToShow: <?php echo ( $slides ) ? $slides : '4'; ?>,
                    slidesToScroll: <?php echo ( $slides ) ? $slides : '4'; ?>,
                    prevArrow: $(".prev_<?php echo $rand; ?>"),
                    nextArrow: $(".next_<?php echo $rand; ?>"),
                    dots: ($(window).width() < 769 ) ? true : false,
                    responsive: [
                        {
                            breakpoint: 1930,
                            settings: {
                                slidesToShow: <?php echo ( $slides ) ? $slides : '4'; ?>,
                                slidesToScroll: <?php echo ( $slides ) ? $slides : '4'; ?>,
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
                $("#slider_<?php echo $rand; ?>").not(".slick-initialized").slick("resize");
            });
        </script>
        <!-- End Blogging Profiles Slider - Container Module VC -->
               
    <?php
        return ob_get_clean();
    }
}
?>