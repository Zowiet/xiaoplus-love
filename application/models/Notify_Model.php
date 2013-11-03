<?php

class Notify_Model extends MY_Model {
	public function __construct() {
		parent::__construct();
		$this->table = 'm_user_notify';   #loveletter表，看看是不是这个名字
		$this->db = $this->load->database('default', TRUE);
	}
	
	//========================================
	//follow function interact with database
	public function add_notify($loveletter_id, $uid){
		$data = array(
			'loveletter_id' => $loveletter_id,
			'member_uid' => $uid,
			'ctime' => time());
		return $this->insert($data);
	}

	public function update_notify($loveletter_id, $uid, $new = True){
		$condition = array('loveletter_id' => $loveletter_id, 'member_uid' => $uid);
		$this->where($condition);
		if($new){
			$this->set('comment_number', 'comment_number+1', FALSE);
		} else {
			$this->set('comment_number', 'comment_number-1', FALSE);
		}
		$data = array('ctime' => time());
		return $this->update($data);
	}

	public function get_notify($uid){
		$this->where(array('member_uid' => $uid));
		return $this->result_array();
	}

}
