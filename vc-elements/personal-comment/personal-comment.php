<?php
/* Element Description: VC personalComment*/
 
// Element Class 
class vcpersonalComment extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_personalComment_mapping' ) );
        add_shortcode( 'vc_personalComment', array( $this, 'vc_personalComment_html' ) );
    }
     
    // Element Mapping
    public function vc_personalComment_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('PersonalComment', 'text-domain'),
                'base' => 'vc_personalComment',
                'description' => __('Personal Comment Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',            
                'params' => array( 
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Selfie', 'text-domain' ),
                        'param_name' => 'selfie',
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
                        'type' => 'textfield',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Author Name', 'text-domain' ),
                        'param_name' => 'author_name',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Rating', 'text-domain' ),
                        'param_name' => 'star',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => array(
                            __('None','0'),
                            __('1','1'),
                            __('2','2'),
                            __('3','3'),
                            __('4','4'),
                            __('5','5')
                        ),
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Comment', 'text-domain' ),
                        'param_name' => 'comment',
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
    public function vc_personalComment_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);
         // Params extraction

        extract(
            shortcode_atts(
                array(
                    'selfie'   => '',
                    'author_name'   => '',
                    'comment'   => '',
                    'star'   => '',
                ), 
                $atts
            )
        );

        $selfie = wp_get_attachment_image_src($selfie, 'medium');
        
       return $this->BlockHTML($selfie, $author_name, $comment, $star);         
    } 

    public function BlockHTML($selfie, $author_name, $comment, $star){  
        ob_start(); ?>
        <!-- Personal Comment Module VC -->
        <div class="comment-container container">
            <div class="comment-selfie">
                <img src="<?php echo $selfie[0] ?>" alt="">
            </div>
            <div class="comment-author">
                <h3><?php echo $author_name ?></h3>
                <div class="comment-text"><?php echo $comment ?></div>
                <?php if( $star > 0): ?>
                    <div class="comment-rating">
                        Rating: 
                    </div>
                    <div class="comment-star">
                        <?php for ($i=1; $i < 6; $i++): ?>
                            <?php if($i <= $star): ?>
                                <img src="<?php echo IMAGES ?>/icons/star-type-1-red.svg">
                            <?php else: ?>
                                <img src="<?php echo IMAGES ?>/icons/star-type-1-grey.svg">
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div> 
        </div> 
        <!-- End Personal Comment Module VC -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcpersonalComment();

?>
