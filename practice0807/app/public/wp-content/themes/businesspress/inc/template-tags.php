<?php
/**
 * Custom template tags for this theme.
 *
 * @package BusinessPress
 */

if ( ! function_exists( 'businesspress_top_bar_main' ) ) :
/**
 * Display Top Bar Main.
 */
function businesspress_top_bar_main() {
	?>
	<ul class="top-bar-main">
		<?php if ( get_theme_mod( 'businesspress_top_bar_phone' ) ) : ?>
			<li class="top-bar-main-phone"><?php echo sanitize_text_field( get_theme_mod( 'businesspress_top_bar_phone' ) ); ?></li>
		<?php endif; ?>
		<?php if ( get_theme_mod( 'businesspress_top_bar_contact' ) ) : ?>
			<li class="top-bar-main-contact"><a href="<?php echo sanitize_text_field( get_theme_mod( 'businesspress_top_bar_contact' ) ); ?>"><?php esc_attr_e( 'Contact', 'businesspress' ); ?></a></li>
		<?php endif; ?>
		<?php if ( get_theme_mod( 'businesspress_top_bar_access' ) ) : ?>
			<li class="top-bar-main-access"><a href="<?php echo sanitize_text_field( get_theme_mod( 'businesspress_top_bar_access' ) ); ?>"><?php esc_attr_e( 'Access', 'businesspress' ); ?></a></li>
		<?php endif; ?>
	</ul><!-- .top-bar-main -->
	<?php
}
endif;

if ( ! function_exists( 'businesspress_header_social_link' ) ) :
/**
 * Display Header Social Link.
 */
function businesspress_header_social_link() {
	if ( ! has_nav_menu( 'header-social' ) ) {
		return;
	}
	?>
	<nav class="header-social-link social-link-menu">
		<?php wp_nav_menu( array( 'theme_location' => 'header-social', 'depth' => 1, 'link_before'  => '<span class="screen-reader-text">', 'link_after'  => '</span>' ) ); ?>
	</nav><!-- .header-social-link -->
	<?php
}
endif;

if ( ! function_exists( 'businesspress_logo' ) ) :
/**
 * Display logo image.
 */
function businesspress_logo() {
	if ( ! has_custom_logo() ) {
		return;
	}
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$custom_logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	$logo_width = get_theme_mod( 'businesspress_logo_width', $custom_logo[1] );
	printf( '<div class="site-logo"><a href="%1$s" rel="home"><img alt="%2$s" src="%3$s" width="%4$s" /></a></div>',
		esc_url( home_url( '/' ) ),
		get_bloginfo( 'name' ),
		esc_url( $custom_logo[0] ),
		esc_attr( $logo_width )
	);
}
endif;

if ( ! function_exists( 'businesspress_title' ) ) :
/**
 * Display Site Title and Tagline.
 */
function businesspress_title() {
	if ( is_front_page() ) : ?>
	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<?php else: ?>
	<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
	<?php endif; ?>
	<div class="site-description"><?php bloginfo( 'description' ); ?></div>
	<?php
}
endif;

if ( ! function_exists( 'businesspress_main_navigation' ) ) :
/**
 * Display Main Navigation.
 */
function businesspress_main_navigation() {
	?>
	<nav class="main-navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav><!-- .main-navigation -->
	<?php
}
endif;

if ( ! function_exists( 'businesspress_post_background' ) ) :
/**
 * Set background of posts.
 */
function businesspress_post_background( $thumbnail_id = '' , $image_size = 'businesspress-post-thumbnail-large' ) {
	if ( '' == $thumbnail_id ) {
		$thumbnail_id = get_post_thumbnail_id();
	}
	$featured_url = wp_get_attachment_image_src( $thumbnail_id, $image_size );
	if ( $featured_url ) : ?>
		 style="background-image: url('<?php echo esc_url( $featured_url[0] ) ?>')"
	<?php endif;
}
endif;

if ( ! function_exists( 'businesspress_home_header_background' ) ) :
/**
 * Set background of the home header.
 */
function businesspress_home_header_background() {
	$background_image = get_theme_mod( 'businesspress_home_header_background_image' );
	if ( $background_image ) {
		 echo ' style="background-image:url(\'' . esc_url( $background_image ) . '\')"';
	}
}
endif;

if ( ! function_exists( 'businesspress_category' ) ) :
/**
 * Display categories.
 */
function businesspress_category() {
	if ( get_theme_mod( 'businesspress_hide_category' ) ) {
		return;
	}
	echo '<div class="cat-links">';
	the_category( '<span class="category-sep">/</span>' );
	echo '</div><!-- .cat-links -->';
}
endif;

if ( ! function_exists( 'businesspress_entry_meta' ) ) :
/**
 * Display post header meta.
 */
function businesspress_entry_meta() {
	// Hide for pages on Search.
	if ( 'post' != get_post_type() ) {
		return;
	}
	?>
	<div class="entry-meta">
		<span class="posted-on">
		<?php printf( '<a href="%1$s" rel="bookmark"><time class="entry-date published updated" datetime="%2$s">%3$s</time></a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			); ?>
		</span>
		<span class="byline"><?php esc_html_e( 'by', 'businesspress' ); ?>
			<span class="author vcard">
				<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php printf( esc_html__( 'View all posts by %s', 'businesspress' ), get_the_author() );?>"><?php echo get_the_author();?></a>
			</span>
		</span>
		<?php if ( ! post_password_required() && comments_open() ) : ?>
		<span class="comments-link"><span class="comments-sep"> / </span>
			<?php comments_popup_link( esc_html__( '0 Comment', 'businesspress' ), esc_html__( '1 Comment', 'businesspress' ), esc_html__( '% Comments', 'businesspress' ) ); ?>
		</span>
		<?php endif; ?>
	</div><!-- .entry-meta -->
	<?php
}
endif;

if ( ! function_exists( 'businesspress_page_meta' ) ) :
/**
 * Display page header meta.
 */
function businesspress_page_meta() {
	?>
	<div class="entry-meta">
		<span class="posted-on">
		<?php printf( '<time class="entry-date updated" datetime="%1$s">%2$s</time>',
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() ) 
			); ?>
		</span>
		<span class="byline"><?php esc_html_e( 'by', 'businesspress' ); ?>
			<span class="author vcard">
				<span class="fn n"><?php echo get_the_author();?></span>
			</span>
		</span>
	</div><!-- .entry-meta -->
	<?php
}
endif;

if ( ! function_exists( 'businesspress_shorten_text' ) ) :
/**
 * Shorten text.
 */
function businesspress_shorten_text( $text, $length ) {
	$text = wp_kses( $text, array() );
	if( mb_strlen( $text ) > $length ) {
		$text = mb_substr( $text ,0 ,$length );
		return $text . '...';
	} else {
		return $text;
	}
}
endif;

if ( ! function_exists( 'businesspress_author_profile' ) ) :
/**
 * Display author profile when applicable.
 */
function businesspress_author_profile() {
	if ( get_theme_mod( 'businesspress_hide_author_profile' ) ) {
		return;
	}
	?>
	<div class="author-profile">
		<div class="author-profile-header">
			<div class="author-profile-avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 75 ); ?>
			</div><!-- .author-profile-avatar -->
			<div class="author-profile-name">
				<strong><a class="author-profile-description-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php the_author() ?></a></strong>
			</div><!-- .author-profile-name-link -->
		</div><!-- .author-profile-header -->
		<div class="author-profile-content">
			<div class="author-profile-description">
				<?php the_author_meta( 'description' ); ?>
			</div><!-- .author-profile-description -->
		</div><!-- .author-profile-content -->
	</div><!-- .author-profile -->
	<?php
}
endif;

if ( ! function_exists( 'businesspress_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function businesspress_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'businesspress' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous"><div class="post-nav-title">' . esc_html__( 'Previous post', 'businesspress' ) . '</div>%link</div>', esc_html_x( '%title', 'Previous post link', 'businesspress' ) );
				next_post_link( '<div class="nav-next"><div class="post-nav-title">' . esc_html__( 'Next post', 'businesspress' ) . '</div>%link</div>', esc_html_x( '%title', 'Next post link', 'businesspress' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .post-navigation -->
	<?php
}
endif;


if ( ! function_exists( 'businesspress_footer' ) ) :
/**
 * Display footer credit.
 */
function businesspress_footer() {
	if ( function_exists( 'bp_footer_customize' ) ) {
		bp_footer_customize();
	} else { ?>
	<div class="site-info">
		<div class="site-copyright">
			&copy; <?php echo date_i18n('Y') ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</div><!-- .site-copyright -->
		<div class="site-credit">
			<?php printf( wp_kses( __( 'Powered by <a href="%1$s">%2$s</a>', 'businesspress' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( __( 'https://wordpress.org/', 'businesspress' ) ), 'WordPress' ); ?>
			<span class="site-credit-sep"> | </span>
			<?php printf( wp_kses( __( 'Theme by <a href="%1$s">%2$s</a>', 'businesspress' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( __( 'https://businesspress.jp/', 'businesspress' ) ), 'BusinessPress' ); ?>
		</div><!-- .site-credit -->
	</div><!-- .site-info -->
	<?php
	}
}
endif;

