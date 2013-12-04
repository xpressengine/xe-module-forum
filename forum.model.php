<?php
/* Copyright (C) NAVER <http://www.navercorp.com> */
/**
 * @class  forumModel
 * @author NAVER (developers@xpressengine.com)
 * @brief  forum modul Model class
 **/
class forumModel extends module
{
	/**
	 * @brief Initialization
	 **/
	function init()
	{
	}

	/**
	 * @brief get list configuration
	 **/
	function getListConfig($module_srl)
	{
		$oModuleModel = &getModel('module');
		$oDocumentModel = &getModel('document');

		// get module partial configuration
		$list_config = $oModuleModel->getModulePartConfig('forum', $module_srl);
		if(!$list_config || !count($list_config)) $list_config = array('readed_count','comment_count','last_update');

		// get module extra keys
		$inserted_extra_vars = $oDocumentModel->getExtraKeys($module_srl);

		foreach($list_config as $key)
		{
			if(preg_match('/^([0-9]+)$/',$key))
			{
				$output['extra_vars'.$key] = $inserted_extra_vars[$key];
			}
			else
			{
				$output[$key] = new ExtraItem($module_srl, -1, Context::getLang($key), $key, 'N', 'N', 'N', null);
			}
		}
		return $output;
	}

	/**
	 * @brief get degault list configuration
	 **/
	function getDefaultListConfig($module_srl)
	{
		// setting up module virtual vars
		$virtual_vars = array('regdate', 'last_update', 'readed_count','comment_count','Replies');
		foreach($virtual_vars as $key)
		{
			$extra_vars[$key] = new ExtraItem($module_srl, -1, Context::getLang($key), $key, 'N', 'N', 'N', null);
		}

		// instancing document model
		$oDocumentModel = &getModel('document');
		$inserted_extra_vars = $oDocumentModel->getExtraKeys($module_srl);

		if(count($inserted_extra_vars))
		{
			foreach($inserted_extra_vars as $obj)
			{
				$extra_vars['extra_vars'.$obj->idx] = $obj;
			}
		}

		return $extra_vars;

	}
	/**
	 * @brief verify if a user is set for email notifications on a document
	 **/
	function isNotified($obj)
	{
		$output= executeQueryArray('forum.getNotifyMessage', $obj);
		$oDocumentModel=&getModel('document');
		$document_srl=Context::get('document_srl');
		$oDocument=$oDocumentModel->getDocument($document_srl);
		$notification=0;
		if($oDocument->variables['notify_message'] == 'Y') $notification = 1;

		if(isset($output->data))
		{
			foreach ($output->data as $notified)
			{
				if($notified->notify_message == 'Y') $notification = 1;
			}
		}
		return $notification;
	}

	/**
	 * @brief return module name in sitemap
	 **/
	function triggerModuleListInSitemap(&$obj)
	{
		array_push($obj, 'forum');
	}


}
