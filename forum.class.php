<?php
    /**
     
     **/

    class forum extends ModuleObject {

        var $search_option = array('title','content','comment','nick_name','tag'); ///

        var $order_target = array('list_order', 'update_order', 'regdate', 'voted_count', 'readed_count', 'comment_count', 'title'); // 

        var $skin = "default"; ///
        var $list_count = 20; ///
        var $page_count = 10; ///
        var $category_list = NULL; ///


        /**
         
         **/
        function moduleInstall() {
            // 
            $oModuleController = &getController('module');
            $oModuleModel = &getModel('module');

            // 
            $oModuleController->insertTrigger('member.getMemberMenu', 'forum', 'controller', 'triggerMemberMenu', 'after');
            
            $oModuleController->insertTrigger('forum.dispForumCommentSetup', 'comment', 'view', 'triggerDispCommentAdditionSetup', 'before');

            $oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'document', 'view', 'triggerDispDocumentAdditionSetup', 'before');
            $oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'file', 'view', 'triggerDispFileAdditionSetup', 'before');
            $oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'point', 'view', 'triggerDispPointAdditionSetup', 'before');
            $oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'editor', 'view', 'triggerDispEditorAdditionSetup', 'before');
            
            // 
            $args->site_srl = 0;
            $output = executeQuery('module.getSite', $args);
            if(!$output->data->index_module_srl) {
                $args->mid = 'forum';
                $args->module = 'forum';
                $args->browser_title = 'XpressEngine';
                $args->skin = 'xe_default';
                $args->site_srl = 0;
                $output = $oModuleController->insertModule($args);
                $module_srl = $output->get('module_srl');
                $site_args->site_srl = 0;
                $site_args->index_module_srl = $module_srl;
                $oModuleController = &getController('module');
                $oModuleController->updateSite($site_args);
            }

            return new Object();
        }

        /**
         * 
         **/
        function checkUpdate() {
            $oModuleModel = &getModel('module');

            // 
            if(!$oModuleModel->getTrigger('member.getMemberMenu', 'forum', 'controller', 'triggerMemberMenu', 'after')) return true;
            
            if(!$oModuleModel->getTrigger('forum.dispForumCommentSetup', 'comment', 'view', 'triggerDispCommentAdditionSetup', 'before')) return true;
            
            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'document', 'view', 'triggerDispDocumentAdditionSetup', 'before')) return true;
            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'file', 'view', 'triggerDispFileAdditionSetup', 'before')) return true;
            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'point', 'view', 'triggerDispPointAdditionSetup', 'before')) return true;
            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'editor', 'view', 'triggerDispEditorAdditionSetup', 'before')) return true;
            
            return false;
        }

        /**
         
         **/
        function moduleUpdate() {
            $oModuleModel = &getModel('module');
            $oModuleController = &getController('module');

            //
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
            	
            return new Object(0, 'success_updated');
        }

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
         
         **/
        function recompileCache() {
        }

    }
?>
