<!--Add class to posts imported from Movable Type, to correct spacing. Also in single.php--> 
<?php if ($post->ID < 63205) { 
    $imported_post = 'imported-post';
} ?>
  

<article <?php post_class('longview') ?> id="post-<?php the_ID(); ?>">

        <header>
            
            <?php comments_popup_link('', '1 Comment', '% Comments', 'comments-link', ''); ?>
            
            <time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></time>
                               
            <h3><?php
            				switch(get_post_type()){
            					case "post":
            						$categories = get_the_category();
		                    foreach($categories as $category){
			                    $cat_link = get_category_link($category->cat_ID);
    				              echo '<a href="'.$cat_link.'">'.$category->name.'</a>'; 
			                    }
            						break;
            					case "event":
            						$categories = get_the_terms(get_the_ID(),'event-category');
												$the_category = array_shift($categories);
							
												printf('<a href="%s">%s</a>',
													site_url()."/events/category/".$the_category->slug,
													$the_category->name
													);
            						break;
                }?>
            </h3>
            
            <h1><a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a></h1>
        </header>    
    
        <p class="dek"><a href="<?php the_permalink(); ?>"><?php get_custom_field('dek', TRUE); ?></a></p>
        
        <p class="byline">By 
            <?php if(function_exists('coauthors_posts_links'))
                coauthors_posts_links(', ', ' and ', '', '');
                else
                the_author_posts_link();
            ?>
            <?php if ($post_image_credit = get_post_meta($post->ID, 'image_credit', true)) {
            echo ' &bull; ' . $post_image_credit; } ?>
        </p>
        
        <?php global $more; $more = 0; ?>
	<a href="<?php the_permalink(); ?>"><?php if ($post_alt_image = get_post_meta($post->ID, 'alt_image', true)) {
            echo $post_alt_image; } ?></a>
        <?php //the_content('<span class="morelink">Read More...</span>'); ?>
		<?php the_content('<span class="morelink">Keep reading: </span>' . get_the_title('', '', false)); ?>

</article>
