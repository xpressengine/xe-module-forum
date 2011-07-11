<?php
    /**
     * @file   en.lang.php
     * @author dan (dan.dragan@arnia.ro)
     * @brief  forum modules's basic language pack
     **/

    $lang->forum = 'Forum';

    $lang->read_more = 'Read more';
    $lang->except_notice = 'Exclude Sticky';
    $lang->use_anonymous = 'Use Anonymous';
    $lang->allow_anonymous_search='Allow Anonymous Search';
    $lang->notice='Sticky';
    $lang->notify='Email Notification';

    $lang->cmd_manage_menu = 'Manage Menus';
    $lang->list_target_item = 'Target Item';
    $lang->list_display_item = 'Display Item';
    $lang->summary = 'Summary';
    $lang->thumbnail = 'Thumbnail';
    $lang->main='Main';
    $lang->separator='>';;
    $lang->cmd_quote='Quote';
    $lang->new_comment='New Comment';
    
    //Admin
    $lang->forum_title='Title of Forum';
    $lang->forum_title_description='Please input the title of forum.';
    $lang->description='Description';
    $lang->about_description='You may input description which will be displayed under the forum title.';
    $lang->manage_category='Categories';
    $lang->site_layout='Site Layout';
    $lang->forum_theme='Forum Theme';
    $lang->design='Design';
    $lang->view='view';
    $lang->xe_forum='Xe Forum';
    
    //Dashboard of forum
    $lang->number_of_posts='Posts';
    $lang->number_of_threads='Threads';
    $lang->number_of_users='Users';
    $lang->number_of_atachements='Attachements';
    $lang->forum_id='Forum ID';
    $lang->last_updated_threads='Last updated threads';
    $lang->last_updated_comments='Last 5 posts';
    $lang->lastweek_threads='Last week threads';
    $lang->lastweek_posts='Last week posts';
    $lang->lastweek_users='Last week users';
    $lang->lastweek_atachements='Last week attachements';
    
    //View document page attributes
    $lang->post_subject='Post subject';
    $lang->post_date='Post date';
    $lang->registered='registered';
    $lang->ip='ip';
    $lang->views='views';
    $lang->file_size='File Size';
    $lang->download='Download';
    $lang->subject='Subject';
    $lang->reply='Reply';
    $lang->author='author';
    $lang->message='message';
    
    // Category attributes
    $lang->last_update = 'Last update';
    $lang->article_count = 'Article(s)';
    $lang->document_count = 'Thread(s)';
    $lang->notice_count = 'Sticky(s)';
    $lang->comments='Post(s)';
    $lang->category_statistics='Category statistics';
    
    // Item
    $lang->search_result = 'Search Result';
    $lang->consultation = 'Consultation';
    $lang->admin_mail = 'Administrator\'s Mail';

    // words used in button
    $lang->cmd_forum_list = 'Forum List';
    $lang->cmd_module_config = 'Common Forum Setting';
    $lang->cmd_view_info = 'Forum Info';
    $lang->cmd_list_setting = 'List Setting';
    $lang->cmd_create_forum = 'Create a new forum';
    $lang->cmd_ban='Ban';

    // blah blah..
    $lang->about_layout_setup = 'You can manually modify forum layout code. Insert or manage the widget code anywhere you want';
    $lang->about_forum_category = 'You can make forum categories.<br />When forum category is broken, try rebuilding the cache file manually.';
    $lang->about_except_notice = 'Sticky articles will not be displayed on normal list.';
    $lang->about_use_anonymous = 'Make this forum into an anonymous forum by hiding the author\'s information.<br /><strong>Please turn off history at additional setup. If not, editing document might show the author\'s info.</strong>';
    $lang->about_allow_anonymous_search='Allow users that are not logged in to search the forums';
    $lang->about_forum = 'This module is for creating and managing forums.';
    $lang->about_consultation = 'Non-administrator members would see their own articles.\nNon-members would not be able to write articles when using consultation.';
    $lang->about_admin_mail = 'A mail will be sent when an article or comment is submitted.<br />Multiple mails can be sent with commas(,).';
    $lang->about_list_config = 'If using list-style skin, you may arrange items to display.<br />However, this feature might not be availble for non-official skins.<br />If you double-click target items and display items, then you can add / remove them';
	$lang->mail_unsibscribe = 'If you wish to unsubscribe from emailing notification please clcik on this link';
    $lang->unsubscribe_success= 'You have been currently unsubscribed from the ';
	
    // Admin - Forum info
    $lang->display_categories_on_index = 'Display category list on index page';
    $lang->about_display_categories_on_index = 'Choose whether to display a list of all forum categories on home page or a list of the most recent articles.';
    
    //Point
    $lang->msg_not_enough_point = 'Your point is not enough to write an article in this forum.';
	
    //Write
	$lang->write_comment = 'Write a comment';
	$lang->write_new_thread='Write new thread';
	
	//Sectional Titles
	$lang->module_info ='Module Info';
	$lang->module_theme_info='Module Theme Info';
	$lang->functional_info='Functional Info';
	$lang->module_member_info='Module Member Info';
	$lang->admin_info='Administrator Info';
	$lang->content_info='Content Info';
	
	//Operational 
	$lang->dashboard='Dashboard';
	$lang->post='Post';
	$lang->nick_name='Nick Name';
	$lang->last_update='Last Update';
	$lang->thread='Thread';
	$lang->threadmic='thread';
	$lang->actions='Actions';
	$lang->preview='Preview';
	$lang->last_post = 'Last post';
    $lang->main_categories='Main Categories';
    $lang->new_thread = 'New Thread';
    $lang->of_which='of wich';
    $lang->back='Back';
	//Search form
	$lang->search_forums='Search the forums';
	$lang->search_in='Search in';
	$lang->keywords='Keywords';
	$lang->search_current='Search only current category';
	//Delete form text
	$lang->ban_user = 'Are you sure you want to ban this user ';
	$lang->and_posts= 'and all its posts';
	$lang->confirm_delete_comment = 'Are you sure you want to delete this post';
	$lang->confirm_ban_user = 'Are you sure you want to ban this user';
	$lang->delete_comments_and_threads = 'Delete all comments and threads for the specified user';
	$lang->delete_user = 'Delete the user';
	$lang->ban_ip = 'Ban user IP';
	$lang->ban_id = 'Ban user ID';
	//Search form text
	$lang->search_message1='In order to search the forums, you have to';
	$lang->login='login';
	$lang->first='first';
	$lang->search_message2='If you don\'t have an account, you can register';
	$lang->here='here';
	$lang->no_articles='No articles were found for your search criteria.';
	
	//Member info
	$lang->my_account='My account';
?>
