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

			<?php if ( have_posts() ) : ?>

				<!---- Page header, display category title-->
				<header class="page-header">
					<h2 class="page-title"><?php
						printf( __( 'Upcoming in %s', 'eventorganiser' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h2>

				<!---- If the category has a description display it-->
					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</header>

				<!---- Navigate between pages-->
				<!---- In TwentyEleven theme this is done by twentyeleven_content_nav-->
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
								<?php else: ?>
									<!-- Event is not an all day event - display time -->
									<li class="dates"><?php eo_the_start('l, F j, Y; g:ia'); ?></li>
								<?php endif; ?>
							</ul><!-- .entry-details -->

						</header><!-- .entry-header -->
						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->

					</article><!-- #post-<?php the_ID(); ?> -->

    				<?php endwhile; ?><!----The Loop ends-->

				<!---- Navigate between pages-->
				<?php 
				if ( $wp_query->max_num_pages > 1 ) : ?>
					<nav id="nav-below">
						<div class="nav-next events-nav-newer"><?php next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'eventorganiser' ) ); ?></div>
						<div class="nav-previous events-nav-newer"><?php previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'eventorganiser' ) ); ?></div>
					</nav><!-- #nav-below -->
				<?php endif; ?>

			<?php else : ?>

				<!---- If there are no events -->
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'eventorganiser' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no events were found for the requested category. ', 'eventorganiser' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<!-- Call template sidebar and footer -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
