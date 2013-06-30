<?php
/*
Plugin Name: WP Views Get Attachment Image Shortcode
Plugin URI: http://khromov.wordpress.com
Description: Example usage: [wpv-get-attachment-image id="[wpv-post-id]" size="thumbnail"]
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
				print_r($image_info);
				return $image_info[0];
			}
			else
			{
				//FIXME: Change to a better solution. Perhaps make an if in the view with new shortcode first: [wpv-attachment-image-exists id="[wpv-post-id]"]
				$image_info = wp_get_attachment_image_src(1520, $size);
				return $image_info[0];				
			}
		}
		else
		{
			if(wp_attachment_is_image($id))
				return wp_get_attachment_image($id, $size);
			else //FIXME: Change to a better solution. Perhaps make an if in the view with new shortcode first: [wpv-attachment-image-exists id="[wpv-post-id]"]
				return wp_get_attachment_image(1520, $size); //1520 = not image media			
		}
	}
	else
		return "";
}
add_shortcode('wpv-get-attachment-image', 'shortcode_get_image');