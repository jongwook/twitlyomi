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
		$tweets = ORM::factory('tweet')->get_public($this->limit, $this->offset);
		$this->render($tweets,'/page/','Tweets');
	}

	public function action_archive()
	{
		$untilyear = $this->year;
		$untilmonth = $this->month;
		$untilday = $this->day;
		$query = $this->year;
		$pages = NULL;
		if($this->month === 0) {
			$this->month = $this->day = $untilmonth = $untilday = 1;
			$untilyear += 1;
			$desc = 'Tweets in '.$this->year;
		} else if($this->day === 0) {
			$this->day = $untilday = 1;
			$untilmonth += 1;
			if($untilmonth === 13) {
				$untilyear += 1;
				$untilmonth = 1;
			}
			$query .= $this->month;
			$desc = 'Tweets in '.date('F Y', mktime(0,0,0,$this->month,$this->day,$this->year));
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
			$date = mktime(0,0,0,$this->month,$this->day,$this->year);
			$desc = date('D j F Y', $date);
			$pages = array();
			$pages[] = array('/archive/'.date('Ymd',$date+86400), '&lt;&lt;');
			$pages[] = array('/archive/'.date('Ymd',$date), date('Y.m.d',$date));
			$pages[] = array('/archive/'.date('Ymd',$date-86400), '&gt;&gt;');
		}
		$since = strtotime($this->year.'/'.$this->month.'/'.$this->day);
		$until = strtotime($untilyear.'/'.$untilmonth.'/'.$untilday);
		
		
		$tweets = ORM::factory('tweet')->get_archive($since, $until, $this->limit, $this->offset);
		$this->render($tweets, '/archive/'.$query.'/', $desc, $pages);
	}
	
	public function action_search()
	{
		$tweets = ORM::factory('tweet')->get_search($this->keyword, $this->limit, $this->offset);
		$desc = 'Search result for '.$this->keyword;
		$this->render($tweets, '/search/'.$this->keyword.'/', $desc);
	}
	
	public function render($tweets, $prefix='/page/', $desc='', $pages=NULL)
	{
		$view = View::factory('list');
		$view->bind('tweets', $tweets[0]);
		
		// pagination
		if($pages === NULL) {
			$pages = array();
			$page_max = floor(($tweets[1]-1)/$this->tweets_per_page)+1;
			$this->page = ($this->page > $page_max)? $page_max : $this->page;
			for($p = max($this->page-5,1); $p <= min($this->page+5, $page_max); $p++) {
				$pages[] = array($prefix.$p,($p==$this->page)?'<b>['.$p.']</b>':$p);
			}
		}
		$view->bind('pages', $pages);
		$view->bind('total', $tweets[1]);
		$view->bind('desc', $desc);
		
		$this->response->body($view);
	}

} // End List
