<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class RatingsModel extends CI_Model{

	public function __construc(){
		parent::__construc();
	}

	public function insert($rate){
		$this->db->set('idmovie', $rate['idmovie']);
		$this->db->set('iduser', $rate['iduser']);
		$this->db->set('value', $rate['value']);
		$this->db->insert('ratings');
		return $this->db->insert_id();
	}

	public function update($rate){
		$this->db->set('value', $rate['value']);
		$this->db->where('idmovie', $rate['idmovie']);
		$this->db->where('iduser', $rate['iduser']);
		return $this->db->update('ratings');
	}

	public function validate($rate){

		if( !isset($rate['idmovie']) || (int)$rate['idmovie'] === 0 || strlen($rate['idmovie']) > 11 ){
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
		$this->db->where('idmovie', $rate['idmovie']);
		$this->db->where('iduser', $rate['iduser']);
		$query = $this->db->get('ratings');
		return $query->num_rows() ? true : false;
	}

	public function generateRatings($movies, $iduser = ''){
		if( !is_array($movies) ){
			return $movies;
		}

		if( $iduser ){
			foreach( $movies as $key => $movie ){
				$movies[$key]['rating'] = $this->getUserRating($movie, $iduser);
				$movies[$key]['userRating'] = true;
				if( !$movies[$key]['rating'] ){
					$movies[$key]['rating'] = $this->getRating($movie);
					$movies[$key]['userRating'] = false;
				}
			}	
		} else {
			foreach( $movies as $key => $movie ){
				$movies[$key]['rating'] = $this->getRating($movie);
				$movies[$key]['userRating'] = false;
			}
		}
		
		return $movies;
	}

	public function getRating($movie){
		$this->db->select_avg('value');
		$this->db->where('idmovie', $movie['idmovie']);
		$rate = $this->db->get('ratings');
		$rate = $rate->result_array();
		return $rate[0]['value'] ? (int)$rate[0]['value'] : 0;
	}

	public function getUserRating($movie, $iduser){
		$this->db->where('idmovie', $movie['idmovie']);
		$this->db->where('iduser', $iduser);
		$query = $this->db->get('ratings');
		$query = $query->result_array();
		return count($query) ? (int)$query[0]['value'] : 0;
	}

	public function getUserRecommendations($user){
		$query = $this->db->query("
			SELECT movies.idmovie, movies.director, movies.title, movies.synopses, movies.logo, AVG(value) AS rating
			FROM movies 
				INNER JOIN movies_has_genres USING(idmovie)
				LEFT JOIN ratings USING(idmovie)
			WHERE 
				idgenre IN (
					SELECT idgenre 
					FROM users INNER JOIN users_has_genres USING(iduser)
					WHERE users.iduser = {$user['iduser']}
				)
				AND movies.idmovie NOT IN (
					SELECT idmovie 
					FROM ratings 
					WHERE iduser = {$user['iduser']}
				)
			GROUP BY movies.idmovie
			ORDER BY value DESC
		");

		return $query->num_rows() ? $query->result_array() : false;
	}








}