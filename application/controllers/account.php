<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account extends CI_Controller{

	private $validatePassword;

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index(){
		// $this->session->set_userdata('iduser', 4);
		$this->create();
	}

	public function create(){
		$this->usersModel->logout();
		$data['message'] = $this->session->userdata('message');
		$this->session->unset_userdata('message');
		$this->template->load('template', 'account/create', $data);
	}

	public function alter(){
		$user = $this->usersModel->getUserSession();
		if( !$user['iduser'] ){
			$this->session->set_userdata('message', 'Usuário não encontrado, use o formulário abaixo para criar um.');
			redirect(base_url('account/create'));
		}

		$data['message'] = $this->session->userdata('message');
		$this->session->unset_userdata('message');
		$data['validatePassword'] = $this->validatePassword;
		$data['user'] = $this->usersModel->get($user);
		$data['user'] = $data['user'][0];
		$data['content'] = $this->load->view('account/alter', $data, true);
		$this->load->view('template', $data);
	}

	public function save(){
		if( !$this->usersModel->getUserSession() ){
			$user = $this->insert();
			$this->usersModel->login($user);
			$this->session->set_userdata('message', 'Sua conta foi criada com sucesso.');

		} else {
			$this->update();
			$this->session->set_userdata('message', 'Sua conta foi alterada com sucesso.');
		}

		redirect(base_url("account/alter"));
	}

	private function insert(){
		if( ! $this->usersModel->validate() ){
			return $this->template->load('template', 'create');
		}
		
		$user = array();
		$user['username'] = $this->input->post('username');
		$user['email'] = $this->input->post('email');
		$user['password'] = $this->input->post('password');
		$user['preferences'] = $this->input->post('preferences');
		$user['iduser'] = $this->usersModel->insert($user);
		return $user;
	}

	private function update(){
		$this->validatePassword = (boolean)$this->input->post('validatePassword');
		if( !$this->usersModel->validate($this->validatePassword) ){
			return $this->alter();
		}

		$user = array();
		$user['iduser'] = $this->session->userdata('iduser');
		$user['username'] = $this->input->post('username');
		$user['email'] = $this->input->post('email');
		$user['password'] = $this->input->post('password');
		$user['preferences'] = $this->input->post('preferences');
		$this->usersModel->update($user);
	}

}