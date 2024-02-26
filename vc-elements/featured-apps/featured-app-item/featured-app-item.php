<?php
/* Element Description: VC Featured Apps Item*/
 
// Element Class 
class vcFeaturedAppsItem extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_featuredAppsItem_mapping' ) );
        }
        add_shortcode( 'vc_featuredAppsItem', array( $this, 'vc_featuredAppsItem_html' ) );
    }

    public function getCategory(){
        $categ = array();
        $categories = get_terms('user-reviews-category', array('hide_empty' => false)); 
        $categ[] = __('');
        foreach ( $categories as $category ) {
            $categ[] = __($category->slug);
        }

        return $categ;
    }
     
    // Element Mapping
    public function vc_featuredAppsItem_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Featured App Item', 'text-domain'),
                'base' => 'vc_featuredAppsItem',
                'description' => __('Featured App Item Module', 'text-domain'),
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Select App', 'text-domain' ),
                        'param_name' => 'app',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => $this->getCategory(),
                    ),

                )
            )
        );
    }
     
    // Element HTML
    public function vc_featuredAppsItem_html( $atts ) {
        
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
        
        return $this->BlockHTML( $app );
    } 

    public function BlockHTML( $app ) { 
        
        ob_start(); 

        $cat = get_term_by( 'slug', $app , 'user-reviews-category' );

        $image = get_field('image', $cat->taxonomy . '_' . $cat->term_id);

        $app_link = get_field('app_link', $cat->taxonomy . '_' . $cat->term_id);

        $app_android = get_field('app_android', $cat->taxonomy . '_' . $cat->term_id);

        $download_app = get_field('download_app_link', $cat->taxonomy . '_' . $cat->term_id);
        
        $ratings = calcGralRating( $cat->term_id ); // Return Prom Ratings
        
        $overall = $ratings['rating']; ?>
        
        <div class="app-post-preview featured-app-item">

            <div class="img-app line-border" style="background-image: url(<?php echo $image; ?>);"></div>

            <div class="content">

                <a href="<?php echo get_category_link( $cat ); ?>">
                
                    <h2><?php echo $cat->name; ?></h2>
                
                </a>

                <div class="featured-app-item__stars d-flex">

                    <div class="star-module d-flex flex-row justify-content-center">

                        <span><?php echo number_format( $overall, 1, '.', ',' ); ?> </span>

                        <?php for ($i=1; $i < 6; $i++) { 

                            if($i <= $overall){

                                echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg" alt="Star">';
                                
                            }else{

                                echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg" alt="Star">';

                            }

                        } ?>

                    </div>

                    <div class="score">( <?php echo $cat->count; ?> Reviews )</div>
                
                </div>

                <div class="app-description mt-3">                    
                    
                    <?php echo cadena::corta( strip_tags( $cat->description ), 160 ); ?>

                </div>

            </div>
            
            <div class="footer external-link">
            
                <?php if( $app_link ): ?>

                    <a href="<?php echo $app_link; ?>">Overview</a>

                <?php endif; ?>

                <?php if ( $download_app ) : ?>

                    <a href="<?php echo $download_app['url']; ?>" target="<?php echo $download_app['target']; ?>"><?php echo $download_app['title']; ?></a>

                <?php else : ?>

                    <a href="<?php echo $app_android; ?>" target="_blank">Download App</a>

                <?php endif; ?>


            </div>

        </div>

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcFeaturedAppsItem();

?>