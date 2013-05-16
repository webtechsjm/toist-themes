jQuery(document).ready(function($){
	if(('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch){
		$("html").addClass("touch");
	}
	
	if($("body.blog.home")){
		var $newswatch = $(".newswatch .container");
		var $compact = true;
		var $width = $(".newswatch>div").width();
		var $prev = $(".newswatch .prev");
		var $next = $(".newswatch .next");
		
		$("body.blog").on("click","aside.newswatch article",function(){
			$(this).parent().parent()
				.toggleClass("expanded compact");
			if($compact){
				$compact = false;
				var start = parseInt($(this).index() / 3) * -100;
				var end = $(this).index() * -100;
				$newswatch.css({marginLeft: start+"%"});
				$newswatch.animate({marginLeft:end+"%"},500);
			}else{
				$compact = true;
				var start = $(this).index() * -100;
				var end = parseInt($(this).index() / 3) * -100;
				$newswatch.css({marginLeft: start+"%"});
				$newswatch.animate({marginLeft:end+"%"},500);
			}
			
		});
		
		$("body.blog").on("click","aside.newswatch article a",function(){
			stopPropagation();
		});
		
		$("body.blog").on("mousedown","aside.newswatch button",function(ev){
			var $this = $(this);
			if($this.hasClass("inactive")) return;
		
			ev.stopPropagation();
			ev.preventDefault();
			
			$this.addClass("inactive");
			
			if($this.hasClass("prev")){
				$newswatch.animate(
					{marginLeft: '+=100%'},
					function(){handleButtons()}
					);
			}else if($this.hasClass("next")){
				$newswatch.animate(
					{marginLeft: '-=100%'},
					function(){handleButtons()}
					);
					
			}
		});
		
		function handleButtons(){
			var $first = $newswatch
				.children("article:first")
				.position();
			var $last = $newswatch
				.children("article:last")
				.position();
			if($first.left < 0){
				$prev.removeClass("inactive");
			}else if($first.left >0 && !$prev.hasClass("inactive")){
				$prev.addClass("inactive");
			}
			if($last.left < $width && !$next.hasClass("inactive")){
				$next.addClass("inactive");
			}else if($last.left > $width){
				$next.removeClass("inactive");
			}
		}
	}
	
	if($("#content.pillar").length > 0){
		var pillar = $("#content.pillar");
		
		pillar.on('click','.slidenav',function(ev){
			ev.preventDefault();
			ev.stopPropagation();
			
			var $this = $(this);
			var $slider = $this.parent();
			var container = $slider.children(".container");
			var articles = container.children("article");
			var index = $slider.attr("data-index");
			if(typeof index === 'undefined') index = 0;
			var articleWidth = articles.outerWidth();
			var endWidth = (articles.length -1)*articleWidth*-1;
			//var currentOffset = $slider.scrollLeft();
			var currentOffset = parseInt(container.css('marginLeft'));

			if($this.hasClass("previous")){
				if(index > 0){
					index--;
					$this.siblings(".next").removeClass("disabled");
					if(index == 0){$this.addClass("disabled");}
				}
			}else if($this.hasClass("next")){
				if(index < articles.length - 1){
					index++;
					$this.siblings('.previous').removeClass("disabled");
					if(to == articles.length - 1) $this.addClass("disabled");
				}
			}
			var to = index * articleWidth * -1;
			container.css({'marginLeft':to+"px"});
			$slider.attr("data-index",index);
		});
	}
});

/*! A fix for the iOS orientationchange zoom bug. Script by @scottjehl, rebound by @wilto.MIT License.*/(function(m){if(!(/iPhone|iPad|iPod/.test(navigator.platform)&&navigator.userAgent.indexOf("AppleWebKit")>-1)){return}var l=m.document;if(!l.querySelector){return}var n=l.querySelector("meta[name=viewport]"),a=n&&n.getAttribute("content"),k=a+",maximum-scale=1",d=a+",maximum-scale=10",g=true,j,i,h,c;if(!n){return}function f(){n.setAttribute("content",d);g=true}function b(){n.setAttribute("content",k);g=false}function e(o){c=o.accelerationIncludingGravity;j=Math.abs(c.x);i=Math.abs(c.y);h=Math.abs(c.z);if(!m.orientation&&(j>5||((h>4&&i<6||h<6&&i>4)&&j>3))){if(g){b()}}else{if(!g){f()}}}m.addEventListener("orientationchange",f,false);m.addEventListener("devicemotion",e,false)})(this);
