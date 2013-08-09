<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){
		$this->load->model('postsModel');
		$this->load->model('ratingsModel');
		$data['posts'] = $this->postsModel->get();
		$data['posts'] = $this->ratingsModel->generateRatings($data['posts'], $this->session->userdata('iduser'));
		// die(var_dump($data['posts']));
		foreach( $this->session->all_userdata() as  $k => $v ){
			echo "{$k} - {$v}<br>";
		}
		die();
		$this->template->load('template', 'home', $data);
	}
	
	public function login(){
		$user['email'] = $this->input->post('email');
		$user['password'] = $this->input->post('password');
		$this->load->model('usersModel');

		if( $this->usersModel->isValid($user) ){
			$user = $this->usersModel->get($user);
			$user = $user[0];
			$this->usersModel->login($user);
		} else {

		}

		$this->index();
	}

	public function logout(){
		$this->usersModel->logout();
		redirect(base_url());
	}

	public function login_validate($login){
		$this->load->library('form_validation');

		$ths->form_validation->set_rules('username', 'Nome', ' ');
	}
}
?>