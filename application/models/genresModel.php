<?php if( !defined('BASEPATH') ) exit('Access not allowed');
class genresModel extends CI_Model{

	public $idgenre;
	public $genre;

	public function __construct(){
		parent::__construct();
	}

	public function get($idgenre=false){
		$idgenre ? $this->db->where('idgenre', $idgenre) : false;
		$this->db->order_by('genre');
		$query = $this->db->get('genres');
		return $query->result_array();
	}

	

}
?>