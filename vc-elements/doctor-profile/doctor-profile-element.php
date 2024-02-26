<?php
/* Element Description: VC DoctorProfile*/
 
// Element Class 
class vcDoctorProfile extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_doctorProfile_mapping' ) );
        add_shortcode( 'vc_doctorProfile', array( $this, 'vc_doctorProfile_html' ) );
    }
     
    // Element Mapping
    public function vc_doctorProfile_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Doctor Profile', 'text-domain'),
                'base' => 'vc_doctorProfile',
                'description' => __('Doctor Profile Module', 'text-domain'), 
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
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Name', 'text-domain' ),
                        'param_name' => 'name',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),

                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
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
                        'type' => 'textarea',
                        'holder' => 'div',
                        'class' => 'text-class',
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
                        'holder' => 'a',
                        'class' => 'title-class',
                        'heading' => __( 'Link_Bio', 'text-domain' ),
                        'param_name' => 'link_bio',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'a',
                        'class' => 'title-class',
                        'heading' => __( 'Link_Video', 'text-domain' ),
                        'param_name' => 'link_video',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'a',
                        'class' => 'title-class',
                        'heading' => __( 'Link Facebook', 'text-domain' ),
                        'param_name' => 'link_facebook',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Additional',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'a',
                        'class' => 'title-class',
                        'heading' => __( 'Link Twitter', 'text-domain' ),
                        'param_name' => 'link_twitter',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Additional',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'a',
                        'class' => 'title-class',
                        'heading' => __( 'Link Linkedin', 'text-domain' ),
                        'param_name' => 'link_linkedin',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Additional',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'a',
                        'class' => 'title-class',
                        'heading' => __( 'Link Email', 'text-domain' ),
                        'param_name' => 'link_email',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Additional',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'a',
                        'class' => 'title-class',
                        'heading' => __( 'Link Website', 'text-domain' ),
                        'param_name' => 'link_website',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Additional',
                    ),
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_doctorProfile_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);
         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'name'   => '',
                    'title'   => '',
                    'text' => '',
                    'link_bio'   => '',
                    'link_video'   => '',
                    'selfie'   => '',
                    'link_facebook' => '',
                    'link_twitter' => '',
                    'link_linkedin' => '',
                    'link_email' => '',
                    'link_website' => ''
                ), 
                $atts
            )
        );

        $selfie = wp_get_attachment_image_src($selfie, 'medium');
        
        return $this->BlockHTML($selfie, $name, $title, $text, $link_bio, $link_video, $link_facebook, $link_twitter, $link_linkedin, $link_email, $link_website);
         
    } 

    public function BlockHTML($selfie, $name, $title, $text, $link_bio, $link_video, $link_facebook, $link_twitter, $link_linkedin, $link_email, $link_website) { 
        ob_start(); ?>
        <!-- Doctor Profile Module VC -->
        <div class="doctor-profile-container">
             <div class="container doctor-grey-mobile">
                 <div class="doctor-profile">
                     <div class="selfie">
                         <img src="<?php echo $selfie[0] ?>" alt="Doctor Profile">
                         <div class="networks">
                            <ul>
                                <?php if(!empty($link_website)):  ?> <li><a href="<?php echo $link_website ?>" target="_blank"><img src="<?php echo IMAGES ?>/icons/doctor-profile/click.svg"></a></li> <?php endif ?>
                                <?php if(!empty($link_email)):    ?> <li><a href="mailto:<?php echo $link_email ?>" target="_blank"><img src="<?php echo IMAGES ?>/icons/doctor-profile/mail.svg"></a></li> <?php endif ?>
                                <?php if(!empty($link_facebook)): ?> <li><a href="<?php echo $link_facebook ?>" target="_blank"><img src="<?php echo IMAGES ?>/icons/doctor-profile/facebook.svg"></a></li> <?php endif ?>
                                <?php if(!empty($link_linkedin)): ?> <li><a href="<?php echo $link_linkedin ?>" target="_blank"><img src="<?php echo IMAGES ?>/icons/doctor-profile/linkedin.svg"></a></li> <?php endif ?>
                                <?php if(!empty($link_twitter)):  ?> <li><a href="<?php echo $link_twitter ?>" target="_blank"><img src="<?php echo IMAGES ?>/icons/doctor-profile/twitter.svg"></a></li> <?php endif ?>
                            </ul>
                         </div>
                     </div>
                     <div class="dc-details">
                        <h1><?php echo $name ?></h1>
                        <h2><?php echo $title ?></h2>
                        <p><?php echo $text ?></p>
                        <div class="call-to-action">
                            <?php if(!empty($link_bio)): ?> <a href="<?php echo $link_bio ?>">View Full Bio</a> <?php endif ?>
                            <?php if(!empty($link_video)): ?> <a href="<?php echo $link_video ?>">View All Videos</a><?php endif ?>
                        </div>
                     </div>
                 </div>
             </div>
         </div>
        <!-- End Doctor Profile Module VC -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcDoctorProfile();

?>