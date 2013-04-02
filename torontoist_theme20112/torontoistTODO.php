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

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post" id="post-<?php the_ID(); ?>">
	<h2><?php //the_title(); ?></h2>
		<div class="entry">
			<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
		</div> 
	</div>
<?php endwhile; endif; ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>