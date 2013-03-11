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
				wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"), false);
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
    		'before_title'  => '<h5>',
    		'after_title'   => '</h5>'
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
		wp_register_style('webfonts','http://fonts.googleapis.com/css?family=Sanchez:400,400italic|Kameron:400,700');
		wp_enqueue_style('webfonts');
		wp_enqueue_script('toist-functions',get_bloginfo('template_directory').'/_/js/functions.js','jquery');
}

add_filter('coauthors_search_authors_get_terms_args',function($args){
	$args['number'] = 100;
	return $args;
	});


add_action('pre_get_posts',function($query){
	if($query->query['post_type'] == 'event'){
		$query->set('posts_per_page',-1);
		return;
	}
});

function the_event_star_rating(){
if($stars = get_post_meta(get_the_ID(),'stars',true)):
	switch($stars){
		case "0": $stars_filename = "0stars"; break;
		case "0.5":case ".5": $stars_filename = "0.5stars"; break;
		case "1": $stars_filename = "1stars"; break;
		case "1.5": $stars_filename = "1.5stars"; break;
		case "2": $stars_filename = "2stars"; break;
		case "2.5": $stars_filename = "2.5stars"; break;
		case "3": $stars_filename = "3stars"; break;
		case "3.5": $stars_filename = "3.5stars"; break;
		case "4": $stars_filename = "4stars"; break;
		case "4.5": $stars_filename = "4.5stars"; break;
		case "5": $stars_filename = "5stars"; break;
		default: $stars_filename = false; break;
	}
	if($stars_filename){
		printf(
			'<li><img src="%s/images/graphics/%s.jpg" title="%s" /></li>',
			get_stylesheet_directory_uri(),
			$stars_filename,
			$stars_filename
			);
	}
endif;
}

/*
*		Turns mechanical hours, minutes and ante-/post-meridien in to a beautiful string
*/

function time_compact_ap_format($hours,$minutes,$meridien){
	$patterns = array("am","pm","AM","PM");
	$replacements = array("a.m.","p.m.","A.M.","P.M.");
	
	$meridien = str_replace($patterns,$replacements,$meridien);
	
	if($minutes == "00") return sprintf("%s %s",$hours,$meridien);
	else return sprintf("%s:%s %s",$hours,$minutes,$meridien);
}

/*
*		Give it start and end DateTimes and it will give you strings and diffs!
*/

function the_date_range($start_dt,$end_dt, $one_day = false){
	
	$duration = $start_dt->diff($end_dt);
	$start = explode(" ",$start_dt->format('l F j Y g i a'));
	$end = explode(" ",$end_dt->format('l F j Y g i a'));
	
	//happening at the same time
	if($start == $end){
		return array(
			"date"	=>	sprintf(
				"%s, %s %s",
				$start[0], //day of week
				$start[1], //month
				$start[2] //day of month
				),
			"duration"	=>	$duration,
			"time"	=>	eo_is_all_day() ? 'all day' : time_compact_ap_format($start[4],$start[5],$start[6])
		);
	}	
	//happening on the same day
	elseif($start[2] == $end[2] || ($duration->days < 1 && $duration->h < 24)){
		//Monday, March 4; 9:00 p.m.
		return array(
			"date"	=>	sprintf(
				"%s, %s %s",
				$start[0], //day of week
				$start[1], //month
				$start[2] //day of month
				),
			"duration"	=>	$duration,
			"time"	=>	eo_is_all_day() ? 'all day' : sprintf(
				"%s&ndash;%s",
				time_compact_ap_format($start[4],$start[5],$start[6]),
				time_compact_ap_format($end[4],$end[5],$end[6])	 //formatted date
				)
			);
	}
	//happening in the same month
	//check if happening all day; if not, return eo_all_day ? : 
	elseif($start[1] == $end[1]){
		return (eo_is_all_day() || $one_day) ? 
		sprintf(
			"%s %s&ndash;%s",
			$start[1], //month
			$start[2], //day of month
			$end[2]
		)
		: 
		array(
			"date" => sprintf(
				"%s %s&ndash;%s",
				$start[1],
				$start[2],
				$end[2]					
				),
			"datetime" => sprintf(
				"%s, %s %s&ndash;%s, %s %s",
				time_compact_ap_format($start[4],$start[5],$start[6]),
				$start[1],
				$start[2],
				time_compact_ap_format($end[4],$end[5],$end[6]),
				$end[1],
				$end[2]					
				),
			"duration"	=>	$duration,
			"time"	=>	sprintf(
				"%s&ndash;%s",
				time_compact_ap_format($start[4],$start[5],$start[6]),
				time_compact_ap_format($end[4],$end[5],$end[6])
			)
		);
	}
	//happening in the same year
	elseif($start[3] == $end[3]){
		return (eo_is_all_day() || $one_day) ?
			sprintf(
				"%s, %s %s&ndash;%s, %s %s",
				$start[0], //day of week
				$start[1], //month
				$start[2], //day of month
				$end[0],
				$end[1],
				$end[2]
			)
			:
			array(
				"date"	=>	sprintf(
					"%s %s&ndash;%s %s",
					$start[1],
					$start[2],
					$end[1],
					$end[2]
				),
				"datetime"	=>	sprintf(
					"%s, %s, %s %s&ndash;%s, %s, %s %s",
					time_compact_ap_format($start[4],$start[5],$start[6]),
					$start[0],
					$start[1],
					$start[2],
					time_compact_ap_format($end[4],$end[5],$end[6]),
					$end[0],
					$end[1],
					$end[2]
				),
				"duration"	=>	$duration,
				"time"	=>	sprintf("%s&ndash;%s",
					time_compact_ap_format($start[4],$start[5],$start[6]),
					time_compact_ap_format($end[4],$end[5],$end[6])
				)
			);
	}
	//just plain happening

	else{
		return (eo_is_all_day() || $one_day) ? 
			sprintf(
				"%s, %s %s&ndash;%s, %s %s",
				$start[0], //day of week
				$start[1], //month
				$start[2], //day of month
				$end[0],
				$end[1],
				$end[2]
			)
			:
			array(
				"date"	=>	sprintf(
					"%s, %s %s&ndash;%s, %s %s",
					$start[0],
					$start[1],
					$start[2],
					$end[0],
					$end[1],
					$end[2]
				),
				"datetime"	=>	sprintf(
					"%s, %s, %s %s&ndash;%s, %s, %s %s",
					time_compact_ap_format($start[4],$start[5],$start[6]),
					$start[0],
					$start[1],
					$start[2],
					time_compact_ap_format($end[4],$end[5],$end[6]),
					$end[0],
					$end[1],
					$end[2]
				),
				"duration"	=>	$duration,
				"time"	=>	sprintf("%s&ndash;%s",
					time_compact_ap_format($start[4],$start[5],$start[6]),
					time_compact_ap_format($end[4],$end[5],$end[6])
				)
			);
	}
}
?>
