<?php

	/*
	*
	*	@Description:	xx在xx做xx(例如:张三在学校看书)
	*	@Author:	localtest
	*
	*/

	//$where_rand_num = rand( 0, 65535 );
	
	//$what_rand_num = rand( 0, 65535 );

	//包含数据库操作类
	include("database.php");
	$db = new db_operation();
	$db -> db_use_db('rand_app_tx','utf8');
	
	//随机显示的 内容数组
	$what_content = $db -> db_select('rand_what');

	//随机显示的 出现地点数组
	$where_content = $db -> db_select('rand_where');

	array_pop( $what_content );
	array_pop( $where_content );
	
	//元素个数
	$what_count = count( $what_content );
	//元素个数
	$where_count = count( $where_content );
	
	//内容 随机数
	$rand_what_num = rand( 0, $what_count - 1);
	//地点 随机数
	$rand_where_num = rand( 0, $where_count - 1 );

	//print_r( $rand_what_num );
	//echo "<br/>";
	//print_r( $rand_where_num );

	//随机 内容元素
	$what_content = $what_content[$rand_what_num]['wcontent'];

	//随机 出现地点元素
	$where_content = $where_content[$rand_where_num]['rcontent'];

	//print_r( $what_count );
	//print_r( $where_count );

	//print_r( $what_content );
	//echo "<br/>";
	//print_r( $where_content );
	//echo "<br/>";
	
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>xx在xx做xx</title>

	<style type="text/css">
		
		*{
			font-family: Tahoma, "Microsoft Yahei", Arial;
		}

		table{
			clear:both;
			margin: 0 auto;
			text-align:center;
		}
		th{
			background:#3066a6;
			color:#FFFFFF;
		}
		td{
			padding-top:5px;
			color:#660066;
			font-size:16px;
		}

	</style>
</head>

<table width="500px;">
	<tr>
		<th>xx在xx做xx</th>
	</tr>
	<tr>
		<td><?php echo "张三在:".$where_content.$what_content; ?></td>
	</tr>
</table>
</html>