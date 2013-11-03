<?php

class Weibo_Model extends MY_Model {
	public function __construct() {
		parent::__construct();
	}


	//发布微博
	public function pubWeibo($status, $url) {
        
        //没有配图
        if ($url == "") {
        	$TARGET_URL = "https://api.weibo.com/2/statuses/update.json";
            $data = "status=".encodeURL($status)."&source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE";
            
        } else {							//有配图
        	$TARGET_URL = 'https://api.weibo.com/2/statuses/upload_url_text.json';
            $data = "status=".encodeURL($status)."&url=".encodeURL($url)."&source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE";
        }
        
        //发送post请求
        $curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器
		curl_setopt($curl, CURLOPT_POST, 1); 														// 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 												// Post提交的数据包
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 												// 获取的信息以文件流的形式返回
		$returnInfo = curl_exec($curl); 																// 执行操作
		
		if (curl_errno($curl)) {
			echo curl_error($curl);
		} 
        
		curl_close($curl);
    }

	//根据用户给的网址提取出微博mid
	public function getWeiboMidFromUrl($url) {
		$arrayUrl = explode("?", $url);
		$arrayMid = explode("/", $arrayUrl[0]);
		return $arrayMid[count($arrayMid) - 1];
	}

	//获取根据mid值获取该条微博id
	public function getWeiboIdFromMid($mid) {
		$TARGET_URL = "https://api.weibo.com/2/statuses/queryid.json?isBase62=1&type=1&source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&mid=".$mid;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);

		return $data['id'];
	}

	//根据微博id获取评论列表
	public function getCommentListFromWeiboId($weiboId) {
		$TARGET_URL = "https://api.weibo.com/2/comments/show.json?source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&id=".$weiboId;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);
		return $data;
	}

	

	//根据用户的Uid获得粉丝的Uid了列表
	public function getFollowersUidByUid($uid) {
		$data = "source=3167760632&access_token=2.00KxwAmCNIuySE01085cf0680T9vNp&uid=".$uid;
		$TARGET_URL = "https://api.weibo.com/2/friendships/followers/ids.json?".$data;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);

		return $data;
	}

	//根据用户的Uid获得关注的人的Uid列表
	public function getFriendsUidByUid($uid) {
		$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&uid=".$uid;
		$TARGET_URL = "https://api.weibo.com/2/friendships/friends/ids.json?".$data;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);

		return $data;
	}

	//获取双向的关注的用户ID列表
	//param $uid 当前用户id  $count 单页返回的条数
	public function getBilateralFriendsUidFromUid($uid, $count = 50) {
		$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&uid=".$uid."&count=".$count;
		$TARGET_URL = "https://api.weibo.com/2/friendships/friends/bilateral/ids.json?".$data;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);

		return $data;
	}











	/*================================评论普通写入接口===========================================
		createCommentByWeiboId
		deleteCommentByComentId
		deleteCommentsByComentsId
		replyCommentByCommentId
	*/
	//根据微博id对一条微博进行评论
	public function createCommentByWeiboId($weiboId, $comment, $comment_ori = 1) {
		$TARGET_URL = "https://api.weibo.com/2/comments/create.json";
	 	$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&id=".$weiboId.
	 			"&comment=".urlencode($comment)."&comment_ori=".$comment_ori;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_POST, 1); 														// 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 												// Post提交的数据包
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);
		return $data;
	}

	//根据微博id对一条微博进行评论
	//param   $cid   评论id
	public function deleteCommentByComentId($cid) {
		$TARGET_URL = "https://api.weibo.com/2/comments/destroy.json";
	 	https://api.weibo.com/2/comments/destroy.json
	 	$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&cid=$cid";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_POST, 1); 														// 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 												// Post提交的数据包
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);
		return $data;
	}

	//根据评论id批量删除
	//param   $cid   评论id
	public function deleteCommentsByComentsId($cidArray) {
		$cidString = join(",", $cidArray);
		$TARGET_URL = "https://api.weibo.com/2/comments/destroy.json";
	 	$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&cids=$cidString";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_POST, 1); 														// 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 												// Post提交的数据包
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);
		return $data;
	}

	//根据评论id, 微博id回复该评论
	//param   $cid   评论id
	public function replyCommentByCommentId($weiboId, $cid, $comment, $without_mention = 0, $comment_ori = 0) {
		$TARGET_URL = "https://api.weibo.com/2/comments/reply.json";
	 	$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&id=$weiboId&comment=".urlencode($comment)."&cid=$cid&comment_ori=$comment_ori";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_POST, 1); 														// 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 												// Post提交的数据包
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);
		return $data;
	}




















	/*============================用户普通读取接口=======================================================
		
		getUserInfoByUid
		getUserInfoByDomainshow
		getUserCounts
		getUserRank
	*/
	//根据用户的Uid获取用户的信息
	public function getUserInfoByUid($uid) {
		$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&uid=".$uid;
		$TARGET_URL = "https://api.weibo.com/2/users/show.json?".$data;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);

		return $data;
	}

	//根据用户的昵称获取用户的信息
	public function getUserInfoByNickName($name) {
		$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&screen_name=".$name;
		$TARGET_URL = "https://api.weibo.com/2/users/show.json?".$data;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);

		return $data;
	}

	//通过个性化域名获取用户资料以及用户最新的一条微博
	public function getUserInfoByDomainshow($string) {
		$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&domain=".$string;
		$TARGET_URL = "https://api.weibo.com/2/users/domain_show.json?".$data;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);

		return $data;
	}

	//批量获取用户的粉丝数、关注数、微博数
	public function getUserCounts($userArray) {
		$userString = join(",", $userArray);
		$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&uids=".$userString;
		$TARGET_URL = "https://api.weibo.com/2/users/counts.json?".$data;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);

		return $data;
	}

	//获取用户等级信息  此API不存在了！！！！！！！！！！！！！！！！！！！！！
	public function getUserRank($uid) {
		$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&uid=".$uid;
		$TARGET_URL = "https://api.weibo.com/2/users/show_rank.json?".$data;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);

		return $data;
	}

















	/*======================================关系普通写入接口============================================
			
	
	
	*/

	//根据昵称关注用户
	public function createFriendshipByName($name) {
		$TARGET_URL = "https://api.weibo.com/2/friendships/create.json";
	 	$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&screen_name=$name";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_POST, 1); 														// 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 												// Post提交的数据包
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);
		return $data;
	}

	//根据用户uid关注用户
	public function createFriendshipByUid($uid) {
		$TARGET_URL = "https://api.weibo.com/2/friendships/create.json";
	 	$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&uid=$uid";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_POST, 1); 														// 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 												// Post提交的数据包
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);
		return $data;
	}

	//根据昵称取消关注用户
	public function destroyFriendshipByName($name) {
		$TARGET_URL = "https://api.weibo.com/2/friendships/destroy.json";
	 	$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&screen_name=$name";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_POST, 1); 														// 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 												// Post提交的数据包
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);
		return $data;
	}

	//根据用户uid取消关注用户
	public function destroyFriendshipByUid($uid) {
		$TARGET_URL = "https://api.weibo.com/2/friendships/destroy.json";
	 	$data = "source=817668502&access_token=2.00KxwAmC0evq1t4ee0f45d8bcCQQTE&uid=$uid";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $TARGET_URL);
		curl_setopt($curl, CURLOPT_POST, 1); 														// 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 												// Post提交的数据包
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 						// 模拟用户使用的浏览器									
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); 													// 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$data = json_decode(curl_exec($curl), true);
		curl_close($curl);
		return $data;
	}



}

