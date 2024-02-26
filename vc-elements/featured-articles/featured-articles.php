<?php
/* Element Description: VC FeaturedArticles*/
 
// Element Class 
class vcFeaturedArticles extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_featuredArticles_mapping' ) );
        }
        add_shortcode( 'vc_featuredArticles', array( $this, 'vc_featuredArticles_html' ) );
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
    public function vc_featuredArticles_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Featured Articles', 'text-domain'),
                'base' => 'vc_featuredArticles',
                'description' => __('Featured Articles Module', 'text-domain'), 
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
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link', 'text-domain' ),
                        'param_name' => 'link',
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
                        'heading' => __( 'Post Type', 'text-domain' ),
                        'param_name' => 'post_type',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => array(
                            __('',''),
                            __('post','post'),
                            __('video_play','video_play'),
                            __('product_reviews','product_reviews')
                        ),
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
                    array(
                        "type"          => "checkbox",
                        "admin_label"   => true,
                        "weight"        => 10,
                        "heading"       => __( "Author not show", "text-domain" ),
                        "description"   => __("description", "text-domain"),
                        "value"         => array('Author Not show' => 'true' ),
                        "param_name"    => "show_author",
                        'group' => 'General',
                    ),
                )
            )
        );                           
        
    }
     
    // Element HTML
    public function vc_featuredArticles_html( $atts ) {

         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'  => '',
                    'link'  => '/blog',
                    'subtitle'  => '',
                    'post_type' => '',
                    'category' => '',
                    'taxonomy' => '',
                    'doctor' => '',
                    'mobile_slider' => '',
                    'show_author' => ''
                ), 
                $atts
            ) 
        );

        $rand = rand(99,9999);

        $link = explode('|', $link);

        if($doctor){
            $doctor_prop = explode('-', $doctor);
            $doctor_id = $doctor_prop[0];
        }else{
            $doctor_id = null;
        }

        $current_post = ( is_single() ) ? get_the_ID() : 0;

        $loop = new WP_Query( array(
            'post_type' => $post_type,
            'category_name' => $category,
            'tag' => strtolower(str_replace(' ','-', $taxonomy)),
            'author' => $doctor_id,
            'post__not_in' => array( $current_post ),
            'posts_per_page' => 3
        ));
        
        return $this->BlockHTML($title, $subtitle, $link, $rand, $category, $taxonomy, $doctor, $mobile_slider, $loop, $show_author);
             
    } 
    
    public function BlockHTML($title, $subtitle, $link, $rand, $category, $taxonomy, $doctor, $mobile_slider, $loop, $show_author){ 
        ob_start(); ?>
        <!-- Featured Articles Module VC -->
        <div class="blog-posts-preview-container">            
            <div class="container">
                <div class="header">
                    <h2><?php echo $title ?></h2>
                    <?php
                    $url = urldecode(str_replace('url:','', $link[0]));
                    if( $url !== '' && strpos($url, "https") === false){  
                        $url = get_bloginfo('wpurl') . $url; 
                    } ?>
                    <a href="<?php echo $url ?>"><?php echo urldecode(str_replace('title:','', $link[1])) ?></a>
                </div>
                <div class="body featured-article slick-features-<?php echo $rand?>">

                    <?php  while ( $loop -> have_posts()) : $loop->the_post(); ?>
                                            
                            <div class="blog-post-preview" data-slug="<?php echo( basename( get_permalink() ) ); ?>">
                                <a href="<?php the_permalink() ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>);" class="trim"></a>
                                <div class="content">
                                    <a href="<?php the_permalink() ?>">
                                        <?php if(get_field('subtitle')){ ?>
                                            <h3><?php the_field('subtitle') ?></h3>
                                        <?php } ?>
                                        <h2 class="<?php echo ($show_author) ? 'pb-25' : '';?>"><?php the_title() ?></h2>
                                    </a>
                                </div>
                                <?php if(!$show_author) :?>
                                    <div class="footer">
                                        <div class="post-author"><?php echo get_avatar(get_the_author_meta('email'), '32') ?></div>
                                        <span><?php the_author() ?></span>
                                    </div>
                                <?php endif ?>
                            </div>

                    <?php endwhile; ?>
                </div>
                <div class="footer-view d-md-none">
                    <a class="view-all" href="<?php echo $url ?>"><?php echo urldecode(str_replace('title:','', $link[1])) ?></a>
                </div>
            </div>
        </div>
        
        <script>
            $("document").ready(function(){
                if($(window).width() < 769){

                    if("<?php echo $mobile_slider ?>" == "I want a Slider"){
                        
                        $(".featured-article").removeClass("slides_grid");
                        $(".slick-features-<?php echo $rand ?>").slick({
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
                                },
                                {
                                breakpoint: 768,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1
                                    }
                                }
                            ]
                        });

                    }else{

                        $(".featured-article").addClass("slides_grid");
                        $(".slick-features-<?php echo $rand ?>").slick({
                            infinite: true,
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            prevArrow: $(".prev"),
                            nextArrow: $(".next"),
                            responsive: [
                                {
                                    breakpoint: 1930,
                                    settings: {
                                        slidesToShow: 3,
                                        slidesToScroll: 3,
                                    }
                                },
                                {
                                    breakpoint: 1024,
                                    settings: "unslick",
                                },
                            ]
                        });
                    }

                } 
            });
            /* $(window).on("resize", function() {
                $(".slick-features-<?php //echo $rand ?>").not(".slick-initialized").slick("resize");
            }); */

        </script>
        <!-- Featured Articles Module VC -->
    <?php 
        return ob_get_clean(); 
    }
     
} // End Element Class
 
// Element Class Init
new vcFeaturedArticles();

?>