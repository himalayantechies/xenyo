<?php
App::uses('AppModel', 'Model');
/**
 * Issue Model
 *
 * @property Project $Project
 * @property Worklog $Worklog
 */
class Issue extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';
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
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Worklog' => array(
			'className' => 'Worklog',
			'foreignKey' => 'issue_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
    
    public function beforeFind($queryData) {
    	if(!isset($queryData['conditions']['deleted']) && !isset($queryData['conditions']['Issue.deleted'])) {
    		$queryData['conditions'][$this->alias . '.deleted'] = 0;
    	}
    	return $queryData;
    }
}
