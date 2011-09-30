<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List extends Controller_Common {
	public function before()
	{
		parent::before();
		
		
	}

	public function action_index()
	{
		$this->response->body('not here');
	}
	
	public function action_page()
	{
		$this->response->body('list : '.$this->page);
	}

	public function action_archive()
	{
		$this->response->body('archive : '.$this->year.'/'.$this->month.'/'.$this->day);
		
	}
	
	public function action_search()
	{
		$this->response->body('search : '.$this->keyword);
	}
	
	public function render($items)
	{
		
	}

} // End Welcome
