	<footer class="global">		    
		<nav>
			<ul>
				<li class="bul"><a href="http://torontoist.com/">Home</a></li><li>&bull;</li>
				<li><a href="http://torontoist.com/about/">About</a></li>
				<li><a href="http://torontoist.com/staff/">Staff</a></li>
				<li><a href="http://torontoist.com/contribute/">Contribute</a></li>		        
				<li style="display:none;"><a href="http:/torontoist.com/advertise/">Advertise</a></li>
				<li><a href="http://torontoist.com/contact-us/">Contact</a></li>
				<li><a href="http://torontoist.com/policies/">Policies</a></li>
			</ul>
		</nav>		    
		<div id="copyright">	<small>&copy; <?php echo date("Y"); ?>, Ink Truck Media All rights reserved.</small></div>
		<div id="sjm-network-footer">
		<img class="heading" src="http://torontoist.com/wp-content/uploads/2013/02/TST-footer-favourites-980.png" />
		<img src="http://torontoist.com/wp-content/uploads/2013/02/TST-footer-favourites-560.png" alt="" class="heading small" />
		<ul>
		<?php
		global $post;
		$posts = new WP_Query();
		$posts->query(array('showposts' => 12, 'post_status' => 'publish', 'tag' => 'favourites'));
		?>
		<?php
		while ($posts->have_posts()) {
			$posts->the_post();
			$imageback = "http://torontoist.com/wp-content/uploads/2013/02/skyline-for-footer-200x150.jpg";
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium');
		?>
		<li><a href="<?php echo get_permalink(); ?>">
		<?php if ($image != null) { ?>
			<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" width="200" height="150" border="0" align="left"/>
		<?php } else { ?>
			<img src="<?php echo $imageback; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" width="200" height="150" border="0" align="left"/>
		<?php } ?>
		</a>
		<p><a href="<?php echo get_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
		<?php if ($alternate = get_post_meta($post->ID, 'alt_title', true)) {echo $alternate;}
		else the_title(); ?>
		</a></p></li>
		<?php } wp_reset_query(); ?>
		</ul>    
    </div>    
	</footer>

	<?php wp_footer(); ?>

<!--custom functions-->
<script src="<?php bloginfo('template_directory'); ?>/_/js/functions.js"></script>

<!--The closing div below closes the uber container-->
</div>
<!--<script type="text/javascript" src="http://s.skimresources.com/js/130X1023785.skimlinks.js"></script>-->
</body>

</html>
