<?php
App::uses('AppModel', 'Model');
/**
 * Worklog Model
 *
 * @property Issue $Issue
 */
class Worklog extends AppModel {

	public $actsAs = array('Containable');
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Epic' => array(
			'className' => 'Epic',
			'foreignKey' => 'issue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Issue' => array(
			'className' => 'Issue',
			'foreignKey' => 'issue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
				
	);
    
    public function beforeFind($queryData) {
    	if(!isset($queryData['conditions']['deleted']) && !isset($queryData['conditions']['Worklog.deleted'])) {
    		$queryData['conditions'][$this->alias . '.deleted'] = 0;
    	}
    	return $queryData;
    }
}
