<?php	 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends CI_Model {
	
	protected $clientid;
	
	public function __construct() {
		parent::__construct();

		// Retrieve active client ID
		$user = unserialize($this->session->userdata('user'));
		$this->clientid = $user->uuid;
	}
	
	public function getClientInvoices() {
		$this->db->order_by('invoicedate', 'desc');
		$query = $this->db->get_where('invoices', array('clientid' => $this->clientid));
		$invoices = $query->result();
		return $invoices;
	}
	
	public function getInvoiceById($invoiceid = 0) {

		// Check if provied
		if (!$invoiceid)
			return false;
		
		// Invoice
		$query = $this->db->get_where('invoices', array('clientid' => $this->clientid, 'id' => $invoiceid), 1);
		$invoice = $query->result();
		if (!is_array($invoice)) return false;
		$invoice = array_shift($invoice);
		$record = $invoice;

		if (!$record)
			return false;

		// Related Client Record
		$query = $this->db->get_where('clients', array('uuid' => $this->clientid), 1);
		$client = $query->result();
		$record->client = array_shift($client);

		// Invoice Line Items
		$this->db->select('lineitems.*, products.partname, products.partnumber, products.unitofmeasure, lineitems.memo as lineitem_memo');
		$this->db->from('lineitems');
		$this->db->join('products', 'lineitems.productid = products.uuid', 'left');
		$this->db->where('invoiceid', $invoiceid);
		$this->db->order_by('displayorder', 'asc');
		$query = $this->db->get();
		$record->lineitems = $query->result();

		// Invoice Status
		$this->db->select('name AS invoicestatus');
		$query = $this->db->get_where('invoicestatuses', array('uuid' => $invoice->statusid), 1);
		$invoicestatus = $query->result();
		$record->invoicestatus = $invoicestatus[0]->invoicestatus;
		
		// Payment Status
		$this->db->select('name AS paymentmethod');
		$query = $this->db->get_where('paymentmethods', array('uuid' => $invoice->paymentmethodid), 1);	
		$paymentmethod = $query->result();
		$record->paymentmethod = $paymentmethod[0]->paymentmethod;
		
		return $record;
		
	}
	
	
	
}