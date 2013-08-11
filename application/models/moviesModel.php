<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MoviesModel extends CI_Model {
	
	public $idmovie;
	public $title;
	public $synopses;
	public $logo;
	public $genres;
	public $director;

	public function __construc(){
		parent::__construc();
	}

	public function get($movie = array()){
		isset($movie['idmovie']) ? $this->db->where('idmovie', $movie['idmovie']) : false;
		$query = $this->db->get('movies');
		return $query->result_array();
	}

	public function insert(){
		$this->db->insert('movies', $this);
		$this->idmovie = $this->db->insert_id();
		return $this;
	}

	public function update(){
		$this->db->where('idmovie', $this->idmovie);
		$this->db->update('movies', $this);

		return true;
	}

	public function validate(){
		$this->form_validation->set_error_delimiters('<span class="text-error">', '</span>');
		$this->form_validation->set_rules('director', 'Diretor', 'required|trim|strip_tags|max_length[100]');
		$this->form_validation->set_rules('title', 'Título', 'required|trim|strip_tags|max_length[100]');
		$this->form_validation->set_rules('synopses', 'Sinopse', 'required|trim|strip_tags');
		$this->form_validation->set_rules('genres', 'Genero', 'trim|strip_tags');
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

} 