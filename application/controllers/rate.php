<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rate extends CI_Controller{

	public function index(){

	}

	public function thisMovie(){
		$this->input->is_ajax_request() ? true : die('Não foi possível concluir sua requisição');
		$this->load->model('ratingsModel');
		$rate['iduser'] = $this->session->userdata('iduser');
		$rate['idmovie'] = $this->uri->segment(3);
		$rate['value'] = $this->uri->segment(4);

		if( $this->ratingsModel->validate($rate) ){
			if( $this->ratingsModel->isRated($rate) ){
				$this->ratingsModel->update($rate);
			} else {
				$this->ratingsModel->insert($rate);
			}
			
			echo "Sua nota foi salva com sucesso";
		} else {
			die(var_dump($rate));
		}
		
	}

}
?>