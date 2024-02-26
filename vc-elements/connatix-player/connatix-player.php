<?php
/* Element Description: VC ConnatixPlayer*/
 
// Element Class 
class vcConnatixPlayer extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_connatixPlayer_mapping' ) );
        add_shortcode( 'vc_connatixPlayer', array( $this, 'vc_connatixPlayer_html' ) );
    }
     
    // Element Mapping
    public function vc_connatixPlayer_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Connatix Player', 'text-domain'),
                'base' => 'vc_connatixPlayer',
                'description' => __('Connatix Player Module', 'text-domain'), 
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
                        'weight' => 0,
                        'group' => 'General',
                    ),
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_connatixPlayer_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);
         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'   => '',
                ), 
                $atts
            )
        );
        
        return $this->BlockHTML($title);
         
    } 

    public function BlockHTML($title) { 
        ob_start(); ?>
        <!-- Connatix Player Module VC -->
        <div class="container">
            <div class="body justify-content-start connatix-container">
                <h2 class="title align-self-start"><?php echo $title ; ?></h2>
                    <script>
                        !function(n){if(!window.cnx){window.cnx={},window.cnx.cmd=[];var t=n.createElement('iframe');t.display='none',t.onload=function(){var n=t.contentWindow.document;c=n.createElement('script'),c.src='//cd.connatix.com/connatix.player.js',c.setAttribute('async','1'),c.setAttribute('type','text/javascript'),n.body.appendChild(c)},n.head.appendChild(t)}}(document);
                    </script>
                    <script id="862151eebb95410687f16a66cd812619">
                        cnx.cmd.push(function() {
                            cnx({
                                playerId: '6b100eca-9dd9-47b3-82bf-98bac07b59cc',
                                playlistId: '08d706e4-c4c7-678d-38a3-942586c59c68'
                            }).render('862151eebb95410687f16a66cd812619');
                        });
                    </script>
            </div>
        </div>
        <!-- End Connatix Player Module VC -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcConnatixPlayer();

?>