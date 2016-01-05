<?php
App::uses('AppModel', 'Model');
/**
 * TimeEntry Model
 *
 * @property Project $Project
 * @property User $User
 * @property Issue $Issue
 * @property Activity $Activity
 */
class TimeEntry extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'redmine';
	public $actsAs = array('Containable');


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'RedmineIssue' => array(
			'className' => 'RedmineIssue',
			'foreignKey' => 'issue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
