<?php
/**
 * Menu filtering to add in our extra content to main navigation
 * mega menu for desktop
 * additional links for mobile
 * wrapping mega menu class
 */

class DoctorpediaMenu {

	public function __construct(){
		add_filter( 'walker_nav_menu_start_el', [ $this, 'mega_menu_contents_conditions' ], 20, 4 );
		add_filter( 'walker_nav_menu_start_el', [ $this, 'mega_menu_contents_channels' ], 20, 4 );
		add_filter( 'walker_nav_menu_start_el', [ $this, 'mega_menu_contents_soecialty_areas' ], 20, 4 );
	}

	/**
	* Add content into menu after top level links for mega menu
	*/
	public function mega_menu_contents_conditions( $item_output, $item, $depth, $args ){
		if( 'top_big_menu' !== $args->menu_id || $depth !== 0 ) {
			return $item_output;
		}

		$has_mega_menu = get_field( 'has_mega_menu', $item );
		if( false === $has_mega_menu ) {
			return $item_output;
		}

		ob_start();
		if ( in_array('has-mega-menu', $item->classes) ) {
			include( get_template_directory() . '/partials/big-menu-conditions.php' );
		}
		$item_output .= ob_get_clean();

		return $item_output;
    }
    
    /**
	* Add content into menu after top level links for mega menu
	*/
	public function mega_menu_contents_channels( $item_output, $item, $depth, $args ){
		if( 'top_big_menu' !== $args->menu_id || $depth !== 0 ) {
			return $item_output;
		}
		
		ob_start();
		if ( in_array('has-channels-menu', $item->classes) ) {
			include( get_template_directory() . '/partials/big-menu-channels.php' );
		}
		$item_output .= ob_get_clean();

		return $item_output;
	}

	/**
	 * Add content into menu after top level links for mega menu
	 */
	public function mega_menu_contents_soecialty_areas( $item_output, $item, $depth, $args ){
		if( 'top_big_menu' !== $args->menu_id || $depth !== 0 ) {
			return $item_output;
		}
		
		ob_start();
		if ( in_array('has-specialty-areas-menu', $item->classes) ) {
			include( get_template_directory() . '/partials/big-menu-specialty-areas.php' );
		}
		$item_output .= ob_get_clean();

		return $item_output;
	}
}

new DoctorpediaMenu();