<?php
/* Element Description: VC UtilitiesTools*/
 
// Element Class 
class vcUtilitiesTools extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_utilitiesTools_mapping' ) );
        add_shortcode( 'vc_utilitiesTools', array( $this, 'vc_utilitiesTools_html' ) );
    }
     
    // Element Mapping
    public function vc_utilitiesTools_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Utilities & Tools', 'text-domain'),
                'base' => 'vc_utilitiesTools',
                'description' => __('Utilities & Tools Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',  
                'params' => array(
                    array(
                        'type'        => 'checkbox',
                        'heading'     => __(''),
                        'param_name'  => 'selectboxname',
                        'admin_label' => false,
                        'value'       => array(
                            'Hide title module'=>'hide',
                        ),
                        'std' => ' ',
                        'description' => __(''),
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background', 'text-domain' ),
                        'param_name' => 'image_1',
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
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'title_1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),                                       
                    array(
                        'type' => 'textarea',
                        'holder' => 'div',
                        'class' => 'text-class',
                        'heading' => __( 'Text', 'text-domain' ),
                        'param_name' => 'text_1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Page", "my-text-domain" ),
                        "param_name" => "link_page_1",
                        "value" => '', 
                        "description" => __( "", "my-text-domain" ),
                        'group' => 'General',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Text Button Link", "my-text-domain" ),
                        "param_name" => "text_link_1",
                        "value" => '', 
                        "description" => __( "", "my-text-domain" ),
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background', 'text-domain' ),
                        'param_name' => 'image_2',
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
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'title_2',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),                                       
                    array(
                        'type' => 'textarea',
                        'holder' => 'div',
                        'class' => 'text-class',
                        'heading' => __( 'Text', 'text-domain' ),
                        'param_name' => 'text_2',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Page", "my-text-domain" ),
                        "param_name" => "link_page_2",
                        "value" => '', 
                        "description" => __( "", "my-text-domain" ),
                        'group' => 'General',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Text Button Link", "my-text-domain" ),
                        "param_name" => "text_link_2",
                        "value" => '', 
                        "description" => __( "", "my-text-domain" ),
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background', 'text-domain' ),
                        'param_name' => 'image_3',
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
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'title_3',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),                                       
                    array(
                        'type' => 'textarea',
                        'holder' => 'div',
                        'class' => 'text-class',
                        'heading' => __( 'Text', 'text-domain' ),
                        'param_name' => 'text_3',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Page", "my-text-domain" ),
                        "param_name" => "link_page_3",
                        "value" => '', 
                        "description" => __( "", "my-text-domain" ),
                        'group' => 'General',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Text Button Link", "my-text-domain" ),
                        "param_name" => "text_link_3",
                        "value" => '', 
                        "description" => __( "", "my-text-domain" ),
                        'group' => 'General',
                    ),
                )   
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_utilitiesTools_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        extract(
            shortcode_atts(
                array(
                    'selectboxname' => '',
                    'image_1' => '',
                    'title_1' => '',
                    'text_1' => '',
                    'link_page_1' => '',
                    'text_link_1' => '',
                    'image_2' => '',
                    'title_2' => '',
                    'text_2' => '',
                    'link_page_2' => '',
                    'text_link_2' => '',
                    'image_3' => '',
                    'title_3' => '',
                    'text_3' => '',
                    'link_page_3' => '',
                    'text_link_3' => '',
                ),$atts
            )
        );

        $image_1 = wp_get_attachment_image_src($image_1, 'full');
        $image_2 = wp_get_attachment_image_src($image_2, 'full');
        $image_3 = wp_get_attachment_image_src($image_3, 'full');

        return $this->BlockHTML($selectboxname, $image_1, $title_1, $text_1, $link_page_1, $text_link_1, $image_2, $title_2, $text_2, $link_page_2, $text_link_2, $image_3, $title_3, $text_3, $link_page_3, $text_link_3);
    } 

    public function BlockHTML($selectboxname, $image_1, $title_1, $text_1, $link_page_1, $text_link_1, $image_2, $title_2, $text_2, $link_page_2, $text_link_2, $image_3, $title_3, $text_3, $link_page_3, $text_link_3) { 
        ob_start(); ?>

        <!-- Utilities Module VC -->

        <?php 
            $list_resources = array(
                [   
                    'image' => $image_1[0],
                    'title' => $title_1,
                    'text' => $text_1,
                    'link_page' => $link_page_1,
                    'text-link' => $text_link_1
                ],
                [
                    'image' => $image_2[0],
                    'title' => $title_2,
                    'text' => $text_2,
                    'link_page' => $link_page_2,
                    'text-link' => $text_link_2
                ],
                [
                    'image' => $image_3[0],
                    'title' => $title_3,
                    'text' => $text_3,
                    'link_page' => $link_page_3,
                    'text-link' => $text_link_3
                ]
            );

            if(empty($list_resources[2]['title'])) {
                $cant_resources = 2;
                $nro_col_md = 6;
                $content_margin = 'two-col';
            } else {
                $cant_resources = 3;
                $nro_col_md = 4;
                $content_margin = 'tree-col';
            }

        ?>

        <div class="utilities <?php echo ( $selectboxname ) ? 'bg-white' : ''; ?>"> 

            <?php if ( ! $selectboxname ) : ?>

                <h2 class="text-center title-utilities">Why Doctorpedia?<br>Understand the Doctorpedia&reg; Difference.</h2> 

            <?php endif; ?>
 
            <div class="container <?php echo ( ! $selectboxname ) ? 'utilities-width' : ''; ?> <?php echo ( $selectboxname ) ? 'mt-5' : ''; ?>">

                <div class="row text-center">
                
                    <?php for ($i=0; $i < $cant_resources ; $i++) : ?>

                        <?php $display_left = ($i != ($cant_resources - 1)) ? 'left' : ''; ?>

                        <div class="col-md-<?php echo $nro_col_md ?> <?php echo $display_left ?> order-10 order-md-1 col-xs-12 <?php echo ( $selectboxname ) ? 'pt-4' : ''; ?>">

                            <div class="content fix-margin-<?php echo $content_margin ?>">

                                <div class="header">

                                    <img src="<?php echo $list_resources[$i]['image'] ?>" alt="">

                                </div>

                                <div class="body">

                                    <h2><?php echo $list_resources[$i]['title'] ?></h2>

                                    <p><?php echo $list_resources[$i]['text'] ?></p>

                                </div>

                                <?php if( !empty ($list_resources[$i]['link_page']) ) :  ?>

                                    <div class="footer">

                                        <a href="<?php echo $list_resources[$i]['link_page'] ?>"><?php echo $list_resources[$i]['text-link'] ?></a>

                                    </div>

                                <?php endif ?>

                            </div>

                        </div>

                    <?php endfor; ?>

                    <?php if ( ! $selectboxname ) : ?>

                        <div class="col-12 order-12 border-utilities"></div>

                    <?php endif; ?>

                </div>

            </div>

        </div>
        <!-- End Utilities Module VC -->

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcUtilitiesTools();

?>