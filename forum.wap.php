<?php
/* Copyright (C) NAVER <http://www.navercorp.com> */
/**
 * @class  forumWAP
 * @author NAVER (developers@xpressengine.com)
 * @brief  forum module WAP class
 **/
class forumWAP extends forum
{
	/**
	 * @brief wap procedure method
	 **/
	function procWAP(&$oMobile)
	{
		// check permissions
		if($this->module_info->consultation == 'Y') return $oMobile->setContent(Context::getLang('msg_not_permitted'));

		// instancing document model
		$oDocumentModel = &getModel('document');

		// get the selected document_srl
		$document_srl = Context::get('document_srl');
		if($document_srl)
		{
			$oDocument = $oDocumentModel->getDocument($document_srl);
			if($oDocument->isExists())
			{
				// set browser title with the document title
				Context::setBrowserTitle($oDocument->getTitleText());

				// if action display forum content comment list
				if($this->act=='dispForumContentCommentList')
				{

					$oCommentModel = &getModel('comment');
					$output = $oCommentModel->getCommentList($oDocument->document_srl, 0, false, $oDocument->getCommentCount());

					$content = '';
					if(count($output->data))
					{
						foreach($output->data as $key => $val)
						{
							$oComment = new commentItem();
							$oComment->setAttribute($val);
							if(!$oComment->isAccessible()) continue;
							$content .= "<b>".$oComment->getNickName()."</b> (".$oComment->getRegdate("Y-m-d").")<br>\r\n".$oComment->getContent(false,false)."<br>\r\n";
						}
					}

					// set content
					$oMobile->setContent( $content );

					// back to the list specified in the parrent page
					$oMobile->setUpperUrl( getUrl('act',''), Context::getLang('cmd_go_upper') );

				// view comments and documents
				}
				else
				{
					// strip tags form content
					$content = strip_tags(str_replace('<p>','<br>&nbsp;&nbsp;&nbsp;',$oDocument->getContent(false,false,false)),'<br><b><i><u><em><small><strong><big>');

					// for information on top show links
					$content = Context::getLang('replies').' : <a href="'.getUrl('act','dispForumContentCommentList').'">'.$oDocument->getCommentCount().'</a><br>'."\r\n".$content;
					$content = '<b>'.$oDocument->getNickName().'</b> ('.$oDocument->getRegdate("Y-m-d").")<br>\r\n".$content;

					//set content
					$oMobile->setContent( $content );

					// back to the list specified in the parrent page
					$oMobile->setUpperUrl( getUrl('document_srl',''), Context::getLang('cmd_list') );
				}

				return;
			}
		}

		// set arguments
		$args->module_srl = $this->module_srl;
		$args->page = Context::get('page');;
		$args->list_count = 9;
		$args->sort_index = $this->module_info->order_target?$this->module_info->order_target:'list_order';
		$args->order_type = $this->module_info->order_type?$this->module_info->order_type:'asc';
		$output = $oDocumentModel->getDocumentList($args, $this->except_notice);
		$document_list = $output->data;
		$page_navigation = $output->page_navigation;

		$childs = array();
		if($document_list && count($document_list))
		{
			foreach($document_list as $key => $val)
			{
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

		// specify next/prevUrl
		if($page>1) $oMobile->setPrevUrl(getUrl('mid',$_GET['mid'],'page',$page-1), sprintf('%s (%d/%d)', Context::getLang('cmd_prev'), $page-1, $totalPage));

		if($page<$totalPage) $oMobile->setNextUrl(getUrl('mid',$_GET['mid'],'page',$page+1), sprintf('%s (%d/%d)', Context::getLang('cmd_next'), $page+1, $totalPage));

		$oMobile->mobilePage = $page;
		$oMobile->totalPage = $totalPage;
	}
}
