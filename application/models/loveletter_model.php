<?php

class User_Model extends MY_Model {
	public function __construct() {
		parent::__construct();
		$this->table = 'm_content';   #loveletter表，看看是不是这个名字
		$this->db = $this->load->database('default', TRUE);
	}
	
	//========================================
	//follow function interact with database
	// public function insert_loveletter($loveletter){
	// 	$loveletter_detail = array(
	// 			''=> ,
	// 			''=>
	// 		)
	//     return $this->insert($loveletter_detail);
	// }
	
}

























