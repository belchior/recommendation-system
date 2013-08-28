<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MoviesModel extends CI_Model {
	
	public $idmovie;
	public $title;
	public $year;
	public $synopses;
	public $logo;
	public $genres;
	public $director;
	public $url;

	public function __construct(){
		parent::__construct();
	}

	public function get($movie = array()){
		isset($movie['idmovie']) ? $this->db->where('movies.idmovie', $movie['idmovie']) : false;
		isset($movie['url']) ? $this->db->where('movies.url', normalize_url($movie['url'])) : false;

		$this->db->group_by('movies.idmovie');
		$query = $this->db->get('movies');
		return $query->result_array();
	}

	public function search($search=''){
		$this->db->join('movies_has_genres', 'movies.idmovie = movies_has_genres.idmovie', 'left');
		$this->db->join('genres', 'movies_has_genres.idgenre = genres.idgenre', 'left');
		$this->db->or_like('director', $search);
		$this->db->or_like('title', $search);
		$this->db->or_like('synopses', $search);
		$this->db->or_like('year', $search);
		$this->db->or_like('genre', $search);
		$this->db->group_by('movies.idmovie');
		$query = $this->db->get('movies');
		return $query->result_array();
	}

	public function parseMovies($movies){
		$this->load->model('ratingsModel');

		foreach( $movies as $key => $movie ){
			$genres = array();
			foreach( $this->getGenres($movie) as $genre ){
				$genres[] = $genre['genre'];
			}
			$movies[$key]['genres'] = implode(' | ', $genres);
		}

		$movies = $this->ratingsModel->generateRatings($movies, $this->session->userdata('iduser'));

		return $movies;
	}

	public function insert(){
		$this->db->set('director', $this->director);
		$this->db->set('title', $this->title);
		$this->db->set('year', $this->year);
		$this->db->set('synopses', $this->synopses);
		$this->db->set('url', normalize_url($this->title));
		$this->db->set('logo', $this->logo = $this->logo ? $this->logo : 'movie/no_image.jpg');
		$this->db->insert('movies');
		$this->idmovie = $this->db->insert_id();

		if( is_array($this->genres) ){
			foreach( $this->genres as $genre ){
				$this->db->set('idmovie', $this->idmovie);
				$this->db->set('idgenre', $genre);
				$this->db->insert('movies_has_genres');
			}
		}
		return $this;
	}

	public function update(){
		$this->db->set('director', $this->director);
		$this->db->set('title', $this->title);
		$this->db->set('year', $this->year);
		$this->db->set('synopses', $this->synopses);
		$this->db->set('url', $this->url = normalize_url($this->title));
		$this->db->where('idmovie', $this->idmovie);
		$this->db->update('movies');

		$this->db->where('idmovie', $this->idmovie);
		$this->db->delete('movies_has_genres');
		if( is_array($this->genres) ){
			foreach( $this->genres as $genre ){
				$this->db->set('idmovie', $this->idmovie);
				$this->db->set('idgenre', $genre);
				$this->db->insert('movies_has_genres');
			}
		}
		return true;
	}

	public function validate(){
		$this->form_validation->set_error_delimiters('<span class="text-error">', '</span>');
		$this->form_validation->set_rules('director', 'Diretor', 'required|trim|strip_tags|max_length[100]');
		$this->form_validation->set_rules('title', 'Título', 'required|trim|strip_tags|max_length[100]');
		$this->form_validation->set_rules('year', 'Ano', 'required|is_natural_no_zero|exact_length[4]');
		$this->form_validation->set_rules('synopses', 'Sinopse', 'required|trim|strip_tags');
		return $this->form_validation->run();
	}

	public function uploadImage(){
		$config['upload_path'] = IMG_DIR . 'movie/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1024';
		$config['max_width']  = '1024';
		$config['max_height']  = '1024';
		$this->load->library('upload');
		$this->upload->initialize($config);

		if( !$this->upload->do_upload() ){
			return $this->upload->display_errors();
		}
		return true;
	}

	public function getGenres($movie){
		$this->db->select('genres.idgenre, genre');
		$this->db->join('genres', 'movies_has_genres.idgenre = genres.idgenre', 'inner');
		$this->db->where('idmovie', $movie['idmovie']);
		$query = $this->db->get('movies_has_genres');
		return $query->result_array();
	}


} 