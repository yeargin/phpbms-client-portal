<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {
	
	public $layout = 'default';
	
	public function __construct() {
		parent::__construct();
		$this->user->requireAuth();
		
		// E-mail library and helper
		$this->load->library('email');
		$this->load->helper('email');
		
	}
	
	public function index() {
		
		// Pre-set some of the form information
		$user = $this->user->getCurrentUser();
		$data['email'] = $user->email;
		$data['name'] = $user->firstname . ' ' . $user->lastname;
		$data['subject'] = '';
		$data['message'] = '';
		
		$data['status'] = '';
		
		$data['page_title'] = 'Contact Us';
	
		$this->load->view('contact/form', $data);
		
	}
	
	public function send() {
		
		// Get posted data
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');

		// Validate posted data
		$send = true;
		if (!valid_email($email))
			$send = false;
		if (empty($name))
			$send = false;
		if (empty($subject))
			$send = false;
		if (empty($message))
			$send = false;
			
		// If validation passed, send
		if ($send == true):

			$this->email->from($email, $name);
			$this->email->to($this->config->item('contact_email_recipient'));
			$this->email->subject($subject);
			$this->email->message($message);

			$this->email->send();
			$this->session->set_flashdata('message', 'Message sent!');
			$data['status'] = 'success';
		// Validation failed
		else:
			$this->session->set_flashdata('message', 'There was a problem sending your message. Please try again.');
			$data['status'] = 'error';
		endif;

		// Re-populate form with data
		$data['email'] = $email;
		$data['name'] = $name;
		$data['subject'] = $subject;
		$data['message'] = $message;

		$data['page_title'] = 'Contact Us';

		$this->load->view('contact/form', $data);

	}
	
}