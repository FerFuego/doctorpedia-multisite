<?php
/* Element Description: VC personalCommentTen*/
 
// Element Class 
class vcpersonalCommentTen extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_personalCommentTen_mapping' ) );
        add_shortcode( 'vc_personalCommentTen', array( $this, 'vc_personalCommentTen_html' ) );
    }
     
    // Element Mapping
    public function vc_personalCommentTen_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('PersonalCommentTen', 'text-domain'),
                'base' => 'vc_personalCommentTen',
                'description' => __('Personal Comment 10 Stars Module', 'text-domain'), 
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
                            __('1.5','1.5'),
                            __('2','2'),
                            __('2.5','2.5'),
                            __('3','3'),
                            __('3.5','3.5'),
                            __('4','4'),
                            __('4.5','4.5'),
                            __('5','5'),
                            __('5.5','5.5'),
                            __('6','6'),
                            __('6.5','6.5'),
                            __('7','7'),
                            __('7.5','7.5'),
                            __('8','8'),
                            __('8.5','8.5'),
                            __('9','9'),
                            __('9.5','9.5'),
                            __('10','10')
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
    public function vc_personalCommentTen_html( $atts ) {

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

        <!-- Personal Comment 10 Module VC -->
        <div class="comment-container container">

            <div class="comment-selfie">

                <img src="<?php echo $selfie[0] ?>" alt="">

            </div>

            <div class="comment-author">
            
                <h3><?php echo $author_name ?></h3>

                <div class="comment-text"><?php echo $comment ?></div>

                <?php if ( $star > 0) : ?>

                    <div class="comment-rating"> Rating: </div>

                    <div class="comment-star">

                        <?php $num = explode('.', $star);?>

                        <?php $control = intval ( $num[1] == 5 ) ? $num[0] + 1 : 0; ?>

                        <?php for ($i=1; $i < 11; $i++) : ?>

                            <?php if ($i <= $star) : ?>

                                <img src="<?php echo IMAGES ?>/icons/star-type-1-red.svg">

                            <?php else: ?>

                                <?php if ( $control == $i ) : ?>

                                    <img src="<?php echo IMAGES ?>/icons/star-type-middle-red.svg">

                                <?php else: ?>

                                    <img src="<?php echo IMAGES ?>/icons/star-type-1-grey.svg">

                                <?php endif; ?>

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
new vcpersonalCommentTen();

?>
