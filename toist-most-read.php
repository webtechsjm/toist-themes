<?php

/**
 * @package Torontoist
 */
/*
Plugin Name: Torontoist Most Read
Plugin URI: http://torontoist.com
Description: Records all pageviews and looks for the most read posts
Version: 0.1
Author: Senning Luk
Author URI: http://puppydogtales.ca
License: GPLv2 or later
*/

/*
	
	Flush and store values every month/year?
	- schedule a WP Cron job to run every X minutes
		- Queries the table for most popular over Y timespan
	- schedule a WP Cron job to run every month
		- flushes all rows older than Z
*/

class Toist_Most_Read{

	function __construct(){
		add_action('shutdown',array($this,'record_pageview'));
		$this->table_name = "toistmostread_posts";
		$this->cron_schedules = array(
			array("five-minutely","300","Every five minutes"),
			array("ten-minutely","600","Every ten minutes"),
			array("thirty-minutely","1800","Every thirty minutes"),
			array("weekly","604800","Weekly"),
			array("monthly","2592000","Monthly"),
			array("yearly","31557600","Annually")
		);
		
		add_filter('cron_schedules',array($this,'add_cron_schedules'));
		add_action('toist_mostread_process',array($this,'post_process'));
		add_action('toist_mostread_clear_old_posts',array($this,'clear_old_pageviews'));
		register_activation_hook(__FILE__,array($this,'activate'));
		register_deactivation_hook(__FILE__,array($this,'deactivate'));
		register_uninstall_hook(__FILE__,array($this,'uninstall'));
	}
	
	function record_pageview(){
		global $wpdb;
		
		if(is_single()){
			$data = array(
				"post_id"		=>	get_the_id(),
				"view_time"	=>	time(),
				"hashed_ip"	=>	md5($_SERVER['REMOTE_ADDR'])
			);
			$format = array(
				'%d',
				'%d',
				'%s'	
			);
			$wpdb->insert(
				$wpdb->prefix.$this->table_name,
				$data,$format
				);
		}
	}
	
	function clear_old_pageviews(){
		global $wpdb;
		$keepfor = get_option('toist_mostread_keepfor');
		$time = time() - $keepfor;
		$query = "DELETE FROM $wpdb->prefix$this->table_name WHERE view_time < %s";
		$wpdb->query($wpdb->prepare($query,$time));
	}
	
	function post_process(){
		global $wpdb;
		$timespan = get_option('toist_mostread_timespan');
		
		$query = "SELECT post_id,COUNT(*) AS count FROM $wpdb->prefix$this->table_name WHERE view_time > %d GROUP BY post_id ORDER BY count DESC";
		$past = time() - intval($timespan); //24 hours ago 24 * 60 * 60
		$q = $wpdb->prepare(
			$query,
			$past
		);
		$res = $wpdb->get_results($q, ARRAY_A);
		
		foreach($res as $post){
			//$posts[$post['post_id']] = $post['count'];
			update_post_meta($post['post_id'],'_toist_pageviews',$post['count']);
		}
	}
	
	function post_list($args){
		$num = empty($args['posts_num']) ? 20 : $args['posts_num'];
	
		$posts = new WP_Query(array(
			'orderby'					=>	'meta_value_num',
			'meta_key'				=>	'_toist_pageviews',
			'posts_per_page'	=>	$num
		));
		
		return $posts;
	}
	
	function add_cron_schedules($schedules){
		foreach($this->cron_schedules as $sch){
			$schedules[$sch[0]]	=	array(
				'interval'		=>	$sch[1],
				'display'			=>	__($sch[2])
			);
		}
		return $schedules;
	}
	
	function reschedule($hook,$interval){
		wp_clear_scheduled_hook($hook);
		$time = time();
		//if($hook == "toist_mostread_clear_old_posts") $time += 3600;
		return wp_schedule_event($time,$interval,$hook);
	}
	
	
	function activate(){
		global $wpdb;
		
		
		wp_schedule_event(time(),'five-minutely','toist_mostread_process');
		wp_schedule_event(time(),'monthly','toist_mostread_clear_old_posts');
		
		//create the table
		$sql = 
"CREATE TABLE IF NOT EXISTS $wpdb->prefix$this->table_name (
	id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	post_id bigint(20) unsigned NOT NULL,
	view_time int(11) unsigned NOT NULL,
	hashed_ip varchar(32) NOT NULL,
	PRIMARY KEY (id),
	KEY post_id (post_id,view_time)
)";

		require_once(ABSPATH.'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
	
	function deactivate(){
		//clear schedules for all scheduled hooks
		wp_clear_scheduled_hook('toist_mostread_process');
		wp_clear_scheduled_hook('toist_mostread_clear_old_posts');
	}
	
	function uninstall(){
		//delete the table
		if(!defined('WP_UNINSTALL_PLUGIN')) exit();
		
		global $wpdb;
		$wpdb->query("DROP TABLE IF EXISTS ".$wpdb->prefix.$this->table_name);
	}
}
$toist_most_read = new Toist_Most_Read;

/*
*		Widget
*
*/

class Toist_Most_Read_Widget extends WP_Widget{
	public function __construct(){
		parent::__construct(
			'toist_most_read_widget',
			'Most Read',
			array(
				'description'	=>	__('Shows the most read posts','toistmostread')
			)
		);
		$this->timespans = array(
			86400		=>	'Past day',
			604800	=>	'Past week',
			2592000	=>	'Past 30 days',
			7776000	=>	'Past 90 days',
			31557600=>	'Past year'
		);
	}
	public function form($instance){
		if(isset($instance['title'])){
			$title = $instance['title'];
		}else{
			$title = __('Most Read','toistmostread');
		}
		
		$schedules = wp_get_schedules();
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title) ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts_num'); ?>">Number of posts to show:</label>
			<input id="<?php echo $this->get_field_id('posts_num'); ?>" name="<?php echo $this->get_field_name('posts_num'); ?>" type="number" value="<?php echo esc_attr($instance['posts_num']) ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('timespan'); ?>">Time span</label>
			<select name="<?php echo $this->get_field_name('timespan'); ?>" id="<?php echo $this->get_field_id('timespan'); ?>">
				<?php
					foreach($this->timespans as $seconds=>$name){
						$attr = '';
						if($instance['timespan'] == $seconds) $attr .= 'selected="selected"';
						printf('<option value="%d" %s>%s</option>',
							$seconds,
							$attr,
							$name
						);
					}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('refresh'); ?>">Reload read count: </label>
			<select name="<?php echo $this->get_field_name('refresh'); ?>" id="<?php echo $this->get_field_id('refresh'); ?>">
				<?php				
				foreach($schedules as $name => $sched){
					$attr = '';
					if($instance['refresh'] == $name) $attr .= 'selected="selected"';
					printf('<option value="%s" %s>%s</option>',
						$name,
						$attr,
						$sched['display']
						);
				}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('delete_after'); ?>">Delete pageviews older than the: </label>
			<select name="<?php echo $this->get_field_name('delete_after'); ?>" id="<?php $this->get_field_name('delete_after'); ?>">
			<?php
			foreach($this->timespans as $seconds => $name){
				$attr = '';
				if($instance['delete_after'] == $seconds) $attr .= 'selected="selected"';
				printf('<option value="%d" %s>%s</option>',
					$seconds,
					$attr,
					$name
					);
			}
			?>
			</select>
			<select name="<?php echo $this->get_field_name('delete_every'); ?>" id="<?php echo $this->get_field_id('delete_every'); ?>">
				<?php
				foreach($schedules as $name => $sched){
					$attr = '';
					if($instance['delete_every'] == $name) $attr .= 'selected="selected"';
					printf('<option value="%s" %s>%s</option>',
						$name,
						$attr,
						$sched['display']
						);
				}
				?>
			</select>
		</p>
		
		<?php 
	
	}
	public function update($new_instance,$old_instance){
		global $toist_most_read;
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if(
			(intval($new_instance['timespan']) == $new_instance['timespan'])
			&& ($new_instance['timespan'] != $old_instance['timespan'])
			){
			$instance['timespan'] = $new_instance['timespan'];
			update_option('toist_mostread_timespan',$new_instance['timespan']);
		}
		
		if($new_instance['refresh'] != $old_instance['refresh']){
			$instance['refresh'] = $new_instance['refresh'];
			//also reset the refresh counter
			$toist_most_read->reschedule('toist_mostread_process',$new_instance['refresh']);
		}
		
		if(intval($new_instance['delete_after']) == $new_instance['delete_after']){
			$instance['delete_after'] = $new_instance['delete_after'];
			update_option('toist_mostread_keepfor',$instance['delete_after']);
		}
		
		if($new_instance['delete_every'] != $old_instance['delete_every']){
			$instance['delete_every'] = $new_instance['delete_every'];
			$toist_most_read->reschedule('toist_mostread_clear_old_posts',$instance['delete_every']);
		}
		
		if(
			(intval($new_instance['posts_num']) == $new_instance['posts_num'])
			&& ($new_instance['posts_num'] != $old_instance['posts_num'])
			){
			$instance['posts_num'] = $new_instance['posts_num'];
		}

		return $instance;
	}
	public function widget($args,$instance){
		global $toist_most_read;
		extract($args);
		$title = apply_filters('widget_title',$instance['title']);
		
		$args = array(
			'timespan'		=>	$instance['timespan'],
			'posts_num'		=>	$instance['posts_num']
		);
		$most_read = $toist_most_read->post_list($args);
			
		if($most_read->have_posts()):
		
			echo $before_widget;
			if(!empty($title)){
				echo $before_title.$title.$after_title;
			}
			$count = 1;
			
			add_filter('excerpt_length',array($this,"excerpt_length"));
			//add_filter('excerpt_more',array($this,"excerpt_more"));
		while($most_read->have_posts()): $most_read->the_post();?>
			<article>
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<aside><?php echo $count; ?></aside>
				<div><?php the_excerpt(); ?></div>
			</article>
		<?php 
		$count++;
		endwhile; 
		
		remove_filter('excerpt_length',array($this,"excerpt_length"));
		
		echo $after_widget;
		wp_reset_query();
		endif;
	}
	function excerpt_length(){
		return 20;
	}
	
}
//add_action('widgets_init',create_function('','register_widget("Toist_Most_Read_Widget")'));
add_action('widgets_init',function(){
	return register_widget('Toist_Most_Read_Widget');
});

?>
