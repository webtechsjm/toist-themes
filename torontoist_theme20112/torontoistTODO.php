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
<!--eps-->
<div class="todo_container">
  <img src="http://media.torontolife.com/img/TOdo/study_go_abroad_todo2013_600x100.jpg" width="600px" height="100px" />
  <p style="margin-top: 5px; margin-bottom: 10px;" class="expand">Details</p>
  <div class="collapse">
    <img class="product" src="http://media.torontolife.com/img/TOdo/study_go_abroad_todo2013_260x260.jpg" width="260px" height="260px" />
    <div class="info">
    <p><b>Don't miss the most important event of the year for studies or travel abroad</b><br/>
    Study and Go Abroad student expo<br/>
Sunday, March 3 – Metro Toronto Convention Centre, North Building<br/><br/>

    Don't miss the Study and Go Abroad Fair, Canada's largest international university and student travel expo.   The expo, which is open from 1pm to 5pm on Sunday, March 3rd, offers visitors an exciting opportunity to meet with top-ranked universities and colleges from around the world to learn about undergraduate, post-graduate,  vocational and language programs abroad.  Our student travel pavilion will showcase a range of gap year options, work abroad programs, volunteering and adventure travel.  <br/><br/> Come an hour before the fair opens to catch our guest speaker seminar (check our website for more information).<br/><br/>
    Pre-register online or on the day and you will be entered into the Grand Prize Draw.<br/>

Admission and seminars are FREE.<br/><br/>

  <strong><a style="color:#000;" href="http://www.torontolife.com/revolveepsholdings_todo" target="_blank">Click here for more info &raquo;</a></strong></p>
    </div>
    <img src="http://media.torontolife.com/hotdeals/images/underline.gif" width="600px" height="20px" />
  </div>
</div>
<!--end eps-->
<!--ballet jorgen-->
<div class="todo_container">
  <img src="http://media.torontolife.com/img/TOdo/swan-lake_600x100.jpg" width="600px" height="100px" />
  <p style="margin-top: 5px; margin-bottom: 10px;" class="expand">Details</p>
  <div class="collapse">
    <img class="product" src="http://media.torontolife.com/img/TOdo/swan-lake_260x260.jpg" width="260px" height="260px" />
    <div class="info"><p><b>SWAN LAKE</b><br/>
    <b>March 27, 28, &amp; 30, 2013</b><br/>
    <b>Betty Oliphant Theatre</b><br/>
    <b>Tickets: 416.978.8849 or <strong><a style="color:#000;" href="http://www.uofttix.ca" target="_blank">www.uofttix.ca</strong></a>
</b><br/>
<br/>
   Ballet J&ouml;rgen Canada presents a spectacular new production of Swan Lake. Choreographed by Bengt Jörgen, this newly-imagined version of the iconic ballet is set at the Fortress of Louisbourg, Nova Scotia.<br /> 
Tickets $29 - $75.
<br/><br/>
  <strong><a style="color:#000;" href="http://www.torontolife.com/balletjorgencanada_swanlake_todo" target="_blank">Click here for more info &raquo;</a></strong></p>
    </div>
    <img src="http://media.torontolife.com/hotdeals/images/underline.gif" width="600px" height="20px" />
  </div>
</div>
<!--end ballet jorgen-->
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
