<?php

	/*
	*	Description:	用户基本处理模型
		//模型针对参数和处理还需要做许多修订
	*
	*
	*/
	
	class UserBase extends db_class{
	

			/*	()
			*	@Description:	增加用户
				//仅要这几个参数,是因为:
				//	①前台注册表单在注册时不需要填写太多项数据,其他数据可以在用户更新个人信息时调用modi_user()方法增加
					②管理员在后台添加用户也可以不填太多用户信息,想更新用户资料时可以调用modi_user()方法

				@Param
						$mem_name	用户名
						$mem_pwd	用户密码
						$mem_email	用户Email(在SQL里允许为空,但因为需要邮箱验证,所以这里不允许为空,需要修改SQL字段使之不为空)
						$mem_group	用户所属组	|	0

			*
			*
			*
			*/
			public function add_user( $mem_name, $mem_pwd, $mem_email, $mem_group = 0 ){
			
				//获取当前时间戳作为 用户注册时间
				$mem_regtime = time();

				//刚注册时,最后登陆时间为注册时间
				$mem_llogtime = $mem_regtime;

				//最后一次登陆IP,因为是注册,所以取当前IP
				$llogip = getIp();

				//构造 $coloumns	字段
				$coloumns = "mem_name,mem_pwd,mem_email,mem_group,mem_regtime,mem_llogtime,mem_llogip";

				//构造 $values		值
				$values = "'".$mem_name."','".$mem_pwd."','".$mem_email."','".$mem_group."','".$mem_regtime."','".$mem_llogtime."','".$llogip."'";

				//增加用户
				parent::db_insert( 't_member', $coloumns, $values );

			}

			/*	()
			*	@Description:	删除用户

				@param
			*	@Param		$conditions		条件
			*
			*
			*/
			public function del_user( $conditions = '' ){
				
				//删除用户
				parent::db_delete( 't_member', $conditions = '' );

			}


			/*	()
			*	@Description:	修改用户基本信息

				@param
				@Param		$modify			修改的列值
			*	@Param		$conditions		依据的条件列值
			*
			*
			*/
			public function modi_user( $modify, $conditions ){
			
				//修改用户信息
				parent::db_update( 't_member', $modify, $conditions );

			}

			/*	()
			*	@Description:	查询用户基本信息

				@param

					$columns		操作的列
					$conditions		查询条件
			*
			*
			*/
			public function seli_user( $columns = '*', $conditions = '' ){
				
				/*
				echo $conditions;
				echo "<br/>";
				*/

				//查询用户信息
				$UserInfo =  parent::db_select( 't_member', $columns, $conditions );
				
				return $UserInfo;

			}

	}
?>