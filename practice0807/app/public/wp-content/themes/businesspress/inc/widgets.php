<?php
/**
 * Custom widgets for this theme.
 *
 * @package BusinessPress
 */

/**
 * Recent post widget class
 * This class is based on code from WordPress core.
 */
class BusinessPress_Widget_Recent_Posts extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_businesspress_recent_posts', 'description' => esc_html__( 'Displays recent posts with featured images.', 'businesspress' ));
		parent::__construct('businesspress_recent_posts', esc_html__( 'BusinessPress Recent Posts', 'businesspress' ), $widget_ops);
	}

	public function widget($args, $instance) {
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts', 'businesspress' );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$r = new WP_Query( array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true
		) );
		if ($r->have_posts()) :
		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<ul>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ): ?>
					<div class="recent-posts-thumbnail">
						<?php the_post_thumbnail('businesspress-post-thumbnail-small'); ?>
					</div><!-- .recent-posts-thumbnail -->
					<?php endif; ?>
					<div class="recent-posts-text">
						<span class="post-title"><?php get_the_title() ? the_title() : the_ID(); ?></span>
						<?php if ( $show_date ) : ?>
						<span class="post-date"><?php echo get_the_date(); ?></span>
						<?php endif; ?>
					</div><!-- .recent-posts-text -->
				</a>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
		endif;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

		return $instance;
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e( 'Title:', 'businesspress' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id('number') ); ?>"><?php esc_html_e( 'Number of posts to show:', 'businesspress' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id('show_date') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id('show_date') ); ?>"><?php esc_html_e( 'Display post date?', 'businesspress' ); ?></label></p>
	<?php
	}
}

/**
 * Featured post widget class
 * This class is based on code from WordPress core.
 */
class BusinessPress_Widget_Featured_Posts extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_businesspress_featured_posts', 'description' => esc_html__( 'Displays posts that are set as featured category.', 'businesspress' ));
		parent::__construct('businesspress_featured_posts', esc_html__( 'BusinessPress Featured Posts', 'businesspress' ), $widget_ops);
	}

	public function widget($args, $instance) {
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Featured Posts', 'businesspress' );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 4;
		if ( ! $number )
			$number = 4;
		$featured = new WP_Query( array(
			'cat'                 => get_theme_mod( 'businesspress_featured_category' ),
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true
		) );
		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<?php if ($featured->have_posts()) : ?>
			<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-widget-entry"<?php businesspress_post_background( '', 'businesspress-post-thumbnail-medium' ); ?>>
					<div class="featured-widget-entry-overlay">
						<div class="featured-widget-entry-content">
							<h3 class="featured-widget-entry-title"><?php echo businesspress_shorten_text( get_the_title(), 60 ); ?></h3>
							<?php if ( ! get_theme_mod( 'businesspress_hide_date' ) ) : ?>
							<div class="featured-widget-entry-date"><?php echo get_the_date(); ?></div>
							<?php endif; ?>
						</div><!-- .featured-widget-entry-content -->
					</div><!-- .featured-widget-entry-overlay -->
				</a>
			<?php endwhile; ?>
		<?php else: ?>
			<?php esc_html_e( 'There are no posts set in Featured Posts.', 'businesspress' ); ?>
		<?php endif; ?>
		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e( 'Title:', 'businesspress' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id('number') ); ?>"><?php esc_html_e( 'Number of posts to show (maximum 6):', 'businesspress' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

	<?php
	}
}

/**
 * Profile widget class
 * This class is based on code from WordPress core.
 */
class BusinessPress_Widget_Profile extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_businesspress_profile', 'description' => esc_html__( 'Displays a profile with a photo and social media links.', 'businesspress' ));
		parent::__construct('businesspress_profile', esc_html__( 'BusinessPress Profile', 'businesspress' ), $widget_ops);
	}

	public function widget( $args, $instance ) {
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$profile = empty( $instance['profile'] ) ? '' : $instance['profile'];
		$name = empty( $instance['name'] ) ? '' : $instance['name'];
		$text = empty( $instance['text'] ) ? '' : $instance['text'];
		$social_1 = empty( $instance['social_1'] ) ? '' : $instance['social_1'];
		$social_2 = empty( $instance['social_2'] ) ? '' : $instance['social_2'];
		$social_3 = empty( $instance['social_3'] ) ? '' : $instance['social_3'];
		$social_4 = empty( $instance['social_4'] ) ? '' : $instance['social_4'];
		$social_5 = empty( $instance['social_5'] ) ? '' : $instance['social_5'];
		$social_6 = empty( $instance['social_6'] ) ? '' : $instance['social_6'];
		$social_7 = empty( $instance['social_7'] ) ? '' : $instance['social_7'];
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="profilewidget">
			<div class="profilewidget-wrapper">
				<?php if ( $profile ): ?>
					<div class="profilewidget-profile"><img src="<?php echo esc_attr( $profile ); ?>" alt="<?php echo esc_attr( $name ); ?>" /></div>
				<?php endif; ?>
				<div class="profilewidget-meta">
					<div class="profilewidget-name"><strong><?php echo esc_html( $name ); ?></strong></div>
					<?php if ( $social_1 || $social_2 || $social_3 || $social_4 || $social_5 || $social_6 || $social_7 ): ?>
					<div class="profilewidget-link menu">
						<?php if ( $social_1 ): ?><a href="<?php echo esc_url( $social_1 ); ?>"></a><?php endif; ?>
						<?php if ( $social_2 ): ?><a href="<?php echo esc_url( $social_2 ); ?>"></a><?php endif; ?>
						<?php if ( $social_3 ): ?><a href="<?php echo esc_url( $social_3 ); ?>"></a><?php endif; ?>
						<?php if ( $social_4 ): ?><a href="<?php echo esc_url( $social_4 ); ?>"></a><?php endif; ?>
						<?php if ( $social_5 ): ?><a href="<?php echo esc_url( $social_5 ); ?>"></a><?php endif; ?>
						<?php if ( $social_6 ): ?><a href="<?php echo esc_url( $social_6 ); ?>"></a><?php endif; ?>
						<?php if ( $social_7 ): ?><a href="<?php echo esc_url( $social_7 ); ?>"></a><?php endif; ?>
					</div><!-- .profilewidget-link -->
					<?php endif; ?>
				</div><!-- .profilewidget-meta -->
			</div><!-- .profilewidget-wrapper -->
			<div class="profilewidget-text"><?php echo wp_kses_post( $text ); ?></div>
		</div><!-- .profilewidget -->
		<?php
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['profile'] = strip_tags($new_instance['profile']);
		$instance['name'] = strip_tags($new_instance['name']);
		$instance['social_1'] = strip_tags($new_instance['social_1']);
		$instance['social_2'] = strip_tags($new_instance['social_2']);
		$instance['social_3'] = strip_tags($new_instance['social_3']);
		$instance['social_4'] = strip_tags($new_instance['social_4']);
		$instance['social_5'] = strip_tags($new_instance['social_5']);
		$instance['social_6'] = strip_tags($new_instance['social_6']);
		$instance['social_7'] = strip_tags($new_instance['social_7']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'profile' => '', 'name' => '', 'text' => '', 'social_1' => '', 'social_2' => '', 'social_3' => '', 'social_4' => '', 'social_5' => '', 'social_6' => '', 'social_7' => '' ) );
		$title = strip_tags($instance['title']);
		$profile = strip_tags($instance['profile']);
		$name = strip_tags($instance['name']);
		$text = $instance['text'];
		$social_1 = strip_tags($instance['social_1']);
		$social_2 = strip_tags($instance['social_2']);
		$social_3 = strip_tags($instance['social_3']);
		$social_4 = strip_tags($instance['social_4']);
		$social_5 = strip_tags($instance['social_5']);
		$social_6 = strip_tags($instance['social_6']);
		$social_7 = strip_tags($instance['social_7']);
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e( 'Title:', 'businesspress' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id('profile') ); ?>"><?php esc_html_e( 'Profile Image URL:', 'businesspress' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('profile') ); ?>" name="<?php echo esc_attr( $this->get_field_name('profile') ); ?>" type="text" value="<?php echo esc_attr( $profile ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id('name') ); ?>"><?php esc_html_e( 'Name:', 'businesspress' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('name') ); ?>" name="<?php echo esc_attr( $this->get_field_name('name') ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" /></p>

		<textarea class="widefat" rows="8" cols="20" id="<?php echo esc_attr( $this->get_field_id('text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text') ); ?>"><?php echo esc_textarea( $text ); ?></textarea>

		<p><label for="<?php echo esc_attr( $this->get_field_id('social_1') ); ?>"><?php esc_html_e( 'Social Link 1:', 'businesspress' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_1') ); ?>" type="text" value="<?php echo esc_url( $social_1 ); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('social_2') ); ?>"><?php esc_html_e( 'Social Link 2:', 'businesspress' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_2') ); ?>" type="text" value="<?php echo esc_url( $social_2 ); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('social_3') ); ?>"><?php esc_html_e( 'Social Link 3:', 'businesspress' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_3') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_3') ); ?>" type="text" value="<?php echo esc_url( $social_3 ); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('social_4') ); ?>"><?php esc_html_e( 'Social Link 4:', 'businesspress' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_4') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_4') ); ?>" type="text" value="<?php echo esc_url( $social_4 ); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('social_5') ); ?>"><?php esc_html_e( 'Social Link 5:', 'businesspress' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_5') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_5') ); ?>" type="text" value="<?php echo esc_url( $social_5 ); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('social_6') ); ?>"><?php esc_html_e( 'Social Link 6:', 'businesspress' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_6') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_6') ); ?>" type="text" value="<?php echo esc_url( $social_6 ); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('social_7') ); ?>"><?php esc_html_e( 'Social Link 7:', 'businesspress' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_7') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_7') ); ?>" type="text" value="<?php echo esc_url( $social_7 ); ?>" /></p>
	<?php
	}
}

/**
 * Register widgets
 */
function businesspress_register_widgets() {
	register_widget( 'BusinessPress_Widget_Recent_Posts' );
	register_widget( 'BusinessPress_Widget_Featured_Posts' );
	register_widget( 'BusinessPress_Widget_Profile' );
}
add_action( 'widgets_init', 'businesspress_register_widgets' );