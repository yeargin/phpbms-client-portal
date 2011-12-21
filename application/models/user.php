<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public function login() {
		$this->db->select('id, uuid, firstname, lastname, type, email, username');
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', $this->input->post('password'));
		$query = $this->db->get('clients');
		
		// If valid, set 'user' session variable. If not, clear it.
		if($query->num_rows == 1):
			$this->session->set_userdata('user', serialize(array_shift($query->result())));
			return true;
		else:
			$this->session->unset_userdata('user');
			return false;
		endif;
	}
	

	public function logout() {
		$this->session->unset_userdata('user');
		return true;
	}

	public function isLoggedIn() {
		if (!$this->session->userdata('user'))
			return false;
		else
			return true;
	}
	
	public function requireAuth($redirect = 'login') {
		$auth = $this->isLoggedIn();
		if (!$auth)
			redirect($redirect);
	}
	
	public function getCurrentUser() {
		if (!$this->isLoggedIn())
			return false;
		
		$user = unserialize($this->session->userdata('user'));
		return $this->getUserById($user->id);
		
	}
	
	public function getUserById($id) {
		$query = $this->db->get_where('clients', array('id' => $id), 1);
		return array_shift($query->result());
	}

	public function getUserByUuid($id) {
		$query = $this->db->get_where('clients', array('uuid' => $id), 1);
		return array_shift($query->result());
	}

}