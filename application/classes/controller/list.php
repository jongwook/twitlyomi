<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List extends Controller_Common {
	public function before()
	{
		parent::before();
		$this->tweets_per_page = 15;
	}

	public function action_index()
	{
		$this->response->body('not here');
	}
	
	public function action_page()
	{
		$limit = $this->tweets_per_page;
		$offset = ($this->page-1) * $this->tweets_per_page;
		
		$tweets = ORM::factory('tweet')->order_by('created_at','desc')
						->limit($limit)->offset($offset)->find_all();
		$this->render($tweets);
	}

	public function action_archive()
	{
		$this->response->body('archive : '.$this->year.'/'.$this->month.'/'.$this->day);
		
	}
	
	public function action_search()
	{
		$this->response->body('search : '.$this->keyword);
	}
	
	public function render($tweets)
	{
		$view = View::factory('list');
		$view->bind('tweets', $tweets);
		
		// pagination
		$pages = array();
		for($p = max($this->page-5,1); $p <= $this->page+5; $p++) {
			if($p==$this->page) {

			} else {
			
			}
		}
		$view->bind('page', $pages);
		
		$this->response->body($view);
	}

} // End List
