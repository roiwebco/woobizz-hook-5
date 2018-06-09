<?php
/*
Plugin Name: Woobizz Hook 5 
Plugin URI: http://woobizz.com
Description: Add content before the purchase button on checkout page 
Author: WOOBIZZ.COM
Author URI: http://woobizz.com
Version: 1.0.1
Text Domain: woobizzhook5
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook5_load_textdomain' );
function woobizzhook5_load_textdomain() {
  load_plugin_textdomain( 'woobizzhook5', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Add Hook 5
function woobizzhook5_widget() {
	$args = array(
				'id'            => 'woobizzhook5_id',
				'name'          => __( 'Woobizz Hook 5', 'woobizzhook5' ),
				'description'   => __( 'Add content before the purchase button on checkout page','woobizzhook5' ),
				'before_title'  => '<h2 class="widgettitle">',
				'before_title'   => '</h2>',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'before_widget'  => '</li>',
	);
	register_sidebar( $args );
	add_action( 'woocommerce_review_order_before_submit', 'woobizzhook5_display',100);
	function woobizzhook5_display(){
		?>
		<div class="woobizzhook5-widget-div">
			<div class="woobizzhook5-widget-content">
				<?php dynamic_sidebar( 'Woobizz Hook 5' ); ?>
			</div>
		</div>
		<?php
	}
}
add_action( 'widgets_init', 'woobizzhook5_widget',105);