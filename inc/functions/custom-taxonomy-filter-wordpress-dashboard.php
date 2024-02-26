<?php 
/*------------------------------------*\
    Custom Taxonomies Filter WP Dash
\*------------------------------------*/

function filter_cars_by_taxonomies( $post_type, $which ) {

	// Apply this only on a specific post type
	if ( 'video-library' !== $post_type )
		return;

	// A list of taxonomy slugs to filter by
	$taxonomies = array( 'video-library-category' );

	foreach ( $taxonomies as $taxonomy_slug ) {

		// Retrieve taxonomy data
		$taxonomy_obj = get_taxonomy( $taxonomy_slug );
		$taxonomy_name = $taxonomy_obj->labels->name;

		// Retrieve taxonomy terms
		$terms = get_terms( $taxonomy_slug );

		// Display filter HTML
		echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
		echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
		foreach ( $terms as $term ) {
			printf(
				'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
				$term->slug,
				( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
				$term->name,
				$term->count
			);
		}
		echo '</select>';
	}

}
add_action( 'restrict_manage_posts', 'filter_cars_by_taxonomies' , 10, 2); 


function filter_reviews_by_taxonomies( $post_type, $which ) {

	// Apply this only on a specific post type
	if ( 'reviews' !== $post_type )
		return;
	
	// A list of taxonomy slugs to filter by
	$taxonomies = array( 'reviews-category' );
	
	foreach ( $taxonomies as $taxonomy_slug ) {
	
		// Retrieve taxonomy data
		$taxonomy_obj = get_taxonomy( $taxonomy_slug );
		$taxonomy_name = $taxonomy_obj->labels->name;
	
		// Retrieve taxonomy terms
		$terms = get_terms( $taxonomy_slug );
	
		// Display filter HTML
		echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
		echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
		foreach ( $terms as $term ) {
			printf(
				'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
				$term->slug,
				( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
				$term->name,
				$term->count
			);
		}
		echo '</select>';
	}
	
}
add_action( 'restrict_manage_posts', 'filter_reviews_by_taxonomies' , 10, 2); 


/*--------------------------------------------------*\
			Add Order by Registered Column
\*--------------------------------------------------*/

/**
 * Registers column for display
 */
add_filter( 'manage_users_columns', 'wpse209591_users_columns');
function wpse209591_users_columns( $columns ) {
    $columns['doctor_directory'] = _x( 'Doctor Directory', 'user', 'your-text-domain' );
    $columns['registerdate'] = _x( 'Registered', 'user', 'your-text-domain' );
    return $columns;
}

/**
 * Handles the registered date column output.
 * 
 * This uses the same code as column_registered, which is why
 * the date isn't filterable.
 *
 * @global string $mode
 */
add_action( 'manage_users_custom_column', 'wpse209591_users_custom_column', 10, 3);
function wpse209591_users_custom_column( $value, $column_name, $user_id ) {

    global $mode;
	$mode = empty( $_REQUEST['mode'] ) ? 'list' : $_REQUEST['mode'];
	
	switch ( $column_name ) {
		case 'doctor_directory':
			$user_meta = get_userdata($user_id);
			$user_roles = $user_meta->roles;

			if (in_array('blogger', $user_roles)) {
				return (get_user_meta( $user_id, 'hide_dd', true )) ? '<span style="color: red; font-weight:bold;">Hiding</span>' : '<span style="color: green; font-weight:bold;">Showing</span>';
			}
			
			return '<span style="color: red; font-weight:bold;">Hiding</span>';

		break;
		case 'menu_order' :
			return '<input type="number" name="menu_order" onchange="goUpdateOrder(this, '.$user_id.')" value="'. get_user_by('id', $user_id)->user_order . '" style="width:100px">';
		break;
		case 'registerdate':
			$user = get_userdata( $user_id );

			if ( is_multisite() && ( 'list' == $mode ) ) {
				$formated_date = __( 'Y/m/d' );
			} else {
				$formated_date = __( 'Y/m/d g:i:s a' );
			}

			$registered   = strtotime( get_date_from_gmt( $user->user_registered ) );
			$registerdate = '<span>'. date_i18n( $formated_date, $registered ) .'</span>' ;

			return $registerdate;
		break;
    }
}

/**
 * Makes the column sortable
 */
add_filter( 'manage_users_sortable_columns', 'wpse209591_users_sortable_columns' );
function wpse209591_users_sortable_columns( $columns ) {

    $custom = array(
        // meta column id => sortby value used in query
		'registerdate' => 'registered',
    );

    return wp_parse_args( $custom, $columns );
}

/**
 * Calculate the order if we sort by date.
 *
 */
add_filter( 'request', 'wpse209591_users_orderby_column' );
function wpse209591_users_orderby_column( $vars ) {

    if ( isset( $vars['orderby'] ) && 'registerdate' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'registerdate',
            'orderby' => 'meta_value'
        ) );
    }

    return $vars;
}