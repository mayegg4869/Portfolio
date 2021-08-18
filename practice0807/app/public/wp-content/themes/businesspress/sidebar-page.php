<?php
/**
 * The sidebar for pages.
 *
 * @package BusinessPress
 */
if (   ! is_active_sidebar( 'sidebar-page' )
	&& ! is_active_sidebar( 'sidebar-page-s' ) ) {
	return;
}
?>

<div id="secondary" class="sidebar-area" role="complementary">
	<?php if ( is_active_sidebar( 'sidebar-page' ) ) : ?>
	<div class="normal-sidebar widget-area">
		<?php dynamic_sidebar( 'sidebar-page' ); ?>
	</div><!-- .normal-sidebar -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-page-s' ) ) : ?>
	<div id="sticky-sidebar" class="sticky-sidebar widget-area">
		<?php dynamic_sidebar( 'sidebar-page-s' ); ?>
	</div><!-- #sticky-sidebar -->
	<?php endif; ?>
</div><!-- #secondary -->
