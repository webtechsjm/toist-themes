<article <?php post_class(shortview) ?> id="post-<?php the_ID(); ?>">

    <header>
        
        <h2><a href="<?php the_permalink(); ?>">
            <?php if ($post_alt_title = get_post_meta($post->ID, 'alt_title', true)) {
                  echo $post_alt_title;
                  } 
                  else {
                  the_title();
                  } 
            ?>
        </a>


<!--        
        <?php comments_popup_link('', '1 Comment', '% Comments', 'comments-link', ''); ?>
-->
                            
    </h2></header>    
      <p class="dek">                 
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
		echo "<span class=\"stars\">$star_string</span>";
	    ?>
    </p> 

    <p class="dek">
        <a href="<?php the_permalink(); ?>">
            <?php if ($post_alt_dek = get_post_meta($post->ID, 'alt_dek', true)) {
                  echo $post_alt_dek;
                  } 
                  else {
                  get_custom_field('dek', TRUE);
                  } 
            ?>
	</a>
    </p> 

    <p class="playing"><b>Playing: </b>
            <?php get_custom_field('Hot Docs 2012 Dates', TRUE); ?>
    </p> 
<!--
   <p><span class="morelink"><a href="<?php the_permalink(); ?>">Read More...</a></span></p>
-->   

    <a class="img" href="<?php the_permalink() ?>" title=""><?php the_post_thumbnail('medium'); ?></a>
    
</article> 
