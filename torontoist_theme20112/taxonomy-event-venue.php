<?php
/**
 * The template for displaying the venue page
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
		<div id="primary">
		<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<!-- Page header, display venue title-->
				<header class="page-header">	
				<h2 class="page-title"><?php
					printf( __( 'Events: %s', 'eventorganiser' ), '<span class="tax-name">' .eo_get_venue_name(). '</span>' );
				?></h2>

				<!-- Display the venue map. If you specify a class, ensure that class has height/width dimensions-->
				<?php echo eo_get_venue_map( eo_get_venue(), array('width'=>"100%") ); ?>
			</header><!-- end header -->

				<!-- Navigate between pages-->
				<!-- In TwentyEleven theme this is done by twentyeleven_content_nav-->
				<?php 
				if ( $wp_query->max_num_pages > 1 ) : ?>
					<nav id="nav-above">
						<div class="nav-next events-nav-newer"><?php next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'eventorganiser' ) ); ?></div>
						<div class="nav-previous events-nav-newer"><?php previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'eventorganiser' ) ); ?></div>
					</nav><!-- #nav-above -->
				<?php endif; ?>


				<?php
						//Get the description and print it if it exists
						$venue_description =eo_get_venue_description();

						if(!empty($venue_description)){?>
							<!-- If the venue has a description display it-->
							<div class="venue-archive-meta">
								<strong><?php $addr = eo_get_venue_address(); echo $addr['address']; ?></strong> <?php echo $venue_description; ?>
							</div>
						<?php 
						}else{?>
							<div class="venue-archive-meta">
								<strong><?php $addr = eo_get_venue_address(); echo $addr['address']; ?></strong>
							</div>
						<?php } ?>
						
				<!-- This is the usual loop, familiar in WordPress templates-->
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
								<li class="dates">
									
									<?php 
										
										$occurrences = eo_get_the_occurrences_of(get_the_ID());
										$first = array_shift($occurrences);
										$last = array_pop($occurrences);
										
										if($last == NULL) $last = $first;
																				
										$range = the_date_range($first['start'],$last['start']);
										if(is_array($range)){
											echo $range['date'];
											if(isset($range['time'])){
												printf('</li><li class="dates">%s',
													$range['time']
												);
											}
										}else{
											echo $range;
											}
										
										if(eo_is_all_day()){
											echo ", ";
											_e('All day','eventorganiser');
										}
									?>
									
									</li>
							</ul><!-- .entry-details -->

						</header><!-- .entry-header -->
						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->

					</article><!-- #post-<?php the_ID(); ?> -->

    				<?php endwhile; ?><!-- The Loop ends-->

				<!-- Navigate between pages-->
				<?php 
				global $wp_query;
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
						<p><?php _e( 'Apologies, but no events were found for the requested venue. ', 'eventorganiser' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<!-- Call template sidebar and footer -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
