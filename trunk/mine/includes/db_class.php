<?php

	/*
	*	Description:	数据库基础类(可在此类,或子类(model类)中增加错误状态码,针对错误做合理处理,使错误可控)
	*
	*
	*/
	class db_class{
			
			private $db_server;			//数据库服务器地址
			private $db_name;			//数据库名
			private $db_username;		//数据库用户名
			private $db_userpass;		//数据库用户密码
			private $dblink = '';		//数据库连接
			
			/*	()
			*	@Description:	初始化数据库->服务器地址,数据库名,用户名,密码	连接数据库

				@param	$server		数据库服务器地址	|
						$db_name	数据库名			|
						$user		数据库用户名		|
						$pass		数据库用户密码		|
						$charset	数据库默认编码		|
			*
			*
			*/
			public function __construct( $db_server, $db_name, $db_username, $db_userpass, $charset ){

				$this -> db_name = $db_name;
				$this -> db_server = $db_server;
				$this -> db_username = $db_username;
				$this -> db_userpass = $db_userpass;
				
				//连接数据库
				$this->db_conn( $db_server, $db_name, $db_username, $db_userpass, $charset );
			}
			
			/*	()
			*	@Description:	连接,使用数据库,设置默认编码

				@param	$server		数据库服务器地址	|
						$db_name	数据库名			|
						$user		数据库用户名		|
						$pass		数据库用户密码		|
						$charset	数据库默认编码		|
			*
			*
			*/
			private function db_conn( $db_server, $db_name, $db_username, $db_userpass, $charset ){
				
				//打开一个到 MySQL 服务器的连接
				$this -> dblink = mysql_connect( $db_server, $db_username, $db_userpass );
				if(!$this->dblink){
					$this -> dblink = '';
					die('Error:不能连接到Mysql: '.mysql_error());
				}
				//使用数据库
				if( !(mysql_query( 'USE '.$db_name )) ){
					die("Error:不能正确使用数据库,错误信息：".mysql_error());
				}
				//设置编码
				if( !(mysql_query( 'SET NAMES "'.$charset.'"' )) ){
					die("Error:不能正确设置 ".$charset." 编码".mysql_error() );
				}
			}
			
			/*	()
			*	@Description:	关闭数据库连接

				@param	none
			*
			*
			*/
			public function db_close(){
				mysql_close( $this->link );
			}
			
			/*()
			*	Description: 插入记录

			*	@Param	$table		操作表 
			*	@Param	$coloumns	字段		|	空
			*	@Param	$values		值
			*/
			

			public function db_insert( $table, $coloumns = '', $values ){
				
				if( $coloumns ){

					$sql = 'INSERT INTO '.$table.' ('.$coloumns.') VALUES ('.$values.')';

				}else{

					$sql = 'INSERT INTO '.$table.' VALUES ('.$values.')';

				}
				
				if( !mysql_query( $sql, $this -> dblink ) ){

					die('Insert Error :'.mysql_error());

				}

				//取得上一步 INSERT 操作产生的 ID(需要考虑:查询语句之间被重置的情况)
				return mysql_insert_id();
			}

			
			
			/*()
			*	Description: 删除记录

			*	@Param		$table			操作表
			*	@Param		$conditions		条件
			*/
			public function db_delete( $table, $conditions = '' ){
				
				if( $conditions != '' ){

					$sql = 'DELETE FROM '.$table.' WHERE '.$conditions;

				}else{

					$sql = 	'DELETE FROM '.$table;

				}

				//echo $sql;
				//echo "<br/>";
				
				if( !mysql_query( $sql, $this->dblink ) ){

					die( 'Delete Error :'.mysql_error() );

				}
			}
			
			/*()
			*	Description: 更新记录
			*	@Param		$table			操作表
			*	@Param		$modify			修改的列值
			*	@Param		$conditions		依据的条件列值
			*/
			public function db_update( $table, $modify, $conditions ){

				$sql = 'UPDATE '.$table.' SET '.$modify.' WHERE '.$conditions;
				
				if( !mysql_query( $sql,$this->link ) ){
					die('Update Error :'.mysql_error());
				}

			}
			
			/*	()
			*	@Description:	查询记录

				@param	$table			操作的表
						$columns		操作的列
						$conditions		查询条件

				@return		$result		符合条件的结果集二维数组
			*
			*
			*/
			public function db_select( $table, $columns = '*', $conditions = '' ){
				
				//为以后测试需要,暂时保留测试代码
				/*
				echo $table;
				echo "<br/>";
				echo $columns;
				echo "<br/>";
				echo $conditions;
				echo "<br/>";
				*/

				if( $conditions ){

					$sql = 'SELECT '.$columns.' FROM '.$table.' WHERE '.$conditions;

				}else{

					$sql = 'SELECT '.$columns.' FROM '.$table;

				}
				
				/*
				echo $sql;
				echo "<br/>";
				*/

				//为以后测试需要,暂时保留测试代码
				//echo $sql;

				if( !($handle = mysql_query( $sql, $this->dblink )) ){

					die( "SELECT Error :".mysql_error() );

				}

				while( $result[] = mysql_fetch_array( $handle, MYSQL_ASSOC ) ){};
				
				//弹出返回信息数组的最后一个空单元
				array_pop( $result );

				return $result;
			}

			/*	()
			*	@Description:	多表联合查询记录(这里主要考虑两个表联结,条件为字段等值的情况)

				@param	$$selicolumns	要查询的列(以半角逗号分隔的多个列,如"did,sid,title...",可AS改名,如"did AS id,sid,...")
						$table1			要联结的表名
						$table2			要联结的表名
						$conditions		等值条件
						//$equlcolumns	查询的等值列(如sid,在函数体中将把列构造为$table1.".".$columarray[0]."=".$table2.".".$columarray[1])
													($equlcolumns可为半角逗号分隔的,多个等值数组,函数体将把它们explode为数组元素而组合成多个AND等值的WHERE条件)
													($equlcolumns还可以为带运算符的值,如">id",这个还暂未考虑)

				@return		$result		
			*
			*
			*/
			public function db_multi_select( $selicolumns, $table1, $table2, $conditions ){
			
				//$eqularray = explode( ",", $equlcolumns );

				$sql = "SELECT ".$selicolumns." FROM ".$table1.",".$table2." WHERE ".$conditions;

				if( !($handle = mysql_query( $sql, $this->dblink )) ){

					die( "SELECT Error :".mysql_error() );

				}

				while( $result[] = mysql_fetch_array( $handle, MYSQL_ASSOC ) ){};
				
				//弹出返回信息数组的最后一个空单元
				array_pop( $result );

				return $result;

			}
		}
?>