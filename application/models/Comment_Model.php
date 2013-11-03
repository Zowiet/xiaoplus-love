<?php

class Comment_Model extends MY_Model {
	public function __construct() {
		parent::__construct();
		$this->table = 'm_comments';   #loveletter表，看看是不是这个名字
		$this->db = $this->load->database('default', TRUE);
	}
	
	//========================================
	//follow function interact with database
	public function get_comment_by_id(){

	}

	public function insert_comment($data){
		return $this->insert($data);
	}

	public function get_comment($loveletter_id){
		$data = array('loveletter_id' => $loveletter_id);
		$this->where($data);
		$this->order_by('ctime', 'desc');
		return $this->result_array();
	}

	public function delete_comment($comment_id){
		$data = array('id' => $comment_id);
		return $this->delete($data);
	}

	public function get_comment_count($loveletter_id){
		$data = array('loveletter_id' => $loveletter_id);
		$this->where($data);
		return count($this->result_array());
	}

}
