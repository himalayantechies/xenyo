<?php
App::uses('AppController', 'Controller');
/**
 * MonthlyReports Controller
 *
 * @property MonthlyReport $MonthlyReport
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MonthlyReportsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function report() {
		$start 		= date('2014-10-1'); //'2015-02-01';
		$end		= date('Y-m-t'); //'2015-02-28';
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->request->data['Worklog']['start'] != '') {
				$start 	= date('Y-m-1', strtotime($this->request->data['Worklog']['start']));
			}
			if ($this->request->data['Worklog']['end'] != '') {
				$end 	= date('Y-m-t', strtotime($this->request->data['Worklog']['end']));
			}
			if ($this->Session->read('Auth.User.role') != 'Support' && $this->request->data['MonthlyReport']['type'] != '') {
				$conditions['MonthlyReport.type'] = $this->request->data['MonthlyReport']['type'];
			}
		} else {
			$this->request->data['Worklog']['start'] = date('M-Y', strtotime($start));
			$this->request->data['Worklog']['end']	 = date('M-Y', strtotime($end));
		}
		
		if($this->Session->read('Auth.User.role') == 'Support') {
			$conditions['MonthlyReport.type'] = 'Support';
		}
		
		$start    = new DateTime($start);
		$end      = new DateTime($end);
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);
		
		$options['fields'] 		= array('User.id', 'User.name');
		$options['order']  		= array('User.name' => 'ASC');
		$options['conditions']  = array('User.role' => 'Developer');
		$authors = $this->MonthlyReport->User->find('list', $options);
		
		$reports = array();
		foreach ($period as $dt) {
			$month  = $dt->format('M, Y');
			$reports[$month] = $authors;
			$conditions['MonthlyReport.month_year'] = $dt->format('Y-m-1');
			$conditions['User.role'] = 'Developer';
			$options = array();
			$options['fields']		= array('MonthlyReport.month_year', 'MonthlyReport.user_id', 
											'SUM(MonthlyReport.month_hours) AS sum_month_hours' , 
											'SUM(MonthlyReport.value_completed) AS sum_value_completed');
			$options['conditions']  = $conditions;
			$options['group']		= array('month_year', 'user_id');
			$report = $this->MonthlyReport->find('all', $options);
				
			$total_hours = $total_monthly = 0;
			foreach($report as $key => $value) {
				$author = $value['MonthlyReport']['user_id'];
				$reports[$month][$author] = array();
				$reports[$month][$author]['month_hours'] 	 = $value[0]['sum_month_hours'];
				$reports[$month][$author]['value_completed'] = $value[0]['sum_value_completed'];
				$reports[$month][$author]['hours_worked'] 	 = $value[0]['sum_month_hours'];
				
				if($reports[$month][$author]['hours_worked'] > 132)  {
					$reports[$month][$author]['hours_worked'] = 132;
				}
				$reports[$month][$author]['monthly_average'] = $reports[$month][$author]['value_completed']/$reports[$month][$author]['hours_worked'];
				$total_hours 	+= $reports[$month][$author]['hours_worked'];
				$total_monthly  += $reports[$month][$author]['value_completed'];
			}
			$reports[$month]['total_hours'] = $total_hours;
			$reports[$month]['total_monthly'] = $total_monthly;
			if($total_hours < 1) {
				$reports[$month]['monthly_average'] = 0;
			} else {
				$reports[$month]['monthly_average'] = $total_monthly/$total_hours;
			}
		}
		$this->set('authors', $authors);
		$this->set('reports', $reports);
	}
}
