<?php 

/*
Plugin Name: TR Woocommerce Product Slider
Plugin URI: http://themeroad.net/
Description: Aweosome Plugin for Woocommerce Product Slider
Author: Theme Road
Version: 1.0
Author URI: http://themeroad.net/
*/





/**
 * Enqueue scripts and styles
 */
function tr_woo_pro_slider_scripts() {

    // load  wp js
    wp_enqueue_script( 'jquery' );
	wp_enqueue_style( 'tr-owl.carousel-css', plugins_url('/css/owl.carousel.css', __FILE__) );
 	wp_enqueue_style( 'tr-bootstrap-css', plugins_url('/css/bootstrap.min.css', __FILE__) );
 	wp_enqueue_style( 'trmd-font-awesome-style', plugins_url('/css/font-awesome.min.css', __FILE__) );
 	wp_enqueue_style( 'tr-style-css', plugins_url('/css/style.css', __FILE__) );
 	wp_enqueue_script( 'tr-bootstrap-popup-js', plugins_url('/js/bootstrap.min.js', __FILE__) ,array('jquery'));
 	wp_enqueue_script( 'tr-carousel-popup-js', plugins_url('/js/owl.carousel.js', __FILE__),array('jquery'));
 	wp_enqueue_script( 'tr-script-js', plugins_url('/js/scripts.js', __FILE__) ,array('jquery'));

}
add_action( 'wp_enqueue_scripts', 'tr_woo_pro_slider_scripts' );


// add image size
add_image_size( 'tr-pro-image', 300 , 300 , true);

// register shortcode for latest product


add_shortcode('tr-latest', 'tr_latest_product_shortcode');

function tr_latest_product_shortcode($atts){
	extract(shortcode_atts(array(
		  'title' => 'Latest Products'
	   ), $atts));

	$html = '<section class="carousel-products">';
	
	$html .= '<div class="container">';
	$html .= '<div class="row">';
	$html .= '<div class="col-xs-12 title-box">';
	$html .= '<h2 class="tr-product-title">'.$title.'</h2>';
    $html .= '<div class="carousel-trending">';
	
    $args = array(
				'post_type' => 'product',
		   'posts_per_page' => -1,
					);
					
	$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
	global $product;
        $html .= '<div class="item">';
		$html .= '<div class="product-box"> <span class="left-corner"></span> <span class="right-corner"></span>';
		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
		global $post, $product;
		$html .= '<div class="product-image">';
		$html .= '<a href="'.get_permalink().'" class="tr-product-link">';
		if (has_post_thumbnail( $loop->post->ID )){
			$html .= get_the_post_thumbnail($loop->post->ID,'tr-pro-image', array('class' => "tr_image_style"));
		}else{
		    $html .= '<img id="woo_place_thumb" src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" />';
		}
		$html .='</a>';

		$html .='</div>';



	
		$html .='<h4 class="product-name">';
		if (strlen($post->post_title) > 20) {
			$html .= substr(the_title($before = '', $after = '', FALSE), 0) . '...';
		}else{
			$html .= get_the_title();
		}
		$html .='</h4>';

		$html .= '<div class="add-to-cart-tr">'.do_shortcode('[add_to_cart id="'.get_the_ID().'"]').'</div>'; // call cart btn and price 
		
		
		
		$html .= '</div>';
		$html .= '</div>';
		 
    endwhile;
	} else {
	echo __( 'No products found' );
	}
	wp_reset_postdata();
			
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</section>';

    wp_reset_query();
    return $html;   
	   
	   
}





// register shortcode for feature product


add_shortcode('tr-feature', 'tr_feature_product_shortcode');

function tr_feature_product_shortcode($atts){
	extract(shortcode_atts(array(
		  'title' => 'Feature Products'
	   ), $atts));

	$html = '<section class="carousel-products wow fadeInUp">';
	
	$html .= '<div class="container">';
	$html .= '<div class="row">';
	$html .= '<div class="col-xs-12 title-box">';
	$html .= '<h2 class="tr-product-title">'.$title.'</h2>';
    $html .= '<div class="carousel-trending">';
	
    $args = array(
					'post_type' => 'product',
				 	'meta_key' => '_featured',
			   		'meta_value' => 'yes', 
		  			'posts_per_page' => -1,
					);
					
	$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
	global $product;
        $html .= '<div class="item">';
		$html .= '<div class="product-box"> <span class="left-corner"></span> <span class="right-corner"></span>';
		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
		global $post, $product;
		$html .= '<div class="product-image">';
		$html .= '<a href="'.get_permalink().'" class="tr-product-link">';
		if (has_post_thumbnail( $loop->post->ID )){
			$html .= get_the_post_thumbnail($loop->post->ID,'tr-pro-image', array('class' => "tr_image_style"));
		}else{
		    $html .= '<img id="woo_place_thumb" src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" />';
		}
		$html .='</a>';

		$html .='</div>';



	
		$html .='<h4 class="product-name">';
		if (strlen($post->post_title) > 20) {
			$html .= substr(the_title($before = '', $after = '', FALSE), 0) . '...';
		}else{
			$html .= get_the_title();
		}
		$html .='</h4>';

		$html .= '<div class="add-to-cart-tr">'.do_shortcode('[add_to_cart id="'.get_the_ID().'"]').'</div>'; // call cart btn and price 
		
		
		
		$html .= '</div>';
		$html .= '</div>';
		 
    endwhile;
	} else {
	echo __( 'No products found' );
	}
	wp_reset_postdata();
			
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</section>';

    wp_reset_query();
    return $html;   
	   
	   
}



