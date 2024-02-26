<?php
/**
 * Processing of the request of Doctor Directory Page
 * @return json
 */
add_action('wp_ajax_searchDoctorDirectory', 'searchDoctorDirectory');
add_action( 'wp_ajax_nopriv_searchDoctorDirectory', 'searchDoctorDirectory' );

function searchDoctorDirectory () {

    $status = 'Fail';
    $html = '';
    $x = 0;
    $paginator = '';
    $sortBy = $_POST['sortBy'];
    $specialty = $_POST['specialty'];
    $expertise = $_POST['expertise'];
    $current_page = $_POST['current_page'] ? (int) $_POST['current_page'] : 1;
    $users_per_page = 20;

    remove_filter( 'pre_user_query', 'alter_user_search' );

    $args = [
        'role' => 'blogger',
        'orderby' => ($sortBy == 'last_name') ? 'meta_value' : 'meta_value_num',
        'meta_key' => $sortBy,
        'number' => $users_per_page,
        'paged' => $current_page,
        'order' => ($sortBy == 'last_name') ? 'ASC' : 'DESC',
        'meta_query' => getmetaQuery($specialty, $expertise, $sortBy),
    ];
    $query = new WP_User_Query( $args );
    $experts = $query->get_results();
 
    if (!empty($experts) ) :

        $status = 'success';
        $total_users = $query->get_total();
        $num_pages = ceil($total_users / $users_per_page);

        //--------------------
        // Doctors Cards
        //--------------------
        foreach ($experts as $expert) : $x++;
            ob_start();
            set_query_var( 'x', $x );
            set_query_var( 'user', $expert );
            get_template_part( 'partials/expert-card' );
            $html .= ob_get_contents();
            ob_end_clean();
        endforeach;

        //--------------------
        // Paginator
        //--------------------
        ob_start();
        set_query_var( 'num_pages', $num_pages );
        set_query_var( 'current_page', $current_page );
        get_template_part( 'partials/experts-paginator' );
        $paginator .= ob_get_contents();
        ob_end_clean();

    else :
        $html = '<h2 class="mb-5 pb-5">No experts found</h2>'; 
    endif;
 
    wp_send_json_success( [
        'status' => $query,
        'html' => $html,
        'paginator' => $paginator
    ] );
}

/**
 * Filter By Metas
 */
function getmetaQuery($specialty, $expertise, $sortBy) {
    return array(
        'relation' => 'AND',
        array(
            'relation' => 'OR',
            array(
                'key' => 'hide_dd',
                'value' => 'check',
                'compare' => 'NOT LIKE'
            ),
            array(
                'key' => 'hide_dd',
                'compare' => 'NOT EXISTS'
            ),
        ),
        sortByQuery($sortBy),
        specialtyQuery($specialty),
        expertiseQuery($expertise),
    );
}

/**
 * Hide Experts without posts
 */
function sortByQuery($sortBy) {
    if ($sortBy && $sortBy !== 'last_name') {
        return array(
            'relation' => 'AND',
            array(
                'key' => $sortBy,
                'value' => 0,
                'compare' => '>'
            )
        );
    }
}

/**
 * Filter by Specialty
 */
function specialtyQuery($specialty) {
    if ($specialty) {
        return array(
            'relation' => 'OR',
            array(
                'key' => 'bb_specialties_0_specialty',
                'value' => $specialty,
                'compare' => '='
            ),
            array(
                'key' => 'bb_specialties_1_specialty',
                'value' => $specialty,
                'compare' => '='
            ),
            array(
                'key' => 'bb_specialties_2_specialty',
                'value' => $specialty,
                'compare' => '='
            ),
            array(
                'key' => 'bb_specialties_3_specialty',
                'value' => $specialty,
                'compare' => '='
            ),
            array(
                'key' => 'bb_specialties_4_specialty',
                'value' => $specialty,
                'compare' => '='
            ),
            array(
                'key' => 'bb_specialties_5_specialty',
                'value' => $specialty,
                'compare' => '='
            ),
        );
    }
}

/**
 * Filter by Areas of Expertises
 */
function expertiseQuery($expertise) {
    if ($expertise) {
        return array(
            'relation' => 'OR',
            array(
                'key' => 'bb_expertise_0_expertise',
                'value' => $expertise,
                'compare' => '='
            ),
            array(
                'key' => 'bb_expertise_1_expertise',
                'value' => $expertise,
                'compare' => '='
            ),
            array(
                'key' => 'bb_expertise_2_expertise',
                'value' => $expertise,
                'compare' => '='
            ),
            array(
                'key' => 'bb_expertise_3_expertise',
                'value' => $expertise,
                'compare' => '='
            ),
            array(
                'key' => 'bb_expertise_4_expertise',
                'value' => $expertise,
                'compare' => '='
            ),
            array(
                'key' => 'bb_expertise_5_expertise',
                'value' => $expertise,
                'compare' => '='
            ),
        );
    }
}

/**
 * Return Experts, Specialties and Areas of Expertises
 */
function getExpertsDD() {

    global $wpdb;

    $specialties = [];

    $experts = $wpdb->get_results("SELECT DISTINCT $wpdb->users.ID, $wpdb->users.display_name
        FROM $wpdb->users 
        LEFT JOIN $wpdb->usermeta ON ( $wpdb->users.ID = $wpdb->usermeta.user_id )
        LEFT JOIN $wpdb->usermeta AS mt1 ON ( $wpdb->users.ID = mt1.user_id ) 
        LEFT JOIN $wpdb->usermeta AS mt2 ON ( $wpdb->users.ID = mt2.user_id ) 
        WHERE 1=1
        AND ($wpdb->usermeta.meta_key = 'first_name')
        AND ((mt1.meta_key = 'hide_dd' AND mt1.meta_value NOT LIKE '%check%' ) OR mt1.user_id IS NULL) 
        AND (mt2.meta_key = '{$wpdb->prefix}capabilities' AND mt2.meta_value LIKE '%\"blogger\"%' )
        ORDER BY $wpdb->usermeta.meta_value ASC", OBJECT );
 
    if (!empty($experts) ) {
        foreach ($experts as $expert) :
            $areas[] = trim( @get_field('bb_expertise', 'user_' . $expert->ID)[0]['expertise'] );
            $areas[] = trim( @get_field('bb_expertise', 'user_' . $expert->ID)[1]['expertise'] );
            $areas[] = trim( @get_field('bb_expertise', 'user_' . $expert->ID)[2]['expertise'] );
            $areas[] = trim( @get_field('bb_expertise', 'user_' . $expert->ID)[3]['expertise'] );
            $areas[] = trim( @get_field('bb_expertise', 'user_' . $expert->ID)[4]['expertise'] );

            $specialties[] = trim( @get_field('bb_specialties', 'user_' . $expert->ID)[0]['specialty'] );
            $specialties[] = trim( @get_field('bb_specialties', 'user_' . $expert->ID)[1]['specialty'] );
            $specialties[] = trim( @get_field('bb_specialties', 'user_' . $expert->ID)[2]['specialty'] );
            $specialties[] = trim( @get_field('bb_specialties', 'user_' . $expert->ID)[3]['specialty'] );
            $specialties[] = trim( @get_field('bb_specialties', 'user_' . $expert->ID)[4]['specialty'] );
        endforeach;
    }
    
    //remove empties and repeated specialties
    $areas = array_unique(array_filter($areas));
    $specialties = array_unique(array_filter($specialties)); 

    sort($areas);
    sort($specialties);

    return [
        'experts' => $experts,
        'areas' => $areas,
        'specialties' => $specialties
    ];
}

/**
 * Processing of the request of Doctor Directory Page
 * @return json
 */
add_action('wp_ajax_filterDoctorDirectory', 'filterDoctorDirectory');
add_action('wp_ajax_nopriv_filterDoctorDirectory', 'filterDoctorDirectory' );

function filterDoctorDirectory () {

    $expert = get_user_by('id', $_POST['expert_id']);
 
    if (!empty($expert) ) :
        //--------------------
        // Doctors Cards
        //--------------------       
        ob_start();
        set_query_var( 'x', 1 );
        set_query_var( 'user', $expert );
        get_template_part( 'partials/expert-card' );
        $html = ob_get_contents();
        ob_end_clean();

        //--------------------
        // Paginator
        //--------------------
        ob_start();
        set_query_var( 'num_pages', 1 );
        set_query_var( 'current_page', 1 );
        get_template_part( 'partials/experts-paginator' );
        $paginator = ob_get_contents();
        ob_end_clean();

    else :
        $html = '<h2 class="mb-5 pb-5">No expert found</h2>'; 
    endif;
 
    wp_send_json_success( [
        'html' => $html,
        'paginator' => $paginator
    ] );
}