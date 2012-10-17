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
	//function get_

	/*
	*
	*	@Description:	写缓存函数(修改缓存信息,可以通过 1.写缓存函数直接写重名缓存替换掉原缓存 或 2.清除缓存等系统下一次执行的时候再生成缓存)
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

		//这里暂时只直接创建缓存文件
		$handle =  fopen( $ch_filename, 'w+' );

		//Json_encode缓存信息数组
		$ch_data = json_encode( $ch_data );

		//保存缓存数据
		//这里或者上面函数,可根据这几个函数的执行情况,返回状态码,来让控制器里的Action可以根据状态码做相应的处理
		fwrite( $handle, $ch_data );
		
		//关闭文件指针
		fclose( $handle );

	
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
	
		//打开缓存文件
		$handle =  fopen( $ch_filename, 'r' );

		//读取 $ch_filename 缓存文件中保存的Json格式的缓存信息

		$ch_data = fread( $handle, filesize($ch_filename) );
		
		//关闭文件指针
		fclose( $handle );


		//Json_decode缓存信息数组
		$ch_data = json_decode( $ch_data, true );

		//返回decode后的数据
		return $ch_data;
	
	}

	/*
	*
	*	@Description:	清除缓存函数(更新缓存即为:清除缓存,然后下次访问网站时,程序再生成缓存)
	*	@Param	None
	*	@Return
			string	$ch_filename	缓存名 | 
			string	$
	*
	*
	*/
	function clear_cache( $ch_filename = '' ){
	
		//删除缓存文件(如果指定缓存文件,则只删除指定缓存文件,否则删除 data/cache 下所有缓存文件)
		//(可扩展,以可以删除多个缓存文件)
		if( $ch_filename ){
		
			unlink( $ch_filename );
		
		}else{
		
			//循环删除 data/cache 文件夹下所有缓存文件
			//使用 "data/cache" 这样定义目录有些问题,仅在从index.php入口文件下访问执行才能成功
			$handle = opendir("data/cache");
			
			//遍历删除缓存目录下的文件(排除了.和..)
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					unlink( $file );
				}
			}
		
		}
	
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

	/*
	$string = "测试字符串";
	echo $string;
	echo "<br/>";

	$test = new encoding_transform( "UTF-8", "GB2312//IGNORE", $string );
	$target = $test->do_transform();
	echo $target;
	*/

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

		if( @$_SERVER["HTTP_CLIENT_IP"]){// check ip from share internet(手册上没有找到这个预定义服务器变量)

			$ip = $_SERVER["HTTP_CLIENT_IP"];

		}elseif( @$_SERVER["HTTP_X_FORWARDED_FOR"] ){// to check ip is pass from proxy(手册上没有找到这个预定义服务器变量)

			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];

		}else{
			
			//浏览当前页面的用户的IP地址
			$ip = $_SERVER["REMOTE_ADDR"];
		}
	 
		return $ip;
	 
	}

	/*
	*
	*	@Description:	浮点表示的时间
	*	@Param	None
	*	@Return
	*
	*
	*/
	function microtime_float(){
		list($msec, $sec) = explode(" ", microtime());
		return ((float)$msec + (float)$sec);
	}

	/*
	*
	*	@Description:	发送邮件函数

	*	@Param	$sendto_email	目的邮件地址
				$subject		邮件主题
				$body			邮件主体
				$user_name		目的用户名
	*	@Return
	*
	*
	*/

	function send_mail( $sendto_email, $subject, $body, $user_name ){
	
		global $smtp_host,$smtp_username,$smtp_pwd,$mail_from,$mail_from_name,$mail_charset,$mail_encoding;

		//包含发送邮件类(仅包含一次)
		require_once("includes/phpmailer/class.phpmailer.php");
		
		//实例化对象
		$mail = new PHPMailer();

		// send via SMTP
		//SMTP方式发送邮件
		$mail->IsSMTP();

		// SMTP servers
		//SMTP邮件服务器地址
		$mail->Host = $smtp_host;

		// turn on SMTP authentication
		//开启SMTP认证
		$mail->SMTPAuth = true;

		// SMTP username  注意：普通邮件认证不需要加 @域名
		//SMTP用户名
		$mail->Username = $smtp_username;

		// SMTP password
		//SMTP密码
		$mail->Password = $smtp_pwd;

		// 发件人邮箱
		$mail->From = $mail_from;
		// 发件人
		$mail->FromName =  $mail_from_name;
		// 这里指定字符集！
		$mail->CharSet = $mail_charset;
		$mail->Encoding = $mail_encoding;

		// 收件人邮箱和姓名
		$mail->AddAddress( $sendto_email, $user_name );
		$mail->AddReplyTo( $mail_from, $mail_from_name);

		//$mail->WordWrap = 50; // set word wrap 换行字数
		//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment 附件
		//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");

		// send as HTML
		$mail->IsHTML( true );

		// 邮件主题
		$mail->Subject = $subject;

		// 邮件内容
		$mail->Body = $body;

		//$mail->AltBody ="text/html"; 
		 if(!$mail->Send()){    
			
			echo "<h3>邮件发送有误!</h3>";
			echo "邮件错误信息: " . $mail->ErrorInfo;

			//可通过try...catch获取错误,进行友好处理
			exit;
		}else {
			echo "邮件发送成功!<br/>";
		}    
	
	}


	/*
	*
	*	@Description:	设置Cookie函数

	*	@Param	$name		Cookie的识别名称
				$value		Cookie的值
				$expire		Cookie的生存期限(天)
				$path		Cookie在服务器端的指定路径		|		"/"(可以修订,使之可以适应于虚拟空间等的情况下,同一目录下存在多个项目的情况)
	*	@Return
	*
	*
	*/
	function set_cookie( $name, $value, $expire, $path = "/" ){
	
		global $Cookie_pwd;

		//md5加密其值(串接密钥)
		//$value = md5( $value.$Cookie_pwd );

		//整合Cookie保存时间
		$expire = time() + $expire *60*60 *24;

		//设置Cookie
		setcookie( $name, $value, $expire, $path );
	
	}


	/*
	*
	*	@Description:	自动适应范围的页码分页函数

						参考链接:http://www.jz123.cn/text/2625788.html

						效果如下:
						<< < 1 2 3 4 5 6 7 > >>

						<< < 6 7 8 9 10 11 12 > >>


	*	@Param	$page		访问的页码
				$total		记录总数
				$phpfile	分页处理访问的文件名
				$pagesize	每页的最大记录数
				$pagelen	显示的页码数目
	*	@Return Array( pagecode, sqllimit )
	*
	*
	*/
	function paging( $page, $total, $phpfile, $pagesize, $pagelen ){

		$pagecode = '';						//定义变量,存放分页生成的HTML
		$page = intval($page);				//避免非数字页码
		$total = intval($total);			//保证总记录数值类型正确

		if( !$total )						//总记录数为零返回空数组
			return array();

		$pages = ceil( $total/$pagesize );	//计算总分页

		//处理页码合法性
		if( $page<1 )
			$page = 1;
		if( $page>$pages )
			$page = $pages;

		//计算查询偏移量
		$offset = $pagesize*( $page-1 );

		//页码范围计算
		$init = 1;											//起始页码数
		$max = $pages;										//结束页码数
		$pagelen = ( $pagelen%2 ) ? $pagelen:$pagelen+1;	//页码个数
		$pageoffset = ($pagelen-1)/2;						//页码个数左右偏移量

		//生成html
		$pagecode='<div class="page">';
		$pagecode.="<span>$page/$pages</span>";				//第几页,共几页

		//如果是第一页，则不显示第一页和上一页的连接
		if($page!=1){
			//$pagecode.="<a href="{$phpfile}?page=1"><<</a>";			//第一页
			$pagecode.="<a href='".$phpfile."?page=1'><<</a>";			//第一页
			//$pagecode.="<a href="{$phpfile}?page=".($page-1).""><</a>";	//上一页
			$pagecode.="<a href='".$phpfile."page=".($page-1)."'><</a>";	//上一页
		}

		if($pages>$pagelen){//分页数大于页码个数时可以偏移
		
			if($page<=$pageoffset){//如果当前页小于等于左偏移
				$init=1;
				$max = $pagelen;
			}else{//如果当前页大于左偏移
			
				if($page+$pageoffset>=$pages+1){//如果当前页码右偏移超出最大分页数
					$init = $pages-$pagelen+1;

				}else{//左右偏移都存在时的计算
				
					$init = $page-$pageoffset;
					$max = $page+$pageoffset;
				}

			}

		}

		//生成html
		for($i=$init;$i<=$max;$i++){

			if($i==$page){
				$pagecode.='<span>'.$i.'</span>';
			}else{
				//$pagecode.="<a href="{$phpfile}?page={$i}">$i</a>";
			}
		}
		
		if($page!=$pages){
			//$pagecode.="<a href="{$phpfile}?page=".($page+1)."">></a>";		//下一页
			$pagecode.="<a href='".$phpfile."?page=".($page+1)."'>></a>";		//下一页
			//$pagecode.="<a href="{$phpfile}?page={$pages}">>></a>";			//最后一页
			$pagecode.="<a href='".$phpfile."?page=".$pages."'>>></a>";			//最后一页
		}

		$pagecode.='</div>';
		return array('pagecode'=>$pagecode,'sqllimit'=>' limit '.$offset.','.$pagesize);
	}



?>