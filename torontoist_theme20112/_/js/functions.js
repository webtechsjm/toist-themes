jQuery(document).ready(function($){
	//Events organiser Show All toggle
	var recurrences = $(".recur");
	
	if(recurrences.length > 0){
		if(recurrences.children().length > 5 
			&& recurrences.siblings("#show-all-button").length == 0){
			recurrences.addClass("hide-long");
			$('<a id="show-all-button">Show all</a>')
				.insertAfter(recurrences)
				.click(function(ev){
					recurrences.toggleClass("hide-long");
					ev.stopPropagation();
					ev.preventDefault()
					})
		}
	}

});
