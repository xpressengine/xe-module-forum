<?php
    /**
     * @class  forum
     * @author dan (dan.dragan@arnia.ro)
     * @brief  forum module high class
     **/

    class forum extends ModuleObject {

        var $search_option = array('title','Subject + Content','nick_name'); ///< search options

        var $order_target = array('list_order', 'update_order', 'regdate', 'voted_count', 'readed_count', 'comment_count', 'title'); // sort options

        var $skin = "default"; ///< skin name
        var $list_count = 20; ///< list count
        var $page_count = 10; ///< page count
        var $category_list = NULL; ///< category list


        /**
         * @brief module install function
         **/
        function moduleInstall() {
            $oModuleController = &getController('module');
            $oModuleModel = &getModel('module');
            $oDocumentController = &getController('document');
            $oCommentController = &getController('comment');
            

            // insert triggers 
            $oModuleController->insertTrigger('member.getMemberMenu', 'forum', 'controller', 'triggerMemberMenu', 'after');
            $oModuleController->insertTrigger('forum.dispForumCommentSetup', 'comment', 'view', 'triggerDispCommentAdditionSetup', 'before');
			$oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'document', 'view', 'triggerDispDocumentAdditionSetup', 'before');
            $oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'file', 'view', 'triggerDispFileAdditionSetup', 'before');
            $oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'point', 'view', 'triggerDispPointAdditionSetup', 'before');
            $oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'editor', 'view', 'triggerDispEditorAdditionSetup', 'before');
            
            // Create the basic forum
            $args->mid = 'forum';
            $args->module = 'forum';
            $args->browser_title = 'XpressEngine';
            $args->skin = 'dtheme';
            $args->site_srl = 0;
            $insert_module = $oModuleController->insertModule($args);
            //create demo category
            $obj->module_srl = $insert_module->get('module_srl');
            $obj->title = 'Demo Category';
            $insert_category = $oDocumentController->insertCategory($obj);
            //create demo thread
            $document_args->title = 'Demo Thread';
            $document_args->content = 'This is a a thread example';
            $document_args->module_srl = $insert_module->get('module_srl');
            $document_args->category_srl = $insert_category->get('category_srl');
            $document_args->comment_status = 'ALLOW';
            $insert_document = $oDocumentController->insertDocument($document_args);
            //create demo comment
            $comment_args->content = '<p>This is a comment example</p>';
            $comment_args->document_srl = $insert_document->get('document_srl');
            $comment_args->module_srl = $insert_module->get('module_srl');
            $comment_args->status = '1';
            $insert_comment = $oCommentController->insertComment($comment_args);
            //add basic forum to be index module if index module doesn't exist
            $argx->site_srl = 0;
            $output = executeQuery('module.getSite', $argx);
            if(!$output->data->index_module_srl) {
                $module_srl = $insert_module->get('module_srl');
                $site_args->site_srl = 0;
                $site_args->index_module_srl = $module_srl;
                $oModuleController->updateSite($site_args);
            }

            return new Object();
        }

        /**
         * @brief check to see if update is necessary
         **/
        function checkUpdate() {
            $oModuleModel = &getModel('module');

            // check to see if the necessary triggers are found in the database
            if(!$oModuleModel->getTrigger('member.getMemberMenu', 'forum', 'controller', 'triggerMemberMenu', 'after')) return true;
            if(!$oModuleModel->getTrigger('forum.dispForumCommentSetup', 'comment', 'view', 'triggerDispCommentAdditionSetup', 'before')) return true;
            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'document', 'view', 'triggerDispDocumentAdditionSetup', 'before')) return true;
            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'file', 'view', 'triggerDispFileAdditionSetup', 'before')) return true;
            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'point', 'view', 'triggerDispPointAdditionSetup', 'before')) return true;
            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'editor', 'view', 'triggerDispEditorAdditionSetup', 'before')) return true;
            
            return false;
        }

        /**
         * @brief module update
         **/
        function moduleUpdate() {
            $oModuleModel = &getModel('module');
            $oModuleController = &getController('module');
            
            $module_config = $oModuleModel->getModuleConfig('forum');
            if(!$module_config->first_install){
            	$this->moduleInstall();
            	$module_config->first_install = 'Y';
            	$oModuleController->insertModuleConfig('forum',$module_config);
            }else{
            	// updates all the necessary tables in order for the forum to work properly
	            if(!$oModuleModel->getTrigger('member.getMemberMenu', 'forum', 'controller', 'triggerMemberMenu', 'after'))
	                $oModuleController->insertTrigger('member.getMemberMenu', 'forum', 'controller', 'triggerMemberMenu', 'after');
	            if(!$oModuleModel->getTrigger('forum.dispForumCommentSetup', 'comment', 'view', 'triggerDispCommentAdditionSetup', 'before'))
	            	$oModuleController->insertTrigger('forum.dispForumCommentSetup', 'comment', 'view', 'triggerDispCommentAdditionSetup', 'before');
				if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'document', 'view', 'triggerDispDocumentAdditionSetup', 'before'))
	            	$oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'document', 'view', 'triggerDispDocumentAdditionSetup', 'before');
	            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'file', 'view', 'triggerDispFileAdditionSetup', 'before'))
	            	$oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'file', 'view', 'triggerDispFileAdditionSetup', 'before');
	            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'point', 'view', 'triggerDispPointAdditionSetup', 'before'))
	            	$oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'point', 'view', 'triggerDispPointAdditionSetup', 'before');
	            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'editor', 'view', 'triggerDispEditorAdditionSetup', 'before'))
	            	$oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'editor', 'view', 'triggerDispEditorAdditionSetup', 'before');
            }
            return new Object(0, 'success_updated');
        }
		/**
         * @brief module uninstall function
         **/
		function moduleUninstall() {
			$output = executeQueryArray("forum.getAllForum");
			if(!$output->data) return new Object();
			set_time_limit(0);
			$oModuleController =& getController('module');
			foreach($output->data as $forum)
			{
				$oModuleController->deleteModule($forum->module_srl);
			}
			return new Object();
		}

        /**
         * @brief recompile the cache after module installation / update
         **/
        function recompileCache() {
        }

    }
?>
