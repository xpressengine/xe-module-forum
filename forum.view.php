<?php
    /**
     * @class  forumView
     * @author NHN (developers@xpressengine.com)
     * @brief  forum ÃƒÂ«Ã‚ÂªÃ‚Â¨ÃƒÂ«Ã¢â‚¬Å“Ã‹â€ ÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ View class
     **/

    class forumView extends forum {

        /**
         * @brief ÃƒÂ¬Ã‚Â´Ã‹â€ ÃƒÂªÃ‚Â¸Ã‚Â°ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬ï¿½
         * forum ÃƒÂ«Ã‚ÂªÃ‚Â¨ÃƒÂ«Ã¢â‚¬Å“Ã‹â€ ÃƒÂ¬Ã¯Â¿Â½Ã¢â€šÂ¬ ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¼ÃƒÂ«Ã‚Â°Ã‹Å“ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂªÃ‚Â³Ã‚Â¼ ÃƒÂªÃ‚Â´Ã¢â€šÂ¬ÃƒÂ«Ã‚Â¦Ã‚Â¬ÃƒÂ¬Ã…Â¾Ã¯Â¿Â½ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â¡Ã…â€œ ÃƒÂ«Ã¢â‚¬Å¡Ã‹Å“ÃƒÂ«Ã‹â€ Ã¢â‚¬Å¾ÃƒÂ¬Ã¢â‚¬â€œÃ‚Â´ÃƒÂ¬Ã‚Â§Ã¢â‚¬Å¾ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤.\n
         **/
        function init() {
            /**
             * ÃƒÂªÃ‚Â¸Ã‚Â°ÃƒÂ«Ã‚Â³Ã‚Â¸ ÃƒÂ«Ã‚ÂªÃ‚Â¨ÃƒÂ«Ã¢â‚¬Å“Ã‹â€  ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂ«Ã¢â‚¬Å“Ã‚Â¤ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¤ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ (list_count, page_countÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂªÃ‚Â²Ã…â€™ÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œÃƒÂ­Ã…â€™Ã¯Â¿Â½ ÃƒÂ«Ã‚ÂªÃ‚Â¨ÃƒÂ«Ã¢â‚¬Å“Ã‹â€  ÃƒÂ¬Ã‚Â Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¡Ã‚Â© ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂªÃ‚Â³Ã‚Â  ÃƒÂªÃ‚Â¸Ã‚Â°ÃƒÂ«Ã‚Â³Ã‚Â¸ ÃƒÂªÃ‚Â°Ã¢â‚¬â„¢ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ ÃƒÂ«Ã…â€™Ã¢â€šÂ¬ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â²Ã‹Å“ÃƒÂ«Ã‚Â¦Ã‚Â¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â¨)
             **/
            if($this->module_info->list_count) $this->list_count = $this->module_info->list_count;
            if($this->module_info->search_list_count) $this->search_list_count = $this->module_info->search_list_count;
            if($this->module_info->page_count) $this->page_count = $this->module_info->page_count;
            $this->except_notice = $this->module_info->except_notice == 'N' ? false : true;

            /**
             * ÃƒÂ¬Ã†â€™Ã¯Â¿Â½ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â´ ÃƒÂªÃ‚Â¸Ã‚Â°ÃƒÂ«Ã…Â Ã‚Â¥ ÃƒÂ¬Ã‚Â²Ã‚Â´ÃƒÂ­Ã¯Â¿Â½Ã‚Â¬. ÃƒÂ­Ã‹Å“Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¾Ã‚Â¬ ÃƒÂªÃ‚Â²Ã…â€™ÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œÃƒÂ­Ã…â€™Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ ÃƒÂªÃ‚Â´Ã¢â€šÂ¬ÃƒÂ«Ã‚Â¦Ã‚Â¬ÃƒÂ¬Ã…Â¾Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã†â€™Ã¯Â¿Â½ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â´ÃƒÂªÃ‚Â¸Ã‚Â°ÃƒÂ«Ã…Â Ã‚Â¥ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ offÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œÃƒÂ­Ã¢â‚¬Å¡Ã‚Â´
             * ÃƒÂ­Ã‹Å“Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¾Ã‚Â¬ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ¬Ã…Â¾Ã¯Â¿Â½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ ÃƒÂ«Ã‚Â¹Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â¡Ã…â€œÃƒÂªÃ‚Â·Ã‚Â¸ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¸ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ¬Ã…Â¾Ã¯Â¿Â½ÃƒÂ«Ã¯Â¿Â½Ã‚Â¼ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¢â‚¬Å“Ã‚Â°ÃƒÂªÃ‚Â¸Ã‚Â°/ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¢â‚¬Å“Ã‚Â°ÃƒÂªÃ‚Â¸Ã‚Â°/ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂªÃ‚Â¸Ã‚Â°/ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂªÃ‚Â¸Ã‚Â° ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã‚Â Ã…â€œÃƒÂªÃ‚Â±Ã‚Â°ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â¨
             **/
            if($this->module_info->consultation == 'Y' && !$this->grant->manager) {
                $this->consultation = true; 
                if(!Context::get('is_logged')) $this->grant->list = $this->grant->write_document = $this->grant->write_comment = $this->grant->view = false;
            } else {
                $this->consultation = false;
            }

            /**
             * ÃƒÂ¬Ã…Â Ã‚Â¤ÃƒÂ­Ã¢â‚¬Å¡Ã‚Â¨ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ«Ã‚Â¡Ã…â€œÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ«Ã‚Â¯Ã‚Â¸ÃƒÂ«Ã‚Â¦Ã‚Â¬ template_path ÃƒÂ«Ã¯Â¿Â½Ã‚Â¼ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂ¬Ã‹â€ Ã‹Å“ÃƒÂ«Ã‚Â¡Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¤ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â¨
             * ÃƒÂ¬Ã…Â Ã‚Â¤ÃƒÂ­Ã¢â‚¬Å¡Ã‚Â¨ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã‚Â¡Ã‚Â´ÃƒÂ¬Ã…Â¾Ã‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ¬Ã¢â‚¬Â¢Ã…Â ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤ÃƒÂ«Ã‚Â©Ã‚Â´ xe_forumÃƒÂ«Ã‚Â¡Ã…â€œ ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂªÃ‚Â²Ã‚Â½
             **/
            $template_path = sprintf("%sskins/%s/",$this->module_path, $this->module_info->skin);
            if(!is_dir($template_path)||!$this->module_info->skin) {
                $this->module_info->skin = 'xe_default';
                $template_path = sprintf("%sskins/%s/",$this->module_path, $this->module_info->skin);
            }
            $this->setTemplatePath($template_path);

            /**
             * ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬Â¢ÃƒÂ¬Ã…Â¾Ã‚Â¥ ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂ¬Ã‹â€ Ã‹Å“ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œ ÃƒÂ«Ã‚Â¯Ã‚Â¸ÃƒÂ«Ã‚Â¦Ã‚Â¬ ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬Â¢ÃƒÂ¬Ã…Â¾Ã‚Â¥ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂ¬Ã‹â€ Ã‹Å“ÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ ÃƒÂ«Ã…â€™Ã¢â€šÂ¬ÃƒÂ¬Ã†â€™Ã¯Â¿Â½ ÃƒÂ­Ã¢â‚¬Å¡Ã‚Â¤ÃƒÂ«Ã¢â‚¬Å“Ã‚Â¤ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã‚Â¸ÃƒÂ¬Ã¢â€žÂ¢Ã¢â€šÂ¬ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ context set
             **/
            $oDocumentModel = &getModel('document');
            $extra_keys = $oDocumentModel->getExtraKeys($this->module_info->module_srl);
            Context::set('extra_keys', $extra_keys);

            /** 
             * ÃƒÂªÃ‚Â²Ã…â€™ÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œÃƒÂ­Ã…â€™Ã¯Â¿Â½ ÃƒÂ¬Ã‚Â Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â°Ã‹Å“ÃƒÂ¬Ã‚Â Ã¯Â¿Â½ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â¡Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ«Ã¯Â¿Â½Ã‹Å“ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ javascript, JS ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Å¾Ã‚Â° ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬
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
         * @brief ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ«Ã‚Â°Ã¯Â¿Â½ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â ÃƒÂ­Ã†â€™Ã¯Â¿Â½ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã‚Â Ã‚Â¥
         **/
        function dispForumContent() {
            /**
             * ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂªÃ‚Â¸Ã‚Â° ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â²Ã‚Â´ÃƒÂ­Ã¯Â¿Â½Ã‚Â¬ (ÃƒÂ«Ã‚ÂªÃ‚Â¨ÃƒÂ«Ã¢â‚¬Å“Ã‚Â  ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã¢â€šÂ¬ ModuleObjectÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ xml ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂ¬Ã¢â€žÂ¢Ã¢â€šÂ¬ module_infoÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ grant ÃƒÂªÃ‚Â°Ã¢â‚¬â„¢ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ«Ã‚Â¹Ã¢â‚¬Å¾ÃƒÂªÃ‚ÂµÃ¯Â¿Â½ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ¬Ã¢â‚¬â€�Ã‚Â¬ ÃƒÂ«Ã‚Â¯Ã‚Â¸ÃƒÂ«Ã‚Â¦Ã‚Â¬ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¤ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ¬Ã¢â‚¬â€�Ã‚Â¬ ÃƒÂ«Ã¢â‚¬Â Ã¢â‚¬Å“ÃƒÂ¬Ã¯Â¿Â½Ã…â€™)
             **/
            if(!$this->grant->access || !$this->grant->list) return $this->dispForumMessage('msg_not_permitted');
			
       		$document_srl = Context::get('document_srl');
       		$category = Context::get('category');
       		$search_keyword=Context::get('search_keyword');
	        
        	if(!$category && !$search_keyword){
	        	$this->dispForumCategoryListIndex();
	            }
            /**
             * ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬Â¢ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¸ÃƒÂ­Ã¢â‚¬ÂºÃ¢â‚¬Å¾ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œ ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬ ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ¬Ã¢â€žÂ¢Ã¢â€šÂ¬ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ContextÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦
             **/
            $this->dispForumCategoryList();
            
            $this->dispForumCategoryChildren();
            
            $this->dispBreadcrumbs();

            /**
             * ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ«Ã¢â‚¬Â¦Ã‚Â¸ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã¯Â¿Â½Ã‚Â ÃƒÂ«Ã¢â‚¬Â¢Ã…â€™ ÃƒÂªÃ‚Â°Ã¢â€žÂ¢ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ«Ã¢â‚¬Å¡Ã‹Å“ÃƒÂ¬Ã‹Å“Ã‚Â¤ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂªÃ‚Â²Ã¢â€šÂ¬ÃƒÂ¬Ã†â€™Ã¢â‚¬Â° ÃƒÂ¬Ã‹Å“Ã‚ÂµÃƒÂ¬Ã¢â‚¬Â¦Ã‹Å“ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â¦Ã‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ¬Ã¢â‚¬â€�Ã‚Â¬ ÃƒÂ¬Ã…Â Ã‚Â¤ÃƒÂ­Ã¢â‚¬Å¡Ã‚Â¨ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å“Ã‚Â¸ ÃƒÂ¬Ã‹â€ Ã‹Å“ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ«Ã¯Â¿Â½Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ context set
             * ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬Â¢ÃƒÂ¬Ã…Â¾Ã‚Â¥ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂ¬Ã‹â€ Ã‹Å“ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂªÃ‚Â²Ã¢â€šÂ¬ÃƒÂ¬Ã†â€™Ã¢â‚¬Â° ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â ÃƒÂ­Ã†â€™Ã¯Â¿Â½ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â­ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã‚Â­ÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œ ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬
             **/
            // ÃƒÂ­Ã¢â‚¬Â¦Ã…â€œÃƒÂ­Ã¢â‚¬ï¿½Ã…â€™ÃƒÂ«Ã‚Â¦Ã‚Â¿ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â  ÃƒÂªÃ‚Â²Ã¢â€šÂ¬ÃƒÂ¬Ã†â€™Ã¢â‚¬Â°ÃƒÂ¬Ã‹Å“Ã‚ÂµÃƒÂ¬Ã¢â‚¬Â¦Ã‹Å“ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦ (ÃƒÂªÃ‚Â²Ã¢â€šÂ¬ÃƒÂ¬Ã†â€™Ã¢â‚¬Â°ÃƒÂ¬Ã‹Å“Ã‚ÂµÃƒÂ¬Ã¢â‚¬Â¦Ã‹Å“ keyÃƒÂªÃ‚Â°Ã¢â‚¬â„¢ÃƒÂ¬Ã¯Â¿Â½Ã¢â€šÂ¬ ÃƒÂ«Ã‚Â¯Ã‚Â¸ÃƒÂ«Ã‚Â¦Ã‚Â¬ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â ÃƒÂ¬Ã¢â‚¬â€œÃ‚Â¸ÃƒÂ«Ã¯Â¿Â½Ã‹Å“ÃƒÂ¬Ã¢â‚¬â€œÃ‚Â´ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ÃƒÂ«Ã¯Â¿Â½Ã‚Â° ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ ÃƒÂ«Ã…â€™Ã¢â€šÂ¬ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã¢â‚¬â€œÃ‚Â¸ÃƒÂ¬Ã¢â‚¬â€œÃ‚Â´ÃƒÂ«Ã‚Â³Ã¢â‚¬Å¾ ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â¨)
            foreach($this->search_option as $opt) $search_option[$opt] = Context::getLang($opt);
            $extra_keys = Context::get('extra_keys');
            if($extra_keys) {
                foreach($extra_keys as $key => $val) {
                    if($val->search == 'Y') $search_option['extra_vars'.$val->idx] = $val->name;
                }
            }
            Context::set('search_option', $search_option);

            // ÃƒÂªÃ‚Â²Ã…â€™ÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã‚Â¸ÃƒÂ¬Ã‹Å“Ã‚Â´
            $this->dispForumContentView();

            // ÃƒÂªÃ‚Â³Ã‚ÂµÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â­ ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ context set (ÃƒÂªÃ‚Â³Ã‚ÂµÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â­ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ«Ã‚Â§Ã‚Â¤ÃƒÂ­Ã…Â½Ã‹Å“ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ¬Ã‚Â Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã‚Â¼ ÃƒÂ¬Ã†â€™Ã¯Â¿Â½ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¨ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ ÃƒÂ¬Ã…â€œÃ¢â‚¬Å¾ÃƒÂ¬Ã‚Â¹Ã‹Å“ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂªÃ‚Â¸Ã‚Â° ÃƒÂ¬Ã…â€œÃ¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ)
            $this->dispForumNoticeList();

            // ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½
            $this->dispForumContentList();

            /** 
             * ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ«Ã¯Â¿Â½Ã‹Å“ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ javascript ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Å¾Ã‚Â° ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'search.xml');

            // template_fileÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ list.htmlÃƒÂ«Ã‚Â¡Ã…â€œ ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢
            if($category || $search_keyword || $document_srl) {
            	$this->setTemplateFile('list');
            }
        }

        /**
         * @brief ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬ ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â­ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ¬Ã¢â€žÂ¢Ã¢â€šÂ¬ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ¬Ã…Â Ã‚Â¤ÃƒÂ­Ã¢â‚¬Å¡Ã‚Â¨ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â  ÃƒÂ¬Ã‹â€ Ã‹Å“ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ«Ã¯Â¿Â½Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦
         **/
        function dispForumCategoryList(){
            // ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â ÃƒÂ«Ã¢â‚¬Â¢Ã…â€™ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ«Ã‚Â§Ã…â€™ ÃƒÂ«Ã¯Â¿Â½Ã‚Â°ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂ­Ã¢â‚¬Å¾Ã‚Â°ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂ¬Ã‚Â¶Ã…â€œ
            
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
            // ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â ÃƒÂ«Ã¢â‚¬Â¢Ã…â€™ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ«Ã‚Â§Ã…â€™ ÃƒÂ«Ã¯Â¿Â½Ã‚Â°ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂ­Ã¢â‚¬Å¾Ã‚Â°ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂ¬Ã‚Â¶Ã…â€œ
            
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
            // ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â ÃƒÂ«Ã¢â‚¬Â¢Ã…â€™ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ«Ã‚Â§Ã…â€™ ÃƒÂ«Ã¯Â¿Â½Ã‚Â°ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂ­Ã¢â‚¬Å¾Ã‚Â°ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂ¬Ã‚Â¶Ã…â€œ
           
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
         * @brief ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â ÃƒÂ­Ã†â€™Ã¯Â¿Â½ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂªÃ‚Â²Ã…â€™ÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã‚Â¸ÃƒÂ¬Ã¢â€žÂ¢Ã¢â€šÂ¬ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ¬Ã…Â Ã‚Â¤ÃƒÂ­Ã¢â‚¬Å¡Ã‚Â¨ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã¯Â¿Â½Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦
         **/
        function dispForumContentView(){
            // ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ¬Ã‚Â²Ã‚Â­ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂ¬Ã‹â€ Ã‹Å“ ÃƒÂªÃ‚Â°Ã¢â‚¬â„¢ÃƒÂ«Ã¢â‚¬Å“Ã‚Â¤ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â¦Ã‚Â¬
            $document_srl = Context::get('document_srl');
            $page = Context::get('page');

            // document model ÃƒÂªÃ‚Â°Ã¯Â¿Â½ÃƒÂ¬Ã‚Â²Ã‚Â´ ÃƒÂ¬Ã†â€™Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â± 
            $oDocumentModel = &getModel('document');

            /**
             * ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ¬Ã‚Â²Ã‚Â­ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂ«Ã‚Â¬Ã‚Â¸ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ«Ã‚Â²Ã‹â€ ÃƒÂ­Ã‹Å“Ã‚Â¸ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ«Ã‚Â¬Ã‚Â¸ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â¨
             **/
            if($document_srl) {
                $oDocument = $oDocumentModel->getDocument($document_srl);

                // ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¹ ÃƒÂ«Ã‚Â¬Ã‚Â¸ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œÃƒÂªÃ‚Â°Ã¢â€šÂ¬ ÃƒÂ¬Ã‚Â¡Ã‚Â´ÃƒÂ¬Ã…Â¾Ã‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â  ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â²Ã‹Å“ÃƒÂ«Ã‚Â¦Ã‚Â¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â¨
                if($oDocument->isExists()) {

                    // ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂªÃ‚Â³Ã‚Â¼ ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ¬Ã‚Â²Ã‚Â­ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂ«Ã‚ÂªÃ‚Â¨ÃƒÂ«Ã¢â‚¬Å“Ã‹â€ ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤ÃƒÂ«Ã‚Â¥Ã‚Â´ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã‹Å“Ã‚Â¤ÃƒÂ«Ã‚Â¥Ã‹Å“ ÃƒÂ­Ã¢â‚¬ËœÃ…â€œÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œ
                    if($oDocument->get('module_srl')!=$this->module_info->module_srl ) return $this->stop('msg_invalid_request');

                    // ÃƒÂªÃ‚Â´Ã¢â€šÂ¬ÃƒÂ«Ã‚Â¦Ã‚Â¬ ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ«Ã‚Â¶Ã¢â€šÂ¬ÃƒÂ¬Ã¢â‚¬â€�Ã‚Â¬
                    if($this->grant->manager) $oDocument->setGrant();

                    // ÃƒÂ¬Ã†â€™Ã¯Â¿Â½ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â´ÃƒÂªÃ‚Â¸Ã‚Â°ÃƒÂ«Ã…Â Ã‚Â¥ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ«Ã¯Â¿Â½Ã‹Å“ÃƒÂªÃ‚Â³Ã‚Â  ÃƒÂªÃ‚Â³Ã‚ÂµÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â­ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ«Ã¢â‚¬Â¹Ã‹â€ ÃƒÂªÃ‚Â³Ã‚Â  ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ¬Ã…Â¾Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ«Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ«Ã¢â‚¬Â¹Ã‹â€ ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ«Ã‚Â¬Ã‚Â´ÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œ
                    if($this->consultation && !$oDocument->isNotice()) {
                        $logged_info = Context::get('logged_info');
                        if($oDocument->get('member_srl')!=$logged_info->member_srl) $oDocument = $oDocumentModel->getDocument(0);
                    }
                    
                // ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ¬Ã‚Â²Ã‚Â­ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂ«Ã‚Â¬Ã‚Â¸ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œÃƒÂ«Ã‚Â²Ã‹â€ ÃƒÂ­Ã‹Å“Ã‚Â¸ÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ ÃƒÂ«Ã‚Â¬Ã‚Â¸ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œÃƒÂªÃ‚Â°Ã¢â€šÂ¬ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â©Ã‚Â´ document_srl null ÃƒÂ¬Ã‚Â²Ã‹Å“ÃƒÂ«Ã‚Â¦Ã‚Â¬ ÃƒÂ«Ã‚Â°Ã¯Â¿Â½ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂªÃ‚Â³Ã‚Â  ÃƒÂ«Ã‚Â©Ã¢â‚¬ï¿½ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã‚Â Ã‚Â¥
                } else {
                    Context::set('document_srl','',true);
                    $this->alertMessage('msg_not_founded');
                }

            /**
             * ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ¬Ã‚Â²Ã‚Â­ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂ«Ã‚Â¬Ã‚Â¸ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ«Ã‚Â²Ã‹â€ ÃƒÂ­Ã‹Å“Ã‚Â¸ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ ÃƒÂ¬Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ¬Ã‹Å“Ã‹â€  ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ«Ã‚Â¹Ã‹â€  ÃƒÂ«Ã‚Â¬Ã‚Â¸ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂªÃ‚Â°Ã¯Â¿Â½ÃƒÂ¬Ã‚Â²Ã‚Â´ ÃƒÂ¬Ã†â€™Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â±
             **/
            } else {
                $oDocument = $oDocumentModel->getDocument(0);
            }

            /**
             * ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂªÃ‚Â¸Ã‚Â° ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã‚Â²Ã‚Â´ÃƒÂ­Ã¯Â¿Â½Ã‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã‹Å“Ã‚Â¤ÃƒÂ«Ã‚Â¥Ã‹Å“ ÃƒÂ«Ã‚Â©Ã¢â‚¬ï¿½ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã‚Â Ã‚Â¥ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã¯Â¿Â½Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ¬Ã‚Â²Ã‹Å“ÃƒÂ«Ã‚Â¦Ã‚Â¬
             **/
            if($oDocument->isExists()) {
                if(!$this->grant->view && !$oDocument->isGranted()) {
                    $oDocument = $oDocumentModel->getDocument(0);
                    Context::set('document_srl','',true);
                    $this->alertMessage('msg_not_permitted');
                } else {
                    // ÃƒÂ«Ã‚Â¸Ã…â€™ÃƒÂ«Ã¯Â¿Â½Ã‚Â¼ÃƒÂ¬Ã…Â¡Ã‚Â°ÃƒÂ¬Ã‚Â Ã¢â€šÂ¬ ÃƒÂ­Ã†â€™Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¹Ã¢â€šÂ¬ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ ÃƒÂ¬Ã‚Â Ã…â€œÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬
                    Context::addBrowserTitle($oDocument->getTitleText());

                    // ÃƒÂ¬Ã‚Â¡Ã‚Â°ÃƒÂ­Ã…Â¡Ã…â€™ÃƒÂ¬Ã‹â€ Ã‹Å“ ÃƒÂ¬Ã‚Â¦Ã¯Â¿Â½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ (ÃƒÂ«Ã‚Â¹Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â°Ã¢â€šÂ¬ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¼ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â²Ã‚Â´ÃƒÂ­Ã¯Â¿Â½Ã‚Â¬)
                    if(!$oDocument->isSecret() || $oDocument->isGranted()) $oDocument->updateReadedCount();

                    // ÃƒÂ«Ã‚Â¹Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â°Ã¢â€šÂ¬ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¼ÃƒÂ«Ã¢â‚¬Â¢Ã…â€™ ÃƒÂ¬Ã‚Â»Ã‚Â¨ÃƒÂ­Ã¢â‚¬Â¦Ã¯Â¿Â½ÃƒÂ¬Ã‚Â¸Ã‚Â ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂ¬Ã¢â‚¬â€�Ã‚Â¬ÃƒÂ¬Ã‚Â£Ã‚Â¼ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ«Ã‚Â§Ã¯Â¿Â½ÃƒÂ¬Ã…Â¾Ã¯Â¿Â½.
                    if($oDocument->isSecret() && !$oDocument->isGranted()) $oDocument->add('content',Context::getLang('thisissecret'));
                }
            }

            // ÃƒÂ¬Ã…Â Ã‚Â¤ÃƒÂ­Ã¢â‚¬Å¡Ã‚Â¨ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â  oDocument ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂ¬Ã‹â€ Ã‹Å“ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦
            $oDocument->add('module_srl', $this->module_srl);
            Context::set('oDocument', $oDocument);

            /** 
             * ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ«Ã¯Â¿Â½Ã‹Å“ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ javascript ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Å¾Ã‚Â° ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'insert_comment.xml');
        
//            return new Object();
        }

        /**
         * @brief ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â ÃƒÂ­Ã†â€™Ã¯Â¿Â½ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂ¬Ã‚Â²Ã‚Â¨ÃƒÂ«Ã‚Â¶Ã¢â€šÂ¬ÃƒÂ­Ã…â€™Ã…â€™ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¼ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ ÃƒÂ«Ã…â€™Ã¢â€šÂ¬ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂ«Ã‚Â¥Ã‚Â¼ API ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â  ÃƒÂ¬Ã‹â€ Ã‹Å“ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ«Ã¯Â¿Â½Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦
         **/
        function dispForumContentFileList(){
            $oDocumentModel = &getModel('document');
            $document_srl = Context::get('document_srl');
            $oDocument = $oDocumentModel->getDocument($document_srl);
            Context::set('file_list',$oDocument->getUploadedFiles());
        }

        /**
         * @brief ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â ÃƒÂ­Ã†â€™Ã¯Â¿Â½ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂªÃ‚Â·Ã‚Â¸ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ API ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â  ÃƒÂ¬Ã‹â€ Ã‹Å“ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ«Ã¯Â¿Â½Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦
         **/
        function dispForumContentCommentList(){
            $oDocumentModel = &getModel('document');
            $document_srl = Context::get('document_srl');
            $oDocument = $oDocumentModel->getDocument($document_srl);
            $comment_list = $oDocument->getComments();

            // ÃƒÂ«Ã‚Â¹Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â°Ã¢â€šÂ¬ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¼ÃƒÂ«Ã¢â‚¬Â¢Ã…â€™ ÃƒÂ¬Ã‚Â»Ã‚Â¨ÃƒÂ­Ã¢â‚¬Â¦Ã¯Â¿Â½ÃƒÂ¬Ã‚Â¸Ã‚Â ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂ¬Ã¢â‚¬â€�Ã‚Â¬ÃƒÂ¬Ã‚Â£Ã‚Â¼ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ«Ã‚Â§Ã¯Â¿Â½ÃƒÂ¬Ã…Â¾Ã¯Â¿Â½.
            foreach($comment_list as $key => $val){
                if(!$val->isAccessible()){
                    $val->add('content',Context::getLang('thisissecret'));
                }
            }
            Context::set('comment_list',$comment_list);
        }

        /**
         * @brief ÃƒÂªÃ‚Â³Ã‚ÂµÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â­ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° APIÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â  ÃƒÂ¬Ã‹â€ Ã‹Å“ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂªÃ‚Â²Ã…â€™ ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂªÃ‚Â¸Ã‚Â° ÃƒÂ¬Ã…â€œÃ¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦
         **/
        function dispForumNoticeList(){
            $oDocumentModel = &getModel('document');
            $args->module_srl = $this->module_srl; 
            $args->category_srl = Context::get('category');
            $notice_output = $oDocumentModel->getNoticeList($args);
            Context::set('notice_list', $notice_output->data);
        }

        /**
         * @brief ÃƒÂªÃ‚Â²Ã…â€™ÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½
         **/
        function dispForumContentList(){
            // ÃƒÂ«Ã‚Â§Ã…â€™ÃƒÂ¬Ã¢â‚¬Â¢Ã‚Â½ ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂªÃ‚Â¸Ã‚Â° ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂ¬Ã¢â‚¬â€�Ã‚Â¬ÃƒÂ¬Ã‚Â£Ã‚Â¼ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ¬Ã¢â‚¬Â¢Ã…Â ÃƒÂ¬Ã¯Â¿Â½Ã…â€™
            if(!$this->grant->list) {
                Context::set('document_list', array());
                Context::set('total_count', 0);
                Context::set('total_page', 1);
                Context::set('page', 1);
                Context::set('page_navigation', new PageHandler(0,0,1,10));
                return;
            }

            $oDocumentModel = &getModel('document');

            // ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂªÃ‚Â¸Ã‚Â° ÃƒÂ¬Ã…â€œÃ¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ«Ã…â€™Ã¢â€šÂ¬ÃƒÂ¬Ã†â€™Ã¯Â¿Â½ ÃƒÂ«Ã‚ÂªÃ‚Â¨ÃƒÂ«Ã¢â‚¬Å“Ã‹â€ / ÃƒÂ­Ã…Â½Ã‹Å“ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ¬Ã‹â€ Ã‹Å“/ ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ¬Ã‹â€ Ã‹Å“/ ÃƒÂ­Ã…Â½Ã‹Å“ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ¬Ã‹â€ Ã‹Å“ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ ÃƒÂ«Ã…â€™Ã¢â€šÂ¬ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‹Å“Ã‚ÂµÃƒÂ¬Ã¢â‚¬Â¦Ã‹Å“ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¤ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢
            $args->module_srl = $this->module_srl; 
            $args->page = Context::get('page');
            $args->list_count = $this->list_count; 
            $args->page_count = $this->page_count; 

            // ÃƒÂªÃ‚Â²Ã¢â€šÂ¬ÃƒÂ¬Ã†â€™Ã¢â‚¬Â°ÃƒÂªÃ‚Â³Ã‚Â¼ ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â Ã‚Â¬ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã…â€œÃ¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂ¬Ã‹â€ Ã‹Å“ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¤ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢
            $args->search_target = Context::get('search_target'); 
            $args->search_keyword = Context::get('search_keyword'); 

            // ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬ ÃƒÂªÃ‚Â°Ã¢â‚¬â„¢ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ«Ã‚Â°Ã¢â‚¬ÂºÃƒÂ¬Ã¯Â¿Â½Ã…â€™
            $args->category_srl = Context::get('category'); ///< ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â ÃƒÂ­Ã†â€™Ã¯Â¿Â½ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬
			$args->current_category_only=Context::get('current_category_only');
            // ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â Ã‚Â¬ÃƒÂªÃ‚Â°Ã¢â‚¬â„¢ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã…Â Ã‚Â¤ÃƒÂ­Ã¢â‚¬Å¡Ã‚Â¨ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¤ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â Ã‚Â¬ ÃƒÂªÃ‚Â°Ã¢â‚¬â„¢ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â¨
            $args->sort_index = Context::get('sort_index');
            $args->order_type = Context::get('order_type');
            if(!in_array($args->sort_index, $this->order_target)) $args->sort_index = $this->module_info->order_target?$this->module_info->order_target:'list_order';
            if(!in_array($args->order_type, array('asc','desc'))) $args->order_type = $this->module_info->order_type?$this->module_info->order_type:'asc';

            // ÃƒÂ­Ã…Â Ã‚Â¹ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ ÃƒÂ«Ã‚Â¬Ã‚Â¸ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ permalinkÃƒÂ«Ã‚Â¡Ã…â€œ ÃƒÂ¬Ã‚Â§Ã¯Â¿Â½ÃƒÂ¬Ã‚Â Ã¢â‚¬Ëœ ÃƒÂ¬Ã‚Â Ã¢â‚¬ËœÃƒÂ¬Ã¢â‚¬Â Ã¯Â¿Â½ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â  ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° pageÃƒÂªÃ‚Â°Ã¢â‚¬â„¢ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã‚Â§Ã¯Â¿Â½ÃƒÂ¬Ã‚Â Ã¢â‚¬Ëœ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â¨
            $_get = $_GET;
            if(!$args->page && ($_GET['document_srl'] || $_GET['entry'])) {
                $oDocument = $oDocumentModel->getDocument(Context::get('document_srl'));
                if($oDocument->isExists() && !$oDocument->isNotice()) {
                    $page = $oDocumentModel->getDocumentPage($oDocument, $args);
                    Context::set('page', $page);
                    $args->page = $page;
                }
            }

            // ÃƒÂ«Ã‚Â§Ã…â€™ÃƒÂ¬Ã¢â‚¬Â¢Ã‚Â½ ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂªÃ‚Â±Ã‚Â°ÃƒÂ«Ã¢â‚¬Å¡Ã‹Å“ ÃƒÂªÃ‚Â²Ã¢â€šÂ¬ÃƒÂ¬Ã†â€™Ã¢â‚¬Â°ÃƒÂ¬Ã¢â‚¬â€œÃ‚Â´ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â©Ã‚Â´list_countÃƒÂ«Ã‚Â¥Ã‚Â¼ search_list_count ÃƒÂ«Ã‚Â¡Ã…â€œ ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂ¬Ã…Â¡Ã‚Â©
            //if($args->category_srl || $args->search_keyword) $args->list_count = $this->search_list_count;

            // ÃƒÂ¬Ã†â€™Ã¯Â¿Â½ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â´ ÃƒÂªÃ‚Â¸Ã‚Â°ÃƒÂ«Ã…Â Ã‚Â¥ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ onÃƒÂ«Ã¯Â¿Â½Ã‹Å“ÃƒÂ¬Ã¢â‚¬â€œÃ‚Â´ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ­Ã‹Å“Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¾Ã‚Â¬ ÃƒÂ«Ã‚Â¡Ã…â€œÃƒÂªÃ‚Â·Ã‚Â¸ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¸ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ¬Ã…Â¾Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ«Ã‚Â§Ã…â€™ ÃƒÂ«Ã¢â‚¬Å¡Ã‹Å“ÃƒÂ­Ã†â€™Ã¢â€šÂ¬ÃƒÂ«Ã¢â‚¬Å¡Ã‹Å“ÃƒÂ«Ã¯Â¿Â½Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ¬Ã‹Å“Ã‚ÂµÃƒÂ¬Ã¢â‚¬Â¦Ã‹Å“ ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂªÃ‚Â²Ã‚Â½
            if($this->consultation) {
                $logged_info = Context::get('logged_info');
                $args->member_srl = $logged_info->member_srl;
            }

            // ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¼ÃƒÂ«Ã‚Â°Ã‹Å“ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ context set
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

            // ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¤ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂªÃ‚Â°Ã¢â‚¬â„¢ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦
            $oforumModel = &getModel('forum');
            Context::set('list_config', $oforumModel->getListConfig($this->module_info->module_srl));
        }

        /**
         * @brief ÃƒÂ­Ã†â€™Ã…â€œÃƒÂªÃ‚Â·Ã‚Â¸ ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ«Ã‚ÂªÃ‚Â¨ÃƒÂ«Ã¢â‚¬ËœÃ¯Â¿Â½ ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂªÃ‚Â¸Ã‚Â°
         **/
        function dispForumTagList() {
            // ÃƒÂ«Ã‚Â§Ã…â€™ÃƒÂ¬Ã¢â‚¬Â¢Ã‚Â½ ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂªÃ‚Â¸Ã‚Â° ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ¬Ã‚Â¡Ã‚Â°ÃƒÂ¬Ã‚Â¹Ã‹Å“ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂ­Ã†â€™Ã…â€œÃƒÂªÃ‚Â·Ã‚Â¸ ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ÃƒÂ«Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂ¬Ã¢â‚¬â€�Ã‚Â¬ÃƒÂ¬Ã‚Â£Ã‚Â¼ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ¬Ã¢â‚¬Â¢Ã…Â ÃƒÂ¬Ã¯Â¿Â½Ã…â€™
            if(!$this->grant->list) return $this->dispForumMessage('msg_not_permitted');

            // ÃƒÂ­Ã†â€™Ã…â€œÃƒÂªÃ‚Â·Ã‚Â¸ ÃƒÂ«Ã‚ÂªÃ‚Â¨ÃƒÂ«Ã¯Â¿Â½Ã‚Â¸ ÃƒÂªÃ‚Â°Ã¯Â¿Â½ÃƒÂ¬Ã‚Â²Ã‚Â´ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ­Ã†â€™Ã…â€œÃƒÂªÃ‚Â·Ã‚Â¸ ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ¬Ã‹Å“Ã‚Â´
            $oTagModel = &getModel('tag');

            $obj->mid = $this->module_info->mid;
            $obj->list_count = 10000;
            $output = $oTagModel->getTagList($obj);

            // ÃƒÂ«Ã¢â‚¬Å¡Ã‚Â´ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ«Ã…Â¾Ã…â€œÃƒÂ«Ã¯Â¿Â½Ã‚Â¤ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â¡Ã…â€œ ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â Ã‚Â¬
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
         * @brief ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ ÃƒÂ¬Ã…Â¾Ã¢â‚¬ËœÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â± ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬ï¿½ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã‚Â Ã‚Â¥
         **/
        function dispForumWrite() {
            // ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â²Ã‚Â´ÃƒÂ­Ã¯Â¿Â½Ã‚Â¬
            if(!$this->grant->write_document) return $this->dispForumMessage('msg_not_permitted');

            $this->dispBreadcrumbs();
            
            $oDocumentModel = &getModel('document');

            /**
             * ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬Â¢ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¸ÃƒÂ­Ã¢â‚¬ÂºÃ¢â‚¬Å¾ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ¬Ã¢â‚¬Â¹Ã…â€œ ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬ ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ¬Ã¢â€žÂ¢Ã¢â€šÂ¬ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ContextÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦, ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ«Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â¨ÃƒÂªÃ‚Â»Ã‹Å“ ÃƒÂ¬Ã‚Â²Ã‚Â´ÃƒÂ­Ã¯Â¿Â½Ã‚Â¬
             **/
            
                // ÃƒÂ«Ã‚Â¡Ã…â€œÃƒÂªÃ‚Â·Ã‚Â¸ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¸ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ¬Ã…Â¾Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ ÃƒÂªÃ‚Â·Ã‚Â¸ÃƒÂ«Ã‚Â£Ã‚Â¹ ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â¨
                if(Context::get('is_logged')) {
                    $logged_info = Context::get('logged_info');
                    $group_srls = array_keys($logged_info->group_list);
                } else {
                    $group_srls = array();
                }
                $group_srls_count = count($group_srls);

                // ÃƒÂ¬Ã‚Â¹Ã‚Â´ÃƒÂ­Ã¢â‚¬Â¦Ã…â€™ÃƒÂªÃ‚Â³Ã‚Â ÃƒÂ«Ã‚Â¦Ã‚Â¬ ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂªÃ‚Â³Ã‚Â  ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã‚Â²Ã‚Â´ÃƒÂ­Ã¯Â¿Â½Ã‚Â¬
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
           

            // GET parameterÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ document_srlÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã‚Â¸ÃƒÂ¬Ã‹Å“Ã‚Â´
            $document_srl = Context::get('document_srl');
            $oDocument = $oDocumentModel->getDocument(0, $this->grant->manager);
            $oDocument->setDocument($document_srl);
			if($oDocument->get('module_srl') == $oDocument->get('member_srl')) $savedDoc = true;
            $oDocument->add('module_srl', $this->module_srl);

            // ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã‹â€ Ã‹Å“ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã‚Â Ã‚Â¤ÃƒÂªÃ‚Â³Ã‚Â  ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â  ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂ«Ã‚Â¹Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â°Ã¢â€šÂ¬ÃƒÂ«Ã‚Â²Ã‹â€ ÃƒÂ­Ã‹Å“Ã‚Â¸ ÃƒÂ¬Ã…Â¾Ã¢â‚¬Â¦ÃƒÂ«Ã‚Â Ã‚Â¥ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬ï¿½ÃƒÂ«Ã‚Â©Ã‚Â´ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â¡Ã…â€œ
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

            // ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬Â¢ÃƒÂ¬Ã…Â¾Ã‚Â¥ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂ¬Ã‹â€ Ã‹Å“ÃƒÂ¬Ã‚Â²Ã‹Å“ÃƒÂ«Ã‚Â¦Ã‚Â¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã…â€œÃ¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ xml_js_filterÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã‚Â§Ã¯Â¿Â½ÃƒÂ¬Ã‚Â Ã¢â‚¬Ëœ headerÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ ÃƒÂ¬Ã‚Â Ã¯Â¿Â½ÃƒÂ¬Ã…Â¡Ã‚Â©
            $oDocumentController = &getController('document');
            $oDocumentController->addXmlJsFilter($this->module_info->module_srl);

            // ÃƒÂ¬Ã‚Â¡Ã‚Â´ÃƒÂ¬Ã…Â¾Ã‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬Â¢ÃƒÂ¬Ã…Â¾Ã‚Â¥ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂ¬Ã‹â€ Ã‹Å“ ÃƒÂªÃ‚Â°Ã¢â‚¬â„¢ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ context set
            if($oDocument->isExists() && !$savedDoc) Context::set('extra_keys', $oDocument->getExtraVars());

            /** 
             * ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ«Ã¯Â¿Â½Ã‹Å“ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ javascript ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Å¾Ã‚Â° ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'insert.xml');

            $this->setTemplateFile('write_form');
        }

        /**
         * @brief ÃƒÂ«Ã‚Â¬Ã‚Â¸ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â­ÃƒÂ¬Ã‚Â Ã…â€œ ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬ï¿½ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã‚Â Ã‚Â¥
         **/
        function dispForumDelete() {
            // ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â²Ã‚Â´ÃƒÂ­Ã¯Â¿Â½Ã‚Â¬
            if(!$this->grant->write_document) return $this->dispForumMessage('msg_not_permitted');

            // ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â­ÃƒÂ¬Ã‚Â Ã…â€œÃƒÂ­Ã¢â‚¬Â¢Ã‚Â  ÃƒÂ«Ã‚Â¬Ã‚Â¸ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œÃƒÂ«Ã‚Â²Ã‹â€ ÃƒÂ­Ã‹Å“Ã‚Â¸ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã‚Â¸ÃƒÂ¬Ã‹Å“Ã‚Â¨ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤
            $document_srl = Context::get('document_srl');

            // ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬Â¢ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¸
            if($document_srl) {
                $oDocumentModel = &getModel('document');
                $oDocument = $oDocumentModel->getDocument($document_srl);
            }

            // ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â­ÃƒÂ¬Ã‚Â Ã…â€œÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã‚Â Ã‚Â¤ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ«Ã…Â¸Ã‚Â¬
            if(!$oDocument->isExists()) return $this->dispForumContent();

            // ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂ«Ã‚Â¹Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â°Ã¢â€šÂ¬ÃƒÂ«Ã‚Â²Ã‹â€ ÃƒÂ­Ã‹Å“Ã‚Â¸ ÃƒÂ¬Ã…Â¾Ã¢â‚¬Â¦ÃƒÂ«Ã‚Â Ã‚Â¥ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬ï¿½ÃƒÂ«Ã‚Â©Ã‚Â´ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â¡Ã…â€œ
            if(!$oDocument->isGranted()) return $this->setTemplateFile('input_password_form');

            Context::set('oDocument',$oDocument);

            /** 
             * ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Å¾Ã‚Â° ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'delete_document.xml');

            $this->setTemplateFile('delete_form');
        }

        /**
         * @brief ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ ÃƒÂ«Ã¢â‚¬Â¹Ã‚ÂµÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬ï¿½ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã‚Â Ã‚Â¥
         **/
        function dispForumWriteComment() {
            $document_srl = Context::get('document_srl');

            // ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â²Ã‚Â´ÃƒÂ­Ã¯Â¿Â½Ã‚Â¬
            if(!$this->grant->write_comment) return $this->dispForumMessage('msg_not_permitted');

            // ÃƒÂ¬Ã¢â‚¬ÂºÃ¯Â¿Â½ÃƒÂ«Ã‚Â³Ã‚Â¸ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â¨
            $oDocumentModel = &getModel('document');
            $oDocument = $oDocumentModel->getDocument($document_srl);
            if(!$oDocument->isExists()) return $this->dispForumMessage('msg_invalid_request');

            // ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¹ ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã‚Â°Ã‚Â¾ÃƒÂ¬Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â³Ã‚Â¸ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤ (comment_formÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â°Ã¢â€žÂ¢ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬Å“Ã‚Â°ÃƒÂªÃ‚Â¸Ã‚Â° ÃƒÂ¬Ã…â€œÃ¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ¬Ã¢â‚¬Å¾Ã…â€œ ÃƒÂ«Ã‚Â¹Ã‹â€  ÃƒÂªÃ‚Â°Ã¯Â¿Â½ÃƒÂ¬Ã‚Â²Ã‚Â´ ÃƒÂ¬Ã†â€™Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â±)
            $oCommentModel = &getModel('comment');
            $oSourceComment = $oComment = $oCommentModel->getComment(0);
            $oComment->add('document_srl', $document_srl);
            $oComment->add('module_srl', $this->module_srl);

            // ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂ«Ã¢â‚¬Å“Ã‚Â¤ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦
            Context::set('oDocument',$oDocument);
            Context::set('oSourceComment',$oSourceComment);
            Context::set('oComment',$oComment);

            /** 
             * ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Å¾Ã‚Â° ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'insert_comment.xml');

            $this->setTemplateFile('comment_form');
        }

        /**
         * @brief ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ ÃƒÂ«Ã¢â‚¬Â¹Ã‚ÂµÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬ï¿½ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã‚Â Ã‚Â¥
         **/
        function dispForumReplyComment() {
            // ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â²Ã‚Â´ÃƒÂ­Ã¯Â¿Â½Ã‚Â¬
            if(!$this->grant->write_comment) return $this->dispForumMessage('msg_not_permitted');

            // ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã‹Å“Ã¢â‚¬Å¾ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂ¬Ã‹â€ Ã‹Å“ÃƒÂ«Ã¢â‚¬Å“Ã‚Â¤ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã‚Â¸ÃƒÂ¬Ã‹Å“Ã‚Â¨ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤
            $parent_srl = Context::get('comment_srl');
            

            // ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂ¬Ã¢â‚¬ÂºÃ¯Â¿Â½ ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã‹Å“Ã‚Â¤ÃƒÂ«Ã‚Â¥Ã‹Å“
            if(!$parent_srl) return new Object(-1, 'msg_invalid_request');

            // ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¹ ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã‚Â°Ã‚Â¾ÃƒÂ¬Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â³Ã‚Â¸ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤
            $oCommentModel = &getModel('comment');
            $oSourceComment = $oCommentModel->getComment($parent_srl, $this->grant->manager);

            // ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã‹Å“Ã‚Â¤ÃƒÂ«Ã‚Â¥Ã‹Å“
            if(!$oSourceComment->isExists()) return $this->dispForumMessage('msg_invalid_request');
            if(Context::get('document_srl') && $oSourceComment->get('document_srl') != Context::get('document_srl')) return $this->dispForumMessage('msg_invalid_request');

            // ÃƒÂ«Ã…â€™Ã¢â€šÂ¬ÃƒÂ¬Ã†â€™Ã¯Â¿Â½ ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã†â€™Ã¯Â¿Â½ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â±
            $oComment = $oCommentModel->getComment();
            $oComment->add('parent_srl', 0);
            $oComment->add('document_srl', $oSourceComment->get('document_srl'));
            $quote = Context::get('quote');
            $lang->cmd_quote=Context::getLang('cmd_quote');
            if($quote=='Y') {
            	$content ="<div class=\"quote\"><div class=\"quoteTitle\">".$lang->cmd_quote."</div>".$oSourceComment->get('content')."</div></br>";
            	
            	$oComment->add('content',$content);
            }

            // ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂ«Ã¢â‚¬Å“Ã‚Â¤ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦
            Context::set('oSourceComment',$oSourceComment);
            Context::set('oComment',$oComment);
            Context::set('module_srl',$this->module_info->module_srl);

            /** 
             * ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ«Ã¯Â¿Â½Ã‹Å“ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ javascript ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Å¾Ã‚Â° ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'insert_comment.xml');

            $this->setTemplateFile('comment_form');
        }

        /**
         * @brief ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ ÃƒÂ¬Ã‹â€ Ã‹Å“ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ ÃƒÂ­Ã¯Â¿Â½Ã‚Â¼ ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã‚Â Ã‚Â¥
         **/
        function dispForumModifyComment() {
            // ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â²Ã‚Â´ÃƒÂ­Ã¯Â¿Â½Ã‚Â¬
            if(!$this->grant->write_comment) return $this->dispForumMessage('msg_not_permitted');

            // ÃƒÂ«Ã‚ÂªÃ‚Â©ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂªÃ‚ÂµÃ‚Â¬ÃƒÂ­Ã‹Å“Ã¢â‚¬Å¾ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ«Ã‚Â³Ã¢â€šÂ¬ÃƒÂ¬Ã‹â€ Ã‹Å“ÃƒÂ«Ã¢â‚¬Å“Ã‚Â¤ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã‚Â¸ÃƒÂ¬Ã‹Å“Ã‚Â¨ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤
            $document_srl = Context::get('document_srl');
            $comment_srl = Context::get('comment_srl');

            // ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã¯Â¿Â½Ã…â€œ ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã‹Å“Ã‚Â¤ÃƒÂ«Ã‚Â¥Ã‹Å“
            if(!$comment_srl) return new Object(-1, 'msg_invalid_request');

            // ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â´ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¹ ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã‚Â°Ã‚Â¾ÃƒÂ¬Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â³Ã‚Â¸ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤
            $oCommentModel = &getModel('comment');
            $oComment = $oCommentModel->getComment($comment_srl, $this->grant->manager);

            // ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã‹Å“Ã‚Â¤ÃƒÂ«Ã‚Â¥Ã‹Å“
            if(!$oComment->isExists()) return $this->dispForumMessage('msg_invalid_request');

            // ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂ¬Ã‹â€ Ã‹Å“ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã‚Â Ã‚Â¤ÃƒÂªÃ‚Â³Ã‚Â  ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â  ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂ«Ã‚Â¹Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â°Ã¢â€šÂ¬ÃƒÂ«Ã‚Â²Ã‹â€ ÃƒÂ­Ã‹Å“Ã‚Â¸ ÃƒÂ¬Ã…Â¾Ã¢â‚¬Â¦ÃƒÂ«Ã‚Â Ã‚Â¥ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬ï¿½ÃƒÂ«Ã‚Â©Ã‚Â´ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â¡Ã…â€œ
            if(!$oComment->isGranted()) return $this->setTemplateFile('input_password_form');

            // ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â Ã¢â‚¬Â¢ÃƒÂ«Ã‚Â³Ã‚Â´ÃƒÂ«Ã¢â‚¬Å“Ã‚Â¤ ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ­Ã…â€™Ã¢â‚¬Â¦
            Context::set('oSourceComment', $oCommentModel->getComment());
            Context::set('oComment', $oComment);

            /** 
             * ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¬Ã…Â¡Ã‚Â©ÃƒÂ«Ã¯Â¿Â½Ã‹Å“ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ javascript ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Å¾Ã‚Â° ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'insert_comment.xml');

            $this->setTemplateFile('comment_form');
        }

        /**
         * @brief ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â­ÃƒÂ¬Ã‚Â Ã…â€œ ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬ï¿½ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã‚Â Ã‚Â¥
         **/
        function dispForumDeleteComment() {
            // ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‚Â²Ã‚Â´ÃƒÂ­Ã¯Â¿Â½Ã‚Â¬
            if(!$this->grant->write_comment) return $this->dispForumMessage('msg_not_permitted');

            // ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â­ÃƒÂ¬Ã‚Â Ã…â€œÃƒÂ­Ã¢â‚¬Â¢Ã‚Â  ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ«Ã‚Â²Ã‹â€ ÃƒÂ­Ã‹Å“Ã‚Â¸ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã‚Â¸ÃƒÂ¬Ã‹Å“Ã‚Â¨ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤
            $comment_srl = Context::get('comment_srl');

            // ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â­ÃƒÂ¬Ã‚Â Ã…â€œÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã‚Â Ã‚Â¤ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬Â¢ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¸
            if($comment_srl) {
                $oCommentModel = &getModel('comment');
                $oComment = $oCommentModel->getComment($comment_srl, $this->grant->manager);
            }

            // ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â­ÃƒÂ¬Ã‚Â Ã…â€œÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã‚Â Ã‚Â¤ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ«Ã…Â¸Ã‚Â¬
            if(!$oComment->isExists() ) return $this->dispForumContent();

            // ÃƒÂªÃ‚Â¶Ã…â€™ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂ«Ã‚Â¹Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â°Ã¢â€šÂ¬ÃƒÂ«Ã‚Â²Ã‹â€ ÃƒÂ­Ã‹Å“Ã‚Â¸ ÃƒÂ¬Ã…Â¾Ã¢â‚¬Â¦ÃƒÂ«Ã‚Â Ã‚Â¥ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬ï¿½ÃƒÂ«Ã‚Â©Ã‚Â´ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â¡Ã…â€œ
            if(!$oComment->isGranted()) return $this->setTemplateFile('input_password_form');

            Context::set('oComment',$oComment);

            /** 
             * ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Å¾Ã‚Â° ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'delete_comment.xml');

            $this->setTemplateFile('delete_comment_form');
        }

        /**
         * @brief ÃƒÂ¬Ã¢â‚¬â€�Ã‚Â®ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¸ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â­ÃƒÂ¬Ã‚Â Ã…â€œ ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬ï¿½ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã‚Â Ã‚Â¥
         **/
        function dispForumDeleteTrackback() {
            // ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â­ÃƒÂ¬Ã‚Â Ã…â€œÃƒÂ­Ã¢â‚¬Â¢Ã‚Â  ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ«Ã‚Â²Ã‹â€ ÃƒÂ­Ã‹Å“Ã‚Â¸ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ÃƒÂ¬Ã‚Â Ã‚Â¸ÃƒÂ¬Ã‹Å“Ã‚Â¨ÃƒÂ«Ã¢â‚¬Â¹Ã‚Â¤
            $trackback_srl = Context::get('trackback_srl');

            // ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â­ÃƒÂ¬Ã‚Â Ã…â€œÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã‚Â Ã‚Â¤ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂ«Ã…â€™Ã¢â‚¬Å“ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂªÃ‚Â°Ã¢â€šÂ¬ ÃƒÂ¬Ã…Â¾Ã‹â€ ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ­Ã¢â€žÂ¢Ã¢â‚¬Â¢ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¸
            $oTrackbackModel = &getModel('trackback');
            $output = $oTrackbackModel->getTrackback($trackback_srl);
            $trackback = $output->data;

            // ÃƒÂ¬Ã¢â‚¬Å¡Ã‚Â­ÃƒÂ¬Ã‚Â Ã…â€œÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã‚Â Ã‚Â¤ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂªÃ‚Â¸Ã¢â€šÂ¬ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ¬Ã…â€œÃ‚Â¼ÃƒÂ«Ã‚Â©Ã‚Â´ ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½ÃƒÂ«Ã…Â¸Ã‚Â¬
            if(!$trackback) return $this->dispForumContent();

            Context::set('trackback',$trackback);

            /** 
             * ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Å¾Ã‚Â° ÃƒÂ¬Ã‚Â¶Ã¢â‚¬ï¿½ÃƒÂªÃ‚Â°Ã¢â€šÂ¬
             **/
            Context::addJsFilter($this->module_path.'tpl/filter', 'delete_trackback.xml');

            $this->setTemplateFile('delete_trackback_form');
        }

        /**
         * @brief ÃƒÂ«Ã‚Â©Ã¢â‚¬ï¿½ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã‚Â Ã‚Â¥
         **/
        function dispForumMessage($msg_code) {
            $msg = Context::getLang($msg_code);
            if(!$msg) $msg = $msg_code;
            Context::set('message', $msg);
            $this->setTemplateFile('message');
        }

        /**
         * @brief ÃƒÂ¬Ã‹Å“Ã‚Â¤ÃƒÂ«Ã‚Â¥Ã‹Å“ÃƒÂ«Ã‚Â©Ã¢â‚¬ï¿½ÃƒÂ¬Ã¢â‚¬Å¾Ã‚Â¸ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ system alertÃƒÂ«Ã‚Â¡Ã…â€œ ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã‚Â Ã‚Â¥ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ method
         * ÃƒÂ­Ã…Â Ã‚Â¹ÃƒÂ«Ã‚Â³Ã¢â‚¬Å¾ÃƒÂ­Ã¢â‚¬Â¢Ã…â€œ ÃƒÂ¬Ã‹Å“Ã‚Â¤ÃƒÂ«Ã‚Â¥Ã‹Å“ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã¢â‚¬Â¢Ã…â€™ÃƒÂ«Ã‚Â Ã‚Â¤ÃƒÂ¬Ã‚Â£Ã‚Â¼ÃƒÂ¬Ã¢â‚¬â€œÃ‚Â´ÃƒÂ¬Ã¢â‚¬Â¢Ã‚Â¼ ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ÃƒÂ«Ã¯Â¿Â½Ã‚Â° ÃƒÂ«Ã‚Â³Ã¢â‚¬Å¾ÃƒÂ«Ã¯Â¿Â½Ã¢â‚¬Å¾ÃƒÂ¬Ã¯Â¿Â½Ã‹Å“ ÃƒÂ«Ã¢â‚¬ï¿½Ã¢â‚¬ï¿½ÃƒÂ¬Ã…Â¾Ã¯Â¿Â½ÃƒÂ¬Ã¯Â¿Â½Ã‚Â¸ÃƒÂªÃ‚Â¹Ã…â€™ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ÃƒÂ«Ã…Â Ã¢â‚¬ï¿½ ÃƒÂ­Ã¢â‚¬Â¢Ã¢â‚¬Å¾ÃƒÂ¬Ã…Â¡Ã¢â‚¬ï¿½ ÃƒÂ¬Ã¢â‚¬â€�Ã¢â‚¬Â ÃƒÂ¬Ã¯Â¿Â½Ã¢â‚¬Å¾ ÃƒÂªÃ‚Â²Ã‚Â½ÃƒÂ¬Ã…Â¡Ã‚Â° ÃƒÂ­Ã…Â½Ã‹Å“ÃƒÂ¬Ã¯Â¿Â½Ã‚Â´ÃƒÂ¬Ã‚Â§Ã¢â€šÂ¬ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ«Ã‚ÂªÃ‚Â¨ÃƒÂ«Ã¢â‚¬ËœÃ¯Â¿Â½ ÃƒÂªÃ‚Â·Ã‚Â¸ÃƒÂ«Ã‚Â¦Ã‚Â°ÃƒÂ­Ã¢â‚¬ÂºÃ¢â‚¬Å¾ÃƒÂ¬Ã¢â‚¬â€�Ã¯Â¿Â½
         * ÃƒÂ¬Ã‹Å“Ã‚Â¤ÃƒÂ«Ã‚Â¥Ã‹Å“ÃƒÂ«Ã‚Â¥Ã‚Â¼ ÃƒÂ¬Ã‚Â¶Ã…â€œÃƒÂ«Ã‚Â Ã‚Â¥ÃƒÂ­Ã¢â‚¬Â¢Ã‹Å“ÃƒÂ«Ã¯Â¿Â½Ã¢â‚¬Å¾ÃƒÂ«Ã‚Â¡Ã¯Â¿Â½ ÃƒÂ­Ã¢â‚¬Â¢Ã‚Â¨
         **/
        function alertMessage($message) {
            $script =  sprintf('<script type="text/javascript"> xAddEventListener(window,"load", function() { alert("%s"); } );</script>', Context::getLang($message));
            Context::addHtmlHeader( $script );
        }

    }
?>
