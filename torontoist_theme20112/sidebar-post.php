<div id="sidebar">
    <section id="mainsearch"> 
        <form action="<?php bloginfo('siteurl'); ?>" method="get">
            <input type="search" id="s" name="s" value="SEARCH TORONTOIST" onfocus="if(this.value=='SEARCH TORONTOIST')this.value=''" onblur="if(this.value=='')this.value='SEARCH TORONTOIST'" placeholder="SEARCH TORONTOIST" />   
            <input type="image" value="go" name="search" class="go" src="/wp-content/themes/torontoist_theme20112/images/graphics/search-btn-grey.png">
        </form>
    </section>
    
 		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Post Sidebar')) : ?>

		<?php endif; ?>

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
