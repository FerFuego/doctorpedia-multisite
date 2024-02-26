<?php
/* Element Description: VC Featured Apps Item Manual*/
 
// Element Class 
class vcFeaturedAppsItemManual extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_featuredAppsItemManual_mapping' ) );
        add_shortcode( 'vc_featuredAppsItemManual', array( $this, 'vc_featuredAppsItemManual_html' ) );
    }
    
    // Element Mapping
    public function vc_featuredAppsItemManual_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Featured App Item (Manual)', 'text-domain'),
                'base' => 'vc_featuredAppsItemManual',
                'description' => __('Featured App Item Module (Manual)', 'text-domain'),
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'title',
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
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Overall', 'text-domain' ),
                        'param_name' => 'overall',
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
                            __('5','5')
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        'class' => 'title-class',
                        'heading' => __( 'Overall (only number Ex: 4.7)', 'text-domain' ),
                        'param_name' => 'overall_num',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'class' => 'title-class',
                        'heading' => __( 'Reviews (only number)', 'text-domain' ),
                        'param_name' => 'reviews',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Description', 'text-domain' ),
                        'param_name' => 'description',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link Overview', 'text-domain' ),
                        'param_name' => 'link_overview',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link External', 'text-domain' ),
                        'param_name' => 'link_external',
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
    public function vc_featuredAppsItemManual_html( $atts ) {
        
        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title' => '',
                    'image' => '',
                    'link_overview' => '',
                    'link_external' => '',
                    'overall' => '',
                    'overall_num' => '',
                    'reviews' => '',
                    'description' => ''
                ), 
                $atts
            )
        );

        $link_overview = explode('|', $link_overview);

        $link_external = explode('|', $link_external);

        $image = wp_get_attachment_image_src($image, 'medium');
        
        return $this->BlockHTML( $title, $image, $link_overview, $link_external, $overall, $overall_num, $reviews, $description );
    } 

    public function BlockHTML( $title, $image, $link_overview, $link_external, $overall, $overall_num, $reviews, $description ) { 
        
        ob_start(); ?>
        
        <div class="app-post-preview featured-app-item">

            <div class="img-app line-border" style="background-image: url(<?php echo $image[0]; ?>);"></div>

            <div class="content">
                
                <?php if ( $title ) : ?>
                        
                    <h2><?php echo $title; ?></h2>

                <?php endif;?>

                <div class="featured-app-item__stars d-flex">

                    <div class="star-module d-flex flex-row justify-content-center">

                        <span><?php echo $overall_num; ?> </span>

                        <?php $num = explode('.', $overall);?>

                        <?php $control = intval ( $num[1] == 5 ) ? $num[0] + 1 : 0; ?>

                        <?php for ($i=1; $i < 6; $i++) : ?>

                            <?php if ($i <= $overall) : ?>

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

                    <div class="score">( <?php echo ( $reviews ) ? $reviews : '0'; ?> Reviews )</div>
                
                </div>

                <div class="app-description mt-3">

                    <?php echo cadena::corta( strip_tags( $description ), 160 ); ?>

                </div>

            </div>
            
            <div class="footer external-link">
            
                <?php if( $link_overview[0] ): ?>

                    <a href="<?php echo urldecode(str_replace('url:','', $link_overview[0])) ?>" target="<?php echo ( $link_overview[0] ) ? urldecode(str_replace('target:','', $link_overview[2])) : ''; ?>"><?php echo urldecode(str_replace('title:','', $link_overview[1])) ?></a>

                <?php endif; ?>

                <?php if( $link_external[0] ): ?>

                    <a href="<?php echo urldecode(str_replace('url:','', $link_external[0])) ?>" target="<?php echo ( $link_external[0] ) ? urldecode(str_replace('target:','', $link_external[2])) : ''; ?>"><?php echo urldecode(str_replace('title:','', $link_external[1])) ?></a>

                <?php endif; ?>


            </div>

        </div>

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcFeaturedAppsItemManual();

?>