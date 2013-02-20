<?php
/*
Template Name: TIFF Reviews Page
*/
?>


<?php get_header(); ?>


	<div id="content">
        

        <h2 class="page-title">TIFF 2011 Reviews - Sorted by: Star Rating <div style="float:right; margin-top:2px;"></h2>
        <b>Sort Reviews by:</b> Stars | <a href="/tiff-2011-reviews-by-alpha/">Alphabetical</a> | <a href="/tiff-reviews-by-date/">Date</a> | <a href="/tiff-recent-reviews/">Recently Added</a><br>
        
        <!--START loop -->

	<?php
	$querystring = array(
	'tag' => 'tiff-2011-reviews',
        'numberposts' => 100,
	'order'    => 'DES'
	);             
        query_posts($querystring.'&meta_key=stars&orderby=meta_value'); 
	$do_not_duplicate = array();
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        if (in_array($post->ID, $do_not_duplicate)) continue; update_post_caches($posts);
        ?>
                <!--include/article-shortview.php-->                
                <?php include (TEMPLATEPATH . '/includes/tiff-review-shortview.php'); ?>                     
            
            <?php endwhile; endif; ?>     
        <!--END loop -->         
        
<!--
        <nav class="post-nav">
            <div class="older-posts"><a href="/culture/page/2/">&laquo; Next Page</a></div>
        </nav>    
-->
        
    </div>    

<?php get_sidebar(); ?>

<?php get_footer(); ?>
