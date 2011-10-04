<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List extends Controller_Common {
	public function before()
	{
		parent::before();
		$this->tweets_per_page = 15;
		$this->limit = $this->tweets_per_page;
		$this->offset = ($this->page-1) * $this->tweets_per_page;
	}

	public function action_index()
	{
		$this->response->body('not here');
	}
	
	public function action_page()
	{
		$tweets = ORM::factory('tweet')->get_list($this->limit, $this->offset);
		$this->render($tweets);
	}

	public function action_archive()
	{
		$untilyear = $this->year;
		$untilmonth = $this->month;
		$untilday = $this->day;
		$query = $this->year;
		if($this->month === 0) {
			$this->month = 1;
			$this->day = 1;
			$untilyear += 1;
			$untilmonth = 1;
			$untilday = 1;
		} else if($this->day === 0) {
			$this->day = 1;
			$untilday = 1;
			$untilmonth += 1;
			if($untilmonth === 13) {
				$untilyear += 1;
				$untilmonth = 1;
			}
			$query .= $this->month;
		} else {
			$untilday += 1;
			if($untilday === 32) {
				$untilday = 1;
				$untilmonth += 1;
				if($untilmonth === 13) {
					$untilmonth = 1;
					$untilyear += 1;
				}
			}
			$query .= $this->month.$this->day;
		}
		$since = strtotime($this->year.'/'.$this->month.'/'.$this->day);
		$until = strtotime($untilyear.'/'.$untilmonth.'/'.$untilday);
		
		$tweets = ORM::factory('tweet')->get_archive($since, $until, $this->limit, $this->offset);
		
		$this->render($tweets, '/archive/'.$query.'/');
	}
	
	public function action_search()
	{
		$tweets = ORM::factory('tweet')->get_search($this->keyword, $this->limit, $this->offset);
		
		$this->render($tweets, '/search/'.$this->keyword.'/');
	}
	
	public function render($tweets, $prefix='/page/')
	{
		$view = View::factory('list');
		$view->bind('tweets', $tweets[0]);
		
		// pagination
		$pages = array();
		$page_max = floor(($tweets[1]-1)/$this->tweets_per_page)+1;
		$this->page = ($this->page > $page_max)? $page_max : $this->page;
		for($p = max($this->page-5,1); $p <= min($this->page+5, $page_max); $p++) {
			$pages[] = array($prefix.$p,($p==$this->page)?'<b>['.$p.']</b>':$p);
		}
		$view->bind('pages', $pages);
		$view->bind('total', $tweets[1]);
		
		$this->response->body($view);
	}

} // End List
