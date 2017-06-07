<?php
/**
 * Plugin Name: SEO and Open Graph Tags
 * Plugin URI: http://sheehanweb.com
 * Description: This plugin adds Facebook Open Graph, Twitter and SEO tags.
 * Version: 1.0.1
 * Author: Joe Sheehan
 * Author URI: http://sheehanweb.com
 * License: GPL2
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Used for the og title
function keywords() {
		$post_id = get_the_ID();
		// User Defined keyword from meta box
		$userDefinedKeywords = get_post_meta( $post_id, 'jsheehan_post_class', true );
		
		if (empty($userDefinedKeywords)) {
			return the_title();
		} else {
			return $userDefinedKeywords;
		}
	}

// Used for the og image
function catch_that_image() {
	$post_id = get_the_ID();
	//Find first image on page
	  global $post, $posts;
	  $first_img = '';
	  ob_start();
	  ob_end_clean();
	  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	  $first_img = $matches [1] [0];
		if (get_post_meta( $post_id, 'jsheehan_user_image', true ) == null ){

			//If no image on page
			if (empty($first_img)) {
				//find featured image
				if ( has_post_thumbnail() ) {
					$first_img = site_url() . wp_get_attachment_image_src( the_post_thumbnail_url() );
				  }
				else {
					$first_img = get_option('jsheehan_field_1');
				}
			}

				return $first_img;

		} else {
			$userImg = get_post_meta( $post_id, 'jsheehan_user_image', true );
			return $userImg;
		}
}

// Used for og description
function og_description(){
	$post_id = get_the_ID();
	$userDescription = get_post_meta( $post_id, 'jsheehan-description', true );
	if (empty($userDescription)) {
		return bloginfo('description');
	} else {
		echo $userDescription; 
	}
}	

add_action( 'wp_head', 'jsheehan_seo_tags', $priority = 1 );
function jsheehan_seo_tags() { 
	$contentType = get_option('jsheehan_field_2');;
	$twitterAccount = get_option('jsheehan_field_3');
?>
	<meta name="description" content="<?php og_description(); ?>" />
   	<meta property="og:locale" content="<?php echo get_locale(); ?>" />
	<meta property="og:type" content="<?php echo $contentType; ?>" />
    <meta property="og:title" content="<?php echo keywords();  ?>" />
    <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>" />
    <meta property="og:url" content="<?php the_permalink(); ?>" />
    <meta property="og:description" content="<?php og_description(); ?>" />
	<meta property="og:image" content="<?php echo catch_that_image(); ?>"/> 
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:description" content="<?php og_description(); ?>" />
	<meta name="twitter:title" content="<?php echo keywords();  ?>" />
	<meta name="twitter:site" content="<?php echo $twitterAccount; ?>" />
	<meta name="twitter:image" content="<?php echo catch_that_image(); ?>" />
	<meta name="twitter:creator" content="<?php echo $twitterAccount; ?>" /> <?php			
}


// ----------------- Main Plugin Page ---------------------\\
include_once('admin-page.php');

// ----------------- Single page settings -------------------\\
include_once('single-page.php');



