<?php
    /**
     * @class  forum
     * @author NHN (developers@xpressengine.com)
     * @brief  forum Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Ëœ high class
     **/

    class forum extends ModuleObject {

        var $search_option = array('title','content','comment','nick_name','tag'); ///< ÃªÂ²â‚¬Ã¬Æ’â€° Ã¬ËœÂµÃ¬â€¦Ëœ

        var $order_target = array('list_order', 'update_order', 'regdate', 'voted_count', 'readed_count', 'comment_count', 'title'); // Ã¬Â â€¢Ã«Â Â¬ Ã¬ËœÂµÃ¬â€¦Ëœ

        var $skin = "default"; ///< Ã¬Å Â¤Ã­â€šÂ¨ Ã¬ï¿½Â´Ã«Â¦â€ž
        var $list_count = 20; ///< Ã­â€¢Å“ Ã­Å½ËœÃ¬ï¿½Â´Ã¬Â§â‚¬Ã¬â€”ï¿½ Ã«â€šËœÃ­Æ’â‚¬Ã«â€šÂ  ÃªÂ¸â‚¬Ã¬ï¿½Ëœ Ã¬Ë†Ëœ
        var $page_count = 10; ///< Ã­Å½ËœÃ¬ï¿½Â´Ã¬Â§â‚¬Ã¬ï¿½Ëœ Ã¬Ë†Ëœ
        var $category_list = NULL; ///< Ã¬Â¹Â´Ã­â€¦Å’ÃªÂ³Â Ã«Â¦Â¬ Ã«ÂªÂ©Ã«Â¡ï¿½


        /**
         * @brief Ã¬â€žÂ¤Ã¬Â¹ËœÃ¬â€¹Å“ Ã¬Â¶â€�ÃªÂ°â‚¬ Ã¬Å¾â€˜Ã¬â€”â€¦Ã¬ï¿½Â´ Ã­â€¢â€žÃ¬Å¡â€�Ã­â€¢Â Ã¬â€¹Å“ ÃªÂµÂ¬Ã­Ëœâ€ž
         **/
        function moduleInstall() {
            // action forwardÃ¬â€”ï¿½ Ã«â€œÂ±Ã«Â¡ï¿½ (ÃªÂ´â‚¬Ã«Â¦Â¬Ã¬Å¾ï¿½ Ã«ÂªÂ¨Ã«â€œÅ“Ã¬â€”ï¿½Ã¬â€žÅ“ Ã¬â€šÂ¬Ã¬Å¡Â©Ã­â€¢ËœÃªÂ¸Â° Ã¬Å“â€žÃ­â€¢Â¨)
            $oModuleController = &getController('module');
            $oModuleModel = &getModel('module');

            // 2007. 10. 17 Ã¬â€¢â€žÃ¬ï¿½Â´Ã«â€�â€� Ã­ï¿½Â´Ã«Â¦Â­Ã¬â€¹Å“ Ã«â€šËœÃ­Æ’â‚¬Ã«â€šËœÃ«Å â€� Ã­Å’ï¿½Ã¬â€”â€¦Ã«Â©â€�Ã«â€°Â´Ã¬â€”ï¿½ Ã¬Å¾â€˜Ã¬â€žÂ±ÃªÂ¸â‚¬ Ã«Â³Â´ÃªÂ¸Â° ÃªÂ¸Â°Ã«Å Â¥ Ã¬Â¶â€�ÃªÂ°â‚¬
            $oModuleController->insertTrigger('member.getMemberMenu', 'forum', 'controller', 'triggerMemberMenu', 'after');
            
            $oModuleController->insertTrigger('forum.dispForumCommentSetup', 'comment', 'view', 'triggerDispCommentAdditionSetup', 'before');

            $oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'document', 'view', 'triggerDispDocumentAdditionSetup', 'before');
            $oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'file', 'view', 'triggerDispFileAdditionSetup', 'before');
            $oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'point', 'view', 'triggerDispPointAdditionSetup', 'before');
            $oModuleController->insertTrigger('forum.dispForumAdditionSetup', 'editor', 'view', 'triggerDispEditorAdditionSetup', 'before');
            
            // ÃªÂ¸Â°Ã«Â³Â¸ ÃªÂ²Å’Ã¬â€¹Å“Ã­Å’ï¿½ Ã¬Æ’ï¿½Ã¬â€žÂ±
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
         * @brief Ã¬â€žÂ¤Ã¬Â¹ËœÃªÂ°â‚¬ Ã¬ï¿½Â´Ã¬Æ’ï¿½Ã¬ï¿½Â´ Ã¬â€”â€ Ã«Å â€�Ã¬Â§â‚¬ Ã¬Â²Â´Ã­ï¿½Â¬Ã­â€¢ËœÃ«Å â€� method
         **/
        function checkUpdate() {
            $oModuleModel = &getModel('module');

            // 2007. 10. 17 Ã¬â€¢â€žÃ¬ï¿½Â´Ã«â€�â€� Ã­ï¿½Â´Ã«Â¦Â­Ã¬â€¹Å“ Ã«â€šËœÃ­Æ’â‚¬Ã«â€šËœÃ«Å â€� Ã­Å’ï¿½Ã¬â€”â€¦Ã«Â©â€�Ã«â€°Â´Ã¬â€”ï¿½ Ã¬Å¾â€˜Ã¬â€žÂ±ÃªÂ¸â‚¬ Ã«Â³Â´ÃªÂ¸Â° ÃªÂ¸Â°Ã«Å Â¥ Ã¬Â¶â€�ÃªÂ°â‚¬
            if(!$oModuleModel->getTrigger('member.getMemberMenu', 'forum', 'controller', 'triggerMemberMenu', 'after')) return true;
            
            if(!$oModuleModel->getTrigger('forum.dispForumCommentSetup', 'comment', 'view', 'triggerDispCommentAdditionSetup', 'before')) return true;
            
            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'document', 'view', 'triggerDispDocumentAdditionSetup', 'before')) return true;
            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'file', 'view', 'triggerDispFileAdditionSetup', 'before')) return true;
            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'point', 'view', 'triggerDispPointAdditionSetup', 'before')) return true;
            if(!$oModuleModel->getTrigger('forum.dispForumAdditionSetup', 'editor', 'view', 'triggerDispEditorAdditionSetup', 'before')) return true;
            
            return false;
        }

        /**
         * @brief Ã¬â€”â€¦Ã«ï¿½Â°Ã¬ï¿½Â´Ã­Å Â¸ Ã¬â€¹Â¤Ã­â€“â€°
         **/
        function moduleUpdate() {
            $oModuleModel = &getModel('module');
            $oModuleController = &getController('module');

            // 2007. 10. 17 Ã¬â€¢â€žÃ¬ï¿½Â´Ã«â€�â€� Ã­ï¿½Â´Ã«Â¦Â­Ã¬â€¹Å“ Ã«â€šËœÃ­Æ’â‚¬Ã«â€šËœÃ«Å â€� Ã­Å’ï¿½Ã¬â€”â€¦Ã«Â©â€�Ã«â€°Â´Ã¬â€”ï¿½ Ã¬Å¾â€˜Ã¬â€žÂ±ÃªÂ¸â‚¬ Ã«Â³Â´ÃªÂ¸Â° ÃªÂ¸Â°Ã«Å Â¥ Ã¬Â¶â€�ÃªÂ°â‚¬
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
         * @brief Ã¬Âºï¿½Ã¬â€¹Å“ Ã­Å’Å’Ã¬ï¿½Â¼ Ã¬Å¾Â¬Ã¬Æ’ï¿½Ã¬â€žÂ±
         **/
        function recompileCache() {
        }

    }
?>
