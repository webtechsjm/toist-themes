<!DOCTYPE html><head id="www-torontoist-com" data-template-set="torontoist_theme20112">
    <title><?php wp_title(''); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<meta name="google-site-verification" content="">
	<meta name="author" content="Torontoist">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="Copyright" content="Copyright Torontoist, Ink Truck Media, St. Joseph Media, 2011. All Rights Reserved.">
<!--
    <meta name="viewport" content="width = 1040" />	
-->
    <meta name="alexa-verification" content="AYUwll_m3QGcxTYTyPIcr3yOB2o"/>
    <meta name="bitly-verification" content="bc50193bf440"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><!--Force latest IE rendering engine & Chrome Frame-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic&v2' rel='stylesheet'>
	<link rel="stylesheet" href="/wp-content/themes/torontoist_theme20112/style.css">
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

<?php

define("JUICEMOBILEV2_MODE", "live");

function juicemobilev2_ad()
{
    $ua = $_SERVER['HTTP_USER_AGENT'];
    $ip = (stristr($ua,"opera mini") && array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
        ? trim(end(split(",", $_SERVER['HTTP_X_FORWARDED_FOR'])))
        : $_SERVER['REMOTE_ADDR'];

    // prepare url parameters of request
    $juicemobilev2_get  = 'site='.urlencode('17511');
    $juicemobilev2_get .= '&ip='.urlencode($ip);
    $juicemobilev2_get .= '&ua='.urlencode($ua);
    $juicemobilev2_get .= '&url='.urlencode(sprintf("http%s://%s%s", (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == TRUE ? "s": ""), $_SERVER["HTTP_HOST"], $_SERVER["REQUEST_URI"]));
    $juicemobilev2_get .= '&zone='.urlencode('53845');
    $juicemobilev2_get .= '&type=-1'; // type of ads (1 - text, 2 - image, 4 - richmedia ad) or a combination like 3 = 1+2 (text + image), 7 = 1+2+4 (text + image + richmedia)
    $juicemobilev2_get .= '&key=1';
    //$juicemobilev2_get .= '&lat=1';
    //$juicemobilev2_get .= '&long=1';
    $juicemobilev2_get .= '&count=1'; // quantity of ads
    $juicemobilev2_get .= '&version='.urlencode('php_0001'); // php code version
    $juicemobilev2_get .= '&keywords='; // keywords to search ad delimited by commas (not necessary)
    $juicemobilev2_get .= '&whitelabel=0'; // filter by whitelabel(0 - all, 1 - only whitelabel, 2 - only non-whitelabel)
    $juicemobilev2_get .= '&premium=0'; // filter by premium status (0 - non-premium, 1 - premium only, 2 - both)
    $juicemobilev2_get .= '&over_18=0'; // filter by ad over 18 content (0 or 1 - deny over 18 content , 2 - only over 18 content, 3 - allow all ads including over 18 content)
    $juicemobilev2_get .= '&paramBORDER='.urlencode('#000000'); // ads border color
    $juicemobilev2_get .= '&paramHEADER='.urlencode('#cccccc'); // header color
    $juicemobilev2_get .= '&paramBG='.urlencode('#eeeeee'); // background color
    $juicemobilev2_get .= '&paramTEXT='.urlencode('#000000'); // text color
    $juicemobilev2_get .= '&paramLINK='.urlencode('#ff0000'); // url color


    //check UID
    if ( isset($_COOKIE['MOCEAN_AD_UDID']) ) {
        if(setcookie('MOCEAN_AD_UDID', $_COOKIE['MOCEAN_AD_UDID'], time() + 60 * 60 * 24 * 7)) {
            $juicemobilev2_get .= '&udid='.urlencode($_COOKIE['MOCEAN_AD_UDID']);
        }
    } else {
        $udid = md5(time()+rand());
        if(setcookie('MOCEAN_AD_UDID', $udid, time() + 60 * 60 * 24 * 7)) {
            $juicemobilev2_get .= '&udid='.urlencode($udid);
        }
    }


    if(JUICEMOBILEV2_MODE == "test") $juicemobilev2_get .= '&test=1';

    // send request
    $juicemobilev2_request = @fsockopen('ads.juicemobile.ca', 80, $errno, $errstr, 1);
    if ($juicemobilev2_request) {
        stream_set_timeout($juicemobilev2_request, 3000);
        $query = "GET /ad?".$juicemobilev2_get." HTTP/1.0\r\n";
        $query .= "Host: ads.juicemobile.ca\r\n";
        $query .= "Connection: close\r\n";


        // IIS support
        if(isset($_SERVER['ALL_HTTP']) && is_array($_SERVER['ALL_HTTP'])) {
            foreach ($_SERVER['ALL_HTTP'] as $name => $value) {
                $query .= "CS_$name: $value\r\n";
            }
        }
        elseif(isset($_SERVER['ALL_HTTP'])) {
            $array = explode("\n",$_SERVER['ALL_HTTP']);
            foreach ($array as $value) {
                if($value) {
                    $query .= "CS_$value\r\n";
                }
            }
        }

        foreach ($_SERVER as $name => $value) {
            $query .= "CS_$name: $value\r\n";
        }

        $query .= "\r\n";
        fwrite($juicemobilev2_request, $query);
        $juicemobilev2_info = stream_get_meta_data($juicemobilev2_request);
        $juicemobilev2_timeout = $juicemobilev2_info['timed_out'];
        $juicemobilev2_contents = "";
        $juicemobilev2_body = false;
        $juicemobilev2_head = "";
        while (!feof($juicemobilev2_request) && !$juicemobilev2_timeout) {
            $juicemobilev2_line = fgets($juicemobilev2_request);
            if(!$juicemobilev2_body && $juicemobilev2_line == "\r\n") $juicemobilev2_body = true;
            if(!$juicemobilev2_body) $juicemobilev2_head .= $juicemobilev2_line;
            if($juicemobilev2_body && !empty($juicemobilev2_line)) $juicemobilev2_contents .= $juicemobilev2_line;
            $juicemobilev2_info = stream_get_meta_data($juicemobilev2_request);
            $juicemobilev2_timeout = $juicemobilev2_info['timed_out'];
        }
        fclose($juicemobilev2_request);
        if (!preg_match('/^HTTP\/1\.\d 200 OK/', $juicemobilev2_head)) $juicemobilev2_timeout = true;
        if($juicemobilev2_timeout) return "";
        return $juicemobilev2_contents;
    }
}

?>
 <!-- bg start-->
<?php 
if(is_page( 'put-name-here' )) { ?>
	<style type="text/css">
	body { background:#e9e8dd;}
	
	#add_left { position: absolute; margin-left:-250px; top:0px; width:235px; height:3000px; z-index:22; display:block; cursor:pointer; background: url(http://media.torontolife.com/img/0torontoist_wp/left.jpg) no-repeat; position:fixed}
	#add_right{ position: absolute; margin-left:995px; top:0px; width:235px; height:3000px; z-index:22; display:block; cursor:pointer; background: url(http://media.torontolife.com/img/0torontoist_wp/right.jpg) no-repeat; position:fixed}

	</style>
    
    <?php } else { ?>
	<style type="text/css">
	body { background-color: transparent;}
	#add_left { visibility:hidden; position: absolute; left: -200%;}
	#add_right{ visibility:hidden; position: absolute; left: -200%;}

	</style>
<?php } ?>
<!-- bg end-->
</head>

<body <?php body_class(); ?>>
<!--Uber container gives the page content a background - div is closed in footer file-->
<div class="uber_container">
<!--[if lte IE 8 ]>
<noscript>Please note: You do not currently have JavaScript enabled. JavaScript is required for this website to be displayed correctly.</noscript>
<![endif]-->
<div id="add_left">
<a href="http://www.moosehead.ca/" target="_blank"><img src="http://media.fashionmagazine.com/ads/add_trans.gif" width="196" height="3000;" border="0" /></a>
</div>
<div id="add_right">
<a href="http://www.moosehead.ca/" target="_blank"><img src="http://media.fashionmagazine.com/ads/add_trans.gif" width="196" height="3000;" border="0" /></a>
</div>
<div class="mobile-ad">
<?php
echo juicemobilev2_ad();
?>
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
		echo "<div class=\"logo\"><h1 style=\"width:540px; height:100px; text-indent:-9999em; background:url('/wp-content/themes/torontoist_theme20112/images/torontoist-logos/primary/rotate.php') 0 0 no-repeat;\"><a href=\"/\">Torontoist</a></h1></div>";
	}
	else {
		echo "<div class=\"logo\"><h1 style=\"width:540px; height:100px; text-indent:-9999em; background:url('/wp-content/themes/torontoist_theme20112/images/torontoist-logos/secondary/rotate.php') 0 0 no-repeat;\"><a href=\"/\">Torontoist</a></h1></div>";
	}
?>

<h1 class="print"><a href="/"><img src="/wp-content/themes/torontoist_theme20112/images/torontoist-logos/small/rotate.php"></a></h1>

                            
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
                    <li style="display:none;"><a href="http://torontoist.com/photos-page/">Photos</a></li>
                    <li style="display:none;"><a href="http://torontoist.com/events-page/">Events</a></li>
                    <li class="info bul">&bull;<a href="http://torontoist.com/rob-fords-conflict-of-interest-case/">Rob Ford's Conflict of Interest</a></li>
                    <li class="info bul">&bull;<a href="http://torontoist.com/about/">About</a></li>
                    <li class="info"><a href="http://torontoist.com/staff/">Staff</a></li>
                    <li class="info"><a href="http://torontoist.com/contact-us/">Contact</a></li>
                    <li class="info2 bul" style="display:none;"><a href="http://www.inktruck.com/">Advertise</a></li>


			    </ul>
			</nav>
		
		</header>
