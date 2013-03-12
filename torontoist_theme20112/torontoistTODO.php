<?php
/*
Template Name: torontoistTODO
*/
?>


<?php get_header(); ?>

<div id="content">	
        
<link rel="stylesheet" href="http://media.torontolife.com/todo/todo.css" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://media.torontolife.com/todo/expand.js"></script>

<script type="text/javascript">

<!--//-->< ![CDATA[//><!--
$(function() {
    // --- first section initially expanded:
	$(".expand").toggler();
    //$(".expand").toggler({initShow: "div.collapse:first"});
});
//-->< !]]>

</script>

<div id="todo_head" style="margin:20px 0 40px 25px;">
  <img src="http://media.torontolife.com/img/TOdo/TOdo_header_noSponsor.gif" border="0" usemap="#todo_sponsor" />
  <map name="todo_sponsor" id="todo_sponsor">
    <area shape="rect" coords="469,4,598,25" href="" target="_blank" alt="sponsor link" />
    <area shape="rect" coords="460,46,598,65" href="http://www.torontolife.com/TOdo_sales/" alt="Add Your Event" />
  </map>
</div>
<!--OCAD-->
<div class="todo_container">
  <img src="http://media.torontolife.com/img/TOdo/ocad/130228_OCADU_P31_todo_600x100.jpg" width="600px" height="100px" />
  <p style="margin-top: 5px; margin-bottom: 10px;" class="expand">Details</p>
  <div class="collapse">
    <img class="product" src="http://media.torontolife.com/img/TOdo/ocad/130227_OCADU_P31_todo_260x260.jpg" width="260px" height="260px" />
    <div class="info">
    <p><b>Project 31 Live Art Auction &ndash; Wednesday, March 27, 2013</b><br/>
    OCAD University, Great Hall (2nd Floor), 100 McCaul Street<br/>
	6 p.m. Preview and Reception, 7 p.m. Live Auction<br/>
    Tickets: $95<br/>
    <strong><a style="color:#000;" href="http://www.ocadu.ca/project31" target="_blank">www.ocadu.ca/project31</a></strong></p>
<br/>
	Attend one of the city's most accessible art collecting events, Project 31, a live art auction that offers stunning paintings, photography, limited edition prints, sculpture, textile,  illustration, jewellery and digital media created by OCAD University's award-winning faculty members. All funds raised support OCAD U student initiatives and learning experiences. Tickets can be purchased on-line.<br/><br/>

  <strong><a style="color:#000;" href="http://www.torontolife.com/ocaduniversity_todo_torontoist" target="_blank">Click here for more info &raquo;</a></strong></p>
    </div>
    <img src="http://media.torontolife.com/hotdeals/images/underline.gif" width="600px" height="20px" />
  </div>
</div>
<!--end OCAD-->
<!--ROM--> <div class="todo_container">  <img src="http://media.torontolife.com/img/TOdo/AncientPROM_TL_ExpendingImage.jpg" width="600px" height="100px" />  <p style="margin-top: 5px; margin-bottom: 10px;" class="expand">Details</p>  <div class="collapse">    <img class="product" src="http://media.torontolife.com/img/TOdo/AncientPROM_TL_Main_Image.jpg" width="260px" height="260px" />    <div class="info">    <p><b>Rock the Cradle of Civilization &ndash; Ancient Prom</b><br/>    100 Queen's Park, 416.586.5772<br/> Saturday April 6 &ndash; Royal Ontario Museum<br/><br/>     Join hundreds of Young Patrons Circle (YPC) members and guests for a contemporary party at the ROM inspired by past civilizations. Ancient PROM will be an unforgettable night of live entertainment and dancing, luxurious lounge areas and gourmet fare. Get ready to experience an epic party worthy of an ancient empire on Saturday, April 6, 2013!<br/><br/>   <strong><a style="color:#000;" href="http://www.torontolife.com/romprom_todo_torontoist" target="_blank" rel="nofollow">Click here for more info &raquo;</a></strong></p>    </div>    <img src="http://media.torontolife.com/hotdeals/images/underline.gif" width="600px" height="20px" />  </div> </div> <!--end ROM-->
<!--ballet jorgen-->
<div class="todo_container">
  <img src="http://media.torontolife.com/img/TOdo/swan-lake_600x100.jpg" width="600px" height="100px" />
  <p style="margin-top: 5px; margin-bottom: 10px;" class="expand">Details</p>
  <div class="collapse">
    <img class="product" src="http://media.torontolife.com/img/TOdo/swan-lake_260x260.jpg" width="260px" height="260px" />
    <div class="info"><p><b>SWAN LAKE</b><br/>
    <b>March 27, 28, &amp; 30, 2013</b><br/>
    <b>Betty Oliphant Theatre</b><br/>
    <b>Tickets: 416.978.8849 or <strong><a style="color:#000;" href="http://www.uofttix.ca" target="_blank" rel="nofollow">www.uofttix.ca</strong></a>
</b><br/>
<br/>
   Ballet J&ouml;rgen Canada presents a spectacular new production of Swan Lake. Choreographed by Bengt Jörgen, this newly-imagined version of the iconic ballet is set at the Fortress of Louisbourg, Nova Scotia.<br /> 
Tickets $29 - $75.
<br/><br/>
  <strong><a style="color:#000;" href="http://www.torontolife.com/balletjorgencanada_swanlake_todo" target="_blank" rel="nofollow">Click here for more info &raquo;</a></strong></p>
    </div>
    <img src="http://media.torontolife.com/hotdeals/images/underline.gif" width="600px" height="20px" />
  </div>
</div>
<!--end ballet jorgen-->
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
