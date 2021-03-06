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
						$dry_sid	 日志分类id
						$dry_title	 日志title
						$dry_content 日志content
						$dry_ifcomm		是否允许评论	|	0(允许)
						$dry_private	日志隐私设置	|	0(所有人可见)

			*
			*
			*/
			public function add_dairy( $dry_uid, $dry_sid, $dry_title, $dry_content, $dry_ifcomm = 0, $dry_private = 0 ){
			
				//日志发布时间
				$dry_pubtime = time();

				//添加日志时,最后修改时间跟发布时间是一样的
				$dry_lmoditime = $dry_pubtime;

				//构造 $coloumns	字段
				$coloumns = "dry_uid,dry_sid,dry_title,dry_content,dry_pubtime,dry_lmoditime,dry_ifcomm,dry_private";

				//构造 $values		值
				$values = "'".$dry_uid."','".$dry_sid."','".$dry_title."','".$dry_content."','".$dry_pubtime."','".$dry_lmoditime."','".$dry_ifcomm."','".$dry_private."'";

				//增加日志
				$did = parent::db_insert( 't_dairy', $coloumns, $values );

				//返回新添加的日志id
				return $did;


			}

			/*	()
			*	@Description:	删除日志(需要增加:删除日志时,同时删除日志下的评论)

				@param
			*	@Param		$conditions		条件
			*
			*
			*/
			public function del_dairy( $conditions = '' ){
				
				//echo "conditions:".$conditions;

				//删除日志
				parent::db_delete( 't_dairy', $conditions );

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
						$drycm_dryid		评论的日志id
						$drycm_uid			评论用户id
						$drycm_content		评论内容
			*
			*
			*/
			public function add_comment( $drycm_dryid, $drycm_uid, $drycm_content  ){
			
				//评论发布时间
				$drycm_pubtime = time();

				//构造 $coloumns	字段
				$coloumns = "drycm_dryid,drycm_uid,drycm_content,drycm_pubtime";

				//构造 $values		值
				$values = "'".$drycm_dryid."','".$drycm_uid."','".$drycm_content."','".$drycm_pubtime."'";

				//增加日志
				$did = parent::db_insert( 't_drycomm', $coloumns, $values );

				//
				//return $did;

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
			*	@Description:	查询日志评论

				@param

					$columns		操作的列
					$conditions		查询条件
			*
			*
			*/
			public function sele_comment( $columns = '*', $conditions = '' ){
				
				/*
				echo $conditions;
				echo "<br/>";
				*/

				//查询评论信息
				$CommentInfo =  parent::db_select( 't_drycomm', $columns, $conditions );
				
				return $CommentInfo;

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
			public function add_sort( $dry_uid, $dry_stitle, $dry_sifcomm = 0, $dry_sprivate = 0 ){
			

				//构造 $coloumns	字段
				$coloumns = "dry_uid,dry_stitle,dry_sifcomm,dry_sprivate";

				//构造 $values		值
				$values = "'".$dry_uid."','".$dry_stitle."','".$dry_sifcomm."','".$dry_sprivate."'";

				//增加日志
				parent::db_insert( 't_dairysort', $coloumns, $values );



			}

			/*	()
			*	@Description:	删除日志分类(需要增加:删除日志分类时,同时删除分类下的日志)

				@param		$sid			删除的分类sid
			*	@Param		$
			*
			*
			*/
			public function del_sort( $sid ){
				
				//删除日志分类
				parent::db_delete( 't_dairysort', "dry_sid = ".$sid );

				//删除分类下日志
				//parent::db_delete( 't_dairy', "dry_sid = ".$sid );
				
				//删除分类下日志
				$this->del_dairy( "dry_sid = ".$sid );

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

			/*	()
			*	@Description:	增加日志配置记录

				@param
						$conf_dryuid			配置记录的uid
						$conf_dryname			博客名
						$conf_dryurl			博客个性url
						$conf_dryaboutme		“关于我”说明
						$conf_drypersonality	“个性签名”部分
						$conf_drymeta			博客keywords
						$conf_drydescription	博客description
						$conf_drybriefwords		文章列表每篇文章显示概览字数(检索文章列表时，简略内容限定字数+“查看全文”)
						$conf_drypagenum		每页显示的文章数

			*
			*
			*/
			public function add_dairy_config( $conf_dryuid, $conf_dryname, $conf_dryurl, $conf_dryaboutme, $conf_drypersonality, $conf_drymeta, $conf_drydescription, $conf_drybriefwords, $conf_drypagenum ){
			

				//构造 $coloumns	字段
				$coloumns = "conf_dryuid,conf_dryname,conf_dryurl,conf_dryaboutme,conf_drypersonality,conf_drymeta,conf_drydescription,conf_drybriefwords,conf_drypagenum";

				//构造 $values		值
				$values = "'".$conf_dryuid."','".$conf_dryname."','".$conf_dryurl."','".$conf_dryaboutme."'"."','".$conf_drypersonality."'"."','".$conf_drymeta."'"."','".$conf_drydescription."'"."','".$conf_drybriefwords."'"."','".$conf_drypagenum."'";

				//增加日志
				parent::db_insert( 't_dryconfig', $coloumns, $values );


			}

			/*	()
			*	@Description:	删除日志配置记录

				@param		$uid			记录所属用户id
			*	@Param		$
			*
			*
			*/
			public function del_dairy_config( $uid ){
				
				//删除日志分类
				parent::db_delete( 't_dryconfig', "conf_dryuid = ".$uid );

			}

			/*	()
			*	@Description:	修改日志配置记录

				@param
				@Param		$modify			修改的列值
			*	@Param		$conditions		依据的条件列值
			*
			*
			*/
			public function modi_dairy_config( $modify, $conditions ){
			
				//修改用户信息
				parent::db_update( 't_dryconfig', $modify, $conditions );

			}

			/*	()
			*	@Description:	查询日志配置记录

				@param

					$columns		操作的列
					$conditions		查询条件
			*
			*
			*/
			public function sele_dairy_config( $columns = '*', $conditions = '' ){
				
				/*
				echo $conditions;
				echo "<br/>";
				*/

				//查询用户信息
				$ConfInfo =  parent::db_select( 't_dryconfig', $columns, $conditions );
				
				return $ConfInfo;

			}

	}
?>