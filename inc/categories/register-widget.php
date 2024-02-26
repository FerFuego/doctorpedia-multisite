<?php
/* 
* Register Sidebar
*/
register_sidebar(array(
    'name'          => __( 'Slider Categories', 'doctorpedia' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
    'id'            => 'unique-sidebar-id', 
    'class'         => '',
    'description'   => '',
));