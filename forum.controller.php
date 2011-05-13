<?php
    /**
     * @class  forumController
     * @author NHN (developers@xpressengine.com)
     * @brief  forum Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Ëœ Controller class
     **/

    class forumController extends forum {

        /**
         * @brief Ã¬Â´Ë†ÃªÂ¸Â°Ã­â„¢â€�
         **/
        function init() {
        }

        /**
         * @brief Ã«Â¬Â¸Ã¬â€žÅ“ Ã¬Å¾â€¦Ã«Â Â¥
         **/
        function procForumInsertDocument() {
            // ÃªÂ¶Å’Ã­â€¢Å“ Ã¬Â²Â´Ã­ï¿½Â¬
			if($this->module_info->module != "forum") return new Object(-1, "msg_invalid_request");
            if(!$this->grant->write_document) return new Object(-1, 'msg_not_permitted');
            $logged_info = Context::get('logged_info');

            // ÃªÂ¸â‚¬Ã¬Å¾â€˜Ã¬â€žÂ±Ã¬â€¹Å“ Ã­â€¢â€žÃ¬Å¡â€�Ã­â€¢Å“ Ã«Â³â‚¬Ã¬Ë†ËœÃ«Â¥Â¼ Ã¬â€žÂ¸Ã­Å’â€¦
            $obj = Context::getRequestVars();
            $obj->content=strip_tags($obj->content);
            $obj->module_srl = $this->module_srl;
            if($obj->is_notice!='Y'||!$this->grant->manager) $obj->is_notice = 'N';

            settype($obj->title, "string");
            if($obj->title == '') $obj->title = cut_str(strip_tags($obj->content),20,'...');
            //ÃªÂ·Â¸Ã«Å¾ËœÃ«ï¿½â€ž Ã¬â€”â€ Ã¬Å“Â¼Ã«Â©Â´ Untitled
            if($obj->title == '') $obj->title = 'Untitled';

            // ÃªÂ´â‚¬Ã«Â¦Â¬Ã¬Å¾ï¿½ÃªÂ°â‚¬ Ã¬â€¢â€žÃ«â€¹Ë†Ã«ï¿½Â¼Ã«Â©Â´ ÃªÂ²Å’Ã¬â€¹Å“ÃªÂ¸â‚¬ Ã¬Æ’â€°Ã¬Æ’ï¿½/ÃªÂµÂµÃªÂ¸Â° Ã¬Â Å“ÃªÂ±Â°
            if(!$this->grant->manager) {
                unset($obj->title_color);
                unset($obj->title_bold);
            }

            // document moduleÃ¬ï¿½Ëœ model ÃªÂ°ï¿½Ã¬Â²Â´ Ã¬Æ’ï¿½Ã¬â€žÂ±
            $oDocumentModel = &getModel('document');

            // document moduleÃ¬ï¿½Ëœ controller ÃªÂ°ï¿½Ã¬Â²Â´ Ã¬Æ’ï¿½Ã¬â€žÂ±
            $oDocumentController = &getController('document');

            // Ã¬ï¿½Â´Ã«Â¯Â¸ Ã¬Â¡Â´Ã¬Å¾Â¬Ã­â€¢ËœÃ«Å â€� ÃªÂ¸â‚¬Ã¬ï¿½Â¸Ã¬Â§â‚¬ Ã¬Â²Â´Ã­ï¿½Â¬
            $oDocument = $oDocumentModel->getDocument($obj->document_srl, $this->grant->manager);

            // Ã¬ï¿½ÂµÃ«Âªâ€¦ Ã¬â€žÂ¤Ã¬Â â€¢Ã¬ï¿½Â¼ ÃªÂ²Â½Ã¬Å¡Â° Ã¬â€”Â¬Ã«Å¸Â¬ÃªÂ°â‚¬Ã¬Â§â‚¬ Ã¬Å¡â€�Ã¬â€ Å’Ã«Â¥Â¼ Ã«Â¯Â¸Ã«Â¦Â¬ Ã¬Â Å“ÃªÂ±Â° (Ã¬â€¢Å’Ã«Â¦Â¼Ã¬Å¡Â© Ã¬Â â€¢Ã«Â³Â´Ã«â€œÂ¤ Ã¬Â Å“ÃªÂ±Â°)
            
                $bAnonymous = false;
            

            // Ã¬ï¿½Â´Ã«Â¯Â¸ Ã¬Â¡Â´Ã¬Å¾Â¬Ã­â€¢ËœÃ«Å â€� ÃªÂ²Â½Ã¬Å¡Â° Ã¬Ë†ËœÃ¬Â â€¢
            if($oDocument->isExists() && $oDocument->document_srl == $obj->document_srl) {
				if(!$oDocument->isGranted()) return new Object(-1,'msg_not_permitted');
                $output = $oDocumentController->updateDocument($oDocument, $obj);
                $msg_code = 'success_updated';

            // ÃªÂ·Â¸Ã«Â â€¡Ã¬Â§â‚¬ Ã¬â€¢Å Ã¬Å“Â¼Ã«Â©Â´ Ã¬â€¹Â ÃªÂ·Å“ Ã«â€œÂ±Ã«Â¡ï¿½
            } else {
                $output = $oDocumentController->insertDocument($obj, $bAnonymous);
                $msg_code = 'success_registed';
                $obj->document_srl = $output->get('document_srl');

                // Ã«Â¬Â¸Ã¬Â Å“ÃªÂ°â‚¬ Ã¬â€”â€ ÃªÂ³Â  Ã«ÂªÂ¨Ã«â€œË† Ã¬â€žÂ¤Ã¬Â â€¢Ã¬â€”ï¿½ ÃªÂ´â‚¬Ã«Â¦Â¬Ã¬Å¾ï¿½ Ã«Â©â€�Ã¬ï¿½Â¼Ã¬ï¿½Â´ Ã«â€œÂ±Ã«Â¡ï¿½Ã«ï¿½ËœÃ¬â€“Â´ Ã¬Å¾Ë†Ã¬Å“Â¼Ã«Â©Â´ Ã«Â©â€�Ã¬ï¿½Â¼ Ã«Â°Å“Ã¬â€ Â¡
                if($output->toBool() && $this->module_info->admin_mail) {
                    $oMail = new Mail();
                    $oMail->setTitle($obj->title);
                    $oMail->setContent( sprintf("From : <a href=\"%s\">%s</a><br/>\n%s", getFullUrl('','document_srl',$obj->document_srl), getFullUrl('','document_srl',$obj->document_srl), $obj->content));
                    $oMail->setSender($obj->user_name, $obj->email_address);

                    $target_mail = explode(',',$this->module_info->admin_mail);
                    for($i=0;$i<count($target_mail);$i++) {
                        $email_address = trim($target_mail[$i]);
                        if(!$email_address) continue;
                        $oMail->setReceiptor($email_address, $email_address);
                        $oMail->send();
                    }
                }
            }

            // Ã¬ËœÂ¤Ã«Â¥Ëœ Ã«Â°Å“Ã¬Æ’ï¿½Ã¬â€¹Å“ Ã«Â©Ë†Ã¬Â¶Â¤
            if(!$output->toBool()) return $output;

            // ÃªÂ²Â°ÃªÂ³Â¼Ã«Â¥Â¼ Ã«Â¦Â¬Ã­â€žÂ´
            $this->add('mid', Context::get('mid'));
            $this->add('document_srl', $output->get('document_srl'));

            // Ã¬â€žÂ±ÃªÂ³Âµ Ã«Â©â€�Ã¬â€žÂ¸Ã¬Â§â‚¬ Ã«â€œÂ±Ã«Â¡ï¿½
            $this->setMessage($msg_code);
        }

        /**
         * @brief Ã«Â¬Â¸Ã¬â€žÅ“ Ã¬â€šÂ­Ã¬Â Å“
         **/
        function procForumDeleteDocument() {
            // Ã«Â¬Â¸Ã¬â€žÅ“ Ã«Â²Ë†Ã­ËœÂ¸ Ã­â„¢â€¢Ã¬ï¿½Â¸
            $document_srl = Context::get('document_srl');

            // Ã«Â¬Â¸Ã¬â€žÅ“ Ã«Â²Ë†Ã­ËœÂ¸ÃªÂ°â‚¬ Ã¬â€”â€ Ã«â€¹Â¤Ã«Â©Â´ Ã¬ËœÂ¤Ã«Â¥Ëœ Ã«Â°Å“Ã¬Æ’ï¿½
            if(!$document_srl) return $this->doError('msg_invalid_document');

            // document module model ÃªÂ°ï¿½Ã¬Â²Â´ Ã¬Æ’ï¿½Ã¬â€žÂ±
            $oDocumentController = &getController('document');

            // Ã¬â€šÂ­Ã¬Â Å“ Ã¬â€¹Å“Ã«ï¿½â€ž
            $output = $oDocumentController->deleteDocument($document_srl, $this->grant->manager);
            if(!$output->toBool()) return $output;

            // Ã¬â€žÂ±ÃªÂ³Âµ Ã«Â©â€�Ã¬â€žÂ¸Ã¬Â§â‚¬ Ã«â€œÂ±Ã«Â¡ï¿½
            $this->add('mid', Context::get('mid'));
            $this->add('page', $output->get('page'));
            $this->setMessage('success_deleted');
        }

        /**
         * @brief Ã¬Â¶â€�Ã¬Â²Å“
         **/
        function procForumVoteDocument() {
            // document module controller ÃªÂ°ï¿½Ã¬Â²Â´ Ã¬Æ’ï¿½Ã¬â€žÂ±
            $oDocumentController = &getController('document');

            $document_srl = Context::get('document_srl');
            return $oDocumentController->updateVotedCount($document_srl);
        }

        /**
         * @brief Ã¬Â½â€�Ã«Â©ËœÃ­Å Â¸ Ã¬Â¶â€�ÃªÂ°â‚¬
         **/
        function procForumInsertComment() {
            // ÃªÂ¶Å’Ã­â€¢Å“ Ã¬Â²Â´Ã­ï¿½Â¬
            if(!$this->grant->write_comment) return new Object(-1, 'msg_not_permitted');
            $logged_info = Context::get('logged_info');

            // Ã«Å’â€œÃªÂ¸â‚¬ Ã¬Å¾â€¦Ã«Â Â¥Ã¬â€”ï¿½ Ã­â€¢â€žÃ¬Å¡â€�Ã­â€¢Å“ Ã«ï¿½Â°Ã¬ï¿½Â´Ã­â€žÂ° Ã¬Â¶â€�Ã¬Â¶Å“
            $obj = Context::gets('document_srl','comment_srl','parent_srl','content','password','nick_name','member_srl','email_address','homepage','is_secret','notify_message');
            $obj->module_srl = $this->module_srl;

            // Ã¬â€ºï¿½ÃªÂ¸â‚¬Ã¬ï¿½Â´ Ã¬Â¡Â´Ã¬Å¾Â¬Ã­â€¢ËœÃ«Å â€�Ã¬Â§â‚¬ Ã¬Â²Â´Ã­ï¿½Â¬
            $oDocumentModel = &getModel('document');
            $oDocument = $oDocumentModel->getDocument($obj->document_srl);
            if(!$oDocument->isExists()) return new Object(-1,'msg_not_permitted');

            // For anonymous use, remove writer's information and notifying information
            
                $bAnonymous = false;
            

            // comment Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Ëœ model ÃªÂ°ï¿½Ã¬Â²Â´ Ã¬Æ’ï¿½Ã¬â€žÂ±
            $oCommentModel = &getModel('comment');

            // comment Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Ëœ controller ÃªÂ°ï¿½Ã¬Â²Â´ Ã¬Æ’ï¿½Ã¬â€žÂ±
            $oCommentController = &getController('comment');

            // comment_srlÃ¬ï¿½Â´ Ã¬Â¡Â´Ã¬Å¾Â¬Ã­â€¢ËœÃ«Å â€�Ã¬Â§â‚¬ Ã¬Â²Â´Ã­ï¿½Â¬
            // Ã«Â§Å’Ã¬ï¿½Â¼ comment_srlÃ¬ï¿½Â´ n/aÃ«ï¿½Â¼Ã«Â©Â´ getNextSequence()Ã«Â¡Å“ ÃªÂ°â€™Ã¬ï¿½â€ž Ã¬â€“Â»Ã¬â€“Â´Ã¬ËœÂ¨Ã«â€¹Â¤.
            if(!$obj->comment_srl) {
                $obj->comment_srl = getNextSequence();
            } else {
                $comment = $oCommentModel->getComment($obj->comment_srl, $this->grant->manager);
            }

            // comment_srlÃ¬ï¿½Â´ Ã¬â€”â€ Ã¬ï¿½â€ž ÃªÂ²Â½Ã¬Å¡Â° Ã¬â€¹Â ÃªÂ·Å“ Ã¬Å¾â€¦Ã«Â Â¥
            if($comment->comment_srl != $obj->comment_srl) {

                // parent_srlÃ¬ï¿½Â´ Ã¬Å¾Ë†Ã¬Å“Â¼Ã«Â©Â´ Ã«â€¹ÂµÃ«Â³â‚¬Ã¬Å“Â¼Ã«Â¡Å“
                if($obj->parent_srl) {
                    $parent_comment = $oCommentModel->getComment($obj->parent_srl);
                    if(!$parent_comment->comment_srl) return new Object(-1, 'msg_invalid_request');

                    $output = $oCommentController->insertComment($obj, $bAnonymous);

                // Ã¬â€”â€ Ã¬Å“Â¼Ã«Â©Â´ Ã¬â€¹Â ÃªÂ·Å“
                } else {
                    $output = $oCommentController->insertComment($obj, $bAnonymous);
                }

                // Ã«Â¬Â¸Ã¬Â Å“ÃªÂ°â‚¬ Ã¬â€”â€ ÃªÂ³Â  Ã«ÂªÂ¨Ã«â€œË† Ã¬â€žÂ¤Ã¬Â â€¢Ã¬â€”ï¿½ ÃªÂ´â‚¬Ã«Â¦Â¬Ã¬Å¾ï¿½ Ã«Â©â€�Ã¬ï¿½Â¼Ã¬ï¿½Â´ Ã«â€œÂ±Ã«Â¡ï¿½Ã«ï¿½ËœÃ¬â€“Â´ Ã¬Å¾Ë†Ã¬Å“Â¼Ã«Â©Â´ Ã«Â©â€�Ã¬ï¿½Â¼ Ã«Â°Å“Ã¬â€ Â¡
                if($output->toBool() && $this->module_info->admin_mail) {
                    $oMail = new Mail();
                    $oMail->setTitle($oDocument->getTitleText());
                    $oMail->setContent( sprintf("From : <a href=\"%s#comment_%d\">%s#comment_%d</a><br/>\r\n%s", getFullUrl('','document_srl',$obj->document_srl),$obj->comment_srl, getFullUrl('','document_srl',$obj->document_srl), $obj->comment_srl, $obj->content));
                    $oMail->setSender($obj->user_name, $obj->email_address);
					$author_email=$oDocument->variables['email_address'];
					
					//mail to author of thread
					if($author_email != $obj->email_address) {
						$oMail->setReceiptor($author_email, $author_email);
						$oMail->send();
					}
					//mail to subscribers that turned notification on
					$comment_list=$oCommentModel->getCommentList($obj->document_srl);
					foreach($comment_list->data as $key_comment){
						if($key_comment->notify_message=='Y'){
							$oMail->setReceiptor($key_comment->email_address, $key_comment->email_address);
							$oMail->send();
						}
					}
					
					
                    $target_mail = explode(',',$this->module_info->admin_mail);
                    for($i=0;$i<count($target_mail);$i++) {
                        $email_address = trim($target_mail[$i]);
                        if(!$email_address) continue;
                        $oMail->setReceiptor($email_address, $email_address);
                        $oMail->send();
                    }
                }

            // comment_srlÃ¬ï¿½Â´ Ã¬Å¾Ë†Ã¬Å“Â¼Ã«Â©Â´ Ã¬Ë†ËœÃ¬Â â€¢Ã¬Å“Â¼Ã«Â¡Å“
            } else {
				// Ã«â€¹Â¤Ã¬â€¹Å“ ÃªÂ¶Å’Ã­â€¢Å“Ã¬Â²Â´Ã­ï¿½Â¬
				if(!$comment->isGranted()) return new Object(-1,'msg_not_permitted');

                $obj->parent_srl = $comment->parent_srl;
                $obj->user_name=$comment->user_name;
                $output= executeQuery('forum.updateComments', $obj);
                //$output = $oCommentController->updateComment($obj, $this->grant->manager);
                $comment_srl = $obj->comment_srl;
            }
            if(!$output->toBool()) return $output;

            $this->setMessage('success_registed');
            $this->add('mid', Context::get('mid'));
            $this->add('document_srl', $obj->document_srl);
            $this->add('comment_srl', $obj->comment_srl);
        }

        /**
         * @brief Ã¬Â½â€�Ã«Â©ËœÃ­Å Â¸ Ã¬â€šÂ­Ã¬Â Å“
         **/
        function procForumDeleteComment() {
            // Ã«Å’â€œÃªÂ¸â‚¬ Ã«Â²Ë†Ã­ËœÂ¸ Ã­â„¢â€¢Ã¬ï¿½Â¸
            $comment_srl = Context::get('comment_srl');
            if(!$comment_srl) return $this->doError('msg_invalid_request');

            // comment Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Ëœ controller ÃªÂ°ï¿½Ã¬Â²Â´ Ã¬Æ’ï¿½Ã¬â€žÂ±
            $oCommentController = &getController('comment');

            $output = $oCommentController->deleteComment($comment_srl, $this->grant->manager);
            if(!$output->toBool()) return $output;

            $this->add('mid', Context::get('mid'));
            $this->add('page', Context::get('page'));
            $this->add('document_srl', $output->get('document_srl'));
            $this->setMessage('success_deleted');
        }

        /**
         * @brief Ã¬â€”Â®Ã¬ï¿½Â¸ÃªÂ¸â‚¬ Ã¬â€šÂ­Ã¬Â Å“
         **/
        function procForumDeleteTrackback() {
            $trackback_srl = Context::get('trackback_srl');

            // trackback moduleÃ¬ï¿½Ëœ controller ÃªÂ°ï¿½Ã¬Â²Â´ Ã¬Æ’ï¿½Ã¬â€žÂ±
            $oTrackbackController = &getController('trackback');
            $output = $oTrackbackController->deleteTrackback($trackback_srl, $this->grant->manager);
            if(!$output->toBool()) return $output;

            $this->add('mid', Context::get('mid'));
            $this->add('page', Context::get('page'));
            $this->add('document_srl', $output->get('document_srl'));
            $this->setMessage('success_deleted');
        }

        /**
         * @brief Ã«Â¬Â¸Ã¬â€žÅ“Ã¬â„¢â‚¬ Ã«Å’â€œÃªÂ¸â‚¬Ã¬ï¿½Ëœ Ã«Â¹â€žÃ«Â°â‚¬Ã«Â²Ë†Ã­ËœÂ¸Ã«Â¥Â¼ Ã­â„¢â€¢Ã¬ï¿½Â¸
         **/
        function procForumVerificationPassword() {
            // Ã«Â¹â€žÃ«Â°â‚¬Ã«Â²Ë†Ã­ËœÂ¸Ã¬â„¢â‚¬ Ã«Â¬Â¸Ã¬â€žÅ“ Ã«Â²Ë†Ã­ËœÂ¸Ã«Â¥Â¼ Ã«Â°â€ºÃ¬ï¿½Å’
            $password = Context::get('password');
            $document_srl = Context::get('document_srl');
            $comment_srl = Context::get('comment_srl');

            $oMemberModel = &getModel('member');

            // comment_srlÃ¬ï¿½Â´ Ã¬Å¾Ë†Ã¬ï¿½â€ž ÃªÂ²Â½Ã¬Å¡Â° Ã«Å’â€œÃªÂ¸â‚¬Ã¬ï¿½Â´ Ã«Å’â‚¬Ã¬Æ’ï¿½
            if($comment_srl) {
                // Ã«Â¬Â¸Ã¬â€žÅ“Ã«Â²Ë†Ã­ËœÂ¸Ã¬â€”ï¿½ Ã­â€¢Â´Ã«â€¹Â¹Ã­â€¢ËœÃ«Å â€� ÃªÂ¸â‚¬Ã¬ï¿½Â´ Ã¬Å¾Ë†Ã«Å â€�Ã¬Â§â‚¬ Ã­â„¢â€¢Ã¬ï¿½Â¸
                $oCommentModel = &getModel('comment');
                $oComment = $oCommentModel->getComment($comment_srl);
                if(!$oComment->isExists()) return new Object(-1, 'msg_invalid_request');

                // Ã«Â¬Â¸Ã¬â€žÅ“Ã¬ï¿½Ëœ Ã«Â¹â€žÃ«Â°â‚¬Ã«Â²Ë†Ã­ËœÂ¸Ã¬â„¢â‚¬ Ã¬Å¾â€¦Ã«Â Â¥Ã­â€¢Å“ Ã«Â¹â€žÃ«Â°â‚¬Ã«Â²Ë†Ã­ËœÂ¸Ã¬ï¿½Ëœ Ã«Â¹â€žÃªÂµï¿½
                if(!$oMemberModel->isValidPassword($oComment->get('password'),$password)) return new Object(-1, 'msg_invalid_password');

                $oComment->setGrant();
            } else {
                // Ã«Â¬Â¸Ã¬â€žÅ“Ã«Â²Ë†Ã­ËœÂ¸Ã¬â€”ï¿½ Ã­â€¢Â´Ã«â€¹Â¹Ã­â€¢ËœÃ«Å â€� ÃªÂ¸â‚¬Ã¬ï¿½Â´ Ã¬Å¾Ë†Ã«Å â€�Ã¬Â§â‚¬ Ã­â„¢â€¢Ã¬ï¿½Â¸
                $oDocumentModel = &getModel('document');
                $oDocument = $oDocumentModel->getDocument($document_srl);
                if(!$oDocument->isExists()) return new Object(-1, 'msg_invalid_request');

                // Ã«Â¬Â¸Ã¬â€žÅ“Ã¬ï¿½Ëœ Ã«Â¹â€žÃ«Â°â‚¬Ã«Â²Ë†Ã­ËœÂ¸Ã¬â„¢â‚¬ Ã¬Å¾â€¦Ã«Â Â¥Ã­â€¢Å“ Ã«Â¹â€žÃ«Â°â‚¬Ã«Â²Ë†Ã­ËœÂ¸Ã¬ï¿½Ëœ Ã«Â¹â€žÃªÂµï¿½
                if(!$oMemberModel->isValidPassword($oDocument->get('password'),$password)) return new Object(-1, 'msg_invalid_password');

                $oDocument->setGrant();
            }
        }

        /**
         * @brief Ã¬â€¢â€žÃ¬ï¿½Â´Ã«â€�â€� Ã­ï¿½Â´Ã«Â¦Â­Ã¬â€¹Å“ Ã«â€šËœÃ­Æ’â‚¬Ã«â€šËœÃ«Å â€� Ã­Å’ï¿½Ã¬â€”â€¦Ã«Â©â€�Ã«â€°Â´Ã¬â€”ï¿½ "Ã¬Å¾â€˜Ã¬â€žÂ±ÃªÂ¸â‚¬ Ã«Â³Â´ÃªÂ¸Â°" Ã«Â©â€�Ã«â€°Â´Ã«Â¥Â¼ Ã¬Â¶â€�ÃªÂ°â‚¬Ã­â€¢ËœÃ«Å â€� trigger
         **/
        function triggerMemberMenu(&$obj) {
            $member_srl = Context::get('target_srl');
            $mid = Context::get('cur_mid');

            if(!$member_srl || !$mid) return new Object();

            $logged_info = Context::get('logged_info');

            // Ã­ËœÂ¸Ã¬Â¶Å“Ã«ï¿½Å“ Ã«ÂªÂ¨Ã«â€œË†Ã¬ï¿½Ëœ Ã¬Â â€¢Ã«Â³Â´ ÃªÂµÂ¬Ã­â€¢Â¨
            $oModuleModel = &getModel('module');
            $cur_module_info = $oModuleModel->getModuleInfoByMid($mid);

            if($cur_module_info->module != 'forum') return new Object();

            // Ã¬Å¾ï¿½Ã¬â€¹Â Ã¬ï¿½Ëœ Ã¬â€¢â€žÃ¬ï¿½Â´Ã«â€�â€�Ã«Â¥Â¼ Ã­ï¿½Â´Ã«Â¦Â­Ã­â€¢Å“ ÃªÂ²Â½Ã¬Å¡Â°
            if($member_srl == $logged_info->member_srl) {
                $member_info = $logged_info;
            } else {
                $oMemberModel = &getModel('member');
                $member_info = $oMemberModel->getMemberInfoByMemberSrl($member_srl);
            }

            if(!$member_info->user_id) return new Object();

            // Ã¬â€¢â€žÃ¬ï¿½Â´Ã«â€�â€�Ã«Â¡Å“ ÃªÂ²â‚¬Ã¬Æ’â€°ÃªÂ¸Â°Ã«Å Â¥ Ã¬Â¶â€�ÃªÂ°â‚¬
            $url = getUrl('','mid',$mid,'search_target','nick_name','search_keyword',$member_info->nick_name);
            $oMemberController = &getController('member');
            $oMemberController->addMemberPopupMenu($url, 'cmd_view_own_document', './modules/member/tpl/images/icon_view_written.gif');

            return new Object();
        }

    }
?>
