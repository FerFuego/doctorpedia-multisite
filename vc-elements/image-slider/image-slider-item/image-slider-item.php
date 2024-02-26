<?php
/* Element Description: VC Slider Sites Item*/
 
// Element Class 
class vcImageSliderItem extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_imageSliderItem_mapping' ) );
        add_shortcode( 'vc_imageSliderItem', array( $this, 'vc_imageSliderItem_html' ) );
    }
     
    // Element Mapping
    public function vc_imageSliderItem_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Image Slider Item', 'text-domain'),
                'base' => 'vc_imageSliderItem',
                'description' => __('Image Slider Module', 'text-domain'),
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
                        'group' => 'General',
                    ),
                )
            )
        );
    }
     
    // Element HTML
    public function vc_imageSliderItem_html( $atts ) {
        
        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'link' => '',
                    'image' => '',
                ), 
                $atts
            )
        );   

        $image = wp_get_attachment_image_src($image, 'medium');
        
        return $this->BlockHTML($link, $image);
    } 

    public function BlockHTML($link, $image){ 
        $link = explode('|', $link);
        
        ob_start(); ?>
        
        <div class="image-slider__slider-main">

            <?php if($link[0]) : ?>
                <a class="image-slider__link" href="<?php echo urldecode(str_replace('url:','', $link[0])); ?>" target="<?php echo urldecode(str_replace('target:','', $link[2])); ?>">
            <?php endif; ?>
    
                <div class="image-slider__slider-item">
    
                    <div class="image-slider__img" style="background-image:url(<?php echo $image[0]; ?>);"></div>
    
                    <div class="image-slider__item-content">
                        <h2 class="image-slider__title"><?php echo urldecode(str_replace('title:','', $link[1])); ?></h2>
                    </div>
    
                </div>
            <?php if($link[0]) : ?>
                </a>
            <?php endif; ?>

        </div>

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcImageSliderItem();

?>