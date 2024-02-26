<?php

function getHighArticles(){

    global $wpdb;
    global $post;
    
    $posts[] = __('');

    $args = array(
        'post_type' => 'categories',
        'status' => 'publish',
        'posts_per_page' => -1,
        'nopaging' => true
    );

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ):

        while( $the_query->have_posts() ) : $the_query->the_post();

            $posts[] = __( get_the_ID() . '|' . get_the_title() );

        endwhile;

    endif;

    return $posts;
}

//Register "container" content element. It will hold all your inner (child) content elements
vc_map(
    array(
        "name" => __("Channels News", "my-text-domain"),
        "base" => "vc_newsChannels",
        "as_parent" => array('only' => 'vc_singleNewsArticles'),
        'description' => __('Channels News Module ', 'text-domain'),
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
                'type' => 'dropdown',
                'holder' => 'p',
                'class' => 'title-class',
                'heading' => __( 'Featured Article', 'text-domain' ),
                'param_name' => 'post',
                'description' => __( '', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
                'value' => getHighArticles(),
            )
        ),
    )
);

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_vc_newsChannels extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_newsChannels_output')){
    
    function wbc_newsChannels_output( $atts, $content = null){

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title' => '',
                    'post' => ''
                ), 
                $atts
            )
        );

        $rand = rand();

        $post_obj = explode('|', $post)[0];

        $post_obj = get_post( $post_obj );

        return customnewsChannelsHtml( $title, $rand, $post_obj, do_shortcode( $content ));
    }
    add_shortcode( 'vc_newsChannels' , 'wbc_newsChannels_output' );

    function customnewsChannelsHtml($title, $rand, $post_obj, $data){
        ob_start(); ?>
        
        <!-- Channels News Module VC -->
        <div class="blog-posts-preview-container news-channel-container">   

            <div class="container">

                <div class="header-news">
                    <h2><?php echo $title; ?></h2>
                </div>

                <div class="body body-fix">

                    <div class="block pl-0">

                        <?php 
                            $post_link = get_post_permalink( $post_obj->ID );
                            $post_description = get_post_meta( $post_obj->ID, 'short_description', true);
                        ?>

                        <div class="blog-post-news" data-slug="<?php echo $post_link; ?>">
        
                            <a href="<?php echo $post_link; ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post_obj->ID, 'large'); ?>)" class="trim"></a>
                        
                            <div class="content">
                        
                                <a href="<?php echo $post_link; ?>">
                                    <h2><?php echo $post_obj->post_title; ?></h2>
                                </a>

                                <?php if ( $post_description ) : ?>
                                    <p><?php echo $post_description; ?></p>
                                <?php endif; ?>
                        
                            </div>
                        
                        </div>

                    </div>

                    <div class="block pr-0">
                        <?php echo $data; ?>
                    </div>
                    
                </div>

            </div>

        </div>
            
    <!-- End Channels News Module VC -->
       
    <?php
        return ob_get_clean();
    }
}

?>