<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aritem extends CI_Model {
	
	protected $clientid;
	
	public function __construct() {
		parent::__construct();
		
		// $this->output->enable_profiler(true);
		
		// Retrieve active client ID
		$user = unserialize($this->session->userdata('user'));
		$this->clientid = $user->uuid;
	}
	
	public function getClientLedgerItems() {
		// aritems table
		$this->db->select('aritems.id, aritems.status, aritems.amount, aritems.paid, aritems.aged1, aritems.aged2, aritems.aged3, invoices.id as invoice_id, aritems.modifieddate, receipts.receiptdate, receipts.status as receipt_status, receiptitems.applied, paymentmethods.name as paymentmethod, receipts.paymentother');
		$this->db->from('aritems');
		$this->db->join('invoices', 'invoices.uuid = aritems.relatedid', 'left');
		$this->db->join('receiptitems', 'aritems.uuid = receiptitems.aritemid', 'left');
		$this->db->join('receipts', 'receipts.uuid = receiptitems.receiptid', 'left');
		$this->db->join('paymentmethods', 'paymentmethods.uuid = receipts.paymentmethodid', 'left');
		$this->db->where('aritems.clientid', $this->clientid);
		$this->db->order_by('receipts.receiptdate', 'desc');
		$query = $this->db->get();
		$aritems = $query->result();

		// aritems -> receipts
		$this->db->select();
		





		return $aritems;
	}
	
}