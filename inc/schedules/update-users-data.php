<?php
/*--------------------------------------------------
                    Schedule
---------------------------------------------------*/
require(dirname(__FILE__) . '/../../../../../wp-load.php');

/**
 * Doctorpedia Users Data
 * This class handles user data updates
 * Run through the server cronjob
 * */
class DP_Users_Data {

    static protected $instance = NULL;

    static public function load() {
        if ( empty( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        $this->custom_update_users();
    }

    /**
     * Get All usues and update the data
     * @return string status
     */
    public function custom_update_users() {
    
        $args = [ 'role' => 'blogger' ];
        $query = new WP_User_Query( $args );
        $experts = $query->get_results();

        if ( is_wp_error( $experts ) ) {
            $error_code = array_key_first( $experts->errors );
            $error_message = $experts->errors[$error_code][0];
            printf("Code %u: %s.", $error_code, $error_message);
        }
     
        if (!empty($experts) ) :
            foreach ($experts as $expert) :
    
                $user_id = ( $expert->ID ) ? $expert->ID : $expert['ID'];           
                update_user_meta($user_id, 'c_activity',    $this->getLastPostsByDate($user_id));
                update_user_meta($user_id, 'c_blogs',       $this->getCountPostsByPostType('blog', $user_id));
                update_user_meta($user_id, 'c_videos',      $this->getCountPostsByPostType('videos', $user_id));
                update_user_meta($user_id, 'c_articles',    $this->getCountPostsByPostType(['article','categories'], $user_id));
                update_user_meta($user_id, 'c_reviews',     $this->getCountPostsByPostType('user-reviews', $user_id));

            endforeach;

            echo 'Users successful updated';
        else :
            echo 'No users founds';
        endif;
    }
    
    /**
     * Get All posts by type and return sum of them
     * @return int
     */
    public function getCountPostsByPostType( $postType, $user_id ) {
    
        global $wp_query; 
    
        $args = [
            'post_type' => $postType,
            'author' => $user_id,
        ];
    
        $wp_query = new WP_Query( $args );
        $result = $wp_query->found_posts;
    
        return $result;
    }
    
    /**
     * Get the last post published by the user
     * @return strtotime
     */
    public function getLastPostsByDate( $user_id ) {
        
        $result = null;
    
        $args = [
            'post_type'   => ['videos','article','blog','user-reviews'],
            'author'      => $user_id,
            'post_status' => 'publish',
            'numberposts' => 1
        ];
    
        $recent_posts = wp_get_recent_posts($args);
    
        if ($recent_posts) :
            foreach( $recent_posts as $post_item ) :
                $result = strtotime($post_item['post_date']);
            endforeach;
        endif;
        
        return $result;
    }
}

DP_Users_Data::load();