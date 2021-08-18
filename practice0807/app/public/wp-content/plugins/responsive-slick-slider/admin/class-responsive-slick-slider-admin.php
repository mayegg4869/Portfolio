<?php
// Exit if accessed directly
if(!defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    responsive-slick-slider
 * @subpackage responsive-slick-slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    responsive-slick-slider
 * @subpackage responsive-slick-slider/admin
 * @author     vsourz Digital <mehul@vsourz.com>
 */
class responsive_slick_slider_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in responsive-slick-slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The responsive-slick-slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_style( 'responsive-slick-slider', plugin_dir_url( __FILE__ ) . 'css/responsive-slick-slider-admin.css', array(), $this->version, 'all' );
		wp_register_style( 'bootstrap.min', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in responsive-slick-slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The responsive-slick-slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/responsive-slick-slider-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'jscolor', plugin_dir_url( __FILE__ ) . 'js/jscolor.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_media();
	}
	
	//Register custom post type here
	public function register_banner_cpt(){

		$cap_type 	= 'post';
		$plural 	= 'Responsive Slick Slider';
		$single 	= 'Slider';
		$cpt_name 	= 'vsz_responsive_slick';
		$text_domain = 'vsz_responsive_slick';
		
		// define labels for show in admin side vsz_responsive_slick post type
		$banner_labels = array(
							'name'                  => __( $plural, $text_domain ),
							'singular_name'         => __( $single, $text_domain ),
							'add_new'               => __( "Add {$single} ", $text_domain ),
							'add_new_item'          => __( "Add {$single} ", $text_domain ),
							'edit_item'             =>  __( "Edit {$single}" , $text_domain ),
							'new_item'              => __( "New {$single}", $text_domain ),
							'all_items' 			=> __( "Slider", $text_domain ),
							'view_item'             => __( "View {$single}", $text_domain ),
							'search_items'          => __( "Search {$plural}", $text_domain ),
							'not_found'             => __( "No {$plural} Found", $text_domain ),
							'not_found_in_trash'    => __( "No {$plural} Found in Trash", $text_domain ),
						);
		
		
		// define which arguments are passed in vsz_responsive_slick posts type and used.
		$banner_args = array(
								'labels'                => $banner_labels,
								'public'                => false,
								'show_ui'               => true,
								'show_in_nav_menus'		=> false,
								'publicly_queryable' 	=> true,
								'capability_type'       => 'post',
								'menu_icon'				=> 'dashicons-images-alt',
								'menu_position'			=> 52,
								'exclude_from_search' 	=> true,
								'hierarchical' 			=> false,
								'has_archive' 			=> false,
								'supports'              => array( 'title' ),
								'query_var'				=> true,		
								'show_in_rest'       => true,
								
							);
	
		// register custom post type for banner
		register_post_type(strtolower( $cpt_name ),$banner_args);
	}
	
	//Register all box here
	function add_banner_metabox(){
		
		$cpt_name 	= 'vsz_responsive_slick';
		$text_domain = 'vsz_responsive_slick';
		
		// define meta box on vsz_responsive_slick post type for display slider details fields
		add_meta_box(
			'banner_details',
			__( 'Add Slider', $text_domain),
			array($this,'display_banner_details_field_callback'),
			$cpt_name,
			'normal',
			'high'
			);
			
		// define meta box on vsz_responsive_slick post type for display setting details fields
		add_meta_box(
			'banner_settings',
			__( 'Slider Options', $text_domain),
			array($this,'setting'),
			$cpt_name,
			'side',
			'high'
			);
			
		
	}
	//Display slider detail meta box
	function display_banner_details_field_callback ($post){
		
		//ob_start (); 
		include(plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/banner_management-admin-display.php');
		//$slider_content = ob_get_contents ();
		//ob_end_clean ();
		//$return= $slider_content;
		//$allowed_tags = wp_kses_allowed_html( $return );
		//echo $return;
	}
	
	// Display setting metabox 
	function setting(){
		include_once(plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/setting.php');
	}
	
	//save meta box content value when post is saved 
	public function banner_save_meta_box_data($post_id){
		global $post;
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/save_meta_box_data.php';
	}
	//Customize listing screen table header
	function my_edit_banner_columns( $columns ) {
		
		if(isset($columns['date'])){
			unset($columns['date']);
		}
		$columns['type'] = __( 'Post Type / Taxonomy' );
		$columns['shortcode'] = __( 'Shortcode' );
		$columns['date'] = __( 'Date');
		return $columns;
	}
	
	//Display cloumn related specific value
	function my_manage_banner_columns($columns, $post_id){
		switch( $columns ) {
			case 'type' :
				$decide_type_of_id = get_post_meta($post_id,'decide_type_of_id',true);
				if(!empty($decide_type_of_id)){
					echo ucfirst($decide_type_of_id);
				}
				else{
					echo "-";
				}
				break;
				
			// for shortcode
			case 'shortcode' :
				echo "[vsz_slick_slider id='".$post_id."']";
				break;
			
			/* Just break out of the switch statement for everything else. */
			default :
				break;
		}
	}
	
	//Register all menu here
	function add_setting_page_menu(){
		//Add designer support menu
		add_submenu_page( "edit.php?post_type=vsz_responsive_slick", "Designer Support", "Designer Support", "manage_options", "designer_support", array($this,"support_designer"));
	}
	
	//Display designer suuport screen when call this function
	function support_designer(){
		include_once(plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/support.php');
	}
	
	//Handle post and taxonomy listing AJAX request here
	public function display_post_taxonomy_list(){
		include_once(plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/getPosts.php');
	}

}
