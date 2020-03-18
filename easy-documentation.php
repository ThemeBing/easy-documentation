<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themebing.com
 * @since             1.0.0
 * @package           Easy_Documentation
 *
 * @wordpress-plugin
 * Plugin Name:       Easy Documentation
 * Plugin URI:        https://themebing.com/plugin/easy-documentation/
 * Description:       Easy Documentation is a Digital Product Download and Selling Solution. It Has Complete Digital Management System.
 * Version:           1.0.0
 * Author:            ThemeBing
 * Author URI:        https://themebing.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       easy-documentation
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Easy_Documentation_Public {

	public function __construct() {

		add_action( 'wp_enqueue_scripts',  array($this, 'enqueue_styles'));
		add_action( 'wp_enqueue_scripts',  array($this, 'enqueue_scripts'));
		add_action( 'init',  array($this, 'easy_documentation_post_type'));
		add_action( 'init',  array($this, 'easy_documentation_taxonomies'));
		add_filter( 'template_include',  array($this, 'easy_documentation_templates'));

	}

	public function enqueue_styles() {

		wp_enqueue_style( 'marketplace-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css');

	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'marketplace-main', plugin_dir_url( __FILE__ ) . 'assets/js/main.js');

	}

	// Register Custom Post Type
	public function easy_documentation_post_type() {

		register_post_type( 'easy_documentation', array(
			'label'                 => __( 'Easy Documentation', 'easy-documentation' ),
			'description'           => __( 'Easy Documentation Items', 'easy-documentation' ),
			'labels'                => array(
				'name'                  => _x( 'Documentation Items', 'Post Type General Name', 'easy-documentation' ),
				'singular_name'         => _x( 'Documentation Item', 'Post Type Singular Name', 'easy-documentation' ),
				'menu_name'             => __( 'Documentation', 'easy-documentation' ),
				'name_admin_bar'        => __( 'Documentation Item', 'easy-documentation' ),
				'add_new'               => __( 'Add New', 'easy-documentation' ),
        		'add_new_item'          => __( 'Add New Documentation', 'easy-documentation' ),
			),
			'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes' ),
			'taxonomies'            => array( 'digital_categories', 'digital_tags' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-format-aside',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => array(
				'slug'                  => 'easy_documentation',
				'with_front'            => true,
				'pages'                 => true,
				'feeds'                 => true,
			),
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		));

	}

	// Register Custom taxonomies
	public function easy_documentation_taxonomies() {
	    // Add new taxonomy, make it hierarchical (like categories)	 
	    register_taxonomy( 'digital_categories', array( 'easy_documentation' ), array(
	        'hierarchical'      => true,
	        'labels'            => array(
		        'name'              => _x( 'Categories', 'taxonomy general name', 'easy-documentation' ),
		    ),
	        'show_ui'           => true,
	        'show_admin_column' => true,
	        'query_var'         => true,
	        'rewrite'           => array( 'slug' => 'easy_documentation/category' ),
	    ));
	}

	// Filter the template with our custom function
	public function easy_documentation_templates( $template ) {

		if ( is_post_type_archive('easy_documentation') ) {
			$exists_in_theme = locate_template('easy-documentation/archive.php', false);
			if ( $exists_in_theme != '' ) {
				return $exists_in_theme;
			} else {
				return plugin_dir_path( __DIR__ ) . 'templates/archive.php';
			}
		}

		if ( is_singular('easy_documentation') ) {
		    $exists_in_theme = locate_template('easy-documentation/single.php', false);
		    if ( $exists_in_theme != '' ) {
		    	return $exists_in_theme;
		    } else {
		    	return plugin_dir_path( __DIR__ ) . 'templates/single.php';
		    }
		}

		return $template;
	}

}

new Easy_Documentation_Public;
