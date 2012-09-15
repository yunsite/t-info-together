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
			*
			*
			*/
			private function del_dairy(){
			
			}

			/*	()
			*	@Description:	修改日志

				@param
			*
			*
			*/
			private function modi_dairy(){
			
			}

			/*	()
			*	@Description:	查询日志

				@param	
			*
			*
			*/
			private function sele_dairy(){
			
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
			*
			*
			*/
			private function add_sort(){
			
			}

			/*	()
			*	@Description:	删除日志分类

				@param	
			*
			*
			*/
			private function del_sort(){
			
			}

			/*	()
			*	@Description:	修改日志分类

				@param	
			*
			*
			*/
			private function modi_sort(){
			
			}

	}
?>