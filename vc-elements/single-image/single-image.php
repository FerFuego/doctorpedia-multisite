<?php
/* Element Description: VC SingleImage*/
 
// Element Class 
class vcSingleImage extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_singleImage_mapping' ) );
        add_shortcode( 'vc_singleImage', array( $this, 'vc_singleImage_html' ) );
    }
     
    // Element Mapping
    public function vc_singleImage_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Single Image', 'text-domain'),
                'base' => 'vc_singleImage',
                'description' => __('Single Image Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',     
                'params' => array(  
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Image', 'text-domain' ),
                        'param_name' => 'image',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Desktop',
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Image Size', 'text-domain' ),
                        'param_name' => 'size',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Desktop',
                        'value' => array(
                            __('full','full'),
                            __('large','large'),
                            __('medium','medium'),
                            __('small','small')
                        ),
                    ),
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Image', 'text-domain' ),
                        'param_name' => 'image_mobile',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Mobile',
                    )
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_singleImage_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);
         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'image'  => '',
                    'size' => 'full',
                    'image_mobile' => ''
                ), 
                $atts
            ) 
        );

        $image = wp_get_attachment_image_src($image, 'full');
        $image_mobile = wp_get_attachment_image_src($image_mobile, 'full');

        if($size == 'large'){
            $width = '1024px';
        }elseif($size == 'medium'){
            $width = '750px';
        }elseif($size == 'small'){
            $width = '250px';
        }else{
            $width = '';
        }

        return $this->BlockHTML($image, $image_mobile, $width);
    } 

    
    public function BlockHTML ($image, $image_mobile, $width) {  ob_start(); ?>

        <!-- Simple Image Module VC -->
        <div class="single-image">

            <?php if ( wp_is_mobile() ) : ?>

                <img src="<?php echo ( $image_mobile[0] ) ? $image_mobile[0] : $image[0]; ?>" class="img-responsive single-image-img">

            <?php else : ?>

                <img src="<?php echo $image[0] ?>" width="<?php echo $width ?>" class="img-responsive single-image-img">

            <?php endif; ?>

        </div>
        <!-- End Simple Image Module VC -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcSingleImage();

?>