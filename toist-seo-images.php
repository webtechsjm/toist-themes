<?php
/**
 * @package Torontoist
 */
/*
Plugin Name: Torontoist SEO Images
Plugin URI: http://torontoist.com
Description: Replace the alt tag with a more readable adaptation of the file name
Version: 0.1
Author: Senning Luk
Author URI: http://puppydogtales.ca
License: GPLv2 or later
*/

add_filter('image_send_to_editor','replace_alt',10,8);

function replace_alt($html,$id,$caption,$title,$align,$url='',$size='medium',$alt=''){


	if(empty($alt) || $alt == $caption || $alt == $title){
		$alt = pathinfo($url);
		$alt = $alt['filename'];
	} 
	
	$patterns = array('|[-]|','|[.]|','|[_]|');
	$replacements = array(' ',' ',' ');
	$alt = preg_replace($patterns,$replacements,$alt);
	
	$html = get_image_tag($id, $alt, '', $align, $size);

	$rel = $rel ? ' rel="attachment wp-att-' . esc_attr($id).'"' : '';

	if ( $url )
		$html = '<a href="' . esc_attr($url) . "\"$rel>$html</a>";
	
	return $html;
}

?>
