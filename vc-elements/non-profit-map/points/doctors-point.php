<?php
/* Element Description: VC Slider Sites Item*/
 
// Element Class 
class vcDoctorPoint extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_doctorPoint_mapping' ) );
        add_shortcode( 'vc_doctorPoint', array( $this, 'vc_doctorPoint_html' ) );
    }
     
    // Element Mapping
    public function vc_doctorPoint_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Doctor Point', 'text-domain'),
                'base' => 'vc_doctorPoint',
                'description' => __('Doctor Point Module', 'text-domain'),
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Name', 'text-domain' ),
                        'param_name' => 'name',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Specialty', 'text-domain' ),
                        'param_name' => 'specialty',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Address', 'text-domain' ),
                        'param_name' => 'address',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Phone', 'text-domain' ),
                        'param_name' => 'phone',
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
                        'type' => 'textfield',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Lat', 'text-domain' ),
                        'param_name' => 'lat_vc',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Long', 'text-domain' ),
                        'param_name' => 'long_vc',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link Bio', 'text-domain' ),
                        'param_name' => 'link_bio',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link Website', 'text-domain' ),
                        'param_name' => 'link_web',
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
    public function vc_doctorPoint_html( $atts ) {
        
        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'name' => '',
                    'specialty' => '',
                    'address' => '',
                    'phone' => '',
                    'image' => '',
                    'lat_vc' => '',
                    'long_vc' => '',
                    'link_bio' => '',
                    'link_web' => ''
                ), 
                $atts
            )
        );   

        $image = wp_get_attachment_image_src($image, 'medium');

        $link_bio = explode('|', $link_bio);
        $link_web = explode('|', $link_web);

        $data = [
            'name'      => str_replace( "'", "", $name ),
            'specialty' => str_replace( "'", "", $specialty ),
            'address'   => str_replace( "'", "", $address ),
            'phone'     => $phone, 
            'open'      => false,
            'image'     => $image, 
            'lat_vc'    => $lat_vc, 
            'long_vc'   => $long_vc, 
            'link_bio'  => urldecode(str_replace('url:','', $link_bio[0])), 
            'link_web'  => urldecode(str_replace('url:','', $link_web[0])),
            'type'      => 'doctor'
        ];

        return json_encode( $data );
    } 
     
} // End Element Class
 
// Element Class Init
new vcDoctorPoint();

?>