<?php
/**
 * Start output buffering
 *
 * @return void
 */

function lwp_2629_user_edit_ob_start() {
    ob_start();
}
        
add_action( 'personal_options', 'lwp_2629_user_edit_ob_start' );

/**
 * Insert a new textinput for Nicename below the Username row on User/Profile page
 *
 * @param object $user The current WP_User object.
 * @return void
 */
function lwp_2629_insert_nicename_input( $user ) {
    $content = ob_get_clean();

    // Find the proper class, try to be future proof
    $regex = '/<tr(.*)class="(.*)\buser-user-login-wrap\b(.*)"(.*)>([\s\S]*?)<\/tr>/';

    // HTML code of the table row
    $nicename_row = sprintf(
        '<tr class="user-user-nicename-wrap"><th><label for="user_nicename">%1$s</label></th><td><input type="text" name="user_nicename" id="user_nicename" value="%2$s" class="regular-text" />' . "\n" . '<span class="description">%3$s</span></td></tr>',
        esc_html__( 'Nicename' ),
        esc_attr( $user->user_nicename ),
        esc_html__( 'Must be unique.' )
    );

    // Insert the row in the content
    echo preg_replace( $regex, '\0' . $nicename_row, $content );
}

add_action( 'show_user_profile', 'lwp_2629_insert_nicename_input' );
add_action( 'edit_user_profile', 'lwp_2629_insert_nicename_input' );

/**
 * Handle user profile updates
 *
 * @param object  &$errors Instance of WP_Error class.
 * @param boolean $update  True if updating an existing user, false if saving a new user.
 * @param object  &$user   User object for user being edited.
 * @return void
 */
function lwp_2629_profile_update( $errors, $update, $user ) {

    // Return if not update
    if ( !$update ) return;

    if ( empty( $_POST['user_nicename'] ) ) {
        $errors->add(
            'empty_nicename',
            sprintf(
                '<strong>%1$s</strong>: %2$s',
                esc_html__( 'Error' ),
                esc_html__( 'Please enter a Nicename.' )
            ),
            array( 'form-field' => 'user_nicename' )
        );
    } else {
        // Set the nicename
        $user->user_nicename = $_POST['user_nicename'];
    }
}

add_action( 'user_profile_update_errors', 'lwp_2629_profile_update', 10, 3 );


/** 
 * This function run after register
 */
function update_user_register_data( $user_id ) {
    global $wpdb;
    global $user;

    $user = get_user_by( 'id', $user_id );

    $user_slug = strtolower($user->first_name) . '-' . strtolower($user->last_name);

    //add_user_meta( $user_id, 'user_nicename', $user_slug );
    //update_user_meta( $user_id, 'user_nicename', $user_slug );

    wp_update_user( array(
        'ID' => $user_id,
        'user_nicename' => $user_slug
    ) );
    
    return true;
}

add_action( 'user_register', 'update_user_register_data', 10, 1 );

//change author/username base to users/userID
function change_author_permalinks() {
    global $wp_rewrite;
    // Change the value of the author permalink base to whatever you want here
    $wp_rewrite->author_base = 'doctor-profile';
    $wp_rewrite->flush_rules();
}

add_action('init','change_author_permalinks');

/**
 * Custom Function
 */
function get_user_logged_and_blogger() {

    if ( is_user_logged_in() ) {

        $user = wp_get_current_user();

        $user_roles = $user->roles;

        if ( in_array( 'blogger', $user_roles, true ) ) {
            return true;
        }
    }

    return false;
}

/**
 * Repost
 */
function repost() {

    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

        $post_id = $_POST['post_id'];
        $content = $_POST['content'];

        $post = get_post( $post_id, OBJECT ); 

        if ( ! $post )
            wp_die('Error creating blog');

        // insert article
        $data = array(
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
            'post_author'    => get_current_user_id(),
            'post_name'      => sanitize_title( $post->post_title ),
            'post_title'     => $post->post_title,
            'post_status'    => 'publish',
            'post_type'      => 'repost',
            'post_content'   => $content
        );

        $postId = wp_insert_post( sanitize_post( $data ) );

        update_post_meta($postId, 'share_blog', $post->ID );

        if ( ! $postId ) 
            wp_die( 'Error creating blog' );

        $result = [
            'status' => 'success',
            'message' => $post->post_title . 'Blog Compartido Correctamente!'
        ];

    } else {

        $result = [
            'status' => 'error',
            'message' => 'Ups! something went wrong. Try again.'
        ];

    }

    wp_send_json_success($result);
    
}
add_action( 'wp_ajax_repost', 'repost' );
add_action( 'wp_ajax_nopriv_repost', 'repost' );

/**
 * Get External metadata
 * @return array
 */
function get_external_data( $url ) {
    
    $doc = new DOMDocument();

    @$doc->loadHTML(file_get_contents($url));

    $res['title'] = $doc->getElementsByTagName('title')->item(0)->nodeValue;

    foreach ($doc->getElementsByTagName('meta') as $m){

        $tag = $m->getAttribute('name') ?: $m->getAttribute('property');

        if(in_array($tag,['description','keywords']) || strpos($tag,'og:')===0) $res[str_replace('og:','',$tag)] = $m->getAttribute('content');

    }

    $data = $specificTags ? array_intersect_key( $res, array_flip($specificTags) ) : $res;

    return $data;
}

/**
 * Search metadata of external sites
 * @return html
 */
function get_Site_OG (){

    $url = $_POST['publish_content'];
    $specificTags = 0;

    preg_match_all('/(https?|ssh|ftp):\/\/[^\s"]+/', $_POST['publish_content'], $url);
    $all_url = $url[0]; // Returns Array Of all Found URL's
    $url = $url[0][0]; // Gives the First URL in Array of URL's

    $data = get_external_data( $url );
    
    ob_start();

    if (!empty( $data['title'] ) ) : ?>
    
        <div class="external-link">

            <div class="external-link-image text-center" style="background-image: url(<?php echo $data['image']; ?>);"></div>

            <div class="external-link-content">

                <a href="<?php echo $data['url']; ?>">

                    <h2 class="author__content-title"><?php echo $data['title']; ?></h1>

                </a>

                <p><?php echo $data['description']; ?></p>

            </div>

        </div>

    <?php

        wp_send_json([
            'status' => 'success',
            'html' => ob_get_clean()
        ]);

    else :
        
        wp_send_json([
            'status' => 'failed',
            'html' => 'No content'
        ]);

    endif;
}
add_action('wp_ajax_nopriv_get_Site_OG', 'get_Site_OG');

add_action('wp_ajax_get_Site_OG', 'get_Site_OG');


/**
 * Publish repost
 * @return array
 */
function publish_external_blog() {

    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

        $content = $_POST['content'];

        if (trim($content) == '') {
            
            $result = [
                'status' => 'error',
                'message' => 'Ups! something went wrong. Try again.'
            ];
    
            wp_send_json_success($result);
        }
            
        preg_match_all('/(https?|ssh|ftp):\/\/[^\s"]+/', $content, $url);
        $all_url = $url[0]; // Returns Array Of all Found URL's
        $url = $url[0][0]; // Gives the First URL in Array of URL's

        $content = str_replace( $url , '<span class="text-muted mr-2">External link:</span><a href="'. $url .'" target="_blank">'. $url .' <i class="fas fa-external-link-alt ml-1"></i></a>', $content );

        // insert article
        $data = array(
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
            'post_author'    => get_current_user_id(),
            'post_name'      => sanitize_title( wp_get_current_user()->display_name ),
            'post_title'     => wp_get_current_user()->display_name,
            'post_status'    => 'publish',
            'post_type'      => 'repost',
            'post_content'   => $content
        );

        $postId = wp_insert_post( sanitize_post( $data ) );

        if ( $url && $_POST['preview'] !== '' )
            update_post_meta($postId, 'share_external_link', $url );

        if ( ! $postId ) 
            wp_die( 'Error creating blog' );

        $result = [
            'html' => '',
            'status' => 'success',
            'message' => 'Blog Publicado Correctamente!'
        ];

    } else {

        $result = [
            'status' => 'error',
            'message' => 'Ups! something went wrong. Try again.'
        ];

    }

    wp_send_json_success($result);

}
add_action('wp_ajax_nopriv_publish_external_blog', 'publish_external_blog');

add_action('wp_ajax_publish_external_blog', 'publish_external_blog');