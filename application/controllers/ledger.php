<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * A/R Ledger
 */
class Ledger extends CI_Controller {
	
	public $layout = 'default';
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->user->requireAuth();
	
		$this->load->model('aritem');
		
	}
	
	/**
	 * Index
	 */
	public function index() {
		
		$items = $this->aritem->getClientLedgerItems();

		$data['aritems'] = array();	
		$lastupdate = 0;
		foreach ($items as $item):
				if (strtotime($item->modifieddate) > $lastupdate)
					$lastupdate = strtotime($item->modifieddate);
				
			// Build nested array of transactions
			$data['aritems'][$item->id] = $item;
			$data['aritem_transactions'][$item->id][] = $item;
				
		endforeach;
		$data['lastupdate'] = $lastupdate;
		
		$data['page_title'] = 'Accounts Receivable Ledger';
	
		$this->load->view('ledger', $data);
		
	}
	
}