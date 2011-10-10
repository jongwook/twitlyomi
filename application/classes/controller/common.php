<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Common extends Controller {
	public function before() 
	{
		parent::before();

		$params = $this->request->param();
		foreach($params as $key=>$value) {
			$this->$key = $value;
		}
		
		date_default_timezone_set('America/New_York');
	}
	
	public function action_notfound() 
	{
		$msg = 'Invalid URL';
		$status = 404;
		$this->error($msg, $status);
	}
	
	public function action_robots() 
	{
		$this->response->headers('Content-type','text/plain');
		$this->response->body("User-Agent: *\nDisallow: /\n");
	}
	
	public function error($msg, $status=200) 
	{
		// TODO : make and load an error view
		$this->response->status($status);
		$this->response->body('error : '.$msg);
	}
	
} // End Common
