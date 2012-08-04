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
			string	$ch_filename	缓存名
			string	$ch_data		缓存数据
	*
	*
	*/
	function write_cache( $ch_filename, $ch_data ){
	
		
		//检测缓存目录下,是否已有该缓存文件
		//如果有的话,则直接更新里边的数据,没有的话,则创建文件并创建信息

		//Json_encode缓存信息数组
		$ch_data = json_encode( $ch_data );

	
	}

	/*
	*
	*	@Description:	读缓存函数
	*	@Param	None
	*	@Return
			string	$ch_filename	缓存名
			string	$
	*
	*
	*/
	function read_cache( $ch_filename ){
	
		//读取 $ch_filename 缓存文件中保存的Json格式的缓存信息

		$ch_data = 

		//Json_decode缓存信息数组
		$ch_data = json_decode( $ch_data );

		//返回decode后的数据
		return $ch_data;
	
	}

	/*
	*
	*	@Description:	清除缓存函数(更新缓存即为:清除缓存,然后下次访问网站时,程序再生成缓存)
	*	@Param	None
	*	@Return
			string	$ch_filename	缓存名
			string	$
	*
	*
	*/
	function clear_cache( $ch_filename ){
	
		//删除缓存文件
	
	}



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

	/*
	*
	*    @Author:        Pcyoyo
	*    @Site:          http://pcyoyo.com
	*    @description    获取访客ip
	*    @Param          none
	*
	*    @return         string $ip
	*
	*/
	function getIp(){
		if( $_SERVER["HTTP_CLIENT_IP"]){// check ip from share internet(手册上没有找到这个预定义服务器变量)

			$ip = $_SERVER["HTTP_CLIENT_IP"];

		}elseif( $_SERVER["HTTP_X_FORWARDED_FOR"] ){// to check ip is pass from proxy(手册上没有找到这个预定义服务器变量)

			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];

		}else{
			
			//浏览当前页面的用户的IP地址
			$ip = $_SERVER["REMOTE_ADDR"];
		}
	 
		return $ip;
	 
	}

?>