<?php
/* Element Description: VC Featured Apps Item*/
 
// Element Class 
class vcSingleNewsArticlesGrid extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_singleNewsArticles_mapping' ) );
        }
        add_shortcode( 'vc_singleNewsArticles', array( $this, 'vc_singleNewsArticles_html' ) );
    }

    public function getHighArticles(){

        global $wpdb;
        global $post;
        
        $posts[] = __('');

        $args = array(
            'post_type' => 'categories',
            'status' => 'publish',
            'nopaging' => true,
            'posts_per_page' => -1
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
    public function vc_singleNewsArticles_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Channels News Item', 'text-domain'),
                'base' => 'vc_singleNewsArticles',
                'description' => __('Single News Module', 'text-domain'),
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
                    )
                )
            )
        );
    }
     
    // Element HTML
    public function vc_singleNewsArticles_html( $atts ) {
        
        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'app' => ''
                ), 
                $atts
            )
        );

        $app = explode('|', $app)[0];

        $post_item = get_post( $app );
        
        return $this->BlockHTML( $post_item );
    } 

    public function BlockHTML( $post_item ) { 
        
        ob_start(); 
        
        $post_item_link = get_post_permalink( $post_item->ID );
        $post_item_description = get_post_meta( $post_item->ID, 'short_description', true);
        $categories = wp_get_post_terms( $post_item->ID, 'categories-category' ); ?>
                                        
        <div class="blog-post-preview-news" data-slug="<?php echo $post_item_link; ?>">
        
            <a href="<?php echo $post_item_link; ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post_item->ID, 'large'); ?>)" class="trim"></a>
        
            <div class="content">
        
                <a href="<?php echo $post_item_link; ?>">
                    <h2 style="-webkit-box-orient: vertical;"><?php echo $post_item->post_title; ?></h2>
                </a>

                <?php if ( $post_item_description ) : ?>
                    <p><?php echo $post_item_description; ?></p>
                <?php endif; ?>

            </div>
        
        </div>

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcSingleNewsArticlesGrid();

?>