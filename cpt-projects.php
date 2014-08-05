<?php
/*
Plugin Name: Custom Post Type Projects
Plugin URL: https://github.com/Horttcore/Custom-Post-Type-Projects
Description:
Version: 1.0.0
Author: Ralf Hortt
Author URL: http://horttcore.de/
*/



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
	 * @since v1.0.0
	 * @author Ralf Hortt
	 **/
	public function __construct()
	{

		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
		add_filter( 'post_updated_messages', array( $this, 'post_updated_messages' ) );

	} // end __construct



	/**
	 * Load plugin textdomain
	 *
	 * @access public
	 * @since v1.0.0
	 * @author Ralf Hortt
	 **/
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain( 'cpt-projects', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	} // end load_plugin_textdomain



	/**
	 * Post updated messages
	 *
	 * @access public
	 * @param array $messages Update Messages
	 * @return array Update Messages
	 * @since v1.0.0
	 * @author Ralf Hortt
	 **/
	public function post_updated_messages( $messages )
	{

		global $post, $post_ID;

		$messages['project'] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => sprintf( __( 'Project updated. <a href="%s">View Project</a>', 'cpt-projects' ), esc_url( get_permalink($post_ID) ) ),
			2 => __( 'Custom field updated.' ),
			3 => __( 'Custom field deleted.' ),
			4 => __( 'Project updated.', 'cpt-projects' ),
			/* translators: %s: date and time of the revision */
			5 => isset($_GET['revision']) ? sprintf( __( 'Project restored to revision from %s', 'cpt-projects' ), wp_post_revision_title( (int) $_GET['revision'], FALSE ) ) : FALSE,
			6 => sprintf( __( 'Project published. <a href="%s">View Project</a>', 'cpt-projects' ), esc_url( get_permalink($post_ID) ) ),
			7 => __( 'Project saved.', 'cpt-projects' ),
			8 => sprintf( __( 'Project submitted. <a target="_blank" href="%s">Preview Project</a>', 'cpt-projects' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			9 => sprintf( __( 'Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Project</a>', 'cpt-projects' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __( 'Project draft updated. <a target="_blank" href="%s">Preview Project</a>', 'cpt-projects' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

		return $messages;

	} // end register_post_type



	/**
	 * Register post type
	 *
	 * @access public
	 * @since v1.0.0
	 * @author Ralf Hortt
	 **/
	public function register_post_type()
	{

		$labels = array(
			'name' => _x( 'Projects', 'post type general name', 'cpt-projects' ),
			'singular_name' => _x( 'Project', 'post type singular name', 'cpt-projects' ),
			'add_new' => _x( 'Add New', 'Project', 'cpt-projects' ),
			'add_new_item' => __( 'Add New Project', 'cpt-projects' ),
			'edit_item' => __( 'Edit Project', 'cpt-projects' ),
			'new_item' => __( 'New Project', 'cpt-projects' ),
			'view_item' => __( 'View Project', 'cpt-projects' ),
			'search_items' => __( 'Search Projects', 'cpt-projects' ),
			'not_found' =>	__( 'No Projects found', 'cpt-projects' ),
			'not_found_in_trash' => __( 'No Projects found in Trash', 'cpt-projects' ),
			'parent_item_colon' => '',
			'menu_name' => __( 'Projects', 'cpt-projects' )
		);

		$args = array(
			'labels' => $labels,
			'public' => TRUE,
			'publicly_queryable' => TRUE,
			'show_ui' => TRUE,
			'show_in_menu' => TRUE,
			'query_var' => TRUE,
			'rewrite' => array( 'slug' => _x( 'projects', 'post type slug', 'cpt-projects' ) ),
			'capability_type' => 'post',
			'has_archive' => TRUE,
			'hierarchical' => FALSE,
			'menu_position' => NULL,
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
		);

		register_post_type( 'project', $args );

	} // end register_post_type



} // end Custom_Post_Type_Project

new Custom_Post_Type_Project;
