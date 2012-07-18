<?php
	
	/*
	*	Name:	伪原创相关处理
	*
	*
	*
	*/

	/*
	*	Description:	关键词替换(词语替换法修改标题)(依赖于function.php文件里的函数)
	*	@Param
	*		1.$string	源字符串
	*		2.$
	*		3.$
	*	@return	替换后的字符串
	*/
	function keyword_replace( $string ){
		
		$keyword_info = line_read_file( '', 'replace_word.txt', ',' );
		$string = strtr( $string, $keyword_info[0], $keyword_info[1] );

		return $string;

	}
	
?>