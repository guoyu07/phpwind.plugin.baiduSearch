<?php
defined('WEKIT_VERSION') or exit(403);
/**
 * 前台入口
 *
 * generated by phpwind.com
 */
class IndexController extends PwBaseController {
	
	public function beforeAction($handlerAdapter) {
		parent::beforeAction($handlerAdapter);
		//TODO do something before all the action
		if (!Wekit::C('site', 'search.isopen')) {
			$this->forwardRedirect(WindUrlHelper::createUrl('search/search/run'));
		}
	}
	
	public function run() {
		//TODO Insert your code here
		$q		 = $this->getInput("keywords");
		$search  = $this->_loadMedzServer()->medz("search");
		$urlArgs = array(
			's'		=> $search['s'],	// 百度站内搜索引擎ID
			'q'		=> $q,				// 搜索关键词
			'entry' => $search['entry']	// 是否开启搜索记录<1|2>
		);
		$url  = 'http://';
		$url .= $search['domain'] . '/cse/search?';
		$url .= WindUrlHelper::argsToUrl($urlArgs);
		$this->forwardRedirect($url);
		exit;
	}
	
	private function _loadMedzServer() {
		return Wekit::load('EXT:search.service.helps.App_Medz_Server');
	}
}
