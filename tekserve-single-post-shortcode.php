<?php
/**
 * Plugin Name: Tekserve Single Post Shortcode
 * Plugin URI: https://github.com/bangerkuwranger
 * Description: Wordpress plugin to create a shortcode for showing the title, post info, excerpt, and thumbnail for a single post.
 * Version: 1.0
 * Author: Chad A. Carino
 * Author URI: http://www.chadacarino.com
 * License: MIT
 */
/*
The MIT License (MIT)
Copyright (c) 2013 Chad A. Carino
 
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

// shortcode to display a single post

// Add Shortcode
function tekserve_single_post( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'id' => '',
			'showimage' => '',
		), $atts )
	);

	// Code
	$title = '<h2 class="tekserve-single-post-title">' . get_the_title( $id ) . '</h2>';
	$authorid = get_post_field( 'post_author', $id );
	$author = get_the_author_meta( 'display_name', $authorid );
	$datestr = get_post_field( 'post_date', $id );
	$date = DateTime::createFromFormat('Y-m-d H:i:s', $datestr);
	$date = $date->format('D, M j, Y');
	$excerpt = substr(get_post_field( 'post_content', $id ), 0, 90);
	$excerpt = '<div id="tekserve-single-post-excerpt">' . $excerpt . '...CONTINUE...</div>';
	$meta = '<div class="tekserve-single-post-meta">' . $date . ' by ' . $author . '</div>';
	$thumb = get_the_post_thumbnail($id, array(200,200));
	if($showimage == "show") {
		return '<div id="single-post-' . $id . '" class="tekserve-single-post"> <a href="' . get_permalink( $id ) . '">' . $thumb . $title . $meta . $excerpt . '</a></div>';
	}
	else {
		return '<div id="single-post-' . $id . '" class="tekserve-single-post"> <a href="' . get_permalink( $id ) . '">' . $title . $meta . $excerpt . '</a></div>';
	}
}
add_shortcode( 'single_post', 'tekserve_single_post' );