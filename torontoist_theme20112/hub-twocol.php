<?php
/*
Template Name: Coverage Hub with Sidebar
*/
?>


<?php get_header(); ?>
<section id="breaking-news" style="display:none">
<?php slidedeck( 63405, array( 'width' => '100%', 'height' => '370px' ) ); ?>
</section>
<div id="content" class="hub">
	<header>
		<?php 
			if(function_exists('the_featured_media')) {the_featured_media('full');}
			else{the_post_thumbnail('full');}
			?>
		<h1><?php the_title(); ?></h1>
		<?php edit_post_link(__('[Edit]'));?>
	</header>
	<div class="full container">
		<?php if(have_posts()) while(have_posts()): the_post(); 
			the_content(); 
			endwhile;?>
	</div>
</div>
<?php get_sidebar('special-topics'); ?>
<?php get_footer(); ?>

