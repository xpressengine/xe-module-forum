<?php
    /**
     * @class  forumAdminView
     
     **/

    class forumAdminView extends forum {

        /**
     
         **/
        function init() {
            // 
            $module_srl = Context::get('module_srl');
            if(!$module_srl && $this->module_srl) {
                $module_srl = $this->module_srl;
                Context::set('module_srl', $module_srl);
            }

            // 
            $oModuleModel = &getModel('module');

            // 
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

            // 
            $module_category = $oModuleModel->getModuleCategories();
            Context::set('module_category', $module_category);

            // 
            $template_path = sprintf("%stpl/",$this->module_path);
            $this->setTemplatePath($template_path);

            // 
            foreach($this->order_target as $key) $order_target[$key] = Context::getLang($key);
            $order_target['list_order'] = Context::getLang('document_srl');
            $order_target['update_order'] = Context::getLang('last_update');
            Context::set('order_target', $order_target);
        }

        /**
         
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
        	//
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
	        // 
	        Context::set('total_count', $output->total_count);
	        Context::set('total_page', $output->total_page);
	        Context::set('page', $output->page);
	        Context::set('forum_list', $output->data);
	        Context::set('page_navigation', $output->page_navigation);
	
	        // 
	        $this->setTemplateFile('index');
        }

        /**
         
         **/
        function dispForumAdminForumInfo() {
            $this->dispForumAdminInsertForum();
        }

        /**
         
         **/
        function dispForumAdminInsertForum() {
            if(!in_array($this->module_info->module, array('admin', 'forum','blog','guestbook'))) {
                return $this->alertMessage('msg_invalid_request');
            }

            //
            $oModuleModel = &getModel('module');
            $skin_list = $oModuleModel->getSkins($this->module_path);
            Context::set('skin_list',$skin_list);

			$mskin_list = $oModuleModel->getSkins($this->module_path, "m.skins");
			Context::set('mskin_list', $mskin_list);

            //
            $oLayoutModel = &getModel('layout');
            $layout_list = $oLayoutModel->getLayoutList();
            Context::set('layout_list', $layout_list);

			$mobile_layout_list = $oLayoutModel->getLayoutList(0,"M");
			Context::set('mlayout_list', $mobile_layout_list);

            //
            $this->setTemplateFile('forum_insert');
        }

        /**
         
         **/
        function dispForumAdminForumAdditionSetup() {
            //
            $content = '';

            //
            //
            $output = ModuleHandler::triggerCall('forum.dispForumAdditionSetup', 'before', $content);
            Context::set('setup_content', $content);

            //
            $this->setTemplateFile('addition_setup');
        }

        /**
         
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

            // 
            $this->setTemplateFile('forum_delete');
        }

        /**
         
         **/
        function dispForumAdminListSetup() {
            $oforumModel = &getModel('forum');
			
             $content = '';

            // 
            // 
            $output = ModuleHandler::triggerCall('forum.dispForumCommentSetup', 'before', $content);
            $lang->comment_count=Context::getLang('comment_count');
            $lang->number_of_posts=Context::getLang('number_of_posts');
            $content=str_replace($lang->comment_count, $lang->number_of_posts, $content);
            Context::set('setup_content', $content);
            // 
            $aux=$oforumModel->getDefaultListConfig($this->module_info->module_srl);
            Context::set('extra_vars', $aux);

            // 
            $aux2=$oforumModel->getListConfig($this->module_info->module_srl);
            Context::set('list_config', $aux2);

            $this->setTemplateFile('list_setting');
        }

        /**
         
         **/
        function dispForumAdminCategoryInfo() {
            $oDocumentModel = &getModel('document');
            $catgegory_content = $oDocumentModel->getCategoryHTML($this->module_info->module_srl);
            Context::set('category_content', $catgegory_content);

            Context::set('module_info', $this->module_info);
            $this->setTemplateFile('category_list');
        }

        /**

         **/
        function dispForumAdminGrantInfo() {
            //
            $oModuleAdminModel = &getAdminModel('module');
            $grant_content = $oModuleAdminModel->getModuleGrantHTML($this->module_info->module_srl, $this->xml_info->grant);
            Context::set('grant_content', $grant_content);

            $this->setTemplateFile('grant_list');
        }

        /**
         
         **/
        function dispForumAdminExtraVars() {
            $oDocumentAdminModel = &getModel('document');
            $extra_vars_content = $oDocumentAdminModel->getExtraVarsHTML($this->module_info->module_srl);
            Context::set('extra_vars_content', $extra_vars_content);

            $this->setTemplateFile('extra_vars');
        }

        /**
         
         **/
        function dispForumAdminSkinInfo() {
            //
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
         
         **/
        function alertMessage($message) {
            $script =  sprintf('<script type="text/javascript"> xAddEventListener(window,"load", function() { alert("%s"); } );</script>', Context::getLang($message));
            Context::addHtmlHeader( $script );
        }
    }
?>
