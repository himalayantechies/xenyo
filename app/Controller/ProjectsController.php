<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProjectsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
		parent::beforeFilter();
		
		if($this->Session->read('Auth.User.role') == 'Support') {
			if(in_array($this->request->params['action'], array('add', 'edit', 'delete'))) {
				$this->Session->setFlash(__('Sorry! You are not allowed here.'), 'default', array('class' => 'note note-danger'));
				return $this->redirect($this->referer());
			}
		}
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Project->recursive = 0;
		$this->Paginator->settings = array('order' => array('Project.name' => 'ASC'), 'limit' => 50);
		$this->set('projects', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Project->exists($id)) {
			throw new NotFoundException(__('Invalid project'));
		}
		
		if($this->Session->read('Auth.User.role') == 'Support') {
			$options['contain'] = array('Epic' => array('conditions' => array('Epic.issue_type' => 'Support', 'Epic.deleted' => 0)));
		} else {
			$options['contain'] = array('Epic' => array('conditions' => array('Epic.deleted' => 0)));
		}
		
		$options['conditions']  = array('Project.' . $this->Project->primaryKey => $id);
		$this->set('project', $this->Project->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Project->create();
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Project->exists($id)) {
			throw new NotFoundException(__('Invalid project'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Project.' . $this->Project->primaryKey => $id));
			$this->request->data = $this->Project->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Project->delete()) {
			$this->Session->setFlash(__('The project has been deleted.'));
		} else {
			$this->Session->setFlash(__('The project could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function updateProjectIssues($manualDate = null) {
		$this->autoRender = false;

		if($this->Session->check('Issue')) {
			$updated = $this->Session->read('Issue.updated');
			$startAt = $this->Session->read('Issue.startAt') + $this->Session->read('Issue.maxResults');
		} else {
			$updated = $this->Project->Issue->field('MAX(updated)', array('Issue.id >' => 0));
			$startAt = 0;
		}
		
		if(is_null($updated)) $updated = '2014-01-01';
		if(is_null($manualDate)) {
			$updated = date('Y-m-d', strtotime($updated));
		} else {
			$updated = date('Y-m-d', strtotime($manualDate));
		}
		
		$issues = file_get_contents(Router::url(array('controller' => 'pages', 'action' => 'curl', 'issues', $updated, $startAt), true));
		$issues = json_decode($issues, true);
		
		$return['updated'] 		= $updated;
		$return['startAt'] 		= $issues['startAt'];
		$return['maxResults'] 	= $issues['maxResults'];
		$return['total'] 		= $issues['total'];
		
		if(($issues['startAt'] + $issues['maxResults']) >= $issues['total']) {
			$this->Session->delete('Issue');
		} else {
			$this->Session->write('Issue.updated', $updated);
			$this->Session->write('Issue.startAt', $issues['startAt']);
			$this->Session->write('Issue.maxResults', $issues['maxResults']);
			$this->Session->write('Issue.total', $issues['total']);
		}
		
		if(!is_null($issues)) {
			foreach($issues['issues'] as $result) {
				$issue = $user = array();
				$issue['id'] 					= $result['id'];
				$issue['key'] 					= $result['key'];
				$issue['self'] 					= $result['self'];
				$issue['description'] 			= $result['fields']['summary'];
				
				$issue['hours_spent'] = $issue['hours_remaining'] = $issue['complete_percentage'] = 0;
				if(isset($result['fields']['aggregateprogress']['percent'])) {
					$progress = $result['fields']['aggregateprogress']['progress'];
					$issue['hours_spent'] = $progress/3600;
					$issue['hours_remaining'] = ($result['fields']['aggregateprogress']['total'] - $progress)/3600;
					$issue['complete_percentage'] = $result['fields']['aggregateprogress']['percent'];
				}
				$issue['issuetype'] 			= $result['fields']['issuetype']['name'];
				$issue['subtask'] 				= $result['fields']['issuetype']['subtask'];
				$issue['priority'] 				= $result['fields']['priority']['name'];
				$issue['status'] 				= $result['fields']['status']['name'];
				$issue['project_id'] 			= $result['fields']['project']['id'];
				$issue['worklog'] 				= 0;
				
				/* if(isset($result['fields']['customfield_10003'])) {
					$issue['business_value'] = $result['fields']['customfield_10003'];
				} else {
					$issue['business_value'] = null;
				} */
				if(isset($result['fields']['customfield_10006'])) {
					$issue['epic_link'] = $result['fields']['customfield_10006'];
				} else {
					$issue['epic_link'] = null;
				}
				if(isset($result['fields']['customfield_10007'])) {
					$issue['epic_name'] = $result['fields']['customfield_10007'];
				} else {
					$issue['epic_name'] = null;
				}
				
				$issue['created'] = substr(str_replace('T', ' ', $result['fields']['created']), 0, strpos($result['fields']['created'], '.'));
				$issue['updated'] = substr(str_replace('T', ' ', $result['fields']['updated']), 0, strpos($result['fields']['updated'], '.'));
					
				$this->Project->save($result['fields']['project']);
				
				$this->loadModel('User');
				$user['User']['name'] 		= $result['fields']['assignee']['displayName'];
				$user['User']['username'] 	= $result['fields']['assignee']['name'];
				$user['User']['email'] 		= $result['fields']['assignee']['emailAddress'];
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
				$issue['assignee'] 	= $result['fields']['assignee']['name'];
				$issue['user_id'] 	= $assignee;
				
				if($issue['issuetype'] == 'Epic') {
					$this->Project->Epic->save($issue);
				} else {
					$this->Project->Issue->save($issue);
				}
			}
		}
		return json_encode($return);
	}
}
