<?php
/*
Template Name: TIFF 2011 Page
*/
?>


<?php get_header(); ?>

	<style>
		#content {float:none !important; width:100% !important; border:none !important;}
		.hub-main {
			max-width: 640px;
			width: 63%;
			float: left;
		}
		h2 {font-size:20px !important;}
		.hub
		.hub-sidebar {
			max-width: 350px;
			width:35%;
			float: right;
		}
		.hub-sidebar article { padding:0px 20px !important; width:90% !important; margin-bottom: 5px !important; float:none !important;}

		.clear {
			width: 100%;
			display: block;
			clear: both;
		}
		.hub-section {
			margin-bottom: 2em;
		}

		#tiff-search {
			width: 400px;
			margin: 20px auto;
		}
		#tiff-search input[type="text"] {
			width: 65%;
		}
		.hub-header {
			margin-bottom: 20px;
			display: none;
		}

		h5 {
		    border-bottom: 1px solid #B2B2B2;
		    border-top: 1px solid #B2B2B2;
		    color: #9E0B0F;
  		  font-size: 18px;
  		  font-weight: 600;
  		  letter-spacing: 2px;
  		  padding: 5px;
  		  text-align: center;
  		  text-transform: uppercase;
		}
		h4 { font-weight: 600; font-size: 14px; padding: 5px;}
	</style>

    <section id="breaking-news">
<?php slidedeck( 76953, array( 'width' => '100%', 'height' => '150px' ) ); ?>
</section>

	<div id="content" class="hub">
		
		<div id="header" class="hub-header">
			<img src="<?php bloginfo("template_url") ?>/tiff-header.png"/>
			<form id="tiff-search">
				<input type="text" value="Search reviews"/>
				<input type="submit" value="Search">
			</form>
		</div>
		
		<div class="hub-main">

	<div id="tiff-reviews" class="mobile-smallest">
	<h5>TIFF Reviews</h5>
        <!--START loop -->

	<div style="text-align:center;"><form name="quickselect">
	<select name="movie" style="width: 80%; margin:4px;">
	<?php
	$querystring = array(
	'tag' => 'tiff-2011-reviews',
        'numberposts' => 100,
	orderby => 'title',
	'order'    => 'ASC'
	);             

        query_posts($querystring);
	$do_not_duplicate = array(); 
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
          if (in_array($post->ID, $do_not_duplicate)) continue; update_post_caches($posts); 
        ?>

          <option value="<?php the_permalink(); ?>"><?php the_title(); ?>  

            <?php $numstars = get_custom_field('stars'); 
		$number_of_stars = floatval($numstars);
		$i = 1;
		$blank_stars = 5;
		$star_string = "";
		while ($i <= $number_of_stars) {
		  $star_string = $star_string."&#9733;";
		  $i ++;
		  $blank_stars = $blank_stars-1;
		}
		if (preg_match("/\.5/", "$numstars")) {
        	  $star_string = $star_string. "&frac12;";
		  $blank_stars = $blank_stars-1;
    		}
		$i = 1;
		while ($i <= $blank_stars) {
		  $star_string = $star_string."&#9734;";
		  $i ++;
		}
		echo "<span class=\"stars\">($star_string)</span>";
	    ?>

</option>

	<?php endwhile; endif; ?>
            <input type="image" src="/wp-content/themes/torontoist_theme20112/images/graphics/search-btn-grey.png"  onClick="top.location.href = this.form.movie.options[this.form.movie.selectedIndex].value; return false;">    

 
	</form>
        <b>Sort by:</b> <a href="/tiff-2011-reviews-by-stars/">Stars</a> | <a href="/tiff-recent-reviews/">Recently Added</a> | <a href="/tiff-reviews-by-date/">Date</a> <br>
</div>
        <!--END loop -->    
	</div>

			<h5>Full TIFF 2011 coverage</h5>
			<?php $args = array(
				'tag' => 'tiff-2011',
				'numberposts' => 3,
				'tag__not_in' => array(25744, 25492)
				);
            $lastposts = get_posts( $args );
            foreach($lastposts as $post) : setup_postdata($post); ?>
                
                <!--include/article-longview.php-->                 
                <?php include (TEMPLATEPATH . '/includes/article-longview.php'); ?>                     
            
            <?php endforeach; ?>     

			<?php $args = array(
				'tag' => 'tiff-2011',
				'numberposts' => 3,
				'tag__not_in' => array(25744, 25492)
				);
            $lastposts = get_posts( $args );
            foreach($lastposts as $post) : setup_postdata($post); ?>
                
                <!--include/article-shortview-mobile.php-->                 
                <?php include (TEMPLATEPATH . '/includes/article-shortview-mobile.php'); ?>                     
            
            <?php endforeach; ?> 

			<?php $args = array(
				'tag' => 'tiff-2011',
				'numberposts' => 100,
				'offset' => 3,
				'tag__not_in' => array(25744, 25492)
				);
            $lastposts = get_posts( $args );
            foreach($lastposts as $post) : setup_postdata($post); ?>
                
                <!--include/article-shortview.php-->                 
                <?php include (TEMPLATEPATH . '/includes/article-shortview.php'); ?>                     
            
            <?php endforeach; ?>   



		</div>
		
		<div class="hub-sidebar">
			
			<div id="tiff-contact" class="hub-section">
				<h5>Spot Something?</h5>
<article><h4>Out and about during TIFF? Email <a href="mailto:tiff@torontoist.com">tiff@torontoist.com</a> with your tips, photos and stories. Add your photos to our <a href="http://flickr.com/groups/torontoist">Flickr Pool</a> or send tweets <a href="http://twitter.com/#!/torontoist">@torontoist</a>'s way.</h4></article>
			</div>

	<div id="tiff-reviews" class="hub-section">
	<h5>TIFF Reviews</h5>
        <!--START loop -->

	<div style="text-align:center;"><form name="quickselect">
	<select name="movie" style="width: 80%; margin:4px;">
	<?php
	$querystring = array(
	'tag' => 'tiff-2011-reviews',
        'numberposts' => 100,
	orderby => 'title',
	'order'    => 'ASC'
	);             

        query_posts($querystring);
	$do_not_duplicate = array(); 
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
          if (in_array($post->ID, $do_not_duplicate)) continue; update_post_caches($posts); 
        ?>

          <option value="<?php the_permalink(); ?>"><?php the_title(); ?>  

            <?php $numstars = get_custom_field('stars'); 
		$number_of_stars = floatval($numstars);
		$i = 1;
		$blank_stars = 5;
		$star_string = "";
		while ($i <= $number_of_stars) {
		  $star_string = $star_string."&#9733;";
		  $i ++;
		  $blank_stars = $blank_stars-1;
		}
		if (preg_match("/\.5/", "$numstars")) {
        	  $star_string = $star_string. "&frac12;";
		  $blank_stars = $blank_stars-1;
    		}
		$i = 1;
		while ($i <= $blank_stars) {
		  $star_string = $star_string."&#9734;";
		  $i ++;
		}
		echo "<span class=\"stars\">($star_string)</span>";
	    ?>

</option>

	<?php endwhile; endif; ?>
            <input type="image" src="/wp-content/themes/torontoist_theme20112/images/graphics/search-btn-grey.png"  onClick="top.location.href = this.form.movie.options[this.form.movie.selectedIndex].value; return false;">    

 
	</form>
        <b>Sort by:</b> <a href="/tiff-2011-reviews-by-stars/">Stars</a> | <a href="/tiff-recent-reviews/">Recently Added</a> | <a href="/tiff-reviews-by-date/">Date</a> <br>
</div>
        <!--END loop -->    
	</div>
			
			<div id="tiff-survival">
				<h5>Surviving TIFF</h5>
			<?php $args = array(
				'tag' => 'tiff-2011-survival-guide'
				);
			?>
			<?php $tiff_query = new WP_Query($args); ?>
			<?php while ( $tiff_query->have_posts() ) : $tiff_query->the_post(); ?>
				<article>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h2>
					<?php the_post_thumbnail(array(300, auto)); ?></a>
				</article>
			<?php endwhile; ?>

			</div>
			
			<div id="tiff-interviews" class="hub-section">
				<h5>Interviews</h5>
			<?php $args = array(
				'tag' => 'tiff-qa'
				);
			?>
			<?php $tiff_query = new WP_Query($args); ?>
			<?php while ( $tiff_query->have_posts() ) : $tiff_query->the_post(); ?>
				<article>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h2>
					<?php the_post_thumbnail(array(300, auto)); ?></a>
				</article>
			<?php endwhile; ?>
			</div>				
			
			<div class="clear">
			</div>
		</div>
		
    </div>    



<?php get_footer(); ?>
