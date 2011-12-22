<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdfcache extends CI_Controller {

	public function invoice() {
		$filename = APPPATH . 'cache/pdfcache/' . $this->uri->segment(3);
		$handle = fopen($filename, "r");
		$filesize = filesize($filename);
		$contents = fread($handle, $filesize);
		fclose($handle);
		$pathinfo = pathinfo($filename);
		
		// Set filename for download
		$file_parts = preg_split('/-/', $filename);
		$download_name = array_shift(array_slice($file_parts, -1, 1));
		
		// Rendering which phase of the PDF
		switch ($pathinfo['extension']):
			case 'html':
				header('Content-type: text/html');
				break;
			case 'pdf':
				header('Content-Type: application/pdf');
				header('Content-Length: '.filesize($filename));
				header(sprintf('Content-Disposition: inline; filename="%s"', $filename ? urlencode($download_name) : 'pdf.pdf'));
				header('Cache-Control: private, max-age=0, must-revalidate');
				header('Pragma: public');
				ini_set('zlib.output_compression','0');
				break;
		endswitch;
		
		print $contents;

	}
	
}