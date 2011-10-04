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
	
	public function get_list($limit, $offset)
	{
		$tweets = $this->order_by('created_at','desc')->limit($limit)->offset($offset)->find_all();
		$count = $this->find_all()->count();
		return array($tweets, $count);
	}
	
	public function get_archive($since, $until, $limit, $offset)
	{
		$tweets = $this->order_by('created_at','desc')
						->where('created_at','>=',$since)->where('created_at','<',$until)
						->limit($limit)->offset($offset)->find_all();
						
		$count = $this->order_by('created_at','desc')
						->where('created_at','>=',$since)->where('created_at','<',$until)
						->find_all()->count();
						
		return array($tweets, $count);
	}
	
	public function get_search($keyword, $limit, $offset)
	{
		$tweets = $this->order_by('created_at','desc')->where('text','regexp',$keyword)
						->limit($limit)->offset($offset)->find_all();
		
		$count = $this->order_by('created_at','desc')->where('text','regexp',$keyword)->find_all()->count();
		
		return array($tweets, $count);
	}

} // End Tweet
