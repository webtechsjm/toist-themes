<?php get_header(); ?>

    <section id="breaking-news" style="display:none;">
    <?php slidedeck( 63405, array( 'width' => '1000px', 'height' => '150px' ) ); ?>
    </section>

<?php if (get_custom_field('sidebar_off')) {
	echo "<div id=\"content\" class=\"sidebaroff\">";
	}
	else { 
	echo "<div id=\"content\">";
	}
?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <!--Add class to posts imported from Movable Type, to correct spacing. Also in single.php--> 
            <?php if ($post->ID < 69442) { 
                $imported_post = 'imported-post';
            } ?>

            <article <?php post_class($imported_post) ?> id="post-<?php the_ID(); ?>">
                
                <header>
                    <?php edit_post_link('[Edit]','',' '); ?>
                    
                    <?php comments_popup_link('', '1 Comment', '% Comments', 'comments-link', ''); ?>
                    
                    <time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></time>
                                       
                    <h3><?php
                            $categories = get_the_category();
                            foreach($categories as $category){
			 	if ($category->name != "NoIndex") {
                                  $cat_link = get_category_link($category->cat_ID);
                            	  echo '<a href="'.$cat_link.'">'.$category->name.' </a>'; 
				}
                        }?>
                    </h3>
                    
                    <h1><?php the_title(); ?></h1>
                </header>    

                <p class="dek">
                    <?php get_custom_field('dek', TRUE); ?>
                </p>
                
                <p class="byline">By 
                    <?php if(function_exists('coauthors_posts_links'))
                        coauthors_posts_links(', ', ', and ', '', '');
                        else
                        the_author_posts_link();
                    ?>
                    <?php if ($post_image_credit = get_post_meta($post->ID, 'image_credit', true)) {
                    echo ' &bull; ' . $post_image_credit; } ?>                    
                </p>
                    

                <?php the_content(); ?>



                <hr class="invisible">


				<?php   
				if ($numpages > 1) {
				    echo('<nav class="pagination">');
					wp_link_pages(array('before'=>'<span class="previous">', 'after'=>'</span>', 'next_or_number'=>'next', 'previouspagelink' => __('&laquo; Previous'), 'nextpagelink' => ''));

					echo('<span class="page-number">Page <span class="current">'.$page.'</span> of '.$numpages.'</span>');

					wp_link_pages(array('before'=>'<span class="next">', 'after'=>'</span>', 'next_or_number'=>'next', 'previouspagelink' => '', 'nextpagelink' => __('Next &raquo;'))); 
				    echo('</nav>');
				}
				?>			
								
                <footer>
                    <?php if ($post_related_tag = get_post_meta($post->ID, 'featured_tag', true)) { 
			                $showtag = $post_related_tag;
			                $showtag = str_replace("-","&nbsp;&nbsp;<br>",$showtag);
                            echo ('<section class="related" id="tag-related"><div>more&nbsp;&nbsp;<br>from&nbsp;&nbsp;<br>'.$showtag.':&nbsp;&nbsp;</div><ul>');
                            global $post;
                            $myposts = get_posts('numberposts=4&offset=1&tag='.$post_related_tag); 
                            foreach($myposts as $post) : 
                            ?>
                    
                            <li><a href="<?php the_permalink(); ?>" class="image"><?php the_post_thumbnail(); ?></a>
                            <a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></li>
                    
                            <?php endforeach; wp_reset_query(); ?>
                    <?php echo ('</ul></section>'); } ?>
                    
                    <?php // the_ID(); ?>
                
                    <section class="tag-list">
                        <?php 
			  $tags = get_the_tag_list('<p>Filed under: ', ', ', '</p>');
			  $tags = str_replace("\"","",$tags);
			  $pattern = "/\b@(.*?)\,\b/";
			  $replace = "";
			  $string = $tags;
			  $tags = preg_replace($pattern,$replace,$string);
			  echo $tags;
			?>
                    </section>
                    
                    <section class="tools">
<?php
echo do_shortcode('[pinit]');
?>
                        <span class="google-plus">
                        <!-- Start Google +1 -->
                        <g:plusone size="medium"></g:plusone>
                        <script type="text/javascript">
                          (function() {
                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                            po.src = 'https://apis.google.com/js/plusone.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                          })();
                        </script>
                        <!-- End Google +1 -->
                        </span>
                        


                        <!-- Start ShareThis -->                        
                        <script charset="utf-8" type="text/javascript">var switchTo5x=false;</script><script charset="utf-8" type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'wp.0aa23093-2b8c-4fd5-9602-c686dee727c9'});var st_type='wordpress3.2';</script>
                        <span class='st_facebook_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='like'></span>
                        <span class='st_twitter_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span>
                        <span class='st_email_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='email'></span>
                        <!--span class='st_sharethis_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span-->                  
                        <!-- End ShareThis --> 

                        
                        <a href="mailto:tips@torontoist.com?subject=Error&nbsp;in&nbsp;article">Report error</a>
                        
                        <a href="mailto:tips@torontoist.com?subject=Tip">Send a tip</a>               
<!--                    
                        <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                        
                        <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=button_count&amp;show_faces=true&amp;width=90&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe>

-->
                    </section>

                   


                </footer>   
                                
            </article>
            
            <!--comments go here-->    
            <div id="post-comments">
                <h4 id="comments">Comments</h4>
                <?php comments_template(); ?>
            </div>

    
        <?php endwhile; endif; ?>
	</div>

<?php 
  $sidebaroff = get_post_meta($post->ID, 'sidebar_off', true);
  if ($sidebaroff != "true") {
    get_sidebar();
  }
?>
	


<?php get_footer(); ?> 