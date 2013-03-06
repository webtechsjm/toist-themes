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
								<?php if(eo_is_all_day()):?>
									<!-- Event is an all day event -->
									<li class="dates"><?php _e('All day','eventorganiser'); ?></li>
								<?php else: 
									//we want the list of all occurrences today
									//var_dump(eo_get_the_occurrences_of(get_the_ID()));
									//$today = 
								
								
								?>
									<!-- Event is not an all day event - display time -->
									<li class="dates"><?php eo_the_start('g:ia'); ?></li>
								<?php endif; ?>
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

					</article><!-- #post-<?php the_ID(); ?> -->
