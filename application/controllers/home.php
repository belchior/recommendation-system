<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('moviesModel');
	}

	public function index(){
		$data['movies'] = $this->moviesModel->get();
		$data['movies'] = $this->parseMovies($data['movies']);
		if( $user = $this->usersModel->getUserSession() ){
			$data['recommendations'] = $this->ratingsModel->getUserRecommendations($user);
		}
		$this->template->load('template', 'home', $data);
	}

	private function parseMovies($movies){
		$this->load->model('ratingsModel');

		foreach( $movies as $key => $movie ){
			$genres = array();
			foreach( $this->moviesModel->getGenres($movie) as $genre ){
				$genres[] = $genre['genre'];
			}
			$movies[$key]['genres'] = implode(' | ', $genres);
		}

		$movies = $this->ratingsModel->generateRatings($movies, $this->session->userdata('iduser'));

		return $movies;
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

	public function search(){
		$this->input->is_ajax_request() ? true : die('Não foi possível completar sua requisição.');
		$search = $this->uri->segment(2, '');
		$search = urldecode($search);
		$search = trim($search);
		$search = addslashes($search);
		
		$data['movies'] = $this->moviesModel->search($search);
		$data['movies'] = $this->parseMovies($data['movies']);
		$data['search'] = $search;
		$this->load->view('home', $data);
	}

}
?>