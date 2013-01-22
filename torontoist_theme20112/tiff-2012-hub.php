<?php
/*
Template Name: TIFF 2012
*/
?>


<?php get_header(); ?>

<style>
 p {font-style:normal;}
 li {font-style:normal;}
 td {font-style:normal;}
</style>
<img src="http://torontoist.com/wp-content/uploads/2012/09/tiff-2012-banner.jpg" alt="" title="tiff-2012-banner" width="1000" height="150" class="alignnone size-full wp-image-193298" /><br/><br/>
<section id="breaking-news">

<?php slidedeck( 155784, array( 'width' => '100%', 'height' => '370px' ) ); ?>

  </section>
</em></em></em>	<div id="content">
        
            <article class="post-154662 post type-post status-draft format-standard hentry category-culture-category tag-hot-docs tag-hot-docs-2012" id="post-154662" style="background:#fff; padding:0px;">
<p style="margin:0px;">It’s early September, <a href="http://www.nowtoronto.com/guides/tiff/2012/story.cfm?content=188446" target="_blank">select watering holes</a> are serving until 4 a.m., and the silver screen's top talent have once again descended on our fair streets. That’s right, it’s time for the 37th installment of the <a href="http://tiff.net/thefestival" target="_blank">Toronto International Film Festival</a>, the world’s largest public celebration of cinema.</p>

<p>Indeed, 2012 is a particularly big year for TIFF, with a mammoth 289 features and 83 shorts unspooling between September 6 and and 16. This year's fest selections hail from a record-breaking 72 countries, while 270 films will make their world, international, or North American premieres—also a festival best.</p>

</article>
<br/>
        <h2 class="page-title">TIFF 2012 Reviews</h2>

          
<section id="tiff-reviews" style="display:inline;">
        <!--START loop -->


    <div style="text-align:center;"><form name="quickselect">
<h3><strong>Alphabetically:</strong></h3>
    <select name="movie" style="width: 80%; margin:4px;">
    <?php
    $querystring = array(
    'tag' => 'TIFF-2012-reviews',
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
    'tag' => 'TIFF-2012-reviews',
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

       <h2 class="page-title">TIFF Daily Tipsheet: Friday, September 14</h2>
<p></p>   
<p>It’s closing time at TIFF, with only three days to go before the 270-some films run together into a blurry false memory of Salman Rushdie sent back through time to snuff out Bruce Willis. Before it comes to that, why not spend the day with some films we liked?
</p>
   
<p>Our top pick today—although we suspect the 20 or so people who walked out of its first screening won’t agree—is <em>Leviathan</em> (<img src="http://torontoist.com/wp-content/uploads/2011/10/stars-4andahalf24.jpg" alt="" title="stars-4andahalf24" width="70" height="15" class="alignnone size-full wp-image-87363" />). Hatched by a pair of anthropologists at Harvard’s Sensory Ethnography Lab, the film is a documentary tour of a fishing vessel off the coast of New Bedford. The camera soars through the air as often as it crashes down in a mess of bloody chum. Gross as it all sounds, it’s a visual feast unlike anything at the festival. The film is somewhere between a gruesome autobiography of a fish and a no-nonsense profile of men at work. </p>

<p><em>Leviathan</em> is not for everyone, to put it mildly, and neither is our next pick, <em>Spring Breakers</em> (<img src="http://torontoist.com/wp-content/uploads/2011/09/4stars.jpg" alt="" title="4stars" width="70" height="15" class="alignnone size-full wp-image-82627" />). Enfant terrible Harmony Korine returns with the hedonistic comedy (starring who else but Selena Gomez and Vanessa Hudgens!) about four vacationing coeds in search of Florida’s piece of the sublime. Props to James Franco, who goes whole hog as a drug dealer prone to boasting about his wide array of colourful shorts. Those seeking something a bit more traditional than either the fish or the Franco odyssey will be safer with <em>Rebelle</em> (<img src="http://torontoist.com/wp-content/uploads/2011/09/stars-3andahalf9.jpg" alt="" title="stars-3andahalf" width="70" height="15" class="alignnone size-full wp-image-81185" />), Kim Nguyen’s sensitive and nicely lensed first-person diary of a child soldier uprooted from her home.</p>

</p>


       <h2 class="page-title">Tickets and Box Office</h2>

<p></p>   
<p><strong>Single tickets</strong> are $20 for regular screenings, $15 for those 25 and under; red carpet premieres are about twice as much. Blocks of available tickets are released at 7 a.m. each day, and rush tickets are released ten minutes before screening time. Packages are entirely sold out.</p>

<p><strong>Online</strong> is hit-and-miss, but <a href="http://tiff.net/thefestival/tickets/packages">the site</a> seems to be working better this year.</p>

<p><strong>By phone</strong> at 416.599.8433</p>

<p><strong>In person</strong> at the Festival Box Office (225 King Street West).</p>
  
<!--
        <nav class="post-nav">
            <div class="older-posts"><a href="/culture/page/2/">&laquo; Next Page</a></div>
        </nav>    
-->
        
    </div>    

<?php get_sidebar(); ?>


<?php get_footer(); ?>

