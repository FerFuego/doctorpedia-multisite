<?php
/* Element Description: VC videoPlaylist*/
 
// Element Class 
class vcvideoPlaylist extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_videoPlaylist_mapping' ) );
        add_shortcode( 'vc_videoPlaylist', array( $this, 'vc_videoPlaylist_html' ) );
    }
     
    // Element Mapping
    public function vc_videoPlaylist_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Video Playlist', 'text-domain'),
                'base' => 'vc_videoPlaylist',
                'description' => __('Video Playlist', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',            
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'holder' => 'span',
                        'class' => 'title-class',
                        'heading' => __( 'Subtitle', 'text-domain' ),
                        'param_name' => 'subtitle',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),    
                    array(
                        'type' => 'textfield',
                        'holder' => '',
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
                        'type' => 'textarea',
                        'holder' => '',
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
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background Image', 'text-domain' ),
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
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Background Color', 'text-domain' ),
                        'param_name' => 'bg_color',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => array(
                            __('',''),
                            __('White','White'),
                            __('Grey','Grey')
                        ),
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Video", "my-text-domain" ),
                        "param_name" => "link_video",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'span',
                        'class' => 'title-class',
                        'heading' => __( 'Playlist Details', 'text-domain' ),
                        'param_name' => 'details',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( 'Ej: 5 videos playlist (15:30)', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),    
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background Image', 'text-domain' ),
                        'param_name' => 'background_1',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title_1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title Section', 'text-domain' ),
                        'param_name' => 'subtitle_1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Video", "my-text-domain" ),
                        "param_name" => "link_video_1",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => '',
                        'class' => 'title-class',
                        'heading' => __( 'Description', 'text-domain' ),
                        'param_name' => 'description_1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background Image', 'text-domain' ),
                        'param_name' => 'background_2',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title_2',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title Section', 'text-domain' ),
                        'param_name' => 'subtitle_2',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Video", "my-text-domain" ),
                        "param_name" => "link_video_2",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => '',
                        'class' => 'title-class',
                        'heading' => __( 'Description', 'text-domain' ),
                        'param_name' => 'description_2',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background Image', 'text-domain' ),
                        'param_name' => 'background_3',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title_3',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title Section', 'text-domain' ),
                        'param_name' => 'subtitle_3',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Video", "my-text-domain" ),
                        "param_name" => "link_video_3",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => '',
                        'class' => 'title-class',
                        'heading' => __( 'Description', 'text-domain' ),
                        'param_name' => 'description_3',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background Image', 'text-domain' ),
                        'param_name' => 'background_4',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title_4',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title Section', 'text-domain' ),
                        'param_name' => 'subtitle_4',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Video", "my-text-domain" ),
                        "param_name" => "link_video_4",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => '',
                        'class' => 'title-class',
                        'heading' => __( 'Description', 'text-domain' ),
                        'param_name' => 'description_4',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background Image', 'text-domain' ),
                        'param_name' => 'background_5',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title_5',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title Section', 'text-domain' ),
                        'param_name' => 'subtitle_5',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Video", "my-text-domain" ),
                        "param_name" => "link_video_5",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => '',
                        'class' => 'title-class',
                        'heading' => __( 'Description', 'text-domain' ),
                        'param_name' => 'description_5',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background Image', 'text-domain' ),
                        'param_name' => 'background_6',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title_6',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title Section', 'text-domain' ),
                        'param_name' => 'subtitle_6',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Video", "my-text-domain" ),
                        "param_name" => "link_video_6",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => '',
                        'class' => 'title-class',
                        'heading' => __( 'Description', 'text-domain' ),
                        'param_name' => 'description_6',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background Image', 'text-domain' ),
                        'param_name' => 'background_7',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title_7',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title Section', 'text-domain' ),
                        'param_name' => 'subtitle_7',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Video", "my-text-domain" ),
                        "param_name" => "link_video_7",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => '',
                        'class' => 'title-class',
                        'heading' => __( 'Description', 'text-domain' ),
                        'param_name' => 'description_7',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background Image', 'text-domain' ),
                        'param_name' => 'background_8',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title_8',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title Section', 'text-domain' ),
                        'param_name' => 'subtitle_8',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Video", "my-text-domain" ),
                        "param_name" => "link_video_8",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => '',
                        'class' => 'title-class',
                        'heading' => __( 'Description', 'text-domain' ),
                        'param_name' => 'description_8',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background Image', 'text-domain' ),
                        'param_name' => 'background_9',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title_9',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title Section', 'text-domain' ),
                        'param_name' => 'subtitle_9',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Video", "my-text-domain" ),
                        "param_name" => "link_video_9",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => '',
                        'class' => 'title-class',
                        'heading' => __( 'Description', 'text-domain' ),
                        'param_name' => 'description_9',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background Image', 'text-domain' ),
                        'param_name' => 'background_10',
                        'value' => '',
                        'description' => __( '', 'text-domain' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => false,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title_10',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title Section', 'text-domain' ),
                        'param_name' => 'subtitle_10',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Video", "my-text-domain" ),
                        "param_name" => "link_video_10",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => '',
                        'class' => 'title-class',
                        'heading' => __( 'Description', 'text-domain' ),
                        'param_name' => 'description_10',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_videoPlaylist_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);
         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'subtitle' => '',
                    'title' => '',
                    'description' => '',
                    'background' => '',
                    'bg_color' => '',
                    'link_video' => '',
                    'title_1' => '',
                    'link_video_1' => '',
                    'details' => '',
                    'background_1' => '',
                    'description_1' => '',
                    'title_2' => '',
                    'link_video_2' => '',
                    'background_2' => '',
                    'description_2' => '',
                    'title_3' => '',
                    'link_video_3' => '',
                    'background_3' => '',
                    'description_3' => '',
                    'title_4' => '',
                    'link_video_4' => '',
                    'background_4' => '',
                    'description_4' => '',
                    'title_5' => '',
                    'link_video_5' => '',
                    'description_5' => '',
                    'background_5' => '',
                    'title_6' => '',
                    'link_video_6' => '',
                    'description_6' => '',
                    'background_6' => '',
                    'title_7' => '',
                    'link_video_7' => '',
                    'description_7' => '',
                    'background_7' => '',
                    'title_8' => '',
                    'link_video_8' => '',
                    'description_8' => '',
                    'background_8' => '',
                    'title_9' => '',
                    'link_video_9' => '',
                    'description_9' => '',
                    'background_9' => '',
                    'title_10' => '',
                    'link_video_10' => '',
                    'background_10' => '',
                    'description_10' => '',
                    'subtitle_1' => '',
                    'subtitle_2' => '',
                    'subtitle_3' => '',
                    'subtitle_4' => '',
                    'subtitle_5' => '',
                    'subtitle_6' => '',
                    'subtitle_7' => '',
                    'subtitle_8' => '',
                    'subtitle_9' => '',
                    'subtitle_10' => '',
                ), 
                $atts
            )
        );

        $image = wp_get_attachment_image_src($background, 'large');
        $image_1 = wp_get_attachment_image_src($background_1, 'medium');
        $image_2 = wp_get_attachment_image_src($background_2, 'medium');
        $image_3 = wp_get_attachment_image_src($background_3, 'medium');
        $image_4 = wp_get_attachment_image_src($background_4, 'medium');
        $image_5 = wp_get_attachment_image_src($background_5, 'medium');
        $image_6 = wp_get_attachment_image_src($background_6, 'medium');
        $image_7 = wp_get_attachment_image_src($background_7, 'medium');
        $image_8 = wp_get_attachment_image_src($background_8, 'medium');
        $image_9 = wp_get_attachment_image_src($background_9, 'medium');
        $image_10 = wp_get_attachment_image_src($background_10, 'medium');

        if($bg_color == 'Grey'){
            $bg_color = '#f2f2f2';
        }else{
            $bg_color = '#ffffff';
        }

        $rand = rand(999, 9999);
        
        return $this->BlockHTML($rand, $bg_color, $subtitle, $title, $description, $image, $image_1, $image_2, $image_3, $image_4, $image_5, $image_6, $image_7, $image_8, $image_9, $image_10, $link_video, $title_1, $link_video_1, $details, $description_1, $title_2, $link_video_2, $description_2, $title_3, $link_video_3, $description_3, $title_4, $link_video_4, $description_4, $title_5, $link_video_5, $description_5, $title_6, $link_video_6, $description_6, $title_7, $link_video_7, $description_7, $title_8, $link_video_8, $description_8, $title_9, $link_video_9, $description_9, $title_10, $link_video_10, $description_10, $subtitle_1, $subtitle_2, $subtitle_3, $subtitle_4, $subtitle_5, $subtitle_6, $subtitle_7, $subtitle_8, $subtitle_9, $subtitle_10);
    } 

    public function BlockHTML($rand, $bg_color, $subtitle, $title, $description, $image, $image_1, $image_2, $image_3, $image_4, $image_5, $image_6, $image_7, $image_8, $image_9, $image_10, $link_video, $title_1, $link_video_1, $details, $description_1, $title_2, $link_video_2, $description_2, $title_3, $link_video_3, $description_3, $title_4, $link_video_4, $description_4, $title_5, $link_video_5, $description_5, $title_6, $link_video_6, $description_6, $title_7, $link_video_7, $description_7, $title_8, $link_video_8, $description_8, $title_9, $link_video_9, $description_9, $title_10, $link_video_10, $description_10, $subtitle_1, $subtitle_2, $subtitle_3, $subtitle_4, $subtitle_5, $subtitle_6, $subtitle_7, $subtitle_8, $subtitle_9, $subtitle_10){ 
        ob_start(); ?>

        <!-- Video Playlist Module VC -->
        <div class="playlist-container" style="background-color: <?php echo $bg_color ?>">
            <div class="container">
                <div class="sponsors video-playlist <?php echo ( is_front_page() ) ? 'playlist-margin-cero' : 'playlist-margin-top'; ?>">
                    <div class="row">
                        <div id="description-playlist" class="description col-md-5 order-12 order-md-1">
                            <h1><?php echo $title ?></h1>
                            <p><?php echo $description ?></p>
                        </div>
                        <div class="col-md-7 order-1 order-md-12 video-bg">
                            <div class="video-module video-module-playlist">
                                <div class="video-wrapper-playlist">
                                    <iframe id="playlist_principal" class="video" src=<?php echo "$link_video"; ?> frameborder="0" allow="autoplay"></iframe>
                                </div>
                            
                                <div class="network-share-call-to-action d-none" id="js-share-call-to-action-playlist">
                                    <img class="icon-open icon-share-playlist"  src="<?php print IMAGES; ?>/icons/share-video.svg" alt="">
                                </div>

                                <div class="network-skip-intro d-none" id="js-skip-intro-playlist">
                                    <button class="skip-intro" id="js-skip-intro-playlist">Skip Intro</button>
                                </div>

                                <div class="network-share" id="js-network-share-playlist">
                                    <div class="network-share__social-media d-none" id="js-social-media-playlist">
                                        <img class="icon-close icon-close-playlist" id="js-close-share-playlist" src="<?php print IMAGES; ?>/icons/close-share.svg" alt="">
                                        <div class="network-share__social-media__content">
                                            <h3 class="text-white">Share This Video</h3>
                                            <hr>
                                            <?php echo do_shortcode('[easy-social-share]'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="video-placeholder video-placeholder-playlist" style="background-image:url(<?php echo $image[0] ?>)">
                                    <button class="play-video-btn">
                                        <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                                    </button>
                                </div>

                            </div>
                            <p class="playlist-text text-center text-md-left"><?php echo $details ?></p>
                        </div>
                    </div>
                    <div class="d-none d-md-block">                    
                        <hr>
                    </div>
                </div>
            </div>
            <div class="video-playlist-module-slider">
                <div class="container">
                    <div class="slider-container">

                        <?php if(!empty($link_video_5)): ?>
                            <img src="<?php echo IMAGES ?>/icons/prev.svg" class="prev prev_<?php echo $rand ?>">
                        <?php endif ?>

                        <div id="slider_video_playlist_<?php echo $rand ?>" class="slider_video_playlist slides slides_grid">

                            <?php if(!empty($link_video_1)): ?>
                                <div class="slider-single-item" id="video_slider_1">
                                    <div class="trim" style="background-image: url(<?php echo $image_1[0] ?>)">
                                        <div class="video" videourl="<?php echo $link_video_1 ?>" ></div>
                                        <button class="play-video-btn">
                                            <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                                        </button>
                                    </div>
                                    <div class="slider-single-item-content">
                                        <h2><?php echo $subtitle_1 ?></h2>
                                        <h1><?php echo $title_1 ?></h1>
                                        <p class="hidden"><?php echo $description_1 ?></p>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php if(!empty($link_video_2)): ?>
                                <div class="slider-single-item" id="video_slider_2">
                                    <div class="trim" style="background-image: url(<?php echo $image_2[0] ?>)">
                                        <div class="video" videourl="<?php echo $link_video_2 ?>"></div>
                                        <button class="play-video-btn">
                                            <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                                        </button>
                                    </div>
                                    <div class="slider-single-item-content">
                                        <h2><?php echo $subtitle_2 ?></h2>
                                        <h1><?php echo $title_2 ?></h1>
                                        <p class="hidden"><?php echo $description_2 ?></p>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php if(!empty($link_video_3)): ?>
                                <div class="slider-single-item" id="video_slider_3">
                                    <div class="trim" style="background-image: url(<?php echo $image_3[0] ?>)">
                                        <div class="video" videourl="<?php echo $link_video_3 ?>"></div>
                                        <button class="play-video-btn">
                                            <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                                        </button>
                                    </div>
                                    <div class="slider-single-item-content" id="<?php echo $link_video_3 ?>">
                                        <h2><?php echo $subtitle_3 ?></h2>
                                        <h1><?php echo $title_3 ?></h1>
                                        <p class="hidden"><?php echo $description_3 ?></p>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php if(!empty($link_video_4)): ?>
                                <div class="slider-single-item" id="video_slider_4">
                                    <div class="trim" style="background-image: url(<?php echo $image_4[0] ?>)">
                                        <div class="video" videourl="<?php echo $link_video_4 ?>" ></div>
                                        <button class="play-video-btn">
                                            <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                                        </button>
                                    </div>
                                    <div class="slider-single-item-content">                                    
                                        <h2><?php echo $subtitle_4 ?></h2>
                                        <h1 class="slider-single-title"><?php echo $title_4 ?></h1>
                                        <p class="hidden"><?php echo $description_4 ?></p>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php if(!empty($link_video_5)): ?>
                                <div class="slider-single-item" id="video_slider_5">
                                    <div class="trim" style="background-image: url(<?php echo $image_5[0] ?>)">
                                        <div class="video" videourl="<?php echo $link_video_5 ?>" ></div>
                                        <button class="play-video-btn">
                                            <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                                        </button>
                                    </div>
                                    <div class="slider-single-item-content">                                    
                                        <h2><?php echo $subtitle_5 ?></h2>
                                        <h1><?php echo $title_5 ?></h1>
                                        <p class="hidden"><?php echo $description_5 ?></p>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php if(!empty($link_video_6)): ?>
                                <div class="slider-single-item" id="video_slider_6">
                                    <div class="trim" style="background-image: url(<?php echo $image_6[0] ?>)">
                                        <div class="video" videourl="<?php echo $link_video_6 ?>" ></div>
                                        <button class="play-video-btn">
                                            <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                                        </button>
                                    </div>
                                    <div class="slider-single-item-content">                    
                                        <h2><?php echo $subtitle_6 ?></h2>
                                        <h1><?php echo $title_6 ?></h1>
                                        <p class="hidden"><?php echo $description_6 ?></p>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php if(!empty($link_video_7)): ?>
                                <div class="slider-single-item" id="video_slider_7">
                                    <div class="trim" style="background-image: url(<?php echo $image_7[0] ?>)">
                                        <div class="video" videourl="<?php echo $link_video_7 ?>" ></div>
                                        <button class="play-video-btn">
                                            <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                                        </button>
                                    </div>
                                    <div class="slider-single-item-content">                                    
                                        <h2><?php echo $subtitle_7 ?></h2>
                                        <h1><?php echo $title_7 ?></h1>
                                        <p class="hidden"><?php echo $description_7 ?></p>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php if(!empty($link_video_8)): ?>
                                <div class="slider-single-item" id="video_slider_8">
                                    <div class="trim" style="background-image: url(<?php echo $image_8[0] ?>)">
                                        <div class="video" videourl="<?php echo $link_video_8 ?>" ></div>
                                        <button class="play-video-btn">
                                            <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                                        </button>
                                    </div>
                                    <div class="slider-single-item-content">                                    
                                        <h2><?php echo $subtitle_8 ?></h2>
                                        <h1><?php echo $title_8 ?></h1>
                                        <p class="hidden"><?php echo $description_8 ?></p>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php if(!empty($link_video_9)): ?>
                                <div class="slider-single-item" id="video_slider_9">
                                    <div class="trim" style="background-image: url(<?php echo $image_9[0] ?>)">
                                        <div class="video" videourl="<?php echo $link_video_9 ?>" ></div>
                                        <button class="play-video-btn">
                                            <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                                        </button>
                                    </div>
                                    <div class="slider-single-item-content">                                    
                                        <h2><?php echo $subtitle_9 ?></h2>
                                        <h1><?php echo $title_9 ?></h1>
                                        <p class="hidden"><?php echo $description_9 ?></p>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php if(!empty($link_video_10)): ?>
                                <div class="slider-single-item" id="video_slider_10">
                                    <div class="trim" style="background-image: url('<?php echo $image_10[0] ?>)">
                                        <div class="video" videourl="<?php echo $link_video_10 ?>" ></div>
                                        <button class="play-video-btn">
                                            <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                                        </button>
                                    </div>
                                    <div class="slider-single-item-content">                                    
                                        <h2><?php echo $subtitle_10 ?></h2>
                                        <h1><?php echo $title_10 ?></h1>
                                        <p class="hidden"><?php echo $description_10 ?></p>
                                    </div>
                                </div>
                            <?php endif ?>
                        
                        </div>
                        
                        <?php if(!empty($link_video_5)): ?>
                            <img src="<?php echo IMAGES ?>/icons/next.svg" class="next next_<?php echo $rand ?>">
                        <?php endif ?>

                    </div>
                </div>    
            </div>
        </div>

        <script>   
            $(document).ready(function() {
                $("#slider_video_playlist_<?php echo $rand ?>").slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    prevArrow: $(".prev_<?php echo $rand ?>"),
                    nextArrow: $(".next_<?php echo $rand ?>"),
                    dots: false,
                    responsive: [
                        {
                        breakpoint: 768,
                        settings: "unslick",
                        }
                    ]
                });
            })

            $(window).on("resize", function() {
                $("#slider_video_playlist_<?php echo $rand ?>").not(".slick-initialized").slick("resize");
            });

            //$('.slider-single-item').css({'opacity':'0.6'});

        </script>

        <!-- <script src="https://player.vimeo.com/api/player.js"></script> -->
        <script>


            $("document").ready(function(){

                var iframe_playlist = $(".video-wrapper-playlist iframe")[0];
                var player = new Vimeo.Player(iframe_playlist);
                var i = 0;
                var skip = 5;

                var playlist = [

                    "<?php echo ($link_video_1 ) ? $link_video_1 : ''; ?>",
                    "<?php echo ($link_video_2 ) ? $link_video_2 : ''; ?>",
                    "<?php echo ($link_video_3 ) ? $link_video_3 : ''; ?>",
                    "<?php echo ($link_video_4 ) ? $link_video_4 : ''; ?>",
                    "<?php echo ($link_video_5 ) ? $link_video_5 : ''; ?>",
                    "<?php echo ($link_video_6 ) ? $link_video_6 : ''; ?>",
                    "<?php echo ($link_video_7 ) ? $link_video_7 : ''; ?>",
                    "<?php echo ($link_video_8 ) ? $link_video_8 : ''; ?>",
                    "<?php echo ($link_video_9 ) ? $link_video_9 : ''; ?>",
                    "<?php echo ($link_video_10 ) ? $link_video_10 : ''; ?>",

                ];

                $(".video-placeholder-playlist .play-video-btn").click(function(){
                    $(this).parent().fadeOut("slow");
                    $(this).parent().siblings(".video-wrapper-playlist").children( "iframe" ).click();
                
                    $('#js-share-call-to-action-playlist').removeClass('d-none');
                    $('#js-skip-intro-playlist').removeClass('d-none');
                    $("#js-skip-intro-playlist").css("display", "");
                    $('#js-skip-intro-playlist').show('slow');
                    
                    setTimeout(function() { player.play(); }, 1000);

                    $('#transcript').click(function(){
                        $('#tanscription').slideToggle('fast');
                        $('#transcript span').toggleClass('inactive');
                    });

                    var width = $('#playlist_principal').width();
                    $('#js-share-call-to-action-playlist').css({'width':width+'px'});
                    $('#js-skip-intro-playlist').css({'width':width+'px'});

                    $('#' + item).css({'opacity':'1'});

                })  

                // Slider Items
                $(".slider-single-item").click(function(){
                    var src = $(this).children(".trim").children(".video").attr("videourl");
                    var title = $(".slider-single-item-content", this).children("h1").clone();
                    var text = $(".slider-single-item-content", this).children("p").clone();
                    $("#playlist_principal").attr("src", src);
                    $("#description-playlist h1").replaceWith("<h1>"+ title[0].innerText+"</h1>");
                    $("#description-playlist p").replaceWith("<p>"+ text[0].innerText+"</p>");
                    $(".video-placeholder-playlist").fadeOut("slow");
                    
                    $(this).parent().siblings(".video-wrapper-playlist").children( "iframe" ).click();
                    setTimeout(function(){ player.play(); }, 1000);

                    $('#js-share-call-to-action-playlist').removeClass('d-none');
                    $('#js-skip-intro-playlist').removeClass('d-none');
                    $("#js-skip-intro-playlist").css("display", "");
                    var width = $('#playlist_principal').width();
                    $('#js-share-call-to-action-playlist').css({'width':width+'px'});
                    $('#js-skip-intro-playlist').css({'width':width+'px'});

                    //$('.slider-single-item').css({'opacity':'0.6'});
                    $(this).css({'opacity':'1'});
                })  

                $(".video-wrapper-playlist .close-video-btn").click(function(){
                    $(".video-placeholder-playlist").fadeIn("slow");
                    $( this ).parent().siblings( ".video-wrapper-playlist" ).children( "iframe" ).click();
                    player.pause();
                });

                //Btn pause
                $('.video-module .close-video-btn').click(function(){
                    $('.video-module .play-video-btn').parent().fadeIn('slow');
                    $('#video-trascript').hide('slow');
                    $( this ).parent().siblings( '.video-wrapper-section' ).children( 'iframe' ).click();
                    player.pause();
                });

                // open network-share 
                $('#js-share-call-to-action-playlist').click( function() {
                    $('#js-share-call-to-action-playlist').addClass('d-none');
                    $('#js-social-media-playlist').removeClass('d-none');
                    var width = $('#playlist_principal').width();
                    var height = $('#playlist_principal').height();
                    $('#js-social-media-playlist').css({'width':width+'px', 'height':height+'px'});
                    player.pause();
                });

                // close network-share
                $('#js-close-share-playlist').click( function() {
                    $('#js-social-media-playlist').addClass('d-none');
                    $('#js-share-call-to-action-playlist').removeClass('d-none');
                    player.play();
                });

                //Skip intro
                $('#js-skip-intro-playlist').click( function () {
                    //set time in 5 seg to skip intro
                    player.setCurrentTime( skip ).then( function (seconds) {
                        $('#js-skip-intro-playlist').hide('slow');
                    });
                });

                $('#js-social-media-playlist').click(function(e) {
                    if(e.target !== this) {
                        return;
                    }
                    $('#js-social-media-playlist').addClass('d-none');
                    $('#js-share-call-to-action-playlist').removeClass('d-none');
                    player.play();
                });

                player.on('play', function() {
                    $('#js-social-media-playlist').addClass('d-none');
                    $('#js-share-call-to-action-playlist').removeClass('d-none');
                });

                player.on('pause', function() {
                    $('#js-share-call-to-action-playlist').addClass('d-none');
                    $('#js-social-media-playlist').removeClass('d-none');
                    var width = $('#playlist_principal').width();
                    var height = $('#playlist_principal').height();
                    $('#js-social-media-playlist').css({'width':width+'px', 'height':height+'px'});
                });

                player.on('progress', function( data ) {
                    player.getCurrentTime().then(function(seconds) {
                        if( seconds > 5 ) {
                            $('#js-skip-intro-playlist').hide('slow');
                        }
                    });
                });

                //Finish function
                player.on('ended', function() {
                    if( playlist[i] ){
                        player.loadVideo(playlist[i]).then(function(id) {
                            $('#js-skip-intro-playlist').show('slow');
                            sliderItemsPlay( i );
                        }).catch(function(error) {
                            console.log( error.name);
                        });
                        setTimeout(function(){ player.play(); }, 1000);
                        i++;
                    }
                });

                function sliderItemsPlay( id ) {            
                    var title = $('#video_slider_' + id).children('.slider-single-item-content').children('h2').clone()
                    var description = $('#video_slider_' + id).children('.slider-single-item-content').children('p').clone();
                    $('#video_slider_' + id).css({'opacity':'1'});

                    $("#description-playlist h1").replaceWith("<h1>"+ title[0].innerText+"</h1>");
                    $("#description-playlist p").replaceWith("<p>"+ description[0].innerText+"</p>");

                    ('#js-share-call-to-action-playlist').removeClass('d-none');
                    $('#js-skip-intro-playlist').removeClass('d-none');
                    $("#js-skip-intro-playlist").css("display", "");
                    $('#js-skip-intro-playlist').show('slow');

                    var width = $('#playlist_principal').width();
                    $('#js-share-call-to-action-playlist').css({'width':width+'px'});
                    $('#js-skip-intro-playlist').css({'width':width+'px'});
                }

            })
        </script>
        <!-- End Video Playlist Module VC -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class

 
// Element Class Init
new vcvideoPlaylist();

?>
