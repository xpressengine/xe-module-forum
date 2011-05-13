<?php
    /**
     * @class  forumAdminController
     
     **/

    class forumAdminController extends forum {

        /**
     
         **/
        function init() {
        }

        /**
     
         **/
        function procForumAdminInsertForum($args = null) {
            // 
            $oModuleController = &getController('module');
            $oModuleModel = &getModel('module');

            // 
            $args = Context::getRequestVars();
            $args->module = 'forum';
            $args->mid = $args->forum_name;
            unset($args->forum_name);

            // 
           
            if($args->except_notice!='Y') $args->except_notice = 'N';
            if($args->use_anonymous!='Y') $args->use_anonymous= 'N';
            if($args->consultation!='Y') $args->consultation = 'N';
            if(!in_array($args->order_target,$this->order_target)) $args->order_target = 'list_order';
            if(!in_array($args->order_type,array('asc','desc'))) $args->order_type = 'asc';

            // 
            if($args->module_srl) {
                $module_info = $oModuleModel->getModuleInfoByModuleSrl($args->module_srl);
                if($module_info->module_srl != $args->module_srl) unset($args->module_srl);
            }

            // 
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
         
         **/
        function procForumAdminDeleteForum() {
            $module_srl = Context::get('module_srl');

            //
            $oModuleController = &getController('module');
            $output = $oModuleController->deleteModule($module_srl);
            if(!$output->toBool()) return $output;

            $this->add('module','forum');
            $this->add('page',Context::get('page'));
            $this->setMessage('success_deleted');
        }

        /**
         
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
