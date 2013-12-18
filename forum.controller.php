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
            if(Context::get('is_logged') && $logged_info->is_admin!='Y') $obj->allow_comment='Y';
            $obj->content = strip_tags($obj->content,'<p><a><b><ul><li><span><u><i><strike><sup><sub><div><ol><blockquote><br><table><tbody><tr><td><tfoot><thead><img>');
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
                //$this->insert_document_alias($obj);

            // Inserting a new document
            } else {
                $output = $oDocumentController->insertDocument($obj, $bAnonymous);
                $msg_code = 'success_registed';
                $insert_alias = true;
                $insert_alias = $this->insert_document_alias($obj);
                if(!$insert_alias) return new Object(-1,'thread title already exists');
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
			$args=Context::getRequestVars();
			$args->quote_content=html_entity_decode($args->quote_content);
			// comments data extraction
			$obj = Context::gets('document_srl','comment_srl','parent_srl','content','password','nick_name','member_srl','email_address','homepage','notify_message');
			$obj->module_srl = $this->module_srl;
			$obj->content=$args->quote_content.$obj->content;
			if($args->quote_content)	$obj->use_html="Y";
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
				if($output->toBool()) {
					//check if comment writer is admin or not
					$oMemberModel = &getModel("member");
					if (isset($obj->member_srl) && !is_null($obj->member_srl))
					{
						$member_info = $oMemberModel->getMemberInfoByMemberSrl($obj->member_srl);
					}
					else
					{
						$member_info->is_admin = 'N';
					}

					// if current module is using Comment Approval System and comment write is not admin user then
					if(method_exists($oCommentController,'isModuleUsingPublishValidation') && $oCommentController->isModuleUsingPublishValidation($this->module_srl) && $member_info->is_admin != 'Y')
					{
						//$oCommentController->sendEmailToAdminAfterInsertComment($obj);
						$this->setMessage('comment_to_be_approved');
					}
					else
					{
						$this->setMessage('success_registed');
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
				// $comment_srl = $obj->comment_srl;
			}
			if(!$output->toBool()) return $output;

			//$this->setMessage('success_registed');
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

    	function procForumBanUser() {
            // get member_srl and verify if it exists
            $obj->member_srl = Context::get('member_srl');
            $obj->ipaddress = Context::get('ipaddress');
            $obj->delete_user = Context::get('delete_user');
            $obj->ban_ip = Context::get('ban_ip');
            $obj->ban_id = Context::get('ban_id');
            $obj->delete_comments_and_threads = Context::get('delete_comments_and_threads');
            $document_srl=Context::get('document_srl');
            if(!$obj->member_srl) return $this->doError('msg_invalid_request');

            // instancing controllers
            $oMemberModel = &getModel('member');
            $oDocumentController = &getController('document');
            $oCommentController = &getController('comment');

            if($obj->delete_comments_and_threads == 'Y'){
	            $output = executeQuery('forum.deleteCommentsbyModuleSrl', $obj);
	            $documents=executeQuery('forum.getDocumentSrlsbyMemberSrl',$obj)->data;
	            if(count($documents)>1)
			            foreach ($documents as $document){
			            	$output = $oDocumentController->deleteDocument($document->document_srl,$this->grant->manager);
			            	$output = $oCommentController->deleteComments($document->document_srl,$this->grant->manager);
			            }
			         else {
			         		$output = $oDocumentController->deleteDocument($documents->document_srl,$this->grant->manager);
			            	$output = $oCommentController->deleteComments($documents->document_srl,$this->grant->manager);
			         }
            }
			if($obj->ban_id){
            	$member_info = $oMemberModel->getMemberInfoByMemberSrl($obj->member_srl);
				if($member_info) $output = executeQuery('member.insertDeniedID', $member_info);
			}
			if($obj->ban_ip) if($obj->ipaddress) $output = executeQuery('spamfilter.insertDeniedIP', $obj);
			if($obj->delete_user) $output = executeQuery('member.deleteMember', $obj);

            $this->add('mid', Context::get('mid'));
            $this->add('page', Context::get('page'));
            $this->add('ipaddress','');
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
         * @brief trigger for sending emails to all subscribers of the comment's parent thread
         **/
        function triggerSendMailToSubscribers(&$comment_srl_list)
	{
		//get admin info
		$logged_info = Context::get('logged_info');
		 // instancing module model
		$oModuleModel = &getModel('module');
		
		 // instancing module model
		$oCommentController = &getController('comment');
		
		// create the model object of the document
		$oDocumentModel = &getModel('document');
		
		// create the comment model object
		$oCommentModel = &getModel('comment');
			
		// create new mail object
		$oMail = new Mail();
		foreach ($comment_srl_list as $comment_srl) 
		{
			
			// create object comment for current comment_srl
			$comment = $oCommentModel->getComment($comment_srl);
			
			$comment_module_info = $oModuleModel->getModuleInfoByModuleSrl($comment->module_srl);
			if($comment_module_info->module == $this->module)
			{
				$oDocument = $oDocumentModel->getDocument($comment->document_srl);
				
				// check if comment's module is using Comment Approval System
				if(method_exists($oCommentController,'isModuleUsingPublishValidation') )
				{
					$using_validation = $oCommentController->isModuleUsingPublishValidation($comment->module_srl);
				}
				else
				{
					$using_validation = false;
				}
				
				if ($using_validation)
				{
					// setting subject for email
					$mail_title = "[XE - ".$comment_module_info->mid."] comment(s) status changed to published on thread: \"".$oDocument->getTitleText()."\"";
					// setting content of email
					$mail_content = "
						The comment #".$comment_srl." on document \"".$oDocument->getTitleText()."\" has been approved by admin of <strong><i>".  strtoupper($comment_module_info->mid)."</i></strong> module.
						<br />
						<br />Comment content:
						".$comment->content."
						<br />
					";
				}
				else
				{
					// setting subject for email
					$mail_title = "[XE - ".$comment_module_info->mid."] new comment was written on thread: \"".$oDocument->getTitleText()."\"";
					// setting content of email
					$mail_content = "
						Dear subscriber,
						<br />
						<br />
						The comment #".$comment_srl." was written on document \"".$oDocument->getTitleText()."\".
						<br />
						<br />Author: ".$comment->nick_name."
						<br />Author email: ".$comment->email_address."
						<br />Comment content:
						".$comment->content."
						<br />
					";
				}
				$oMail->setTitle($mail_title);
				$oMail->setContent($mail_content);
				// setting FROM attribute of email
				$oMail->setSender($logged_info->user_name, $logged_info->email_address);		
		
				// mail to subscribers that turned email notification on - START
				// get a list of comments for parent document (thread)
				$comment_list=$oCommentModel->getCommentList($comment->document_srl);
				// do send mails if we have a list of comments for parent document
				if($comment_list->data)
				{
					$already_sent = array();
					foreach($comment_list->data as $key_comment)
					{
						if($key_comment->notify_message=='Y')
						{
							if(!in_array($key_comment->email_address, $already_sent))
							{
								if($logged_info->email_address != $key_comment->email_address)
								{
									$already_sent[] = $key_comment->email_address;
									// setting TO attribute of email
									$oMail->setReceiptor($key_comment->user_name, $key_comment->email_address);
									// adding to content link for unsubscribe to current thread
									$oMail->setContent($mail_content.sprintf("%s : <a href=\"%s\">%s</a>" ,Context::getLang('mail_unsibscribe') ,getFullUrl('','act','unsubscribeThread','document_srl',$comment->document_srl,'member_srl',$key_comment->member_srl),getFullUrl('','act','unsubscribeThread','document_srl',$comment->document_srl,'member_srl',$key_comment->member_srl)));
									$oMail->send();
								}
							}
						}
					}
				}
				//mail to subscribers that turned email notification on - STOP
			}
		}
		return ;
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


        function insert_document_alias($obj)
	     {
	         $oDocumentController = &getController('document');
	         $oDocumentModel = &getModel('document');
	         $alias = $obj->title;
	         $output = executeQuery('forum.getAlias', $obj);
	         if(!isset($output->data)){
	         	$oDocumentController->insertAlias($obj->module_srl, $obj->document_srl, $alias);
	         	return true;
	         }
			else {
				$document = $oDocumentModel->getDocument($output->data->document_srl)->variables;
				if($obj->category_srl == $document['category_srl']){
					return false;
				}
				else{
					$category = $oDocumentModel->getCategory($obj->category_srl);
					$alias = $category->title.'|'.$alias;
					while ($category->parent_srl ) {
						$category = $oDocumentModel->getCategory($category->parent_srl);
						$alias = $category->title.'|'.$alias;
						$args->title = $alias;
						$output = executeQuery('forum.getAlias', $args);
						if(isset($output->data)) return false;
					}
					$oDocumentController->insertAlias($obj->module_srl, $obj->document_srl, $alias);
					return true;
				}
			}

	     }



    }
?>
