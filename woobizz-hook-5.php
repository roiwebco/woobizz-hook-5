<?php
/*
Plugin Name: Woobizz Hook 5 
Plugin URI: http://woobizz.com
Description: Add widget content before buy button on checkout page
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
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
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
    add_action( 'widgets_init', 'woobizzhook5_widget',105);
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook5_admin_notice' );
}
//Add Hook 5

function woobizzhook5_widget() {
	$args = array(
				'id'            => 'woobizzhook5_id',
				'name'          => __( 'Woobizz Hook 5', 'woobizzhook5' ),
				'description'   => __( 'Add widget content before buy button on checkout page','woobizzhook5' ),
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
//Hook1 Notice
function woobizzhook5_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 5 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook5' ); ?></p>
    </div>
    <?php
}