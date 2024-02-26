<?php

//Register "container" content element. It will hold all your inner (child) content elements
vc_map(
    array(
        "name" => __("Blogging Vertical Articles - Container", "my-text-domain"),
        "base" => "vc_gridBlogging",
        "as_parent" => array('only' => 'vc_singleArticleBlog'),
        'description' => __('Blogging Grid Module ', 'text-domain'),
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
        ),
    )
);

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_vc_gridBlogging extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_gridBlogging_output')){
    
    function wbc_gridBlogging_output( $atts, $content = null){

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title' => '',
                ), 
                $atts
            )
        );

        $rand = rand();

        return customGridBloggingHtml( $title, $rand, do_shortcode( $content ));
    }
    add_shortcode( 'vc_gridBlogging' , 'wbc_gridBlogging_output' );

    function customGridBloggingHtml($title, $rand, $data){
        ob_start(); ?>
        
        <!-- Blogging Vertical Articles - Container - Container Module VC -->
        <div class="blogging-grid-container">   

            <div class="container">

                <div class="header">

                    <h2><?php echo $title; ?></h2>

                </div>

                <div class="body featured-article slick-features-<?php echo $rand; ?>">

                    <?php echo $data; ?>
                    
                </div>

            </div>

        </div>
            
    <!-- End Blogging Vertical Articles - Container - Container Module VC -->
       
    <?php
        return ob_get_clean();
    }
}

?>