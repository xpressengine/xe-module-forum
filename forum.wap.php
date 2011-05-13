<?php
    /**
     * @class  forumWAP
     * @author NHN (developers@xpressengine.com)
     * @brief  forum ëª¨ë“ˆì�˜ WAP class
     **/

    class forumWAP extends forum {

        /**
         * @brief wap procedure method
         **/
        function procWAP(&$oMobile) {
            // ê¶Œí•œ ì²´í�¬
            if(!$this->grant->list || $this->module_info->consultation == 'Y') return $oMobile->setContent(Context::getLang('msg_not_permitted'));

            // document model ê°�ì²´ ìƒ�ì„±
            $oDocumentModel = &getModel('document');

            // ì„ íƒ�ë�œ ê²Œì‹œê¸€ì�´ ìžˆì�„ ê²½ìš°
            $document_srl = Context::get('document_srl');
            if($document_srl) {
                $oDocument = $oDocumentModel->getDocument($document_srl);
                if($oDocument->isExists()) {
                    // ê¶Œí•œ í™•ì�¸
                    if(!$this->grant->view) return $oMobile->setContent(Context::getLang('msg_not_permitted'));

                    // ê¸€ ì œëª© ì„¤ì •
                    Context::setBrowserTitle($oDocument->getTitleText());

                    // ëŒ“ê¸€ ë³´ê¸° ì�¼ ê²½ìš°
                    if($this->act=='dispForumContentCommentList') {

                        $oCommentModel = &getModel('comment');
                        $output = $oCommentModel->getCommentList($oDocument->document_srl, 0, false, $oDocument->getCommentCount());

                        $content = '';
                        if(count($output->data)) {
                            foreach($output->data as $key => $val){
                                $oComment = new commentItem();
                                $oComment->setAttribute($val);
                                if(!$oComment->isAccessible()) continue;
                                $content .= "<b>".$oComment->getNickName()."</b> (".$oComment->getRegdate("Y-m-d").")<br>\r\n".$oComment->getContent(false,false)."<br>\r\n";
                            }
                        }

                        // ë‚´ìš© ì„¤ì •
                        $oMobile->setContent( $content );

                        // ìƒ�ìœ„ íŽ˜ì�´ì§€ë¥¼ ëª©ë¡�ìœ¼ë¡œ ë�Œì•„ê°€ê¸°ë¡œ ì§€ì •
                        $oMobile->setUpperUrl( getUrl('act',''), Context::getLang('cmd_go_upper') );

                    // ëŒ“ê¸€ ë³´ê¸°ê°€ ì•„ë‹ˆë©´ ê¸€ ë³´ì—¬ì¤Œ
                    } else {

                        // ë‚´ìš© ì§€ì • (íƒœê·¸ë¥¼ ëª¨ë‘� ì œê±°í•œ ë‚´ìš©ì�„ ì„¤ì •)
                        $content = strip_tags(str_replace('<p>','<br>&nbsp;&nbsp;&nbsp;',$oDocument->getContent(false,false,false)),'<br><b><i><u><em><small><strong><big>');


                        // ë‚´ìš© ìƒ�ë‹¨ì—� ì •ë³´ ì¶œë ¥ (ëŒ“ê¸€ ë³´ê¸° ë§�í�¬ í�¬í•¨)
                        $content = Context::getLang('replies').' : <a href="'.getUrl('act','dispForumContentCommentList').'">'.$oDocument->getCommentCount().'</a><br>'."\r\n".$content;
                        $content = '<b>'.$oDocument->getNickName().'</b> ('.$oDocument->getRegdate("Y-m-d").")<br>\r\n".$content;
                        
                        // ë‚´ìš© ì„¤ì •
                        $oMobile->setContent( $content );

                        // ìƒ�ìœ„ íŽ˜ì�´ì§€ë¥¼ ëª©ë¡�ìœ¼ë¡œ ë�Œì•„ê°€ê¸°ë¡œ ì§€ì •
                        $oMobile->setUpperUrl( getUrl('document_srl',''), Context::getLang('cmd_list') );

                    }

                    return;
                }
            }

            // ê²Œì‹œê¸€ ëª©ë¡�
            $args->module_srl = $this->module_srl; 
            $args->page = Context::get('page');; 
            $args->list_count = 9;
            $args->sort_index = $this->module_info->order_target?$this->module_info->order_target:'list_order';
            $args->order_type = $this->module_info->order_type?$this->module_info->order_type:'asc';
            $output = $oDocumentModel->getDocumentList($args, $this->except_notice);
            $document_list = $output->data;
            $page_navigation = $output->page_navigation;

            $childs = array();
            if($document_list && count($document_list)) {
                foreach($document_list as $key => $val) {
                    $href = getUrl('mid',$_GET['mid'],'document_srl',$val->document_srl);
                    $obj = null;
                    $obj['href'] = $val->getPermanentUrl();

                    $title = htmlspecialchars($val->getTitleText());
                    if($val->getCommentCount()) $title .= ' ['.$val->getCommentCount().']';
                    $obj['link'] = $obj['text'] = '['.$val->getNickName().'] '.$title;
                    $childs[] = $obj;
                }
                $oMobile->setChilds($childs); 
            }

            $totalPage = $page_navigation->last_page;
            $page = (int)Context::get('page');
            if(!$page) $page = 1;

            // next/prevUrl ì§€ì •
            if($page>1) $oMobile->setPrevUrl(getUrl('mid',$_GET['mid'],'page',$page-1), sprintf('%s (%d/%d)', Context::getLang('cmd_prev'), $page-1, $totalPage));

            if($page<$totalPage) $oMobile->setNextUrl(getUrl('mid',$_GET['mid'],'page',$page+1), sprintf('%s (%d/%d)', Context::getLang('cmd_next'), $page+1, $totalPage));

            $oMobile->mobilePage = $page;
            $oMobile->totalPage = $totalPage;
        }
    }

?>
