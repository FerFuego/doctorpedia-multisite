<?php
/* Element Description: VC newsletter*/
 
// Element Class 
class vcnewsletter extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_newsletter_mapping' ) );
        add_shortcode( 'vc_newsletter', array( $this, 'vc_newsletter_html' ) );
    }
     
    // Element Mapping
    public function vc_newsletter_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Newsletter', 'text-domain'),
                'base' => 'vc_newsletter',
                'description' => __('Doctor Profile Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',            
                'params' => array(   
                    array(
                        'type' => 'textfield',
                        'holder' => 'span',
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
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_newsletter_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);
         // Params extraction

        extract(
            shortcode_atts(
                array(
                    'title'   => '',
                    'description'   => '',
                ), 
                $atts
            )
        );
        
        return $this->BlockHTML($title, $description);
    } 

    public function BlockHTML($title, $description){ 
        ob_start(); ?>
        <!-- Newsletter Module VC -->
        <div class="container">
            <div class="newsletter">
                <div>
                    <img src="<?php echo IMAGES ?>/hand-illustration.svg" alt="">
                </div>
                <div class="text-container">
                    <h1><?php echo $title ?></h1>
                    <p><?php echo $description ?></p>
                    <div class="input-container">
                        <!-- Begin Mailchimp Signup Form-->
                        <div id="mc_embed_signup">
                            <form action="https://doctorpedia.us20.list-manage.com/subscribe/post?u=f85fcca7f131032b9d3ae6e08&amp;id=bfb910e08a" method="post" class="validate" target="_blank" name="newsletter" novalidate>
                                <input type="email" value="" name="EMAIL" class="email" id="mce_EMAIL" placeholder="Email Address" required>
                                <input type="hidden" name="b_f85fcca7f131032b9d3ae6e08_bfb910e08a" tabindex="-1" value="">
                                <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn button" onclick="ValidateEmail(document.newsletter.EMAIL)">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo esc_url( home_url('/') ); ?>wp-content/themes/doctorpedia/vc-elements/newsletter/newsletter.js"></script>
        <!-- End Newsletter Module -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcnewsletter();

?>