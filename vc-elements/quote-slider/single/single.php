<?php
/* Element Description: VC Quote Slider Item*/
 
// Element Class 
class vcSingleQuote extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_singleQuote_mapping' ) );
        add_shortcode( 'vc_singleQuote', array( $this, 'vc_singleQuote_html' ) );
    }
     
    // Element Mapping
    public function vc_singleQuote_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Single Quote Item', 'text-domain'),
                'base' => 'vc_singleQuote',
                'description' => __('Single Quote Item Module', 'text-domain'),
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Text', 'text-domain' ),
                        'param_name' => 'text',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Author Name', 'text-domain' ),
                        'param_name' => 'author',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                )
            )
        );
    }
     
    // Element HTML
    public function vc_singleQuote_html( $atts ) {
        
        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'text' => '',
                    'author' => '',
                ), 
                $atts
            )
        );

        return $this->BlockHTML( $text, $author );

    }

    public function BlockHTML( $text, $author ) { 
        
        ob_start(); ?>

        <div class="quote-slider__content__item">

            <div class="quote-slider__content__item__text">

                <h2><?php echo $text; ?></h2>

                <p><?php echo $author; ?></p>

            </div>

        </div>

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcSingleQuote();

?>