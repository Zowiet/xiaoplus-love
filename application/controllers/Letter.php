<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class letter extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->view();
	}

	// 缺少用户模块
	// 告白
	public function publish(){
		$this->load->model("Letter_Model");
		$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : 0;
		$to_weibo_name = isset($_POST['to_weibo_name']) ? $_POST['to_weibo_name'] : 0;
		// loveletter内容
		$data = array(
			"to_weibo_id" => $_POST['to_weibo_id'],
			"to_weibo_name" => $to_weibo_name,
			"from_uid" => $uid,
			"content" => $_POST['content'],
			"ctime" => time(),
			"publish" => $_POST['publish']);
		var_dump($data);
		$result = $this->Letter_Model->insert_loveletter($data);
		if($result){
			$this->load->model("Notify_Model");
			/*$this->load->model("User_Model");
			$userData = $this->User_Model->get_user_by_weibo_id($_POST['to_weibo_id']); // 查询是否存在此用户
			if(count($userData)){
				$this->Notify_Model->add_notify($loveletter_id, $userData['id']);
				$this->Notify_Model->update_notify($loveletter_id, $userData['id'], True);
			}*/
			$this->Notify_Model->add_notify($result['affected_row'], $uid);
		}



		var_dump($result);
	}

	public function view(){
		$data['letters'] = $this->get_loveletters_by_praise();
		$this->load->view("./letter/index", $data);
	}

	public function delete_loveletter_by_id(){
		$this->load->model("Letter_Model");
		$loveletter_id = isset($_POST['loveletter_id']) ? $_POST['loveletter_id'] : 0;
		$result = $this->Letter_Model->delete_loveletter_by_id($loveletter_id);
		// var_dump($result);
		return $result;
	}


	public function get_loveletter_by_weiboName(){
		$this->load->model("Letter_Model");
		$weiboName = isset($_POST['weibo_name']) ? $_POST['weibo_name'] : "";
		$result = $this->Letter_Model->get_loveletter_by_weibo_name($weibo_name);
		// var_dump($result);
		return $result;
	}

	public function get_loveletter_by_id(){
		$this->load->model("Letter_Model");
		$loveletter_id = isset($_POST['loveletter_id']) ? $_POST['loveletter_id'] : 0;
		$result = $this->Letter_Model->get_loveletter_by_id($loveletter_id);
		// var_dump($result);
		return $result;
	}

	public function get_loveletters_by_praise(){
		$this->load->model("Letter_Model");
		$result = $this->Letter_Model->get_loveletters_by_praise(10);
		// var_dump($result);
		return $result;
	}

	public function get_loveletters_by_newtime(){
		$this->load->model("Letter_Model");
		$result = $this->Letter_Model->get_loveletters_by_newtime(10);
		// var_dump($result);
		return $result;
	}

	// 评论
	public function comment_count(){
		$this->load->model("Comment_Model");
		$loveletter_id = isset($_POST['loveletter_id']) ? $_POST['loveletter_id'] : 0;
		$result = $this->Comment_Model->get_comment_count($loveletter_id);
		// echo $result;
		return $result;
	}

	public function comment_submit(){
		$this->load->model("Comment_Model");
		$data = array(
			'from_uid' => $_POST['from_uid'], //session
			'to_uid' => $_POST['to_uid'],
			'loveletter_id' => $_POST['loveletter_id'],
			'comments' => $_POST['comments'],
			'ctime' => time());
		var_dump($data);
		$result = $this->Comment_Model->insert_comment($data);
		if($result){
			$this->load->model("Notify_Model");
			$this->Notify_Model->update_notify($_POST['loveletter_id'], $_POST['to_uid']);
		}
		// echo $result;
		return $result;
	}

	public function comment_get(){
		$this->load->model("Comment_Model");
		$loveletter_id = isset($_POST['loveletter_id']) ? $_POST['loveletter_id'] : 0;
		$result = $this->Comment_Model->get_comment($loveletter_id);
		// var_dump($result);
		return $result;
	}

	public function comment_delete(){
		$this->load->model("Comment_Model");
		$comment_id = isset($_POST['comment_id']) ? $_POST['comment_id'] : 0;
		$result = $this->Comment_Model->delete_comment($comment_id);
		// echo $result;
		return $result;
	}

}
