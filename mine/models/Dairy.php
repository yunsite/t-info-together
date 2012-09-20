<?php

	/*
	*	Description:	日志处理模型
	*
	*
	*/
	
	class Dairy extends db_class{
	

			/*	()
			*	@Description:	添加日志

				@param
						$dry_uid	 用户id
						$dry_title	 日志title
						$dry_content 日志content
						$dry_ifcomm		是否允许评论	|	0(允许)
						$dry_private	日志隐私设置	|	0(所有人可见)

			*
			*
			*/
			private function add_dairy( $dry_uid, $dry_title, $dry_content, $dry_ifcomm = 0, $dry_private = 0 ){
			
				//日志发布时间
				$dry_pubtime = time();

				//添加日志时,最后修改时间跟发布时间是一样的
				$dry_lmoditime = $dry_pubtime;

				//构造 $coloumns	字段
				$coloumns = "dry_uid,dry_title,dry_content,dry_pubtime,dry_lmoditime,dry_ifcomm,dry_private";

				//构造 $values		值
				$values = "'".$dry_uid."','".$dry_title."','".$dry_content."','".$dry_pubtime."','".$dry_lmoditime."','".$dry_ifcomm."','".$dry_private."'";

				//增加日志
				parent::db_insert( 't_dairy', $coloumns, $values );



			}

			/*	()
			*	@Description:	删除日志

				@param
			*	@Param		$conditions		条件
			*
			*
			*/
			public function del_dairy( $conditions = '' ){
				
				//删除日志
				parent::db_delete( 't_dairy', $conditions = '' );

			}

			/*	()
			*	@Description:	修改日志(需要添加限制:禁止修改 日志id )

				@param
				@Param		$modify			修改的列值
			*	@Param		$conditions		依据的条件列值
			*
			*
			*/
			public function modi_dairy( $modify, $conditions ){
			
				//修改用户信息
				parent::db_update( 't_dairy', $modify, $conditions );

			}

			/*	()
			*	@Description:	查询日志

				@param

					$columns		操作的列
					$conditions		查询条件
			*
			*
			*/
			public function sele_dairy( $columns = '*', $conditions = '' ){
				
				/*
				echo $conditions;
				echo "<br/>";
				*/

				//查询用户信息
				$DairyInfo =  parent::db_select( 't_dairy', $columns, $conditions );
				
				return $DairyInfo;

			}


			/*	()
			*	@Description:	添加日志评论

				@param	
			*
			*
			*/
			private function add_comment(){
			
			}

			/*	()
			*	@Description:	删除评论

				@param	
			*
			*
			*/
			private function del_comment(){
			
			}

			/*	()
			*	@Description:	添加日志分类

				@param
						$dry_uid		分类用户id
						$dry_stitle		分类标题
						$dry_sifcomm	是否允许评论	|	0(允许)
						$dry_sprivate	日志隐私设置	|	0(所有人可见)

			*
			*
			*/
			private function add_sort( $dry_uid, $dry_stitle, $dry_sifcomm = 0, $dry_sprivate = 0 ){
			

				//构造 $coloumns	字段
				$coloumns = "dry_uid,dry_stitle,dry_sifcomm,dry_sprivate";

				//构造 $values		值
				$values = "'".$dry_uid."','".$dry_stitle."','".$dry_sifcomm."','".$dry_sprivate."'";

				//增加日志
				parent::db_insert( 't_dairysort', $coloumns, $values );



			}

			/*	()
			*	@Description:	删除日志分类

				@param
			*	@Param		$conditions		条件
			*
			*
			*/
			public function del_sort( $conditions = '' ){
				
				//删除日志
				parent::db_delete( 't_dairysort', $conditions = '' );

			}

			/*	()
			*	@Description:	修改日志分类

				@param
				@Param		$modify			修改的列值
			*	@Param		$conditions		依据的条件列值
			*
			*
			*/
			public function modi_sort( $modify, $conditions ){
			
				//修改用户信息
				parent::db_update( 't_dairysort', $modify, $conditions );

			}

			/*	()
			*	@Description:	查询日志分类

				@param

					$columns		操作的列
					$conditions		查询条件
			*
			*
			*/
			public function sele_sort( $columns = '*', $conditions = '' ){
				
				/*
				echo $conditions;
				echo "<br/>";
				*/

				//查询用户信息
				$SortInfo =  parent::db_select( 't_dairysort', $columns, $conditions );
				
				return $SortInfo;

			}

	}
?>