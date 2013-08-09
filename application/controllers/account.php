<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account extends CI_Controller{

	private $validatePassword;

	public function __construct(){
		parent::__construct();
		$this->load->model('usersModel');
		$this->load->library('form_validation');
	}

	public function index(){
		// $this->session->set_userdata('iduser', 4);
		$this->create();
	}

	public function create(){
		$this->usersModel->logout()
		$data['message'] = $this->session->userdata('message');
		$this->session->unset_userdata('message');
		$data['content'] = $this->load->view('account/create', $data, true);
		$this->load->view('template', $data);
	}

	public function alter(){
		$user['id'] = $this->session->userdata('iduser');
		if( !$user['id'] ){
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
		if( !$this->session->userdata('iduser') ){
			$this->insert();
		} else {
			$this->update();
		}
	}

	private function insert(){
		if( ! $this->usersModel->validate() ){
			$data['content'] = $this->load->view('create', '', true);
			return $this->load->view('template', $data);
		}
		
		$user = array();
		$user['username'] = $this->input->post('username');
		$user['email'] = $this->input->post('email');
		$user['password'] = $this->input->post('password');
		$user['preferences'] = $this->input->post('preferences');
		$id = $this->usersModel->insert($user);

		$this->session->set_userdata('iduser', $id);
		$this->session->set_userdata('message', 'Sua conta foi criada com sucesso.');
		redirect(base_url("account/alter"));
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

		$this->session->set_userdata('message', 'Sua conta foi alterada com sucesso.');
		redirect(base_url("account/alter"));
	}

}