<?php
App::uses('AppController', 'Controller');
/**
 * Worklogs Controller
 *
 * @property Worklog $Worklog
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class WorklogsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
		parent::beforeFilter();
		
		if($this->Session->read('Auth.User.role') == 'Support') {
			$this->Session->setFlash(__('Sorry! You are not allowed here.'), 'default', array('class' => 'note note-danger'));
			return $this->redirect($this->referer());
		}
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Worklog->recursive = 0;
		$this->set('worklogs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Worklog->exists($id)) {
			throw new NotFoundException(__('Invalid worklog'));
		}
		$options = array('conditions' => array('Worklog.' . $this->Worklog->primaryKey => $id));
		$this->set('worklog', $this->Worklog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Worklog->create();
			if ($this->Worklog->save($this->request->data)) {
				$this->Session->setFlash(__('The worklog has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The worklog could not be saved. Please, try again.'));
			}
		}
		$issues = $this->Worklog->Issue->find('list');
		$this->set(compact('issues'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Worklog->exists($id)) {
			throw new NotFoundException(__('Invalid worklog'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Worklog->save($this->request->data)) {
				$this->Session->setFlash(__('The worklog has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The worklog could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Worklog.' . $this->Worklog->primaryKey => $id));
			$this->request->data = $this->Worklog->find('first', $options);
		}
		$issues = $this->Worklog->Issue->find('list');
		$this->set(compact('issues'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Worklog->id = $id;
		if (!$this->Worklog->exists()) {
			throw new NotFoundException(__('Invalid worklog'));
		}
		$this->request->onlyAllow('post', 'delete');

		//if ($this->Worklog->delete()) {
		if ($this->Worklog->saveField('deleted', 1)) {
			$this->Session->setFlash(__('The worklog has been deleted.'), 'default', array('class' => 'note note-success'));
		} else {
			$this->Session->setFlash(__('The worklog could not be deleted. Please, try again.'), 'default', array('class' => 'note note-danger'));
		}
		return $this->redirect($this->referer());
	}

/**
 * restore method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function restore($id = null) {
		$this->Worklog->id = $id;
		if ($this->Worklog->saveField('deleted', 0)) {
			$this->Session->setFlash(__('The worklog has been restored.'), 'default', array('class' => 'note note-success'));
		} else {
			$this->Session->setFlash(__('The worklog could not be restored. Please, try again.'), 'default', array('class' => 'note note-danger'));
		}
		return $this->redirect($this->referer());
	}
	
	public function updateWorkLogs($issue_id = null) {
		$this->autoRender = false;
		$epic = 0;
		$options['contain'] 	= false;
		if(is_null($issue_id)) {
			$options['conditions'] 	= array('worklog' => 0);
		} else {
			$options['conditions'] 	= array('id' => $issue_id);
		}
		$options['limit'] 		= 5;
		$issues = $this->Worklog->Epic->find('all', $options);
		if(count($issues) > 0) {
			$epic = 1;
		} else {
			$issues = $this->Worklog->Issue->find('all', $options);
		}
		$return = '';
		foreach($issues as $count => $result) {
			if(isset($result['Epic'])) {
				$result['Issue'] = $result['Epic'];
				$return .= 'Epic: ';
			}
			$return .= $result['Issue']['id'] . '<br />';
			$worklogs = file_get_contents(Router::url(array('controller' => 'pages', 'action' => 'curl', 'worklog', $result['Issue']['id']), true));
			$worklogs = json_decode($worklogs, true);
			
			//debug($worklogs);
			
			$this->Worklog->deleteAll(array('Worklog.issue_id' => $result['Issue']['id']), true);
			
			if(isset($worklogs['errorMessages'][0])) {
				if($worklogs['errorMessages'][0] == 'Issue Does Not Exist' ||
				   $worklogs['errorMessages'][0] == 'You do not have the permission to see the specified issue.') {
					
				   	if($epic) {
						$this->Worklog->Epic->id = $result['Issue']['id'];
						$this->Worklog->Epic->delete();
					} else {
						$this->Worklog->Issue->id = $result['Issue']['id'];
						$this->Worklog->Issue->delete();
					}
				}
			} else {
				//foreach($worklogs['fields']['worklog']['worklogs'] as $worklog) {
				foreach($worklogs['worklogs'] as $worklog) {
					$user = array();
					$this->loadModel('User');
					$user['User']['name'] 		= (isset($worklog['author']['displayName']))?$worklog['author']['displayName']: '';
					$user['User']['username'] 	= $worklog['author']['name'];
					$user['User']['email'] 		= (isset($worklog['author']['emailAddress']))?$worklog['author']['emailAddress']: '';
					$user['User']['role'] 		= 'Developer';
					$user['User']['password']	= '123456';
					$exists = $this->User->findByUsername($user['User']['username']);
					$assignee = null;
					if(empty($exists)) {
						$this->User->create();
						$this->User->save($user);
						$assignee = $this->User->getLastInsertId();
					} else {
						$assignee = $exists['User']['id'];
					}
					
					$worklog['user_id'] = $assignee;
					$worklog['author'] = $worklog['author']['name'];
					$worklog['updateAuthor'] = $worklog['updateAuthor']['name'];
					$worklog['issue_id'] = $result['Issue']['id'];
					$worklog['project_id'] = $result['Issue']['project_id'];
				
					$worklog['created'] = substr(str_replace('T', ' ', $worklog['created']), 0, strpos($worklog['created'], '.'));
					$worklog['updated'] = substr(str_replace('T', ' ', $worklog['updated']), 0, strpos($worklog['updated'], '.'));
					$worklog['started'] = substr(str_replace('T', ' ', $worklog['started']), 0, strpos($worklog['started'], '.'));
				
					$this->Worklog->save($worklog);
				}
					
				if(isset($worklogs['fields']['timetracking']['originalEstimateSeconds'])) {
					$result['Issue']['originalEstimateSeconds'] = $worklogs['fields']['timetracking']['originalEstimateSeconds'];
				}
				if(isset($worklogs['fields']['timetracking']['remainingEstimateSeconds'])) {
					$result['Issue']['remainingEstimateSeconds'] = $worklogs['fields']['timetracking']['remainingEstimateSeconds'];
				}
				if(isset($worklogs['fields']['timetracking']['timeSpentSeconds'])) {
					$result['Issue']['timeSpentSeconds'] = $worklogs['fields']['timetracking']['timeSpentSeconds'];
				}
				
				$result['Issue']['worklog'] = 1;
				if($epic) {
					$this->Worklog->Epic->save($result['Issue']);
				} else {
					$this->Worklog->Issue->save($result['Issue']);
				}
			}
		}
		if(is_null($issue_id)) {
			return $return;
		} else {
			$this->redirect($this->referer());
		}
	}
}