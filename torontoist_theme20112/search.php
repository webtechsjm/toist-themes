<?php get_header(); ?>

    <div id="content">	
        <?php if (have_posts()) : ?>
    
            <h2 class="page-title">Search results for '<?php the_search_query() ?>'</h2>
    
            <?php while (have_posts()) : the_post(); ?>
    
                <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    <header>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </header>
                    
                    <?php the_excerpt(); ?> 
                
                    <footer>
                        <span class="byline">By
                        <?php if(function_exists('coauthors_posts_links'))
                            coauthors_posts_links(', ', ', and ', '', '');
                            else
                            the_author_posts_link();
                        ?>
                        <?php if ($post_image_credit = get_post_meta($post->ID, 'image_credit', true)) {
                        echo ' &bull; ' . $post_image_credit; } ?>                        
                        </span> 
                        <time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></time>
<!--
                        <?php comments_popup_link('', '1 Comment', '% Comments', 'comments-link', ''); ?>
-->
                    </footer>
                        
                </article>
    
            <?php endwhile; ?>
    
            <?php include (TEMPLATEPATH . '/includes/post-nav.php' ); ?>
    
        <?php else : ?>
    
            <h2>No posts found.</h2>
    
        <?php endif; ?>
    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
