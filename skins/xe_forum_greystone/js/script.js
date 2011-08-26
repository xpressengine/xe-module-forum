jQuery(function($){
	var state = false;

	deleteBottomBorder();
	CommentHeightExpand();

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
	
	// The function is used for delete the bottom border of the last tr of table. 
	function deleteBottomBorder(){
		var last_tr = $('table.forumCategoryList').find('tr').last().find('td');
		$.each(last_tr, function(k,v){
			$(v).css('border-bottom','0');
			$(v).find('div').css('border-bottom','0');
		});

		var sub_forum_ltr = $('#forum_mod.sub_forums').find('table.forumCategoryList').find('tr').last().find('td');
		$.each(sub_forum_ltr, function(k,v){
			$(v).css('border-bottom','0');
			$(v).find('div').css('border-bottom','0');
		});
		var thread_ltr = $('#forum_mod.thread_lists').find('table.forumCategoryList').find('tr.bg1').last().find('td');
		$.each(thread_ltr, function(k,v){
			$(v).css('border-bottom','0');
			$(v).find('div').css('border-bottom','0');
		});
	}

	// Expand the height of the comment box if less content 
	function CommentHeightExpand(){
		var content_td = $('td.content_text');
		$.each(content_td, function(k,v){
			var content_mod = $(v).find('div.content_mod');
			var content_mod_btn = $(content_mod).find('.btn');
			if(content_mod.height()<150){
				content_mod.height(150);
				content_mod.css('position','relative');
				content_mod_btn.css('position','absolute');
				content_mod_btn.css('right',0);
				content_mod_btn.css('bottom',0);
				content_mod_btn.width('100%');
		}
	});
	}


});