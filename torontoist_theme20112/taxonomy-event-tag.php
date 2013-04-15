<?php
/**
 * The template for displaying an event-category page
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

		<!-- This template follows the TwentyEleven theme-->
		<section id="primary">
			<div id="content" role="main">
			<?php if(function_exists('the_hub_banner')) the_hub_banner(); ?>

			<?php if ( have_posts() ) : ?>

				<!---- Page header, display category title-->
				<header class="page-header">
					<h2 class="page-title"><?php
						printf( __( 'Events: %s', 'eventorganiser' ), '<span class="tax-name">' . single_cat_title( '', false ) . '</span>' );
					?></h2>

				<!-- If the category has a description display it-->
					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</header>

				<!-- Navigate between pages-->
				<!-- In TwentyEleven theme this is done by twentyeleven_content_nav-->
				<?php 
				global $wp_query;
				if ( $wp_query->max_num_pages > 1 ) : ?>
					<nav id="nav-above">
						<div class="nav-next events-nav-newer"><?php next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'eventorganiser' ) ); ?></div>
						<div class="nav-previous events-nav-newer"><?php previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'eventorganiser' ) ); ?></div>
					</nav><!-- #nav-above -->
				<?php endif; ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts()) : the_post(); 
					$eo_classes = eo_get_event_classes();
					?>
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
								
								the_event_star_rating();
								?>
								
							</ul><!-- .entry-details -->

						</header><!-- .entry-header -->
						<div class="entry-content">
							<?php the_content(''); ?>
						</div><!-- .entry-content -->
						<a href="<?php the_permalink() ?>" class="more-link">
							<span class="morelink">Details: </span>
							<?php the_title(); ?>
						</a>

					</article><!-- #post-<?php the_ID(); ?> -->

    				<?php endwhile; ?><!--The Loop ends-->

				<!-- Navigate between pages-->
				<?php 
				if ( $wp_query->max_num_pages > 1 ) : ?>
					<nav id="nav-below">
						<div class="nav-next events-nav-newer"><?php next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'eventorganiser' ) ); ?></div>
						<div class="nav-previous events-nav-newer"><?php previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'eventorganiser' ) ); ?></div>
					</nav><!-- #nav-below -->
				<?php endif; ?>

			<?php else : ?>

				<!-- If there are no events -->
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'eventorganiser' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Looks like we don\'t have any events that match your search yet. We\'re always adding more though, so try again soon!', 'eventorganiser' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<!-- Call template sidebar and footer -->
<?php get_sidebar('home'); ?>
<?php get_footer(); ?>
