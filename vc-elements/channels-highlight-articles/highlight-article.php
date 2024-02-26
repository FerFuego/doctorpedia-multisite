<?php

//Register "container" content element. It will hold all your inner (child) content elements
vc_map(
    array(
        "name" => __("Highlight Articles Channels", "my-text-domain"),
        "base" => "vc_highlight",
        "as_parent" => array('only' => 'vc_singleArticle'),
        'description' => __('Highlight Articles Channels Module ', 'text-domain'),
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
                'type' => 'textfield',
                'class' => 'title-class',
                'heading' => __( 'Call To Action Copy', 'text-domain' ),
                'param_name' => 'call_to_action_copy',
                'value' => __( '', 'text-domain' ),
                'description' => __( '', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
            ),
            array(
                'type' => 'textfield',
                'class' => 'title-class',
                'heading' => __( 'Call To Action Link', 'text-domain' ),
                'param_name' => 'call_to_action_link',
                'value' => __( '', 'text-domain' ),
                'description' => __( '', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
            ),
            array(
                'type' => 'dropdown',
                'class' => 'title-class',
                'heading' => __( 'Background Color', 'text-domain' ),
                'param_name' => 'bg_color',
                'description' => __( '', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
                'value' => array(
                    __('gray'),
                    __('turquoise'),
                    __('pink'),
                ),
            ),
        ),
    )
);

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_vc_highlight extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_highlight_output')){
    
    function wbc_highlight_output( $atts, $content = null){

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title' => 'Highlight',
                    'call_to_action_copy' => '',
                    'call_to_action_link' => '',
                    'bg_color' => '',
                ), 
                $atts
            )
        );

        $rand = rand();

        return customHighlightHtml( $title, $rand, $bg_color, $call_to_action_copy, $call_to_action_link, do_shortcode( $content ));
    }
    add_shortcode( 'vc_highlight' , 'wbc_highlight_output' );

    function customHighlightHtml($title, $rand, $bg_color, $call_to_action_copy, $call_to_action_link, $data ){
        ob_start(); ?>
        
        <!-- Highlight Module VC -->
        <div class="blog-posts-preview-container highlight-channels <?php echo $bg_color; ?>">   

            <div class="container">

                <div class="header">

                    <h2><?php echo $title; ?></h2>
                    <a href="<?php echo $call_to_action_link;?>"><?php echo $call_to_action_copy;?></a>

                </div>

                <div class="body featured-article slick-features-<?php echo $rand; ?>">

                    <?php echo $data; ?>
                    
                </div>

            </div>

        </div>
    
        <!-- End Highlight Module VC -->
       
    <?php
        return ob_get_clean();
    }
}

?>