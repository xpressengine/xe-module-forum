<?php
    /**
     * @class  forumAdminController
     * @author zero (zero@nzeo.com)
     * @brief  forum Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Ëœ admin controller class
     **/

    class forumAdminController extends forum {

        /**
         * @brief Ã¬Â´Ë†ÃªÂ¸Â°Ã­â„¢â€�
         **/
        function init() {
        }

        /**
         * @brief ÃªÂ²Å’Ã¬â€¹Å“Ã­Å’ï¿½ Ã¬Â¶â€�ÃªÂ°â‚¬
         **/
        function procForumAdminInsertForum($args = null) {
            // module Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Ëœ model/controller ÃªÂ°ï¿½Ã¬Â²Â´ Ã¬Æ’ï¿½Ã¬â€žÂ±
            $oModuleController = &getController('module');
            $oModuleModel = &getModel('module');

            // ÃªÂ²Å’Ã¬â€¹Å“Ã­Å’ï¿½ Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Ëœ Ã¬Â â€¢Ã«Â³Â´ Ã¬â€žÂ¤Ã¬Â â€¢
            $args = Context::getRequestVars();
            $args->module = 'forum';
            $args->mid = $args->forum_name;
            unset($args->forum_name);

            // ÃªÂ¸Â°Ã«Â³Â¸ ÃªÂ°â€™Ã¬â„¢Â¸Ã¬ï¿½Ëœ ÃªÂ²Æ’Ã«â€œÂ¤Ã¬ï¿½â€ž Ã¬Â â€¢Ã«Â¦Â¬
           
            if($args->except_notice!='Y') $args->except_notice = 'N';
            if($args->use_anonymous!='Y') $args->use_anonymous= 'N';
            if($args->consultation!='Y') $args->consultation = 'N';
            if(!in_array($args->order_target,$this->order_target)) $args->order_target = 'list_order';
            if(!in_array($args->order_type,array('asc','desc'))) $args->order_type = 'asc';

            // module_srlÃ¬ï¿½Â´ Ã«â€žËœÃ¬â€“Â´Ã¬ËœÂ¤Ã«Â©Â´ Ã¬â€ºï¿½ Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Â´ Ã¬Å¾Ë†Ã«Å â€�Ã¬Â§â‚¬ Ã­â„¢â€¢Ã¬ï¿½Â¸
            if($args->module_srl) {
                $module_info = $oModuleModel->getModuleInfoByModuleSrl($args->module_srl);
                if($module_info->module_srl != $args->module_srl) unset($args->module_srl);
            }

            // module_srlÃ¬ï¿½Ëœ ÃªÂ°â€™Ã¬â€”ï¿½ Ã«â€�Â°Ã«ï¿½Â¼ insert/update
            if(!$args->module_srl) {
                $output = $oModuleController->insertModule($args);
                $msg_code = 'success_registed';
            } else {
                $output = $oModuleController->updateModule($args);
                $msg_code = 'success_updated';
            }

            if(!$output->toBool()) return $output;

            $this->add('page',Context::get('page'));
            $this->add('act',$args->action);
            $this->add('module_srl',$output->get('module_srl'));
            $this->setMessage($msg_code);
        }

        /**
         * @brief ÃªÂ²Å’Ã¬â€¹Å“Ã­Å’ï¿½ Ã¬â€šÂ­Ã¬Â Å“
         **/
        function procForumAdminDeleteForum() {
            $module_srl = Context::get('module_srl');

            // Ã¬â€ºï¿½Ã«Â³Â¸Ã¬ï¿½â€ž ÃªÂµÂ¬Ã­â€¢Â´Ã¬ËœÂ¨Ã«â€¹Â¤
            $oModuleController = &getController('module');
            $output = $oModuleController->deleteModule($module_srl);
            if(!$output->toBool()) return $output;

            $this->add('module','forum');
            $this->add('page',Context::get('page'));
            $this->setMessage('success_deleted');
        }

        /**
         * @brief ÃªÂ²Å’Ã¬â€¹Å“Ã­Å’ï¿½ Ã«ÂªÂ©Ã«Â¡ï¿½ Ã¬Â§â‚¬Ã¬Â â€¢
         **/
        function procForumAdminInsertListConfig() {
            $module_srl = Context::get('module_srl');
            $list = explode(',',Context::get('list'));
            if(!count($list)) return new Object(-1, 'msg_invalid_request');

            $list_arr = array();
            foreach($list as $val) {
                $val = trim($val);
                if(!$val) continue;
                if(substr($val,0,10)=='extra_vars') $val = substr($val,10);
                $list_arr[] = $val;
            }

            $oModuleController = &getController('module');
            $oModuleController->insertModulePartConfig('forum', $module_srl, $list_arr);
        }
    }
?>
