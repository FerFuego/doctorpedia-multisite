<?php
/* Element Description: VC Blogging News Item*/
 
// Element Class 
class vcSingleProfileGrid extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_singleProfile_mapping' ) );
        }
        add_shortcode( 'vc_singleProfile', array( $this, 'vc_singleProfile_html' ) );
    }

    public function getBlogProfile(){

        global $wpdb;
        global $post;
        
        $users[] = __('');

        $blogusers = get_users( 'blog_id=1&orderby=nicename&role=blogger' );

        if ( $blogusers ) {

            foreach ( $blogusers as $user ) {

                $users[] = __( $user->ID . ' | ' . $user->display_name );

            }

        }

        return $users;
    }
     
    // Element Mapping
    public function vc_singleProfile_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Blogging Profiles Slider - Profile', 'text-domain'),
                'base' => 'vc_singleProfile',
                'description' => __('Single Blogging Profile Module', 'text-domain'),
                'category' => __('DoctorPedia Blogging', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Select Author', 'text-domain' ),
                        'param_name' => 'author',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => $this->getBlogProfile(),
                    )
                )
            )
        );
    }
     
    // Element HTML
    public function vc_singleProfile_html( $atts ) {
        
        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'author' => ''
                ), 
                $atts
            )
        );

        $author = explode('|', $author)[0];

        $user = get_user_by( 'id', trim( $author ) );
        
        return $this->BlockHTML( $user );
    } 

    public function BlockHTML( $user ) { 
        
        ob_start(); ?>

        <div class="slider-single-item <?php echo ( $slides == 3 ) ? 'fix-width':''; ?>">

            <div class="trim bg-profile-image">

                <img src="<?php echo get_avatar_url($user->ID, '200'); ?>" class="rounded-circle">

            </div>

            <div class="slider-single-item-content">

                <h2 class="slider-single-title"><?php the_author_meta('display_name', $user->ID); ?></h2>

                <?php if (get_field('bb_specialties', 'user_' . $user->ID)): ?>

                    <?php //foreach (get_field('bb_specialties', 'user_' . $user->ID) as $specialty): ?>

                        <h4><?php echo get_field('bb_specialties', 'user_' . $user->ID)[0]['specialty']; ?></h4>

                        <?php //echo ( $specialty['subspecialty'] ) ? '  -  ' . $specialty['subspecialty'] : ''; ?>

                    <?php //endforeach;?>

                <?php endif; ?>

                <a href="<?php echo get_author_posts_url( $user->ID ); ?>">View Profile</a>

            </div>

        </div>

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcSingleProfileGrid();

?>