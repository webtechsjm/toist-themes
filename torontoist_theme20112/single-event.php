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
							//Events have their own 'event-category' taxonomy. Get list of categories this event is in.
/*
							$categories_list = get_the_term_list( get_the_ID(), 'event-category', '', ', ',''); 
							if("" != $categories_list){
								printf("<h3>%s</h3>",
									$categories_list
									);
							}
*/
							$categories = get_the_terms(get_the_ID(),'event-category');
							$the_category = array_shift($categories);
							
							$category_link = sprintf('<a href="%s">%s</a>',
								site_url()."/events/category/".$the_category->slug,
								$the_category->name
							);
							printf("<h3>%s</h3>",$category_link);
							
						?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php if(has_post_thumbnail()) the_post_thumbnail('large'); ?>
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
														case 3: $schedule_name = join(', ',$schedule_days); break;
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
								
											foreach($occurrences as $occurrence):
												$occ_start = $occurrence['start']->format('l, F j, Y; g:ia');
												printf('<li>%s</li>',
												$occ_start
											);
											endforeach;
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
											//create our time block
											$first_occ = explode(' ',$first_start);
											$first_end = explode(' ',$first_ending);
											$one_day = true;
											
											if($first_start === $first_ending):
												$sched_day = sprintf('%s, %s %s, %s',
														$first_occ[0],
														$first_occ[2],
														$first_occ[1],
														$first_occ[3]
													);
												$sched_time = $first_occ[4];
											elseif($first_occ[1] == $first_end[1]
												&& $first_occ[2] == $first_end[2]
												&& $first_occ[3] == $first_end[3]
												):
												$sched_day = sprintf('%s, %s %s, %s',
														$first_occ[0],
														$first_occ[2],
														$first_occ[1],
														$first_occ[3]
													);
												$sched_time = $first_occ[4].'-'.$first_end[4];
											elseif($first_occ[1] == $first_end[1]):
												
												$sched_day = sprintf('%s, %s %s - %s, %s %s, %s',
														$first_occ[0],
														$first_occ[2],
														$first_occ[1],
														$first_end[0],
														$first_end[2],
														$first_end[1],
														$first_occ[3]
													);
												$compact = false;
												$one_day = false;
											else:
												$sched_day = sprintf('%s, %s %s, %s - %s, %s %s, %s',
														$first_occ[0],
														$first_occ[2],
														$first_occ[1],
														$first_occ[3],
														$first_end[0],
														$first_end[2],
														$first_end[1],
														$first_end[3]
													);
												$one_day = false;
											endif;
											
											if($compact):
												//schedule name, time
												printf('<li class="dates">%s, %s</li>',
													$schedule_name,
													$sched_time
													);
											elseif($one_day):
												printf('<li class="dates">%s, %s</li><li>%s</li>',
													$schedule_name,
													$sched_day,
													$sched_time);
											else:
												//expanded, multiple days
												printf('<li class="dates">%s</li>',$sched_day);												
											endif;
											
										endif;
									else: //doesn't reoccur
										$schedule = eo_get_event_schedule();
										$event_start = explode(' ',eo_get_the_start('l j F Y g:ia'));
										$event_end = explode(' ',eo_get_the_end('l j F Y g:ia'));
										$compact = false;
										if($event_start === $event_end):
												$sched_day = sprintf('%s, %s %s, %s',
														$event_start[0],
														$event_start[2],
														$event_start[1],
														$event_start[3]
													);
												$sched_time = $event_start[4];
											elseif($event_start[1] == $event_end[1]
												&& $event_start[2] == $event_end[2]
												&& $event_start[3] == $event_end[3]
												):
												$sched_day = sprintf('%s, %s %s, %s',
														$event_start[0],
														$event_start[2],
														$event_start[1],
														$event_start[3]
													);
												if(!$schedule['all_day']):
													$sched_time = $event_start[4].'-'.$event_end[4];
												endif;
											elseif($event_start[1] == $event_end[1]):
												
												$sched_day = sprintf('%s, %s %s - %s, %s %s, %s',
														$event_start[0],
														$event_start[2],
														$event_start[1],
														$event_start[0],
														$event_end[2],
														$event_end[1],
														$event_start[3]
													);
												$compact = true;
											else:
												$sched_day = sprintf('%s, %s %s, %s - %s, %s %s, %s',
														$event_start[0],
														$event_start[2],
														$event_start[1],
														$event_start[3],
														$event_end[0],
														$event_end[2],
														$event_end[1],
														$event_end[3]
													);
												$compact = true;
											endif;
										
											if(!$one_day):
												printf('<li class="dates">%s</li><li class="dates">%s</li>',
													$sched_day,
													$sched_time);
											else:
												//expanded, multiple days
												printf('<li class="dates">%s</li>',$sched_day);												
											endif;
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
						<?php the_content(); ?>
						<?php if(isset($venue_addr) && $venue_addr) echo eo_get_venue_map(); ?>
						
						<?php 
							/* check whether the address is exactly the same as venue name */ 
							if(isset($venue_name) && isset($venue_addr) && $venue_name == $venue_addr):
								$workaround = "street-site";
							endif;
								
						?>
						<section class="side-nav clearfix <?php echo $workaround; ?>">
							<h4>What's happening:</h4>
							<a class="today" href="<?php echo get_site_url().'/events/event/?ondate='.date('Y-m-d'); ?>">Today</a>
							<?php if(isset($the_category) && "" != $the_category){
								printf('<a class="category" href="%s">In %s</a>',
									site_url()."/events/category/".$the_category->slug,
									$the_category->name
									);
								
								}	?>
							<?php 
								if(isset($venue_url) && isset($venue_name) 
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
