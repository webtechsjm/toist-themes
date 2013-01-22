<?php get_header(slideshow); ?>

<!-- image.php -->
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<div id="content">

	<header>

		<h2><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a></h2> 
	</header>

		<article class="post" id="post-<?php the_ID(); ?>">
			<!--start slide-->
			
			<?php 
				$defaults = array( 
					'post_parent' => $post->post_parent,
					'post_type' => 'attachment', 
					'numberposts' => -1,
					'post_status' => 'any',
					'post_mime_type' => 'image',
					'order' => 'ASC',
					'orderby' => 'menu_order'
				);
				
				$images = array_values(get_children( $defaults ));
				
				if ( empty($images) ) {
					// there are no attachments
				} else {
					foreach ( $images as $k => $attachment ) {
						if ( $attachment->ID == $post->ID ) {
							break;
						}
					}
					$k++;
					
					$attachment_img = wp_get_attachment_image( $post->ID, 'full' );
				}
				
				$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' );


				echo ('<a href="');
				echo ($image_attributes[0]);
				echo ('" rel="lightbox">');
				echo($attachment_img);
				echo ('</a>');

			
				?>

			<!--end slide-->
			
			<span class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></span>
			<div id="gallery-nav">
			  <span class="previous"><?php  mf_previous_image_link('&lsaquo;&lsaquo; Previous') ?></span>
			
			  <?php echo('<span class="slide-count"> Image: '.$k.' of '.count($images).'</span>'); ?>
		
			  <span class="next"><?php mf_next_image_link('Next &rsaquo;&rsaquo;') ?></span>

<div class="mobileonly">
<span class="description"><?php the_content (); // usually for photo credit ?></span>
</div>
			</div>


<br clear="all"><span class="return"><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment">Return to article: <?php echo get_the_title($post->post_parent); ?></a></span>
					
		</article>
<?php echo do_shortcode('[gallery id="'.$post->post_parent.'" columns="7"]'); ?>	
	</div>

		

	
	<div id="sidebar">

		<section id="logo">
		  <a href="/"><img src="/wp-content/themes/torontoist_theme20112/images/graphics/Torontoist-whiteonblack-gallery.png"></a>				
		</section>

			<div id="gallery-nav">
			  <span class="previous"><?php  mf_previous_image_link('&lsaquo;&lsaquo; Previous') ?></span>
			
			  <?php echo('<span class="slide-count"> Image: '.$k.' of '.count($images).'</span>'); ?>
		
			  <span class="next"><?php mf_next_image_link('Next &rsaquo;&rsaquo;') ?></span>

			</div>

<br clear="all">
		
		<section id="slide-info">	
			<span class="description"><?php the_content (); // usually for photo credit ?></span>
		</section>	

		<section id="social-media">
			<!-- Start ShareThis -->                        
			<script charset="utf-8" type="text/javascript">var switchTo5x=false;</script><script charset="utf-8" type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'wp.0aa23093-2b8c-4fd5-9602-c686dee727c9'});var st_type='wordpress3.2';</script>
			<span class='icon st_facebook_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='like'></span>
			<span class='icon st_twitter_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span>
			<span class='icon st_email_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='email'></span>
			<!--span class='st_sharethis_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span-->                  
			<!-- End ShareThis --> 
		</section>
		
<br clear="all"><span class="return"><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment">Return to article: <?php echo get_the_title($post->post_parent); ?></a></span>		

<section id="sidebar_ad">

        <div class="big-box" style="display:inline">
        </div>
		<!-- TST_BB_Upper -->
		<div id='div-gpt-ad-1347634485931-0'>
		<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1347634485931-0'); });
		</script>
		</div>
</section>
		
	</div><!--end gallery sidebar-->
	
		
	<?php endwhile; else: ?>
		<p>Sorry, no attachments matched your criteria.</p>
	<?php endif; ?>

	<footer>
		<small>&copy; <?php echo date("Y"); ?> Torontoist, Ink Truck Media All rights reserved.</small>
				
		<div id="sitemeter"><!--PUT HERE, verify sitemeter code-->
			<script src="http://sm1.sitemeter.com/js/counter.js?site=sm1torontoist"></script>
			<noscript>
				<a href="http://sm1.sitemeter.com/stats.asp?site=sm1torontoist" target="_top">
				<img src="http://sm1.sitemeter.com/meter.asp?site=sm1torontoist" alt="Site Meter" border="0"/></a>
			</noscript>
		</div><!-- Copyright (c)2009 Site Meter -->
	</footer>

	<?php wp_footer(); ?>

<!--jQuery is called via the Wordpress-friendly way via functions.php-->
<!--custom functions-->
<script src="<?php bloginfo('template_directory'); ?>/_/js/functions.js"></script>

<!-- end image.php -->	

</body>
</html>