<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class RatingsModel extends CI_Model{

	public function __construc(){
		parent::__construc();
	}

	public function insert($rate){
		$this->db->set('idpost', $rate['idpost']);
		$this->db->set('iduser', $rate['iduser']);
		$this->db->set('value', $rate['value']);
		$this->db->insert('ratings');
		return $this->db->insert_id();
	}

	public function update($rate){
		$this->db->set('value', $rate['value']);
		$this->db->where('idpost', $rate['idpost']);
		$this->db->where('iduser', $rate['iduser']);
		return $this->db->update('ratings');
	}

	public function validate($rate){

		if( !isset($rate['idpost']) || (int)$rate['idpost'] === 0 || strlen($rate['idpost']) > 11 ){
			return false;
		}

		if( !isset($rate['iduser']) || (int)$rate['iduser'] === 0 || strlen($rate['iduser']) > 11 ){
			return false;
		}

		if( !isset($rate['value']) || (int)$rate['value'] === 0 || strlen($rate['value']) > 1 || (int)$rate['value'] > 5 || (int)$rate['value'] < 1 ){
			return false;
		}

		return true;
	}

	public function isRated($rate){
		$this->db->where('idpost', $rate['idpost']);
		$this->db->where('iduser', $rate['iduser']);
		$query = $this->db->get('ratings');
		return $query->num_rows() ? true : false;
	}

	public function generateRatings($posts, $iduser){
		if( !is_array($posts) ){
			return $posts;
		}

		if( $iduser ){
			foreach( $posts as $key => $post ){
				$posts[$key]['rating'] = $this->getUserRating($post, $iduser);
				$posts[$key]['userRating'] = true;
				if( !$posts[$key]['rating'] ){
					$posts[$key]['rating'] = $this->getRating($post);
					$posts[$key]['userRating'] = false;
				}
			}	
		} else {
			foreach( $posts as $key => $post ){
				$posts[$key]['rating'] = $this->getRating($post);
				$posts[$key]['userRating'] = false;
			}
		}
		
		return $posts;
	}

	public function getRating($post){
		$this->db->select_avg('value');
		$this->db->where('idpost', $post['idpost']);
		$rate = $this->db->get('ratings');
		$rate = $rate->result_array();
		return $rate[0]['value'] ? (int)$rate[0]['value'] : 0;
	}

	public function getUserRating($post, $iduser){
		$this->db->where('idpost', $post['idpost']);
		$this->db->where('iduser', $iduser);
		$query = $this->db->get('ratings');
		$query = $query->result_array();
		return count($query) ? (int)$query[0]['value'] : 0;
	}










}