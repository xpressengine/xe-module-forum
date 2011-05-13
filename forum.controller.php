<?php
    /**
     
     **/

    class forumController extends forum {

        /**
         
         **/
        function init() {
        }

        /**
         
         **/
        function procForumInsertDocument() {
            // 
			if($this->module_info->module != "forum") return new Object(-1, "msg_invalid_request");
            if(!$this->grant->write_document) return new Object(-1, 'msg_not_permitted');
            $logged_info = Context::get('logged_info');

            // 
            $obj = Context::getRequestVars();
            $obj->content=strip_tags($obj->content);
            $obj->module_srl = $this->module_srl;
            if($obj->is_notice!='Y'||!$this->grant->manager) $obj->is_notice = 'N';

            settype($obj->title, "string");
            if($obj->title == '') $obj->title = cut_str(strip_tags($obj->content),20,'...');
            //
            if($obj->title == '') $obj->title = 'Untitled';

            //
            if(!$this->grant->manager) {
                unset($obj->title_color);
                unset($obj->title_bold);
            }

            //
            $oDocumentModel = &getModel('document');

            //
            $oDocumentController = &getController('document');

            //
            $oDocument = $oDocumentModel->getDocument($obj->document_srl, $this->grant->manager);

            //            
                $bAnonymous = false;
            

            //
            if($oDocument->isExists() && $oDocument->document_srl == $obj->document_srl) {
				if(!$oDocument->isGranted()) return new Object(-1,'msg_not_permitted');
                $output = $oDocumentController->updateDocument($oDocument, $obj);
                $msg_code = 'success_updated';

            //
            } else {
                $output = $oDocumentController->insertDocument($obj, $bAnonymous);
                $msg_code = 'success_registed';
                $obj->document_srl = $output->get('document_srl');

                // 
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

            // 
            if(!$output->toBool()) return $output;

            // 
            $this->add('mid', Context::get('mid'));
            $this->add('document_srl', $output->get('document_srl'));

            // 
            $this->setMessage($msg_code);
        }

        /**
         
         **/
        function procForumDeleteDocument() {
            // 
            $document_srl = Context::get('document_srl');

            // 
            if(!$document_srl) return $this->doError('msg_invalid_document');

            // 
            $oDocumentController = &getController('document');

            // 
            $output = $oDocumentController->deleteDocument($document_srl, $this->grant->manager);
            if(!$output->toBool()) return $output;

            // 
            $this->add('mid', Context::get('mid'));
            $this->add('page', $output->get('page'));
            $this->setMessage('success_deleted');
        }

        /**
         
         **/
        function procForumVoteDocument() {
            // 
            $oDocumentController = &getController('document');

            $document_srl = Context::get('document_srl');
            return $oDocumentController->updateVotedCount($document_srl);
        }

        /**
         
         **/
        function procForumInsertComment() {
            // 
            if(!$this->grant->write_comment) return new Object(-1, 'msg_not_permitted');
            $logged_info = Context::get('logged_info');

            // 
            $obj = Context::gets('document_srl','comment_srl','parent_srl','content','password','nick_name','member_srl','email_address','homepage','is_secret','notify_message');
            $obj->module_srl = $this->module_srl;

            // 
            $oDocumentModel = &getModel('document');
            $oDocument = $oDocumentModel->getDocument($obj->document_srl);
            if(!$oDocument->isExists()) return new Object(-1,'msg_not_permitted');

            // For anonymous use, remove writer's information and notifying information
            
                $bAnonymous = false;
            

            // 
            $oCommentModel = &getModel('comment');

            // 
            $oCommentController = &getController('comment');

            // 
            // 
            if(!$obj->comment_srl) {
                $obj->comment_srl = getNextSequence();
            } else {
                $comment = $oCommentModel->getComment($obj->comment_srl, $this->grant->manager);
            }

            // 
            if($comment->comment_srl != $obj->comment_srl) {

                //
                if($obj->parent_srl) {
                    $parent_comment = $oCommentModel->getComment($obj->parent_srl);
                    if(!$parent_comment->comment_srl) return new Object(-1, 'msg_invalid_request');

                    $output = $oCommentController->insertComment($obj, $bAnonymous);

                //
                } else {
                    $output = $oCommentController->insertComment($obj, $bAnonymous);
                }

                //
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

            //
            } else {
				//
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
         
         **/
        function procForumDeleteComment() {
            //
            $comment_srl = Context::get('comment_srl');
            if(!$comment_srl) return $this->doError('msg_invalid_request');

            //
            $oCommentController = &getController('comment');

            $output = $oCommentController->deleteComment($comment_srl, $this->grant->manager);
            if(!$output->toBool()) return $output;

            $this->add('mid', Context::get('mid'));
            $this->add('page', Context::get('page'));
            $this->add('document_srl', $output->get('document_srl'));
            $this->setMessage('success_deleted');
        }

        /**
         
         **/
        function procForumDeleteTrackback() {
            $trackback_srl = Context::get('trackback_srl');

            //
            $oTrackbackController = &getController('trackback');
            $output = $oTrackbackController->deleteTrackback($trackback_srl, $this->grant->manager);
            if(!$output->toBool()) return $output;

            $this->add('mid', Context::get('mid'));
            $this->add('page', Context::get('page'));
            $this->add('document_srl', $output->get('document_srl'));
            $this->setMessage('success_deleted');
        }

        /**
         
         **/
        function procForumVerificationPassword() {
            //
            $password = Context::get('password');
            $document_srl = Context::get('document_srl');
            $comment_srl = Context::get('comment_srl');

            $oMemberModel = &getModel('member');

            //
            if($comment_srl) {
                //
                $oCommentModel = &getModel('comment');
                $oComment = $oCommentModel->getComment($comment_srl);
                if(!$oComment->isExists()) return new Object(-1, 'msg_invalid_request');

                //
                if(!$oMemberModel->isValidPassword($oComment->get('password'),$password)) return new Object(-1, 'msg_invalid_password');

                $oComment->setGrant();
            } else {
                //
                $oDocumentModel = &getModel('document');
                $oDocument = $oDocumentModel->getDocument($document_srl);
                if(!$oDocument->isExists()) return new Object(-1, 'msg_invalid_request');

                //
                if(!$oMemberModel->isValidPassword($oDocument->get('password'),$password)) return new Object(-1, 'msg_invalid_password');

                $oDocument->setGrant();
            }
        }

        /**
         
         **/
        function triggerMemberMenu(&$obj) {
            $member_srl = Context::get('target_srl');
            $mid = Context::get('cur_mid');

            if(!$member_srl || !$mid) return new Object();

            $logged_info = Context::get('logged_info');

            //
            $oModuleModel = &getModel('module');
            $cur_module_info = $oModuleModel->getModuleInfoByMid($mid);

            if($cur_module_info->module != 'forum') return new Object();

            //
            if($member_srl == $logged_info->member_srl) {
                $member_info = $logged_info;
            } else {
                $oMemberModel = &getModel('member');
                $member_info = $oMemberModel->getMemberInfoByMemberSrl($member_srl);
            }

            if(!$member_info->user_id) return new Object();

            //
            $url = getUrl('','mid',$mid,'search_target','nick_name','search_keyword',$member_info->nick_name);
            $oMemberController = &getController('member');
            $oMemberController->addMemberPopupMenu($url, 'cmd_view_own_document', './modules/member/tpl/images/icon_view_written.gif');

            return new Object();
        }

    }
?>
