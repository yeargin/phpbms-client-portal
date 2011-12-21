<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public $layout = 'default';
	
	public function __construct() {
		parent::__construct();
		$this->user->requireAuth();
	}
	
	public function index() {
		$data['clientinfo'] = $this->user->getCurrentUser();
		$this->load->view('profile', $data);
	}
	
}