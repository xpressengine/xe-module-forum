/**
 * @file   modules/forum/js/forum.js
 * @author NHN (developers@xpressengine.com)
 * @brief  forum ëª¨ë“ˆì�˜ javascript
 **/

/* ê¸€ì“°ê¸° ìž‘ì„±í›„ */
function completeDocumentInserted(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];
    var mid = ret_obj['mid'];
    var document_srl = ret_obj['document_srl'];
    var category_srl = ret_obj['category_srl'];

    //alert(message);

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

/* ê¸€ ì‚­ì œ */
function completeDeleteDocument(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];
    var mid = ret_obj['mid'];
    var page = ret_obj['page'];

    var url = current_url.setQuery('mid',mid).setQuery('act','').setQuery('document_srl','');
    if(page) url = url.setQuery('page',page);

    //alert(message);

    location.href = url;
}

/* ê²€ìƒ‰ ì‹¤í–‰ */
function completeSearch(ret_obj, response_tags, params, fo_obj) {
    fo_obj.submit();
}

function completeVote(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];
    alert(message);
    location.href = location.href;
}

// í˜„ìž¬ íŽ˜ì�´ì§€ reload
function completeReload(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];

    location.href = location.href;
}

/* ëŒ“ê¸€ ê¸€ì“°ê¸° ìž‘ì„±í›„ */
function completeInsertComment(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];
    var mid = ret_obj['mid'];
    var document_srl = ret_obj['document_srl'];
    var comment_srl = ret_obj['comment_srl'];

    var url = current_url.setQuery('mid',mid).setQuery('document_srl',document_srl).setQuery('act','');
    if(comment_srl) url = url.setQuery('rnd',comment_srl)+"#comment_"+comment_srl;

    //alert(message);

    location.href = url;
}

/* ëŒ“ê¸€ ì‚­ì œ */
function completeDeleteComment(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];
    var mid = ret_obj['mid'];
    var document_srl = ret_obj['document_srl'];
    var page = ret_obj['page'];

    var url = current_url.setQuery('mid',mid).setQuery('document_srl',document_srl).setQuery('act','');
    if(page) url = url.setQuery('page',page);

    //alert(message);

    location.href = url;
}

/* íŠ¸ëž™ë°± ì‚­ì œ */
function completeDeleteTrackback(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];
    var mid = ret_obj['mid'];
    var document_srl = ret_obj['document_srl'];
    var page = ret_obj['page'];

    var url = current_url.setQuery('mid',mid).setQuery('document_srl',document_srl).setQuery('act','');
    if(page) url = url.setQuery('page',page);

    //alert(message);

    location.href = url;
}

/* ì¹´í…Œê³ ë¦¬ ì�´ë�™ */
function doChangeCategory() {
    var category_srl = jQuery('#forum_category option:selected').val();
    location.href = decodeURI(current_url).setQuery('category',category_srl).setQuery('act', 'dispForumContent');
}

/* ìŠ¤í�¬ëž© */
function doScrap(document_srl) {
    var params = new Array();
    params["document_srl"] = document_srl;
    exec_xml("member","procMemberScrapDocument", params, null);
}
