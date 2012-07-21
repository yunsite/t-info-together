<?php
	
	/*
	*
	*	@Description:	每次刷新网页都给出一句提示语
	*	@Author:	贾朝藤
	*
	*
	*/
	
		include("database.php");
		$db = new db_operation();
		$db -> db_use_db('tips','utf8');

		$tips = $db -> db_select('tips');
		$tips_num = count( $tips ) - 1;
		
		//产生随机数
		$rand_num = rand(0,$tips_num-1);
		
		//调用新浪API,获取所在地信息
		include("../Get_ip_area/GetIpArea_sina.php");

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Tips-everyaccess</title>

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

<div class="area">
<?php
	$info_decode = GetArea();
	echo "您在 <font color='green'>".$info_decode['country'].$info_decode['province']."省".$info_decode['city']."市 ".$info_decode['isp']."网络</font>";
?>
</div>

<table width="500px;">
	<tr>
		<th>Tips</th>
	</tr>
	<tr>
		<td><?php echo $tips[$rand_num]['content']; ?></td>
	</tr>
</table>
</html>