<?php

function getBlogHighArticles(){

    global $wpdb;
    global $post;
    
    $posts[] = __('');

    $args = array(
        'post_type' => 'blog',
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
if(is_admin()){
    vc_map(
        array(
            "name" => __("Blogging Grid - Container", "my-text-domain"),
            "base" => "vc_newsBlogging",
            "as_parent" => array('only' => 'vc_singleBloggingNews'),
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
                    'value' => getBlogHighArticles(),
                )
            ),
        )
    );
}

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_vc_newsBlogging extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_newsBlogging_output')){
    
    function wbc_newsBlogging_output( $atts, $content = null){

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

        $post = @explode('|', $post)[0];

        $post = get_post( $post );

        return customnewsBloggingHtml( $title, $rand, $post, do_shortcode( $content ));
    }
    add_shortcode( 'vc_newsBlogging' , 'wbc_newsBlogging_output' );

    function customnewsBloggingHtml($title, $rand, $post, $data){
        ob_start(); ?>
        
        <!-- Blogging Grid - Container Module VC -->
        <div class="blog-posts-preview-container blogging-news-container">   

            <div class="container">

                <?php if ( $title ) : ?>

                    <div class="header">

                        <h2><?php echo $title; ?></h2>

                    </div>

                <?php endif; ?>

                <div class="body body-fix">

                    <div class="block pl-0 block__column">

                        <?php echo $data; ?>

                    </div>

                    <div class="block pr-0 block__big-picture">

                        <a href="<?php echo get_post_permalink( $post->ID ); ?>">

                            <div class="block__big-picture__box blog-post-news trim" data-slug="<?php echo get_post_permalink( $post->ID ); ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post->ID, 'large'); ?>)">

                                <!-- Hardcoded - Tag -->
                                <h5 class="blogging-header__channel-body__tag">Featured</h5>

                                <!-- Hardcoded - Star -->
                                <div class="blogging-header__channel-body__star"><img src="<?php echo IMAGES; ?>/blogging/blogging-star.svg" alt="Star"></div>
                        
                                <div class="big_shadow"></div>

                                <div class="content">

                                    <!-- Author -->
                                    <div class="content-author-container">
                                    
                                        <img class="content-author-img rounded-circle" src="<?php echo get_avatar_url($post->post_author, '32'); ?>" alt="<?php the_author_meta('display_name', $post->post_author );?>">

                                        <div class="content-author-text">
                                        
                                            <h3 class="content-author-title"><?php the_author_meta('display_name', $post->post_author );?></h3>
                                            <h4 class="content-author-date"><?php echo get_the_date('', $post->ID ); ?></h4>

                                        </div>

                                    </div>
                                                        
                                    <h2><?php echo $post->post_title; ?></h2>
        
                                    <?php if ( get_post_meta( $post->ID, 'short_description', true) ) : ?>
                                    
                                        <p><?php echo get_post_meta( $post->ID, 'short_description', true); ?></p>
    
                                    <?php endif; ?>
    
                                </div>
                                
                            </div>

                        </a>

                    </div>
                    
                </div>

            </div>

        </div>
        <!-- End Blogging Grid - Container Module VC -->
       
    <?php
        return ob_get_clean();
    }
}

?>