<?php
/* Element Description: VC FeaturedCollection*/
 
// Element Class 
class vcFeaturedCollection extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_featuredCollection_mapping' ) );
        }
        add_shortcode( 'vc_featuredCollection', array( $this, 'vc_featuredCollection_html' ) );
    }

    //Get Taxonomy Terms
    function getTaxonomyTerms(){
        $terms = get_terms('video-library-category'); // Get all terms of a taxonomy
        $taxTerm[] = __('');

            foreach ( $terms as $term ) {
                $taxTerm[ __($term->name) ] = __($term->term_id);
            } 
        return $taxTerm;      
    }

     
    // Element Mapping
    public function vc_featuredCollection_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Featured Collections', 'text-domain'),
                'base' => 'vc_featuredCollection',
                'description' => __('Featured Collections Module', 'text-domain'), 
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
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link Full Videos', 'text-domain' ),
                        'param_name' => 'link',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
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
                    array(
                        "type"        => "checkbox",
                        "heading"     => 'Theme Data', 'my-theme',
                        "param_name"  => "taxonomy_term",
                        "admin_label" => true,
                        'group' => 'General',
                        "value"       => $this->getTaxonomyTerms()

                        // 'type' => 'checkbox',
                        // 'holder' => 'p',
                        // 'class' => 'title-class',
                        // 'param_name' => 'show_terms',
                        // 'description' => __( '', 'text-domain' ),
                        // 'admin_label' => false,
                        // 'weight' => 0,
                        // 'group' => 'General',
                        // "heading" => 'Featured Collections',
                        // 'value' => $this-getTaxonomyTerms(),
                    ),
                )
            )
        );                           
        
    }
     
    // Element HTML
    public function vc_featuredCollection_html( $atts ) {

         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'  => '',
                    'link'  => '/blog',
                    'show_author' => '',
                    'category' => '', 
                    'taxonomy_term' => ''
                ), 
                $atts
            ) 
        );

        $rand = rand(99,9999);

        $link = explode('|', $link);
        $taxonomy_term = explode( ',', $taxonomy_term );
        $terms = array();

        foreach ( $taxonomy_term as $tid ) {
            $terms[] = get_term_by('id', $tid, 'video-library-category' );
        }

        // $query = new WP_Query( [
        //     'post_type' => 'doctors',
        //     'posts_per_page' => -1,
        //     'post__in'      => $doctorsInsideRadio,
        //     // 'paged' => $paged,
        //     'meta_key' => 'profile',
        //     'orderby' => 'meta_value',
        //     'order' => 'DESC'
        // ] );
        return $this->BlockHTML($title, $link, $rand, $loop, $show_author, $category, $taxonomy_term, $terms);
             
    } 
    
    public function BlockHTML($title, $link, $rand, $loop, $show_author, $category, $taxonomy_term, $terms){ 
        ob_start(); ?>
        <!-- Featured Collection Module VC -->
        <div class="collection-review-container">    

            <div class="container">
                <div class="header">
                    <?php //$pepe = getTaxonomyTerms();?>
                    <h1><?php echo $title ?></h1>
                    <a href="<?php echo urldecode(str_replace('url:','', $link[0])) ?>"><?php echo urldecode(str_replace('title:','', $link[1])) ?></a>
                </div>
                <?php if( $terms ): ?>
                    <div class="body slider-container">
                        <img src="<?php echo IMAGES; ?>/icons/prev.svg" alt="" class="d-none d-md-block prev prev_<?php echo $rand; ?>">

                        <div id="slider-app-review" class="app-review-article slider-app-review slides slick_<?php echo $rand; ?>">

                            <?php foreach ( $terms as $term ) :?>
                                <?php 
                                    //Get Taxonomy Author
                                    $videoAuthor = get_field('doctor', $term);
                                    $video_author = get_field('doctor', $term); 
                                    $video_author_img =isset( $video_author[ 'user_avatar' ] ) && !empty($video_author[ 'user_avatar' ]) ? simplexml_load_string( $video_author[ 'user_avatar' ] )->attributes()->src : null;
                                
                                ?>
                                
                                <div class="blog-post-preview">
                                    <img class="post-thumbnail" alt="">
                                    <a href="<?php echo '/video-library-category/' . $term->slug ?>" style="background-image: url(<?php echo get_field('video_cover', $term) ?>);"></a>
                                    <div class="content clinical-content">
                                        <h2><?php echo $term->name ?></h2>
                                    </div>
                                    <?php if(!$show_author) :?>
                                        <div class="footer">
                                            <div class="post-author"><img src="<?php echo $video_author_img; ?>" alt="<?php echo $videoAuthor[ 'nickname' ]; ?>"></div>
                                            
                                            <span><?php echo $videoAuthor[ 'nickname' ]; ?></span>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <?php endforeach; ?>
                            
                        </div>

                        <img src="<?php echo IMAGES ?>/icons/next.svg" alt="" class="d-none d-md-block next next_<?php echo $rand; ?>">
                    </div>
                <?php endif ?>
            </div>
        </div>
        
        <script>
            $(".slick_<?php echo $rand;?>").slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3,
                prevArrow: $(".prev_<?php echo $rand; ?>"),
                nextArrow: $(".next_<?php echo $rand; ?>"),
                dots: false,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: "unslick",
                    }
                ]
            });
            
            $(window).on("resize", function() {
                $("#slick-app-<?php echo $rand ?>").not(".slick-initialized").slick("resize");
            });

        </script>
        <!-- Featured Collection Module VC -->
    <?php 
        return ob_get_clean(); 
    }
     
} // End Element Class
 
// Element Class Init
new vcFeaturedCollection();

?>