<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PostsModel extends CI_Model {
	
	public function __construc(){
		parent::__construc();
	}

	public function get($post = array()){
		$query = $this->db->get('posts');
		return $query->result_array();
	}

	

}