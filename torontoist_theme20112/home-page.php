<?php 
/*
*		Template Name: Home Page
*/

get_header(); 

?>

    <!--HOME-PAGE.PHP-->
    
    
    
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
            $count = 0;
            if(have_posts()) while(have_posts()): the_post();
            	get_template_part('includes/article-longview.php');
            endwhile;
            
            $args = array( 'numberposts' => 3, 'category' => -25420 );
            $lastposts = get_posts( $args );
            
            //can get post->postdate
                        
            foreach($lastposts as $post) : setup_postdata($post); ?>
                
                <!--include/article-longview.php-->                 
                <?php include (TEMPLATEPATH . '/includes/article-longview.php'); ?> 
            
            <?php endforeach; ?>
        <!--END loop 1-->

        <!--START loop 1 mobile--> 
            <?php
            $args = array( 'numberposts' => 3, 'category' => -25420 );
            $lastposts = get_posts( $args );
            foreach($lastposts as $post) : setup_postdata($post); ?>
                
                <!--include/article-shortview-mobile.php-->                 
                <?php include (TEMPLATEPATH . '/includes/article-shortview-mobile.php'); ?> 
            
            <?php endforeach; ?>
        <!--END loop 1 mobile-->
        
        <!--START loop 2-->             
            <?php
            $args = array( 'numberposts' => 17, 'offset'=> 3, 'category' => -25420  );
            $lastposts = get_posts( $args );
            
            foreach($lastposts as $post) : setup_postdata($post); ?>
                
                <!--include/article-shortview.php-->                 
                <?php include (TEMPLATEPATH . '/includes/article-shortview.php'); ?>                     
            
            <?php endforeach; ?>     
        <!--END loop 2-->
        
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
