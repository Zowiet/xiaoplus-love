<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('./common/header');
		$this->load->view('./index/index');
	}

	public function notify(){
		$this->load->Model("Notify_Model");
		$result = $this->Notify_Model->get_notify(1);
		var_dump($result);
	}
}
