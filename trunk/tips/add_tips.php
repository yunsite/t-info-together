<?php
	
	/*
	*
	*	@Description:	向数据库中添加提示语
	*	@Author:	贾朝藤
	*
	*
	*/
	
	
	if( @$_POST['new_tip'] ){
		
		$new_tip = $_POST['new_tip'];

		//包含数据库操作类
		include("database.php");
		$db = new db_operation();
		$db -> db_use_db('tips','utf8');
		$db -> db_insert('tips','content',$new_tip);
		echo "添加成功!";
	}
	
	if( @$_GET['tip_id'] ){
		
		$tip_id = $_GET['tip_id'];

		//包含数据库操作类
		include("database.php");
		$db = new db_operation();
		$db -> db_use_db('tips','utf8');
		$db -> db_delete('tips','tip_id = '.$tip_id);
		echo "删除成功!";

	}

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
			border:1px solid black;
		}
		th{
			background:#3066a6;
			color:#FFFFFF;
		}
		tr{
			border:1px solid black;
			padding: 0; 
			background:#F7F7F7;
		}
		td{
			padding-top:5px;
			color:#660066;
			font-size:15px;
			border:1px solid black;
		}

	</style>
</head>

<form action="add_tips.php" method="post">
<table width="600px;">

	<tr>
		<th colspan="2">Tips</th>
	</tr>

	<tr>
		<td><input name="new_tip" type="text" style="width:370px;" /></td>
		<td><input type="submit" value="增加"/></td>
	</tr>
	<?php
		
		
		if( @!$db ){
			include("database.php");
			$db = new db_operation();
			$db -> db_use_db('tips','utf8');
		}

		$tips = $db -> db_select('tips');
		$tips_num = count( $tips ) - 1;
		//echo $tips_num;
		//echo $tips[3]['content'];
		for( $i = $tips_num - 1; $i >= 0; $i-- ){

			echo "<tr>
				<td>".$tips[$i]['content']."</td>
				<td><a href='add_tips.php?tip_id=".$tips[$i]['tip_id']."'>删除</a></td>
			</tr>";

		}
	?>

</table>
</form>

</html>