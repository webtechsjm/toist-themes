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
            	if($count < 3){
            		if(get_post_type() == "event"){
	            		get_template_part('includes/article','event');
		          		get_template_part('includes/article','shortview-mobile');
            		}else{
		          		get_template_part('includes/article','longview');
		          		get_template_part('includes/article','shortview-mobile');
            		}
            	}else{
            		get_template_part('includes/article','shortview');
            	}
            	$count++;
            	
            endwhile;
            ?>
        
        <nav class="post-nav">
            <div class="older-posts"><a href="/articles/page/2/">&laquo; Older Entries</a></div>
        </nav>    
        
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
