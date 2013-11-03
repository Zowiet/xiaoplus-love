<?php

class Letter_Model extends MY_Model {
	public function __construct() {
		parent::__construct();
		$this->table = 'm_letters';
		$this->db = $this->load->database('default', TRUE);
	}
	
	public function insert_loveletter($data){
		return $this->insert($data);

	}

	public function delete_loveletter_by_id($loveletter_id){
		$data = array('id' => $loveletter_id);
		return $this->delete($data);
	}

	public function get_loveletter_by_id($loveletter_id){
		$data = array('id' => $loveletter_id);
		$this->where($data);
		return $this->result_array();
	}

	public function get_loveletter_by_weibo_name($weibo_name){
		$data = array('to_weibo_name' => $weibo_name);
		$this->where($data);
		return $this->result_array();
	}

	#赞最多的十条
	public function get_loveletters_by_praise($num, $start = 0){
		$this->order_by('praise', 'desc');
		$this->limit($num, $start);
		return $this->result_array();
	}

	#最新发布的
	//缺少分页
	public function get_loveletters_by_newtime($num, $start = 0){
		$this->order_by('ctime', 'desc');
		$this->limit($num, $start);
		return $this->result_array();

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

























