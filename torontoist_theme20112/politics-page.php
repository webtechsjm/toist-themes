<?php
/*
Template Name: Politics Page
*/
?>


<?php get_header(); ?>

<script type="text/javascript">
  $(document).ready(function () {
   jQuery('.slidedeck').slidedeck().options.touch = false; 
  });
</script>

    <!-- PHOTOS-PAGE.PHP, for news landing page -->

<div id="container">
	<div id="content">	
        
        <section id="feature-story"  style="display:none;">
	  <?php slidedeck( 78797, array( 'width' => '100%', 'height' => '370px' ) ); ?>
        </section>
        
        <h2 class="page-title">Posts Filed Under: Politics <div style="float:right; margin-top:2px;"><a href="/tag/politics/feed/"><img height="14" src="/wp-content/themes/torontoist_theme20112/images/graphics/rss.png"></a></div></h2>

        <!--START loop 1--> 
            <?php $my_query = new WP_Query( array( 'tag' =>'politics', 'posts_per_page' => 5 )); 
            while ($my_query->have_posts()) : $my_query->the_post();
            $do_not_duplicate[] = $post->ID ?>
                
                <!--include/article-longview.php-->                
                <?php include (TEMPLATEPATH . '/includes/article-longview.php'); ?> 
            
            <?php endwhile; ?>
        <!--END loop 1-->
        
        <!--START loop 2-->             
        <?php query_posts(array( 'tag' =>'politics', 'posts_per_page' => 15, 'offset' => 5 )); 
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        if (in_array($post->ID, $do_not_duplicate)) continue; update_post_caches($posts);
        ?>
                <!--include/article-shortview.php-->                
                <?php include (TEMPLATEPATH . '/includes/article-shortview.php'); ?>                     
            
            <?php endwhile; endif; ?>     
        <!--END loop 2-->         
        
        <nav class="post-nav">
            <div class="older-posts"><a href="/tag/politics/page/2/">&laquo; Older Entries</a></div>
        </nav>    
        
    </div>    

<?php get_sidebar('home'); ?>
</div>

<?php get_footer(); ?>
