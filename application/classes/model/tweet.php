<?php defined('SYSPATH') or die('No direct script access.');

class Model_Tweet extends ORM {
	//protected $_table_name = 'tweets';
	
	public function rules() 
	{
		return array(
		'id' => array(
			array('not_empty'),
			array('min_length', array(':value', 4)),
			array('max_length', array(':value', 64)),
			array('regex', array(':value', '\d+')),
		),
		'text' => array(
			array('not_empty'),
			array('min_length', array(':value', 0)),
			array('max_length', array(':value', 500)),
		),
		'created_at' => array(
			array('not_empty'),
			array('min_length', array(':value', 4)),
			array('max_length', array(':value', 32)),
		),
		'geo' => array(
			array('min_length', array(':value', 4)),
			array('max_length', array(':value', 127)),
		),
		'in_reply_to_screen_name' => array(
			array('min_length', array(':value', 4)),
			array('max_length', array(':value', 127)),
		),
		'in_reply_to_status_id' => array(
			array('not_empty'),
			array('min_length', array(':value', 4)),
			array('max_length', array(':value', 127)),
		),
		'source' => array(
			array('not_empty'),
			array('min_length', array(':value', 4)),
			array('max_length', array(':value', 512)),
		),
		);
	}

} // End Tweet
