<?php

//Register "container" content element. It will hold all your inner (child) content elements
vc_map(
    array(
        "name" => __("Grid Articles Channels", "my-text-domain"),
        "base" => "vc_gridChannels",
        "as_parent" => array('only' => 'vc_singleArticleGrid'),
        'description' => __('Grid Articles Channels Module ', 'text-domain'),
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
	class WPBakeryShortCode_vc_gridChannels extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_gridChannels_output')){
    
    function wbc_gridChannels_output( $atts, $content = null){

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

        return customGridChannelsHtml( $title, $rand, do_shortcode( $content ));
    }
    add_shortcode( 'vc_gridChannels' , 'wbc_gridChannels_output' );

    function customGridChannelsHtml($title, $rand, $data){
        ob_start(); ?>
        
        <!-- Grid Channels Module VC -->
        <div class="blog-posts-preview-container grid-channel-container">   

            <div class="container">

                <div class="header">

                    <h2><?php echo $title; ?></h2>

                </div>

                <div class="body featured-article slick-features-<?php echo $rand; ?>">

                    <?php echo $data; ?>
                    
                </div>

            </div>

        </div>
            
    <!-- End Grid Channels Module VC -->
       
    <?php
        return ob_get_clean();
    }
}

?>