<?php
/* Element Description: VC featuredFaqs*/
 
// Element Class 
class vcfeaturedFaqs extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_featuredFaqs_mapping' ) );
        add_shortcode( 'vc_featuredFaqs', array( $this, 'vc_featuredFaqs_html' ) );
    }
     
    // Element Mapping
    public function vc_featuredFaqs_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Featured FAQs', 'text-domain'),
                'base' => 'vc_featuredFaqs',
                'description' => __('Doctor Profile Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',            
                'params' => array(   
                    array(
                        'type' => 'textfield',
                        'holder' => 'span',
                        'class' => 'title-class',
                        'heading' => __( 'FAQ 1', 'text-domain' ),
                        'param_name' => 'faq1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'span',
                        'class' => 'title-class',
                        'heading' => __( 'FAQ 2', 'text-domain' ),
                        'param_name' => 'faq2',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'span',
                        'class' => 'title-class',
                        'heading' => __( 'FAQ 3', 'text-domain' ),
                        'param_name' => 'faq3',
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
    public function vc_featuredFaqs_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);
         // Params extraction

        extract(
            shortcode_atts(
                array(
                    'faq1'   => '',
                    'faq2'   => '',
                    'faq3'   => '',
                    'description' => ''
                ), 
                $atts
            )
        );

        $rand = rand(99,9999);
                
        return $this->BlockHTML($rand, $faq1, $faq2, $faq3, $description);
    }

    public function BlockHTML($rand, $faq1, $faq2, $faq3, $description){ 
        ob_start(); ?>
        <!-- Faqs Module VC -->
        <div class="container">
            <div class="faqs">
                <h1>Frequently Asked Questions</h1>
                <p><?php echo $description ?></p>   
                <div class="faqs-container faq-slider-<?php echo $rand ?>">
                    <a class="faq" href="<?php echo esc_url( home_url('/')) ?>faqs">
                        <div>
                            <span>“<?php echo $faq1 ?>”</span>
                            <div class="arrow"></div>
                        </div>
                    </a>
                    <a class="faq baby-blue" href="<?php echo esc_url( home_url('/'))?>faqs">
                        <div>
                            <span>“<?php echo $faq2 ?>”</span>
                            <div class="arrow"></div>
                        </div>
                    </a>
                    <a class="faq primary-grey"href="<?php echo esc_url( home_url('/'))?>faqs">
                        <div>
                            <span>“<?php echo $faq3 ?>”</span>
                            <div class="arrow"></div>
                        </div>
                    </a>
                </div> 
                <div>
                    <a href="<?php echo esc_url( home_url('/'))?>faqs" class="view-all">View All FAQs</a>
                </div>
            </div>
            <hr />
        </div>
        <script>
            $(document).ready(function() {
                $(".faq-slider-<?php echo $rand ?>").slick({
                    infinite: true,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    prevArrow: $(".prev"),
                    nextArrow: $(".next"),
                    dots: true,
                    responsive: [
                        {
                        breakpoint: 1930,
                        settings: "unslick",
                        dots: false,
                        },
                        {
                        breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                })
            });
            $(window).on("resize", function() {
                $(".faq-slider-<?php echo $rand ?>").not(".slick-initialized").slick("resize");
            });
        </script>
        <!-- End Faqs Module VC -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcfeaturedFaqs();

?>