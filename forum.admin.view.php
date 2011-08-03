<?php
    /**
     * @class  forumAdminView
     * @author dan (dan.dragan@arnia.ro)
     * @brief  forum module admin view class
     **/

    class forumAdminView extends forum {

        /**
         * @brief Initialization
         *
         * forum Module is divided into general use and administrative purpose
         **/
        function init() {
            // checks if there are preexisting modules with the current module_srl
            $module_srl = Context::get('module_srl');
            if(!$module_srl && $this->module_srl) {
                $module_srl = $this->module_srl;
                Context::set('module_srl', $module_srl);
            }

            // module creating model object 
            $oModuleModel = &getModel('module');

            // setting the information in advance, in order to save the module
            if($module_srl) {
                $module_info = $oModuleModel->getModuleInfoByModuleSrl($module_srl);
                if(!$module_info) {
                    Context::set('module_srl','');
                    $this->act = 'list';
                } else {
                    ModuleModel::syncModuleToSite($module_info);
                    $this->module_info = $module_info;
                    Context::set('module_info',$module_info);
                }
            }
			// check if we are in the right kind of module
            if($module_info && $module_info->module != 'forum') return $this->stop("msg_invalid_request");

            // Set module categories to populate admin list
            $module_category = $oModuleModel->getModuleCategories();
            Context::set('module_category', $module_category);

            // Set template path for admin view pages
            $template_path = sprintf("%stpl/",$this->module_path);
            $this->setTemplatePath($template_path);

            // set order target
            foreach($this->order_target as $key) $order_target[$key] = Context::getLang($key);
            $order_target['list_order'] = Context::getLang('document_srl');
            $order_target['update_order'] = Context::getLang('last_update');
            Context::set('order_target', $order_target);
        }

        /**
         * @brief Display forum admin content
         **/
        function dispForumAdminContent() {
            $output = executeQueryArray('forum.getForumList', $args);
            $display=Context::get('display');
            ModuleModel::syncModuleToSite($output->data);
            	//if there is only one forum go directly to it's dashboard , else go to forum list
	            if($output->total_count !=1 || $display) {
	            $this->displayForumAdminContentList();
	            }
	            else {
	            	$oModuleModel = &getModel('module');
	            	$module_srl=$output->data[1]->module_srl;
	            	$module_info = $oModuleModel->getModuleInfoByModuleSrl($module_srl);
	            	ModuleModel::syncModuleToSite($module_info);
	                $this->module_info = $module_info;
	                Context::set('module_info',$module_info);
	                Context::set('module_srl',$module_srl);
	                Context::set('act','dispForumAdminDashboard');
	            	$this->dispForumAdminDashboard();
	            }       
        }
        /**
         * @brief Display forum admin dashboard
         **/
        function dispForumAdminDashboard() {
        	
        	 $module_info=Context::get('module_info');
        	 $oDocumentModel = &getModel('document');
        	 $oCommentModel=&getModel('comment');
        	 
        	 $obj->list_count=$oDocumentModel->getDocumentCount($module_info->module_srl);
        	 $obj->mid=$module_info->mid;
        	 $obj->module_srl=$module_info->module_srl;
        	 //seting the right format for time parameters
        	 $time = time();
        	 $end_date=date("Ymd",$time);
        	 $time-=60*60*24*7;
             $start_date = date("Ymd",$time);
        	 
        	 $document_list=$oDocumentModel->getDocumentList($obj);
        	 $lastweek_document_count=0;
        	 foreach($document_list->data as $document) {
        	 	$member_list[]=$document->variables['nick_name'];
        	 	$uploaded_count[]=$document->variables['uploaded_count'];
        	 	if((substr($document->variables['last_update'],0,8) <= $end_date) && (substr($document->variables['last_update'],0,8) >= $start_date) ){
        	 		$lastweek_document_count++;
        	 		$lastweek_member_list[]=$document->variables['nick_name'];
        	 		$lastweek_uploaded_count[]=$document->variables['uploaded_count'];
        	 	}
        	 } 
        	 
        	 $obj->list_count=$oCommentModel->getCommentAllCount($module_info->module_srl);
        	 $comment_list=$oCommentModel->getTotalCommentList($obj);
        	 $lastweek_comment_count=0;
        	 foreach ($comment_list->data as $comment){
        	 	$member_list[]=$comment->variables['nick_name'];
        	 	$uploaded_count[]=$comment->variables['uploaded_count'];
        	 	if((substr($comment->variables['last_update'],0,8) <= $end_date) && (substr($comment->variables['last_update'],0,8) >= $start_date) ){
        	 		$lastweek_comment_count++;
        	 		$lastweek_member_list[]=$comment->variables['nick_name'];
        	 		$lastweek_uploaded_count[]=$comment->variables['uploaded_count'];
        	 	}
        	 }
        	 If(is_array($member_list)){
        	 	 $member_list=array_unique($member_list);
	        	 $lastweek_member_list=array_unique($lastweek_member_list);
	        	 $uploaded_count=array_sum($uploaded_count);
	        	 $lastweek_uploaded_count=array_sum($lastweek_uploaded_count);
        	 }
        	 if(!$uploaded_count) $uploaded_count=0; 
        	 if(!$lastweek_uploaded_count) $lastweek_uploaded_count=0; 
			 
        	 $total_comments=$oCommentModel->getCommentAllCount($module_info->module_srl);
        	 
        	 $obj->list_count=5;
        	 $newest_comments=$oCommentModel->getNewestCommentList($obj);
        	 if(isset($newest_comments)){
	        	 foreach($newest_comments as $comment){	
	        	 	$comment->content=trim(cut_str($comment->content,50,"..."));
	        	 	$comment->document_content=$oDocumentModel->getDocument($comment->document_srl)->variables['title'];
	        	 }
        	 }
        	 $module_info->list_count=5;
        	 $newest_documents= executeQuery('forum.getNewestDocumentList', $module_info);
        	 
        	 //setting last week variables for the dashboard template
          	 Context::set('lastweek_total_count',$lastweek_document_count);
          	 Context::set('lastweek_total_comments',$lastweek_comment_count);
          	 Context::set('lastweek_total_users',count($lastweek_member_list));
          	 Context::set('lastweek_total_attachements',$lastweek_uploaded_count);
          	 //setting total variables for the dashboard template
        	 Context::set('total_count',$document_list->total_count);
        	 Context::set('total_comments',$total_comments);
        	 Context::set('total_users',count($member_list));
        	 Context::set('total_attachements',$uploaded_count);
        	 //setting the documents and comments list for the dashboard template
        	 Context::set('newest_documents',$newest_documents->data);
        	 Context::set('newest_comments',$newest_comments);
        	 $this->setTemplateFile('dashboard');
        	 
        }
        
        /**
         * @brief Display forum admin content list
         **/
    	function displayForumAdminContentList() {
        	// setting up default parameters
            $args->sort_index = "module_srl";
            $args->page = Context::get('page');
            $args->list_count = 20;
            $args->page_count = 10;
            $args->s_module_category_srl = Context::get('module_category_srl');

			$s_mid = Context::get('s_mid');
			if($s_mid) $args->s_mid = $s_mid;

			$s_browser_title = Context::get('s_browser_title');
			if($s_browser_title) $args->s_browser_title = $s_browser_title;

            $output = executeQueryArray('forum.getForumList', $args);
            ModuleModel::syncModuleToSite($output->data);
            
			$oModuleModel = &getModel('module');
            foreach ($output->data as $val) {
            	$module_details=$oModuleModel->getModuleInfoByModuleSrl($val->module_srl);
            	$val->title=$module_details->title;
            }
	        // setting up variables for index template
	        Context::set('total_count', $output->total_count);
	        Context::set('total_page', $output->total_page);
	        Context::set('page', $output->page);
	        Context::set('forum_list', $output->data);
	        Context::set('page_navigation', $output->page_navigation);
	
	        
	        $this->setTemplateFile('index');
        }

        /**
         * @brief Display forum admin forum info
         **/
        function dispForumAdminForumInfo() {
            $this->dispForumAdminInsertForum();
        }

        /**
         * @brief display forum admin insert forum
         **/
        function dispForumAdminInsertForum() {
            if(!in_array($this->module_info->module, array('admin', 'forum','blog','guestbook'))) {
                return $this->alertMessage('msg_invalid_request');
            }

            // instancing module model
            $oModuleModel = &getModel('module');
            $skin_list = $oModuleModel->getSkins($this->module_path);
            Context::set('skin_list',$skin_list);

			$mskin_list = $oModuleModel->getSkins($this->module_path, "m.skins");
			Context::set('mskin_list', $mskin_list);

            // instancing layout model
            $oLayoutModel = &getModel('layout');
            $layout_list = $oLayoutModel->getLayoutList();
            Context::set('layout_list', $layout_list);

			$mobile_layout_list = $oLayoutModel->getLayoutList(0,"M");
			Context::set('mlayout_list', $mobile_layout_list);

            // setting up the template
            $this->setTemplateFile('forum_insert');
        }

        /**
         * @brief display forum admin additional setup 
         **/
        function dispForumAdminForumAdditionSetup() {
            // initializing content
            $content = '';

            // getting additional setup using the trigger
            $output = ModuleHandler::triggerCall('forum.dispForumAdditionSetup', 'before', $content);
            Context::set('setup_content', $content);

            // setting up the template
            $this->setTemplateFile('addition_setup');
        }

        /**
         * @brief forum admin delete forum
         **/
        function dispForumAdminDeleteForum() {
            if(!Context::get('module_srl')) return $this->dispForumAdminContent();
            if(!in_array($this->module_info->module, array('admin', 'forum','blog','guestbook'))) {
                return $this->alertMessage('msg_invalid_request');
            }

            $module_info = Context::get('module_info');

            $oDocumentModel = &getModel('document');
            $document_count = $oDocumentModel->getDocumentCount($module_info->module_srl);
            $module_info->document_count = $document_count;

            Context::set('module_info',$module_info);

            // setting up the template
            $this->setTemplateFile('forum_delete');
        }

        /**
         * @brief display forum admin list setup
         **/
        function dispForumAdminListSetup() {
            $oforumModel = &getModel('forum');
			
             $content = '';

            // getting list configuration using a trigger
            $output = ModuleHandler::triggerCall('forum.dispForumCommentSetup', 'before', $content);
            $lang->comment_count=Context::getLang('comment_count');
            $lang->number_of_posts=Context::getLang('number_of_posts');
            $content=str_replace($lang->comment_count, $lang->number_of_posts, $content);
            Context::set('setup_content', $content);
            // getting default list configuration
            $default_list=$oforumModel->getDefaultListConfig($this->module_info->module_srl);
            Context::set('extra_vars', $default_list);
            $list_config=$oforumModel->getListConfig($this->module_info->module_srl);
            Context::set('list_config', $list_config);
			// setting up the template
            $this->setTemplateFile('list_setting');
        }

        /**
         * @brief display forum admin category info
         **/
        function dispForumAdminCategoryInfo() {
            $oDocumentModel = &getModel('document');
            $catgegory_content = $oDocumentModel->getCategoryHTML($this->module_info->module_srl);
            Context::set('category_content', $catgegory_content);

            Context::set('module_info', $this->module_info);
            // setting up the template
            $this->setTemplateFile('category_list');
        }

        /**
         * @brief display forum grant info
         **/
        function dispForumAdminGrantInfo() {
          	//getting default grant configuration
            $oModuleAdminModel = &getAdminModel('module');
            $grant_content = $oModuleAdminModel->getModuleGrantHTML($this->module_info->module_srl, $this->xml_info->grant);
            Context::set('grant_content', $grant_content);
			// setting up the template
            $this->setTemplateFile('grant_list');
        }

        /**
         * @brief display forum admin extra vars
         **/
        function dispForumAdminExtraVars() {
        	//getting extra vars html
            $oDocumentAdminModel = &getModel('document');
            $extra_vars_content = $oDocumentAdminModel->getExtraVarsHTML($this->module_info->module_srl);
            Context::set('extra_vars_content', $extra_vars_content);
			// setting up the template
            $this->setTemplateFile('extra_vars');
        }

        /**
         * @brief display forum admin skin info
         **/
        function dispForumAdminSkinInfo() {
            // getting module skin info html
            $oModuleAdminModel = &getAdminModel('module');
            $skin_content = $oModuleAdminModel->getModuleSkinHTML($this->module_info->module_srl);
            Context::set('skin_content', $skin_content);
			
            //setting all the variables
            $oModuleModel = &getModel('module');
            $skin_list = $oModuleModel->getSkins($this->module_path);
            Context::set('skin_list',$skin_list);

			$mskin_list = $oModuleModel->getSkins($this->module_path, "m.skins");
			Context::set('mskin_list', $mskin_list);
            
            $oLayoutModel = &getModel('layout');
            $layout_list = $oLayoutModel->getLayoutList();
            Context::set('layout_list', $layout_list);

			$mobile_layout_list = $oLayoutModel->getLayoutList(0,"M");
			Context::set('mlayout_list', $mobile_layout_list);
            // setting up the template
            $this->setTemplateFile('skin_info');
        }


        /**
         * @brief forum module alert message
         **/
        function alertMessage($message) {
            $script =  sprintf('<script type="text/javascript"> xAddEventListener(window,"load", function() { alert("%s"); } );</script>', Context::getLang($message));
            Context::addHtmlHeader( $script );
        }
    }
?>
