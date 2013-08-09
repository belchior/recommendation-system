<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template {

	public $template_data = array();

	public function set($name, $value){
		$this->template_data[$name] = $value;
	}

	public function load($template = '', $view = '', $data = array(), $return = false){
		$this->ci =& get_instance();

		if( $data['user'] = $this->ci->usersModel->getUserSession() ){
			
			$this->set('login', $this->ci->load->view('templateUser', $data, true));

		} else {
			$this->set('login', $this->ci->load->view('templateLogin', $data, true));
		}

		$this->set('content', $this->ci->load->view($view, $data, true));
		return $this->ci->load->view($template, $this->template_data, $return);
	}

}