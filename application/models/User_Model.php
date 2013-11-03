<?php

class User_Model extends MY_Model {
	public function __construct() {
		parent::__construct();
		$this->table = 'user';   #user表，看看是不是这个名字
		$this->db = $this->load->database('default', TRUE);
	}
	
	public function get_user_by_weiboId($weiboId) {
		#$this->db->where('weiboId', $weiboId);    wei 微博ID的字段
		return $this->result_single();
	}


	# param1, param2  替换
	public function insert_user($param1, $param2) {  
		$user = array (
				'$param1'   => $param2,
				'param2'	=> $param2,
				'status'	=> 100,
				'extend'	=> '{}'
		);
		
		return $this->insert($user);
	}
	
	// public function update_user($user) {
	// 	$this->db->where('', $user['']);
	// 	return $this->update($user);
	// }
}
