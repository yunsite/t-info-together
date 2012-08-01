<?php
	/*
	*	Description:	函数文件，包含常用到的函数
	*
	*
	*/

	/*
	*	Description:	获取当前文件路径
	*
	*/
	function get_

	/*
	*
	*	@Description:	写缓存函数
	*	@Param	None
	*	@Return
			string	$
			string	$
	*
	*
	*/

	/*
	*
	*	@Description:	清除缓存函数(更新缓存即为:清除缓存,然后下次访问网站时,程序再生成缓存)
	*	@Param	None
	*	@Return
			string	$
			string	$
	*
	*
	*/

	/*	()
	*	@Description:	编码转换

		@param	none
	*
	*
	*/
	/*
	*
	*	@Description:	不同编码字符转换 类
	*	@Author：	localtest(枕头)
	*	@Reference：	http://www.oschina.net/code/snippet_223451_8286
	*	@More:	未考虑太多目标字符串的模式,如//IGNORE
	*	@Test:	已测试功能，细节未测试
	*
	*/
	

	class encoding_transform{
		
		public $encode_from;		//原编码
		public $encode_to;			//目标编码
		public $src_str;			//原字符串
		public $target_str;			//目标字符串

		function __construct( $from, $to, $string ){
			
			$this->encode_from = $from;
			$this->encode_to = $to;
			$this->src_str = $string;

		}

	/*
	*
	*	@Description:	UTF-8编码字符  To GB2312编码字符
	*	@Param	None
	*	@Return
			string	$target_val		成功转换后的字符串
			string	$this->src_str	原字符串
	*
	*
	*/
	function do_transform(){

		$this->target_val   =   @iconv( $this->encode_from, $this->encode_to, $this->src_str );

		$comp_val   =   @iconv( $this->encode_to, $this->encode_from, $this->target_val);
		
		//如果两次转换 字符串仍为原值的话，则返回转换后的字符串，否则返回原字符串
		if( strlen($this->src_str) == strlen($comp_val) ){
			return   $this->target_val;
		}else{
			return   $this->src_str;
		}

	}


	}

	$string = "测试字符串";
	echo $string;
	echo "<br/>";

	$test = new encoding_transform( "UTF-8", "GB2312//IGNORE", $string );
	$target = $test->do_transform();
	echo $target;
?>