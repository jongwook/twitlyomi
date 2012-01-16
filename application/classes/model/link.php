<?php defined('SYSPATH') or die('No direct script access.');

class Model_Link extends ORM {
	//protected $_table_name = 'links';
	
	public function rules() 
	{
		return array();
		return array(
		'short' => array(
			array('not_empty'),
			array('min_length', array(':value', 4)),
			array('max_length', array(':value', 64)),
		),
		'full' => array(
			array('not_empty'),
			array('min_length', array(':value', 0)),
			array('max_length', array(':value', 2048)),
		),
		'parent' => array(
			array('not_empty'),
			array('min_length', array(':value', 4)),
			array('max_length', array(':value', 64)),
		),
		);
	}
	
	public function expand($tweet) 
	{
		return preg_replace_callback('/http:\/\/t\.co\/\w+/',array(get_class($this),'getURL'),$tweet);
	}
	
	public function getURL($short) 
	{
		$link = $this->where('short','=',$short[0])->find()->full;
		if(!$link) $link = $short[0];
		return $link;
	}

} // End Link
