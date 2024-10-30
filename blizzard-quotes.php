<?php
/*
Plugin Name: Blizzard Quotes
Plugin URI: http://www.plumeriawebdesign.com/blizzardquotes
Description: Add a Blizzard blue quote to your post or page using a simple shortcode.
Version: 1.3
Date: April 19, 2016
Author: Plumeria Web Design
Author URI: http://www.plumeriawebdesign.com
*/ 
function BlizzardQuotesMenu(){
 $file = dirname(__FILE__) . '/index.php';
 $plugin_dir = plugin_dir_url($file);
 add_menu_page('Blizzard Quotes', 'Blizzard Quotes', 'manage_options', 'blizzard-quotes-options', 'BlizzardQuotesSettings', $plugin_dir.'/img/blizz_ico.gif');
}
add_action('admin_menu', 'BlizzardQuotesMenu');
function BlizzardQuotesSettings() {
 include('settings.php');
}
function BlizzardQuotes( $atts, $content = null ) {  
	extract(shortcode_atts(array(  
       "author" => '',
		"link"   => '',
		"source"   => ''
   ), $atts));
	$bluequote  = '<div class="wowbq-bluequote">';
	if(!(empty($author) and empty($link) and empty($source))) {
		$bluequote .= '<div class="wowbq-postedby">';
		if(!empty($author)) {
			$bluequote .= __("Originally Posted by", "wowbq").' <strong>'.$author.'</strong>';
		}
		if(!empty($link) and !empty($source)) {
			$bluequote .= ' (<a href="'.$link.'" target="_blank">'.__("Blue Tracker", "wowbq").'</a> / <a href="'.$source.'" target="_blank">'.__("Official Post", "wowbq").'</a>)';
		}else if(!empty($link)) {
			$bluequote .= ' (<a href="'.$link.'" target="_blank">'.__("Blue Tracker", "wowbq").'</a>)';
		}else if(!empty($source)) {
			$bluequote .= ' (<a href="'.$source.'" target="_blank">'.__("Official Post", "wowbq").'</a>)';
		}
		$bluequote .= '</div><div class="wowbq-clear"></div>';
	}
	$bluequote .= $content.'</div><div class="wowbq-clear"></div>';
   return $bluequote;
}
/* create shortcode */
add_shortcode("blizzardquote", "BlizzardQuotes");
function blizzard_scripts() {
   wp_enqueue_style('blizzard-quotes-custom-css', plugins_url('css/style.css', __FILE__));
}
add_action( 'wp_enqueue_scripts', 'blizzard_scripts' );
function blizzard_posts_default_settings() {
	$file = dirname(__FILE__) . '/blizzard-quotes.php';
   $plugin_dir = plugin_dir_url($file);
	
	add_option('bluepost_bg_color', '#222222');
	add_option('bluepost_bg_img', $plugin_dir.'img/blizzbg.jpg');
	add_option('bluepost_bg_repeat', 'no');
	add_option('bluepost_bg_scroll', 'no');
	add_option('bluepost_radius', '10');
	add_option('bluepost_link_color', '#ffb100');
	add_option('bluepost_postedby_border_color', '#000000');
	add_option('bluepost_text_color', '#00B4FF');
	add_option('bluepost_postedby_link_color', '#FFFFFF');
	
	
}
register_activation_hook( __FILE__, 'blizzard_posts_default_settings' );

function enqueue_libraries($hook) {
   wp_enqueue_style( 'adminstyle', plugins_url( 'css/adminstyle.css' , __FILE__ ));
   //wp_register_script( 'jquery-ui-latest', 'http://code.jquery.com/ui/1.10.4/jquery-ui.min.js', array('jquery'),'',true  );
   //wp_enqueue_script('jquery-ui-latest');
   wp_register_style('jquery-ui-theme-latest', 'http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css', '', '', 'screen');
   wp_enqueue_style('jquery-ui-theme-latest');
   wp_enqueue_style( 'wp-color-picker' );
   wp_enqueue_script( 'bluepost-scripts', plugins_url( 'js/scripts.js',  __FILE__ ) , array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'enqueue_libraries' );	

function plumwd_blizzardquotes_admin_footer_text($my_footer_text) {
 $plugin_url = plugins_url();
 $my_footer_text = "<span class=\"credit\"><img src=\"$plugin_url/blizzard-quotes/img/plumeria.png\" alt=\"Plumeria Web Design Logo\"/><a href=\"http://www.plumeriawebdesign.com/BlizzardQuotes2\" target=\"_blank\">Blizzard Quotes</a>. Developed by <a href=\"http://www.plumeriawebdesign.com\" target=\"_blank\">Plumeria Web Design</a></span>";
	return $my_footer_text;
}
if(isset($_GET['page'])) {
if ($_GET['page'] == "blizzard-quotes-options") {
 add_filter('admin_footer_text', 'plumwd_blizzardquotes_admin_footer_text');
}
}
//let's make the button to add the shortcode
function add_button_sc_plumwd_bluequote() {
add_filter('mce_external_plugins', 'add_plugin_sc_plumwd_bluequote');  
add_filter('mce_buttons', 'register_button_sc_plumwd_bluequote');  
}
add_action('init', 'add_button_sc_plumwd_bluequote');
//we need to register our button
function register_button_sc_plumwd_bluequote($pbq_buttons) {
array_push($pbq_buttons, "plumwd_blizzardquote_display");
return $pbq_buttons;  
}
function add_plugin_sc_plumwd_bluequote($pbq_plugin_array) {
$plugin_url = plugins_url();
$script_url = $plugin_url.'/blizzard-quotes/js/shortcode.js';
$pbq_plugin_array['plumwd_blizzardquote_display'] = $script_url; 
return $pbq_plugin_array;
}
?>