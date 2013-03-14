<div id="sidebar">
    <section id="mainsearch"> 
        <form action="<?php bloginfo('siteurl'); ?>" method="get">
            <input type="search" id="s" name="s" value="SEARCH TORONTOIST" onfocus="if(this.value=='SEARCH TORONTOIST')this.value=''" onblur="if(this.value=='')this.value='SEARCH TORONTOIST'" placeholder="SEARCH TORONTOIST" />   
            <input type="image" value="go" name="search" class="go" src="/wp-content/themes/torontoist_theme20112/images/graphics/search-btn-grey.png">
        </form>
    </section>
       
 		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Test Sidebar')) : ?>

		<?php endif; ?>    

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
