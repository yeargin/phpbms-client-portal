<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Account History
 */
class History extends CI_Controller {
	
	public $layout = 'default';

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->user->requireAuth();
			
		$this->load->model('invoice');
	}
	
	/**
	 * Index
	 */
	public function index() {
		
		// Retrieve all records related to a client
		$records = $this->invoice->getClientInvoices();
		
		// Sort records based on type
		$data['quotes'] = array();
		$data['orders'] = array();
		$data['invoices'] = array();
		$lastupdate = 0;
		foreach ($records as $record):
		
			switch(strtolower($record->type)):

				case 'quote':
					$data['quotes'][] = $record;
					break;
				case 'order':
					$data['orders'][] = $record;
					break;
				case 'invoice':
					$data['invoices'][] = $record;
					break;

			endswitch;
		
			// Get last modified date for invoices
			if (strtotime($record->modifieddate) > $lastupdate)
				$lastupdate = strtotime($record->modifieddate);
		
		endforeach;
		
		$data['lastupdate'] = $lastupdate;

		$data['page_title'] = 'Account History';
		
		$this->load->view('history/index', $data);
		
	}
	
	/**
	 * Detail
	 */
	public function detail() {
		
		$this->layout = 'onecolumn';
		
		$invoiceid = $this->input->get('invoice_id');
		
		// Empty invoice ID
		if (!$invoiceid)
			redirect('history');
		
		$record = $this->invoice->getInvoiceById($invoiceid);

		// Invalid invoice ID
		if (!$record)
			redirect('history');

		$record->amountdue = ($record->totalti - $record->amountpaid);
		$data['record'] = $record;
	
		$data['page_title'] = 'Record Detail';

		$this->load->view('history/detail', $data);
		
	}
	
}