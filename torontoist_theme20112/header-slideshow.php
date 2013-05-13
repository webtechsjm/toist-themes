<!DOCTYPE html>
<html>
	<head id="www-torontoist-com" data-template-set="torontoist_theme20112">

	<title><?php wp_title(' | '); ?><?php bloginfo('name'); ?></title>
   
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="google-site-verification" content="">
	<meta name="author" content="Torontoist">
	<meta name="Copyright" content="Copyright Torontoist, Ink Truck Media, 2011. All Rights Reserved.">
  
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><!--Force latest IE rendering engine & Chrome Frame-->
       
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic&v2' rel='stylesheet'>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/style.css">
	    <!--[if lt IE 9]><link rel="stylesheet" href="/wp-content/themes/torontoist_theme20112/IEstyle.css"><![endif]-->
	
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/graphics/favicon.ico">
	<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon.png">
    <link rel="alternate" type="application/rss+xml" title="Torontoist Main RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<!--GENERATE HTML5 ELEMENTS FOR IE, CAN BE REPLACED WITH MODERNIZR IF CSS3 SUPPORT IS NEEDED-->
    <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->  
                
    <style type="text/css">
    html {overflow-y:scroll;}
    html, body {height:100%; margin:0 auto 1px auto; padding:0;}
    </style>

	<?php //javascript in here prevents lightbox from working, not a good permanent solution to comment this out: wp_head(); ?> 

<!-- DFP SETUP begin -->
<?php
$section = 'section';
$section = get_the_category();
$section = $section[0]->cat_name;
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

<?php /*
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
*/ ?>
<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.pubads().setTargeting('section-TS', '<?php echo sanitize_title_with_dashes($section); ?>');
googletag.pubads().setTargeting('tag', '<?php echo sanitize_title_with_dashes($tag); ?>');
googletag.pubads().setTargeting('slug', '<?php echo $slug; ?>');
googletag.pubads().setTargeting('ishome', '<?php echo $ishome; ?>');
googletag.pubads().setTargeting('issingle', '<?php echo $issingle; ?>');
googletag.defineSlot('/9527589/TST_BB_Upper', [300, 251], 'div-gpt-ad-1347634485931-0').addService(googletag.pubads());
googletag.defineSlot('/9527589/TST_Leaderboard', [728, 90], 'div-gpt-ad-1343667556242-4').addService(googletag.pubads());
googletag.defineSlot('/7740464/St.JoeMedia/Torontoisst', [[300, 50], [320, 50]], 'div-gpt-ad-1365791261208-0').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.pubads().enableAsyncRendering();
googletag.enableServices();
});
</script>
<!-- DFP SETUP end -->

	
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

	<script type="text/javascript">//<![CDATA[
	// Google Analytics for WordPress by Yoast v4.1.3 | http://yoast.com/wordpress/google-analytics/
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount','UA-300475-32']);
	_gaq.push(['_setDomainName','.torontoist.com'],['_setCustomVar',1,'author','torontoist',3],['_setCustomVar',3,'year','2011',3],['_trackPageview'],['_trackPageLoadTime']);
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	//]]></script>

<?php include (TEMPLATEPATH . '/includes/juice-mobile.php' ); ?>

</head>

<body class="slideshow">
	<header>
		<div class="container">
			<h1 class="site-title">
				<a href="<?php echo site_url() ?>">Torontoist</a>
			</h1>
			<div class="mobile-ad">
				<h6>Advertisement</h6>
				<div id='div-gpt-ad-1365791261208-0'>
					<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1365791261208-0')});
					</script>
				</div>
			</div>
			<div class="ad" id="leaderboard">
				<img src="<?php bloginfo('stylesheet_directory') ?>/images/graphics/ad-notice.gif" alt="Advertisement" />
				<div class="ad-container">
					<div id='div-gpt-ad-1343667556242-4' >
						<script type='text/javascript'>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1343667556242-4'); });
						</script>
					</div>
				</div>
			</div>
			<?php $menu = wp_nav_menu(array(
				'container'		=>	'nav'
			));
			?>
		</div>
	</header>
