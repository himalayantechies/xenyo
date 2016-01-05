<?php
App::uses('AppController', 'Controller');
/**
 * Issues Controller
 *
 * @property Issue $Issue
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class IssuesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
		parent::beforeFilter();
		
		if($this->Session->read('Auth.User.role') == 'Support') {
			if(in_array($this->request->params['action'], array('save', 'delete', 'restore'))) {
				$this->Session->setFlash(__('Sorry! You are not allowed here.'), 'default', array('class' => 'note note-danger'));
				return $this->redirect($this->referer());
			}
		}
	}

/**
 * index method to copy over issues time worklog from jira to redmine
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function index() {
		
		$authors = array(
					'andy' => 6, 'azhar' => 7, 'd2thanh' => 8, 'gordon' => 9, 'henry' => 10, 'ho' => 11, 
					'Ivan' => 12, 'jan' => 13, 'kelvinxenyo' => 14, 'kristin' => 15, 'matt' => 16, 'thomas' => 17,
					'keith' => 18
		);
		
		$this->autoRender = false;
		
		$options['contain'] 	= array('User', 'Worklog');
		$options['conditions'] 	= array('Issue.id >' => 13425);
		$options['limit'] 		= 180;
		$options['order']		= 'Issue.id ASC';
		$issues = $this->Issue->find('all', $options);
		
		foreach($issues as $issue) {
			debug($issue['Issue']['id'] . ' - ' . $issue['Issue']['key']);

			$options = array();
			$this->loadModel('RedmineIssue');
			$options['contain'] 	= false;
			$options['conditions'] 	= array('description LIKE' => '%"' . $issue['Issue']['key'] . '"%');
			$redmine = $this->RedmineIssue->find('first', $options);
			
			if(!empty($redmine)) {
				
				$timeentries['project_id'] = $redmine['RedmineIssue']['project_id'];
				$timeentries['issue_id'] = $redmine['RedmineIssue']['id'];
				
				foreach($issue['Worklog'] as $worklog) {
					$this->RedmineIssue->TimeEntry->create();
					
					$started = split('-', substr($worklog['started'], 0, 10));
					
					$timeentries['user_id'] = $authors[$worklog['author']];
					$timeentries['hours'] = $worklog['timeSpentSeconds']/3600;
					$timeentries['activity_id'] = 7;
					$timeentries['spent_on'] = $worklog['started'];
					$timeentries['tyear'] = date('Y', strtotime($worklog['started']));
					$timeentries['tmonth'] = date('m', strtotime($worklog['started']));
					$timeentries['tweek'] = date('W', strtotime($worklog['started']));
					$timeentries['created_on'] = $worklog['created'];
					$timeentries['updated_on'] = $worklog['updated'];
					
					$this->RedmineIssue->TimeEntry->save($timeentries);
				}
			}
		}
	}
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Issue->exists($id)) {
			throw new NotFoundException(__('Invalid issue'));
		}
	
		$options['contain'] 	= array('User', 'Project', 'Worklog' => array('conditions' => array('Worklog.deleted' => 0)));
		$options['conditions'] 	= array('Issue.' . $this->Issue->primaryKey => $id);
		$issue = $this->Issue->find('first', $options);
		$this->set('issue', $issue);
	}
	
/**
 * save method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function save($id = null) {
		$this->autoRender = false;
		if ($this->request->is('ajax') && $this->request->is(array('post', 'put'))) {
			if (!$this->Issue->exists($id)) {
				throw new NotFoundException(__('Invalid issue'));
			}
			$this->Issue->create();
			$this->Issue->id = $id;
			$this->request->data['Issue']['updated'] = false;
			
			if ($this->Issue->save($this->request->data)) {
			} else {
				$this->Session->setFlash(__('The Issue could not be saved. Please, try again.'), 'default', array('class' => 'note note-danger'));
			}
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
		$this->Issue->id = $id;
		if (!$this->Issue->exists()) {
			throw new NotFoundException(__('Invalid Issue'));
		}
		$this->request->onlyAllow('post', 'delete');
		
		//if ($this->Issue->delete()) {
		if ($this->Issue->saveField('deleted', 1)) {
			$this->Session->setFlash(__('The Issue has been deleted.'), 'default', array('class' => 'note note-success'));
		} else {
			$this->Session->setFlash(__('The Issue could not be deleted. Please, try again.'), 'default', array('class' => 'note note-danger'));
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
		$this->Issue->id = $id;
		if ($this->Issue->saveField('deleted', 0)) {
			$this->Session->setFlash(__('The issue has been restored.'), 'default', array('class' => 'note note-success'));
		} else {
			$this->Session->setFlash(__('The issue could not be restored. Please, try again.'), 'default', array('class' => 'note note-danger'));
		}
		return $this->redirect($this->referer());
	}
	
}
