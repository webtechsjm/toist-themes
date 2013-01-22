		<footer class="global">
		    
		    <nav>
                <ul>
		    <li class="bul"><a href="http://torontoist.com/">Home</a></li><li>&bull;</li>
                    <li><a href="http://torontoist.com/about/">About</a></li>
                    <li><a href="http://torontoist.com/staff/">Staff</a></li>
                    <li><a href="http://torontoist.com/contribute/">Contribute</a></li>		        
                    <li style="display:none;"><a href="http:/torontoist.com/advertise/">Advertise</a></li>
                    <li><a href="http://torontoist.com/contact-us/">Contact</a></li>
                    <li><a href="http://torontoist.com/policies/">Policies</a></li>
		        </ul>
		    </nav>
		    
		<div id="copyright">	<small>&copy; <?php echo date("Y"); ?>, Ink Truck Media All rights reserved.</small></div>
					

		</footer>

	<?php wp_footer(); ?>

<!--custom functions-->
<script src="<?php bloginfo('template_directory'); ?>/_/js/functions.js"></script>

    <div id="sjm-network-footer">
        <style>
        <!--
            html #sjm-network-footer, html #sjm-network-footer a, html #sjm-network-footer h5, html #sjm-network-footer ul, html #sjm-network-footer ul li, html #sjm-network-footer h6, html #sjm-network-footer p {margin:0; padding:0; text-decoration:none; font-style:none; text-transform:none; border:none; text-align:center; font-family:"Helvetica Neue", sans-serif; line-height:100%; vertical-align:baseline;}
            
            html #sjm-network-footer {width:1010px; clear:both; margin:20px 0px; display:table;}
            
            html #sjm-network-footer a {color:#325998;}
            html #sjm-network-footer a:hover {text-decoration:underline;}
            
            html #sjm-network-footer h5 { font-weight:bold; font-size:18px; margin:0 0 20px 0; display:block; color:#FFF; background: #252525; padding:5px; opacity:0.6;} 
            
            html #sjm-network-footer ul {margin:0; padding:20px;}
            html #sjm-network-footer ul li:hover {opacity:1;}
            html #sjm-network-footer ul li {list-style:inside none; float:left; width:180px; margin-right:15px; opacity:0.6;}
            html #sjm-network-footer ul li.last-item {margin:0;}
            
            html #sjm-network-footer ul li h6 a {display:block; text-indent:-9999em; height:87px; background:url(http://media.torontolife.com/graphics/sjm-network-footer-logos.png) 0 -9px no-repeat;}
            
            html #sjm-network-footer ul li p {padding:10px;}
            html #sjm-network-footer ul li p a {font-size:14px; line-height:1.4;}           
        -->
        </style>
        
        <h5>The latest from across the St. Joseph Media network</h5>
        <ul>
            <li>
                <h6><a href="http://www.torontolife.com" target="_blank">Toronto Life</a></h6>
                <p><?php simple_feed_list('http://feeds.feedburner.com/TLTheWire','limit=1'); ?></p>
            </li>
            <li>
                <h6><a href="http://www.torontoist.com" target="_blank" style="background-position:-195px -9px;">Torontoist</a></h6>
                <p><?php simple_feed_list('http://feeds2.feedburner.com/Torontoist','limit=1'); ?></p>
            </li>
            <li>
                <h6><a href="http://www.ottawamagazine.com" target="_blank" style="background-position:-390px -9px;">Ottawa Magazine</a></h6>
                <p><?php simple_feed_list('http://feeds.feedburner.com/OttawaMagazine','limit=1'); ?></p>
            </li>            
            <li>
                <h6><a href="http://www.fashionmagazine.com" target="_blank" style="background-position:-585px -9px;">Fashion Magazine</a></h6>
                <p><?php simple_feed_list('http://feeds.feedburner.com/fashionmagmainfeed','limit=1'); ?></p>
            </li> 
            <li class="last-item">
                <h6><a href="http://www.quillandquire.com" target="_blank" style="background-position:-780px -9px;">Quill &amp; Quire</a></h6>
                <p><?php simple_feed_list('http://feeds.feedburner.com/quillblogrss','limit=1'); ?></p>
            </li>
            
            <li style="clear:left;">
                <h6><a href="http://www.canadianfamily.ca" target="_blank" style="background-position:0 -112px;">Canadian Family</a></h6>
                <p><?php simple_feed_list('http://feeds.feedburner.com/Cfmainfeed','limit=1'); ?></p>
            </li>
            <li>
                <h6><a href="http://www.20minutesupperclub.com" target="_blank" style="background-position:-195px -112px;">20 Minute Supper Club</a></h6>
                <p><?php simple_feed_list('http://feeds.feedburner.com/20MSCmainfeed','limit=1'); ?></p>
            </li>
            <li>
                <h6><a href="http://www.where.ca" target="_blank" style="background-position:-390px -112px;">Where Canada</a></h6>
                <p><?php simple_feed_list('http://feeds.feedburner.com/WhereMainFeed','limit=1'); ?></p>
            </li>            
            <li>
                <h6><a href="http://www.weddingbells.ca" target="_blank" style="background-position:-585px -112px;">Weddingbells</a></h6>
                <p><?php simple_feed_list('http://feeds.feedburner.com/Wbmainfeed','limit=1'); ?></p>
            </li> 
            <li class="last-item">
                <h6><a href="http://www.mariagequebec.com" target="_blank" style="background-position:-780px -112px;">Mariage Quebec</a></h6>
                <p><a href="http://www.mariagequebec.com/articles/slideshow/film-noir/">Film noir: Osez le noir et blanc avec les robes et accessoires du moment</a></p>
            </li>            
        </ul>
    
    
    </div>    

<!-- OAS AD 'x02' begin -->
<script type="text/javascript">
// <![CDATA[
OAS_AD('x02');
// ]]>
</script>
<!-- OAS AD 'x02' end -->
<!--The closing div below closes the uber container-->
</div>
<!--<script type="text/javascript" src="http://s.skimresources.com/js/130X1023785.skimlinks.js"></script>-->
</body>

</html>
