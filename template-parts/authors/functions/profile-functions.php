<?php

/**
 * Clean all inputs
 */
function clean_input ( $str ) {
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

/**
 * Save Certifications
 */
add_action('wp_ajax_save_certifications', 'save_certifications');
add_action( 'wp_ajax_nopriv_save_certifications', 'save_certifications' );

function save_certifications() {

    try {
            
        $z = 0;
        $html = '';
        $user_id = wp_get_current_user()->ID;
        $bb_certification = json_decode( stripslashes( $_POST['user_certification'] ) );

        update_user_meta($user_id, '_bb_certification', 'field_5ee32323ewe51bf38b', false);
        update_user_meta($user_id, 'bb_certification', count( $bb_certification ), false);

        foreach( $bb_certification as $bb_cert ) {
            update_user_meta($user_id, '_bb_certification_'.$z.'_certification', 'field_5e332324a6bbf38c', false );
            update_user_meta($user_id, '_bb_certification_'.$z.'_subcertification', 'field_5e332324a675bf38c', false);
            update_user_meta($user_id, 'bb_certification_'.$z.'_certification', $bb_cert->certification, false );
            update_user_meta($user_id, 'bb_certification_'.$z.'_subcertification', $bb_cert->subcertification, false);
            $z++;
        }

        update_user_meta( $user_id, 'residency', $_POST['user_residency'] );
        update_user_meta( $user_id, 'credential', $_POST['user_credential'] );
        
        wp_send_json_success( [
            'data' => $html,
            'status' => 'success'
        ] );
    
    } catch ( Exception $e ) {

        wp_send_json_error( 'Exception captured: ', $e->getMessage(), "\n" );

    }

}


/**
 * Save Education
 */
add_action('wp_ajax_save_education', 'save_education');
add_action( 'wp_ajax_nopriv_save_education', 'save_education' );

function save_education () {

    try {
            
        $user_id = wp_get_current_user()->ID;

        $x = 0;
        $html = '';

        $bb_education = json_decode( stripslashes( $_POST['user_education'] ) );
        
        update_user_meta($user_id, '_bb_education', 'field_00102e51bf38b', false);
        update_user_meta($user_id, 'bb_education', count( $bb_education ), false);
        
        foreach( $bb_education as $bb_edu) {
            
            update_user_meta($user_id, '_bb_education_'.$x.'_education', 'field_5e39980911b0', false);
            update_user_meta($user_id, 'bb_education_'.$x.'_education', $bb_edu, false);
            $x++;

            $html = $bb_edu; //only for control
        }
        
        wp_send_json_success( [
            'data' => $html,
            'status' => 'success'
        ] );
    
    } catch ( Exception $e ) {

        wp_send_json_error( 'Exception captured: ', $e->getMessage(), "\n" );

    }

}


/**
 * Save Biography
 */
add_action('wp_ajax_save_biography', 'save_biography');
add_action( 'wp_ajax_nopriv_save_biography', 'save_biography' );

function save_biography () {

    try {
            
        $user_id = wp_get_current_user()->ID;

        update_user_meta( $user_id, 'biography', substr($_POST['biography'], 0, 500) );
        update_user_meta( $user_id, 'biography_link', $_POST['biography_link'] );

        $html = '<p>' . html_entity_decode(nl2br(str_replace('&nbsp;', ' ', get_the_author_meta('biography', $user_id)))) ;
        $html .= ' <a href="'.get_the_author_meta('biography_link', $user_id) .'" target="_blank">'. get_the_author_meta('biography_link', $user_id) .'</a>';
        $html .= '</p>';
        
        wp_send_json_success( [
            'data' => $html,
            'status' => 'success'
        ] );
    
    } catch ( Exception $e ) {

        wp_send_json_error( 'Exception captured: ', $e->getMessage(), "\n" );

    }

}

/**
 * Save Location
 */
add_action('wp_ajax_save_location', 'save_location');
add_action( 'wp_ajax_nopriv_save_location', 'save_location' );

function save_location () {

    try {
            
        $user_id = wp_get_current_user()->ID;

        $field_name = "field_5e33292cb4321";
        $value = array(
            "address" => $_POST['clinic_location'], 
            "lat" => $_POST['clinic_lat'], 
            "lng" => $_POST['clinic_lng'], 
            "zoom" => 16
        );
        
        update_user_meta($user_id, $field_name, $value);
        update_user_meta($user_id, 'location', $value);
        update_user_meta($user_id, '_location', $field_name);
        update_user_meta($user_id, 'clinic_name', clean_input( $_POST['clinic_name'] ) );
        update_user_meta($user_id, 'clinic_email', clean_input( $_POST['clinic_email'] ) );
        update_user_meta($user_id, 'clinic_open', clean_input( $_POST['clinic_open'] ) );
        update_user_meta($user_id, 'clinic_phone', clean_input( $_POST['clinic_phone'] ) );
        update_user_meta($user_id, 'clinic_web', clean_input( $_POST['clinic_web'] ) );
        update_user_meta($user_id, 'clinic_appointment', clean_input( $_POST['clinic_appointment'] ) );
        update_user_meta($user_id, 'city', clean_input( $_POST['city'] ) );
        update_user_meta($user_id, 'state', clean_input( $_POST['state'] ) );
        update_user_meta($user_id, 'country', clean_input( $_POST['country'] ) );
        
        $html = '';
        
        wp_send_json_success( [
            'data' => $html,
            'status' => 'success'
        ] );
    
    } catch ( Exception $e ) {

        wp_send_json_error( 'Exception captured: ', $e->getMessage(), "\n" );

    }

}

/**
 * Validate user Profile
 */
function validate_user ($author_id) {

    if ( wp_get_current_user()->ID == $author_id ) {
        return true;
    }
    return false;
}

/**
 * Delete Post
 */
add_action('wp_ajax_delete_post', 'delete_post');
add_action( 'wp_ajax_nopriv_delete_post', 'delete_post' );
function delete_post () {

    wp_delete_post( clean_input( $_POST['post_id'] ), true);

    wp_send_json_success( [
        'status' => 'success'
    ] );
}

/**
 * Feature Post
 */
add_action('wp_ajax_feature_post', 'feature_post');
add_action( 'wp_ajax_nopriv_feature_post', 'feature_post' );
function feature_post () {

    $user_id = wp_get_current_user()->ID;

    update_user_meta($user_id, 'feature_article', clean_input( $_POST['post_id'] ) );

    wp_send_json_success( [
        'status' => 'success'
    ] );
}

/**
 * Save Area of Expertise
 */
add_action('wp_ajax_save_expertise', 'save_expertise');
add_action( 'wp_ajax_nopriv_save_expertise', 'save_expertise' );

function save_expertise () {

    try {
            
        $user_id = wp_get_current_user()->ID;

        $x = 0;
        $html = '';

        $bb_expertise = json_decode( stripslashes( $_POST['user_expertise'] ) );
        
        update_user_meta($user_id, '_bb_expertise', 'field_00102e51bareaf38b', false);
        update_user_meta($user_id, 'bb_expertise', count( $bb_expertise ), false);
        
        foreach( $bb_expertise as $bb_exp) {
            
            update_user_meta($user_id, '_bb_expertise_'.$x.'_expertise', 'field_5e39980area911b0', false);
            update_user_meta($user_id, 'bb_expertise_'.$x.'_expertise', $bb_exp, false);
            $x++;

            $html = $bb_exp; //only for control
        }
        
        wp_send_json_success( [
            'data' => $html,
            'status' => 'success'
        ] );
    
    } catch ( Exception $e ) {

        wp_send_json_error( 'Exception captured: ', $e->getMessage(), "\n" );

    }

}

/**
 * Validar user type Blogger
 */
function validate_blogger ($author_id) {

    $user = get_user_by( 'id', $author_id );
    $user_roles = $user->roles;
    
    // check if user is blogger
    if ( in_array( 'blogger', $user_roles, true ) ) {
        
        // check if current user is Admin
        if (in_array('administrator', wp_get_current_user()->roles)) {
            return true;
        }
        
        // check if is current user
        if ($author_id == wp_get_current_user()->ID) {
            return true;
        }
        
        $unactiveA = @get_user_meta($user->ID, 'hide_dd', true);
        $unactiveB = @get_user_meta($user->ID, 'hide_dd', true)[0];
        
        // check if user in showing
        if ($unactiveA == 'check' || $unactiveB == 'check') {
            return false;
        }
        return true;
    }

    return false;
}