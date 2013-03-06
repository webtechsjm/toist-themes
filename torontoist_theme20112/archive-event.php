<?php
//Call the template header
get_header(); ?>

		<!-- This template follows the TwentyEleven theme-->
		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<!-- Page header -->
				<header class="page-header">
					<h2 class="page-title"><?php
					$ondate = $_GET['ondate'];
					if(!preg_match('/[^0-9|-]/',$ondate)){
						printf('Events: <span class="tax-name">%s</span>',
							eo_format_date($ondate,'l, F j, Y')
							);
					}else{
						_e('Events','eventorganiser');
					}
					
					?></h2>
				</header>

				<!-- Navigate between pages -->
				<!-- In TwentyEleven theme this is done by twentyeleven_content_nav -->
				<?php /* Start the Loop */ ?>
				<?php 
					$repeating_events = array();
					while ( have_posts()) : the_post();
					global $post;
					
					$event_start = eo_get_schedule_start();
					$today = eo_format_date($ondate,'d-m-Y');
					
					if($event_start != $today):
						$repeating_events[] = $post;
						continue;
					endif;
					
					?>
					<?php get_template_part('event-atom-daily'); ?>		
					
    		<?php endwhile; ?><!-- The Loop ends-->
				
				
				<?php if(count($repeating_events) > 0): ?>
				<h3 class="section-title">Ongoing&hellip;</h3>
				<?php endif; ?>
				<?php 
					$old_post = $post;
					while($post = array_shift($repeating_events)):
						get_template_part('event-atom-daily');
					endwhile;
					$post = $old_post;
				
				?>
				

			<?php else : ?>
				<!-- If there are no events -->
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h2 class="entry-title"><?php _e( 'Nothing Found', 'eventorganiser' ); ?></h2>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Looks like we don\'t have any events that match your search yet. We\'re always adding more though, so try again soon!' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>
			<?php
					$archive_date = new DateTime($ondate);
					$lastDay = clone($archive_date);
					$lastDay->modify('-1 day');
					$nextDay = clone($archive_date);
					$nextDay->modify('+1 day');
					$archive_baseurl = get_site_url()."/events/event/?ondate=";
				
					printf('<nav class="post-nav"><div class="older-posts"><a href="%s">&laquo; %s</a></div><div class="newer-posts"><a href="%s">%s &raquo;</a></div></nav>',
					$archive_baseurl.$lastDay->format('Y-m-d'),
					$lastDay->format('l, F j'),
					$archive_baseurl.$nextDay->format('Y-m-d'),
					$nextDay->format('l, F j'));
				?>

			</div><!-- #content -->
		</section><!-- #primary -->

<!-- Call template sidebar and footer -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
