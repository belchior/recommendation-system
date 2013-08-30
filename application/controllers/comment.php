<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comment extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('commentsModel');
	}

	public function get(){
		$comment['idmovie'] = $this->uri->segment(3, '');
		$data['comments'] = $this->commentsModel->get($comment);
		if( $this->input->is_ajax_request() ){
			$data['username'] = $this->usersModel->getUserSession('username');
			return $this->load->view('comments', $data);
		}
	}

	public function insert(){
		$this->input->is_ajax_request() ? true : die('Não foi possível completar sua requisição');
		$this->load->library('form_validation');
		if( !$this->commentsModel->validate() ){
			die;
		}

		$this->commentsModel->idmovie = $this->input->post('idmovie');
		$this->commentsModel->iduser = $this->usersModel->getUserSession('iduser');
		$this->commentsModel->comment = $this->input->post('comment');
		$commit = $this->commentsModel->insert();
		$commit->datetime = dateTimeBr($commit->datetime);
		$commit->username = $this->usersModel->getUserSession('username');
		die(json_encode($commit));
	}

}