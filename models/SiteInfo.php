<?php

	/*
	*	Description:	站点基本信息模型
	*
	*
	*/
	
	class SiteInfo extends db_class{
	

			/*	()
			*	@Description:	修改站点基本信息

				@param
			*
			*
			*/

			/*	()
			*	@Description:	查询站点基本信息

				@param
						$columns		操作的列
						$conditions		查询条件

				@return		$result		符合条件的结果集二维数组
			*
			*
			*/
			public function si_select( $columns = '*', $conditions = '' ){
			
				//echo "test0";

				//获取站点信息
				$SiteInfo =  parent::db_select( 't_siteinfo', $columns = '*', $conditions = '' );
				
				//echo "test";
				//print_r( $SiteInfo );

				return $SiteInfo;

			}

	}
?>