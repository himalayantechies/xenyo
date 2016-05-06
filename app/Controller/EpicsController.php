<?php
App::uses('AppController', 'Controller');
/**
 * Epics Controller
 *
 * @property Epic $Epic
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EpicsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
		parent::beforeFilter();
		
		if($this->Session->read('Auth.User.role') == 'Support') {
			if(in_array($this->request->params['action'], array('index', 'add', 'edit', 'delete', 'restore'))) {
				$this->Session->setFlash(__('Sorry! You are not allowed here.'), 'default', array('class' => 'note note-danger'));
				return $this->redirect($this->referer());
			}
			
			if($this->request->params['action'] == 'report' && $this->request->params['pass']['0'] == 'Project') {
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
	public function index($id = null) {
		if ($this->request->is('ajax') && $this->request->is(array('post', 'put'))) {
			if (!$this->Epic->exists($id)) {
				throw new NotFoundException(__('Invalid issue'));
			}
			$this->autoRender = false;
			$this->Epic->create();
			$this->Epic->id = $id;
			$this->request->data['Epic']['updated'] = false;
			
			if(isset($this->request->data['Epic']['month_year'])) {
				if($this->request->data['Epic']['month_year'] == '') {
					$this->request->data['Epic']['month_year'] = null;
				} else {
					$this->request->data['Epic']['month_year'] = date('Y-m-1', strtotime($this->request->data['Epic']['month_year']));
				}
			}
			if ($this->Epic->save($this->request->data)) {
				//$this->Session->setFlash(__('The issue has been saved.'));
			} else {
				$this->Session->setFlash(__('The Epic could not be saved. Please, try again.'));
			}
		} else {
			if ($this->request->is(array('post', 'put'))) {
				if ($this->request->data['Epic']['issue_type'] == '') {
					$options['conditions']['OR'][]['Epic.issue_type'] = null;
					$options['conditions']['OR'][]['Epic.issue_type'] = '';
				} elseif ($this->request->data['Epic']['issue_type'] != '%') {
					$options['conditions']['Epic.issue_type'] = $this->request->data['Epic']['issue_type'];
				}
				if ($this->request->data['Epic']['client_id'] != '') {
					$options['conditions']['Epic.client_id'] = $this->request->data['Epic']['client_id'];
				}
			} else {
				$options['conditions']['OR'][]['Epic.issue_type'] = null;
				$options['conditions']['OR'][]['Epic.issue_type'] = '';
			}
			
			$options['contain']	= false;
			$options['order'] 	= array('Epic.created desc', 'Epic.key');
			$epics = $this->Epic->find('all', $options);
			$this->set(compact('epics'));
		}
		$clients = $this->Epic->Client->find('list', array('order' => 'Client.name ASC'));
		$this->set(compact('clients'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Epic->exists($id)) {
			throw new NotFoundException(__('Invalid epic'));
		}
		
		$options['contain'] 	= array('Project', 'Client', 'Worklog' => array('conditions' => array('Worklog.deleted' => 0)));
		$options['conditions'] 	= array('Epic.' . $this->Epic->primaryKey => $id);
		$epic = $this->Epic->find('first', $options);
		$this->set('epic', $epic);
		
		if($this->Session->read('Auth.User.role') == 'Support') {
			if($epic['Epic']['issue_type'] != 'Support') {
				$this->Session->setFlash(__('Sorry! You are not allowed here.'), 'default', array('class' => 'note note-danger'));
				return $this->redirect(array('controller' => 'epics', 'action' => 'report', 'Support'));
			}
		}

		$this->loadModel('Issue');
		$options = array();
		$options['contain'] 	= false;
		$options['conditions'] 	= array('Issue.epic_link' => $epic['Epic']['key']);
		$this->set('issues', $this->Issue->find('all', $options));
		
		$options = array();
		$options['contain'] 	= false;
		$options['fields'] 		= array('Epic.key', 'Epic.description');
		$options['conditions'] 	= array('Epic.project_id' => $epic['Epic']['project_id']);
		$this->set('epics', $this->Epic->find('list', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if($this->Session->read('Auth.User.role') == 'Support') {
			$this->Session->setFlash(__('Sorry! You are not allowed here.'), 'default', array('class' => 'note note-danger'));
			return $this->redirect(array('controller' => 'epics', 'action' => 'report', 'Support'));
		}

		if ($this->request->is('post')) {
			$this->Epic->create();
			$id = $this->Epic->field('MIN(id)');
			$this->request->data['Epic']['id'] = $id - 1;
			$this->request->data['Epic']['worklog'] = 1;
			if ($this->Epic->save($this->request->data)) {
				$this->Session->setFlash(__('The Epic has been saved.'));
				return $this->redirect(array('action' => 'view', $this->Epic->getInsertID()));
			} else {
				$this->Session->setFlash(__('The Epic could not be saved. Please, try again.'));
			}
		}
		
		$epic_links = $assignees = $options = array();
		$options['contain'] = false;
		$options['fields'] = array('DISTINCT(Epic.assignee)');
		$options['order'] = 'Epic.assignee';
		
		$assignee = $this->Epic->find('all', $options);
		foreach($assignee as $key => $value) {
			$assignees[$value['Epic']['assignee']] = $value['Epic']['assignee'];
		}
		$clients = $this->Epic->Client->find('list', array('order' => 'name'));
		$projects = $this->Epic->Project->find('list', array('order' => 'name'));
		
		$this->set(compact('projects', 'clients', 'assignees'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if($this->Session->read('Auth.User.role') == 'Support') {
			$this->Session->setFlash(__('Sorry! You are not allowed here.'), 'default', array('class' => 'note note-danger'));
			return $this->redirect(array('controller' => 'epics', 'action' => 'report', 'Support'));
		}

		if (!$this->Epic->exists($id)) {
			throw new NotFoundException(__('Invalid Epic'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Epic->save($this->request->data)) {
				$this->Session->setFlash(__('The Epic has been saved.'));
				return $this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The Epic could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Epic.' . $this->Epic->primaryKey => $id));
			$this->request->data = $this->Epic->find('first', $options);
		}
		
		$epic_links = $assignees = $options = array();
		$options['contain'] = false;
		$options['fields'] = array('DISTINCT(Epic.assignee)');
		$options['order'] = 'Epic.assignee';
		
		$assignee = $this->Epic->find('all', $options);
		foreach($assignee as $key => $value) {
			$assignees[$value['Epic']['assignee']] = $value['Epic']['assignee'];
		}
		
		$projects = $this->Epic->Project->find('list', array('order' => 'name'));
		$clients  = $this->Epic->Client->find('list', array('order' => 'name'));
		$this->set(compact('projects', 'clients', 'assignees'));
	}
	
	public function recalculate() {
		$start 		= date("Y-m-1", strtotime("-5 months")); //'2015-02-01';
		$end		= date('Y-m-t'); //'2015-02-28';
		$message	= '';
		if ($this->request->is(array('post', 'put'))) {
			if ($this->request->data['Epic']['monthstart'] != '') {
				$start 	= date('Y-m-1', strtotime($this->request->data['Epic']['monthstart']));
			}
			if ($this->request->data['Epic']['monthend'] != '') {
				$end 	= date('Y-m-1', strtotime($this->request->data['Epic']['monthend']));
			}
				
			$this->request->data['Worklog']['start_end'] = '';
			$this->request->data['Worklog']['start'] 	 = '';
			$this->request->data['Worklog']['end'] 		 = '';
			$this->request->data['Worklog']['user_id'] 	 = '';
			$this->request->data['Epic']['client_id'] 	 = '';
			
			$start    = new DateTime($start);
			$end      = new DateTime($end);
			$interval = DateInterval::createFromDateString('1 month');
			$period   = new DatePeriod($start, $interval, $end);
			$message = 'Failed. Try Again';
			foreach ($period as $dt) {
				$this->report('Project', $dt->format('Y-m-1'), $dt->format('Y-m-t'));
				$this->report('Support', $dt->format('Y-m-1'), $dt->format('Y-m-t'));
			}
			$message = 'Success';
		} else {
			$this->request->data['Epic']['monthstart'] = date('M-Y', strtotime($start));
			$this->request->data['Epic']['monthend']   = date('M-Y', strtotime($end));
		}
		$this->set('message', $message);
	}

/**
 * report method
 *
 * @return void
 */
	public function report($type = 'Project', $start = null, $end = null) {
		$started = $assignee = $client = $epic_lists = array();
		
		if(is_null($start)) {
			$start 		= date('Y-m-1');//'2015-02-01';
			$end		= date('Y-m-t');//'2015-02-28';
		} 
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->request->data['Worklog']['start_end'] != '') {
				$start 	= date('Y-m-1', strtotime($this->request->data['Worklog']['start_end']));
				$end	= date('Y-m-t', strtotime($this->request->data['Worklog']['start_end']));
			}
			if ($this->request->data['Worklog']['start'] != '') {
				$start 	= $this->request->data['Worklog']['start'];
			}
			if ($this->request->data['Worklog']['end'] != '') {
				$end	= $this->request->data['Worklog']['end'];
			}
			if ($this->request->data['Worklog']['user_id'] != '') {
				$assignee = array('Worklog.user_id' => $this->request->data['Worklog']['user_id']);
			}
			if ($this->request->data['Epic']['client_id'] != '') {
				$client = array('Epic.client_id' => $this->request->data['Epic']['client_id']);
			}
		} else {
			$this->request->data['Worklog']['start_end'] = date('M-Y', strtotime($start));
		}
		$started = array('Worklog.started BETWEEN ? AND ?' => array($start, $end));
		
		$options = array();
		$options['contain'] = array('Issue' => array('conditions' => array('Issue.epic_link IS NOT NULL', 'Issue.deleted' => 0)),
									'User' => array('conditions' => array('User.role' => 'Developer')));
		$options['conditions'] = array('Worklog.started BETWEEN ? AND ?' => array($start, $end), $assignee, 'Worklog.deleted' => 0);
		$worklogs = $this->Epic->Worklog->find('all', $options);
		
		$epic_ids = $epic_list = $issues = array();
		foreach($worklogs as $worklog) {
			if(is_null($worklog['Issue']['id'])) {
				$epic_ids[$worklog['Worklog']['issue_id']] = $worklog['Worklog']['issue_id'];
			} else {
				$epic_link = $worklog['Issue']['epic_link'];
				$epic_list[$epic_link] = $epic_link;
				$issues[$epic_link][$worklog['Issue']['key']]['Issue'] = $worklog['Issue'];
				$issues[$epic_link][$worklog['Issue']['key']]['Worklog'][] = $worklog['Worklog'];
			}
		}
		
		$options = array();
		$options['contain'] 	= array('Project', 'Worklog' => array('conditions' => array('Worklog.started BETWEEN ? AND ?' => array($start, $end), 'Worklog.deleted' => 0)));
		$options['conditions'] 	= array('Epic.issue_type' => $type, $client, 'Epic.deleted' => 0,
										'OR' => array('Epic.id' => $epic_ids, 'Epic.key' => $epic_list));
		$options['order']		= array('Epic.key' => 'asc');
		$epics = $this->Epic->find('all', $options);
		
		if($type == 'Project') {
			$return = $this->_project($epics, $issues);
		} elseif($type == 'Support') {
			$return = $this->_support($epics, $issues);
		}
		
		if($this->request->data('Worklog.assignee') == '' && $this->request->data('Epic.client_id') == '' &&
		   $this->request->data('Worklog.start') == '' && $this->request->data('Worklog.end') == '') {
			
			$this->loadModel('MonthlyReport');
			$this->MonthlyReport->deleteAll(array('month_year' => $start, 'type' => $type));
			foreach($return['Month'] as $key => $author) {
				$this->request->data['MonthlyReport'] = $author;
				$this->request->data['MonthlyReport']['month_year'] = $start;
				$this->request->data['MonthlyReport']['user_id'] 	= $key;
				$this->request->data['MonthlyReport']['author'] 	= $key;
				$this->request->data['MonthlyReport']['type'] 		= $type;
		
				$this->MonthlyReport->create();
				$this->MonthlyReport->save($this->request->data);
			}
		}
		$this->set('type', $type);
		$this->set('reports', $return['Report']);
		$this->_setDropDown();
	}

/**
 * project method
 *
 * @return void
 */
	private function _project($epics, $worklogs) {
		$report = $authors = array();
		$this->loadModel('Issue');
		foreach($epics as $e_key => $epic) {
			$author = array();
			$key = $epic['Epic']['key'];
			
			$month_hours = 0;
			$hours_spent  = $this->Issue->field('SUM(hours_spent)', array('Issue.epic_link' => $key));
			$hours_spent += $epics[$e_key]['Epic']['hours_spent'];
			
			$hours_remaining  = $this->Issue->field('SUM(hours_remaining)', array('Issue.epic_link' => $key, 'Issue.status !=' => 'Closed'));
			if($epic['Epic']['status'] != 'Closed') {
				$hours_remaining += $epics[$e_key]['Epic']['hours_remaining'];
			}

			if(isset($worklogs[$key])) {
				foreach($worklogs[$key] as $worklog) {
					foreach($worklog['Worklog'] as $timeSpent) {
						$month_hours += $timeSpent['timeSpentSeconds']/3600;
						
						if(isset($author[$timeSpent['user_id']])) {
							$author[$timeSpent['user_id']]['month_hours'] += $timeSpent['timeSpentSeconds']/3600;
						} else {
							$author[$timeSpent['user_id']]['month_hours']  = $timeSpent['timeSpentSeconds']/3600;
						}
					}
				}
			}
			
			foreach($epic['Worklog'] as $worklog) {
				$month_hours += $worklog['timeSpentSeconds']/3600;
				
				if(isset($author[$worklog['user_id']])) {
					$author[$worklog['user_id']]['month_hours'] += $worklog['timeSpentSeconds']/3600;
				} else {
					$author[$worklog['user_id']]['month_hours']  = $worklog['timeSpentSeconds']/3600;
				}
			}
				
			$epics[$e_key]['Epic']['project_budget_hours'] 	= $epic['Epic']['business_value']/400;
			$epics[$e_key]['Epic']['hours_spent'] 			= $hours_spent;
			
			$epics[$e_key]['Epic']['hours_remaining'] 		= $hours_remaining;
			$epics[$e_key]['Epic']['complete_percentage'] 	= 0;
			$epics[$e_key]['Epic']['project_rate'] 			= 0;
			
			//Old formula
			/* if(($hours_spent + $hours_remaining) > 0) {
				$total_hours = $hours_spent + $hours_remaining;
				$epics[$e_key]['Epic']['complete_percentage'] = $hours_spent/$total_hours;
				$epics[$e_key]['Epic']['project_rate'] = ($epic['Epic']['business_value'] + $epic['Epic']['additional_rate'])/($total_hours + $epic['Epic']['additional_hours']);
			} */
			
			if($epics[$e_key]['Epic']['project_budget_hours'] < $epics[$e_key]['Epic']['hours_spent'] || $epics[$e_key]['Epic']['status'] == 'Closed') {
				$epics[$e_key]['Epic']['project_rate'] = ($epic['Epic']['business_value'] + $epic['Epic']['additional_rate'])/$epics[$e_key]['Epic']['hours_spent'];
			} elseif($epics[$e_key]['Epic']['project_budget_hours'] > $epics[$e_key]['Epic']['hours_spent']) {
				$epics[$e_key]['Epic']['project_rate'] = ($epic['Epic']['business_value'] + $epic['Epic']['additional_rate'])/$epics[$e_key]['Epic']['project_budget_hours'];
			}
			
			$epics[$e_key]['Epic']['month_hours'] 		= $month_hours;
			$epics[$e_key]['Epic']['value_completed'] 	= $epics[$e_key]['Epic']['project_rate'] * $month_hours;
			
			foreach($author as $auth => $value) {
				$value_completed = $value['month_hours'] * $epics[$e_key]['Epic']['project_rate'];
				if(isset($authors[$auth])) {
					$authors[$auth]['month_hours'] 		+= $value['month_hours'];
					$authors[$auth]['value_completed'] 	+= $value_completed;
				} else {
					$authors[$auth]['month_hours'] 		 = $value['month_hours'];
					$authors[$auth]['value_completed'] 	 = $value_completed;
				}
			}
			
			//debug($epics);
		}
		return array('Report' => $epics, 'Month' => $authors);
	}
	
/**
 * support method
 *
 * @return void
 */
	private function _support($epics, $worklogs) {

		$report = $authors = array();
		$this->loadModel('Issue');
		foreach($epics as $e_key => $epic) {
			$author = array();
			$key = $epic['Epic']['key'];
				
			$month_hours = 0;
			$hours_worked  = $this->Issue->field('SUM(hours_spent)', array('Issue.epic_link' => $key));
			$hours_worked += $epics[$e_key]['Epic']['hours_spent'];
				
			if(isset($worklogs[$key])) {
				foreach($worklogs[$key] as $worklog) {
					foreach($worklog['Worklog'] as $timeSpent) {
						$month_hours += $timeSpent['timeSpentSeconds']/3600;
				
						if(isset($author[$timeSpent['user_id']])) {
							$author[$timeSpent['user_id']]['month_hours'] += $timeSpent['timeSpentSeconds']/3600;
						} else {
							$author[$timeSpent['user_id']]['month_hours']  = $timeSpent['timeSpentSeconds']/3600;
						}
					}
				}
			}

			foreach($epic['Worklog'] as $worklog) {
				$month_hours += $worklog['timeSpentSeconds']/3600;
		
				if(isset($author[$worklog['user_id']])) {
					$author[$worklog['user_id']]['month_hours'] += $worklog['timeSpentSeconds']/3600;
				} else {
					$author[$worklog['user_id']]['month_hours']  = $worklog['timeSpentSeconds']/3600;
				}
			}
				
			$business_value			= $epic['Epic']['business_value'];
			$original_contract_hour = $epic['Epic']['original_contract_hour'];
			$additional_hour		= $epic['Epic']['additional_hours'];
			$additional_rate		= $epic['Epic']['additional_rate'];

			$epics[$e_key]['Epic']['invoiced_value']   	= $business_value + ($additional_hour * $additional_rate);
			$epics[$e_key]['Epic']['contract_hours']  	= $original_contract_hour + $additional_hour;
			$epics[$e_key]['Epic']['hours_worked'] 		= $hours_worked;
			$epics[$e_key]['Epic']['month_hours'] 		= $month_hours;
			$epics[$e_key]['Epic']['average_rate']	  	= $epics[$e_key]['Epic']['invoiced_value'] / $hours_worked;
			$epics[$e_key]['Epic']['value_completed'] 	= $epics[$e_key]['Epic']['average_rate'] * $month_hours;
				
			foreach($author as $auth => $value) {
				$value_completed = $epics[$e_key]['Epic']['average_rate'] * $value['month_hours'];
				if(isset($authors[$auth])) {
					$authors[$auth]['month_hours'] 		+= $value['month_hours'];
					$authors[$auth]['value_completed'] 	+= $value_completed;
				} else {
					$authors[$auth]['month_hours'] 		 = $value['month_hours'];
					$authors[$auth]['value_completed'] 	 = $value_completed;
				}
			}
		}
		return array('Report' => $epics, 'Month' => $authors);
	}
	
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Epic->id = $id;
		if (!$this->Epic->exists()) {
			throw new NotFoundException(__('Invalid epic'));
		}
		$this->request->onlyAllow('post', 'delete');
		
		//if ($this->Epic->delete()) {
		if ($this->Epic->saveField('deleted', 1)) {
			$this->Session->setFlash(__('The epic has been deleted.'), 'default', array('class' => 'note note-success'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The epic could not be deleted. Please, try again.'), 'default', array('class' => 'note note-danger'));
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
		$this->Epic->id = $id;
		if ($this->Epic->saveField('deleted', 0)) {
			$this->Session->setFlash(__('The epic has been restored.'), 'default', array('class' => 'note note-success'));
		} else {
			$this->Session->setFlash(__('The epic could not be restored. Please, try again.'), 'default', array('class' => 'note note-danger'));
		}
		return $this->redirect($this->referer());
	}
	
	private function _setDropDown() {
		$options = array();
		$options['conditions']  = array('User.role' => 'Developer');
		$options['order'] 		= array('User.name');
		$users = $this->Epic->User->find('list', $options);
		
		$clients = $this->Epic->Client->find('list');
		$this->set(compact('clients', 'users'));
	}
}
