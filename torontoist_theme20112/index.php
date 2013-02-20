<?php get_header(); ?>
    
    <!-- index.php, used for list of all articles on site (after homepage) -->
    
	<div id="content">	
	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <?php include (TEMPLATEPATH . '/includes/article-shortview.php'); ?>
    
        <?php endwhile; ?>
    
            <?php include (TEMPLATEPATH . '/includes/post-nav.php' ); ?>
    
        <?php else : ?>
    
            <h2>Not Found</h2>
   
        <?php endif; ?>
    </div> 
    
<?php get_sidebar(); ?>

<?php get_footer(); ?>
