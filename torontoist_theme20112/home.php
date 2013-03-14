<?php get_header(); ?>
	<!-- archive.php -->
	<div id="content">	
		<?php if (have_posts()) : ?>

 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
            <?php if(isset($_GET['author_name'])) : $currentauthor = get_userdatabylogin(get_the_author_login());
            else : $currentauthor = get_userdata(intval($author)); endif; // Hack, to allow author name display ?>
            
			<?php if( is_tag() ) { ?>
                <h2 class="page-title">Posts Filed Under: <?php single_tag_title(); ?> <div style="float:right; margin-top:2px;"><a href="feed/"><img height="14" src="/wp-content/themes/torontoist_theme20112/images/graphics/rss.png"></a></div></h2>

			<?php } elseif (is_day()) { ?>
				<h2 class="page-title">Archive for &#8216;<?php the_time('F jS, Y'); ?>&#8217;</h2>

			<?php } elseif (is_month()) { ?>
				<h2 class="page-title">Archive for &#8216;<?php the_time('F, Y'); ?>&#8217;</h2>

			<?php } elseif (is_year()) { ?>
				<h2 class="page-title">Archive for &#8216;<?php the_time('Y'); ?>&#8217;</h2>

			<?php } elseif (is_author()) { ?>
				<h2 class="page-title">Archive for '<?php echo $currentauthor->display_name; ?>' <div style="float:right; margin-top:2px;"><a href="feed/"><img height="14" src="/wp-content/themes/torontoist_theme20112/images/graphics/rss.png"></a></div></h2>

			<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h2 class="page-title">Blog Archives</h2>
			
			<?php } ?>

			<?php while (have_posts()) : the_post(); ?>
			
                <?php include (TEMPLATEPATH . '/includes/article-shortview.php'); ?>

			<?php endwhile; ?>

            <?php include (TEMPLATEPATH . '/includes/post-nav.php' ); ?>
			
	    <?php else : ?>

		<h2>Nothing found</h2>

	    <?php endif; ?>
    </div> 
    
<?php get_sidebar('home'); ?>

<?php get_footer(); ?>
