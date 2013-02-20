<?php
/*
Template Name: NXNE Hub
*/
?>

<style>
td { text-align:center; }
</style>

<?php get_header(); ?>

    <!-- nxne.PHP, for news landing page -->

	<div id="content">	
<img width="100%" src="http://torontoist.com/wp-content/uploads/2012/06/nxneist_banner1.jpg">
        <table width="640" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="20%" valign="middle"><span style="font-size:20px; color:#000000;"><strong><a style="color: #504676;"  href="http://torontoist.com/2012/06/nxne-2012-how-to-go-solo/">SOLO<br/>GUIDE</a></strong></span></td>
<td width="8">&nbsp;</td>
<td width="20%" valign="middle"><span style="font-size:20px; color:#000000;"><strong><a style="color: #7c1d13;" href="http://torontoist.com/2012/06/nxne-2012-how-to-go-hip-hop/">HIP HOP<br/>GUIDE</a></strong></span></td>
<td width="8">&nbsp;</td>
<td width="20%" valign="middle"><span style="font-size:20px; color:#000000;"><strong><a style="color: #afa169;" href="http://torontoist.com/2012/06/nxne-2012-how-to-go-rock/">ROCK<br/>GUIDE</a></strong></span></td>
<td width="8">&nbsp;</td>
<td width="20%" valign="middle"><span style="font-size:20px; color:#000000;"><strong><a style="color: #228db8;" href="http://torontoist.com/2012/06/nxne-2012-how-to-go-electronic/">ELECTRONIC<br/>GUIDE</a></strong></span></td>
<td width="8">&nbsp;</td>
<td width="20%" valign="middle"><span style="font-size:20px; color:#000000;"><strong><a style="color: #456c53;" href="http://torontoist.com/2012/06/nxne-2012-how-to-go-loud/">LOUD<br/>GUIDE</a></strong></span></td>
</tr></table>
<hr class="solidblack">

        <!--START loop 1--> 
            <?php $my_query = new WP_Query( array( 'tag' =>'nxne-2012', 'posts_per_page' => 5 )); 
            while ($my_query->have_posts()) : $my_query->the_post();
            $do_not_duplicate[] = $post->ID ?>
                
                <!--include/article-longview.php-->                
                <?php include (TEMPLATEPATH . '/includes/article-longview.php'); ?> 
            
            <?php endwhile; ?>
        <!--END loop 1-->
        
        <!--START loop 2-->             
        <?php query_posts(array( 'tag' =>'nxne-2012', 'posts_per_page' => 15, 'offset' => 5 )); 
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        if (in_array($post->ID, $do_not_duplicate)) continue; update_post_caches($posts);
        ?>
                <!--include/article-shortview.php-->                
                <?php include (TEMPLATEPATH . '/includes/article-shortview.php'); ?>                     
            
            <?php endwhile; endif; ?>     
        <!--END loop 2-->         
        
        <nav class="post-nav">
            <div class="older-posts"><a href="/tag/photos/page/2/">&laquo; Older Entries</a></div>
        </nav>    
        
    </div>    

<?php get_sidebar(); ?>

<?php get_footer(); ?>
