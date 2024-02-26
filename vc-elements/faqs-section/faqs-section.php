<?php
/* Element Description: VC FaqsSection*/
 
// Element Class 
class vcFaqsSection extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_faqsSection_mapping' ) );
        }
        add_shortcode( 'vc_faqsSection', array( $this, 'vc_faqsSection_html' ) );
    }

    function getTaxonomy(){
        $tax = array();
        $taxonomies = get_tags();
        $tax[] = __('');
        $tax[] = __('All');
        foreach ( $taxonomies as $taxonomy){
            $tax[] = __($taxonomy->name);
        }

        return $tax;
    }
     
    // Element Mapping
    public function vc_faqsSection_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Faqs Section', 'text-domain'),
                'base' => 'vc_faqsSection',
                'description' => __('Faqs Section Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
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
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Tag Post', 'text-domain' ),
                        'param_name' => 'taxonomy',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => $this->getTaxonomy(),
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Show Post', 'text-domain' ),
                        'param_name' => 'num_post',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => array(
                            __('',''),
                            __('All','-1'),
                            __('2','2'),
                            __('3','3'),
                            __('4','4'),
                            __('5','5'),
                            __('6','6'),
                            __('7','7'),
                            __('8','8'),
                            __('9','9'),
                            __('10','10'),
                        ),
                    )
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_faqsSection_html( $atts ) {
         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'   => '',
                    'taxonomy' => '',
                    'num_post' => ''
                ), 
                $atts
            )
        );

        if($taxonomy == 'All'){
            $taxonomy = '';
        }

        $loop = new WP_Query( array(
            'post_type' => 'faqs_type',
            'tag' => $taxonomy,
            'posts_per_page' => $num_post
        ));
                
        return $this->BlockHTML($title, $taxonomy, $num_post, $loop);
         
    }

    public function BlockHTML($title, $taxonomy, $num_post, $loop){ 
        ob_start(); ?>
        <!-- Faqs Section Module VC -->
        <div class="container">
            <div class="faqs-section">
                <div class="faqs-navbar">
                    <h2><?php echo $title ?></h2>
                </div>
            
                <?php while ( $loop -> have_posts()) : $loop->the_post(); ?>
                    <div class="question row">
                        <div class="col-lg-4 col-md-12">
                            <h2><?php the_title() ?></h2>
                        </div>
                        <div class="col-lg-8 col-md-12">
                            <p><?php the_content() ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <!-- End Faqs Section Module VC -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcFaqsSection();

?>