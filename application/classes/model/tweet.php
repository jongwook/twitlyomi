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
		),
		'text' => array(
			array('not_empty'),
			array('min_length', array(':value', 0)),
			array('max_length', array(':value', 512)),
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
			array('max_length', array(':value', 128)),
		),
		);
	}
	
	public function get_tweet($id)
	{
		$tweets = $this->where('id','=',$id)->find_all();
		return $tweets[0];
	}
	
	public function get_public($limit, $offset)
	{
		$tweets = $this->order_by('created_at','desc')->where('text','not regexp','^@.+')
						->limit($limit)->offset($offset)->find_all();
		$count = $this->where('text','not regexp','^@.+')->find_all()->count();
		return array($this->format($tweets), $count);
	}
	
	public function get_list($limit, $offset)
	{
		$tweets = $this->order_by('created_at','desc')->limit($limit)->offset($offset)->find_all();
		$count = $this->find_all()->count();
		return array($this->format($tweets), $count);
	}
	
	public function get_archive($since, $until, $limit, $offset)
	{
		$tweets = $this->order_by('created_at','desc')
						->where('created_at','>=',$since)->where('created_at','<',$until)
						->limit($limit)->offset($offset)->find_all();
						
		$count = $this->where('created_at','>=',$since)->where('created_at','<',$until)
						->find_all()->count();
		
		return array($this->format($tweets), $count);
	}
	
	public function get_search($keyword, $limit, $offset)
	{
		$tweets = $this->order_by('created_at','desc')->where('text','regexp',$keyword)
						->limit($limit)->offset($offset)->find_all();
		
		$count = $this->where('text','regexp',$keyword)->find_all()->count();
		
		return array($this->format($tweets), $count);
	}
	
	public function format($tweets)
	{
		$links = ORM::factory('link');
		$result = array();
		foreach($tweets as $tweet) {
			$text = $tweet->text;
			$text = $links->expand($text);
			$text = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\-\.%]*(\?\S+)?)?)?)@', 
									'<a href="$1" target="_blank">$1</a>', $text);
			$text = preg_replace('@\@([\w_]+)@','<a href="http://twitter.com/$1" target="_blank">@$1</a>', $text);
			$tweet->set('text', $text);
			$result[] = $tweet;
		}
		
		return $result;
	}

} // End Tweet
