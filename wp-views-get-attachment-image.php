<?php
/*
Plugin Name: WP Views Get Attachment Image Shortcode helpers
Plugin URI: http://khromov.wordpress.com
Description: Example usage: [wpv-get-attachment-image id="[wpv-post-id]" size="thumbnail"], [wpv-attachment-is-image id="12"]
Version: 1.0
Author: Stanislav Khromov
Author URI: http://khromov.se
License: GPL2
*/
function shortcode_get_image($atts)
{
	global $wpdb;
	extract( shortcode_atts(array(
		'id' => '0',
		'size' => 'full',
		'raw' => 'false'
	), $atts ));
	
	if($id != 0)
	{
		if($raw == "true")
		{
			if(wp_attachment_is_image($id))
			{
				$image_info = wp_get_attachment_image_src($id, $size);
				return $image_info[0];
			}
			else
			{
				return "";
			}
		}
		else
		{
			if(wp_attachment_is_image($id))
				return wp_get_attachment_image($id, $size);
			else
				return "";
		}
	}
	else
		return "";
}

add_shortcode('wpv-get-attachment-image', 'shortcode_get_image');

/**
 * Checks if an attachment is an image. For use with [wpv-if]
 * Example: [wpv-attachment-is-image id="12"] //returns 1 or 0
 */
function shortcode_attachment_is_image($atts)
{
	extract( shortcode_atts(array(
		'id' => '0',
	), $atts ));

	return wp_attachment_is_image(intval($id)) ? '1' : '0';
}

add_shortcode('wpv-attachment-is-image', 'shortcode_attachment_is_image');