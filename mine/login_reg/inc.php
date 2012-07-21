<?php
if (!isset ($_SESSION)) {
	session_start();
}
define('DB_HOST', '');   //根据自己的情况填写
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');
date_default_timezone_set('Asia/Shanghai');

//获取一个数据库连接
function getDBLink() {
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS);
	mysql_select_db(DB_NAME, $link);
	mysql_query("set names utf8");
	return $link;
}
?>
