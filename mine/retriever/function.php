<?php
	
	/*
	*	Name:	通用函数库
	*
	*
	*
	*/

	/*
	*
	*	Description:	浮点表示的时间
	*
	*
	*/
	function microtime_float(){
		list($msec, $sec) = explode(" ", microtime());
		return ((float)$msec + (float)$sec);
	}


	/*
	*	Description:	将字符串中特定元素保存为数组(可用正则表达式实现)
	*	@Param
	*		1.$string	源字符串
	*		2.$start	开始字符(不包含)
	*		3.$end		结束字符(不包含)
	*	@return	符合条件的数组
	*/
	function strelem_to_array( $string, $start, $end ){
		
		//出现的次数
		$count = substr_count( $string, $start );

		//一次都没有出现
		if( $count === 0 ){
			return -1;
		}
		
		$offset = 0;
		for( $i = 0; $i<$count; $i++ ){
			
			//起始位置
			$startpos = strpos( $string, $start, $offset );
			$startlen = strlen( $start );
			$startpos = $startpos + $startlen;

			//结束位置
			$endpos = strpos( $string, $end, $offset );

			//目标字符串长度
			$length = $endpos - $startpos;
			

			$array[$i] = substr( $string, $startpos, $length );
			

			$endlen = strlen( $end );
			//设置偏移量
			$offset = $endpos + $endlen;

		}

		return $array;

	}
	

	/*
	*	Description:	保存文件(可返回当前所写文件的信息)
	*	@Param
	*		1.$filepath	保存路径
	*		2.$filename	文件名
	*		3.$content	保存内容
	*		4.$
	*	@return	-1(写入文件异常) / 1(正常写入文件)
	*/
	function save_file( $filepath = '', $filename, $content = '' ){
		
		//构造文件完整路径
		$fileinfo = $filepath.$filename;

		$handle = fopen( $fileinfo, "wb" );

		//写入异常
		if( fwrite( $handle,$content ) === FALSE ){
			return -1;
		}

		fclose( $handle );

		return 1;
	}

	/*
	*	Description:	按行读取文件
	*	@Param
	*		1.$filepath	保存路径
	*		2.$filename	文件名
	*		3.$seperate	分隔符
	*		4.$
	*	@return	由分隔符分隔开元素组成的数组
	*/
	function line_read_file( $filepath = '', $filename, $seperate ){
			
			$fileinfo = $filepath.$filename;

			$handle = fopen( $fileinfo, "r");
			
			while( !feof($handle) ){

				$line = fgets($handle);
				$info = explode(',',$line);
			}
			
			//文件中不存在指定信息
			if( !$info ){
				return -1;
			}

			return $info;
	}
?>