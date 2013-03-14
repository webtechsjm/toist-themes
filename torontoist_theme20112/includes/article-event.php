<?php $eo_classes = eo_get_event_classes(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($eo_classes); ?>>

	<header class="entry-header">
		
	<?php
		//Events have their own 'event-category' taxonomy. Get list of categories this event is in.
		$categories_list = get_the_term_list( get_the_ID(), 'event-category', '', ', ',''); 
		if("" != $categories_list){
			printf("<h3>%s</h3>",
				$categories_list
				);
		}
		
	?>
		
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_featured_media('large'); ?>
		<ul class="entry-details">
			<!-- If the event has a venue saved, display this-->
			<?php
				//get the name and address. If we have both, only link from the address.
				$venue_name = eo_get_venue_name();
				$venue_address = eo_get_venue_address();
				$venue_addr = $venue_address['address'] ? $venue_address['address'] : '';
				
				if($venue_name && $venue_addr){
					$venue_text = '<li class="venue">%1$s (%2$s)</li>';
				}elseif($venue_name){
					$venue_text = '<li class="venue">%1$s</li>';
				}elseif($venue_addr){
					$venue_text = '<li class="venue">%2$s</li>';
				}else{
					$venue_text = false;
				}
				
				if($venue_text)
				printf($venue_text,
					$venue_name,
					$venue_addr,
					eo_get_venue_link()
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
					$event_start = $schedule['schedule_start'];
					$event_end = $schedule['schedule_finish'];
					
					
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
				$price = get_post_meta(get_the_ID(),'price',true);
				if($price != ""){
					printf('<li class="price">%s</li>',$price);
				}
				
				the_event_star_rating(); ?>
		</ul><!-- .entry-details -->

	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
			global $post;
			$content = get_post($post);
			$content = apply_filters('the_content', $content->post_content);
			$content = str_replace(']]>', ']]&gt;', $content);
			echo $content;
		?>
	</div><!-- .entry-content -->
	<a href="<?php the_permalink() ?>" class="more-link">
		<span class="morelink">Details: </span>
		<?php the_title(); ?>
	</a>

</article><!-- #post-<?php the_ID(); ?> -->
