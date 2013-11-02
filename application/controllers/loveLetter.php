<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoveLetter extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function publish(){
		echo "publish a love letter";
	}
}
