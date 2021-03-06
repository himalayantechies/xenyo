<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->Auth->allow('curl');
	}
	
	
/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout')); 

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

	public function curl($url, $criteria, $startAt = 0) {
		$this->autoRender = false;
		
		//$issues = file_get_contents(Router::url(array('controller' => 'pages', 'action' => 'curl', 'issues', $updated, $startAt), true));
		//$issues = json_decode($issues, true);
		//$worklogs = file_get_contents(Router::url(array('controller' => 'pages', 'action' => 'curl', 'worklog', $result['Issue']['id']), true));
		//$worklogs = json_decode($worklogs, true);
		
		if($url == 'issues') {
			$ch = curl_init('http://jira.xenyo.net/rest/api/2/search?jql=updated>=' . $criteria . '+order+by+updated+asc&startAt=' . $startAt . '&maxResults=30');
		} elseif($url == 'worklog') {
			//$ch = curl_init('http://jira.xenyo.net/rest/api/2/issue/' . $criteria);
			$ch = curl_init('http://jira.xenyo.net/rest/api/2/issue/' . $criteria . '/worklog');
		}
		
		curl_setopt($ch, CURLOPT_USERPWD, 'matt:xenyo4748');
		$server_output = curl_exec($ch);
		curl_close($ch);
		
		return json_decode($result);
	}

	public function deleted_list() {
	
		$this->loadModel('Epic');
		$options['contain'] 	= false;
		$options['conditions']  = array('deleted' => 1);
		$this->set('epics', $this->Epic->find('all', $options));
		
		$this->loadModel('Issue');
		$options['contain'] 	= false;
		$options['conditions']  = array('Issue.deleted' => 1);
		$this->set('issues', $this->Issue->find('all', $options));
		
		$this->loadModel('Worklog');
		$options['contain'] 	= array('Project', 'Issue');
		$options['conditions']  = array('Worklog.deleted' => 1);
		$this->set('worklogs', $this->Worklog->find('all', $options));
		
	}
}
