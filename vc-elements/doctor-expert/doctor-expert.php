<?php
/* Element Description: VC DoctorExpert*/
 
// Element Class 
class vcDoctorExpert extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_doctorExpert_mapping' ) );
        add_shortcode( 'vc_doctorExpert', array( $this, 'vc_doctorExpert_html' ) );
    }
     
    // Element Mapping
    public function vc_doctorExpert_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Doctor Expert', 'text-domain'),
                'base' => 'vc_doctorExpert',
                'description' => __('Doctor Expert Module', 'text-domain'), 
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
                        'heading' => __( 'Title Section', 'text-domain' ),
                        'param_name' => 'title_section',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
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
                        'class' => 'title-class',
                        'heading' => __( 'Main Article URL', 'text-domain' ),
                        'param_name' => 'main_article',
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
                        'heading' => __( 'Post Image', 'text-domain' ),
                        'param_name' => 'post_image_1',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'title_1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h4',
                        'class' => 'title-class',
                        'heading' => __( 'SubTitle', 'text-domain' ),
                        'param_name' => 'subtitle_1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link Post', 'text-domain' ),
                        'param_name' => 'link_1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Post Image', 'text-domain' ),
                        'param_name' => 'post_image_2',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'title_2',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h4',
                        'class' => 'title-class',
                        'heading' => __( 'SubTitle', 'text-domain' ),
                        'param_name' => 'subtitle_2',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link Post', 'text-domain' ),
                        'param_name' => 'link_2',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Post Image', 'text-domain' ),
                        'param_name' => 'post_image_3',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'title_3',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h4',
                        'class' => 'title-class',
                        'heading' => __( 'SubTitle', 'text-domain' ),
                        'param_name' => 'subtitle_3',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link Post', 'text-domain' ),
                        'param_name' => 'link_3',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_doctorExpert_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);
         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title_section' => '',
                    'name'   => '',
                    'title'   => '',
                    'text' => '',
                    'selfie'   => '',
                    'link_1' => '',
                    'link_2' => '',
                    'link_3' => '',
                    'title_1' => '',
                    'title_2' => '',
                    'title_3' => '',
                    'subtitle_1' => '',
                    'subtitle_2' => '',
                    'subtitle_3' => '',
                    'post_image_1' => '',
                    'post_image_2' => '',
                    'post_image_3' => '',
                    'main_article' => ''
                ), 
                $atts
            )
        );

        $selfie = wp_get_attachment_image_src($selfie, 'medium');
        $post_image_1 = wp_get_attachment_image_src($post_image_1, 'medium');
        $post_image_2 = wp_get_attachment_image_src($post_image_2, 'medium');
        $post_image_3 = wp_get_attachment_image_src($post_image_3, 'medium');
                
        return $this->BlockHTML($selfie, $title_section, $post_image_1, $post_image_2, $post_image_3, $main_article, $name, $title, $text, $link_1, $link_2, $link_3, $title_1, $title_2, $title_3, $subtitle_1, $subtitle_2, $subtitle_3);
    }

    public function BlockHTML($selfie, $title_section, $post_image_1, $post_image_2, $post_image_3, $main_article, $name, $title, $text, $link_1, $link_2, $link_3, $title_1, $title_2, $title_3, $subtitle_1, $subtitle_2, $subtitle_3){ 
        ob_start(); ?>
        <!-- Doctor Expert Module VC -->
        <div class="container doctor-expert">
            <h1 class="blog-title"><?php echo $title_section ?></h1>
            <div class="row">
                <div class="col-xs-12 col-md-6 doctor-expert-content">
                    <a href="<?php echo $main_article ?>">
                        <div class="doctor-expert-profile">
                            <div><img src="<?php echo $selfie[0] ?>"></div>
                            <div><h4><?php echo $name ?></h4></div>
                        </div>
                        <h2><?php echo $title ?></h2>
                        <p class="styles-none"><?php echo $text ?></p>
                    </a>
                </div>
                <div class="col-xs-12 col-md-6 doctor-expert-content-posts">
                    <div class="doctor-box-post">
                        <?php $a = explode('|', $link_1); ?>
                        <a href="<?php echo urldecode(str_replace('url:','', $a[0])) ?>">
                            <div><img src="<?php echo $post_image_1[0] ?>"></div>
                            <div>
                                <h4><?php echo $subtitle_1 ?></h4>
                                <h3><?php echo $title_1 ?></h3>
                            </div>
                        </a>
                    </div>
                    <div class="doctor-box-post">
                        <?php $a = explode('|', $link_2); ?>
                        <a href="<?php echo urldecode(str_replace('url:','', $a[0])) ?>">
                            <div><img src="<?php echo $post_image_2[0] ?>"></div>
                            <div>
                                <h4><?php echo $subtitle_2 ?></h4>
                                <h3><?php echo $title_2 ?></h3>
                            </div>
                        </a>
                    </div>
                    <div class="doctor-box-post">
                        <?php $a = explode('|', $link_3); ?>
                        <a href="<?php echo urldecode(str_replace('url:','', $a[0])) ?>">
                            <div><img src="<?php echo $post_image_3[0] ?>"></div>
                            <div>
                                <h4><?php echo $subtitle_3 ?></h4>
                                <h3><?php echo $title_3 ?></h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Doctor Expert Module VC -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcDoctorExpert();

?>