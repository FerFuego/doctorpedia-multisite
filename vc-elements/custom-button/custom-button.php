<?php
/* Element Description: VC CustomButton*/
 
// Element Class 
class vcCustomButton extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_customButton_mapping' ) );
        add_shortcode( 'vc_customButton', array( $this, 'vc_customButton_html' ) );
    }
     
    // Element Mapping
    public function vc_customButton_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Custom Button', 'text-domain'),
                'base' => 'vc_customButton',
                'description' => __('Custom Button Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link', 'text-domain' ),
                        'param_name' => 'link',
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
    public function vc_customButton_html( $atts ) {
        
        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'link' => '',
                ), 
                $atts
            )
        );   
        
        return $this->BlockHTML($link);
    } 

    public function BlockHTML($link){ 

        $link = explode('|', $link);
        
        ob_start(); ?>

        <!-- CustomButton Module VC -->
        <div class="container">

            <div class=" custom-button">
            
                <a href="<?php echo urldecode(str_replace('url:','', $link[0])) ?>" target="<?php echo urldecode(str_replace('target:','', $link[2])) ?>"><?php echo urldecode(str_replace('title:','', $link[1])) ?></a>
                
            </div>

        </div>
        <!-- End CustomButton Module VC -->
        
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcCustomButton();

?>