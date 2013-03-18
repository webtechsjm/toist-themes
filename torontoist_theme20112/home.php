<?php get_header(); ?>
    <section id="breaking-news" style="display:none;">
    <?php slidedeck( 63405, array( 'width' => '1000px', 'height' => '150px' ) ); ?>
    </section>

	<div id="content">	
        
        <section id="feature-story" style="display:none;">
            <?php
               slidedeck( 63248, array( 'width' => '640', 'height' => '450px' ) );
            ?>
        </section>

        <!--START loop 1--> 
            <?php
            global $wp_query;
            
            $count = 0;
            if(have_posts()) while(have_posts()): the_post();
            	if(!is_paged()){
		          	if($count < 3){
		          		if(get_post_type() == "event"){
			          		get_template_part('includes/article','event');
		          		}else{
				        		get_template_part('includes/article','longview');
		          		}
				       		get_template_part('includes/article','shortview-mobile');
		          	}else{
		          		get_template_part('includes/article','shortview');
		          	}
		          }else{get_template_part('includes/article','shortview');}
            	$count++;
            	
            endwhile;
            ?>
        
 				<?php 
				global $wp_query;
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
