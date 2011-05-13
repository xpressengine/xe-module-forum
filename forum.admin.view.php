<?php
    /**
     * @class  forumAdminView
     * @author zero (zero@nzeo.com)
     * @brief  forum Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Ëœ admin view class
     **/

    class forumAdminView extends forum {

        /**
         * @brief Ã¬Â´Ë†ÃªÂ¸Â°Ã­â„¢â€�
         *
         * forum Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½â‚¬ Ã¬ï¿½Â¼Ã«Â°Ëœ Ã¬â€šÂ¬Ã¬Å¡Â©ÃªÂ³Â¼ ÃªÂ´â‚¬Ã«Â¦Â¬Ã¬Å¾ï¿½Ã¬Å¡Â©Ã¬Å“Â¼Ã«Â¡Å“ Ã«â€šËœÃ«Ë†â€žÃ¬â€“Â´Ã¬Â§â€žÃ«â€¹Â¤.\n
         **/
        function init() {
            // module_srlÃ¬ï¿½Â´ Ã¬Å¾Ë†Ã¬Å“Â¼Ã«Â©Â´ Ã«Â¯Â¸Ã«Â¦Â¬ Ã¬Â²Â´Ã­ï¿½Â¬Ã­â€¢ËœÃ¬â€”Â¬ Ã¬Â¡Â´Ã¬Å¾Â¬Ã­â€¢ËœÃ«Å â€� Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Â´Ã«Â©Â´ module_info Ã¬â€žÂ¸Ã­Å’â€¦
            $module_srl = Context::get('module_srl');
            if(!$module_srl && $this->module_srl) {
                $module_srl = $this->module_srl;
                Context::set('module_srl', $module_srl);
            }

            // module model ÃªÂ°ï¿½Ã¬Â²Â´ Ã¬Æ’ï¿½Ã¬â€žÂ± 
            $oModuleModel = &getModel('module');

            // module_srlÃ¬ï¿½Â´ Ã«â€žËœÃ¬â€“Â´Ã¬ËœÂ¤Ã«Â©Â´ Ã­â€¢Â´Ã«â€¹Â¹ Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Ëœ Ã¬Â â€¢Ã«Â³Â´Ã«Â¥Â¼ Ã«Â¯Â¸Ã«Â¦Â¬ ÃªÂµÂ¬Ã­â€¢Â´ Ã«â€ â€œÃ¬ï¿½Å’
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

            if($module_info && $module_info->module != 'forum') return $this->stop("msg_invalid_request");

            // Ã«ÂªÂ¨Ã«â€œË† Ã¬Â¹Â´Ã­â€¦Å’ÃªÂ³Â Ã«Â¦Â¬ Ã«ÂªÂ©Ã«Â¡ï¿½Ã¬ï¿½â€ž ÃªÂµÂ¬Ã­â€¢Â¨
            $module_category = $oModuleModel->getModuleCategories();
            Context::set('module_category', $module_category);

            // Ã­â€¦Å“Ã­â€�Å’Ã«Â¦Â¿ ÃªÂ²Â½Ã«Â¡Å“ Ã¬Â§â‚¬Ã¬Â â€¢ (forumÃ¬ï¿½Ëœ ÃªÂ²Â½Ã¬Å¡Â° tplÃ¬â€”ï¿½ ÃªÂ´â‚¬Ã«Â¦Â¬Ã¬Å¾ï¿½Ã¬Å¡Â© Ã­â€¦Å“Ã­â€�Å’Ã«Â¦Â¿ Ã«ÂªÂ¨Ã¬â€¢â€žÃ«â€ â€œÃ¬ï¿½Å’)
            $template_path = sprintf("%stpl/",$this->module_path);
            $this->setTemplatePath($template_path);

            // Ã¬Â â€¢Ã«Â Â¬ Ã¬ËœÂµÃ¬â€¦ËœÃ¬ï¿½â€ž Ã¬â€žÂ¸Ã­Å’â€¦
            foreach($this->order_target as $key) $order_target[$key] = Context::getLang($key);
            $order_target['list_order'] = Context::getLang('document_srl');
            $order_target['update_order'] = Context::getLang('last_update');
            Context::set('order_target', $order_target);
        }

        /**
         * @brief ÃªÂ²Å’Ã¬â€¹Å“Ã­Å’ï¿½ ÃªÂ´â‚¬Ã«Â¦Â¬ Ã«ÂªÂ©Ã«Â¡ï¿½ Ã«Â³Â´Ã¬â€”Â¬Ã¬Â¤Å’
         **/
        function dispForumAdminContent() {
            $output = executeQueryArray('forum.getForumList', $args);
            $display=Context::get('display');
            ModuleModel::syncModuleToSite($output->data);
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
                Context::set('act','dispForumAdminForumInfo');
            	$this->dispForumAdminInsertForum();
            }       
        }
        
        
    	function displayForumAdminContentList() {
        	// ÃƒÂ«Ã¢â‚¬Å“Ã‚Â±ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ÃƒÂ«Ã¯Â¿Â½Ã…â€œ forum ÃƒÂ«Ã‚ÂªÃ‚Â¨ÃƒÂ«Ã¢â‚¬Å“Ã‹â€ ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ«Ã‚Â¶Ã‹â€ ÃƒÂ«Ã…Â¸Ã‚Â¬ÃƒÂ¬Ã¢â€žÂ¢Ã¢â€šÂ¬ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦
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
	        // ÃƒÂ­Ã¢â‚¬Â¦Ã…â€œÃƒÂ­Ã¢â‚¬ï¿½Ã…â€™ÃƒÂ«Ã‚Â¦Ã‚Â¿ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ ÃƒÂ¬Ã¢â‚¬Å“Ã‚Â°ÃƒÂªÃ‚Â¸Ã‚Â° ÃƒÂ¬Ã…â€œÃ¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ context::set
	        Context::set('total_count', $output->total_count);
	        Context::set('total_page', $output->total_page);
	        Context::set('page', $output->page);
	        Context::set('forum_list', $output->data);
	        Context::set('page_navigation', $output->page_navigation);
	
	        // ÃƒÂ­Ã¢â‚¬Â¦Ã…â€œÃƒÂ­Ã¢â‚¬ï¿½Ã…â€™ÃƒÂ«Ã‚Â¦Ã‚Â¿ ÃƒÂ­Ã…â€™Ã…â€™ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¼ ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢
	        $this->setTemplateFile('index');
        }

        /**
         * @brief Ã¬â€žÂ Ã­Æ’ï¿½Ã«ï¿½Å“ ÃªÂ²Å’Ã¬â€¹Å“Ã­Å’ï¿½Ã¬ï¿½Ëœ Ã¬Â â€¢Ã«Â³Â´ Ã¬Â¶Å“Ã«Â Â¥ (Ã«Â°â€�Ã«Â¡Å“ Ã¬Â â€¢Ã«Â³Â´ Ã¬Å¾â€¦Ã«Â Â¥Ã¬Å“Â¼Ã«Â¡Å“ Ã«Â³â‚¬ÃªÂ²Â½)
         **/
        function dispForumAdminForumInfo() {
            $this->dispForumAdminInsertForum();
        }

        /**
         * @brief ÃªÂ²Å’Ã¬â€¹Å“Ã­Å’ï¿½ Ã¬Â¶â€�ÃªÂ°â‚¬ Ã­ï¿½Â¼ Ã¬Â¶Å“Ã«Â Â¥
         **/
        function dispForumAdminInsertForum() {
            if(!in_array($this->module_info->module, array('admin', 'forum','blog','guestbook'))) {
                return $this->alertMessage('msg_invalid_request');
            }

            // Ã¬Å Â¤Ã­â€šÂ¨ Ã«ÂªÂ©Ã«Â¡ï¿½Ã¬ï¿½â€ž ÃªÂµÂ¬Ã­â€¢Â´Ã¬ËœÂ´
            $oModuleModel = &getModel('module');
            $skin_list = $oModuleModel->getSkins($this->module_path);
            Context::set('skin_list',$skin_list);

			$mskin_list = $oModuleModel->getSkins($this->module_path, "m.skins");
			Context::set('mskin_list', $mskin_list);

            // Ã«Â Ë†Ã¬ï¿½Â´Ã¬â€¢â€žÃ¬â€ºÆ’ Ã«ÂªÂ©Ã«Â¡ï¿½Ã¬ï¿½â€ž ÃªÂµÂ¬Ã­â€¢Â´Ã¬ËœÂ´
            $oLayoutModel = &getModel('layout');
            $layout_list = $oLayoutModel->getLayoutList();
            Context::set('layout_list', $layout_list);

			$mobile_layout_list = $oLayoutModel->getLayoutList(0,"M");
			Context::set('mlayout_list', $mobile_layout_list);

            // Ã­â€¦Å“Ã­â€�Å’Ã«Â¦Â¿ Ã­Å’Å’Ã¬ï¿½Â¼ Ã¬Â§â‚¬Ã¬Â â€¢
            $this->setTemplateFile('forum_insert');
        }

        /**
         * @brief ÃªÂ²Å’Ã¬â€¹Å“Ã­Å’ï¿½ Ã¬Â¶â€�ÃªÂ°â‚¬ Ã¬â€žÂ¤Ã¬Â â€¢ Ã«Â³Â´Ã¬â€”Â¬Ã¬Â¤Å’
         * Ã¬Â¶â€�ÃªÂ°â‚¬Ã¬â€žÂ¤Ã¬Â â€¢Ã¬ï¿½â‚¬ Ã¬â€žÅ“Ã«Â¹â€žÃ¬Å Â¤Ã­Ëœâ€¢ Ã«ÂªÂ¨Ã«â€œË†Ã«â€œÂ¤Ã¬â€”ï¿½Ã¬â€žÅ“ Ã«â€¹Â¤Ã«Â¥Â¸ Ã«ÂªÂ¨Ã«â€œË†ÃªÂ³Â¼Ã¬ï¿½Ëœ Ã¬â€”Â°ÃªÂ³â€žÃ«Â¥Â¼ Ã¬Å“â€žÃ­â€¢Â´Ã¬â€žÅ“ Ã¬â€žÂ¤Ã¬Â â€¢Ã­â€¢ËœÃ«Å â€� Ã­Å½ËœÃ¬ï¿½Â´Ã¬Â§â‚¬Ã¬Å¾â€ž
         **/
        function dispForumAdminForumAdditionSetup() {
            // contentÃ«Å â€� Ã«â€¹Â¤Ã«Â¥Â¸ Ã«ÂªÂ¨Ã«â€œË†Ã¬â€”ï¿½Ã¬â€žÅ“ call by referenceÃ«Â¡Å“ Ã«Â°â€ºÃ¬â€¢â€žÃ¬ËœÂ¤ÃªÂ¸Â°Ã¬â€”ï¿½ Ã«Â¯Â¸Ã«Â¦Â¬ Ã«Â³â‚¬Ã¬Ë†Ëœ Ã¬â€žÂ Ã¬â€“Â¸Ã«Â§Å’ Ã­â€¢Â´ Ã«â€ â€œÃ¬ï¿½Å’
            $content = '';

            // Ã¬Â¶â€�ÃªÂ°â‚¬ Ã¬â€žÂ¤Ã¬Â â€¢Ã¬ï¿½â€ž Ã¬Å“â€žÃ­â€¢Å“ Ã­Å Â¸Ã«Â¦Â¬ÃªÂ±Â° Ã­ËœÂ¸Ã¬Â¶Å“ 
            // ÃªÂ²Å’Ã¬â€¹Å“Ã­Å’ï¿½ Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Â´Ã¬Â§â‚¬Ã«Â§Å’ Ã¬Â°Â¨Ã­â€ºâ€ž Ã«â€¹Â¤Ã«Â¥Â¸ Ã«ÂªÂ¨Ã«â€œË†Ã¬â€”ï¿½Ã¬â€žÅ“Ã¬ï¿½Ëœ Ã¬â€šÂ¬Ã¬Å¡Â©Ã«ï¿½â€ž ÃªÂ³Â Ã«Â Â¤Ã­â€¢ËœÃ¬â€”Â¬ trigger Ã¬ï¿½Â´Ã«Â¦â€žÃ¬ï¿½â€ž ÃªÂ³ÂµÃ¬Å¡Â©Ã¬Å“Â¼Ã«Â¡Å“ Ã¬â€šÂ¬Ã¬Å¡Â©Ã­â€¢Â  Ã¬Ë†Ëœ Ã¬Å¾Ë†Ã«ï¿½â€žÃ«Â¡ï¿½ Ã­â€¢ËœÃ¬Ëœâ‚¬Ã¬ï¿½Å’
            $output = ModuleHandler::triggerCall('forum.dispForumAdditionSetup', 'before', $content);
            Context::set('setup_content', $content);

            // Ã­â€¦Å“Ã­â€�Å’Ã«Â¦Â¿ Ã­Å’Å’Ã¬ï¿½Â¼ Ã¬Â§â‚¬Ã¬Â â€¢
            $this->setTemplateFile('addition_setup');
        }

        /**
         * @brief ÃªÂ²Å’Ã¬â€¹Å“Ã­Å’ï¿½ Ã¬â€šÂ­Ã¬Â Å“ Ã­â„¢â€�Ã«Â©Â´ Ã¬Â¶Å“Ã«Â Â¥
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

            // Ã­â€¦Å“Ã­â€�Å’Ã«Â¦Â¿ Ã­Å’Å’Ã¬ï¿½Â¼ Ã¬Â§â‚¬Ã¬Â â€¢
            $this->setTemplateFile('forum_delete');
        }

        /**
         * @brief ÃªÂ²Å’Ã¬â€¹Å“Ã­Å’ï¿½Ã¬ï¿½Ëœ Ã«ÂªÂ©Ã«Â¡ï¿½ Ã¬â€žÂ¤Ã¬Â â€¢
         **/
        function dispForumAdminListSetup() {
            $oforumModel = &getModel('forum');
			
             $content = '';

            // Ã¬Â¶â€�ÃªÂ°â‚¬ Ã¬â€žÂ¤Ã¬Â â€¢Ã¬ï¿½â€ž Ã¬Å“â€žÃ­â€¢Å“ Ã­Å Â¸Ã«Â¦Â¬ÃªÂ±Â° Ã­ËœÂ¸Ã¬Â¶Å“ 
            // ÃªÂ²Å’Ã¬â€¹Å“Ã­Å’ï¿½ Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Â´Ã¬Â§â‚¬Ã«Â§Å’ Ã¬Â°Â¨Ã­â€ºâ€ž Ã«â€¹Â¤Ã«Â¥Â¸ Ã«ÂªÂ¨Ã«â€œË†Ã¬â€”ï¿½Ã¬â€žÅ“Ã¬ï¿½Ëœ Ã¬â€šÂ¬Ã¬Å¡Â©Ã«ï¿½â€ž ÃªÂ³Â Ã«Â Â¤Ã­â€¢ËœÃ¬â€”Â¬ trigger Ã¬ï¿½Â´Ã«Â¦â€žÃ¬ï¿½â€ž ÃªÂ³ÂµÃ¬Å¡Â©Ã¬Å“Â¼Ã«Â¡Å“ Ã¬â€šÂ¬Ã¬Å¡Â©Ã­â€¢Â  Ã¬Ë†Ëœ Ã¬Å¾Ë†Ã«ï¿½â€žÃ«Â¡ï¿½ Ã­â€¢ËœÃ¬Ëœâ‚¬Ã¬ï¿½Å’
            $output = ModuleHandler::triggerCall('forum.dispForumCommentSetup', 'before', $content);
            $lang->comment_count=Context::getLang('comment_count');
            $lang->number_of_posts=Context::getLang('number_of_posts');
            $content=str_replace($lang->comment_count, $lang->number_of_posts, $content);
            Context::set('setup_content', $content);
            // Ã«Å’â‚¬Ã¬Æ’ï¿½ Ã­â€¢Â­Ã«ÂªÂ©Ã¬ï¿½â€ž ÃªÂµÂ¬Ã­â€¢Â¨
            $aux=$oforumModel->getDefaultListConfig($this->module_info->module_srl);
            Context::set('extra_vars', $aux);

            // Ã¬â€žÂ¤Ã¬Â â€¢ Ã­â€¢Â­Ã«ÂªÂ© Ã¬Â¶â€�Ã¬Â¶Å“ (Ã¬â€žÂ¤Ã¬Â â€¢Ã­â€¢Â­Ã«ÂªÂ©Ã¬ï¿½Â´ Ã¬â€”â€ Ã¬ï¿½â€ž ÃªÂ²Â½Ã¬Å¡Â° ÃªÂ¸Â°Ã«Â³Â¸ ÃªÂ°â€™Ã¬ï¿½â€ž Ã¬â€žÂ¸Ã­Å’â€¦)
            $aux2=$oforumModel->getListConfig($this->module_info->module_srl);
            Context::set('list_config', $aux2);

            $this->setTemplateFile('list_setting');
        }

        /**
         * @brief Ã¬Â¹Â´Ã­â€¦Å’ÃªÂ³Â Ã«Â¦Â¬Ã¬ï¿½Ëœ Ã¬Â â€¢Ã«Â³Â´ Ã¬Â¶Å“Ã«Â Â¥
         **/
        function dispForumAdminCategoryInfo() {
            $oDocumentModel = &getModel('document');
            $catgegory_content = $oDocumentModel->getCategoryHTML($this->module_info->module_srl);
            Context::set('category_content', $catgegory_content);

            Context::set('module_info', $this->module_info);
            $this->setTemplateFile('category_list');
        }

        /**
         * @brief ÃªÂ¶Å’Ã­â€¢Å“ Ã«ÂªÂ©Ã«Â¡ï¿½ Ã¬Â¶Å“Ã«Â Â¥
         **/
        function dispForumAdminGrantInfo() {
            // ÃªÂ³ÂµÃ­â€ Âµ Ã«ÂªÂ¨Ã«â€œË† ÃªÂ¶Å’Ã­â€¢Å“ Ã¬â€žÂ¤Ã¬Â â€¢ Ã­Å½ËœÃ¬ï¿½Â´Ã¬Â§â‚¬ Ã­ËœÂ¸Ã¬Â¶Å“
            $oModuleAdminModel = &getAdminModel('module');
            $grant_content = $oModuleAdminModel->getModuleGrantHTML($this->module_info->module_srl, $this->xml_info->grant);
            Context::set('grant_content', $grant_content);

            $this->setTemplateFile('grant_list');
        }

        /**
         * @brief Ã­â„¢â€¢Ã¬Å¾Â¥ Ã«Â³â‚¬Ã¬Ë†Ëœ Ã¬â€žÂ¤Ã¬Â â€¢
         **/
        function dispForumAdminExtraVars() {
            $oDocumentAdminModel = &getModel('document');
            $extra_vars_content = $oDocumentAdminModel->getExtraVarsHTML($this->module_info->module_srl);
            Context::set('extra_vars_content', $extra_vars_content);

            $this->setTemplateFile('extra_vars');
        }

        /**
         * @brief Ã¬Å Â¤Ã­â€šÂ¨ Ã¬Â â€¢Ã«Â³Â´ Ã«Â³Â´Ã¬â€”Â¬Ã¬Â¤Å’
         **/
        function dispForumAdminSkinInfo() {
            // ÃªÂ³ÂµÃ­â€ Âµ Ã«ÂªÂ¨Ã«â€œË† ÃªÂ¶Å’Ã­â€¢Å“ Ã¬â€žÂ¤Ã¬Â â€¢ Ã­Å½ËœÃ¬ï¿½Â´Ã¬Â§â‚¬ Ã­ËœÂ¸Ã¬Â¶Å“
            $oModuleAdminModel = &getAdminModel('module');
            $skin_content = $oModuleAdminModel->getModuleSkinHTML($this->module_info->module_srl);
            Context::set('skin_content', $skin_content);
			
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
            
            $this->setTemplateFile('skin_info');
        }


        /**
         * @brief forum moduleÃ¬Å¡Â© Ã«Â©â€�Ã¬â€¹Å“Ã¬Â§â‚¬ Ã¬Â¶Å“Ã«Â Â¥
         **/
        function alertMessage($message) {
            $script =  sprintf('<script type="text/javascript"> xAddEventListener(window,"load", function() { alert("%s"); } );</script>', Context::getLang($message));
            Context::addHtmlHeader( $script );
        }
    }
?>
