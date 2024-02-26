<?php

function acfLoadSitesOptions( $field ) {

    $sites = array();

    $sites["Doctorpedia"] = "Doctorpedia";

    /* foreach ( get_sites( ['number' => 5000] ) as $site ) :

        switch_to_blog( $site->blog_id );

        $sites[ $site->blogname ] = $site->blogname;

        restore_current_blog();

    endforeach; */
	
    $field['choices'] = $sites;

    return $field;
}

add_filter('acf/load_field/key=field_5ed90b10f270e', 'acfLoadSitesOptions');