<?php
App::uses('AppModel', 'Model');
/**
 * Issue Model
 *
 * @property Tracker $Tracker
 * @property Project $Project
 * @property Category $Category
 * @property Status $Status
 * @property AssignedTo $AssignedTo
 * @property Priority $Priority
 * @property FixedVersion $FixedVersion
 * @property Author $Author
 * @property Issue $ParentIssue
 * @property Root $Root
 * @property Issue $ChildIssue
 * @property TimeEntry $TimeEntry
 * @property Changeset $Changeset
 */
class RedmineIssue extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'redmine';
	public $useTable = 'issues';
	public $actsAs = array('Containable');


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TimeEntry' => array(
			'className' => 'TimeEntry',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Changeset' => array(
			'className' => 'Changeset',
			'joinTable' => 'changesets_issues',
			'foreignKey' => 'issue_id',
			'associationForeignKey' => 'changeset_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
