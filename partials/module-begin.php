<?php
/**
 * Define background related classes - appearance tab
 */
//$background_color = '';
$background_location = '';
$background_color = get_sub_field( 'background_color' ) ? 'bg--grey' : 'bg-white';
/* $background_location = $background['background_location'];
if( 'none' !== $background_location ){
	$background_color = "background--".$background['background_color'];
	$background_location = "background--".$background_location;
} */

/**
 * Define padding related classes - appearance tab
 */
$padding_options = get_sub_field( 'padding_options' );
$padding_top = $padding_options['padding_top'];
if( '' == $padding_top ){
	$padding_top = 'padding--top-50';
}
$padding_bottom = $padding_options['padding_bottom'];
if( '' == $padding_bottom ){
	$padding_bottom = 'padding--bottom-50';
}

/**
 * Developer tab options
 */
$id = get_sub_field( 'anchor' );
if( '' !== $id ){
	$id = "id='{$id}'";
}
$additional_classes = esc_attr( get_sub_field( 'additional_classes' ) );

echo "<div {$id} class='{$additional_classes} module module--{$module} background {$background_color} {$background_location} padding {$padding_top} {$padding_bottom}'>";
