<?php
/**
 * Plugin Name: Likebox
 * Plugin URI: http://codeskillet.com
 * Description: Simple plugin to show Facebook likebox
 * Version: 1.0
 * Author: Brad Traversy
 * Author URI: http://codeskillet.com
 * License: GPL2
 */
 
 //Add our JavaScript
 function add_scripts(){
	wp_enqueue_script('likebox-scripts',plugins_url().'/likebox/js/likebox.js',false);
 }
 
 add_action('wp_enqueue_scripts','add_scripts');
 
 //Include Class
 include('class.likebox.php');
 
 //Register Widget
 function register_likebox(){
	register_widget('Likebox_Widget');
 }
 
 add_action('widgets_init','register_likebox');