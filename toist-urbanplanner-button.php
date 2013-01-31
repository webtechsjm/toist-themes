<?php
/*
Plugin Name: Torontoist Urban Planner button
Plugin URI:
Version: 0.1
Description: Adds a button to the editor to generate the Event Organiser shortcode
Author: Senning Luk
Author URI: http://puppydogtales.ca
*/

add_action( 'admin_print_footer_scripts', 'toist_quicktags',100);
function toist_quicktags( $args, $post_id ) 
{ 
?>
<script type="text/javascript">
	QTags.addButton('toist_urbanplanner','Urban Planner',planner_maker,'','p');
	function planner_maker(e,c,ed){
		var d = new Date();
		var weekday = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
		var ymd = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + d.getDate();
		var ymdTomorrow = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + (d.getDate()+1);
		var ymdTwoDays = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + (d.getDate()+2);
		var ymdThreeDays = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + (d.getDate()+3);
		var strTwoDays = weekday[(d.getDay() + 2) % 7];
		var strThreeDays = weekday[(d.getDay() + 3) % 7];
		var events_url = 'http://torontoist.com/events/event/?ondate=';
		
		this.tagStart = '[eo_events ondate="'+ymd+'"]<strong class="event-cat">%event_cats_terms%:</strong> %event_content% %event_location%, %start{g:i a}{}%, %event_price%.[/eo_events] '
			+'\n\n<em>Urban Planner is</em> Torontoist<em>\'s guide to what\'s on in Toronto, published every weekday morning, and in a weekend edition Friday afternoons. If you have an event you\'d like considered, email all of its details—as well as images, if you\'ve got any—to <a href="mailto:events@torontoist.com">events@torontoist.com</a>.</em>'
			+'\n\n<section class="side-nav"><h4>Happening soon:</h4><div class="clearfix"><a href="'+events_url+ymdTomorrow+'">Tomorrow</a> <a href="'+events_url+ymdTwoDays+'">'+strTwoDays+'</a> <a href="'+events_url+ymdThreeDays+'">'+strThreeDays+'</a></div></section>';
		
		QTags.TagButton.prototype.callback.call(this,e,c,ed);
	}

	QTags.addButton('toist_weekendplanner','Weekend Planner',weekend_planner_maker,'','w');
	function weekend_planner_maker(e,c,ed){
		var d = new Date();
		var weekday = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
		var ymd = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + d.getDate();
		var ymdTomorrow = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + (d.getDate()+1);
		var ymdTwoDays = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + (d.getDate()+2);
		var ymdThreeDays = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + (d.getDate()+3);
		var ymdFourDays = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + (d.getDate()+4);
		var strTwoDays = weekday[(d.getDay() + 2) % 7];
		var strThreeDays = weekday[(d.getDay() + 3) % 7];
		var strFourDays = weekday[(d.getDay() + 4) % 7];
		var events_url = 'http://torontoist.com/events/event/?ondate=';
		
		this.tagStart = '[eo_events event_start_after="'+ymd+'" event_start_before="'+ymdTomorrow+'"]<strong class="event-cat">%event_cats_terms%:</strong> %event_content% %event_location%, %start{g:i a}{}%, %event_price%.[/eo_events] '
			+'\n\n<em>Urban Planner is</em> Torontoist<em>\'s guide to what\'s on in Toronto, published every weekday morning, and in a weekend edition Friday afternoons. If you have an event you\'d like considered, email all of its details—as well as images, if you\'ve got any—to <a href="mailto:events@torontoist.com">events@torontoist.com</a>.</em>'
			+'\n\n<section class="side-nav"><h4>Happening soon:</h4><div class="clearfix"><a href="'+events_url+ymdTwoDays+'">'+strTwoDays+'</a> <a href="'+events_url+ymdThreeDays+'">'+strThreeDays+'</a> <a href="'+events_url+ymdFourDays+'">'+strFourDays+'</a></div></section>';
		
		QTags.TagButton.prototype.callback.call(this,e,c,ed);
	}	
	
</script>
<?php }


?>
