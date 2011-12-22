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

		$data['settings'] = $this->setting->getSettings();

		$record->amountdue = ($record->totalti - $record->amountpaid);
		$data['record'] = $record;

		// Show PDF button?
		if (file_exists($this->config->item('pdf_generator_path')))
			$data['has_pdf'] = true;
		else
			$data['has_pdf'] = false;
	
		$data['page_title'] = 'Record Detail';

		$this->load->view('history/detail', $data);
		
	}
	
	/**
	 * PDF
	 */
	public function pdf() {
		
		if (!file_exists($this->config->item('pdf_generator_path')))
			show_error('Your <tt>pdf_generator_path</tt> is not set correctly. File not found', 404);
		
		$invoiceid = $this->input->get('invoice_id');
		
		// Empty invoice ID
		if (!$invoiceid)
			redirect('history');
		
		$record = $this->invoice->getInvoiceById($invoiceid);

		// Invalid invoice ID
		if (!$record)
			redirect('history');

		$data['settings'] = $this->setting->getSettings();

		$record->amountdue = ($record->totalti - $record->amountpaid);
		$data['record'] = $record;
		
		// Load document as a variable to pass to PDF
		$document = $this->load->view('history/print', $data, true);
		
		$this->generatePDF($document, $invoiceid);
	}
	
	/**
	 * Generate PDF
	 *
	 * @param string $document 
	 * @param string $filename 
	 */
	private function generatePDF($document = '<html></html>', $filename = 'document') {
		// Generate paths that will be used for reading/writing
		$cache_id = md5($document) . '-' . $filename;
		$cache_folder = realpath(BASEPATH . '../' . APPPATH . '/cache/pdfcache');
		$cache_html = $cache_folder . '/' . $cache_id .'.html';
		$cache_pdf = $cache_folder . '/' . $cache_id . '.pdf';
		$public_html = site_url('pdfcache/invoice/' . $cache_id . '.html');
		$public_pdf = site_url('pdfcache/invoice/' . $cache_id . '.pdf');
		
		// If file exists, assume it's already good.
		if (file_exists($cache_pdf))
			redirect($public_pdf);
		
		// Save temporary HTML html
		$status = write_file($cache_html, $document, 'w+');
		
		// Cache folder wasn't writable.
		if (!$status)
			show_error('Unable to write cache file.', 500);

		// Generate PDF Document
		$cmd = sprintf('%s %s %s', $this->config->item('pdf_generator_path'), $public_html, $cache_pdf);
		$shell = shell_exec($cmd);
		
		// Make sure PDF was written
		$pdf_final = $cache_pdf;
		if (!file_exists($pdf_final))
			show_error('PDF file not generated.', 500);
		
		redirect($public_pdf);
	}
	
}