<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class usersModel extends CI_Model{

	public function __construc(){
		parent::__construc();
	}

	public function get($user){
		isset($user['id']) && $user['id'] ? $this->db->where('iduser', $user['id']) : false;
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function insert($user){
		$this->db->set('username', $user['username']);
		$this->db->set('email', $user['email']);
		$this->db->set('password', $user['password']);
		$this->db->set('preferences', $user['preferences']);
		$this->db->insert('users');
		return $this->db->insert_id();
	}

	public function update($user, $updatePassword=true){
		$this->db->set('username', $user['username']);
		$this->db->set('email', $user['email']);
		$updatePassword ? $this->db->set('password', $user['password']) : false;
		$this->db->set('preferences', $user['preferences']);
		$this->db->where('iduser', $user['iduser']);
		return $this->db->update('users');
	}

	public function validate($validatePassword=true){
		
		$this->form_validation->set_error_delimiters('<span class="text-error">', '</span>');
		$this->form_validation->set_rules('username', 'Nome de usuário', 'required|trim|strip_tags|max_length[100]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim||strip_tags|max_length[100]|valid_email');
		$validatePassword ? $this->form_validation->set_rules('password', 'Senha', 'required|max_length[100]|do_hash') : false;
		$this->form_validation->set_rules('preferences', 'Preferências', 'trim|strip_tags|max_length[500]');
		return $this->form_validation->run();
	}

	public function isValid($user){
		$this->db->where('email', $user['email']);
		$this->db->where('password', do_hash($user['password']));
		$query = $this->db->get('users');
		return $query->num_rows() ? true : false;
	}

	public function login($user){
		unset($user['password']);
		$this->session->set_userdata($user);
	}

	public function logout(){
		$user['iduser'] = '';
		$user['email'] = '';
		$user['password'] = '';
		$user['username'] = '';
		$user['image'] = '';
		$user['preferences'] = '';
		$this->session->unset_userdata($user);
	}

}
?>