<?php

	/*
	*	Description:	用户基本处理模型
	*
	*
	*/
	
	class UserBase extends db_class{
	

			/*	()
			*	@Description:	增加用户

				@Param	$coloumns	字段		|	空
			*	@Param	$values		值
			*
			*
			*/
			public function add_user( $coloumns = '', $values ){
			
				//增加用户
				parent::db_insert( 't_member', $coloumns = '', $values );

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
				
				//查询用户信息
				$UserInfo =  parent::db_select( 't_member', $columns = '*', $conditions = '' );
				
				return $UserInfo;

			}

	}
?>