<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Model {
	
	/**
	 * Get Settings
	 *
	 * @return array
	 */
	public function getSettings() {
		$this->db->select();
		$query = $this->db->get('settings');
		$settings = $query->result();
		
		$result = array();
		foreach ($settings as $setting):
				$result[$setting->name] = $setting->value;
		endforeach;
		
		return $result;		
	}

}	