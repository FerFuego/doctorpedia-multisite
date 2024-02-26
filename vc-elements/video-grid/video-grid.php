<?php
/* Element Description: VC VideoGrid*/
 
// Element Class 
class vcVideoGrid extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_videoGrid_mapping' ) );
        }
        add_shortcode( 'vc_videoGrid', array( $this, 'vc_videoGrid_html' ) );
    }

    function getCategory(){
        $categ = array();
        $categories = get_categories();
        $categ[] = __('');
        foreach ( $categories as $category ) {
            $categ[] = __($category->name);
        }

        return $categ;
    }

    function getTaxonomy(){
        $tax = array();
        $taxonomies = get_tags();
        $tax[] = __('');
        foreach ( $taxonomies as $taxonomy){
            $tax[] = __($taxonomy->name);
        }

        return $tax;
    }

    function getDoctors(){
        global $wpdb;
        $doc = array();
        $doc[] = __('');
        $authors = $wpdb->get_results("SELECT DISTINCT post_author FROM $wpdb->posts GROUP BY post_author");
        foreach ( $authors as $author ) :
            $author_data = get_userdata($author->post_author);    
            if ($author_data) {
                $doc[] = __($author_data->ID.'- '.$author_data->first_name. ' ' . $author_data->last_name);
            }
        endforeach;
        
        return $doc;
    }
     
    // Element Mapping
    public function vc_videoGrid_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Video Grid', 'text-domain'),
                'base' => 'vc_videoGrid',
                'description' => __('Video Grid Module', 'text-domain'), 
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
                        'type' => 'textfield',
                        'holder' => 'h3',
                        'class' => 'title-class',
                        'heading' => __( 'Subtitle', 'text-domain' ),
                        'param_name' => 'subtitle',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Category Post', 'text-domain' ),
                        'param_name' => 'category',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => $this->getCategory(),
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
                        'heading' => __( 'Filter by Doctor', 'text-domain' ),
                        'param_name' => 'doctor',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => $this->getDoctors(),
                    ),
                )
            )
        );                           
        
    } 
     
    // Element HTML
    public function vc_videoGrid_html( $atts ) {

         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'  => '',
                    'subtitle'  => '',
                    'category' => '',
                    'taxonomy' => '',
                    'doctor' => ''
                ), 
                $atts
            ) 
        );

        if($doctor){
            $doctor_prop = explode('-', $doctor);
            $doctor_id = $doctor_prop[0];
        }else{
            $doctor_id = null;
        }

        $loop = new WP_Query( array(
            'post_type' => array('post','video_play'),
            'category_name' => $category,
            'tag' => $taxonomy,
            'author' => $doctor_id,
            'post_per_page' => -1
        ));
    
        return $this->BlockHTML($loop, $title, $subtitle, $category, $taxonomy);
    }

    public function BlockHTML($loop, $title, $subtitle, $category, $taxonomy){ 
        ob_start(); ?>
        <!-- Video Grid Module VC -->
        <div class="grid">
            <div class="container">
                <div class="header">
                    <h1><?php echo $title ?></h1>
                </div>
                <div class="grid-container">
                    <?php while ( $loop->have_posts()) : $loop->the_post(); ?>
                        <div class="grid-thumbnail">
                            <a href="<?php the_permalink() ?>">
                                <div class="trim">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>" alt="">
                                </div>
                                <?php if($category == 'Videos'): ?>
                                    <button class="play-video-btn <?php (($slides == '3') ? ('play-video-btn-lg') : ('')) ?>">
                                        <img class="icon-play"  src="<?php echo IMAGES ?>/icons/play-button.svg" alt=""> 
                                    </button>
                                <?php endif ?>
                                <h1><?php the_title() ?></h1>
                            </a>
                        </div>
                    <?php endwhile ?>
                </div>
            </div>    
        </div>
        <!-- End video Grid Module -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcVideoGrid();

?>