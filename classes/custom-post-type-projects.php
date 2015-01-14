<?php

/**
 * Security, checks if WordPress is running
 **/
if ( !function_exists( 'add_action' ) ) :
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
endif;



/**
*  Plugin
*/
final class Custom_Post_Type_Project
{



	/**
	 * Constructor
	 *
	 * @access public
	 * @since v1.1.0
	 * @author Ralf Hortt
	 **/
	public function __construct()
	{

		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

	} // end __construct



	/**
	 * Load plugin textdomain
	 *
	 * @access public
	 * @since v1.1.0
	 * @author Ralf Hortt
	 **/
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain( 'custom-post-type-projects', false, dirname( plugin_basename( __FILE__ ) ) . '/../languages/'  );

	} // end load_plugin_textdomain



	/**
	 * Register post type
	 *
	 * @access public
	 * @since v1.1.0
	 * @author Ralf Hortt
	 **/
	public function register_post_type()
	{

		register_post_type( 'project', array(
			'labels' => array(
				'name' => _x( 'Projects', 'post type general name', 'custom-post-type-projects' ),
				'singular_name' => _x( 'Project', 'post type singular name', 'custom-post-type-projects' ),
				'add_new' => _x( 'Add New', 'Project', 'custom-post-type-projects' ),
				'add_new_item' => __( 'Add New Project', 'custom-post-type-projects' ),
				'edit_item' => __( 'Edit Project', 'custom-post-type-projects' ),
				'new_item' => __( 'New Project', 'custom-post-type-projects' ),
				'view_item' => __( 'View Project', 'custom-post-type-projects' ),
				'search_items' => __( 'Search Projects', 'custom-post-type-projects' ),
				'not_found' =>	__( 'No Projects found', 'custom-post-type-projects' ),
				'not_found_in_trash' => __( 'No Projects found in Trash', 'custom-post-type-projects' ),
				'parent_item_colon' => '',
				'menu_name' => __( 'Projects', 'custom-post-type-projects' )
			),
			'public' => TRUE,
			'publicly_queryable' => TRUE,
			'show_ui' => TRUE,
			'show_in_menu' => TRUE,
			'query_var' => TRUE,
			'rewrite' => array( 'slug' => _x( 'projects', 'post type slug', 'custom-post-type-projects' ) ),
			'capability_type' => 'post',
			'has_archive' => TRUE,
			'hierarchical' => FALSE,
			'menu_position' => NULL,
			'menu_icon' => 'dashicons-clipboard',
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
		) );

	} // end register_post_type



} // end Custom_Post_Type_Project

new Custom_Post_Type_Project;
