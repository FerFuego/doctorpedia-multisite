<?php
/* Element Description: VC BloggingHeader*/
 
// Element Class 
class vcBloggingHeader extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_bloggingHeader_mapping' ) );
        }
        add_shortcode( 'vc_bloggingHeader', array( $this, 'vc_bloggingHeader_html' ) );
    }

    public function getHighArticles(){

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
     
    // Element Mapping
    public function vc_bloggingHeader_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Blogging Header', 'text-domain'),
                'base' => 'vc_bloggingHeader',
                'description' => __('Header Blogging Module', 'text-domain'), 
                'category' => __('DoctorPedia Blogging', 'text-domain'),   
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
    public function vc_bloggingHeader_html( $atts ) {

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

        <!-- Header bloggings Module VC -->
        <div class="blogging-header__channel-container">
            
            <?php if ( $title ) : ?>

               <!--  <div class="blogging-header__channel-header">
                    <div class="blogging-header__channel-header-container container">

                        <h1><?php //echo $title; ?></h1>

                    </div>
                </div> -->

            <?php endif; ?>

            <div class="blogging-header__channel-body container d-flex <?php echo ( $orientation == 'Right' ) ? 'flex-row-reverse' : ''; ?>">

                <div class="blogging-header__channel-body__big-picture">

                    <div class="blogging-header__channel-body__big-picture__box" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post1->ID, 'large'); ?>)">

                        <!-- Hardcoded - Tag -->
                        <h5 class="blogging-header__channel-body__tag">Featured</h5>

                        <!-- Hardcoded - Star -->
                        <div class="blogging-header__channel-body__star"><img src="<?php echo IMAGES; ?>/blogging/blogging-star.svg" alt="Star"></div>

                        <a href="<?php echo get_post_permalink( $post1->ID ); ?>">

                            <div class="big_shadow"></div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Author -->
                                <div class="content-author-container">
                                
                                    <img class="content-author-img rounded-circle" src="<?php echo get_avatar_url($post1->post_author, '32'); ?>" alt="<?php echo get_the_author_meta('display_name', $post1->post_author); ?>">

                                    <div class="content-author-text">
                                    
                                        <h3 class="content-author-title"><?php echo get_the_author_meta('display_name', $post1->post_author); ?></h3>
                                        <h4 class="content-author-date"><?php echo get_the_date('', $post1->ID ); ?></h4>

                                    </div>

                                </div>

                                <h2><?php echo $post1->post_title; ?></h2>
                                
                                <?php if ( $big_text ) : ?> <p><?php echo $big_text; ?></p> <?php endif; ?>

                            </div>

                        </a>

                    </div>

                </div>

                <div class="blogging-header__channel-body__column">

                    <div class="blogging-header__channel-body__column__box" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post2->ID, 'large'); ?>)">
                        
                        <!-- Hardcoded - Tag -->
                        <h5 class="blogging-header__channel-body__tag">Latest</h5>

                        <a href="<?php echo get_post_permalink( $post2->ID ); ?>">

                            <div class="big_shadow"></div>

                            <div class="content">

                                <h2><?php echo $post2->post_title; ?></h2>

                                <!-- Author -->
                                <div class="content-author-container">
                                
                                    <img class="content-author-img rounded-circle" src="<?php echo get_avatar_url($post2->post_author, '32'); ?>" alt="<?php echo get_the_author_meta('display_name', $post2->post_author); ?>">

                                    <div class="content-author-text">
                                    
                                        <h3 class="content-author-title"><?php echo get_the_author_meta('display_name', $post2->post_author); ?></h3>
                                        <p class="content-author-date"><?php echo get_the_date('', $post2->ID ); ?></p>

                                    </div>

                                </div>

                            </div>
                        </a>

                    </div>

                    <div class="blogging-header__channel-body__column__box" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post3->ID, 'large'); ?>)">

                        <!-- Hardcoded - Tag -->
                        <h5 class="blogging-header__channel-body__tag">Featured</h5>

                        <!-- Hardcoded - Star -->
                        <div class="blogging-header__channel-body__star"><img src="<?php echo IMAGES; ?>/blogging/blogging-star.svg" alt="Star"></div>

                        <a href="<?php echo get_post_permalink( $post3->ID ); ?>">

                            <div class="big_shadow"></div>

                            <div class="content">
                                <h2><?php echo $post3->post_title; ?></h2>
                                
                                <!-- Author -->
                                <div class="content-author-container">
                                
                                    <img class="content-author-img rounded-circle" src="<?php echo get_avatar_url($post3->post_author, '32'); ?>" alt="<?php echo get_the_author_meta('display_name', $post3->post_author); ?>">

                                    <div class="content-author-text">
                                    
                                        <h3 class="content-author-title"><?php echo get_the_author_meta('display_name', $post3->post_author); ?></h3>
                                        <p class="content-author-date"><?php echo get_the_date('', $post3->ID ); ?></p>

                                    </div>

                                </div>

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
new vcBloggingHeader();

?>