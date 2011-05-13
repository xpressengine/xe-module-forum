jQuery(document).ready(function(){
	
	var state = false;
	
	jQuery("table.forumCategoryList .openClose").click(function () {
	
		var target = jQuery(this);

		jQuery(this).parents(".forumCategoryList").next(".forumContent").toggle(
			"blind", { direction: "vertical" }, 500,
			function () {
				if ( state ) {
					state = false;
					target.removeClass("on");
				} else {
					state = true;
					target.addClass("on");
				}
			}
		);
	});

});