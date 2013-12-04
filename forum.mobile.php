<?php
/* Copyright (C) NAVER <http://www.navercorp.com> */
require_once(_XE_PATH_.'modules/forum/forum.view.php');

class forumMobile extends forumView
{
	function init()
	{
		if($this->module_info->list_count) $this->list_count = $this->module_info->list_count;
		if($this->module_info->search_list_count) $this->search_list_count = $this->module_info->search_list_count;
		if($this->module_info->page_count) $this->page_count = $this->module_info->page_count;
		$this->except_notice = $this->module_info->except_notice == 'N' ? false : true;

		/**
		 * Check consultation option
		 * check if the current user is an administrator
		 **/
		if($this->module_info->consultation == 'Y' && !$this->grant->manager)
		{
			$this->consultation = true;
			if(!Context::get('is_logged')) $this->grant->post = false;
		}
		else
		{
			$this->consultation = false;
		}

		$oDocumentModel = &getModel('document');
		$extra_keys = $oDocumentModel->getExtraKeys($this->module_info->module_srl);
		Context::set('extra_keys', $extra_keys);

		$template_path = sprintf("%sm.skins/%s/",$this->module_path, $this->module_info->mskin);
		if(!is_dir($template_path)||!$this->module_info->mskin)
		{
			$this->module_info->mskin = 'default';
			$template_path = sprintf("%sm.skins/%s/",$this->module_path, $this->module_info->mskin);
		}
		$this->setTemplatePath($template_path);
		Context::addJsFilter($this->module_path.'tpl/filter', 'input_password.xml');
	}

	function dispForumCategory()
	{
		$this->dispForumCategoryList();
		$category_list = Context::get('category_list');
		$this->setTemplateFile('category.html');
	}

	function getForumCommentPage()
	{
		$document_srl = Context::get('document_srl');
		$oDocumentModel =& getModel('document');
		if(!$document_srl) return new Object(-1, "msg_invalid_request");

		$oDocument = $oDocumentModel->getDocument($document_srl);
		if(!$oDocument->isExists()) return new Object(-1, "msg_invalid_request");

		Context::set('oDocument', $oDocument);
		$oTemplate = new TemplateHandler;
		$html = $oTemplate->compile($this->getTemplatePath(), "comment.html");
		$this->add("html", $html);
	}

	function dispForumMessage($msg_code)
	{
		$msg = Context::getLang($msg_code);
		$oMessageObject = &ModuleHandler::getModuleInstance('message','mobile');
		$oMessageObject->setError(-1);
		$oMessageObject->setMessage($msg);
		$oMessageObject->dispMessage();

		$this->setTemplatePath($oMessageObject->getTemplatePath());
		$this->setTemplateFile($oMessageObject->getTemplateFile());
	}

	 /**
	 * Retrieves all forum categories and displays them
	 */
	function dispForumCategoryListIndex()
	{
		if(!$this->grant->access ) return $this->dispForumMessage('msg_not_permitted');

		$categorylist = $this->dispForumCategoryList();
		Context::set('module_srl', $this->module_info->module_srl);
		$this->setTemplateFile('list');

		return $categorylist;
	}
}
