<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Tweet extends Controller_Common {
	public function before()
	{
		parent::before();
	}

	public function action_view()
	{
		$tweet = ORM::factory('tweet')->get_tweet($this->id);
		
		if($tweet === null) {
			$this->response->body('Tweet ' . $this->id . ' not found');
			return;
		}
		
		$this->render($tweet);
	}
	
	public function render($tweet)
	{
		$view = View::factory('tweet');
		$view->bind('tweet', $tweet);
		$this->response->body($view);
	}

} // End List
