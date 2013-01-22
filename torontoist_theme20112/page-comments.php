<?php
/*
Template Name: Page with Comments
*/
?>

<?php get_header(); ?>

	<div id="content">	
	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
            <article class="post" id="post-<?php the_ID(); ?>">

                <h2><?php the_title(); ?></h2>
           
                    <?php the_content(); ?>
    
                    <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
       
                <p><?php edit_post_link('[Edit]','',' '); ?></p> 
    
            </article>

            <!--comments go here-->    
            <div id="post-comments">
                <h4 id="comments">Comments</h4>
                <?php comments_template(); ?>
            </div>

        <?php endwhile; endif; ?>
    </div>    



<?php get_sidebar(); ?>

<?php get_footer(); ?>
