<div id="sidebar">
    <section id="mainsearch"> 
        <form action="<?php bloginfo('siteurl'); ?>" method="get">
            <input type="search" id="s" name="s" value="SEARCH TORONTOIST" onfocus="if(this.value=='SEARCH TORONTOIST')this.value=''" onblur="if(this.value=='')this.value='SEARCH TORONTOIST'" placeholder="SEARCH TORONTOIST" />   
            <input type="image" value="go" name="search" class="go" src="/wp-content/themes/torontoist_theme20112/images/graphics/search-btn-grey.png">
        </form>
    </section>
    
	  <div class="big-box">
			<!-- TST_BB_Upper -->
			<div id='div-gpt-ad-1347634485931-0'>
				<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1347634485931-0'); });
				</script>
			</div>
		</div>
    
 		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : ?>

		<?php endif; ?>
        
        <section id="picks">
            <h5>Editor's Picks</h5>
            <table>
                <?php
		global $post;
		$count = 1;
		$rowcount = 1;
                $myposts = get_posts(array('numberposts'=>6, 'tag'=>'editors-pick'));
                foreach($myposts as $post) :
		if ( $count&1 ) { echo "<tr>"; }
                ?>
                <td>
                    <?php edit_post_link('[Edit]','',' '); ?>   
                    <a href="<?php the_permalink(); ?>" class="title">
                        <?php if ($post_alt_title = get_post_meta($post->ID, 'alt_title', true)) {
                              echo $post_alt_title;
                              } 
                              else {
                              the_title();
                              } 
                        ?>
                    </a>
		   <?php if (($count+$rowcount)&1) : ?>
                    <a href="<?php the_permalink() ?>" class="image">
                        <?php if ($post_alt_image = get_post_meta($post->ID, 'alt_image', true)) {
                              echo $post_alt_image;
                              } 
                              else {
                              the_post_thumbnail('large_thumb');
                              } 
                        ?>
                    </a>
		  <? else: ?>
                    <a href="<?php the_permalink(); ?>" class="dek">
                        <?php if ($post_alt_dek = get_post_meta($post->ID, 'alt_dek', true)) {
                              echo $post_alt_dek;

                              } 
                              elseif ($post_dek = get_post_meta($post->ID, 'dek', true)) {

                              echo $post_dek;
                              } 
                        ?>
                    </a>
		<? endif; ?>

                </td>
                <?php $count ++; 
		  if ( $count&1 ) { echo "</tr>"; $rowcount ++;}
		endforeach; ?>
            </table>

        </section>
<?php /*
        <section id="picks" style="display:none;">
            <a href="/nxne"><h5>NXNE GUIDES</h5></a>
            <table>
                <?php
		global $post;
		$count = 1;
		$rowcount = 1;
                $myposts = get_posts(array('numberposts'=>6, 'tag'=>'nxne-2012-guide'));
                foreach($myposts as $post) :
		if ( $count&1 ) { echo "<tr>"; }
                ?>
                <td>
                    <?php edit_post_link('[Edit]','',' '); ?>   
                    <a href="<?php the_permalink(); ?>" class="title">
                        <?php if ($post_alt_title = get_post_meta($post->ID, 'alt_title', true)) {
                              echo $post_alt_title;
                              } 
                              else {
                              the_title();
                              } 
                        ?>
                    </a>
                    <a href="<?php the_permalink() ?>" class="image">
                        <?php if ($post_alt_image = get_post_meta($post->ID, 'alt_image', true)) {
                              echo $post_alt_image;
                              } 
                              else {
                              the_post_thumbnail('large_thumb');
                              } 
                        ?>
                    </a>

                </td>
                <?php $count ++; 
		  if ( $count&1 ) { echo "</tr>"; $rowcount ++;}
		endforeach; ?>
            </table>
<center><a href="/nxne"><img src="http://torontoist.com/wp-content/uploads/2012/06/NXNEist_mb.jpg"></a></center>
        </section>


        <section id="ttc" style="display:none;">
            <h5><a href="http://twitter.com/#!/TTCnotices" target="_new">TTC Service Alerts</a></h5>
		<?php 
			date_default_timezone_set('America/Toronto');
			$getitems = 3;
			$validresponse = "FALSE";
			do {
			  $shortcode = "[twitter-widget username=\"ttcnotices\" hiderss=\"true\" errmsg=\"Nothing to report at this time.\" hidereplies=\"true\" items=\"$getitems\" title=\" \" hidefrom=\"true\" fetchTimeOut=\"8\" showts=\"1\" dateFormat=\" | g:i A M j\"]";
			  $response = do_shortcode($shortcode); 
			  if (preg_match("/invalid/i",$response)) {
			     $getitems += 5;
			  }
			  else {
			     $validresponse = "TRUE";
			     $response = preg_replace("/\^../","",$response);
			     echo "$response";
			  }
			} while ($validresponse == "FALSE");
		?>
        </section>
*/ ?>




	 	
      <div class="big-box">
		<!-- TST_BB_Lower -->
		<div id='div-gpt-ad-1343667556242-2' >
		<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1343667556242-2'); });
		</script>
		</div>
        </div>
	
            <h5>Social Media</h5>
<!-- Reddit Widget
<section id="reddit">
	<script src="http://www.reddit.com/domain/torontoist.com/hot/.embed?limit=5&t=all&expanded=1&bordercolor=EDEFF4" type="text/javascript"></script>
</section>
-->


        <section id="google+">
<center>
<a href="https://plus.google.com/100174053117586196083/?prsrc=3" style="text-decoration: none; color: #333;"><div style="display: inline-block; *display: inline;"><div style="text-align: center;"><img src="https://ssl.gstatic.com/images/icons/gplus-64.png" width="64" height="64" style="border: 0;"></img></div><div style="font: bold 13px/16px arial,sans-serif; text-align: center;">Torontoist</div><div style="font: 13px/16px arial,sans-serif;"> on Google+ </div></div></a></center>
        </section>


        <section id="twitter-box">	
            <script src="http://widgets.twimg.com/j/2/widget.js"></script>
            <script>
            new TWTR.Widget({
              version: 2,
              type: 'search',
              search: 'Torontoist',
              interval: 6000,
              title: 'Torontoist',
              subject: '',
              width: 298,
              height: 320,
              theme: {
                shell: {
                  background: '#EDEFF4',
                  color: '#333333'
                },
                tweets: {
                  background: '#FFFFFF',
                  color: '#252525',
                  links: '#9E0B0F'
                }
              },
              features: {
                scrollbar: true,
                loop: false,
                live: true,
                hashtags: true,
                timestamp: true,
                avatars: true,
                toptweets: true,
                behavior: 'all'
              }
            }).render().start();
            </script>
        </section>    
               
        <section id="facebook-widgets">
<!--
	<iframe src="http://www.facebook.com/plugins/recommendations.php?site=http%3A%2F%2Fwww.torontoist.com&amp;width=350&amp;height=290&amp;header=true&amp;colorscheme=light&amp;font=arial&amp;border_color=%23b2b2b2" scrolling="yes" frameborder="0" style="border:none; overflow:hidden; width:350px; height:290px;" allowTransparency="true"></iframe>
-->

        <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Ftorontoist&amp;width=300&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23b2b2b2&amp;stream=false&amp;header=true&amp;height=290" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:290px;" allowTransparency="true"></iframe>
        
<!-- Facebook Recent Activity
        <iframe src="http://www.facebook.com/plugins/activity.php?site=http%3A%2F%2Fwww.torontoist.com&amp;width=350&amp;height=300&amp;header=true&amp;colorscheme=light&amp;font=arial&amp;border_color=%23B2B2B2&amp;recommendations=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:350px; height:300px;" allowTransparency="true"></iframe>
--> 
        </section>

        <section id="recent-comments">

        </section>        

            <h5>Special Notices</h5>
        <section id="todo" style="margin:0 25px;">	
	  <!--<a href="/handmade-toronto/"><img src="http://torontoist.com/wp-content/uploads/2012/06/mh_mini_01.jpg"></a>-->
	  <a href="/todo/"><img src="/wp-content/uploads/2011/09/TOdo_MB.gif"></a>

	</section>

</div>

<script type="text/javascript">
//<![CDATA[
{
     document.getElementById('feature-overlay').className='show';
     document.getElementById('breaking3').className='show';
}
//]]>
</script>
