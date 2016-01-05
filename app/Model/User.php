<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

/**
 * User Model
 *
 * @property Comment $Comment
 * @property Post $Post
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	public $actsAs = array('Containable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
			)
		),
		'password' => array(
			'minLength' => array(
				'rule' => array('minLength', 5),
				'message' => 'Password should be minimum 5 characters',
				'allowEmpty' => true,
			),
			'maxLength' => array(
				'rule' => array('maxLength', 12),
				'message' => 'Password should be maximum 12 characters',
				'allowEmpty' => true,
			),
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required',
				'on' => 'create'
			)
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('Admin', 'Author', 'Developer', 'Member', 'Support')),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false
			)
		)
	);
	
	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array();
	
	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Issue' => array(
				'className' => 'Issue',
				'foreignKey' => 'user_id',
				'dependent' => false,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
		),
		'Epic' => array(
				'className' => 'Epic',
				'foreignKey' => 'user_id',
				'dependent' => false,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
		),
		'Worklog' => array(
				'className' => 'Worklog',
				'foreignKey' => 'user_id',
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
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new SimplePasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
					$this->data[$this->alias]['password']
			);
		}
		return true;
	}
}
