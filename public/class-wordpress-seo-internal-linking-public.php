<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://buywp.com
 * @since      1.0.0
 *
 * @package    Wordpress_Seo_Internal_Linking
 * @subpackage Wordpress_Seo_Internal_Linking/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wordpress_Seo_Internal_Linking
 * @subpackage Wordpress_Seo_Internal_Linking/public
 * @author     buyWP <plugins@buywp.com>
 */
class Wordpress_Seo_Internal_Linking_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordpress_Seo_Internal_Linking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpress_Seo_Internal_Linking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpress-seo-internal-linking-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordpress_Seo_Internal_Linking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpress_Seo_Internal_Linking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpress-seo-internal-linking-public.js', array( 'jquery' ), $this->version, false );

	}

	public function wp_sil_alter_content( $content ) {

		$wp_sil_core_options = get_option( 'wp_sil_plugin_core_options' );

		if( ! isset( $wp_sil_core_options['trubleshoot'] ) ){

			$wp_sil_plugin_options = get_option( 'wp_sil_plugin_options' );

			$the_content_parts = explode( "</p>", $content );
			$considered_keywords = [];

			for( $count = 0; $count < count( $the_content_parts ); $count++ ){

				$number_of_keywords = 0;
				
				foreach( $wp_sil_plugin_options['keyword'] as $key => $keyword ){
					
					$pos = strpos( $the_content_parts[ $count ], $keyword );

					if( $pos !== false && ! in_array( $keyword, $considered_keywords ) && $number_of_keywords < $wp_sil_core_options['count'] ){

						array_push( $considered_keywords, $keyword );

						$the_content = substr_replace( 
											$the_content_parts[ $count ], 
											"<a href='" . $wp_sil_plugin_options['link'][$key] . "' " . ( "_blank" == $wp_sil_core_options['target'] ? "target='_blank'" : "" ) . " >" . $keyword . "</a>",
											$pos, 
											strlen( $keyword ) 
										);

						$the_content_parts[ $count ] = $the_content;

						$number_of_keywords++;

					}

				}

			}

			return implode( "</p>", $the_content_parts );

		}
		
		return $content;

	}

}
