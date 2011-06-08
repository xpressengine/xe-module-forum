<?php
    /**
     * @class  forumController
     * @author dan (dan.dragan@arnia.ro)
     * @brief  forum module Controller class
     **/

    class forumController extends forum {

        /**
         * @brief Initialization
         **/
        function init() {
        }

        /**
         * @brief processing forum insert document
         **/
        function procForumInsertDocument() {
            // check grants and permissions
			if($this->module_info->module != "forum") return new Object(-1, "msg_invalid_request");
            if(!$this->grant->post) return new Object(-1, 'msg_not_permitted');
            $logged_info = Context::get('logged_info');

            // setting required variables
            $obj = Context::getRequestVars();
            $obj->content=strip_tags($obj->content);
            $obj->module_srl = $this->module_srl;
            if($obj->is_notice!='Y'||!$this->grant->manager) $obj->is_notice = 'N';

            settype($obj->title, "string");
            if($obj->title == '') $obj->title = cut_str(strip_tags($obj->content),20,'...');
            // Untitled
            if($obj->title == '') $obj->title = 'Untitled';

            // Color and bold removed if not administrator
            if(!$this->grant->manager) {
                unset($obj->title_color);
                unset($obj->title_bold);
            }

            // instancing document model
            $oDocumentModel = &getModel('document');

            // instancing document controller
            $oDocumentController = &getController('document');

            // get current document
            $oDocument = $oDocumentModel->getDocument($obj->document_srl, $this->grant->manager);
            $bAnonymous = false;
            

            // Modifying an existing document
            if($oDocument->isExists() && $oDocument->document_srl == $obj->document_srl) {
				if(!$oDocument->isGranted()) return new Object(-1,'msg_not_permitted');
                $output = $oDocumentController->updateDocument($oDocument, $obj);
                $msg_code = 'success_updated';

            // Inserting a new document
            } else {
                $output = $oDocumentController->insertDocument($obj, $bAnonymous);
                $msg_code = 'success_registed';
                $obj->document_srl = $output->get('document_srl');

                // Verify if an administrator mail exists
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

            // Stop when an error occurs
            if(!$output->toBool()) return $output;

            // Return results
            $this->add('mid', Context::get('mid'));
            $this->add('document_srl', $output->get('document_srl'));

            // Registration success message
            $this->setMessage($msg_code);
        }

        /**
         * @brief processing forum delete document
         **/
        function procForumDeleteDocument() {
            // get document_srl
            $document_srl = Context::get('document_srl');

            // check document_srl
            if(!$document_srl) return $this->doError('msg_invalid_document');

            // instancing document controller
            $oDocumentController = &getController('document');

            // delete document
            $output = $oDocumentController->deleteDocument($document_srl, $this->grant->manager);
            if(!$output->toBool()) return $output;

            // registration success message
            $this->add('mid', Context::get('mid'));
            $this->add('page', $output->get('page'));
            $this->setMessage('success_deleted');
        }

        /**
         * @brief processing forum vote document
         **/
        function procForumVoteDocument() {
            // instancing document controller
            $oDocumentController = &getController('document');

            $document_srl = Context::get('document_srl');
            return $oDocumentController->updateVotedCount($document_srl);
        }

        /**
         * @brief processing forum insert comment
         **/
        function procForumInsertComment() {
            // check grants and registration
            if(!$this->grant->post) return new Object(-1, 'msg_not_permitted');
            $logged_info = Context::get('logged_info');

            // comments data extraction
            $obj = Context::gets('document_srl','comment_srl','parent_srl','content','password','nick_name','member_srl','email_address','homepage','notify_message');
            $obj->module_srl = $this->module_srl;

            // instancing document model
            $oDocumentModel = &getModel('document');
            $oDocument = $oDocumentModel->getDocument($obj->document_srl);
            if(!$oDocument->isExists()) return new Object(-1,'msg_not_permitted');

            // For anonymous use, remove writer's information and notifying information
            $bAnonymous = false;
            
			// instancing comment model
            $oCommentModel = &getModel('comment');

            // instancing comment controller
            $oCommentController = &getController('comment');

            // check comment_srl
            // if not comment_srl then use getNextSequence for a new value
            if(!$obj->comment_srl) {
                $obj->comment_srl = getNextSequence();
            } else {
                $comment = $oCommentModel->getComment($obj->comment_srl, $this->grant->manager);
            }

            // if there is a new comment
            if($comment->comment_srl != $obj->comment_srl) {

                // current comment has parent update comment and notifications
                if($obj->parent_srl) {
                    $parent_comment = $oCommentModel->getComment($obj->parent_srl);
                    if(!$parent_comment->comment_srl) return new Object(-1, 'msg_invalid_request');

                    $output = $oCommentController->insertComment($obj, $bAnonymous);
                    $output= executeQuery('forum.updateComments', $obj);
                    
                    $obj->document_srl=Context::get('document_srl');
                    $output=executeQuery('forum.updateDocumentNotify', $obj);

                // if it doesn't have parent insert comment and update notifications
                } else {
                    $output = $oCommentController->insertComment($obj, $bAnonymous);
                    $output= executeQuery('forum.updateComments', $obj);
                    $obj->document_srl=Context::get('document_srl');
                    $output=executeQuery('forum.updateDocumentNotify', $obj);
                }

                // verifying if the administrator mail is set
                if($output->toBool() && $this->module_info->admin_mail) {
                    $oMail = new Mail();
                    $oMail->setTitle($oDocument->getTitleText());
                    $oMail->setContent( sprintf("From : <a href=\"%s#comment_%d\">%s#comment_%d</a><br/>\r\n%s  ", getFullUrl('','document_srl',$obj->document_srl),$obj->comment_srl, getFullUrl('','document_srl',$obj->document_srl), $obj->comment_srl,$obj->content));
                    $oMail->setSender($obj->user_name, $obj->email_address);
					$author_email=$oDocument->variables['email_address'];
					
					//mail to author of thread
					if($author_email != $obj->email_address) {
						$oMail->setReceiptor($author_email, $author_email);
						$oMail->send();
					}
					//mail to subscribers that turned email notification on
					$comment_list=$oCommentModel->getCommentList($obj->document_srl);
					foreach($comment_list->data as $key_comment){
						if($key_comment->notify_message=='Y'){
							if(!in_array($key_comment->email_address, $already_sent)){
								if($logged_info->email_address!= $key_comment->email_address){
								$already_sent[]=$key_comment->email_address;
								$oMail->setReceiptor($key_comment->user_name, $key_comment->email_address);
								$oMail->content=$oMail->content.sprintf("%s : <a href=\"%s\">%s</a>" ,Context::getLang('mail_unsibscribe') ,getFullUrl('','act','unsubscribeThread','document_srl',$obj->document_srl,'member_srl',$key_comment->member_srl),getFullUrl('','act','unsubscribeThread','document_srl',$obj->document_srl,'member_srl',$key_comment->member_srl));
								$oMail->send();
								}
							}
						}
					}
					
					//mail to all emails set for administrators
                    $target_mail = explode(',',$this->module_info->admin_mail);
                    for($i=0;$i<count($target_mail);$i++) {
                        $email_address = trim($target_mail[$i]);
                        if(!$email_address) continue;
                        if($author_email != $email_address) {
                        	$oMail->setReceiptor($email_address, $email_address);
                        	$oMail->send();
                        }
                    }
                }

            // for a fix comment_srl
            } else {
				// check if it is granted
				if(!$comment->isGranted()) return new Object(-1,'msg_not_permitted');

                $obj->parent_srl = $comment->parent_srl;
                $obj->user_name=$comment->user_name;
                $output= executeQuery('forum.updateComments', $obj);
                $output = $oCommentController->updateComment($obj, $this->grant->manager);
                $comment_srl = $obj->comment_srl;
            }
            if(!$output->toBool()) return $output;

            $this->setMessage('success_registed');
            $this->add('mid', Context::get('mid'));
            $this->add('document_srl', $obj->document_srl);
            $this->add('comment_srl', $obj->comment_srl);
        }

        /**
         * @brief processing forum delete comment
         **/
        function procForumDeleteComment() {
            // get comment_srl and verify if it exists
            $comment_srl = Context::get('comment_srl');
            if(!$comment_srl) return $this->doError('msg_invalid_request');

            // instancing comment controller
            $oCommentController = &getController('comment');

            $output = $oCommentController->deleteComment($comment_srl, $this->grant->manager);
            if(!$output->toBool()) return $output;

            $this->add('mid', Context::get('mid'));
            $this->add('page', Context::get('page'));
            $this->add('document_srl', $output->get('document_srl'));
            $this->setMessage('success_deleted');
        }

        /**
         * @brief processing forum delete trackback
         **/
        function procForumDeleteTrackback() {
            $trackback_srl = Context::get('trackback_srl');

            // instancing trackback controller
            $oTrackbackController = &getController('trackback');
            $output = $oTrackbackController->deleteTrackback($trackback_srl, $this->grant->manager);
            if(!$output->toBool()) return $output;

            $this->add('mid', Context::get('mid'));
            $this->add('page', Context::get('page'));
            $this->add('document_srl', $output->get('document_srl'));
            $this->setMessage('success_deleted');
        }

        /**
         * @brief processing forum verification password
         **/
        function procForumVerificationPassword() {
            // get required variables
            $password = Context::get('password');
            $document_srl = Context::get('document_srl');
            $comment_srl = Context::get('comment_srl');
			// instancing member model
            $oMemberModel = &getModel('member');

            // check if comment_srl is set
            if($comment_srl) {
                // instancing comment model
                $oCommentModel = &getModel('comment');
                $oComment = $oCommentModel->getComment($comment_srl);
                if(!$oComment->isExists()) return new Object(-1, 'msg_invalid_request');

                // verify if the pasword is valid
                if(!$oMemberModel->isValidPassword($oComment->get('password'),$password)) return new Object(-1, 'msg_invalid_password');

                $oComment->setGrant();
            } else {
                // make sure that the document_srl correspond to the current article
                $oDocumentModel = &getModel('document');
                $oDocument = $oDocumentModel->getDocument($document_srl);
                if(!$oDocument->isExists()) return new Object(-1, 'msg_invalid_request');

                // Verify if the password is valid
                if(!$oMemberModel->isValidPassword($oDocument->get('password'),$password)) return new Object(-1, 'msg_invalid_password');

                $oDocument->setGrant();
            }
        }

        /**
         * @brief trigger Member Menu
         **/
        function triggerMemberMenu(&$obj) {
            $member_srl = Context::get('target_srl');
            $mid = Context::get('cur_mid');

            if(!$member_srl || !$mid) return new Object();

            $logged_info = Context::get('logged_info');

            // instancing module model
            $oModuleModel = &getModel('module');
            $cur_module_info = $oModuleModel->getModuleInfoByMid($mid);

            if($cur_module_info->module != 'forum') return new Object();

            // if you click your own username
            if($member_srl == $logged_info->member_srl) {
                $member_info = $logged_info;
            } else {
                $oMemberModel = &getModel('member');
                $member_info = $oMemberModel->getMemberInfoByMemberSrl($member_srl);
            }

            if(!$member_info->user_id) return new Object();

            // add search functionality to id
            $url = getUrl('','mid',$mid,'search_target','nick_name','search_keyword',$member_info->nick_name);
            $oMemberController = &getController('member');
            $oMemberController->addMemberPopupMenu($url, 'cmd_view_own_document', './modules/member/tpl/images/icon_view_written.gif');

            return new Object();
        }

    }
?>
