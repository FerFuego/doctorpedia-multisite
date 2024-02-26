<?php
/* Element Description: VC Team*/
 
// Element Class 
class vcTeam extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        if(is_admin()) {
            add_action( 'init', array( $this, 'vc_team_mapping' ) );
        }
        add_shortcode( 'vc_team', array( $this, 'vc_team_html' ) );
    }

    function getTeams(){
        $tax = array();
        $taxonomies = get_terms('area');
        $tax[] = __('');
        foreach ( $taxonomies as $taxonomy){
            $tax[] = __($taxonomy->slug);
        }

        return $tax;
    }
     
    // Element Mapping
    public function vc_team_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Team', 'text-domain'),
                'base' => 'vc_team',
                'description' => __('Team Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'title_team',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Team Area', 'text-domain' ),
                        'param_name' => 'team',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => $this->getTeams(),
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
                        'type'        => 'checkbox',
                        'heading'     => __(''),
                        'param_name'  => 'background',
                        'admin_label' => false,
                        'value'       => array(
                            'Background Grey'=>'enable',
                        ),
                        'std' => ' ',
                        'description' => __('Default White'),
                        'group' => 'General',
                    ),
                )
            )
        );
    }
     
     
    // Element HTML
    public function vc_team_html( $atts ) {

         // Params extraction
         extract(
            shortcode_atts(
                array(
                    'title_team' => '',
                    'team' => '',
                    'background' => '',
                    'slides' => ''
                ), 
                $atts
            )
        );

        $slider_id = rand();

        if( !$slides ){
            $slides = 3;
        }

        $loop = new WP_Query( array(
            'post_type' => array('team'),
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'area',
                    'field' => 'slug',
                    'terms' => $team
                )
            )
        ));
                
        return $this->BlockHTML( $title_team, $team, $slider_id, $loop, $background, $slides );
    } 

    public function BlockHTML( $title_doctors, $team, $slider_id, $loop, $background, $slides ){ 
        ob_start(); ?>

        <!-- Team Module VC -->
        <div class="container-fluid team-container <?php echo ( $background ) ? 'team-bg-grey' : ''; ?>">
        
            <div class="container header-team">

                <h2><?php echo $title_doctors; ?></h2>

            </div>

            <div class="slider-container container body-team-container">

                <?php if ( $loop->post_count > $slides ) : ?>

                    <img src="<?php echo IMAGES ?>/icons/prev.svg" class="prev prev_<?php echo $slider_id ?>">

                <?php endif ?>

                <div id="slider_<?php echo $slider_id ?>" class="slider_<?php echo $slider_id ?> slides">

                    <?php while ( $loop -> have_posts() ) : $loop->the_post(); ?>

                        <div class="slider-single-item <?php echo ( $slides == 3 ) ? 'fix-width':''; ?>">

                            <div class="trim team-image">
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?>" alt="profile">
                            </div>

                            <div class="slider-single-item-content">

                                <h2 class="slider-single-title <?php echo ( !get_field('position') ) ? 'mb-3':'';?>"><?php the_title() ?></h2>

                                <?php if ( get_field('position') ) : ?>

                                    <p><?php echo get_field('position'); ?></p>

                                <?php endif; ?>

                                <?php if ( !get_field('hide_fullbio') ) : ?>

                                    <a href="<?php echo get_the_permalink(); ?>" target="_blank">View Full Bio</a>

                                <?php endif; ?>

                            </div>

                        </div>

                    <?php endwhile ?>

                </div>

                <?php if ( $loop->post_count > $slides ) : ?>

                    <img src="<?php echo IMAGES ?>/icons/next.svg" class="next next_<?php echo $slider_id ?>">

                <?php endif ?>

            </div>

        </div>

        <script>   
            $("document").ready(function(){
                var divs = document.getElementsByClassName("slider-single-item").length;

                if ( divs < 4 || $(window).width() < 769 ) {
                    $('.next_<?php echo $slider_id ?>').remove();
                    $('.prev_<?php echo $slider_id ?>').remove();
                }

                $("#slider_<?php echo $slider_id ?>").slick({
                    infinite: true,
                    slidesToShow: <?php echo $slides ?>,
                    slidesToScroll: <?php echo $slides ?>,
                    prevArrow: $(".prev_<?php echo $slider_id ?>"),
                    nextArrow: $(".next_<?php echo $slider_id ?>"),
                    dots: ($(window).width() < 769 ) ? true : false,
                    responsive: [
                        {
                            breakpoint: 1930,
                            settings: {
                                slidesToShow: <?php echo $slides ?>,
                                slidesToScroll: <?php echo $slides ?>,
                            }
                        },
                        {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 450,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                            }
                        },
                    ]
                });
            });
            
            $(window).on("resize", function() {
                $("#slider_<?php echo $slider_id ?>").not(".slick-initialized").slick("resize");
            });
        </script>
        <!-- End Team Module VC -->

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcTeam();

?>