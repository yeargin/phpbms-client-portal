<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public $layout = 'default';
	
	public function __construct() {
		parent::__construct();
		$this->user->requireAuth();
	}
	
	public function index() {
		
		// Site not complicated enough for a true dashboard yet
		redirect('history');
		
	}
	
}