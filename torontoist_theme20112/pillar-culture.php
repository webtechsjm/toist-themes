<?php
/*
*	Template Name: Culture Pillar
*
*/

$posts_shown = array();

function culture_loop($tag_slug,$number=1){
	$loop = new WP_Query(array('post_type'=>'post','tag'=>$tag_slug,'posts_per_page'=>$number));
	if($loop->have_posts()): while($loop->have_posts()): $loop->the_post();
		//$term = get_term_by('slug',$tag_slug,'post_tag');
		$meta = get_post_meta(get_the_ID());
		?>
		<?php
		$comments_count = get_comments_number(get_the_ID());
		$comments_link = get_comments_link(get_the_ID());
		$comments = '';
		if(!comments_open()){
			$comments = 'Comments off';
		}else{
			switch($comments_count){
				case 0: $comments = __('0 comments'); break;
				case 1: $comments = __('1 comment'); break;
				default: $comments = sprintf(__('%d comments'),$comments_count); break;
			}
			$comments = sprintf('<a href="%s">%s</a>',
				$comments_link,
				$comments
				);
		}
		
		printf('<article><a href="%2$s">%1$s</a><h1><a href="%2$s">%3$s</a></h1><p>%4$s</p><p class="meta">%5$s | %6$s</p></article>',
			get_the_post_thumbnail(get_the_ID(),'medium'),
			get_permalink(),
			get_the_title(),
			$meta['alt_dek'][0] ?: $meta['dek'][0] ?: '',
			get_the_time('F j, Y \a\t g:i a'),
			$comments
			);
		global $posts_shown;
		$posts_shown[] = get_the_ID();
	endwhile;
	else: return false; endif;
}

get_header();
?>
<div id="content" class="culture pillar">
	<h1>Culture</h1>
	<?php
		global $wpdb;
		$exclude_tag_slugs = array('rep-cinema-this-week','sound-advice','reel-toronto','televisualist');
		$stmt = "SELECT tt.term_taxonomy_id FROM wp_terms t 
							LEFT JOIN wp_term_taxonomy tt ON tt.term_id = t.term_id
							WHERE t.slug IN ('%s')
							AND tt.taxonomy = 'post_tag'";
		$stmt = sprintf($stmt,
			join($exclude_tag_slugs,"','")
			);
		$exclude = $wpdb->get_col($stmt);
				
		$featured = new WP_Query(array(
			'category_name'	=>	'culture-category',
			'tag__not_in'		=>	$exclude,
			'posts_per_page'=>	4
		));
		
		if($featured->have_posts()):
		echo '<section class="featured">';
		while($featured->have_posts()): $featured->the_post();
			$posts_shown[] = get_the_ID();
			if(has_post_thumbnail()){
				$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
				$style = sprintf(' style="background:url(%s)"',$thumb[0]);
			}else{$style = '';}
			$meta = get_post_meta(get_the_ID());
			?>
			<a href="<?php the_permalink(); ?>">
				<img src="<?php echo bloginfo('stylesheet_directory').'/images/graphics/_.gif'; ?>" class="background"<?php echo $style; ?>>
				<div class="overlay">
					<div class="summary">
						<h1><?php the_title(); ?></h1>
						<p><?php echo $meta['alt_dek'][0] ?: $meta['dek'][0] ?: ''; ?></p>
					</div>
				</div>
			</a>
			
			<?php			
		endwhile;
		echo '</section>';
		endif;
		?>
		
	<section class="calendar">
		<h1><strong>Event</strong><wbr>Listings</h1>
		<?php	if(function_exists('dynamic_sidebar')) dynamic_sidebar('Culture Tile'); ?>
	</section>
	<section class="reviews">
		<h1><strong>Recent</strong><wbr>Reviews</h1>
		<?php 
			$events = eo_get_events(array(
				'event_end_after'		=>	'today',
				'meta_key'					=>	'_include_in_feed',
				'meta_value'				=>	'true',
				'posts_per_page'		=>	5
			));
		
			global $post;
			if(!empty($events)):
				echo '<ul>';
				$old_post = $post;
				foreach($events as $event):
				$post = $event;
				?>
		
				<li>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>			
				<?php
				endforeach;
				$post = $old_post;
				echo '</ul>';
			endif;
		?>
	</section>
	<hr />
	<section class="sound-advice">
		<h1><img src="<?php bloginfo('stylesheet_directory') ?>/images/graphics/icon-culture-sound-advice.png" /><strong>Sound</strong><wbr>Advice</h1>
		<div class="slider">
			<a href="" class="slidenav previous"><img class="sprite" src="<?php bloginfo('stylesheet_directory') ?>/images/graphics/_.gif" /></a>
			<a href="" class="slidenav next"><img class="sprite" src="<?php bloginfo('stylesheet_directory') ?>/images/graphics/_.gif" /></a>
			<div class="container">
				<?php culture_loop('sound-advice',5); ?>
			</div>
		</div>
	</section>
	<section class="reel-toronto">
		<h1><img src="<?php bloginfo('stylesheet_directory') ?>/images/graphics/icon-culture-reel-toronto.png" /><strong>Reel</strong><wbr>Toronto</h1>
		<div class="slider">
			<a href="" class="slidenav previous"><img class="sprite" src="<?php bloginfo('stylesheet_directory') ?>/images/graphics/_.gif" /></a>
			<a href="" class="slidenav next"><img class="sprite" src="<?php bloginfo('stylesheet_directory') ?>/images/graphics/_.gif" /></a>
			<div class="container">
				<?php culture_loop('reel-toronto',5); ?>
			</div>
		</div>
	</section>
	<h2>What to <strong>watch this week</strong></h2>
	<section class="televisualist">
		<h1><strong>Tele</strong>visualist</h1>
		<?php culture_loop('televisualist'); ?>
	</section>
	<section class="rep-cinema">
		<h1><strong>Rep</strong>Cinema</h1>
		<?php culture_loop('rep-cinema-this-week'); ?>
	</section>

<?php /*
	<hgroup>
		<h1>Most Recent in Culture</h1>
		<a href="<?php echo site_url('/category/culture'); ?>" class="see-all">See all posts in culture</a>
	</hgroup>
	<?php
		$the_rest = new WP_Query(array(
			'post_type'				=>	'post',
			'category_name'		=>	'culture',
			'post__not_in'		=>	$posts_shown
		));
				
		if($the_rest->have_posts()) while($the_rest->have_posts()):
			$the_rest->the_post();?>
			<article>
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<p><?php the_excerpt(); ?></p>
			</article>
			<?php
			
		endwhile;
		wp_reset_query();
	*/ ?>
</div>
<?php get_sidebar('culture'); ?>
<?php get_footer(); ?>
