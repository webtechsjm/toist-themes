<?php 
	get_header(slideshow); 
	
	$post_permalink = get_permalink($post->post_parent);
	$post_title = get_the_title($post->post_parent);
	?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<div class="container">
		<article class="post photo" id="post-<?php the_ID(); ?>" id="content">
			<aside>
				<p class="back"><a href="<?php echo $post_permalink; ?>" rev="attachment"><?php _e("Back to article","torontoist"); ?></a></p>
				<h1>
					<a href="<?php echo $post_permalink; ?>" rev="attachment"><?php echo $post_title; ?></a>
				</h1>
			</aside>
			<section>
				<div id="slideshow">
				<?php 
					$include = $_GET['include'];
					//use the old way if no ids were included, or if include string is invalid
					if(empty($include) || preg_match('|[^0-9,]|',$include)){
						$include = false;
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
			
						function toist_previous_image_link($arg){mf_previous_image_link($arg);}
						function toist_next_image_link($arg){mf_next_image_link($arg);}
		
					}else{
						$attachment_img = wp_get_attachment_image( $post->ID, 'full' );
						$image_attributes = wp_get_attachment_image_src($attachment_id,'full');
						$include = $_GET['include'];
						$images = explode(',',$include);
						$k = array_search($post->ID,$images) + 1; //array_search indexes to zero
			
						if(!function_exists('toist_previous_image_link')){						
							function toist_previous_image_link($link_text){
								global $wp_filter;
								$filters = $wp_filter['attachment_link'];
								$include = $_GET['include'];
								$images = explode(',',$include);
								$i = array_search(get_the_ID(),$images);
					
								$link = get_attachment_link($images[$i-1]); 
								$link = ($filters === NULL) ? $link.'?include='.$include : $link;
				
								if($i !== 0){
									printf('<a class="previous button" href="%s" data-photoid="%s">%s</a>',
										$link,
										$images[$i-1],
										$link_text
										);
								}else{
									echo '<a class="previous button hide">';
									}
								}
							}
			
						if(!function_exists('toist_next_image_link')){						
							function toist_next_image_link($link_text){
								global $wp_filter;
								$filters = $wp_filter['attachment_link'];
								$include = $_GET['include'];
								$images = explode(',',$include);
								$i = array_search(get_the_ID(),$images);
					
								$link = get_attachment_link($images[$i+1]); 
								$link = ($filters === NULL) ? $link.'?include='.$include : $link;
					
								if($i+1 < count($images)){
									printf('<a class="next button" href="%s" data-photoid="%s">%s</a>',
										$link,
										$images[$i+1],
										$link_text
										);
								}else{
									echo '<a class="next button hide"></a>';
									}
								}
							}
						}//end check for whether we have a list of includes
						
					//add the image
					printf('<a href="%s" class="main" title="%s" data-photoid="%s"><noscript>%s</noscript></a>',
						$image_attributes[0],
						$post->post_excerpt,
						get_the_ID(),
						$attachment_img
						);
		
					?>
				</div>
				<div id="expand_msg">Click image to expand</div>
				<div id="swipe_msg">Swipe left for next photo</div>
				<nav>
					<?php  toist_previous_image_link('Previous') ?>
					<?php  toist_next_image_link('Next') ?>
				</nav>
			</section>
		</article>
	
		<div id="sidebar">
	 		<?php 
	 			printf(
	 				'<p class="slide-count"><span class="index">%s</span> of %s</p>',
	 				$k,
	 				count($images)
	 			); 
	 		?>
		
			<section id="slide-info">
				<?php the_content (); ?>
			</section>	


			<p class="back">
				<a href="<?php echo $post_permalink; ?>" rev="attachment">
					<?php _e("Back to article","torontoist"); ?>
				</a>
			</p>

			<section id="social-media">
				Share on: 
				<a href="http://pinterest.com/pin/create/button/?url=<?php echo $post_permalink; ?>" class="social pinterest" title="Pin this gallery" rel="nofollow">
					<span>&#62226;</span>
				</a>
				<a href="https://plus.google.com/share?url=<?php echo $post_permalink; ?>" class="social gplus" title="Plus One this gallery" rel="nofollow">
					<span>&#62223;</span>
				</a>
				<a href="http://www.facebook.com/sharer.php?u=<?php echo $post_permalink; ?>" class="social facebook" title="Share this gallery on Facebook" rel="nofollow">
					<span>&#62220;</span>
				</a>
				<a href="http://twitter.com/home/?status=<?php echo $post_title;?> - <?php echo $post_permalink; ?>" class="social twitter" title="Tweet this gallery" rel="nofollow">
					<span>&#62217;</span>
				</a>
				<a href="mailto:?subject=<?php echo $post_title ?>&body=See the photos at <?php echo $post_permalink; ?>" class="social email" title="Email this gallery" rel="nofollow">
					<span>&#9993;</span>
				</a>
			</section>

			<section id="sidebar_ad">
				<h6>Advertisement</h6>
				<div id='div-gpt-ad-1347634485931-0'>
					<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1347634485931-0'); });
					</script>
				</div>
			</section>
		
	</div>


	<footer>
		<nav id="thumbnails">		
			<?php
			if($include){
				
				$images = get_posts(array(
					'include' => $include,
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'orderby' => 'post__in'
				));
					
				$url_append = "?include=".$include;
			}else{
				$url_append = "";
			}
			
			
			foreach($images as $image){
				$class = array("thumbnail");
				if($image->ID == get_the_ID()) $class[] = "active";
				
				printf('<a data-photoid="%s" title="%s" href="%s%s" class="%s">%s</a>',
					$image->ID,
					$image->post_excerpt,
					get_attachment_link($image->ID),
					$url_append,
					join(" ",$class),
					wp_get_attachment_image($image->ID,'thumbnail')
				);
			}
		
			?>
		</nav>
	</footer>	
	
		
	<?php endwhile; else: ?>
		<p>Sorry, no attachments matched your criteria.</p>
	<?php endif; ?>
</div><?php //#content ?>

	<footer>
		<div class="container">
			<small>&copy; <?php echo date("Y"); ?> Torontoist, Ink Truck Media All rights reserved.</small>
		</div>
	</footer>
	
	<?php
	
	wp_enqueue_script(
		'eventswipe',
		get_bloginfo('stylesheet_directory')."/javascript/jquery.event.swipe.js",
		'jquery',
		'1.6',
		true
	);
	wp_enqueue_script(
		'customScroll',
		get_bloginfo('stylesheet_directory').'/javascript/jquery.mCustomScrollbar.concat.min.js',
		'jquery',
		'1.9.1',
		true
	);
	
	wp_enqueue_script(
		'toist_gallery2013',
		get_bloginfo('stylesheet_directory')."/javascript/gallery2013.js",
		array('eventswipe','customScroll'),
		'2013-05-16',
		true
		);
	wp_enqueue_style(
		'toist_gallery2013',
		get_bloginfo('stylesheet_directory').'/style-gallery.css',
		false,
		'2013-05-03'
		);
	
	$output = array();
	foreach($images as $image){
		$meta = wp_get_attachment_metadata($image->ID);
		$attachment = get_attachment_link($image->ID);
		if(strpos($attachment,"?") === false){
			$attachment .= "?include=".$include;
		}else{
			$attachment .= "&include=".$include;
		}
		$img_sizes = $meta['sizes'];
		
		
		$path = explode('/',$image->guid);
		array_pop($path);
		$path = join('/',$path);
		
		$output[$image->ID] = array(
			"title"				=>	$image->post_title,
			"caption"			=>	$image->post_excerpt,
			"description"	=>	$image->post_content,
			"type"				=>	$image->post_mime_type,
			"path"				=>	$path.'/',
			"permalink"		=>	$attachment,
			"sizes"				=>	$img_sizes,
			"full"				=>	$image->guid
		);
	};
	wp_localize_script(
		'toist_gallery2013',
		'toist_gallery',
		$output
		);
	?>

	<?php wp_footer(); ?>
</body>
</html>
