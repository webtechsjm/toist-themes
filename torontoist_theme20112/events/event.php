<?php

require_once(STYLESHEETPATH . '/events/calendar.php');
require_once(STYLESHEETPATH . '/events/widget.php');

add_action( 'init', 'create_event_postype' );


function create_event_postype() {
	$args = array(
	    'label' => __('Events'),
	    'public' => true,
	    'can_export' => true,
	    'show_ui' => true,
	    '_builtin' => false,
	    'capability_type' => 'post',
	    'hierarchical' => false,
	    'rewrite' => array( "slug" => "events" ),
	    'supports'=> array('title', 'thumbnail', 'excerpt', 'editor', 'custom-fields') ,
	    'show_in_nav_menus' => true,
			'has_archive' => true,
			'taxonomies' => array('post_tag')
	);
	register_post_type( 'events', $args);
	
	register_taxonomy( 
		'event-type', 
		'events', 
		array( 
			'hierarchical' => true, 
			'label' => 'Event Type', 
			'query_var' => true
			) 
		);  
	
	
}


add_action( 'add_meta_boxes', 'rs_add_date' );
function rs_add_date() {
    add_meta_box( 'rs_add_date', 'Event properties', 'rs_add_date_create_meta_box', 'events', 'normal', 'high' );
}
function rs_add_date_create_meta_box( $post ) {
    $start_date = get_post_meta($post->ID, 'date-start', true);
    $end_date = get_post_meta($post->ID, 'date-end', true);
 		$location = get_post_meta($post->ID, 'location', true);
 		$price = get_post_meta($post->ID, 'price', true);

    wp_nonce_field( plugin_basename(__FILE__), 'rs_date_nonce');
?>
    <h4>Set the date and time for this event</h4>
    <p><label>Start time (format: 2011-08-01 17:00)</label><br/><input type="text" name="date-start" id="start-date" value="<?php echo date('Y-m-d H:i',$start_date); ?>"></p>
    <p><label>End time (format: 2011-08-01 17:00)</label><br/><input type="text" name="date-end" id="end-date" value="<?php echo date('Y-m-d H:i',$end_date); ?>"></p>
    <h4>Other event info</h4>
    <p><label>Location (can be an HTML snippet)</label><br/><textarea cols="60" name="location" id="location"><?php echo $location; ?></textarea></p>
    <p><label>Price</label><br/><input type="text" name="price" id="price" value="<?php echo $price; ?>"></p>
<?php
}


// Save the new meta

add_action('save_post', 'rs_date_save_meta');
function rs_date_save_meta( $post_id ) {

    if(!wp_verify_nonce( $_POST['rs_date_nonce'], plugin_basename(__FILE__) ) )
        return;
    if(!current_user_can('edit_posts') )
        return;
    $start_date = $_POST['date-start'];
    $end_date = $_POST['date-end'];

		$start_timestamp = strtotime($start_date);
		$end_timestamp = strtotime($end_date);		
    update_post_meta($post_id, 'date-start', $start_timestamp);
    update_post_meta($post_id, 'date-end', $end_timestamp);
    update_post_meta($post_id, 'location', $_POST['location']);
    update_post_meta($post_id, 'price', $_POST['price']);
}

add_action('init','yoursite_init');
function yoursite_init() {
  global
  $wp,$wp_rewrite;
  $wp->add_query_var('eventday');

	// for daily calendar
	add_rewrite_rule(
		'events/([0-9]{4}-[0-9]{2}-[0-9]{2})',
		'index.php?eventday=$matches[1]&post_type=events',
		'top'
	);

}