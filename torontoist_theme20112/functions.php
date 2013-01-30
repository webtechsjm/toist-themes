<?php
	

function myFilter($query) {
	if ($query->is_feed) {
		$query->set('cat','-25420');
	}

return $query;
}


function insert_image_src_rel_in_head() {
	global $post;
	if ( !is_singular()) //if it is not a post or a page
		return;
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		$default_image="http://torontoist.com/wp-content/themes/torontoist_theme20112/images/torontoist-logos/secondary/rotate.php"; 		echo '<meta property="og:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	echo "\n";
}
add_action( 'wp_head', 'insert_image_src_rel_in_head', 5 );



add_filter('pre_get_posts','myFilter');

	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery
	if ( !function_exists(core_mods) ) {
		function core_mods() {
			if ( !is_admin() ) {
				wp_deregister_script('jquery');
				wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"), false);
				wp_enqueue_script('jquery');
			}
		}
		core_mods();
	}

	// Clean up the <head>
	function removeHeadLinks() {
		
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    
    
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }
    
    add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video')); // Add 3.1 post format theme support.


    add_filter('the_excerpt_rss', 'insertThumbnailRSS');
//    add_filter('the_content_feed', 'insertThumbnailRSS');
    add_filter('the_excerpt_rss', 'insertDekRSS');
    add_filter('the_content_feed', 'insertDekRSS');

    
    // Enable post thumbnails
    if ( function_exists( 'add_theme_support' ) ) { 
        add_theme_support( 'post-thumbnails' ); 
        set_post_thumbnail_size( 100, 100, TRUE );
        add_image_size( 'large_thumb', 150, 150, TRUE );        
        add_image_size( 'medium', 200, 150, TRUE ); 
    }
    
    // Add thumbnails to RSS Feed
    function insertThumbnailRSS($content) {
        global $post;
        if ( has_post_thumbnail( $post->ID ) ){
            $content =  get_the_post_thumbnail( $post->ID, 'thumbnail' ).'<p class="rss_dek">'.$content.'</p>';
        }
        return $content;
    }

    // Add thumbnails to RSS Feed
    function insertDekRSS($content) {
        global $post;
        if ( get_post_meta( $post->ID, 'dek', true ) ){
            $content =  get_post_meta( $post->ID, 'dek', true ).'<p class="rss_dek">'.$content.'</p>';
        }
        return $content;
    }

    // Adds next page button to post tools in wysiwyg/visual editor
    add_filter('mce_buttons','wysiwyg_editor');
    function wysiwyg_editor($mce_buttons) {
        $pos = array_search('wp_more',$mce_buttons,true);
        if ($pos !== false) {
            $tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
            $tmp_buttons[] = 'wp_page';
            $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
        }
        return $mce_buttons;
    }

    // Simplify use of custom fields
    function get_custom_field($key, $echo = FALSE) {
        global $post;
        $custom_field = get_post_meta($post->ID, $key, true);
        if ($echo == FALSE) return $custom_field;
        echo $custom_field;
    }

/* Replaces thumbnail navigation for image.php template file. Used to be added in the form of a plugin (running on other SJM sites) but plugin no longer appears to exist */

add_action( 'init', 'mf_text_based_image_links' );
	
function mf_text_based_image_links() {

	if ( function_exists( 'mf_previous_image_link' ) === false ) {
		function mf_previous_image_link( $options = false ) {
			if ( $l = mf_adjacent_image_link( $options, true ) )
				print $l;
		}
	}
	
	if ( function_exists( 'mf_next_image_link' ) === false ) {
		function mf_next_image_link( $options = false ) {
			if ( $l = mf_adjacent_image_link( $options, false ) )
				print $l;
		}
	}
	
	if ( function_exists( 'mf_adjacent_image_link' ) === false ) {
		function mf_adjacent_image_link( $options = false, $prev = true ) {
			global $post;
			$post = get_post( $post );
			$query = array(
				'post_parent' => $post->post_parent,
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image', 
				'order' => 'ASC',
				'orderby' => 'menu_order ID'
				);
				
			$attachments = array_values( get_children( $query ) );
			
			/* Forget what this does - but it is necessary :) */
			foreach ( $attachments as $k => $attachment )
				if ( $attachment->ID == $post->ID )
					break;
			
			/* Increment or decrement the array key */
			$k = $prev ? $k - 1 : $k + 1;
			
			/* Parse User Supplied Options */
			if( $options ) {
				if( is_string( $options ) ) { // For versions 1.1 and under
					$link_text = apply_filters( 'the_title', $options );
				}
				elseif( is_array( $options ) ) { // For versions 1.2 and above
					$link_text = ( isset( $options['link_text'] ) && !empty( $options['link_text'] ) )	
						? apply_filters( 'the_title', $options['link_text'] )
						: apply_filters( 'the_title', $attachments[ $k ]->post_title );
					$class_val = ( isset( $options['class'] ) )
						? attribute_escape( trim( $options['class'] ) ) : '';
					$title = ( isset( $options['title'] ) && !empty( $options['title'] ) && $options['title'] !== 'false' )
						? ' title="' . attribute_escape( trim( $options['title'] ) ) . '"'
						: false;
					$id = ( isset( $options['id'] ) )
						? ' id="' . attribute_escape( trim( $options['id'] ) ) . '"' : '';
				}
			}
			/* Define Default Options */
			else {
				$link_text = apply_filters( 'the_title', $attachments[ $k ]->post_title );
				$title = ' title="' . attribute_escape( apply_filters( 'the_title', $attachments[ $k ]->post_title ) ) . '"';
				$class_val = '';
			}
			
			$class_val .= ( !isset( $attachments[ $k ] ) ) ? ' inactive' : '';
			$class = ( !empty( $class_val ) ) ? ' class="' . $class_val . '"' : '';
			$id = ( !empty( $id ) ) ? $id : '';
			$title = ( !empty( $title ) ) ? $title : '';
				
			
			/* Return XHTML */
			if ( isset( $attachments[ $k ] ) )
					return '<a href="' . get_attachment_link( $attachments[$k]->ID ) . '"' . $id . $class . $title . '>' . $link_text . '</a>';
				else
					return false;
		}
	}
}
function TOist_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     	
		<?php comment_text() ?>
	
      <cite>
         <?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>
      <?php if ($comment->comment_approved == '0') : ?>
         <p><em><?php _e('Your comment is awaiting moderation.') ?></em></p>
      <?php endif; ?>
		<?php printf(__('<strong>%1$s at %2$s</strong>'), get_comment_date(),  get_comment_time()) ?><?php edit_comment_link(__('(Edit)'),'  ','') ?>
		<?php printf(__(' | by %s'), get_comment_author_link()) ?></cite>

         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
}


add_action('wp_enqueue_scripts','toist_add_styles');

function toist_add_styles(){
		wp_register_style('webfont-sanchez','http://fonts.googleapis.com/css?family=Sanchez:400,400italic');
		wp_enqueue_style('webfont-sanchez');
}

add_filter('coauthors_search_authors_get_terms_args',function($args){
	$args['number'] = 1000;
	return $args;
	});

?>
