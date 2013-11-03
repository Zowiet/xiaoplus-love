<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class weibo extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function test(){
		echo "<meta charset='UTF-8'>";
		$this->load->model("Weibo_Model");
		$weibo_detail = $this->Weibo_Model->getUserInfoByNickName("右键已坏");
		$weibo_id = $weibo_detail['id'];
		echo $weibo_id;
		$fans = $this->Weibo_Model->getFriendsUidByUid($weibo_id);
		var_dump($fans);

	}

}