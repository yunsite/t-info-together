<?php
	/*
	*	@Description:	模拟QQ登陆
	*	@Reference:	
			http://jucelin.com/php-crul-for-qq-login.html
			http://qq.jucelin.com/
			http://jucelin.com/qqonline-update1.html
	*
	*
	*/

	
	//QQ号
	$qqno='';

	//QQ密码
	$qqpw='';

	//Cookie文件路径和文件名
	$cookie = dirname(__FILE__).'/cookie.txt';

	//POST传递信息数组
	$post = array(
		'login_url' => 'http://pt.3g.qq.com/s?aid=nLogin',
		'q_from' => '',
		'loginTitle' => 'login',
		'bid' => '0',
		'qq' => $qqno,
		'pwd' => $qqpw,
		'loginType' => '1',
		'loginsubmit' => 'login',
	);
	
	//初始化一个cURL会话
	$curl = curl_init('http://pt.3g.qq.com/handleLogin?aid=nLoginHandle&sid=ATAll43N7ZULRQ5V8zdfojol');

	//启用时会将头文件的信息作为数据流输出
	curl_setopt($curl, CURLOPT_HEADER, 0);

	//将curl_exec()获取的信息以文件流的形式返回，而不是直接输出
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	//连接结束后保存cookie信息的文件
	curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);

	//发送一个常规的POST请求
	curl_setopt($curl, CURLOPT_POST, 1);

	//全部数据使用HTTP协议中的"POST"操作来发送
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));

	//执行一个cURL会话
	$result = curl_exec($curl);

	//关闭一个cURL会话
	curl_close($curl);
	
	echo $result;

	//增加PHP获取当前URL,然后记录SID
?>