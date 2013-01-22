<?php
/*
Template Name: Fringe Reviews
*/
?>


<?php get_header(); ?>

	<div id="content">

        <h2 class="page-title">Fringe 2012 Reviews</h2>

          
<section id="fringe-reviews" style="display:inline;">
        <!--START loop -->


    <div style="text-align:center;"><form name="quickselect">
<h3><strong>Alphabetically:</strong></h3>
    <select name="movie" style="width: 80%; margin:4px;">
    <?php
    $querystring = array(
    'tag' => 'fringe-2012-review',
        'numberposts' => 100,
    orderby => 'title',
    'order'    => 'ASC'
    );            

        query_posts($querystring);
    $do_not_duplicate = array();
        if ( have_posts() ) : while ( have_posts() ) : the_post();
          if (in_array($post->ID, $do_not_duplicate)) continue; update_post_caches($posts);
        ?>

          <option value="<?php the_permalink(); ?>">

                        <?php if ($post_alt_title = get_post_meta($post->ID, 'alt_title', true)) {
                              echo $post_alt_title;
                              } 
                              else {
                              the_title();
                              } 
                        ?>
 

            <?php $numstars = get_custom_field('stars');
        $number_of_stars = floatval($numstars);
        $i = 1;
        $blank_stars = 5;
        $star_string = "";
        while ($i <= $number_of_stars) {
          $star_string = $star_string."&#9733;";
          $i ++;
          $blank_stars = $blank_stars-1;
        }
        if (preg_match("/\.5/", "$numstars")) {
              $star_string = $star_string. "&frac12;";
          $blank_stars = $blank_stars-1;
            }
        $i = 1;
        while ($i <= $blank_stars) {
          $star_string = $star_string."&#9734;";
          $i ++;
        }
        echo "<span class=\"stars\">($star_string)</span>";
        ?>

</option>



    <?php endwhile; endif; ?>
            <input type="image" src="/wp-content/themes/torontoist_theme20112/images/graphics/search-btn-grey.png"  onClick="top.location.href = this.form.movie.options[this.form.movie.selectedIndex].value; return false;">   

 
    </form>
        <!--END loop -->   
</div>


        <!--START loop -->

    <div style="text-align:center;"><form name="quickselect">
<h3><strong>By Star Rating:</strong></h3>
    <select name="movie" style="width: 80%; margin:4px;">
    <?php
    $querystring = array(
    'tag' => 'fringe-2012-review',
    'meta_key' => 'stars',
    'numberposts' => 100,
    orderby => 'meta_value',
    'order'    => 'DES'
    );            

        query_posts($querystring);
    $do_not_duplicate = array();
        if ( have_posts() ) : while ( have_posts() ) : the_post();
          if (in_array($post->ID, $do_not_duplicate)) continue; update_post_caches($posts);
        ?>

          <option value="<?php the_permalink(); ?>">

                        <?php if ($post_alt_title = get_post_meta($post->ID, 'alt_title', true)) {
                              echo $post_alt_title;
                              } 
                              else {
                              the_title();
                              } 
                        ?>


            <?php $numstars = get_custom_field('stars');
        $number_of_stars = floatval($numstars);
        $i = 1;
        $blank_stars = 5;
        $star_string = "";
        while ($i <= $number_of_stars) {
          $star_string = $star_string."&#9733;";
          $i ++;
          $blank_stars = $blank_stars-1;
        }
        if (preg_match("/\.5/", "$numstars")) {
              $star_string = $star_string. "&frac12;";
          $blank_stars = $blank_stars-1;
            }
        $i = 1;
        while ($i <= $blank_stars) {
          $star_string = $star_string."&#9734;";
          $i ++;
        }
        echo "<span class=\"stars\">($star_string)</span>";
        ?>

</option>



    <?php endwhile; endif; ?>
            <input type="image" src="/wp-content/themes/torontoist_theme20112/images/graphics/search-btn-grey.png"  onClick="top.location.href = this.form.movie.options[this.form.movie.selectedIndex].value; return false;">   

 
    </form>
        <!--END loop -->   
    </div>


<?php for($day=8;$day<=18;$day++) { ?>

<h2 style="font-size:20px; font-weight:600; margin:10px 0; color:#f58220;">
<a name="Sept<?php echo"$day"; ?>">Shows for July <?php echo"$day"; ?></a></h2><hr class="dottedgrey">
        <!--START loop -->
	<?php
	$querystring = array(
	'tag' => 'fringe-2011-review',
	'orderby' => 'title',
        'numberposts' => 100,
	'order'    => 'ASC'
	);             
        query_posts($querystring);
	$do_not_duplicate = array();
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        if (in_array($post->ID, $do_not_duplicate)) continue; update_post_caches($posts);
	$dates=get_custom_field('Fringe 2012 dates');      
        ?>
                <!--include/article-shortview.php-->                
          <?php if (preg_match("/\s$day/", "$dates")) {        
                include (TEMPLATEPATH . '/includes/tiff-review-shortview.php'); 
	  }
	?>                     
            
            <?php endwhile; endif; ?>     
        <!--END loop -->         
<?php } ?>   


</section>

    </div>    

<?php get_sidebar(); ?>


<?php get_footer(); ?>
