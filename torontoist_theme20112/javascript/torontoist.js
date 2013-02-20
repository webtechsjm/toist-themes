$(document).ready(function(){
var toistSizer = function(){
	var body = $("body");
	var sizes = ['xs','s','m','l','xl'];
	var cookies = document.cookie;
	var setSize = unescape(document.cookie.replace(new RegExp("(?:^|.*;\\s*)toistSize\\s*\\=\\s*((?:[^;](?!;))*[^;]?).*"), "$1"));
	var size = false;
	if(setSize) size = setSize;
	else size = "m";
	
	body.addClass("size-"+size);
	
	function changeSize(change){
		var currentSize = sizes.indexOf(size);
		var warn = false;
		var newSize = false;
		
		switch(change){
			case "larger":
				if(currentSize < sizes.length - 1)
					var newSize = ++currentSize;
				if(newSize + 1 == sizes.length) warn = "max";
				break;
			case "smaller":
				if(currentSize > 0)
					var newSize = --currentSize;
				if(newSize == 0) warn = "min";
				break;
			}
			
		if(newSize !== false){
			body.removeClass("size-"+size);
			size = sizes[newSize];
			body.addClass("size-"+size);
			document.cookie = "toistSize="+size;
			if(warn) return warn;
		}else{return false}
	}
	
	return {
		larger:function(){
			changeSize('larger');
			},
		smaller:function(){
			changeSize('smaller');
			}
		}
	}();

});
