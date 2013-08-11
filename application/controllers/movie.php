<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Movie extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('moviesModel');
		$this->load->library('form_validation');
	}

	public function index(){
		$this->create();
	}

	public function create(){
		
		$this->template->load('template', 'movie/create');
	}

	public function alter(){
		$data['message'] = $this->session->userdata('message');
		$this->session->unset_userdata('message');

		$movie['idmovie'] = $this->uri->segment(3, 4);
		$data['movie'] = $this->moviesModel->get($movie);
		$data['movie'] = $data['movie'][0];
		$this->template->load('template', 'movie/alter', $data);
	}

	public function save(){
		$movie['idmovie'] = $this->uri->segment(3);
		if( $movie['idmovie'] ){
			$this->update();
			$this->session->set_userdata('message', 'Suas alterações foram salvas com sucesso.');
			
		} else {
			$movie = (array)$this->insert();
			$this->session->set_userdata('message', 'Filme salvo com sucesso.');
		}

		redirect(base_url("movie/alter/{$movie['idmovie']}"));
	}

	private function insert(){
		if( !$this->moviesModel->validate() ){
			return $this->create();
		}
		
		$this->moviesModel->director = $this->input->post('director');
		$this->moviesModel->title = $this->input->post('title');
		$this->moviesModel->synopses = $this->input->post('synopses');
		$this->moviesModel->genres = $this->input->post('genres');
		return $this->moviesModel->insert();
	}

	private function update(){
		if( !$this->moviesModel->validate() ){
			return $this->alter();
		}

		$errors = $this->moviesModel->uploadImage();
		if( $errors ){
			// die(var_dump($_FILES));
			die(var_dump($errors));
		}
		$this->moviesModel->idmovie = $this->uri->segment(3);
		$this->moviesModel->director = $this->input->post('director');
		$this->moviesModel->title = $this->input->post('title');
		$this->moviesModel->synopses = $this->input->post('synopses');
		$this->moviesModel->genres = $this->input->post('genres');
		$this->moviesModel->update();
	}

}
?>