<?php
/* Element Description: VC Featured Apps Item*/
 
// Element Class 
class vcSingleArticle extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_singleArticle_mapping' ) );
        }
        add_shortcode( 'vc_singleArticle', array( $this, 'vc_singleArticle_html' ) );
    }

    public function getHighArticles(){

        global $wpdb;
        global $post;
        
        $posts[] = __('');

        $args = array(
            'post_type' => 'categories',
            'status' => 'publish'
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
    public function vc_singleArticle_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Article Channels Item', 'text-domain'),
                'base' => 'vc_singleArticle',
                'description' => __('Single Article Channels Module', 'text-domain'),
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Select Article', 'text-domain' ),
                        'param_name' => 'app',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => $this->getHighArticles(),
                    ),

                )
            )
        );
    }
     
    // Element HTML
    public function vc_singleArticle_html( $atts ) {
        
        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'app' => '',
                ), 
                $atts
            )
        );

        $app = explode('|', $app)[0];

        $post = get_post( $app );
        
        return $this->BlockHTML( $post );
    } 

    public function BlockHTML( $post ) { 
        
        ob_start(); ?>

        <?php $categories = wp_get_post_terms( $post->ID, 'categories-category' );?>
                                        
        <div class="blog-post-preview" data-slug="<?php echo get_post_permalink( $post->ID ); ?>">
        
            <a href="<?php echo get_post_permalink( $post->ID ); ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post->ID, 'large'); ?>)" class="trim"></a>
        
            <div class="content">
        
                <a href="<?php echo get_post_permalink( $post->ID ); ?>">
        
                    <h3><?php echo $categories[0]->name; ?></h3>
        
                    <h2 class="pb-25"><?php echo $post->post_title; ?></h2>
        
                </a>

                <?php if ( get_post_meta( $post->ID, 'short_description', true) ) : ?>
                
                    <p><?php echo get_post_meta( $post->ID, 'short_description', true); ?></p>

                <?php endif; ?>

        
            </div>
        
        </div>

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcSingleArticle();

?>