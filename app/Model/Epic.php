<?php
App::uses('AppModel', 'Model');
/**
 * Epic Model
 *
 * @property Client $Client
 * @property Project $Project
 * @property Issue $Issue
 */
class Epic extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'key';
	public $actsAs = array('Containable');


	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
			'key' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'A Key is required'
					)
			),
	);
	
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
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
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
		if(!isset($queryData['conditions']['deleted']) && !isset($queryData['conditions']['Epic.deleted'])) {
			$queryData['conditions'][$this->alias . '.deleted'] = 0;
		}
		return $queryData;
	}
	
}
