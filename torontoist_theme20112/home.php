<?php 
get_header();
?>
	<div id="content">
    <?php if(function_exists('the_hub_banner')) the_hub_banner(); ?>
        <section id="feature-story" style="display:none;">
            <?php
               slidedeck( 63248, array( 'width' => '640', 'height' => '450px' ) );
            ?>
        </section>

        <!--START loop 1--> 
            <?php
            function events_before($where){
            	global $wp_query;
            	$first_post = $wp_query->posts[0];
            	$first_post_time = new DateTime($first_post->post_date_gmt);
							$first_post_time = $first_post_time->format('Y-m-d H:i:s');
            	$where .= sprintf(' AND post_date <= "%s"',
								$first_post_time
								);
							return $where;
            }
            
            global $wp_query;
            
            if(is_paged()) add_filter('posts_where','events_before');
            $events = new WP_Query(array(
            	'post_type'	=>	'event',
            	'posts_per_page' => 2,
            	'orderby'			=>	'date',
            	'meta_query'	=>	array(
            		array(
		          		'key'			=>	'_include_in_feed',
		          		'value'		=>	'true'
            		)
            	)
            ));
            
            remove_filter('posts_where','events_before');
            
            $queued_event = false;
            $newswatch_shown = false;
                        
            $count = 0;
            if(have_posts()) while(have_posts()): the_post();
	            global $post;
	            
	            //uncomment similar section below
	            if($count == 3 && !$newswatch_shown && function_exists('newswatch_list') && get_option('show_newswatch') == '1'){
		            newswatch_list();
		            $newswatch_shown = true;
	            }
	            
            	if(empty($queued_event)){
		            $queued_event = array_shift($events->posts);
		            }
		          if(!empty($queued_event)){
				        $post_date = new DateTime($post->post_date);
				        $event_date = new DateTime($queued_event->post_date);
				        if($post_date->format('U') < $event_date->format('U')){
				          $old_post = $post;
				          $post = $queued_event;
				          if($count < 3 && !is_paged()){
				          	get_template_part('includes/article','event');
				          }else{
				          	get_template_part('includes/article','shortview');
				          }
				          $count++;
				         
				          $post = $old_post;
				          $queued_event = false;
            		}
            	}
            	
            	
            	if(!is_paged()){
			          if($count == 3 && !$newswatch_shown && function_exists('newswatch_list') && get_option('show_newswatch') == '1'){
				          newswatch_list();
				          $newswatch_shown = true;
			          }
            	
		          	if($count < 3){
		          		
			        		get_template_part('includes/article','longview');
				       		get_template_part('includes/article','shortview-mobile');
		          	}else{
		          		get_template_part('includes/article','shortview');
		          	}
		          }else{get_template_part('includes/article','shortview');}
            	$count++;
            	
            endwhile;
            /*
            $count = 0;
            if(have_posts()) while(have_posts()): the_post();
            if($count < 3){
	        		get_template_part('includes/article','longview');
		       		get_template_part('includes/article','shortview-mobile');
          	}else{
          		get_template_part('includes/article','shortview');
          	}
          	$count++;
            endwhile;
            
            */
            ?>
        
 				<?php 
				if ( $wp_query->max_num_pages > 1 ) : ?>
					<nav class="post-nav">
						<div class="older-posts"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older Entries' , 'torontoist' ) ); ?></div>
						<div class="newer-posts"><?php previous_posts_link( __( 'Newer events <span class="meta-nav">&raquo;</span>', 'torontoist' ) ); ?></div>
					</nav><!-- #nav-above -->
				<?php endif; ?>
        
    </div>    

<?php get_sidebar('home'); ?>

<?php get_footer(); ?>

<script type="text/javascript">
//<![CDATA[
{
     document.getElementById('feature-overlay').className='show';
}
//]]>
</script>
