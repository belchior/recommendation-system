<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Movie extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('moviesModel');
		$this->load->model('genresModel');
		$this->load->library('form_validation');
		$this->load->helper('function');
	}

	public function index(){
		$this->create();
	}

	public function show(){
		$movie['url'] = $this->uri->segment(3, '');
		$data['movie'] = $this->moviesModel->get($movie);
		$data['movie'] = $this->moviesModel->parseMovies($data['movie']);
		if( !$data['movie'] ){
			redirect(base_url());
		}
		$data['movie'] = $data['movie'][0];
		if( $user = $this->usersModel->getUserSession() ){
			$data['username'] = $user['username'];
			$data['recommendations'] = $this->ratingsModel->getUserRecommendations($user);
		}
		$data['comments'] = $this->load->view('comments', $data, true);
		$this->template->load('template', 'movie/show', $data);
	}

	public function create(){
		$data['genres'] = $this->genresModel->get();
		$this->template->load('template', 'movie/create', $data);
	}

	public function alter(){
		$data['message'] = $this->session->userdata('message');
		$this->session->unset_userdata('message');

		$movie['url'] = $this->uri->segment(3, '');
		$data['movie'] = $this->moviesModel->get($movie);
		if( !$data['movie'] ){
			redirect(base_url());
		}
		$data['movie'] = $data['movie'][0];
		$data['movie']['genres'] = $this->moviesModel->getGenres($data['movie']);
		$data['genres'] = $this->genresModel->get();
		$this->template->load('template', 'movie/alter', $data);
	}

	public function save(){
		$movie['url'] = $this->uri->segment(3);
		if( $movie['url'] ){
			$movie = (array)$this->update();
			$this->session->set_userdata('message', 'Suas alterações foram salvas com sucesso.');
			
		} else {
			$movie = (array)$this->insert();
			$this->session->set_userdata('message', 'Filme salvo com sucesso.');
		}

		redirect(base_url("movie/alter/{$movie['url']}"));
	}

	private function insert(){
		if( !$this->moviesModel->validate() ){
			return $this->create();
		}
		
		$this->moviesModel->director = $this->input->post('director');
		$this->moviesModel->title = $this->input->post('title');
		$this->moviesModel->year = $this->input->post('year');
		$this->moviesModel->synopses = $this->input->post('synopses');
		$this->moviesModel->genres = $this->input->post('genres');
		return $this->moviesModel->insert();
	}

	private function update(){
		if( !$this->moviesModel->validate() ){
			return $this->alter();
		}

		// $errors = $this->moviesModel->uploadImage();
		// if( $errors ){
			// die(var_dump($_FILES));
			// die(var_dump($errors));
		// }
		
		$this->moviesModel->idmovie = $this->input->post('idmovie');
		$this->moviesModel->director = $this->input->post('director');
		$this->moviesModel->title = $this->input->post('title');
		$this->moviesModel->year = $this->input->post('year');
		$this->moviesModel->synopses = $this->input->post('synopses');
		$this->moviesModel->genres = $this->input->post('genres');
		$this->moviesModel->update();
		return $this->moviesModel;
	}

}
?>