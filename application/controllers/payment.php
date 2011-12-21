<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payment
 */
class Payment extends CI_Controller {
	
	public $layout = 'default';
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		
		// Payments library
		$this->load->library('paypal');
		
	}
	
	/**
	 * Index
	 */
	public function index() {
		
		$data['message'] = $this->input->get('message');
		$data['payment_ref'] = $this->input->get('payment_ref');
		$data['payment_amount'] = $this->input->get('payment_amount');

		$data['page_title'] = 'Make a Payment';

		$this->load->view('payment/form', $data);
		
	}
	
	/**
	 * Submit
	 */
	public function submit() {

		$this->layout = 'login';

		$payment_amount = (float) $this->input->post('payment_amount');
		$payment_ref = $this->input->post('payment_ref');
		
		// Validate submission
		if ($payment_amount < 0.01):
			$this->session->set_flashdata('message', 'Invalid amount.');
			redirect('payment');
		endif;

		// Specify your paypal email
		$this->paypal->addField('business', $this->config->item('paypal_payments_recipient'));

		// Specify the currency
		$this->paypal->addField('currency_code', 'USD');

		// Specify the url where paypal will send the user on success/failure
		$this->paypal->addField('return', site_url('payment') . '?message=success');
		$this->paypal->addField('cancel_return', site_url('payment') . '?message=cancel');

		// Specify the url where paypal will send the IPN
		$this->paypal->addField('notify_url', site_url('payment/callback'));

		// Specify the product information
		$this->paypal->addField('item_name', 'Invoice/Reference #' . $payment_ref ? $payment_ref : '(Not Submitted)');
		$this->paypal->addField('amount', $payment_amount);
		$this->paypal->addField('item_number', $payment_ref);

		// Define logo to send
		if ($this->config->item('paypal_logo_url') != ''):
			$this->paypal->addField('image_url', $this->config->item('paypal_logo_url'));
		endif;

		// If authenticated, pre-fill user data from record
		if ($this->user->isLoggedIn()):
			$clientinfo = $this->user->getCurrentUser();
			$this->paypal->addField('address1', $clientinfo->address1);
			$this->paypal->addField('address2', $clientinfo->address2);
			$this->paypal->addField('city', $clientinfo->city);
			$this->paypal->addField('country', $clientinfo->country);
			$this->paypal->addField('email', $clientinfo->email);
			$this->paypal->addField('first_name', $clientinfo->firstname);
			$this->paypal->addField('last_name', $clientinfo->lastname);
			$this->paypal->addField('night_phone_a', $clientinfo->workphone);
			$this->paypal->addField('state', $clientinfo->state);
			$this->paypal->addField('zip', $clientinfo->postalcode);
		endif;

		// Let's start the train!
		$data['fields'] = $this->paypal->fields;
		$data['gateway'] = $this->paypal->gatewayUrl;
		
		$data['page_title'] = 'Processing Payment';
		
		$this->load->view('payment/submit', $data);
	}
	
	/**
	 * Callback
	 */
	public function callback() {
		
		$this->load->helper('file');
		
		if ($this->input->post() == '')
			die('error');
		
		$data = sprintf('[%s] %s' . "\n", date('r'), json_encode($this->input->post()) );
		$status = write_file('./application/logs/paypal_transactions.log', $data, 'ab');
		
		print ($status) ? 'success' : 'error';
		
	}

}