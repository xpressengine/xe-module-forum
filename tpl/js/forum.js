/**
 * @file   modules/forum/js/forum.js
 * @author NAVER (developers@xpressengine.com)
 * @brief  forum module javascript functions
 **/

/* callback function for insert filter */
function completeDocumentInserted(ret_obj) {
	var error = ret_obj.error;
	var message = ret_obj.message;
	var mid = ret_obj.mid;
	var document_srl = ret_obj.document_srl;
	var category_srl = ret_obj.category_srl;

	var url;
	if(!document_srl)
	{
		url = current_url.setQuery('mid',mid).setQuery('act','');
	}
	else
	{
		url = current_url.setQuery('mid',mid).setQuery('document_srl',document_srl).setQuery('act','');
	}
	if(category_srl) url = url.setQuery('category',category_srl);
	location.href = url;
}

/* callback function for delete_document filter */
function completeDeleteDocument(ret_obj) {
	var error = ret_obj.error;
	var message = ret_obj.message;
	var mid = ret_obj.mid;
	var page = ret_obj.page;

	var url = current_url.setQuery('mid',mid).setQuery('act','').setQuery('document_srl','');
	if(page) url = url.setQuery('page',page);
	location.href = url;
}

/* callback function for search filter */
function completeSearch(ret_obj, response_tags, params, fo_obj) {
	fo_obj.submit();
}

function completeVote(ret_obj) {
	var error = ret_obj.error;
	var message = ret_obj.message;
	alert(message);
	location.href = location.href;
}

function completeReload(ret_obj) {
	var error = ret_obj.error;
	var message = ret_obj.message;

	location.href = location.href;
}

/* callback function for insert_comment filter */
function completeInsertComment(ret_obj) {
	var error = ret_obj.error;
	var message = ret_obj.message;
	var mid = ret_obj.mid;
	var document_srl = ret_obj.document_srl;
	var comment_srl = ret_obj.comment_srl;

	var url = current_url.setQuery('mid',mid).setQuery('document_srl',document_srl).setQuery('act','');
	if(comment_srl) url = url.setQuery('rnd',comment_srl)+"#comment_"+comment_srl;

	location.href = url;
}

/* callback function for delete_comment filter */
function completeDeleteComment(ret_obj) {
	var error = ret_obj.error;
	var message = ret_obj.message;
	var mid = ret_obj.mid;
	var document_srl = ret_obj.document_srl;
	var page = ret_obj.page;

	var url = current_url.setQuery('mid',mid).setQuery('document_srl',document_srl).setQuery('act','');
	if(page) url = url.setQuery('page',page);

	location.href = url;
}

function completeBanUser(ret_obj) {
	var error = ret_obj.error;
	var message = ret_obj.message;
	var mid = ret_obj.mid;
	var document_srl = ret_obj.document_srl;
	var page = ret_obj.page;

	var url = current_url.setQuery('mid',mid).setQuery('document_srl',document_srl).setQuery('act','').setQuery('member_srl','').setQuery('ipaddress','');
	if(page) url = url.setQuery('page',page);

	location.href = url;
}

/* callback function for delete_trackback filter */
function completeDeleteTrackback(ret_obj) {
	var error = ret_obj.error;
	var message = ret_obj.message;
	var mid = ret_obj.mid;
	var document_srl = ret_obj.document_srl;
	var page = ret_obj.page;

	var url = current_url.setQuery('mid',mid).setQuery('document_srl',document_srl).setQuery('act','');
	if(page) url = url.setQuery('page',page);

	location.href = url;
}

/* change category */
function doChangeCategory() {
	var category_srl = jQuery('#forum_category option:selected').val();
	location.href = decodeURI(current_url).setQuery('category',category_srl).setQuery('act', 'dispForumContent');
}

/* Scrap */
function doScrap(document_srl) {
	var params = new Array();
	params.document_srl = document_srl;
	exec_xml("member","procMemberScrapDocument", params, null);
}
