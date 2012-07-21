<?php

	/*
	*
	*	Description: 数据库操作类
	*	@Version:	复制自retrieve
	*	@Over:未完成，未测试
	*
	*/
	class db_operation{

			public $db_server;		//数据库服务器地址
			public $db_username;	//数据库用户名
			public $db_userpass;	//数据库用户密码
			public $link = '';		//当前数据库链接
			
			//初始化数据库配置参数
			public function __construct( $server = '127.0.0.1', $user = 'root', $pass = '' ){

				$this -> db_server = $server;
				$this -> db_username = $user;
				$this -> db_userpass = $pass;
				
				//连接数据库
				$this -> db_conn();

			}
			
			//连接数据库
			public function db_conn(){

				$this -> link = mysql_connect( $this->db_server, $this->db_username, $this->db_userpass);
				if( !$this->link ){
					$this -> link = '';
					die('Could not connect to Mysql: '.mysql_error());
				}
			
			}
			
			//关闭数据库连接
			public function db_close(){
				mysql_close( $this->link );
			}

			//使用数据库并设置查询字符集
			public function db_use_db( $db_name, $charset ){
				
				if( !mysql_query( 'USE '.$db_name ) ){
					die( "不能正确使用数据库".$db_name );
				}
				if( !mysql_query( "Set names '".$charset."'" ) ){
					die( "不能正确设置查询字符集".$charset );
				}

			}
			
			/*
			* Description: 插入记录
			* @Param $table 操作表
			* @Param $coloumns 字段
			* @Param $values 值
			*/
			public function db_insert( $table, $coloumns, $values ){
				
				if( $coloumns ){
					$sql = "INSERT INTO `".$table."` (`".$coloumns."`) VALUES ('".$values."')";
				}else{
					$sql = 'INSERT INTO '.$table.' VALUES ('.$values.')';
				}

				//echo $sql;
				//echo "<br/>";

				if( !mysql_query( $sql, $this -> link ) ){
					die('Insert Error :'.mysql_error());
				}

			}
			
			/*
			* Description: 删除记录
			* @Param $table 操作表
			* @Param $conditions  条件
			*/
			public function db_delete( $table,$conditions = '' ){
				
				if( $conditions != ''){
					$sql = 'DELETE FROM '.$table.' WHERE '.$conditions;
				}else{
					$sql = 	'DELETE FROM '.$table;
				}
				
				if( !mysql_query( $sql,$this->link ) ){
					die('Delete Error :'.mysql_error());
				}
			}
			
			/*
			* Description: 更新记录
			* @Param $table 操作表
			* @Param $modify 修改的列值
			* @Param $column_condi 条件列
			* @Param $value_condi 条件值
			*/
			/*
			public function db_update( $table,$modify,$column_condi,$value_condi, ){
				$sql = 'UPDATE '.$table.' SET '.$modify.' WHERE '.$column_condi.' = '.$value_condi;
				
				if( !mysql_query( $sql,$this->link ) ){
					die('Update Error :'.mysql_error());	
				}
			}
			*/
			
			/*
			* Description: 查询记录
			* @Param $table 操作表
			* @Param $columns 操作列
			* @Param $conditions 条件
			* @return $result 从结果集查询
			*/
			public function db_select( $table, $columns = '*', $conditions = '' ){
				
				if( $conditions ){
					$sql = 'SELECT '.$columns.' FROM '.$table.'WHERE '.$conditions ;
				}else{
					$sql = 'SELECT '.$columns.' FROM '.$table;	
				}
				
				//echo $sql;
				//echo "<br/>";
				//echo $this->link;
				
				if( !($handle = mysql_query( $sql,$this->link )) ){
					die("查询错误，错误信息：".mysql_error());
				}
				if( $handle = mysql_query( $sql,$this->link ) ){
					while($result[] = mysql_fetch_array( $handle )){
						
					};
				}

				return $result;
				//print_r($result);
			}

		}
?>