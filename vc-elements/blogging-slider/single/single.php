<?php
/* Element Description: VC Slider Sites Item*/
 
// Element Class 
class vcSingleBlogging extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_singleBlogging_mapping' ) );
        add_shortcode( 'vc_singleBlogging', array( $this, 'vc_singleBlogging_html' ) );
    }
     
    // Element Mapping
    public function vc_singleBlogging_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Blogging Slider - Article', 'text-domain'),
                'base' => 'vc_singleBlogging',
                'description' => __('Doctor Point Module', 'text-domain'),
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
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'SubTitle', 'text-domain' ),
                        'param_name' => 'subtitle',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
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
                    )
                )
            )
        );
    }
     
    // Element HTML
    public function vc_singleBlogging_html( $atts ) {
        
        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'     => '',
                    'subtitle'  => '',
                    'image'     => '',
                    'link'      => '',
                ), 
                $atts
            )
        );   

        $link = explode('|', $link);

        $image = wp_get_attachment_image_src($image, 'full');

        return $this->BlockHTML( $title, $subtitle, $image, $link );

    }

    public function BlockHTML( $title, $subtitle, $image, $link ) { 
        
        ob_start(); ?>

        <div class="single-blogging-item-container">

            <?php if ( $link ) : ?>

                <a href="<?php echo urldecode(str_replace('url:','', $link[0])) ?>" target="<?php echo urldecode(str_replace('target:','', $link[1])) ?>">

            <?php endif; ?>

                    <div class="single-blogging-item-img" style="background-image:url(<?php echo $image[0]; ?>)">

                        <div class="cat-shadow"></div>
                        
                    </div>

                    <div class="single-blogging-item-text content">

                        <!-- Author -->
                        <div class="content-author-container">
                            
                            <?php echo get_avatar(get_the_author_meta('email'), '66') ?>

                            <div class="content-author-text">
                            
                                <h4 class="content-author-title"><?php echo get_the_author(); ?></h4>
                                <h5 class="content-author-date"><?php  the_time('F j, Y'); ?></h5>

                            </div>

                        </div>
        
                        <h3><?php echo $title; ?></h3>

                        <p><?php echo $subtitle ?></p>                        
        
                    </div>

            <?php if ( $link ) : ?> </a> <?php endif; ?>

        </div>

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcSingleBlogging();

?>