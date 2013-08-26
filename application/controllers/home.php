<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){
		$this->load->model('moviesModel');
		$this->load->model('ratingsModel');
		$data['movies'] = $this->moviesModel->get();
		foreach( $data['movies'] as $key => $movie ){
			$genres = array();
			foreach( $this->moviesModel->getGenres($movie) as $genre ){
				$genres[] = $genre['genre'];
			}
			$data['movies'][$key]['genres'] = implode(' | ', $genres);
		}

		$data['movies'] = $this->ratingsModel->generateRatings($data['movies'], $this->session->userdata('iduser'));
		if( $user = $this->usersModel->getUserSession() ){
			$data['recommendations'] = $this->ratingsModel->getUserRecommendations($user);
		}
		$this->template->load('template', 'home', $data);
	}
	
	public function login(){
		$user['email'] = $this->input->post('email');
		$user['password'] = $this->input->post('password');

		if( $this->usersModel->isValid($user) ){
			$this->usersModel->logout();
			$user = $this->usersModel->get($user);
			$user = $user[0];
			$this->usersModel->login($user);
		} else {

		}

		redirect(base_url());
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