<?php
/* Element Description: VC ProductReview*/
 
// Element Class 
class vcProductReview extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_productReview_mapping' ) );
        }
        add_shortcode( 'vc_productReview', array( $this, 'vc_productReview_html' ) );
    }

    function getTaxonomy(){
        $tax = array();
        $taxonomies = get_categories( array( 'taxonomy' => 'reviews-category' ) );
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
    public function vc_productReview_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Reviews', 'text-domain'),
                'base' => 'vc_productReview',
                'description' => __('Reviews Module', 'text-domain'), 
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
                        'heading' => __( 'Category Posts', 'text-domain' ),
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
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link View All', 'text-domain' ),
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
    public function vc_productReview_html( $atts ) {

         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'  => '',
                    'taxonomy' => '',
                    'doctor' => '',
                    'link'  => '',
                ), 
                $atts
            ) 
        );

        $rand = rand(999,9999);
        $link = explode('|', $link);

        if($doctor){
            $doctor_prop = explode('-', $doctor);
            $doctor_id = $doctor_prop[0];
        }else{
            $doctor_id = null;
        }

        $loop = new WP_Query( array(
            'post_type' => 'reviews',
            'author' => $doctor_id,
            'tax_query' => array(
                array(
                    'taxonomy' => 'reviews-category',
                    'field' => 'slug',
                    'terms' => $taxonomy
                )
            )
        ));

        return $this->BlockHTML($loop, $title, $rand, $link);
    } 

    public function BlockHTML($loop, $title, $rand, $link){
        ob_start(); ?>
        <!-- Product Review Slider Module VC -->
        <div class="product-review-container">            
            <div class="container">
                <div class="header">
                    <h2><?php echo $title; ?></h2>
                    <?php if ( $link[0] != '' ) :?>
                        <a href="<?php echo urldecode(str_replace('url:','', $link[0])) ?>"><?php echo urldecode(str_replace('title:','', $link[1])) ?></a>
                    <?php endif; ?>
                </div>
                <div class="body">
                    
                    <?php if($loop->post_count > 3): ?>
                        <img src="<?php echo IMAGES ?>/icons/prev.svg" class="prev prev_<?php echo $rand ?>">
                    <?php endif ?>

                    <div id="slick-app-<?php echo $rand ?>" class="body product-review-article">
                        <?php while ( $loop -> have_posts()) : $loop->the_post(); ?>
                            <div class="product-post-preview">
                                <div class="img-app line-border" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>);">
                                    <a href="<?php the_permalink() ?>"></a>
                                </div>
                                <div class="content">
                                    <a href="<?php the_permalink() ?>"><h2><?php the_title() ?></h2></a>
                                    <?php echo cadena::corta(get_field('description'),200) ?>
                                </div>
                                <div class="footer <?php echo (get_field('external_link')) ? 'external-link' : ''; ?>">
                                    <?php if(get_field('title_2')): ?>
                                        <div class="post-author first">
                                            <div class="col-2 col-md-3 p-0">
                                                <h4><?php the_field('title_2') ?></h4>
                                            </div>
                                            <div class="col p-0 text-center">
                                                <div class="stars-rating">
                                                    <?php for ($i=1; $i < 6; $i++): ?>
                                                        <?php if($i <= get_field('stars_2')): ?>
                                                            <img src="<?php echo IMAGES ?>/icons/star-type-2-yellow.svg">
                                                        <?php else: ?>
                                                            <img src="<?php echo IMAGES ?>/icons/star-type-2-white.svg">
                                                        <?php endif ?>
                                                    <?php endfor ?>
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-3 col-lg-4 p-0 stars-rating">
                                                <label>(<?php the_field('reviews_2') ?><span class="reviews-text"> Reviews</span>)</label>
                                            </div>
                                        </div>
                                    <?php endif ?>

                                    <?php if(get_field('title_1')): ?>
                                        <div class="post-author">
                                            <div class="col-2 col-md-3 p-0">
                                                <h4><?php the_field('title_1') ?></h4>
                                            </div>
                                            <div class="col p-0 text-center">
                                                <div class="stars-rating">
                                                    <?php for ($i=1; $i < 6; $i++): ?>
                                                        <?php if($i <= get_field('stars_1')): ?>
                                                            <img src="<?php echo IMAGES ?>/icons/star-type-2-yellow.svg">
                                                        <?php else: ?>
                                                            <img src="<?php echo IMAGES ?>/icons/star-type-2-white.svg">
                                                        <?php endif ?>
                                                    <?php endfor ?>
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-3 col-lg-4 p-0 stars-rating">
                                                <label>(<?php the_field('reviews_1') ?><span class="reviews-text"> Reviews</span>)</label>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    
                                    <?php if(get_field('external_link')): ?>
                                        <?php $a = get_field('external_link'); ?>
                                        <a href="<?php echo urldecode($a['url']); ?>" target="<?php echo urldecode($a['target']) ?>"><?php echo urldecode($a['title']) ?></a>
                                        <?php $b = get_field('external_link_2'); ?>
                                        <a href="<?php echo urldecode($b['url']); ?>" target="<?php echo urldecode($b['target']) ?>"><?php echo urldecode($b['title']) ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile ?>
                    </div>
                    
                    <?php if($loop->post_count > 3): ?>
                        <img src="<?php echo IMAGES ?>/icons/next.svg" class="next next_<?php echo $rand ?>">
                    <?php endif ?>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                if($('.product-post-preview').length < 3 ){
                    $("#slick-app-<?php echo $rand ?>").slick({
                        infinite: true,
                        slidesToShow: $('.product-post-preview').length,
                        slidesToScroll: $('.product-post-preview').length,
                        prevArrow: $(".prev_<?php echo $rand ?>"),
                        nextArrow: $(".next_<?php echo $rand ?>"),
                        dots: false,
                        responsive: [
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    dots: true
    
                                }
                            },
                        ]
                    });
                } else {
                    $("#slick-app-<?php echo $rand ?>").slick({
                        infinite: true,
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        prevArrow: $(".prev_<?php echo $rand ?>"),
                        nextArrow: $(".next_<?php echo $rand ?>"),
                        dots: false,
                        responsive: [
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    dots: true
    
                                }
                            },
                        ]
                    });
                }
            });
            
            $(window).on("resize", function() {
                $("#slick-app-<?php echo $rand ?>").not(".slick-initialized").slick("resize");
            });
        </script>
        <!-- End Product Review Slider Module VC -->
    <?php 
        return ob_get_clean(); 
    }
} // End Element Class
 
// Element Class Init
new vcProductReview();

?>