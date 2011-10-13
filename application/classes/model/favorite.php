<?php defined('SYSPATH') or die('No direct script access.');

class Model_Favorite extends Model_Tweet {
	//protected $_table_name = 'favorites';
	
	public function rules() 
	{
		$rules = parent::rules();
		
		$rules['screen_name'] = array(
			array('not_empty'),
			array('min_length', array(':value', 0)),
			array('max_length', array(':value', 32)),
		);
		
		return $rules;
	}
	
	public function format($tweets)
	{
		$result = parent::format($tweets);
		
		foreach($result as $tweet) {
			$screen_name = $tweet->screen_name;
			$screen_name = preg_replace('@(.*)@','<a href="http://twitter.com/$1" target="_blank">$1</a>', $screen_name);
			$tweet->set('screen_name', $screen_name);
		}
		
		return $result;
	}

} // End Tweet
