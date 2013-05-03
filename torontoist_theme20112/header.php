<!DOCTYPE html><head id="www-torontoist-com" data-template-set="torontoist_theme20112">
    <title><?php wp_title(''); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<meta name="google-site-verification" content="">
	<meta name="author" content="Torontoist">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<meta name="Copyright" content="Copyright Torontoist, Ink Truck Media, St. Joseph Media, 2011. All Rights Reserved.">
<!--
    <meta name="viewport" content="width = 1040" />	
-->
    <meta name="alexa-verification" content="AYUwll_m3QGcxTYTyPIcr3yOB2o"/>
    <meta name="bitly-verification" content="bc50193bf440"/>
    <meta name="p:domain_verify" content="6dcc9332a6f2b65cc3ec17524d441db0" > 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><!--Force latest IE rendering engine & Chrome Frame-->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/style.css?ver=20130422">
        <link rel="stylesheet" media="print" href="/wp-content/themes/torontoist_theme20112/print.css"> 
        <!--[if lt IE 9]><link rel="stylesheet" href="/wp-content/themes/torontoist_theme20112/IEstyle.css"><![endif]-->
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/graphics/favicon.ico">
	<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/images/graphics/apple-touch-icon.png">
    <link rel="alternate" type="application/rss+xml" title="Torontoist Main RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!--GENERATE HTML5 ELEMENTS FOR IE, CAN BE REPLACED WITH MODERNIZR IF CSS3 SUPPORT IS NEEDED-->
    <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->  

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<!-- Scriptaculous Sortable List -->
<?php wp_enqueue_script("scriptaculous-dragdrop"); ?>
    
    <!-- Fade in hidden Slidedeck nodes -->

    <!--LIGHTBOX has conflict with wp_head(); cannot remove wp_head(); when slidedeck is running or slidedeck will break
    
    possible solution: http://codex.wordpress.org/Function_Reference/wp_enqueue_script
    
    <link rel="stylesheet" href="/wp-content/themes/torontoist_theme20112/javascript/lightbox/css/lightbox.css" type="text/css" media="screen" />
    <script src="/wp-content/themes/torontoist_theme20112/javascript/lightbox/js/prototype.js" type="text/javascript"></script>
    <script src="/wp-content/themes/torontoist_theme20112/javascript/lightbox/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
    <script src="/wp-content/themes/torontoist_theme20112/javascript/lightbox/js/lightbox.js" type="text/javascript"></script-->  
    <script src="/wp-content/themes/torontoist_theme20112/javascript/sortable.js" type="text/javascript"></script>

<!-- DFP SETUP begin -->
<?php
$section = 'section';
$section = get_the_category();
if(is_array($section) && !empty($section)){
	$section = $section[0]->cat_name;
}else{$section = '';}

$tag = 'tag';
$posttags = get_the_tags();
$count=0;
	//if ($posttags) { foreach($posttags as $tag0) { $count++; if (1 == $count) { $tag = $tag0->name;}}} // display first tag
	//$tag = get_the_tag_list('',' ',''); // display all tags
	$all_the_tags = get_the_tags($post->ID);
	if($all_the_tags)
	{
	foreach($all_the_tags as $this_tag) {
		if ($this_tag->slug == "locally-made") { // display only one custom tag
			$tag = $this_tag->slug;
		}
	}
	}	
$slug = 'slug';
$slug = $post->post_name;
$ishome='no';
	if ( is_home() ) { $ishome = 'yes'; $slug = 'slug'; $tag = 'tag'; $section = 'section';}
$issingle='no';
	if ( is_single() ) { $issingle = 'yes';}
	if ( is_page() ) { $issingle = 'yes'; $section = 'section';}
?>
<script type='text/javascript'>
(function() {
var useSSL = 'https:' == document.location.protocol;
var src = (useSSL ? 'https:' : 'http:') +
'//www.googletagservices.com/tag/js/gpt_mobile.js';
document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
})();
</script>
<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/7740464/St.JoeMedia/Torontoisst', [[300, 50], [320, 50]], 'div-gpt-ad-1365791261208-0').addService(googletag.pubads());
googletag.enableServices();
});
</script>
<script type='text/javascript'>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') +
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})();
</script>
<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.pubads().setTargeting('section-TS', '<?php echo sanitize_title_with_dashes($section); ?>');
googletag.pubads().setTargeting('tag', '<?php echo sanitize_title_with_dashes($tag); ?>');
googletag.pubads().setTargeting('slug', '<?php echo $slug; ?>');
googletag.pubads().setTargeting('ishome', '<?php echo $ishome; ?>');
googletag.pubads().setTargeting('issingle', '<?php echo $issingle; ?>');
googletag.defineSlot('/9527589/TST_BB_Lower', [300, 250], 'div-gpt-ad-1343667556242-2').addService(googletag.pubads());
googletag.defineSlot('/9527589/TST_BB_Upper', [300, 251], 'div-gpt-ad-1347634485931-0').addService(googletag.pubads());
googletag.defineSlot('/9527589/TST_Leaderboard', [728, 90], 'div-gpt-ad-1343667556242-4').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>
<!-- DFP SETUP end -->
<script src="http://mint.torontoist.com/?js" type="text/javascript"></script>
<meta http-equiv="refresh" content="3600">
<!-- Begin comScore Tag -->
<script>
  var _comscore = _comscore || [];
  _comscore.push({ c1: "2", c2: "10161631" });
  (function() {
    var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
    s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
    el.parentNode.insertBefore(s, el);
  })();
</script>
<noscript>
  <img src="http://b.scorecardresearch.com/p?c1=2&c2=10161631&cv=2.0&cj=1" />
</noscript>
<!-- End comScore Tag -->
<!-- Start Quantcast tag -->
<script type="text/javascript" src="http://edge.quantserve.com/quant.js"></script>
<script type="text/javascript">
_qacct="p-11lnUuPOz_qQQ";quantserve();</script>
<noscript>
<img src="http://pixel.quantserve.com/pixel/p-11lnUuPOz_qQQ.gif" style="display: none" height="1" width="1" alt="Quantcast"/></noscript>
<!-- End Quantcast tag -->

	<?php wp_head(); ?>

<!-- Google+ Tag -->

<link href="https://plus.google.com/100174053117586196083/" rel="publisher" />

</head>

<body <?php body_class(); ?>>
<!--Uber container gives the page content a background - div is closed in footer file-->
<div class="uber_container">
<!--[if lte IE 8 ]>
<noscript>Please note: You do not currently have JavaScript enabled. JavaScript is required for this website to be displayed correctly.</noscript>
<![endif]-->

<div class="mobile-ad">
	<div id='div-gpt-ad-1365791261208-0'>
		<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1365791261208-0')});
		</script>
	</div>
</div>

	<div class="ad" id="leaderboard">
	    <div class="ad-container">
		<div id='div-gpt-ad-1343667556242-4' >
		<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1343667556242-4'); });
		</script>
		</div>
		</div>
	</div>
		<header class="global">
			<div class="container"><!--extra container for IE-->
                <div class="weather">
                    <?php echo do_shortcode('[forecast]'); ?>
                </div>
                
<?php
        if (is_front_page()) {
		echo "<div class=\"logo\"><h3 style=\"width:540px; height:100px; text-indent:-9999em; background:url('/wp-content/themes/torontoist_theme20112/images/torontoist-logos/primary/rotate.php') 0 0 no-repeat;\"><a href=\"/\">Torontoist</a></h3></div>";
	}
	else {
		echo "<div class=\"logo\"><h3 style=\"width:540px; height:100px; text-indent:-9999em; background:url('/wp-content/themes/torontoist_theme20112/images/torontoist-logos/secondary/rotate.php') 0 0 no-repeat;\"><a href=\"/\">Torontoist</a></h3></div>";
	}
?>

<h3 class="print"><a href="/"><img src="/wp-content/themes/torontoist_theme20112/images/torontoist-logos/small/rotate.php"></a></h3>

                            
                <div class="tools">
                    <ul class="social-media">
                       <!-- Icons from icondeck.com -->
                        <li><a href="mailto:tips@torontoist.com"><img src="/wp-content/themes/torontoist_theme20112/images/graphics/email.png" alt="Email"></a></li>
                        <li><a href="http://twitter.com/torontoist" target="_new"><img src="/wp-content/themes/torontoist_theme20112/images/graphics/twitter-2.png" alt="Twitter"></a></li>
                        <li><a href="http://www.facebook.com/torontoist" target="_new"><img src="/wp-content/themes/torontoist_theme20112/images/graphics/facebook.png" alt="Facebook"></a></li>
                        <li><a href="http://www.flickr.com/groups/torontoist/" target="_new"><img src="/wp-content/themes/torontoist_theme20112/images/graphics/flickr.png" alt="Flickr"></a></li>
                        <li><a href="/feed/"><img src="/wp-content/themes/torontoist_theme20112/images/graphics/rss.png" alt="RSS"></a></li>
                    </ul>    
                </div>    
			</div>

			<nav>
			    <ul>
                    <li><a href="http://torontoist.com/news-page/">News</a></li>
                    <li><a href="http://torontoist.com/cityscape-page/">Cityscape</a></li>
                    <li><a href="http://torontoist.com/politics-page/">Politics</a></li>
                    <li><a href="http://torontoist.com/culture-page/">Culture</a></li>
                    <li><a href="http://torontoist.com/photos-page/">Photos</a></li>
                    <li><a href="http://torontoist.com/events-page/">Events</a></li>
                    <li class="info bul">&bull;<a href="http://torontoist.com/about/">About</a></li>
                    <li class="info"><a href="http://torontoist.com/staff/">Staff</a></li>
                    <li class="info"><a href="http://torontoist.com/contact-us/">Contact</a></li>
                    <li class="info2 bul" style="display:none;"><a href="http://www.inktruck.com/">Advertise</a></li>


			    </ul> 
			    <?php
/*
	$defaults = array(
		'container'		=>	'span'
	);
	
	wp_nav_menu(array_merge($defaults,array('theme_location'	=>	'General')));
	wp_nav_menu(array_merge($defaults,array('theme_location'	=>	'Breaking')));
	wp_nav_menu(array_merge($defaults,array('theme_location'	=>	'Administrative')));
*/
?>
			</nav>

		
		</header>
<?php if(function_exists('the_newsflash')) the_newsflash(); ?>
