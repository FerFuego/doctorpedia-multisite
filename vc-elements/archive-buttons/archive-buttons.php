<?php
/* Element Description: VC archiveButtons*/
 
// Element Class 
class vcarchiveButtons extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_archiveButtons_mapping' ) );
        add_shortcode( 'vc_archiveButtons', array( $this, 'vc_archiveButtons_html' ) );
    }
     
    // Element Mapping
    public function vc_archiveButtons_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Archive Buttons', 'text-domain'),
                'base' => 'vc_archiveButtons',
                'description' => __('Section Archive Buttons', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'textarea',
                        'holder' => 'div',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'text',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'group' => 'General',
                    ),
                )
            )
        );
    }
     
     
    // Element HTML
    public function vc_archiveButtons_html( $atts ) {

         // Params extraction
         extract(
            shortcode_atts(
                array(
                    'text'   => '',
                ), 
                $atts
            )
        );
                
        return $this->BlockHTML($text);
    } 

    public function BlockHTML($text){ 

        function getPosts(){
    
            return $postType = ['apps','books','non-profits','products','websites'];
            
        }

        ob_start(); ?>

        <!-- Simple Archive Buttons Module VC -->

            <div class="vs-archives-global-resources">

                <h2 class="title"><?php echo $text; ?></h2>

                <div>

                    <?php foreach( getPosts() as $post ): ?>

                        <a href="/<?php echo $post; ?>" class="btn btn-primary"><?php echo ucfirst($post); ?></a>

                    <?php endforeach; ?>

                </div>

            </div>
            
        <!-- End Simple Archive Buttons Module VC -->

    <?php 
        return ob_get_clean();

    }
     
} // End Element Class
 
// Element Class Init
new vcarchiveButtons();

?>