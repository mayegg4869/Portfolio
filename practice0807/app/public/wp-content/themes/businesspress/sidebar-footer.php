<?php
/**
 * The footer
 *
 * @package BusinessPress
 */
if (   ! is_active_sidebar( 'footer-1' )
	&& ! is_active_sidebar( 'footer-2' )
	&& ! is_active_sidebar( 'footer-3' )
	&& ! is_active_sidebar( 'footer-4' )
	&& ! is_active_sidebar( 'footer-5' )
	&& ! is_active_sidebar( 'footer-6' ) ) {
	return;
}
?>

<div id="supplementary" class="footer-widget-area" role="complementary">
	<div class="footer-widget-content">
		<div class="footer-widget-wrapper">
			<?php if ( is_active_sidebar( 'footer-1' ) && '0' !== get_theme_mod( 'businesspress_footer_width_1' ) ) : ?>
			<div class="footer-widget-1 footer-widget widget-area">
				<?php dynamic_sidebar( 'footer-1' ); ?>
			</div><!-- .footer-widget-1 -->
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-2' ) && '0' !== get_theme_mod( 'businesspress_footer_width_2' ) ) : ?>
			<div class="footer-widget-2 footer-widget widget-area">
				<?php dynamic_sidebar( 'footer-2' ); ?>
			</div><!-- .footer-widget-2 -->
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-3' ) && '0' !== get_theme_mod( 'businesspress_footer_width_3' ) ) : ?>
			<div class="footer-widget-3 footer-widget widget-area">
				<?php dynamic_sidebar( 'footer-3' ); ?>
			</div><!-- .footer-widget-3 -->
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-4' ) && get_theme_mod( 'businesspress_footer_width_4' ) ) : ?>
			<div class="footer-widget-4 footer-widget widget-area">
				<?php dynamic_sidebar( 'footer-4' ); ?>
			</div><!-- .footer-widget-4 -->
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-5' ) && get_theme_mod( 'businesspress_footer_width_5' ) ) : ?>
			<div class="footer-widget-5 footer-widget widget-area">
				<?php dynamic_sidebar( 'footer-5' ); ?>
			</div><!-- .footer-widget-5 -->
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-6' ) && get_theme_mod( 'businesspress_footer_width_6' ) ) : ?>
			<div class="footer-widget-6 footer-widget widget-area">
				<?php dynamic_sidebar( 'footer-6' ); ?>
			</div><!-- .footer-widget-6 -->
			<?php endif; ?>
		</div><!-- .footer-widget-wrapper -->
	</div><!-- .footer-widget-content -->
</div><!-- #supplementary -->
