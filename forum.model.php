<?php
    /**
     * @class  forumModel
     * @author NHN (developers@xpressengine.com)
     * @brief  forum ëª¨ë“ˆì�˜ Model class
     **/

    class forumModel extends module {
        /**
         * @brief ì´ˆê¸°í™”
         **/
        function init() {
        }

        /**
         * @brief ëª©ë¡� ì„¤ì • ê°’ì�„ ê°€ì ¸ì˜´
         **/
        function getListConfig($module_srl) {
            $oModuleModel = &getModel('module');
            $oDocumentModel = &getModel('document');

            // ì €ìž¥ë�œ ëª©ë¡� ì„¤ì •ê°’ì�„ êµ¬í•˜ê³  ì—†ìœ¼ë©´ ê¸°ë³¸ ê°’ìœ¼ë¡œ ì„¤ì •
            $list_config = $oModuleModel->getModulePartConfig('forum', $module_srl);
            if(!$list_config || !count($list_config)) $list_config = array( 'no', 'title', 'nick_name','regdate','readed_count');

            // ì‚¬ìš©ìž� ì„ ì–¸ í™•ìž¥ë³€ìˆ˜ êµ¬í•´ì™€ì„œ ë°°ì—´ ë³€í™˜í›„ return
            $inserted_extra_vars = $oDocumentModel->getExtraKeys($module_srl);

            foreach($list_config as $key) {
                if(preg_match('/^([0-9]+)$/',$key)) $output['extra_vars'.$key] = $inserted_extra_vars[$key];
                else $output[$key] = new ExtraItem($module_srl, -1, Context::getLang($key), $key, 'N', 'N', 'N', null);
            }
            return $output;
        }

        /** 
         * @brief ê¸°ë³¸ ëª©ë¡� ì„¤ì •ê°’ì�„ return
         **/
        function getDefaultListConfig($module_srl) {
            // ê°€ìƒ�ë²ˆí˜¸, ì œëª©, ë“±ë¡�ì�¼, ìˆ˜ì •ì�¼, ë‹‰ë„¤ìž„, ì•„ì�´ë””, ì�´ë¦„, ì¡°íšŒìˆ˜, ì¶”ì²œìˆ˜ ì¶”ê°€
            $virtual_vars = array( 'no', 'title', 'regdate', 'last_update', 'last_post', 'nick_name', 'user_id', 'user_name', 'readed_count', 'voted_count','thumbnail','summary','comment_count');
            foreach($virtual_vars as $key) {
                $extra_vars[$key] = new ExtraItem($module_srl, -1, Context::getLang($key), $key, 'N', 'N', 'N', null);
            }

            // ì‚¬ìš©ìž� ì„ ì–¸ í™•ìž¥ë³€ìˆ˜ ì •ë¦¬
            $oDocumentModel = &getModel('document');
            $inserted_extra_vars = $oDocumentModel->getExtraKeys($module_srl);

            if(count($inserted_extra_vars)) foreach($inserted_extra_vars as $obj) $extra_vars['extra_vars'.$obj->idx] = $obj;

            return $extra_vars;

        }



    }
?>
