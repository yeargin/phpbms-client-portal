<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Formats numbers as currency using locale settings. You can update the defaults in ./config/application.php
 *
 * @author Stephen Yeargin
 * @package default
 */

// Set locale
setlocale(LC_MONETARY, config_item('application_locale') ? config_item('application_locale') : 'en_US');

/**
 * Format Money
 *
 * @param float $number 
 */
function format_money($number = 0) {
	if (!is_numeric($number))
		return '$ n/a ';
	
	return money_format('%(#10n', $number);
}