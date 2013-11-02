<?php

class MY_Model extends CI_Model {
	//this is the base class of the action with database
	var $db, $table;
	
	public function __construct() {
		parent::__construct();
	}
	
	//=======================================
	protected function result_array() {
		//function to return the result array
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	protected function insert($params) {
		return $this->db->insert($this->table, $params);
	}
	
	protected function update($params) {
		return $this->db->update($this->table, $params);
	}
	
	protected function delete($params = FALSE) {
		return $this->db->delete($this->table, $params);
	}
	
	protected function result_single($return_object = FALSE) {
		$query = $this->db->get($this->table);

		if ($return_object) {
			return $query->row();
		} else {
			return $query->row_array();
		}
	}
	
	protected function result_count() {
		return $this->db->count_all_results($this->table);
	}
	
}

























