<?php
/* Element Description: VC Alltopics*/
 
// Element Class 
class vcAlltopics extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_alltopics_mapping' ) );
        add_shortcode( 'vc_alltopics', array( $this, 'vc_alltopics_html' ) );
    }
     
    // Element Mapping
    public function vc_alltopics_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('All Topics', 'text-domain'),
                'base' => 'vc_alltopics',
                'description' => __('All Topics Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',     
                'params' => array(  
                    
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_alltopics_html( $atts ) {

         // Params extraction
        extract(
            shortcode_atts(
                array(), 
                $atts
            ) 
        );

        $loop = new WP_Query( array(
            'post_type' => array('video-library-category'),
            'orderby' => 'title',
            'order'   => 'ASC',
        ));
             
        return $this->BlockHTML($loop);
    } 

    public function BlockHTML($loop){ 
        ob_start(); ?>
        <!-- All Topics Module VC -->
        <script>
	        $(document).ready(function(){
                var contenido_fila;
                var coincidencias;
                var exp;
                $(".alphabet ul li").click(function(){
                    filtrar($(this).html());
                });
                
                //funcion que filtra por coincidencia
                function filtrar(cadena){
                    $("#topics div").each(function(){
                        $(this).removeClass("ocultar");
                        contenido_fila=$(this).find("h2 a").html();
                        if(contenido_fila.charAt(0) != cadena){
                            $(this).addClass("ocultar");	
                        }
                    });
                }
            });
        </script>
        <style type="text/css" media="screen">
            .ocultar{
                display: none;
            }
            .resaltar{
                background-color: yellow;
            }
        </style>
        <div class="container search-alphabet">
            <div class="header">
                <h1>Explore All Topics</h1>
                <svg width="31px" height="32px" viewBox="0 0 31 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round">
                        <g id="Desktop---Full-Nav-Bar" transform="translate(-1272.000000, -24.000000)" stroke="#df054e" stroke-width="2">
                            <g id="Top-Nav-Bar-Copy-6">
                                <g id="Maginfigying-Glass" transform="translate(1225.000000, 11.000000)">
                                    <circle id="Oval-2" cx="65" cy="26" r="12"></circle>
                                    <path d="M56.25,35.75 L48.6014707,43.3985293" id="Line-2" fill="#df054e"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </div>
            <div class="alphabet">
                <ul>
                    <li>A</li>
                    <li>B</li>
                    <li>C</li>
                    <li>D</li>
                    <li>E</li>
                    <li>F</li>
                    <li>G</li>
                    <li>H</li>
                    <li>I</li>
                    <li>J</li>
                    <li>K</li>
                    <li>L</li>
                    <li>M</li>
                    <li>N</li>
                    <li>O</li>
                    <li>P</li>
                    <li>Q</li>
                    <li>R</li>
                    <li>S</li>
                    <li>T</li>
                    <li>U</li>
                    <li>V</li>
                    <li>W</li>
                    <li>X</li>
                    <li>Y</li>
                    <li>Z</li>
                </ul>
            </div>    
            <div class="topics" id="topics">
            
            
            <?php
                $taxonomy = 'video-library-category';
                $terms = get_terms($taxonomy); // Get all terms of a taxonomy
                if ( $terms && !is_wp_error( $terms ) ) :
                ?>
                        <?php foreach ( $terms as $term ) { ?>
                            <div><h2><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></h2></div>
                        <?php } ?>
                    
                <?php endif;?>


            </div>
        </div>
        <!-- End All Topics Module VC -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcAlltopics();

?>