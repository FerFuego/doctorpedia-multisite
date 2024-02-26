<?php
/* Element Description: VC postSlider*/
 
// Element Class 
class vcpostSlider extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_postSlider_mapping' ) );
        }
        add_shortcode( 'vc_postSlider', array( $this, 'vc_postSlider_html' ) );
    }

    function getCategory(){
        $categ = array();
        $categories = get_categories();
        $categ[] = __('');
        foreach ( $categories as $category ) {
            $categ[] = __($category->slug);
        }

        return $categ;
    }

    function getTaxonomy(){
        $tax = array();
        $taxonomies = get_tags();
        $tax[] = __('');
        foreach ( $taxonomies as $taxonomy){
            $tax[] = __($taxonomy->slug);
        }

        return $tax;
    }

    function getDoctors(){
        global $wpdb;
        $doc = array();
        $doc[] = __('');
        $authors = $wpdb->get_results("SELECT DISTINCT post_author FROM $wpdb->posts WHERE post_type IN('post','video_play','faqs_type','vl_category','pages') GROUP BY post_author");
        foreach ( $authors as $author ) :
                $author_data = get_userdata($author->post_author);    
                $doc[] = __($author_data->ID.'- '.$author_data->first_name. ' ' . $author_data->last_name);
        endforeach;
        
        return $doc;
    }
     
    // Element Mapping
    public function vc_postSlider_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Posts Slider', 'text-domain'),
                'base' => 'vc_postSlider',
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
                        "type" => "colorpicker",
                        "class" => "",
                        'heading' => __( 'Title Color', 'text-domain' ),
                        "param_name" => "title_color",
                        "value" => '', 
                        "description" => __( "", "my-text-domain" ),
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
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Slides to show', 'text-domain' ),
                        'param_name' => 'slides',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => array(
                            __('Select the amount of slides'),
                            __('3'),
                            __('4'),
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Category Post', 'text-domain' ),
                        'param_name' => 'category',
                        'description' => __( '(Optional filter)', 'text-domain' ),
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
                        'description' => __( '(Optional filter)', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => $this->getTaxonomy(),
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Show Total Post', 'text-domain' ),
                        'param_name' => 'num_post',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => array(
                            __('',''),
                            __('3','3'),
                            __('4','4'),
                            __('5','5'),
                            __('6','6'),
                            __('7','7'),
                            __('8','8'),
                            __('9','9'),
                            __('10','10')
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Filter by Doctor', 'text-domain' ),
                        'param_name' => 'doctor',
                        'description' => __( '(Optional filter)', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => $this->getDoctors(),
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Mobile Slider', 'text-domain' ),
                        'param_name' => 'mobile_slider',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Mobile',
                        'value' => array(
                            __('Please select a way of viewing the element'),
                            __('I want a Slider'),
                            __('I want a Grid'),
                        ),
                    ),
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_postSlider_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);
         // Params extraction

        extract(
            shortcode_atts(
                array(
                    'title'   => '',
                    'title_color'   => '#000',
                    'description'   => '',
                    'slides'   => '',
                    'category' => '',
                    'taxonomy' => '',
                    'num_post' => '',
                    'mobile_slider' => '',
                    'doctor' => ''
                    
                ), 
                $atts
            )
        );
        
        
        $slider_id = rand(999, 9999);

        if(!$slides){
            $slides = 3;
        }
        if($doctor){
            $doctor_prop = explode('-', $doctor);
            $doctor_id = $doctor_prop[0];
        }else{
            $doctor_id = null;
        }

        $loop = new WP_Query( array(
            'post_type' => array('post','video_play','faqs_type','vl_category'),
            'category_name' => $category,
            'tag' => $taxonomy,
            'author' => $doctor_id,
            'posts_per_page' => $num_post
        ));
        
        return $this->BlockHTML($loop, $slider_id, $title, $title_color, $description, $slides, $mobile_slider, $category);
    } 

    public function BlockHTML($loop, $slider_id, $title, $title_color, $description, $slides, $mobile_slider, $category){ 
        ob_start(); ?>
        <!-- Post Slider Module VC-->
        <div class="post-slider-element">
            <div class="container">
                <h2 class="title title-post-slider" style="color:<?php echo $title_color ?>"><?php echo $title ?></h2>
                <?php if(!empty($description)): ?>
                    <p><?php echo $description ?></p>
                <?php else: ?>
                    <br>
                <?php endif ?>
                <div class="slider-container">
                    <?php if($loop->post_count > $slides): ?>
                        <img src="<?php echo IMAGES ?>/icons/prev.svg" class="prev prev_<?php echo $slider_id ?>">
                    <?php endif ?>

                    <div id="slider_<?php echo $slider_id ?>" class="slider_<?php echo $slider_id ?> slides">
                        <?php while ( $loop -> have_posts()) : $loop->the_post(); ?>
                            <a href="<?php the_permalink() ?>">
                                <div class="slider-single-item">
                                    <div class="trim lazy"  style="background-image:url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>)">
                                        <?php if($category == 'videos' || 'Videos'): ?>
                                            <button class="play-video-btn <?php echo (($slides == '3') ? ('play-video-btn-lg') : ('')) ?>">
                                                <img class="icon-play"  src="<?php echo IMAGES ?>/icons/play-button.svg" alt=""> 
                                            </button>
                                        <?php endif ?>
                                    </div>
                                    <div class="slider-single-item-content">
                                        <h2 class="slider-single-title"><?php the_title() ?></h2>
                                    </div>
                                </div>
                            </a>
                        <?php endwhile ?>
                    </div>

                    <?php if($loop->post_count > $slides): ?>
                        <img src="<?php echo IMAGES ?>/icons/next.svg" class="next next_<?php echo $slider_id ?>">
                    <?php endif ?>
                </div>
            </div>    
        </div>
        <script>   
            $("document").ready(function(){
                if("<?php echo $mobile_slider ?>" == "I want a Slider"){
                    $("#slider_<?php echo $slider_id ?>").removeClass("slides_grid");
                    $("#slider_<?php echo $slider_id ?>").slick({
                        infinite: true,
                        slidesToShow: <?php echo $slides ?>,
                        slidesToScroll: <?php echo $slides ?>,
                        prevArrow: $(".prev_<?php echo $slider_id ?>"),
                        nextArrow: $(".next_<?php echo $slider_id ?>"),
                        responsive: [
                            {
                                breakpoint: 1930,
                                settings: {
                                    slidesToShow: <?php echo $slides ?>,
                                    slidesToScroll: <?php echo $slides ?>,
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 2,
                                }
                            },
                        ]
                    });
                }else{
                    $("#slider_<?php echo $slider_id ?>").addClass("slides_grid");
                    $("#slider_<?php echo $slider_id ?>").slick({
                        infinite: true,
                        slidesToShow: <?php echo $slides ?>,
                        slidesToScroll: <?php echo $slides ?>,
                        prevArrow: $(".prev_<?php echo $slider_id ?>"),
                        nextArrow: $(".next_<?php echo $slider_id ?>"),
                        responsive: [
                            {
                                breakpoint: 1930,
                                settings: {
                                    slidesToShow: <?php echo $slides ?>,
                                    slidesToScroll: <?php echo $slides ?>,
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: "unslick",
                            },
                        ]
                    });
                }
           
            });
            
            $(window).on("resize", function() {
                $("#slider_<?php echo $slider_id ?>").not(".slick-initialized").slick("resize");
            });
        </script>
        <!-- End Thumb Slider Module -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcpostSlider();

?>