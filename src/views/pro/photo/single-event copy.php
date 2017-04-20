<?php
/**
 * Photo View Single Event
 * This file contains one event in the photo view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/pro/photo/single_event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php

global $post;

?>

<div class="tribe-events-photo-event-wrap">

	<?php //echo tribe_event_featured_image( null, 'medium' ); ?>
	<?php 
		if ( is_null( $post_id ) ) {
			$post_id = get_the_ID();
		}

		/**
		 * Provides an opportunity to modify the featured image size.
		 *
		 * @param string $size
		 * @param int    $post_id
		 */
		$size = apply_filters( 'tribe_event_featured_image_size', 'medium', $post_id );

		$featured_image = $wrapper
			? get_the_post_thumbnail( $post_id, $size )
			: wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size, false );

		if ( is_array( $featured_image ) ) {
			$featured_image = $featured_image[ 0 ];
		}

		/**
		 * Controls whether the featured image should be wrapped in a link
		 * or not.
		 *
		 * @param bool $link
		 */
		if ( ! empty( $featured_image ) && apply_filters( 'tribe_event_featured_image_link', $link ) ) {
			$featured_image = '<a href="' . esc_url( tribe_get_event_link( $post_id ) ) . '">' . $featured_image . '</a>';
		}

		/**
		 * Whether to wrap the featured image in our standard div (used to
		 * assist in targeting featured images from stylesheets, etc).
		 *
		 * @param bool $wrapper
		 */
		if ( ! empty( $featured_image ) && apply_filters( 'tribe_events_featured_image_wrap', $wrapper ) ) {
			$featured_image = '<div class="tribe-events-event-image">' . $featured_image . '</div>';
		}
		echo apply_filters( 'tribe_event_featured_image', $featured_image, $post_id, $size );
	
	?>

	<div class="tribe-events-event-details tribe-clearfix">

		<!-- Event Title -->
		<?php do_action( 'tribe_events_before_the_event_title' ); ?>
		<h2 class="tribe-events-list-event-title">
			<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title() ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>
		<?php do_action( 'tribe_events_after_the_event_title' ); ?>

		<!-- Event Meta -->
		<?php do_action( 'tribe_events_before_the_meta' ); ?>
		<div class="tribe-events-event-meta">
			<div class="tribe-event-schedule-details">
				<?php if ( ! empty( $post->distance ) ) : ?>
					<strong>[<?php echo tribe_get_distance_with_unit( $post->distance ); ?>]</strong>
				<?php endif; ?>
				<?php echo tribe_events_event_schedule_details(); ?>
			</div>
		</div><!-- .tribe-events-event-meta -->
		<?php do_action( 'tribe_events_after_the_meta' ); ?>

		<!-- Event Content -->
		<?php do_action( 'tribe_events_before_the_content' ); ?>
		<div class="tribe-events-list-photo-description tribe-events-content">
			<?php echo tribe_events_get_the_excerpt() ?>
		</div>
		<?php do_action( 'tribe_events_after_the_content' ) ?>

	</div><!-- /.tribe-events-event-details -->

</div><!-- /.tribe-events-photo-event-wrap -->
