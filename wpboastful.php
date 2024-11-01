<?php
/*
Plugin Name: WP Boastful
Plugin URI: http://www.wpoets.com/wp-boastful-plugin
Description: A WordPress Plugin that easily integrated Zach Holman's boastful library to your WordPress site.
Author: WPoets Team( Amit Singh)
Version: 0.2
Author URI: http://www.wpoets.com
*/
function poet_wpb_scripts()
{
	if(is_single() )
	{
		wp_enqueue_script('jquery');
		wp_register_script('boastful',
	       plugins_url('jquery.boastful.js', __FILE__),
	       array('jquery'),
	       '1.0' );
	    // enqueue the script
	    wp_enqueue_script('boastful');
	}
}

function poet_wpb_show_boastful($content)
{
	return $content .="<!-- WP Boastful Plugin by WPoets Team --> <div id='boastful'><strong></strong></div>";
}

function poet_wpb_styles()
{
	 $baostful_style = plugins_url('boastful.css', __FILE__);
	 wp_register_style('boastful_style', $baostful_style);
     wp_enqueue_style( 'boastful_style');
}

function poet_wpb_activate()
{
	global $post;
	if(is_single() )
	{
		$url = urlencode(get_permalink($post->ID));//$post
		echo '<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#boastful").boastful({
						location: "'.$url.'",
						empty_message: "No one\'s mentioned this page on Twitter yet. <a href=\'http://twitter.com?status='.$url.'\'>You could be the first</a>."
					});
				});
			  </script>';
	}  
}
add_action('wp_enqueue_scripts', 'poet_wpb_scripts');
add_action('wp_print_styles', 'poet_wpb_styles');
add_action('wp_footer', 'poet_wpb_activate');
add_filter('the_content', 'poet_wpb_show_boastful');