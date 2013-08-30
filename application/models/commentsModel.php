<?php if(!defined('BASEPATH')) exit('Access not allowed');
class CommentsModel extends CI_Model {

	public $idcomment;
	public $idmovie;
	public $iduser;
	public $comment;
	public $datetime;

	public function __construct(){
		parent::__construct();
	}

	public function get($comment){
		isset($comment['idcomment']) ? $this->db->where('idcomment', $comment['idcomment']) : false;
		isset($comment['idmovie']) ? $this->db->where('movies.idmovie', $comment['idmovie']) : false;
		$this->db->join('users', 'users.iduser = comments.iduser', 'inner');
		$this->db->join('movies', 'movies.idmovie = comments.idmovie', 'inner');
		$this->db->order_by('comments.datetime');
		$query = $this->db->get('comments');
		return $query->num_rows() ? $query->result_array() : false;
	}

	public function insert(){
		$this->db->set('idcomment', $this->idcomment);
		$this->db->set('idmovie', $this->idmovie);
		$this->db->set('iduser', $this->iduser);
		$this->db->set('comment', $this->comment);
		@$this->db->set('datetime', $this->datetime = date('Y-m-d h:m:s'));
		$this->db->insert('comments');
		$this->idcomment = $this->db->insert_id();
		return $this;
	}

	public function validate(){		
		$this->form_validation->set_error_delimiters('<span class="text-error">', '</span>');
		$this->form_validation->set_rules('idmovie', 'Filme', 'required|is_natural_no_zero|max_length[11]');
		$this->form_validation->set_rules('comment', 'comentário', 'required|trim|strip_tags|max_length[500]');
		return $this->form_validation->run();
	}

}