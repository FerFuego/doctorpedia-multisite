<?php
/* Element Description: VC FeaturedArticleChannel*/
 
// Element Class 
class vcFeaturedArticleChannel extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_featuredArticleChannel_mapping' ) );
        }
        add_shortcode( 'vc_featuredArticleChannel', array( $this, 'vc_featuredArticleChannel_html' ) );
    }

    public function getHighArticles(){

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
     
    // Element Mapping
    public function vc_featuredArticleChannel_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Header Channel', 'text-domain'),
                'base' => 'vc_featuredArticleChannel',
                'description' => __('Header Channel Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',     
                'params' => array(  
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'title',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Orientation', 'text-domain' ),
                        'param_name' => 'orientation',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => array(
                            __('Please select a way of viewing the element'),
                            __('Left'),
                            __('Right'),
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Select Article', 'text-domain' ),
                        'param_name' => 'post1',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Big Article',
                        'value' => $this->getHighArticles(),
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => 'p',
                        'class' => 'text-class',
                        'heading' => __( 'Text', 'text-domain' ),
                        'param_name' => 'big_text',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Big Article',
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Select Article', 'text-domain' ),
                        'param_name' => 'post2',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Small Article 1',
                        'value' => $this->getHighArticles(),
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Select Article', 'text-domain' ),
                        'param_name' => 'post3',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Small Article 2',
                        'value' => $this->getHighArticles(),
                    ),
                )
            )
        );                           
        
    }
     
    // Element HTML
    public function vc_featuredArticleChannel_html( $atts ) {

         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'  => '',
                    'orientation' => '',
                    'post1' => '',
                    'big_text' => '',
                    'post2' => '',
                    'post3' => ''
                ), 
                $atts
            ) 
        );

        $post1 = get_post( $post1 );
        $post2 = get_post( $post2 );
        $post3 = get_post( $post3 );
        
        return $this->BlockHTML($title, $orientation, $post1 ,$big_text, $post2, $post3);
             
    } 
    
    public function BlockHTML($title, $orientation, $post1 ,$big_text, $post2, $post3){ 
        ob_start(); ?>

        <!-- Header Channels Module VC -->
        <div class="featured-article-channel-container">
            
            <?php if ( $title ) : ?>

                <div class="featured-article-channel-header container">
                    <h1><?php echo $title; ?></h1>
                </div>

            <?php endif; ?>

            <div class="featured-article-channel-body container d-flex <?php echo ( $orientation == 'Right' ) ? 'flex-row-reverse' : ''; ?>">

                <div class="featured-article-channel-body__big-picture">
                    <div class="featured-article-channel-body__big-picture__box" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post1->ID, 'large'); ?>)">
                        <a href="<?php echo get_post_permalink( $post1->ID ); ?>">
                            <div class="big_shadow"></div>
                            <div class="content">
                                <h2><?php echo $post1->post_title; ?></h2>
                                <?php if ( $big_text ) : ?> <p><?php echo $big_text; ?></p> <?php endif; ?>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="featured-article-channel-body__column">

                    <div class="featured-article-channel-body__column__box" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post2->ID, 'large'); ?>)">
                        <a href="<?php echo get_post_permalink( $post2->ID ); ?>">
                            <div class="big_shadow"></div>
                            <div class="content">
                                <h2><?php echo $post2->post_title; ?></h2>
                            </div>
                        </a>
                    </div>

                    <div class="featured-article-channel-body__column__box" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post3->ID, 'large'); ?>)">
                        <a href="<?php echo get_post_permalink( $post3->ID ); ?>">
                            <div class="big_shadow"></div>
                            <div class="content">
                                <h2><?php echo $post3->post_title; ?></h2>
                            </div>
                        </a>
                    </div>

                </div>

            </div>

        </div>
        <!-- Header Channels Module VC -->

    <?php 
        return ob_get_clean(); 
    }
     
} // End Element Class
 
// Element Class Init
new vcFeaturedArticleChannel();

?>