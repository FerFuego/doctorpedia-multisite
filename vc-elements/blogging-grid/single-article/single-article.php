<?php
/* Element Description: VC Blogging News Item*/
 
// Element Class 
class vcSingleBloggingNewsGrid extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_singleBloggingNews_mapping' ) );
        }
        add_shortcode( 'vc_singleBloggingNews', array( $this, 'vc_singleBloggingNews_html' ) );
    }

    public function getBlogHighArticles(){

        global $wpdb;
        global $post;
        
        $posts[] = __('');

        $args = array(
            'post_type' => 'blog',
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
    public function vc_singleBloggingNews_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Blogging Grid - Article', 'text-domain'),
                'base' => 'vc_singleBloggingNews',
                'description' => __('Single Blogging Module', 'text-domain'),
                'category' => __('DoctorPedia Blogging', 'text-domain'),   
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
                        'value' => $this->getBlogHighArticles(),
                    )
                )
            )
        );
    }
     
    // Element HTML
    public function vc_singleBloggingNews_html( $atts ) {
        
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

        $app = @explode('|', $app)[0];

        $post = get_post( $app );
        
        return $this->BlockHTML( $post );
    } 

    public function BlockHTML( $post ) { 
        
        ob_start(); ?>

        <?php $categories = wp_get_post_terms( $post->ID, 'categories-category' );?>
                                        
        <div class="block__column__box trim" data-slug="<?php echo get_post_permalink( $post->ID ); ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post->ID, 'large'); ?>)">

            <!-- Hardcoded - Tag -->
            <h5 class="blogging-header__channel-body__tag">Featured</h5>
        
            <a href="<?php echo get_post_permalink( $post->ID ); ?>"></a>
        
            <div class="big_shadow"></div>

            <div class="content">
        
                <a href="<?php echo get_post_permalink( $post->ID ); ?>">
        
                    <h2><?php echo $post->post_title; ?></h2>
        
                </a>

                <!-- Author -->
                <div class="content-author-container">
                                
                    <img class="content-author-img rounded-circle" src="<?php echo get_avatar_url($post->post_author, '32'); ?>" alt="<?php the_author_meta('display_name', $post->post_author );?>">

                    <div class="content-author-text">
                    
                        <h3 class="content-author-title"><?php the_author_meta('display_name', $post->post_author );?></h3>

                        <p class="content-author-date"><?php echo get_the_date('', $post->ID ); ?></p>

                    </div>

                </div>

        
            </div>
        
        </div>

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcSingleBloggingNewsGrid();

?>