<?php
/**
 * Plugin Name: Custom Post Type Projects
 * Plugin URI: http://horttcore.de
 * Description: Manage projects
 * Version: 1.1.0
 * Author: Ralf Hortt
 * Author URI: http://horttcore.de
 * Text Domain: custom-post-type-projects
 * Domain Path: /languages/
 * License: GPL2
 */

require( 'classes/custom-post-type-projects.php' );

if ( is_admin() )
	require( 'classes/custom-post-type-projects.admin.php' );
