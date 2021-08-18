<?php
/**
 * BusinessPress Theme Customizer
 *
 * @package BusinessPress
 */

/**
 * Set the Customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function businesspress_customize_register( $wp_customize ) {

	class BusinessPress_Read_Me extends WP_Customize_Control {
		public function render_content() {
			?>
			<div class="customize-text">
				<p><?php esc_html_e( 'Thank you for using the BusinessPress theme.', 'businesspress' ); ?></p>
				<div class="customize-section first-customize-section">
				<h3><?php esc_html_e( 'Documentation', 'businesspress' ); ?></h3>
				<p><?php esc_html_e( 'For instructions on theme configuration, please see the documentation.', 'businesspress' ); ?></p>
				<p><a href="<?php echo esc_url( __( 'https://businesspress.jp/theme/document/', 'businesspress' ) ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'businesspress' ); ?></a></p>
				</div>
				<div class="customize-section">
				<h3><?php esc_html_e( 'Support', 'businesspress' ); ?></h3>
				<p><?php esc_html_e( 'If there is something you don\'t understand even after reading the documentation, please contact support.', 'businesspress' ); ?></p>
				<p><a href="<?php echo esc_url( __( 'https://businesspress.jp/support/', 'businesspress' ) ); ?>" target="_blank"><?php esc_html_e( 'Support', 'businesspress' ); ?></a></p>
				</div>
				<div class="customize-section">
				<h3><?php esc_html_e( 'Feedback', 'businesspress' ); ?></h3>
				<p><?php esc_html_e( 'If you have bug reports, suggestions for improvements, feature requests or support messages, please send us feedback.', 'businesspress' ); ?></p>
				<p><a href="<?php echo esc_url( __( 'https://businesspress.jp/feedback/', 'businesspress' ) ); ?>" target="_blank"><?php esc_html_e( 'Feedback', 'businesspress' ); ?></a></p>
				</div>
				<div class="customize-section">
				<h3><?php esc_html_e( 'Donation', 'businesspress' ); ?></h3>
				<p><?php esc_html_e( 'If you are satisfied with the theme, please donate. If you make a donation, we will give you "BP Footer Customize" plugin that allows you to freely change footer credits of BusinessPress.', 'businesspress' ); ?></p>
				<p><a href="<?php echo esc_url( __( 'https://businesspress.jp/donation/', 'businesspress' ) ); ?>" target="_blank"><?php esc_html_e( 'Donation', 'businesspress' ); ?></a></p>
				</div>
			</div>
			<?php
		}
	}

	// READ ME
	$wp_customize->add_section( 'businesspress_read_me', array(
		'title'    => esc_html__( 'READ ME', 'businesspress' ),
		'priority' => 1,
	) );
	$wp_customize->add_setting( 'businesspress_read_me_text', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( new BusinessPress_Read_Me( $wp_customize, 'businesspress_read_me_text', array(
		'section'  => 'businesspress_read_me',
		'priority' => 1,
	) ) );

	// Site Identity
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_control( 'custom_logo' )->priority = 11;
	$wp_customize->add_setting( 'businesspress_hide_blogname', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_hide_blogname', array(
		'label'       => esc_html__( 'Hide Site Title', 'businesspress' ),
		'section'     => 'title_tagline',
		'type'        => 'checkbox',
		'priority'    => 10,
	) );
	$wp_customize->add_setting( 'businesspress_hide_blogdescription', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_hide_blogdescription', array(
		'label'       => esc_html__( 'Hide Tagline', 'businesspress' ),
		'section'     => 'title_tagline',
		'type'        => 'checkbox',
		'priority'    => 10,
	) );
	$wp_customize->add_setting( 'businesspress_logo_width', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_logo_width',
	) );
	$wp_customize->add_control( 'businesspress_logo_width', array(
		'label'       => esc_html__( 'Logo Width (px)', 'businesspress' ),
		'description' => esc_html__( 'If it is half the size of the logo, the logo will be retina ready.', 'businesspress' ),
		'section'     => 'title_tagline',
		'type'        => 'text',
		'priority'    => 12,
	) );

	// Colors
	$wp_customize->get_section( 'colors' )->priority     = 35;
	$wp_customize->add_setting( 'businesspress_link_color' , array(
		'default'   => '#4693f5',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'businesspress_link_color', array(
		'label'    => esc_html__( 'Link Color (Accent Color)', 'businesspress' ),
		'section'  => 'colors',
		'priority' => 1,
	) ) );
	$wp_customize->add_setting( 'businesspress_link_hover_color' , array(
		'default'           => '#639af6',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'businesspress_link_hover_color', array(
		'label'    => esc_html__( 'Link Hover Color', 'businesspress' ),
		'section'  => 'colors',
		'priority' => 2,
	) ) );
	$wp_customize->add_setting( 'businesspress_light_background_color' , array(
		'default'   => '#f4f5f6',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'businesspress_light_background_color', array(
		'label'    => esc_html__( 'Light Background Color', 'businesspress' ),
		'section'  => 'colors',
		'priority' => 3,
	) ) );

	// Top Bar
	$wp_customize->add_section( 'businesspress_top_bar', array(
		'title'    => esc_html__( 'Top Bar', 'businesspress' ),
		'priority' => 50,
	) );
	$wp_customize->add_setting( 'businesspress_enable_top_bar', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_enable_top_bar', array(
		'label'    => esc_html__( 'Enable Top Bar', 'businesspress' ),
		'section'  => 'businesspress_top_bar',
		'type'     => 'checkbox',
		'priority' => 1,
	) );
	$wp_customize->add_setting( 'businesspress_top_bar_phone', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'businesspress_top_bar_phone', array(
		'label'    => esc_html__( 'Phone Number', 'businesspress' ),
		'section'  => 'businesspress_top_bar',
		'type'     => 'text',
		'priority' => 2,
	) );
	$wp_customize->add_setting( 'businesspress_top_bar_contact', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'businesspress_top_bar_contact', array(
		'label'    => esc_html__( 'Contact URL', 'businesspress' ),
		'section'  => 'businesspress_top_bar',
		'type'     => 'text',
		'priority' => 3,
	) );
	$wp_customize->add_setting( 'businesspress_top_bar_access', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'businesspress_top_bar_access', array(
		'label'    => esc_html__( 'Access URL', 'businesspress' ),
		'section'  => 'businesspress_top_bar',
		'type'     => 'text',
		'priority' => 4,
	) );

	// Main Header
	$wp_customize->add_section( 'businesspress_main_header', array(
		'title'    => esc_html__( 'Main Header', 'businesspress' ),
		'priority' => 55,
	) );

	// Header Image
	$wp_customize->add_setting( 'businesspress_hide_subheader', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_hide_subheader', array(
		'label'    => esc_html__( 'Hide Subheader', 'businesspress' ),
		'section'  => 'header_image',
		'type'     => 'checkbox',
		'priority' => 20,
	) );

	// Home Header
	$wp_customize->add_section( 'businesspress_home_header', array(
		'title'       => esc_html__( 'Homepage Header', 'businesspress' ),
		'priority'    => 70,
	) );
	$wp_customize->add_setting( 'businesspress_enable_home_header', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_enable_home_header', array(
		'label'    => esc_html__( 'Enable Homepage Header', 'businesspress' ),
		'section'  => 'businesspress_home_header',
		'type'     => 'checkbox',
		'priority' => 1,
	) );
	$wp_customize->add_setting( 'businesspress_home_header_background_image', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'businesspress_home_header_background_image', array(
		'label'    => esc_html__( 'Background Image', 'businesspress' ),
		'section'  => 'businesspress_home_header',
		'priority' => 2,
	) ) );
	$wp_customize->add_setting( 'businesspress_home_header_layout', array(
		'default'           => 'left',
		'sanitize_callback' => 'businesspress_sanitize_layout',
	) );
	$wp_customize->add_control( 'businesspress_home_header_layout', array(
		'label'   => __( 'Layout', 'businesspress' ),
		'section' => 'businesspress_home_header',
		'type'    => 'select',
		'choices' => array(
			'left'   => __( 'Left', 'businesspress' ),
			'center' => __( 'Center', 'businesspress' ),
			'right'  => __( 'Right', 'businesspress' ),
		),
		'priority' => 3,
	) );
	$wp_customize->add_setting( 'businesspress_home_header_mainheader', array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'businesspress_home_header_mainheader', array(
		'label'       => esc_html__( 'Headline', 'businesspress' ),
		'description' => esc_html__( '<BR /> tag is allowed.', 'businesspress' ),
		'section'     => 'businesspress_home_header',
		'type'        => 'text',
		'priority'    => 4,
	) );
	$wp_customize->add_setting( 'businesspress_home_header_text', array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'businesspress_home_header_text', array(
		'label'       => esc_html__( 'Text', 'businesspress' ),
		'description' => esc_html__( 'HTML tags are allowed.', 'businesspress' ),
		'section'     => 'businesspress_home_header',
		'type'        => 'textarea',
		'priority'    => 5,
	) );
	$wp_customize->add_setting( 'businesspress_home_header_button_text', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'businesspress_home_header_button_text', array(
		'label'    => esc_html__( 'Button 1 Text', 'businesspress' ),
		'section'  => 'businesspress_home_header',
		'type'     => 'text',
		'priority' => 6,
	) );
	$wp_customize->add_setting( 'businesspress_home_header_button_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'businesspress_home_header_button_url', array(
		'label'    => esc_html__( 'Button 1 URL', 'businesspress' ),
		'section'  => 'businesspress_home_header',
		'type'     => 'text',
		'priority' => 7,
	) );
	$wp_customize->add_setting( 'businesspress_home_header_subbutton_text', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'businesspress_home_header_subbutton_text', array(
		'label'    => esc_html__( 'Button 2 Text', 'businesspress' ),
		'section'  => 'businesspress_home_header',
		'type'     => 'text',
		'priority' => 8,
	) );
	$wp_customize->add_setting( 'businesspress_home_header_subbutton_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'businesspress_home_header_subbutton_url', array(
		'label'    => esc_html__( 'Button 2 URL', 'businesspress' ),
		'section'  => 'businesspress_home_header',
		'type'     => 'text',
		'priority' => 9,
	) );

	// Featured Posts
	$wp_customize->add_section( 'businesspress_featured', array(
		'title'       => esc_html__( 'Featured Post Slider', 'businesspress' ),
		'priority'    => 75,
	) );
	$wp_customize->add_setting( 'businesspress_enable_featured_slider', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_enable_featured_slider', array(
		'label'    => esc_html__( 'Enable Featured Post Slider', 'businesspress' ),
		'section'  => 'businesspress_featured',
		'type'     => 'checkbox',
		'priority' => 1,
	) );
	$wp_customize->add_setting( 'businesspress_featured_category', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_featured_category',
	) );
	$categories = get_categories();
	$categories_list = array();
	foreach( $categories as $category ) {
		$categories_list[$category->term_id] = esc_html( $category->name );
	}
	$wp_customize->add_control( 'businesspress_featured_category', array(
		'label'   => esc_html__( 'Featured Category', 'businesspress' ),
		'section' => 'businesspress_featured',
		'type'    => 'select',
		'choices' => $categories_list,
		'priority' => 2,
	) );
	$wp_customize->add_setting( 'businesspress_featured_slider_number', array(
		'default'           => '4',
		'sanitize_callback' => 'businesspress_sanitize_featured_slider_number',
	) );
	$wp_customize->add_control( 'businesspress_featured_slider_number', array(
		'label'       => esc_html__( 'Number of Posts to Show (1 to 8)', 'businesspress' ),
		'section'     => 'businesspress_featured',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'max'  => 8,
			'step' => 1,
		),
		'priority'    => 3,
	) );

	// Blog Settings
	$wp_customize->add_section( 'businesspress_post', array(
		'title'    => esc_html__( 'Blog Settings', 'businesspress' ),
		'priority' => 80,
	) );
	$wp_customize->add_setting( 'businesspress_content', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_content'
	) );
	$wp_customize->add_control( 'businesspress_content', array(
		'label'   => esc_html__( 'Post Display on Blog Posts Index Page', 'businesspress' ),
		'section' => 'businesspress_post',
		'type'    => 'select',
		'choices' => array(
			''          => esc_html__( 'Full Text', 'businesspress' ),
			'summary'   => esc_html__( 'Summary', 'businesspress' ),
			'2-column'  => esc_html__( '2 Column Masonry', 'businesspress' ),
			'3-column'  => esc_html__( '3 Column Masonry', 'businesspress' ),
			'list'      => esc_html__( 'List', 'businesspress' ),
		),
		'priority' => 1,
	) );
	$wp_customize->add_setting( 'businesspress_content_archive', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_content'
	) );
	$wp_customize->add_control( 'businesspress_content_archive', array(
		'label'   => esc_html__( 'Post Display on Archive Page', 'businesspress' ),
		'section' => 'businesspress_post',
		'type'    => 'select',
		'choices' => array(
			''          => esc_html__( 'Full Text', 'businesspress' ),
			'summary'   => esc_html__( 'Summary', 'businesspress' ),
			'2-column'  => esc_html__( '2 Column Masonry', 'businesspress' ),
			'3-column'  => esc_html__( '3 Column Masonry', 'businesspress' ),
			'list'      => esc_html__( 'List', 'businesspress' ),
		),
		'priority' => 2,
	) );
	$wp_customize->add_setting( 'businesspress_content_search', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_content'
	) );
	$wp_customize->add_control( 'businesspress_content_search', array(
		'label'   => esc_html__( 'Post Display on Search Page', 'businesspress' ),
		'section' => 'businesspress_post',
		'type'    => 'select',
		'choices' => array(
			''          => esc_html__( 'Full Text', 'businesspress' ),
			'summary'   => esc_html__( 'Summary', 'businesspress' ),
			'2-column'  => esc_html__( '2 Column Masonry', 'businesspress' ),
			'3-column'  => esc_html__( '3 Column Masonry', 'businesspress' ),
			'list'      => esc_html__( 'List', 'businesspress' ),
		),
		'priority' => 3,
	) );
	$wp_customize->add_setting( 'businesspress_hide_category', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_hide_category', array(
		'label'    => esc_html__( 'Hide Categories', 'businesspress' ),
		'section'  => 'businesspress_post',
		'type'     => 'checkbox',
		'priority' => 4,
	) );
	$wp_customize->add_setting( 'businesspress_hide_date', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_hide_date', array(
		'label'    => esc_html__( 'Hide Date', 'businesspress' ),
		'section'  => 'businesspress_post',
		'type'     => 'checkbox',
		'priority' => 5,
	) );
	$wp_customize->add_setting( 'businesspress_hide_author', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_hide_author', array(
		'label'    => esc_html__( 'Hide Author Name', 'businesspress' ),
		'section'  => 'businesspress_post',
		'type'     => 'checkbox',
		'priority' => 6,
	) );
	$wp_customize->add_setting( 'businesspress_hide_comments_number', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_hide_comments_number', array(
		'label'    => esc_html__( 'Hide Comments Number', 'businesspress' ),
		'section'  => 'businesspress_post',
		'type'     => 'checkbox',
		'priority' => 7,
	) );
	$wp_customize->add_setting( 'businesspress_hide_featured_image_on_full_text', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_hide_featured_image_on_full_text', array(
		'label'    => esc_html__( 'Hide Featured Image on Full Text', 'businesspress' ),
		'section'  => 'businesspress_post',
		'type'     => 'checkbox',
		'priority' => 8,
	) );
	$wp_customize->add_setting( 'businesspress_hide_featured_image_on_summary', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_hide_featured_image_on_summary', array(
		'label'    => esc_html__( 'Hide Featured Image on Summary', 'businesspress' ),
		'section'  => 'businesspress_post',
		'type'     => 'checkbox',
		'priority' => 9,
	) );
	$wp_customize->add_setting( 'businesspress_hide_featured_image_on_grid', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_hide_featured_image_on_grid', array(
		'label'    => esc_html__( 'Hide Featured Image on Masonry', 'businesspress' ),
		'section'  => 'businesspress_post',
		'type'     => 'checkbox',
		'priority' => 10,
	) );
	$wp_customize->add_setting( 'businesspress_hide_featured_image_on_list', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_hide_featured_image_on_list', array(
		'label'    => esc_html__( 'Hide Featured Image on List', 'businesspress' ),
		'section'  => 'businesspress_post',
		'type'     => 'checkbox',
		'priority' => 11,
	) );
	$wp_customize->add_setting( 'businesspress_hide_author_profile', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_hide_author_profile', array(
		'label'    => esc_html__( 'Hide Author Profile', 'businesspress' ),
		'section'  => 'businesspress_post',
		'type'     => 'checkbox',
		'priority' => 12,
	) );
	$wp_customize->add_setting( 'businesspress_hide_post_nav', array(
		'default'           => '',
		'sanitize_callback' => 'businesspress_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'businesspress_hide_post_nav', array(
		'label'    => esc_html__( 'Hide Previous/Next Post Navigation', 'businesspress' ),
		'section'  => 'businesspress_post',
		'type'     => 'checkbox',
		'priority' => 13,
	) );

	// Footer Widget
	$wp_customize->add_section( 'businesspress_footer_widget', array(
		'title'       => esc_html__( 'Footer Widget', 'businesspress' ),
		'description' => esc_html__( 'The width of one line is 12. It can be multi-line.', 'businesspress' ),
		'priority'    => 90,
	) );
	$wp_customize->add_setting( 'businesspress_footer_width_1', array(
		'default'           => '6',
		'sanitize_callback' => 'businesspress_sanitize_footer_width',
	) );
	$wp_customize->add_control( 'businesspress_footer_width_1', array(
		'label'       => esc_html__( 'Width of Footer 1 (0 to 12)', 'businesspress' ),
		'section'     => 'businesspress_footer_widget',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 12,
			'step' => 1,
		),
		'priority'    => 1,
	) );
	$wp_customize->add_setting( 'businesspress_footer_width_2', array(
		'default'           => '3',
		'sanitize_callback' => 'businesspress_sanitize_footer_width',
	) );
	$wp_customize->add_control( 'businesspress_footer_width_2', array(
		'label'       => esc_html__( 'Width of Footer 2 (0 to 12)', 'businesspress' ),
		'section'     => 'businesspress_footer_widget',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 12,
			'step' => 1,
		),
		'priority'    => 2,
	) );
	$wp_customize->add_setting( 'businesspress_footer_width_3', array(
		'default'           => '3',
		'sanitize_callback' => 'businesspress_sanitize_footer_width',
	) );
	$wp_customize->add_control( 'businesspress_footer_width_3', array(
		'label'       => esc_html__( 'Width of Footer 3 (0 to 12)', 'businesspress' ),
		'section'     => 'businesspress_footer_widget',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 12,
			'step' => 1,
		),
		'priority'    => 3,
	) );
	$wp_customize->add_setting( 'businesspress_footer_width_4', array(
		'default'           => '0',
		'sanitize_callback' => 'businesspress_sanitize_footer_width',
	) );
	$wp_customize->add_control( 'businesspress_footer_width_4', array(
		'label'       => esc_html__( 'Width of Footer 4 (0 to 12)', 'businesspress' ),
		'section'     => 'businesspress_footer_widget',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 12,
			'step' => 1,
		),
		'priority'    => 4,
	) );
	$wp_customize->add_setting( 'businesspress_footer_width_5', array(
		'default'           => '0',
		'sanitize_callback' => 'businesspress_sanitize_footer_width',
	) );
	$wp_customize->add_control( 'businesspress_footer_width_5', array(
		'label'       => esc_html__( 'Width of Footer 5 (0 to 12)', 'businesspress' ),
		'section'     => 'businesspress_footer_widget',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 12,
			'step' => 1,
		),
		'priority'    => 5,
	) );
	$wp_customize->add_setting( 'businesspress_footer_width_6', array(
		'default'           => '0',
		'sanitize_callback' => 'businesspress_sanitize_footer_width',
	) );
	$wp_customize->add_control( 'businesspress_footer_width_6', array(
		'label'       => esc_html__( 'Width of Footer 6 (0 to 12)', 'businesspress' ),
		'section'     => 'businesspress_footer_widget',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 12,
			'step' => 1,
		),
		'priority'    => 6,
	) );
}
add_action( 'customize_register', 'businesspress_customize_register' );

/**
 * Sanitize user inputs.
 */
function businesspress_sanitize_checkbox( $value ) {
	if ( $value == 1 ) {
		return 1;
	} else {
		return '';
	}
}
function businesspress_sanitize_logo_width( $value ) {
	if ( preg_match("/^[1-9][0-9]*$/", $value) ) {
		return $value;
	} else {
		return '';
	}
}
function businesspress_sanitize_layout( $value ) {
	$valid = array(
		'left'   => __( 'Left', 'businesspress' ),
		'center' => __( 'Center', 'businesspress' ),
		'right'  => __( 'Right', 'businesspress' ),
	);

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return 'left';
	}
}
function businesspress_sanitize_featured_slider_number( $value ) {
	if ( preg_match("/^[1-8]$/", $value) ) {
		return $value;
	} else {
		return '4';
	}
}
function businesspress_sanitize_content( $value ) {
	$valid = array(
		''          => esc_html__( 'Full Text', 'businesspress' ),
		'summary'   => esc_html__( 'Summary', 'businesspress' ),
		'2-column'  => esc_html__( '2 Column Masonry', 'businesspress' ),
		'3-column'  => esc_html__( '3 Column Masonry', 'businesspress' ),
		'list'      => esc_html__( 'List', 'businesspress' ),
	);

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function businesspress_sanitize_featured_category( $value ) {
	$categories = get_categories();
	$categories_list = array();
	foreach( $categories as $category ) {
		$categories_list[$category->term_id] = esc_html( $category->name );
	}
	$valid = $categories_list;

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function businesspress_sanitize_footer_width( $value ) {
	if ( preg_match("/^[0-9]$|^1[0-2]$/", $value) ) {
		return $value;
	} else {
		return '0';
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function businesspress_customize_preview_js() {
	wp_enqueue_script( 'businesspress_customizer', get_theme_file_uri( '/js/customizer.js' ), array( 'customize-preview' ), '20180907', true );
}
add_action( 'customize_preview_init', 'businesspress_customize_preview_js' );

/**
 * Enqueue Customizer CSS
 */
function businesspress_customizer_style() {
	wp_enqueue_style( 'businesspress-customizer-style', get_theme_file_uri( '/css/customizer.css' ), array(), '20180907' );
}
add_action( 'customize_controls_print_styles', 'businesspress_customizer_style');
