jQuery(document).ready(function($){
	var $list = $(".container footer nav a");
	var $prev = $("article.photo a.previous");
	var $next = $("article.photo a.next");
	var $desc	= $("#slide-info");
	var $slideshow = $("#slideshow");
	var $slides = $slideshow.children("a");
	var $slideIndex = $(".slide-count .index");
	var $window	= $(window);
	var $header = $("body>header");
	var $aside = $("article.photo aside");
	var $thumbnails = $("#thumbnails");
	var $socialMedia = $("#social-media");
	var $footer = $("body>footer");
	var $photo = $("article.photo section");
	var $index = $list.index($(".container footer a.active"));
	var $sidebarAd = $("#sidebar_ad");
	var $mobileAd = $(".mobile-ad");
	var animation_speed = 400;
	var frameHeight = false;
	var frameWidth = false;
	var windowWidth = false;
	var windowHeight = false;
	var thumbnailWidth = 100;
	var boxOffset = 20;
	
	$(".container article nav a").on("click",function(ev){
		var pid = $(this).attr("data-photoid");
		ev.preventDefault();
		ev.stopPropagation();
		image_replacer(pid);
	});
	
	$slideshow.on("click","a",function(ev){
		ev.preventDefault();
		ev.stopPropagation();
		var orig = $(ev.target);
		if(orig.hasClass("expandable")){
			var img = orig.clone();
			var box = $('<div id="embiggened"></div>').append(img);
			$("body").append('<div id="overlay"></div>').append(box);
		
			var offset = orig.offset();
			var boxLeft = offset.left - 10;
			var boxTop = offset.top - 10;
			var startWidth = orig.innerWidth();
			var startHeight = orig.innerHeight();
			var maxHeight = img.naturalHeight();
			var maxWidth = img.naturalWidth();
			var target = {top:"",left:"",height:"",width:""};
			
			if(maxHeight < (windowHeight - boxOffset) && maxWidth < (windowWidth - boxOffset)){
				target.width = maxWidth;
				target.height = maxHeight;
			}else{
				var scale = maxHeight / (windowHeight - boxOffset);
				scale = (scale < (maxWidth/(windowWidth - boxOffset))) ? (maxWidth/(windowWidth - boxOffset)) : scale;
				
				target.width = maxWidth/scale - boxOffset;
				target.height = maxHeight/scale - boxOffset;
			}
			target.top = (windowHeight - target.height) / 2;
			target.left = (windowWidth - target.width) / 2;
			box.css({left:boxLeft, top:boxTop, height:startHeight, width:startWidth});
			box.animate(target);
		}
	});
	
	$slideshow.on("mouseenter","img.expandable",function(){$("#expand_msg").show();});
	$slideshow.on("mouseleave","img.expandable",function(){$("#expand_msg").hide();});
	
	$("body").on("click","#overlay",function(){closeEmbiggened()});
	$("body").on("click","#embiggened",function(){closeEmbiggened()});
	$window.on("keyup",function(ev){
		switch(ev.keyCode){
			case 27: if($("#overlay").length > 0) closeEmbiggened(); break;
			case 39:
				var pid = $slideshow.children(".next").attr("data-photoid");
				if(pid) image_replacer(pid);
				break;
			case 37:
				var pid = $slideshow.children(".prev").attr("data-photoid");
				if(pid) image_replacer(pid);
				break;
			case 32:
				if($("#overlay").length == 0) $slideshow.find("a.main img").click();
				break;
		}
	});
	
	window.addEventListener('orientationchange',function(){setSensitivity()},false);
	
	function closeEmbiggened(){
		$("#overlay").remove();
		$("#embiggened").remove();
	}
	
	setup();
	
	function setup(){
		setLimits();
		$window.on("resize",function(){setLimits();});
		$slideshow.addClass("rich");	
			
		$slideshow.prepend(getPrev());
		$slideshow.append(getNext());
		
		var main = $slideshow.children("a.main");
		var pid = main.attr("data-photoid");
		var photo = toist_gallery[pid];
		var file = largest_available(pid);
		main.html('<img src="'+file+'" title="'+photo.caption+'" />');
		if(!$("html").hasClass("touch")){
			preload();
		}
		
		$desc.mCustomScrollbar({
			horizontalScroll:false,
			scrollInertia:950,
			mouseWheel:true,
			mouseWheelPixels:"auto",
			autoDraggerLength:true,
			autoHideScrollbar:true,
			advanced:{
				updateOnBrowserResize:true,
				updateOnContentResize:true,
				autoExpandHorizontalScroll:false,
				autoScrollOnFocus:false,
				normalizeMouseWheelDelta:false
			},
			contentTouchScroll:true,
			theme:"light"
		});
	
		$thumbnails.mCustomScrollbar({
			horizontalScroll:true,
			scrollInertia:950,
			mouseWheel:true,
			mouseWheelPixels:"auto",
			autoDraggerLength:true,
			autoHideScrollbar:false,
			advanced:{
				updateOnBrowserResize:true,
				autoExpandHorizontalScroll:true,
				autoScrollOnFocus:true,
				normalizeMouseWheelDelta:false
			},
			contentTouchScroll:true
		});
		
		$thumbnails.on("click","a",function(ev){
			ev.preventDefault();
			ev.stopPropagation();
			image_replacer($(this).attr("data-photoid"));
		});
		
		if($desc.find(".mCSB_container").length == 1){
			$desc = $desc.find(".mCSB_container");
		}
		scrollToActive();
		setSensitivity();
	}
	
	function checkExpandable(){
		$("#slideshow img").not(".expandable").each(function(){
			var $this = $(this);
			if(($this.naturalWidth() > frameWidth || $this.naturalHeight() > frameHeight) && (windowWidth - frameWidth > 20 || windowHeight - frameHeight > 20)){
				$this.addClass("expandable");
			}
		})
	}
		
	$slideshow.on('swipeleft',function(e){
		var pid = $slideshow.children(".next").attr("data-photoid");
		if(pid) image_replacer(pid);
	});
	$slideshow.on('swiperight',function(e){
		var pid = $slideshow.children(".prev").attr("data-photoid");
		if(pid) image_replacer(pid);
	});
	$slideshow.on('movestart',function(e){
		if ((e.distX > e.distY && e.distX < -e.distY) ||
      (e.distX < e.distY && e.distX > -e.distY)) {
    	e.preventDefault();
  	}
	});
	
	function scrollToActive(){
		var rowWidth = $thumbnails.innerWidth();
		var activePosition = $thumbnails.find(".thumbnail.active").position();
		var rowPosition = $thumbnails.find(".mCSB_container").position();
		if(
			activePosition.left + thumbnailWidth + rowPosition.left > rowWidth 
			|| activePosition.left + rowPosition.left < 0
		){
			$thumbnails.mCustomScrollbar("scrollTo",activePosition.left);
		}
	}
	
	function setSensitivity(){
		if(typeof orientation === 'undefined') return false;
		if(orientation === 0 || orientation === 180){
			$.event.special.swipe.settings.threshold=0.1;
		}else if(frameWidth > 600){
			$.event.special.swipe.settings.threshold=0.2;
		}else{
			$.event.special.swipe.settings.threshold=0.3;
		}
		$.event.special.swipe.settings.sensitivity=8;
	}
	
	
	function getPrev(){
		if($index-1 >= 0){
			var id = $list.eq($index-1).attr("data-photoid");
			var photo = toist_gallery[id];
			
			var file = largest_available(id);
			
			return $('<a class="prev" data-photoid="'+id+'" href="'+file+'" title="'+photo.caption+'"><img src="'+file+'"></a>');
		}else{
			return $('<a class="prev empty"></a>');
		}
	}
	
	function getNext(){
		if($index+1 < $list.length){
			var id = $list.eq($index+1).attr("data-photoid");
			var photo = toist_gallery[$list.eq($index+1).attr("data-photoid")];
			var file = largest_available(id);
			
			return $('<a class="next" data-photoid="'+id+'" href="'+file+'" title="'+photo.caption+'"><img src="'+file+'"></a>');
		}else{
			return $('<a class="next empty"></a>');
		}
	}
	
	function image_replacer(pid){
		var $main = $slideshow.children("a.main");
		var $nextSlide = $slideshow.children("a.next");
		var $prevSlide = $slideshow.children("a.prev");
		var obj = $("footer a[data-photoid="+pid+"]");
		var old = $index;
		$index = $list.index(obj);
				
		//check whether this is the main image
		if(pid != $main.attr("data-photoid")){
			$("footer a.active").removeClass("active");
			obj.addClass("active");
		
			if(pid == $prevSlide.attr("data-photoid")){
				slide("prev");
			}else if(pid == $nextSlide.attr("data-photoid")){
				slide("next");
			}else{
				var photo = toist_gallery[pid];
				var file = largest_available(pid);
				
				if(old < $index){
					$nextSlide.replaceWith('<a href="'+file+'" title="'+photo.caption+'"><img src="'+file+'"></a>');
					slide("next");
				}else{
					$prevSlide.replaceWith('<a href="'+file+'" title="'+photo.caption+'"><img src="'+file+'"></a>');
					slide("prev");
				}
				
			}
		}else{return false;}
		
		$("article.photo a.button.hide").removeClass("hide");
		
		if($index == 0){
			$prev.addClass("hide");
		}else if($index == $list.length - 1){
			$next.addClass("hide");
		}
		
		if($index-1 >= 0){
			var prev = $list.eq($index-1).attr("data-photoid");
			//var file = largest_available(prev);
			$prev.attr("href",largest_available(prev));
			$prev.attr("data-photoid",prev);
		}
		if($index+1 < $list.length){
			var next = $list.eq($index+1).attr("data-photoid");
			$next.attr("href",largest_available(next));
			$next.attr("data-photoid",next);
		}
		
		$desc.html(toist_gallery[pid].description);
		if(_gaq){
			_gaq.push['_trackEvent','galleryImg',toist_gallery[pid].title];
			_gaq.push['_trackPageview',toist_gallery[pid].permalink];
			}
		$slideIndex.html($index+1);
		googletag.pubads().refresh();
		scrollToActive();
		checkExpandable();
		changeSharelinks(pid);
	}
	
	function slide(direction){
			var main = $slideshow.children("."+direction).removeClass(direction).addClass("main");
			
		if(direction == "next"){
			
			$slideshow.children(":first").animate(
				{width:"0px"},
				animation_speed,
				function(){
					$(this).remove();
					$slideshow.children(":first").removeClass("main").addClass("prev");
					$slideshow.append(getNext());
				});
		}else if(direction == "prev"){
			var newPrev = getPrev();
			newPrev.css({width:"0"});
			$slideshow.prepend(newPrev);
			newPrev.animate(
				{width:"33.333%"},
				animation_speed,
				function(){	
					$slideshow.children(":last").remove();
					$slideshow.children(":last").removeClass("main").addClass("next");
					}
				)
			}
	}
	
	function preload(arr){
		$.each(toist_gallery,function(i){
			$("<img />").attr("src",largest_available(i)).appendTo("body").css("display","none");
		});
	}
	
	function largest_available(pid){
		var fitWidth = fitHeight = 100000;
		var fitFile = false;
		
		for (var key in toist_gallery[pid].sizes){
			var obj = toist_gallery[pid].sizes[key];
			if((obj.height < fitHeight && obj.height > frameHeight) || (obj.width < fitWidth && obj.width > frameWidth)){
				fitWidth = obj.width;
				fitHeight = obj.height;
				fitFile = obj.file
			}
		}
		
		if(!fitFile) return toist_gallery[pid].full;
		else return toist_gallery[pid].path + fitFile;
	}
	
	function changeSharelinks(pid){
		var box = $thumbnails.find("a[data-photoid="+pid+"]");
		var url = box.attr("href");
		var title = "Torontoist: "+box.attr("title")
		$socialMedia.children("span").each(function(index){
			$(this).attr("st_url",url).attr("st_title",title);
		});
	}
	
	function setLimits(){

		var slideInfo = $("#slide-info");
		
		var backOffset = $("p.back:first").offset();
		$("#sidebar .slide-count").css({top:backOffset.top});
			
		windowHeight = $window.outerHeight();
		windowWidth = $window.outerWidth();
		var headerHeight = $header.outerHeight();
		var asideHeight = $aside.outerHeight();
		var thumbnailsHeight = $thumbnails.outerHeight(true);
		var footerHeight = $footer.outerHeight();
		var thumbnailWidth = $thumbnails.find("img:first").outerWidth();
		
		frameWidth = $photo.innerWidth();
		
		if(windowWidth > 768){
			frameHeight = windowHeight - headerHeight-asideHeight-thumbnailsHeight-footerHeight-17;
			$photo.outerHeight(frameHeight);
		
			var boxAdHeight = $sidebarAd.outerHeight(true);
			var mobileAdHeight = $mobileAd.outerHeight(true);
			var socialHeight = $socialMedia.outerHeight(true);
			var sidebarNavHeight = $("#sidebar .back").outerHeight(true);
			var countHeight = $("#sidebar .slide-count").outerHeight(true);
			var sidebarPad = $("#sidebar").outerHeight(true) - $("#sidebar").innerHeight();
			var slideInfoPad = slideInfo.outerHeight(true) - slideInfo.innerHeight();
		
			if(typeof adOffset === 'undefined'){
				if($sidebarAd.filter(":visible").length > 0){
					var adOffset = $sidebarAd.offset();
				}else if(
					$mobileAd.filter(":visible").length > 0 
					&& $mobileAd.css("position") === "absolute"){
						var adOffset = $mobileAd.offset();
				}else{
					var adOffset = {top:0,left:0};
				}
			}
		
			var infoOffset = slideInfo.offset();
			if(windowWidth / windowHeight > 1){
				if(windowHeight <= 768){
					sidebarNavHeight = 0;
					slideInfo.css({"margin-top":0});
					boxAdHeight = 0;
					
					if(windowWidth > 768){
						var slideInfoHeight = windowHeight - headerHeight - footerHeight - mobileAdHeight - socialHeight - countHeight - sidebarPad - slideInfoPad -20;
					}else{
						var slideInfoHeight = windowHeight - headerHeight - footerHeight - boxAdHeight - socialHeight - sidebarNavHeight - countHeight - sidebarPad - slideInfoPad -20;
					}
				
				}else{
					var h1Ht = $aside.children("h1").outerHeight();
					slideInfo.css({"margin-top":h1Ht+10});
					infoOffset.top += h1Ht;
					var slideInfoHeight = windowHeight - headerHeight - footerHeight - boxAdHeight - socialHeight - sidebarNavHeight - countHeight - sidebarPad - slideInfoPad-20;
				}
				
			}else{
				var slideInfoHeight = windowHeight - headerHeight - footerHeight - boxAdHeight - socialHeight - countHeight - sidebarPad - slideInfoPad - 30;
			}
						
			if(adOffset.top > 0 && infoOffset.top + slideInfoHeight + socialHeight + sidebarNavHeight > adOffset.top){
				slideInfoHeight -= slideInfoHeight + infoOffset.top + socialHeight + sidebarNavHeight - adOffset.top + 20;
			}
			
			slideInfo.css({"max-height":slideInfoHeight});
			$("html").css({"overflow":"hidden"});
		}else{
			if($("html").css("overflow") == 'hidden'){
				$("html").css({"overflow":"auto"});
			}
			frameWidth = windowWidth;
			frameHeight = windowHeight;
		}
		checkExpandable();
	}
});

/*! A fix for the iOS orientationchange zoom bug. Script by @scottjehl, rebound by @wilto.MIT License.*/(function(m){if(!(/iPhone|iPad|iPod/.test(navigator.platform)&&navigator.userAgent.indexOf("AppleWebKit")>-1)){return}var l=m.document;if(!l.querySelector){return}var n=l.querySelector("meta[name=viewport]"),a=n&&n.getAttribute("content"),k=a+",maximum-scale=1",d=a+",maximum-scale=10",g=true,j,i,h,c;if(!n){return}function f(){n.setAttribute("content",d);g=true}function b(){n.setAttribute("content",k);g=false}function e(o){c=o.accelerationIncludingGravity;j=Math.abs(c.x);i=Math.abs(c.y);h=Math.abs(c.z);if(!m.orientation&&(j>5||((h>4&&i<6||h<6&&i>4)&&j>3))){if(g){b()}}else{if(!g){f()}}}m.addEventListener("orientationchange",f,false);m.addEventListener("devicemotion",e,false)})(this);

/*
adds .naturalWidth() and .naturalHeight() methods to jQuery for retreaving a normalized naturalWidth and naturalHeight.
http://www.jacklmoore.com/notes/naturalwidth-and-naturalheight-in-ie/
*/

(function($){
  var
  props = ['Width', 'Height'],
  prop;

  while (prop = props.pop()) {
  (function (natural, prop) {
    $.fn[natural] = (natural in new Image()) ? 
    function () {
    return this[0][natural];
    } : 
    function () {
    var 
    node = this[0],
    img,
    value;

    if (node.tagName.toLowerCase() === 'img') {
      img = new Image();
      img.src = node.src,
      value = img[prop];
    }
    return value;
    };
  }('natural' + prop, prop.toLowerCase()));
  }
}(jQuery));

jQuery(document).ready(function($){
	if(('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch){
		$("html").addClass("touch");
		$("#swipe_msg").delay(4000).fadeOut(500);
	}else{
		$("html").addClass("no-touch");
	}
});
