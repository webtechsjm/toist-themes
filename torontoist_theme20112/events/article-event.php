<article <?php post_class(shortview) ?> id="post-<?php the_ID(); ?>">

    <header>
        <?php edit_post_link('[Edit]','',' '); ?>  
        
        <h2><a href="<?php the_permalink(); ?>">
            <?php if ($post_alt_title = get_post_meta($post->ID, 'alt_title', true)) {
                  echo $post_alt_title;
                  } 
                  else {
                  the_title();
                  } 
            ?>
        </a></h2>
        
        <?php comments_popup_link('', '1 Comment', '% Comments', 'comments-link', ''); ?>
                            
    </header>    
                   
    <p class="dek">
        <?php the_content(); ?>

<ul style="float:right; width:425px; padding-left: 20px;">
	<li><strong>Location</strong>: <?php echo get_post_meta($post->ID, 'location', true); ?></li>
	<li><strong>Price</strong>: <?php echo get_post_meta($post->ID, 'price', true); ?></li>
	
	<?php
		$start = get_post_meta($post->ID, 'date-start', true);
		$end = get_post_meta($post->ID, 'date-end', true);
	?>
	<li><strong>Start: </strong><?php echo date('l dS \o\f F Y \a\t h:i:s A', $start); ?></li>
	<li><strong>End: </strong><?php echo date('l dS \o\f F Y \a\t h:i:s A', $end); ?></li>	
</ul>

    <a class="img" href="<?php the_permalink() ?>" title=""><?php the_post_thumbnail('medium'); ?></a>
    
</article> 
