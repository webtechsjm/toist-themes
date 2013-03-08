jQuery(document).ready(function($){
	if(('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch){
		$("html").addClass("touch");
	}
});
