<article <?php post_class('mobileonly') ?> id="post-<?php the_ID(); ?>">

    <header>

                <?php comments_popup_link('', '1 Comment', '% Comments', 'comments-link', ''); ?>

        <h1><a href="<?php the_permalink(); ?>">
          <?php 
         	$post_alt_title = get_post_meta($post->ID, 'alt_title', true);
          if ($post_alt_title && $post->post_type == 'post') {
            echo $post_alt_title;
            } 
            else {
            the_title();
            } 
           ?>
        </a></h1>
       

                            
    </header>    
                   
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

        <p class="byline">By 
            <?php if(function_exists('coauthors_posts_links'))
                coauthors_posts_links(', ', ' and ', '', '');
                else
                the_author_posts_link();
            ?>
            <?php if ($post_image_credit = get_post_meta($post->ID, 'image_credit', true)) {
            echo ' &bull; ' . $post_image_credit; } ?>
<time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="short"><?php the_time('M jS'); ?>, <?php the_time('g:i a'); ?></time>
        </p>

    <a class="img" href="<?php the_permalink() ?>" title=""><?php
    $featured = false;
    if(has_post_thumbnail()){
			the_post_thumbnail('medium');
			$featured = true;
    }elseif(preg_match('|\[gallery(.*)\]|',$post->post_content,$matches)){
    	if(preg_match('|feature="(.*)"|',$matches[1],$featured)){
    	$id = $featured[1];
    	echo wp_get_attachment_image($id,'medium');
    	$featured = true;
    	}
    }
    
    ?></a>
    

</article> 
