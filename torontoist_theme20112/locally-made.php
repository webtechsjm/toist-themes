<?php
/*
Template Name: Locally-Made
*/
?>


<?php get_header(); ?>

    <!-- locally-made.PHP, for local artisans page sponsored by Moosehead-->

<style>
h5 {
    border-bottom: 1px solid #B2B2B2;
    border-top: 1px solid #B2B2B2;
    color: #9E0B0F;
    font-size: 16px;
    font-weight: 700;
    letter-spacing: 2px;
    margin-bottom: 15px;
    padding: 5px;
    text-align: center;
    text-transform: uppercase;
}
h5 a:hover {
    text-decoration: none;
}
#content article.category-sponsored-post {
    background: none repeat scroll 0 0 #FFFFFF !important;
    padding: 10px 0;
}
</style>

	<div id="content">	
        

        <!--START loop 1--> 
            <?php $my_query = new WP_Query( array( 'tag' =>'locally-made', 'posts_per_page' => 1 )); 
            while ($my_query->have_posts()) : $my_query->the_post();
            $do_not_duplicate[] = $post->ID ?>
                
                <!--include/article-longview.php-->                
                <?php include (TEMPLATEPATH . '/includes/article-longview.php'); ?> 
            
            <?php endwhile; ?>
        <!--END loop 1-->
        
        <!--START loop 2-->             
        <?php query_posts(array( 'tag' =>'locally-made', 'posts_per_page' => 9, 'offset' => 1 )); 
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        if (in_array($post->ID, $do_not_duplicate)) continue; update_post_caches($posts);
        ?>
                <!--include/article-shortview.php-->                
                <?php include (TEMPLATEPATH . '/includes/article-shortview.php'); ?>                     
            
            <?php endwhile; endif; ?>     
        <!--END loop 2-->         
  
        <h5><a href="http://moosehead.ca">Thanks to Moosehead for making this series possible.<br>
<img alt="" src="http://torontoist.com/wp-content/uploads/2012/06/MH_LOGO.jpg" class="aligncenter" width="25%" /></a><br>
Read more about the Moosehead Journey below...
</h5>

        <!--START loop 3--> 
            <?php $my_query = new WP_Query( array( 'tag' =>'moosehead-journey', 'posts_per_page' => 10 )); 
            while ($my_query->have_posts()) : $my_query->the_post();
            $do_not_duplicate[] = $post->ID ?>
                
                <!--include/article-longview.php-->                
                <?php include (TEMPLATEPATH . '/includes/sponsored-longview.php'); ?> 
            
            <?php endwhile; ?>
        <!--END loop 3-->
    </div>    

<?php get_sidebar(); ?>

<?php get_footer(); ?>

