<?php
    /**
     * @class  forumView

     **/

    class forumView extends forum {

        /**

         **/
        function init() {
            /**
             
             **/
            if($this->module_info->list_count) $this->list_count = $this->module_info->list_count;
            if($this->module_info->search_list_count) $this->search_list_count = $this->module_info->search_list_count;
            if($this->module_info->page_count) $this->page_count = $this->module_info->page_count;
            $this->except_notice = $this->module_info->except_notice == 'N' ? false : true;

            /**
             
             **/
            if($this->module_info->consultation == 'Y' && !$this->grant->manager) {
                $this->consultation = true; 
                if(!Context::get('is_logged')) $this->grant->list = $this->grant->write_document = $this->grant->write_comment = $this->grant->view = false;
            } else {
                $this->consultation = false;
            }

            /**
             
             **/
            $template_path = sprintf("%sskins/%s/",$this->module_path, $this->module_info->skin);
            if(!is_dir($template_path)||!$this->module_info->skin) {
                $this->module_info->skin = 'xe_default';
                $template_path = sprintf("%sskins/%s/",$this->module_path, $this->module_info->skin);
            }
            $this->setTemplatePath($template_path);

            /**
             
             **/
            $oDocumentModel = &getModel('document');
            $extra_keys = $oDocumentModel->getExtraKeys($this->module_info->module_srl);
            Context::set('extra_keys', $extra_keys);

            /** 
             
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'input_password.xml');
            Context::addJsFile($this->module_path.'tpl/js/forum.js');
        }

         /**
         * forum home page - redirects to page defined in config
         */
        function dispForumIndex(){
	        $document_srl = Context::get('document_srl');
	        
        	if(!$document_srl){
	        	$this->dispForumCategoryListIndex(); return;
	            }
	        $this->dispForumContent(); 
	        
        }

         /**
         * Retrieves all forum categories and displays them
         */
        function dispForumCategoryListIndex() {                      
        	if(!$this->grant->access || !$this->grant->list) return $this->dispForumMessage('msg_not_permitted');

            $this->dispForumCategoryList();

            $this->setTemplateFile('category_index');
        }
        
        /**
         
         **/
        function dispForumContent() {
            /**
         
             **/
            if(!$this->grant->access || !$this->grant->list) return $this->dispForumMessage('msg_not_permitted');
			
       		$document_srl = Context::get('document_srl');
       		$category = Context::get('category');
       		$search_keyword=Context::get('search_keyword');
	        
        	if(!$category && !$search_keyword){
	        	$this->dispForumCategoryListIndex();
	            }
            /**
         
             **/
            $this->dispForumCategoryList();
            
            $this->dispForumCategoryChildren();
            
            $this->dispBreadcrumbs();

            /**
         
             **/
            // 
            foreach($this->search_option as $opt) $search_option[$opt] = Context::getLang($opt);
            $extra_keys = Context::get('extra_keys');
            if($extra_keys) {
                foreach($extra_keys as $key => $val) {
                    if($val->search == 'Y') $search_option['extra_vars'.$val->idx] = $val->name;
                }
            }
            Context::set('search_option', $search_option);

            // 
            $this->dispForumContentView();

            // 
            $this->dispForumNoticeList();

            // 
            $this->dispForumContentList();

            /** 
             * 
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'search.xml');

            // 
            if($category || $search_keyword || $document_srl) {
            	$this->setTemplateFile('list');
            }
        }

        /**
         
         **/
        function dispForumCategoryList(){
            //
            
                $oDocumentModel = &getModel('document');
                
            	
                $categorylist = $oDocumentModel->getCategoryList($this->module_srl);
                $child_exists=0;
                foreach ($categorylist as $key) {
                	if($key->child_count) $child_exists=1;
                	break;
                }
                foreach ($categorylist as $key) {
                	$key->comment_count=0;
                	$args->category_srl=$key->category_srl;
                	$args->module_srl=$this->module_srl;
                	$args->list_count=$oDocumentModel->getCategoryDocumentCount($this->module_srl,$key->category_srl);
                	$output = $oDocumentModel->getDocumentList($args, $this->except_notice);
                	if($output->data) {
                		foreach ($output->data as $document){
                			$comment_count=$document->getCommentCount();
                			$key->comment_count +=$comment_count;
                		}
                	}
                	$key->style_index=1;
                	$key->child_exists=$child_exists;
                	if($child_exists) {
                		if($key->depth) $key->style_index=0;
                	}
                	else {
                	$key->style_index=0;
                	}
                } 
                
	            
                Context::set('category_list', $categorylist);
        }
        
        
    function dispForumCategoryChildren(){
            //
            
                $oDocumentModel = &getModel('document');
                
            	
                $categorylist = $oDocumentModel->getCategoryList($this->module_srl);
                $category=Context::get('category');
                $aux[]=$category;
                foreach ($categorylist as $key){
                	if(in_array($key->category_srl, $aux)){
                		foreach($key->childs as $child){
                			$aux[]=$child;
                		}
                		$categorychildren[$key->category_srl]=$key;
                	}
                		
                }
                $child_exists=0;
                foreach ($categorychildren as $key) {
                	if($key->child_count) $child_exists=1;
                	break;
                }
                foreach ($categorychildren as $key) {
                	$key->comment_count=0;
                	$args->category_srl=$key->category_srl;
                	$args->module_srl=$this->module_srl;
                	$args->list_count=$oDocumentModel->getCategoryDocumentCount($this->module_srl,$key->category_srl);
                	$output = $oDocumentModel->getDocumentList($args, $this->except_notice);
                	if($output->data) {
                		foreach ($output->data as $document){
                			$comment_count=$document->getCommentCount();
                			$key->comment_count +=$comment_count;
                		}
                	}
                	$key->style_index=1;
                	$key->child_exists=$child_exists;
                	if($child_exists) {
                		if($key->depth) $key->style_index=0;
                	}
                	else {
                	$key->style_index=0;
                	}
                } 
                 
                
	            
                Context::set('category_children', $categorychildren);
        }
        
        
    function dispBreadcrumbs(){
            //
           
            	$category=Context::get('category');
            	$document_srl=Context::get('document_srl');
                $oDocumentModel = &getModel('document');
                $document=$oDocumentModel->getDocument($document_srl);
                if(!$category){
                	$category=$document->variables['category_srl'];
                }
                $categorylist = $oDocumentModel->getCategoryList($this->module_srl);
                $breadcrumbs[$category]=$categorylist[$category];
                $parent_srl=$categorylist[$category]->parent_srl;
                while ($parent_srl){
                	foreach ($categorylist as $key){
                		if($key->category_srl  == $parent_srl){
                			$breadcrumbs[$key->category_srl]=$key;
                			$parent_srl=$key->parent_srl;
                			break;
                		}
                	}
                }
                
	            $array_key = array_keys($breadcrumbs);
		        $array_value = array_values($breadcrumbs);
		        
		        $breadcrumbs_return = array();
		        for($i=1, $size_of_array=sizeof($array_key);$i<=$size_of_array;$i++){
		            $breadcrumbs_return[$array_key[$size_of_array-$i]] = $array_value[$size_of_array-$i];
		        }
                
                Context::set('breadcrumbs', $breadcrumbs_return);
        }

        /**
         
         **/
        function dispForumContentView(){
            //
            $document_srl = Context::get('document_srl');
            $page = Context::get('page');

            //
            $oDocumentModel = &getModel('document');

            /**
             
             **/
            if($document_srl) {
                $oDocument = $oDocumentModel->getDocument($document_srl);

                // 
                if($oDocument->isExists()) {

                    //
                    if($oDocument->get('module_srl')!=$this->module_info->module_srl ) return $this->stop('msg_invalid_request');

                    //
                    if($this->grant->manager) $oDocument->setGrant();

                    //
                    if($this->consultation && !$oDocument->isNotice()) {
                        $logged_info = Context::get('logged_info');
                        if($oDocument->get('member_srl')!=$logged_info->member_srl) $oDocument = $oDocumentModel->getDocument(0);
                    }
                    
                // 
                } else {
                    Context::set('document_srl','',true);
                    $this->alertMessage('msg_not_founded');
                }

            /**
             
             **/
            } else {
                $oDocument = $oDocumentModel->getDocument(0);
            }

            /**
             
             **/
            if($oDocument->isExists()) {
                if(!$this->grant->view && !$oDocument->isGranted()) {
                    $oDocument = $oDocumentModel->getDocument(0);
                    Context::set('document_srl','',true);
                    $this->alertMessage('msg_not_permitted');
                } else {
                    //
                    Context::addBrowserTitle($oDocument->getTitleText());

                    //
                    if(!$oDocument->isSecret() || $oDocument->isGranted()) $oDocument->updateReadedCount();

                    //
                    if($oDocument->isSecret() && !$oDocument->isGranted()) $oDocument->add('content',Context::getLang('thisissecret'));
                }
            }

            //
            $oDocument->add('module_srl', $this->module_srl);
            Context::set('oDocument', $oDocument);

            /** 
             
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'insert_comment.xml');
        
//            return new Object();
        }

        /**
         
         **/
        function dispForumContentFileList(){
            $oDocumentModel = &getModel('document');
            $document_srl = Context::get('document_srl');
            $oDocument = $oDocumentModel->getDocument($document_srl);
            Context::set('file_list',$oDocument->getUploadedFiles());
        }

        /**
         
         **/
        function dispForumContentCommentList(){
            $oDocumentModel = &getModel('document');
            $document_srl = Context::get('document_srl');
            $oDocument = $oDocumentModel->getDocument($document_srl);
            $comment_list = $oDocument->getComments();

            // 
            foreach($comment_list as $key => $val){
                if(!$val->isAccessible()){
                    $val->add('content',Context::getLang('thisissecret'));
                }
            }
            Context::set('comment_list',$comment_list);
        }

        /**
         
         **/
        function dispForumNoticeList(){
            $oDocumentModel = &getModel('document');
            $args->module_srl = $this->module_srl; 
            $args->category_srl = Context::get('category');
            $notice_output = $oDocumentModel->getNoticeList($args);
            Context::set('notice_list', $notice_output->data);
        }

        /**
         
         **/
        function dispForumContentList(){
            // 
            if(!$this->grant->list) {
                Context::set('document_list', array());
                Context::set('total_count', 0);
                Context::set('total_page', 1);
                Context::set('page', 1);
                Context::set('page_navigation', new PageHandler(0,0,1,10));
                return;
            }

            $oDocumentModel = &getModel('document');

            // 
            $args->module_srl = $this->module_srl; 
            $args->page = Context::get('page');
            $args->list_count = $this->list_count; 
            $args->page_count = $this->page_count; 

            // 
            $args->search_target = Context::get('search_target'); 
            $args->search_keyword = Context::get('search_keyword'); 

            // 
            $args->category_srl = Context::get('category'); ///<
			$args->current_category_only=Context::get('current_category_only');
            //
            $args->sort_index = Context::get('sort_index');
            $args->order_type = Context::get('order_type');
            if(!in_array($args->sort_index, $this->order_target)) $args->sort_index = $this->module_info->order_target?$this->module_info->order_target:'list_order';
            if(!in_array($args->order_type, array('asc','desc'))) $args->order_type = $this->module_info->order_type?$this->module_info->order_type:'asc';

            //
            $_get = $_GET;
            if(!$args->page && ($_GET['document_srl'] || $_GET['entry'])) {
                $oDocument = $oDocumentModel->getDocument(Context::get('document_srl'));
                if($oDocument->isExists() && !$oDocument->isNotice()) {
                    $page = $oDocumentModel->getDocumentPage($oDocument, $args);
                    Context::set('page', $page);
                    $args->page = $page;
                }
            }

            //
            //if($args->category_srl || $args->search_keyword) $args->list_count = $this->search_list_count;

            //
            if($this->consultation) {
                $logged_info = Context::get('logged_info');
                $args->member_srl = $logged_info->member_srl;
            }

            //
            $notices_output = $oDocumentModel->getNoticeList($args);
            
            $this->except_notice='Y';
            if($args->search_keyword) {
            	if($args->current_category_only != 'Y') $args->category_srl=0;
            }
            $output = $oDocumentModel->getDocumentList($args, $this->except_notice);
        	if($args->search_keyword) {
            	$total_count=count($notices_output->data)+$output->total_count;
            }else {$total_count=$output->total_count;}
            Context::set('document_list', $output->data);
            Context::set('total_count', $total_count);
            Context::set('total_page', $output->total_page);
            Context::set('page', $output->page);
            Context::set('page_navigation', $output->page_navigation);

            //
            $oforumModel = &getModel('forum');
            Context::set('list_config', $oforumModel->getListConfig($this->module_info->module_srl));
        }

        /**
         
         **/
        function dispForumTagList() {
            //
            if(!$this->grant->list) return $this->dispForumMessage('msg_not_permitted');

            //
            $oTagModel = &getModel('tag');

            $obj->mid = $this->module_info->mid;
            $obj->list_count = 10000;
            $output = $oTagModel->getTagList($obj);

            //
            if(count($output->data)) {
                $numbers = array_keys($output->data);
                shuffle($numbers);

                if(count($output->data)) {
                    foreach($numbers as $k => $v) {
                        $tag_list[] = $output->data[$v];
                    }
                }
            }

            Context::set('tag_list', $tag_list);

            $this->setTemplateFile('tag_list');
        }
        
        /**
         
         **/
        function dispForumWrite() {
            // 
            if(!$this->grant->write_document) return $this->dispForumMessage('msg_not_permitted');

            $this->dispBreadcrumbs();
            
            $oDocumentModel = &getModel('document');

            /**
             * 
             **/
            
                //
                if(Context::get('is_logged')) {
                    $logged_info = Context::get('logged_info');
                    $group_srls = array_keys($logged_info->group_list);
                } else {
                    $group_srls = array();
                }
                $group_srls_count = count($group_srls);

                //
                $normal_category_list = $oDocumentModel->getCategoryList($this->module_srl);
                if(count($normal_category_list)) {
                    foreach($normal_category_list as $category_srl => $category) {
                        $is_granted = true;
                        if($category->group_srls) {
                            $category_group_srls = explode(',',$category->group_srls);
                            $is_granted = false;
                            if(count(array_intersect($group_srls, $category_group_srls))) $is_granted = true; 

                        }
                        if($is_granted) $category_list[$category_srl] = $category;
                    }
                }
                Context::set('category_list', $category_list);
           

            // 
            $document_srl = Context::get('document_srl');
            $oDocument = $oDocumentModel->getDocument(0, $this->grant->manager);
            $oDocument->setDocument($document_srl);
			if($oDocument->get('module_srl') == $oDocument->get('member_srl')) $savedDoc = true;
            $oDocument->add('module_srl', $this->module_srl);

            // 
            if($oDocument->isExists()&&!$oDocument->isGranted()) return $this->setTemplateFile('input_password_form');
            if(!$oDocument->isExists()) {
                $oModuleModel = &getModel('module');
                $point_config = $oModuleModel->getModulePartConfig('point',$this->module_srl);
                $logged_info = Context::get('logged_info');
                $oPointModel = &getModel('point');
                $pointForInsert = $point_config["insert_document"];
                if($pointForInsert < 0) {
                    if( !$logged_info ) return $this->dispForumMessage('msg_not_permitted');
                    else if (($oPointModel->getPoint($logged_info->member_srl) + $pointForInsert )< 0 ) return $this->dispForumMessage('msg_not_enough_point');
                }
            }

            Context::set('document_srl',$document_srl);
            Context::set('oDocument', $oDocument);

            // 
            $oDocumentController = &getController('document');
            $oDocumentController->addXmlJsFilter($this->module_info->module_srl);

            // 
            if($oDocument->isExists() && !$savedDoc) Context::set('extra_keys', $oDocument->getExtraVars());

            /** 
             
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'insert.xml');

            $this->setTemplateFile('write_form');
        }

        /**
         
         **/
        function dispForumDelete() {
            // 
            if(!$this->grant->write_document) return $this->dispForumMessage('msg_not_permitted');

            // 
            $document_srl = Context::get('document_srl');

            // 
            if($document_srl) {
                $oDocumentModel = &getModel('document');
                $oDocument = $oDocumentModel->getDocument($document_srl);
            }

            // 
            if(!$oDocument->isExists()) return $this->dispForumContent();

            // 
            if(!$oDocument->isGranted()) return $this->setTemplateFile('input_password_form');

            Context::set('oDocument',$oDocument);

            /** 
             
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'delete_document.xml');

            $this->setTemplateFile('delete_form');
        }

        /**
         
         **/
        function dispForumWriteComment() {
            $document_srl = Context::get('document_srl');

            //
            if(!$this->grant->write_comment) return $this->dispForumMessage('msg_not_permitted');

            //
            $oDocumentModel = &getModel('document');
            $oDocument = $oDocumentModel->getDocument($document_srl);
            if(!$oDocument->isExists()) return $this->dispForumMessage('msg_invalid_request');

            //
            $oCommentModel = &getModel('comment');
            $oSourceComment = $oComment = $oCommentModel->getComment(0);
            $oComment->add('document_srl', $document_srl);
            $oComment->add('module_srl', $this->module_srl);

            //
            Context::set('oDocument',$oDocument);
            Context::set('oSourceComment',$oSourceComment);
            Context::set('oComment',$oComment);

            /** 
             
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'insert_comment.xml');

            $this->setTemplateFile('comment_form');
        }

        /**
         
         **/
        function dispForumReplyComment() {
            //
            if(!$this->grant->write_comment) return $this->dispForumMessage('msg_not_permitted');

            //
            $parent_srl = Context::get('comment_srl');
            

            //
            if(!$parent_srl) return new Object(-1, 'msg_invalid_request');

            //
            $oCommentModel = &getModel('comment');
            $oSourceComment = $oCommentModel->getComment($parent_srl, $this->grant->manager);

            //
            if(!$oSourceComment->isExists()) return $this->dispForumMessage('msg_invalid_request');
            if(Context::get('document_srl') && $oSourceComment->get('document_srl') != Context::get('document_srl')) return $this->dispForumMessage('msg_invalid_request');

            //
            $oComment = $oCommentModel->getComment();
            $oComment->add('parent_srl', 0);
            $oComment->add('document_srl', $oSourceComment->get('document_srl'));
            $quote = Context::get('quote');
            $lang->cmd_quote=Context::getLang('cmd_quote');
            if($quote=='Y') {
            	$content ="<div class=\"quote\"><div class=\"quoteTitle\">".$lang->cmd_quote."</div>".$oSourceComment->get('content')."</div></br>";
            	
            	$oComment->add('content',$content);
            }

            //
            Context::set('oSourceComment',$oSourceComment);
            Context::set('oComment',$oComment);
            Context::set('module_srl',$this->module_info->module_srl);

            /** 
             *
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'insert_comment.xml');

            $this->setTemplateFile('comment_form');
        }

        /**
         
         **/
        function dispForumModifyComment() {
            //
            if(!$this->grant->write_comment) return $this->dispForumMessage('msg_not_permitted');

            //
            $document_srl = Context::get('document_srl');
            $comment_srl = Context::get('comment_srl');

            //
            if(!$comment_srl) return new Object(-1, 'msg_invalid_request');

            //
            $oCommentModel = &getModel('comment');
            $oComment = $oCommentModel->getComment($comment_srl, $this->grant->manager);

            //
            if(!$oComment->isExists()) return $this->dispForumMessage('msg_invalid_request');

            //
            if(!$oComment->isGranted()) return $this->setTemplateFile('input_password_form');

            //
            Context::set('oSourceComment', $oCommentModel->getComment());
            Context::set('oComment', $oComment);

            /** 
             *
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'insert_comment.xml');

            $this->setTemplateFile('comment_form');
        }

        /**
         * 
         **/
        function dispForumDeleteComment() {
            //
            if(!$this->grant->write_comment) return $this->dispForumMessage('msg_not_permitted');

            //
            $comment_srl = Context::get('comment_srl');

            //
            if($comment_srl) {
                $oCommentModel = &getModel('comment');
                $oComment = $oCommentModel->getComment($comment_srl, $this->grant->manager);
            }

            //
            if(!$oComment->isExists() ) return $this->dispForumContent();

            //
            if(!$oComment->isGranted()) return $this->setTemplateFile('input_password_form');

            Context::set('oComment',$oComment);

            /** 
             *
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'delete_comment.xml');

            $this->setTemplateFile('delete_comment_form');
        }

        /**
         * 
         **/
        function dispForumDeleteTrackback() {
            //
            $trackback_srl = Context::get('trackback_srl');

            //
            $oTrackbackModel = &getModel('trackback');
            $output = $oTrackbackModel->getTrackback($trackback_srl);
            $trackback = $output->data;

            //
            if(!$trackback) return $this->dispForumContent();

            Context::set('trackback',$trackback);

            /** 
             *
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'delete_trackback.xml');

            $this->setTemplateFile('delete_trackback_form');
        }

        /**
         
         **/
        function dispForumMessage($msg_code) {
            $msg = Context::getLang($msg_code);
            if(!$msg) $msg = $msg_code;
            Context::set('message', $msg);
            $this->setTemplateFile('message');
        }

        /**
         
         **/
        function alertMessage($message) {
            $script =  sprintf('<script type="text/javascript"> xAddEventListener(window,"load", function() { alert("%s"); } );</script>', Context::getLang($message));
            Context::addHtmlHeader( $script );
        }

    }
?>
