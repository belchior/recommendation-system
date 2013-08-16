<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class usersModel extends CI_Model{

	public $iduser;
	public $email;
	public $username;
	public $password;
	public $image;

	public function __construc(){
		parent::__construc();
	}

	public function get($user){
		isset($user['id']) && $user['id'] ? $this->db->where('iduser', $user['id']) : false;
		isset($user['email']) && $user['email'] ? $this->db->where('email', $user['email']) : false;
		isset($user['password']) && $user['password'] ? $this->db->where('password', do_hash($user['password'])) : false;
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function insert($user){
		$this->db->set('username', $user['username']);
		$this->db->set('email', $user['email']);
		$this->db->set('password', $user['password']);
		$this->db->insert('users');
		$user['iduser'] = $this->db->insert_id();

		if( isset($user['genres']) && is_array($user['genres']) ){
			foreach( $user['genres'] as $genre ){
				$this->db->set('iduser', $user['iduser']);
				$this->db->set('idgenre', $genre);
				$this->db->insert('users_has_genres');
			}
		}

		return $user;
	}

	public function update($user, $updatePassword=true){
		$this->db->set('username', $user['username']);
		$this->db->set('email', $user['email']);
		$updatePassword ? $this->db->set('password', $user['password']) : false;
		$this->db->where('iduser', $user['iduser']);
		$this->db->update('users');

		$this->db->where('iduser', $user['iduser']);
		$this->db->delete('users_has_genres');
		if( isset($user['genres']) && is_array($user['genres']) ){
			foreach( $user['genres'] as $genre ){
				$this->db->set('iduser', $user['iduser']);
				$this->db->set('idgenre', $genre);
				$this->db->insert('users_has_genres');
			}
		}

		return true;
	}

	public function validate($validatePassword=true){
		$this->form_validation->set_error_delimiters('<span class="text-error">', '</span>');
		$this->form_validation->set_rules('username', 'Nome de usuário', 'required|trim|strip_tags|max_length[100]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|strip_tags|max_length[100]|valid_email');
		$validatePassword ? $this->form_validation->set_rules('password', 'Senha', 'required|max_length[100]|do_hash') : false;
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
		$this->session->unset_userdata($user);
	}

	public function getUserSession(){
		if( !$this->session->userdata('iduser') ){
			return false;
		}
		$user['iduser'] = $this->session->userdata('iduser');
		$user['email'] = $this->session->userdata('email');
		$user['username'] = $this->session->userdata('username');
		$user['image'] = $this->session->userdata('image');
		$user['preferences'] = $this->session->userdata('preferences');
		return $user;
	}

	public function getGenres($user){
		$this->db->select('genres.idgenre, genre');
		$this->db->join('genres', 'users_has_genres.idgenre = genres.idgenre', 'inner');
		$this->db->where('iduser', $user['iduser']);
		$query = $this->db->get('users_has_genres');
		return $query->result_array();
	}

}
?>