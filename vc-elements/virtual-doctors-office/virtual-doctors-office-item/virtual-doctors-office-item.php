<?php
/* Element Description: VC Featured Apps Item*/
 
// Element Class 
class vcVirtualDoctorsOfficeItem extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_virtualDoctorsOfficeItem_mapping' ) );
        }
        add_shortcode( 'vc_virtualDoctorsOfficeItem', array( $this, 'vc_virtualDoctorsOfficeItem_html' ) );
    }

    function getDoctors(){
        global $wpdb;
        $doc = array();
        $doc[] = __('');
        $authors = $wpdb->get_results("SELECT DISTINCT post_author FROM $wpdb->posts  GROUP BY post_author");
        foreach ( $authors as $author ) :
            $author_data = get_userdata($author->post_author);    
            if ($author_data) {
                $doc[] = __($author_data->ID.'- '.$author_data->first_name. ' ' . $author_data->last_name);
            }
        endforeach;
        
        return $doc;
    }
     
    // Element Mapping
    public function vc_virtualDoctorsOfficeItem_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Virtual Doctors Office Item', 'text-domain'),
                'base' => 'vc_virtualDoctorsOfficeItem',
                'description' => __('Virtual Doctors Office Item Module', 'text-domain'),
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Select Doctor', 'text-domain' ),
                        'param_name' => 'doctor',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => $this->getDoctors(),
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Specialty", "my-text-domain" ),
                        "param_name" => "specialty",
                        "value" => '', 
                        "description" => __( "", "my-text-domain" ),
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link Room', 'text-domain' ),
                        'param_name' => 'link',
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
    public function vc_virtualDoctorsOfficeItem_html( $atts ) {
        
        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'doctor' => '',
                    'link'   => '',
                    'specialty' => ''
                ), 
                $atts
            )
        );

        $link = explode('|', $link);

        if( $doctor ) {
            $doctor_prop = explode('-', $doctor);
            $doctor_id = $doctor_prop[0];
        } else {
            $doctor_id = null;
        }
        
        return $this->BlockHTML( $doctor_id, $link, $specialty );
    } 

    public function BlockHTML( $doctor_id, $link, $specialty ) { 
        
        ob_start(); 

        $doctor = get_user_by('id', $doctor_id ); ?>
        
        <div class="doctor-office-item">
            
            <div class="doctor-office-item__header">
            
                <img src="<?php echo get_avatar_url( $doctor_id ); ?>" alt="">
                
            </div>

            <div class="doctor-office-item__body">
                
                <h2><?php echo $doctor->display_name; ?></h2>

                <?php if ( $specialty ) : ?>

                    <h4><?php echo $specialty; ?></h4>

                <?php endif; ?>

            </div>
            
            <div class="doctor-office-item__footer">

                <?php if ( $link[0] != '' ) :?>

                    <a class="doctor-office-item__footer__link" href="<?php echo urldecode(str_replace('url:','', $link[0])) ?>" target="<?php echo urldecode(str_replace('target:','', $link[0])) ?>">

                        <?php echo urldecode(str_replace('title:','', $link[1])) ?>
                    
                    </a>

                <?php endif; ?>

            </div>

        </div>

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcVirtualDoctorsOfficeItem();

?>