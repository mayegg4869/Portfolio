<?php
/**
 * The sidebar for blogs.
 *
 * @package BusinessPress
 */
if (   ! is_active_sidebar( 'sidebar-1' )
	&& ! is_active_sidebar( 'sidebar-1-s' ) ) {
	return;
}
?>

<div id="secondary" class="sidebar-area" role="complementary">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div class="normal-sidebar widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- .normal-sidebar -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-1-s' ) ) : ?>
	<div id="sticky-sidebar" class="sticky-sidebar widget-area">
		<?php dynamic_sidebar( 'sidebar-1-s' ); ?>
	</div><!-- #sticky-sidebar -->
	<?php endif; ?>
</div><!-- #secondary -->
