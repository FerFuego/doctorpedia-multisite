<?php
/* Element Description: VC SearchResources*/
 
// Element Class 
class vcSearchResources extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_searchResources_mapping' ) );
        add_shortcode( 'vc_searchResources', array( $this, 'vc_searchResources_html' ) );
    }
     
    // Element Mapping
    public function vc_searchResources_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Search Resources', 'text-domain'),
                'base' => 'vc_searchResources',
                'description' => __('Search Resources Module', 'text-domain'), 
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
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Sub Title', 'text-domain' ),
                        'param_name' => 'subtitle',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background Desktop', 'text-domain' ),
                        'param_name' => 'background',
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
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background Mobile', 'text-domain' ),
                        'param_name' => 'background_mobile',
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
                        'type'        => 'checkbox',
                        'heading'     => __(''),
                        'param_name'  => 'selectboxname',
                        'admin_label' => false,
                        'value'       => array(
                            'Enable Local Search'=>'enable',
                        ),
                        'std' => ' ',
                        'description' => __(''),
                        'group' => 'General',
                    ),
                    array(
                        'type'        => 'checkbox',
                        'heading'     => __(''),
                        'param_name'  => 'selectvirus',
                        'admin_label' => false,
                        'value'       => array(
                            'Enable Top Menu'=>'enable',
                        ),
                        'std' => ' ',
                        'description' => __(''),
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'title_alert',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'group' => 'Top Menu',
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
                        'group' => 'Top Menu',
                    ),
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_searchResources_html( $atts ) {
        
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'  => '',
                    'subtitle' => '',
                    'background' => '',
                    'background_mobile' => '',
                    'selectboxname' => '',
                    'selectvirus' => '',
                    'title_alert' => '',
                    'link' => ''
                ), 
                $atts
            ) 
        );

        $link = explode('|', $link);

        $background = wp_get_attachment_image_src($background, 'full');

        $background_mobile = wp_get_attachment_image_src($background_mobile, 'full');

        return $this->BlockHTML( $title, $subtitle, $background, $background_mobile, $selectboxname, $selectvirus, $title_alert, $link ); 
    } 

    public function BlockHTML( $title, $subtitle, $background, $background_mobile, $selectboxname, $selectvirus, $title_alert, $link ){ 
        ob_start(); ?>

        <!-- Search Resources Module -->
        <?php 
            if ( wp_is_mobile() ) {  
                $background_image = ($background_mobile[0]) ? $background_mobile[0] : esc_url( home_url('/') ) .'wp-content/themes/doctorpedia/img/default/doctorpedia_4.jpg'; 
            }else{ 
                $background_image = ($background[0]) ? $background[0] : esc_url( home_url('/') ) .'wp-content/themes/doctorpedia/img/default/doctorpedia_4.jpg'; 
            }
        ?>
        <section class="sr-discover-health <?php echo ( is_page_template('page_templates/home_page.php') || is_page_template('home_page.php')) ? 'mt-subnavbar-2': ''; ?>" 
            style="background-image: url(<?php echo $background_image; ?>);">

            <?php if ( $selectvirus && $link[0] ) : ?>

                <a href="<?php echo urldecode(str_replace('url:','', $link[0])) ?>" target="<?php echo urldecode(str_replace('target:','', $link[2])) ?>" >

                    <div class="container-fluid sr-top-menu" id="js-search-top-menu">

                        <div class="container box">

                            <span><?php if ( $title_alert ) echo $title_alert; ?></span> &nbsp;

                            <?php echo urldecode(str_replace('title:','', $link[1])) ?>
                            
                        </div>

                    </div>

                </a>
                
            <?php endif; ?>

            <?php if ( !is_page_template('page_templates/light_sites_new_template.php')) : ?>

                <div class="top-elements-filters <?php //echo ( $selectvirus && $link[0] ) ? 'mt-custom':'';?>" id="js-top-elements-filters">

                    <?php if ( !wp_is_mobile() ) { echo '<p>Jump to: </p>'; } ?>

                    <a href="#" class="jumper" data-id="All" data-item="all">All</a>

                    <a href="#videos" class="jumper" data-id="Playback" data-item="playback">Videos</a>

                    <a href="#articles" class="jumper" data-id="articles" data-item="articles">Articles</a>
                    
                    <a href="#apps" class="jumper" data-id="App" data-item="app-reviews">Apps</a>

                </div>

            <?php endif; ?>

            <div class="container sr-discover-health-header">
            
                <div class="container-form-discover-health" >

                    <form id="js-sr-form-discover-health" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-action="<?php echo esc_url( home_url('/search') ); ?>">

                        <h2><?php echo ( $title ) ? $title : "Don't let " . str_replace('pedia','', get_bloginfo('name')) . " control you"; ?></h2><br>

                        <label id="js-form-discover-health-label">
                            <?php echo ( $subtitle ) ? $subtitle : "Whether you're looking for tools to manage " . str_replace('pedia','', get_bloginfo('name')) . " or another health topic, Doctorpedia has doctor-vetted options for you:"; ?>
                        </label>

                        <input type="text" minlength="3" size="20" id="js-search-condition" name="condition" placeholder="Enter a condition, topic, keyword, etc." onKeyPress="return checkSubmit(event)" required/></label>

                        <div id="js-form-discover-health-checkbox">

                            <div class="form-discover-health-checkbox">
                                
                                <label for="all" class="incluir">
                                    <input type="checkbox" name="selection[]" id="all" value="All" id="js-all-checkbox" checked> 
                                    <span></span>
                                    <b>All</b>
                                </label>

                                <label for="playback" class="incluir">
                                    <input type="checkbox" name="selection[]" id="playback" value="Playback"> 
                                    <span></span>
                                    <b>Videos</b>
                                </label>     
                                
                                <label for="app" class="incluir">
                                    <input type="checkbox" name="selection[]" id="app" value="App"> 
                                    <span></span>
                                    <b>Apps</b>
                                </label>
                                
                                <!-- <label for="articles" class="incluir">
                                    <input type="checkbox" name="selection[]" id="article" value="Articles"> 
                                    <span></span>
                                    <b>Articles</b>
                                </label> -->
                                
                                <label for="clinical-trial" class="incluir">
                                    <input type="checkbox" name="selection[]" id="clinical-trial" value="Clinical Trial"> 
                                    <span></span>
                                    <b>Clinical Trials</b>
                                </label>
                                
                                <!-- <label for="reviews" class="incluir">
                                    <input type="checkbox" name="selection[]" id="reviews" value="Reviews"> 
                                    <span></span>
                                    <b>Other</b>
                                </label> -->

                            </div>
                            
                        </div>
                        
                        <br/>

                        <?php if( $selectboxname ) : ?>

                            <button type="submit" class="btn btn-discover" id="js-discover-health-local">Search</button>

                            <button type="submit" class="btn btn-discover-network" id="js-discover-health">Search in the Doctorpedia network</button>

                        <?php else : ?>

                            <button type="submit" class="btn btn-discover full-width" id="js-discover-health">Doctorpedia Search</button>

                        <?php endif; ?>

                    </form>

                </div>
            
            </div>
    
        </section>

        <section class="large-container scroll-container discover-container d-none" id="js-discover-search-resources">

            <div class="final-results-sites">

                <div class="container final-results-sites__header">

                    <h3 id="js-var-to-search"></h3>

                </div>

                <div class="container" id="videos">
                    
                    <div class="slider-container d-none">
                    
                        <h4>Videos (<span id="js-count-playback"></span>)</h4>
                
                        <div id="js-playback" class="app-review-article slider-app-review d-flex flex-row flex-wrap <?php if ( wp_is_mobile() ) { echo 'justify-content-center'; } ?>"></div>
                    
                    </div>

                </div>

                <div class="p-relative" id="featured-apps">

                    <div class="background-white"></div>

                    <div class="container slider-container d-none">

                        <h4>Featured Apps ( <span id="js-count-featured-app"></span> )</h4>

                        <div id="js-featured-app" class="app-review-article slider-app-review d-flex flex-row flex-wrap mb-5 <?php if ( wp_is_mobile() ) { echo 'justify-content-center'; } ?>"></div>

                    </div>

                </div>
                
                <div class="p-relative" id="light-sites">
                
                    <div class="background-white"></div>
                
                    <div class="container slider-container d-none">
                    
                        <h4>

                            <span id="light-site-title"></span> (<span id="js-count-light-sites"></span>)
                            
                        </h4>

                        <div id="js-light-sites-header" class="app-review-article slider-app-review d-resources-header d-flex flex-row"></div>
                
                        <div id="js-light-sites-body" class="app-review-article slider-app-review d-flex flex-row flex-wrap <?php if ( wp_is_mobile() ) { echo 'justify-content-center'; } ?>"></div>
                
                    </div>
                
                </div>

                <div class="container" id="articles">
                    
                    <div class="slider-container">
                    
                        <h4>Articles (<span id="js-count-articles"></span>)</h4>
                
                        <div id="js-articles" class="app-review-article slider-app-review d-flex flex-row flex-wrap"></div>
                    
                    </div>

                </div>

                <div class="container" id="channels">
            
                    <div class="slider-container d-none">
                    
                        <h4>Channels (<span id="js-count-channels"></span>)</h4>
                
                        <div id="js-channels" class="app-review-article slider-app-review d-flex flex-row flex-wrap <?php if ( wp_is_mobile() ) { echo 'justify-content-center'; } ?>"></div>
                            
                    </div>

                </div>

                <div class="container" id="apps">

                    <div class="slider-container d-none">
                    
                        <h4>Mobile Apps (<span id="js-count-app"></span>)</h4>
                
                        <div id="js-app-reviews" class="app-review-article slider-app-review d-flex flex-row flex-wrap <?php if ( wp_is_mobile() ) { echo 'justify-content-center'; } ?>"></div>
                    
                    </div>

                </div>
                
                <div class="container">
                    
                    <div class="slider-container d-none">
                    
                        <h4>Other (<span id="js-count-reviews"></span>)</h4>
                
                        <div id="js-reviews" class="app-review-article slider-app-review d-flex flex-row flex-wrap <?php if ( wp_is_mobile() ) { echo 'justify-content-center'; } ?>"></div>
                            
                    </div>

                </div>

                <div style="position: relative">
                    
                    <div class="background-white"></div>
                    
                    <div class="slider-container container d-none">
                            
                        <h4>Other (<span id="js-count-resources"></span>)</h4>
                
                        <div id="js-resources-header" class="app-review-article slider-app-review d-resources-header d-flex flex-row"></div>
                
                        <div id="js-resources-body" class="app-review-article slider-app-review d-flex flex-row flex-wrap <?php if ( wp_is_mobile() ) { echo 'justify-content-center'; } ?>"></div>
                    
                    </div>

                </div>

            </div>

        </section>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">

        <script>
            function checkSubmit (e) {
                if(e && e.keyCode == 13) {
                    $('#js-sr-form-discover-health').submit();
                    $('#js-discover-health').addClass('loading hiddenBtn').removeClass('done');
                    $('#js-discover-health-local').addClass('loading hiddenBtn').removeClass('done');
                }
            }
        </script>

        <script src="<?php echo esc_url( home_url('/') ); ?>wp-content/themes/doctorpedia/vc-elements/search-resources/search-resources.js"></script>

        <!-- End Search Resources Module -->
        
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcSearchResources();

?>