<?php
/**
 * The template for displaying a single event
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory. 
 *
 * WordPress will automatically prioritise the template in your theme directory.
 ***************** NOTICE: *****************
 *
 * @package Event Organiser (plug-in)
 * @since 1.0.0
 */

//Call the template header
get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); 
				$eo_classes = eo_get_event_classes();?>

				<article id="post-<?php the_ID(); ?>" <?php post_class($eo_classes); ?>>

					<header class="entry-header">
					<?php edit_post_link( __( 'Edit'), '<span class="edit-link">', '</span>' ); ?>
						<?php
							$categories = get_the_terms(get_the_ID(),'event-category');
							$the_category = array_shift($categories);
							
							$category_link = sprintf('<a href="%s">%s</a>',
								site_url()."/events/category/".$the_category->slug,
								$the_category->name
							);
							printf("<h3>%s</h3>",$category_link);
							
						?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
		        <p class="dek">
		            <?php get_custom_field('dek', TRUE); ?>
		        </p>
		        
		        <p class="byline">By 
		            <?php if(function_exists('coauthors_posts_links'))
		                coauthors_posts_links(', ', ', and ', '', '');
		                else
		                the_author_posts_link();
		            ?>
		            <?php if ($post_image_credit = get_post_meta($post->ID, 'image_credit', true)) {
		            echo ' &bull; ' . $post_image_credit; } ?>                    
		        </p>
						
						<?php 
							the_featured_media('large');
							?>
							<ul class="entry-details">							
								<?php
									//get the name and address. If we have both, only link from the address.
									$venue_name = eo_get_venue_name();
									$venue_address = eo_get_venue_address();
									$venue_addr = $venue_address['address'] ? $venue_address['address'] : '';
									$venue_url = eo_get_venue_link();
									if($venue_name && $venue_addr && $venue_name != $venue_addr){
										$venue_text = '<li class="venue">%1$s (%2$s)</li>';
									}elseif($venue_name){$venue_text = '<li class="venue">%1$s</li>';
									}elseif($venue_addr){$venue_text = '<li class="venue">%2$s</li>';
									}else{$venue_text = false;}
									
									if($venue_text)
									printf($venue_text,
										$venue_name,
										$venue_addr,
										$venue_url
										);
								?>
								
								<?php
										
									if(eo_reoccurs()):
										$schedule = eo_get_event_schedule();
										//see if our first and last occurence are the same month.
										$occurrences = eo_get_the_occurrences_of();
										$last_occurrence = eo_get_schedule_last('l j F Y g:ia');
										$first_occurrence = array_shift($occurrences);
										$first_start = $first_occurrence['start']->format('l j F Y g:ia');
										$first_ending = $first_occurrence['end']->format('l j F Y g:ia');
										$compact = false;
										
										$accr_days = array(
											'SU'	=>	'Sundays',
											'MO'	=>	'Mondays',
											'TU'	=>	'Tuesdays',
											'WE'	=>	'Wednesdays',
											'TH'	=>	'Thursdays',
											'FR'	=>	'Fridays',
											'SA'	=>	'Saturdays'
										);
										
										//establish our terms
										if($schedule['frequency'] === 1):
											//Event occurs at every period
											switch($schedule['schedule']):
												case 'daily': $schedule_name = "Daily"; break;
												case 'weekly':
													//expand the accronym
													$schedule_days = array();
													foreach($schedule['schedule_meta'] as $day):
														$schedule_days[] = $accr_days[$day];
													endforeach;
													//pack it back together
													switch(count($schedule_days)):
														case 1:	$schedule_name = $schedule_days[0]; break;
														case 2: $schedule_name = 	join(' and ',$schedule_days); break;
														case 3: 
														case 4:
														case 5: $schedule_name = join(', ',$schedule_days); break;
														case 6: 
															$off_day = array_diff($accr_days,$schedule_days);
															$off_day = array_shift($off_day);
															$schedule_name = "Daily except ".$off_day;
															break;
													endswitch;
													$compact = true;
													break;
												case 'monthly':
													$schedule_meta = explode('=',$schedule['schedule_meta']);
													
													switch($schedule['occurs_by']):
														//either BYDAY (the 3rd Tuesday, 3TU, of the month)
														//or BYMONTHDAY (the 21st of the month)
														case 'BYMONTHDAY':
															$ordinal = toist_ordinalizer($schedule_meta[1]);
															$schedule_name = 'Monthly on the '.$ordinal; break;
															break;
														case 'BYDAY':
															$schedule_designator = intval($schedule_meta[1]);
															$schedule_dayofweek = substr($schedule_meta[1],1,2);
															$ordinal = toist_ordinalizer($schedule_designator);
															$schedule_name = sprintf('%s %s',
																$ordinal,
																$accr_days[$schedule_dayofweek]
																);
															break;
													endswitch;
													$compact = true;
													break;
												case 'yearly': $schedule_name = "Annually,"; break;
												default: $schedule_name = "";
											endswitch;
										else: //event occurs at every Nth period
											switch($schedule['schedule']):
												case 'daily': $schedule_name = "days"; break;
												case 'weekly': $schedule_name = "weeks"; break;
												case 'monthly': $schedule_name = "months"; break;
												case 'yearly': $schedule_name = "years"; break;
												default: $schedule_name = "";
											endswitch;
											if($schedule_name):
												$schedule_name = sprintf('Every %s %s',
													$schedule['frequency'],
													$schedule_name
													);
											endif;
										endif;
										
									
										
																		
										if($schedule['schedule'] == 'irregular'
											|| $schedule['schedule'] == 'custom' ):								
											echo '<li class="dates"><ul class="recur">';
											$occurrences = eo_get_the_occurrences_of();
											
											if(count($occurrences) <= 3){
												foreach($occurrences as $occurrence):
													$formatted = the_date_range($occurrence['start'],$occurrence['end']);
													if(is_array($formatted)){
														
														if($formatted['duration']->days > 0){
															printf('<li class="dates">%s</li>',
																$formatted['date']
																);
														}else{
															printf('<li class="dates">%s; %s</li>',
																$formatted['date'],
																$formatted['time']
																);
														}
													}else{
														printf('<li class="dates">%s<li>',$formatted);
													}
												endforeach;
											}else{
												//too many occurrences to list! Show the range and make the calendar
												$ids = array_keys($occurrences);
												$span_start = $occurrences[$ids[0]]['start'];
												$span_end = $occurrences[$ids[count($occurrences) - 1]]['end'];
												$show_calendar = true;
												
												$formatted = the_date_range($span_start,$span_end,true);
												if(is_array($formatted)){
													printf('<li class="dates">%s</li><li class="dates">%s</li>',
														$formatted['date'],
														$formatted['time']
														);
												}else{
													printf('<li class="dates">%s<li>',$formatted);
												}
												
												$recurrence_calendar = eo_make_calendar($occurrences);
												
											}
																			
											
											echo "</ul></li>";
										//a regular recurrence
										elseif($schedule['all_day']):
											$first_occ = explode(' ',$first_start);
											$sched_day = $first_occ[0];
											$sched_time = "all day";
											if($schedule_name):
												printf('<li class="dates">%s, %s</li>',
													$schedule_name,
													$sched_time);
											else:
												printf('<li class="dates">%s, %s</li>',
													$sched_day,
													$sched_time);	
											endif;
										else:
											$formatted = the_date_range(
												$first_occurrence['start'],
												$first_occurrence['end']
												);
											$schedule_span = the_date_range(
												$first_occurrence['start']->modify("00:00"),
												$schedule['schedule_finish']->modify("00:00"),
												$one_day = true
												);
												
											if(is_array($formatted)){
												printf('<li class="dates">%s, %s</li><li class="dates">%s</li>',
													$schedule_name,
													$formatted['time'],
													is_array($schedule_span) ? $schedule_span['date'] : $schedule_span
													);
											}else{
												printf('<li class="dates">%s</li><li class="dates">%s</li>',
													$schedule_name,
													is_array($schedule_span) ? $schedule_span['time'] : $schedule_span
													);
											}
											
										endif;
									else: //doesn't reoccur
										$schedule = eo_get_event_schedule();
										
										$event_start = new DateTime(eo_get_the_start('Y-m-d H:i:s'));
										$event_end = new DateTime(eo_get_the_end('Y-m-d H:i:s'));
										
										$formatted = the_date_range($event_start,$event_end);
										if(is_array($formatted)){
											printf('<li class="dates">%s</li><li class="dates">%s</li>',
												$formatted['date'],
												$formatted['time']
												);
										}else{
											printf('<li class="dates">%s<li>',$formatted);
										}
									endif; //end reoccurrence check
								
									$meta = get_post_meta(get_the_ID());
									printf('<li class="price">%s</li>',
										$meta['price'][0]
									);
								?>
							</ul><!-- .entry-meta -->

					</header><!-- .entry-header -->
	
					<div class="entry-content">
						<!-- The content or the description of the event-->
						<?php
							if($recurrence_calendar) 
								printf('<div class="recurrence"><h2>Performance dates</h2>%s</div>',$recurrence_calendar);
						?>
						<?php the_content(); ?>
						<?php if(isset($venue_addr) && $venue_addr) echo eo_get_venue_map(); ?>
						
						<?php 
							/* check whether the address is exactly the same as venue name */ 
							if(isset($venue_name) && isset($venue_addr) && $venue_name == $venue_addr):
								$workaround = "street-site";
							endif;
								
						?>
						<section class="side-nav clearfix <?php echo $workaround; ?>">
							<h4>What else is happening:</h4>
							<a class="today" href="<?php echo get_site_url().'/events/event/?ondate='.date('Y-m-d'); ?>">Today</a>
							<?php if(isset($the_category) && "" != $the_category){
								printf('<a class="category" href="%s">In %s</a>',
									site_url()."/events/category/".$the_category->slug,
									$the_category->name
									);
								
								}	?>
							<?php 
								if(isset($venue_url) && isset($venue_name) 
								&& strtoupper($venue_name) != "MULTIPLE VENUES"
								&& is_string($venue_url) && is_string($venue_name)): ?>
								<a class="venue" href="<?php echo $venue_url; ?>"><?php echo "at ".$venue_name; ?></a>
							<?php endif; ?>
						</section>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
					
					<section class="tag-list">
                        <?php 
			  global $post; 
			  echo get_the_term_list($post->ID,'event-tag','Filed under: ',', ');
			?>
                    </section>
                    
                    <section class="tools">
<?php
echo do_shortcode('[pinit]');
?>
                        <span class="google-plus">
                        <!-- Start Google +1 -->
                        <g:plusone size="medium"></g:plusone>
                        <script type="text/javascript">
                          (function() {
                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                            po.src = 'https://apis.google.com/js/plusone.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                          })();
                        </script>
                        <!-- End Google +1 -->
                        </span>
                        


                        <!-- Start ShareThis -->                        
                        <script charset="utf-8" type="text/javascript">var switchTo5x=false;</script><script charset="utf-8" type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'wp.0aa23093-2b8c-4fd5-9602-c686dee727c9'});var st_type='wordpress3.2';</script>
                        <span class='st_facebook_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='like'></span>
                        <span class='st_twitter_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span>
                        <span class='st_email_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='email'></span>
                        <!--span class='st_sharethis_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span-->                  
                        <!-- End ShareThis --> 

                        
                        <a href="mailto:tips@torontoist.com?subject=Error&nbsp;in&nbsp;article">Report error</a>
                        
                        <a href="mailto:tips@torontoist.com?subject=Tip">Send a tip</a>               
                    </section>
					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->
				<div class="comments-template">
<?php comments_template(); ?>
</div>				

						
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<!-- Call template footer -->
<?php
function toist_ordinalizer($number){
	//taken from http://stackoverflow.com/questions/3109978/php-display-number-with-ordinal-suffix
	$ends = array('th','st','nd','rd','th','th','th','th','th','th');
	if (($number %100) >= 11 && ($number%100) <= 13)
		$ordinal = $number. 'th';
	else
		$ordinal = $number. $ends[$number % 10];
		
	return $ordinal;
}
?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php

//given two datetime objects, return the formatted range

function the_date_range($start_dt,$end_dt, $one_day = false){
	
	$duration = $start_dt->diff($end_dt);
	$start = explode(" ",$start_dt->format('l F j Y g i a'));
	$end = explode(" ",$end_dt->format('l F j Y g i a'));
	
	//happening at the same time
	if($start == $end){
		return array(
			"date"	=>	sprintf(
				"%s, %s %s",
				$start[0], //day of week
				$start[1], //month
				$start[2] //day of month
				),
			"duration"	=>	$duration,
			"time"	=>	eo_is_all_day() ? 'all day' : time_compact_ap_format($start[4],$start[5],$start[6])
		);
	}	
	//happening on the same day
	elseif($start[2] == $end[2] || ($duration->days < 1 && $duration->h < 24)){
		//Monday, March 4; 9:00 p.m.
		return array(
			"date"	=>	sprintf(
				"%s, %s %s",
				$start[0], //day of week
				$start[1], //month
				$start[2] //day of month
				),
			"duration"	=>	$duration,
			"time"	=>	eo_is_all_day() ? 'all day' : sprintf(
				"%s&ndash;%s",
				time_compact_ap_format($start[4],$start[5],$start[6]),
				time_compact_ap_format($end[4],$end[5],$end[6])	 //formatted date
				)
			);
	}
	//happening in the same month
	//check if happening all day; if not, return eo_all_day ? : 
	elseif($start[1] == $end[1]){
		return (eo_is_all_day() || $one_day) ? 
		sprintf(
			"%s %s&ndash;%s",
			$start[1], //month
			$start[2], //day of month
			$end[2]
		)
		: 
		array(
			"date" => sprintf(
				"%s, %s %s&ndash;%s, %s %s",
				time_compact_ap_format($start[4],$start[5],$start[6]),
				$start[1],
				$start[2],
				time_compact_ap_format($end[4],$end[5],$end[6]),
				$end[1],
				$end[2]					
				),
			"duration"	=>	$duration,
			"time"	=>	sprintf(
				"%s&ndash;%s",
				time_compact_ap_format($start[4],$start[5],$start[6]),
				time_compact_ap_format($end[4],$end[5],$end[6])
			)
		);
	}
	//happening in the same year
	elseif($start[0] == $end[0]){
		return (eo_is_all_day() || $one_day) ?
			sprintf(
				"%s, %s %s&ndash;%s, %s %s",
				$start[0], //day of week
				$start[1], //month
				$start[2], //day of month
				$end[0],
				$end[1],
				$end[2]
			)
			:
			array(
				"date"	=>	sprintf(
					"%s, %s, %s %s&ndash;%s, %s, %s %s",
					time_compact_ap_format($start[4],$start[5],$start[6]),
					$start[0],
					$start[1],
					$start[2],
					time_compact_ap_format($end[4],$end[5],$end[6]),
					$end[0],
					$end[1],
					$end[2]
				),
				"duration"	=>	$duration,
				"time"	=>	sprintf("%s&ndash;%s",
					time_compact_ap_format($start[4],$start[5],$start[6]),
					time_compact_ap_format($end[4],$end[5],$end[6])
				)
			);
	}
	//just plain happening

	else{
		return (eo_is_all_day() || $one_day) ? 
			sprintf(
				"%s, %s %s&ndash;%s, %s %s",
				$start[0], //day of week
				$start[1], //month
				$start[2], //day of month
				$end[0],
				$end[1],
				$end[2]
			)
			:
			array(
				"date"	=>	sprintf(
					"%s, %s, %s %s&ndash;%s, %s, %s %s",
					time_compact_ap_format($start[4],$start[5],$start[6]),
					$start[0],
					$start[1],
					$start[2],
					time_compact_ap_format($end[4],$end[5],$end[6]),
					$end[0],
					$end[1],
					$end[2]
				),
				"duration"	=>	$duration,
				"time"	=>	sprintf("%s&ndash;%s",
					time_compact_ap_format($start[4],$start[5],$start[6]),
					time_compact_ap_format($end[4],$end[5],$end[6])
				)
			);
	}
}

function time_compact_ap_format($hours,$minutes,$meridien){
	$patterns = array("am","pm","AM","PM");
	$replacements = array("a.m.","p.m.","A.M.","P.M.");
	
	$meridien = str_replace($patterns,$replacements,$meridien);
	
	if($minutes == "00") return sprintf("%s %s",$hours,$meridien);
	else return sprintf("%s:%s %s",$hours,$minutes,$meridien);
}

function eo_make_calendar($list){
	$occs = array();
	
	if(count($list) < 1) return false;
	
	//output start dates as [year][day of year]	=> id
	foreach($list as $occurrence){
		$occs[$occurrence['start']->format("Y-z")][] = the_date_range($occurrence['start'],$occurrence['end']);
	}
	
	//get year and week of the first occurrence
	//the monday of that week is our calendar start
	$tracker = array_shift(array_values($list));
	$tracker = $tracker['start'];
	
	$week = $tracker->format("W");
	$month = $tracker->format("n");
		
	$start_of_week = clone $tracker;
	$start_of_week->modify("Monday this week");
		
	if($start_of_week->format("n") == $month){
		$tracker = $start_of_week;
	}else{
		$tracker = new DateTime($tracker->format("Y-m-1"));
	}
	$one_day = new DateInterval("P1D");
	
	$html = '';
	$week = null;
	$month = null;
	$week_counter = 0;
		
	while(count($occs) > 0 || $week_counter > 0){
		if($tracker->format("F") != $month){
			$start_of_week = clone $tracker;
			$start_of_week->modify("Monday this week");
			$week_padding = $start_of_week->diff($tracker);
			$week_padding = $week_padding->d > 0 ? sprintf('<td class="padding" colspan="%d">',$week_padding->d) : '';

			$month = $tracker->format("F");
			$week = $tracker->format("W");
			
			$html .= sprintf('</tr></table><h4>%s</h4><table class="month"><tr>%s',
				$month,
				$week_padding
				);
		}elseif($tracker->format("W") != $week){
			$html .= '</tr><tr>';
			$week = $tracker->format("W");
		}
		
		
		//the day cell maker
		$attr = "";
		
		if(isset($occs[$tracker->format("Y-z")])){
			//we're just going to assume this is the first remaining element of the array... because it should be
			$times = array();
			foreach($occs[$tracker->format("Y-z")] as $occ){
				$times[] = $occ['time'];
			}
			array_shift($occs);
			
			$attr = 'class="active" title="'.$tracker->format("l, F j").': '.join(', ',$times).'"';
		}
		
		$html .= sprintf('<td %s>%s</td>',
			$attr,
			$tracker->format("j")
			);
			
			
		if($week_counter > 0){
			$week_counter--;
		}elseif(count($occs) == 0 && $week_counter == 0){
			$end_of_week = clone $tracker;
			$end_of_week->modify("Sunday this week");
			$end_of_week = $end_of_week->diff($tracker);
			$week_counter = ($end_of_week->days < 7) ? $end_of_week->days : $end_of_week->days % 7;
		}
		$tracker->add($one_day);
	}
	$html.= "</tr></table>";
	
	
	return $html;

}

?>
