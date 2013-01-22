<?php
/**
 * EventsWidget Class
 */
class EventsWidget extends WP_Widget {
    /** constructor */
    function EventsWidget() {
        parent::WP_Widget(false, $name = 'Events Widget');
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
			?>
			<section id="events">
				
				<style>
				<?php require_once(STYLESHEETPATH . '/events/event-styles.css'); ?>
				</style>
				
				<h5>Events</h5>
				
				<?php
					
					$year = date('Y');
					$month = date('m');
				
					$days = array();
					for ($i = 1; $i <= 31; $i++) {
						$event_url = get_bloginfo('home') . "/events/" . $year . "-" . $month . "-" . $i;
						$days[$i] = array($event_url, 'linked-day');
					}
					echo generate_calendar($year, $month, $days, 3);
				?>
				
				
				<?php
				$today = date('Y-m-d', time());
				$morning = strtotime($day . " 05:00");
				$tomorrow = $morning + 24*60*60;

				
					$args=array(
						'post_type' => 'events',
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key' => 'date-start',
								'value' => $tomorrow,
								'compare' => '<=',
								'type' => 'numeric'
							),
							array(
								'key' => 'date-end',
								'value' => $morning,
								'compare' => '>=',
								'type' => 'numeric'
							),

						)
					);
					query_posts($args);
				?>
				<ul style="margin-top: 20px;">
				<h6><a href="<?php bloginfo("home"); ?>/events/<?php echo date('Y-m-d', time()); ?>">Today's Urban Planner</a></h6>					
				<?php while ( have_posts() ) : the_post(); ?>
						<li  id="post-<?php the_ID(); ?>">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - 
							<?php $start = get_post_meta(get_the_ID(), 'date-start', true); ?>
							<?php echo date('g:ia', $start); ?>
				<?php endwhile; ?>
								
			</section>
			<?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

} // class EventsWidget

add_action('widgets_init', create_function('', 'return register_widget("EventsWidget");'));