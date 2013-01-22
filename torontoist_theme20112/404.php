<?php get_header(); ?>

	<div id="content">
	
        <h2>404 Error</h2>	
        <p>We're sorry, but the page you requested could not be found. This may be because:</p>
        <ol>
            <li>We are currently restructuring the site and the page may have been moved.</li>
            <li>A search engine listing or bookmark is out of date.</li>
            <li>The address used to find the page may be mis-typed.</li>
        </ol>
        <p>Visit our <a href="/" title="homepage">homepage</a> or try searching below for specific content.</p>
        <p>To let us know about a broken link, <a href="mailto:tips@torontoist.com">email us.</a></p>
    
    
        <form action="<?php bloginfo('siteurl'); ?>" method="get">
            <input type="search" id="s" name="s" value="SEARCH TORONTOIST" onfocus="if(this.value=='SEARCH TORONTOIST')this.value=''" onblur="if(this.value=='')this.value='SEARCH TORONTOIST'" placeholder="SEARCH TORONTOIST" />   
            <input type="image" value="go" name="search" class="go" src="/wp-content/themes/torontoist_theme20112/images/graphics/next-black.png">
        </form>    
        
        
        <section class="latest">
            <h3>Latest:</h3>
           
            <ul>
                <?php
                global $post;
                $myposts = get_posts('numberposts=10');
                foreach($myposts as $post) :
                ?>
                <li>
                    <a href="<?php the_permalink() ?>" class="image">
                        <?php { the_post_thumbnail(); } ?>
                    </a>
                    <a href="<?php the_permalink(); ?>" class="title">
                        <?php { the_title(); } ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>   
        </section>
    
    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>