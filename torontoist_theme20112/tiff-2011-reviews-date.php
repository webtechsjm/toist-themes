<?php
/*
Template Name: TIFF Date Reviews Page 
*/
?>


<?php get_header(); ?>


	<div id="content">
        

        <h2 class="page-title">TIFF 2011 Reviews - Sorted by: Date <div style="float:right; margin-top:2px;"></h2>

        <b>Sort Reviews by:</b> <a href="/tiff-2011-reviews-by-stars/">Stars</a> |<a href="/tiff-2011-reviews-by-alpha/">Alphabetical</a> | Date  | <a href="/tiff-recent-reviews/">Recently Added</a><br>
<b>Date:</b> <a href="#Sept8">Sept. 8</a> | <a href="#Sept9">Sept. 9</a> | <a href="#Sept10">Sept. 10</a> | <a href="#Sept11">Sept. 11</a> | <a href="#Sept12">Sept. 12</a> | <a href="#Sept13">Sept. 13</a> | <a href="#Sept14">Sept. 14</a> | <a href="#Sept15">Sept. 15</a> | <a href="#Sept16">Sept. 16</a> | <a href="#Sept17">Sept. 17</a> | <a href="#Sept18">Sept. 18</a> 
<hr class="dottedgrey">  

<?php for($day=8;$day<=18;$day++) { ?>

<h2 style="font-size:20px; font-weight:600; margin:10px 0; color:#f58220;">
<a name="Sept<?php echo"$day"; ?>">Films for Sept. <?php echo"$day"; ?></a></h2><hr class="dottedgrey">
        <!--START loop -->
	<?php
	$querystring = array(
	'tag' => 'tiff-2011-reviews',
	'orderby' => 'title',
        'numberposts' => 100,
	'order'    => 'ASC'
	);             
        query_posts($querystring);
	$do_not_duplicate = array();
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        if (in_array($post->ID, $do_not_duplicate)) continue; update_post_caches($posts);
	$dates=get_custom_field('TIFF 2011 Dates');      
        ?>
                <!--include/article-shortview.php-->                
          <?php if (preg_match("/\s$day/", "$dates")) {        
                include (TEMPLATEPATH . '/includes/tiff-review-shortview.php'); 
	  }
	?>                     
            
            <?php endwhile; endif; ?>     
        <!--END loop -->         
<?php } ?>        
<!--
        <nav class="post-nav">
            <div class="older-posts"><a href="/culture/page/2/">&laquo; Older Entries</a></div>
        </nav>    
-->
        
    </div>    

<?php get_sidebar(); ?>

<?php get_footer(); ?>
