<?php
/*------------------------------------*\
             Custom Scripts
\*------------------------------------*/

/**
 * Header Scripts
 */
add_filter( 'wp_enqueue_scripts', 'doctorpedia_enqueue_scripts' );
function doctorpedia_enqueue_scripts() {
	wp_enqueue_style('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css' );
	wp_enqueue_style('bootstrap-select', 'https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css');
	wp_enqueue_style('main', get_template_directory_uri() . '/assets/dist/main.v2.min.css' );
	wp_enqueue_style('jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css' );
	wp_enqueue_style('Fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css' );
    wp_localize_script('gravity-forms', 'ajax_var', [
        'url'    => admin_url( 'admin-ajax.php' ),
        'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
        'action' => 'validate_code'
	]);
	wp_enqueue_script('jQuery', get_template_directory_uri() . '/assets/temporary-libraries/jquery.min.js', array(), null, false);
	wp_register_script('Recaptcha-async', 'https://www.google.com/recaptcha/api.js', [], null, false);
	wp_register_script('GPT-async', 'https://www.googletagservices.com/tag/js/gpt.js', [], null, false);
	wp_register_script('Didna_gam-async', 'https://storage.googleapis.com/didna-files/doctorpedia/didna_gam.js', [], null, false);
}

/**
 * Admin Scripts
 */
add_action('admin_enqueue_scripts', 'admin_style');
function admin_style() {
	wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/css/admin.css');
}

/**
* Footer Scripts
*/
add_action( 'wp_footer', 'my_footer_scripts' );
function my_footer_scripts() { ?>
 	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="<?php echo get_template_directory_uri() .'/assets/dist/vendor_scripts.v2.min.js'; ?>"></script>
	<script src="<?php echo get_template_directory_uri() . '/assets/temporary-libraries/slick.min.js' ?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vimeo-player/2.15.3/player.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://pagination.js.org/dist/2.1.5/pagination.min.js"></script>
	<script src="<?php echo get_template_directory_uri() .'/assets/dist/app_scripts.v2.min.js'; ?>"></script>
	<script>
	/* <![CDATA[ */
	var pp_vars = {"ajaxurl":"<?php echo bloginfo('url');?>\/wp-admin\/admin-ajax.php"};
	/* ]]> */
	</script>
	<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/dffeeb9ac807dbf92acb9be32/79eeef507671889e1831942de.js");</script>
<?php }

/**
 * Esta función agrega los parámetros "async" y "defer" a recursos de Javascript.
 * Solo se debe agregar "async" o "defer" en cualquier parte del nombre del 
 * recurso (atributo "handle" de la función wp_register_script).
 *
 * @param $tag
 * @param $handle
 *
 * @return mixed
 */
add_filter('script_loader_tag', 'mg_add_async_defer_attributes', 10, 2);
function mg_add_async_defer_attributes( $tag, $handle ) {

	// Busco el valor "async"
	if( strpos( $handle, "async" ) ):
		$tag = str_replace(' src', ' async="async" src', $tag);
	endif;

	// Busco el valor "defer"
	if( strpos( $handle, "defer" ) ):
		$tag = str_replace(' src', ' defer="defer" src', $tag);
	endif;

	return $tag;
}