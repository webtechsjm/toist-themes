<?php
/*
Template Name: HotDocs
*/
?>


<?php get_header(); ?>

<style>
 p {font-style:normal;}
 li {font-style:normal;}
 td {font-style:normal;}
</style>
<img src="http://torontoist.com/wp-content/uploads/2012/04/hotdocstitle1.jpg" alt="" title="hotdocstitle1" width="1000" height="150" class="alignnone size-full wp-image-155906" />
<section id="breaking-news">

<?php slidedeck( 155784, array( 'width' => '100%', 'height' => '370px' ) ); ?>

  </section>
	<div id="content">
        
            <article class="post-154662 post type-post status-draft format-standard hentry category-culture-category tag-hot-docs tag-hot-docs-2012" id="post-154662" style="background:#fff; padding:0px;">
<p style="margin:0px;">Welcome to the 19th edition of the <a  href="http://www.hotdocs.ca/" onclick="javascript:_gaq.push(['_trackEvent','outbound-article','http://www.hotdocs.ca']);" target="_blank" class="external">Hot Docs Canadian International Documentary Festival</a>, North America&#8217;s largest celebration of non-fiction films. This year&#8217;s lineup boasts 189 features and shorts from 51 countries—the broadest slate of international selections since Hot Docs&#8217; founding in 1993. </p>
<p>Venue-wise, this year&#8217;s festival also reaches far and wide. In addition to Hot Docs&#8217; <a  href="http://torontoist.com/2012/03/scene-the-bloor-hot-docs-cinemas-grand-opening/" target="_blank">swanky new digs</a> at Bathurst and Bloor, and a traditional cluster of Yorkville venues, organizers have once again teamed with rep houses across the city, as well as the TIFF Bell Lightbox. And, in a new venture this year, two docs will screen at Cineplex cinemas across Canada via <a  href="http://www.hotdocs.ca/festival/hot_docs_live" onclick="javascript:_gaq.push(['_trackEvent','outbound-article','http://www.hotdocs.ca']);" target="_blank" class="external">Hot Docs Live!</a></p>
<p>It's a lot, and we are here to help you navigate it all. We've been watching screeners for weeks, focusing on the festival&#8217;s Special Presentations and Canadian Spectrum offerings; just click on any title in the drop-down list below to see what we thought of a film. Once the festival's underway we'll also have daily round-ups, filmmaker interviews, and even more reviews.</p>
</article>

        <h2 class="page-title">Hot Docs 2012 Reviews</h2>

          
<section id="hotdocs-reviews" style="display:inline;">
        <!--START loop -->


    <div style="text-align:center;"><form name="quickselect">
<h3><strong>Alphabetically:</strong></h3>
    <select name="movie" style="width: 80%; margin:4px;">
    <?php
    $querystring = array(
    'tag' => 'hot-docs-2012-review',
        'numberposts' => 100,
    orderby => 'title',
    'order'    => 'ASC'
    );            

        query_posts($querystring);
    $do_not_duplicate = array();
        if ( have_posts() ) : while ( have_posts() ) : the_post();
          if (in_array($post->ID, $do_not_duplicate)) continue; update_post_caches($posts);
        ?>

          <option value="<?php the_permalink(); ?>"><?php the_title(); ?> 

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
    'tag' => 'hot-docs-2012-review',
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

          <option value="<?php the_permalink(); ?>"><?php the_title(); ?> 

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



</section>
<p>&nbsp;
</p>     

       <h2 class="page-title">Box Office Information</h2>

<p></p>   
<p><strong>Single tickets</strong> are $14.50 for regular screenings and $5 for late-night screening, and are available in person (<a href="http://maps.google.com/maps?q=783+Bathurst+Street,+Toronto,+ON,+Canada&hl=en&sll=43.653226,-79.383184&sspn=0.837616,1.772919&oq=783+bathur&hnear=783+Bathurst+St,+Toronto,+Ontario+M5S+1Z5,+Canada&t=m&z=17">783 Bathurst Street</a>) and <a href="http://www.hotdocs.ca/festival/online_box_office/">online</a>.</p>

<p><strong>Daytime screenings</strong> are free for students (with valid ID) and seniors (60+).</p>

<p><strong>Festival passes</strong> are $115 (for 10 films) and $205 (for 20 films). An "All-You-Can-Eat" late-night pass is $10 for access to all nine post-11 p.m. screenings.</p>
  
<!--
        <nav class="post-nav">
            <div class="older-posts"><a href="/culture/page/2/">&laquo; Next Page</a></div>
        </nav>    
-->
        
    </div>    

<?php get_sidebar(); ?>


<?php get_footer(); ?>

