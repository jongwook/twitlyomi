<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Common extends Controller {
	public function before() {
		parent::before();

		$params = $this->request->param();
		foreach($params as $key=>$value) {
			$this->$key = $value;
		}
	}
	
	public function action_notfound() {
		$msg = 'Invalid URL';
		$status = 404;
		$this->error($msg, $status);
	}
	
	public function error($msg, $status=200) {
		// TODO : make and load an error view
		$this->response->status($status);
		$this->response->body('error : '.$msg);
	}
} // End Welcome
