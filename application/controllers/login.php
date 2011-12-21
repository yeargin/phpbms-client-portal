<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Login
*/
class Login extends CI_Controller
{
	public $layout = 'login';
	
	/**
	 * Index
	 */
	public function index() {
		$data['redirect'] = ($this->input->get('redirect')) ? $this->input->get('redirect') : '';
		$this->load->view('login/form', $data);
	}

	/**
	 * Post
	 */
	public function post() {
		$status = $this->user->login();
		if ($status):
			if ($this->input->post('redirect') != ''):
				redirect($this->input->post('redirect'));
			else:
				redirect('/');
			endif;
		else:
			$this->session->set_flashdata('message', 'Login failed!');
			redirect('/login/?login_failed=1');
		endif;
	}

	/**
	 * Logout
	 */
	public function logout() {
		$this->user->logout();
		$this->session->set_flashdata('message', 'Logged out!');
		redirect('/login/?logged_out=1');
	}
	
}
