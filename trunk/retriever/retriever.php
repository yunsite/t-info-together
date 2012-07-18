<?php
/*
	Name:	哟哟通用检索程序
	百度知道爬虫(1.其实不算爬虫，算是自动检索吧 2.可扩展为通用检索程序 3.外挂程序)
	Description:
		大多数网站都有类别划分，分类下文章一般由文章号组成，例如：
			百度知道问题网址格式主要为http://zhidao.baidu.com/question/(编号).html，其中编号便是该问题的编号(PID)，
		由此，写出了 哟哟通用检索程序。
	Author:	贾朝藤
	Idea_From:	
		OSCHINA 一位网友分享的一段代码(http://www.oschina.net/code/snippet_189657_7625)以及自己和网友上网的一些需求(可作为不带搜素功能的网站的外挂程序)
	Function:

		1.可根据指定关键词遍历搜索网页，并可显示或保存网页
		2.替换/删除标题后缀
		3.截取保存html内容
		4.文本模式检测当前任务进行到了哪里
		5.检索保存网页中图片
		6.php执行休眠/休眠_关机/重启指令
		7.文本模式显示任务进度
		8.伪原创(关键词替换)

	Function-ing:

		1.增加单一网页等待时间功能
		2.用户配置界面
		4.(在设置主板自动唤醒之后,可设置计划任务自动执行脚本，做每天自动采集任务)
		5.过滤所保存的图片中0KB大小的图片
		6.爬虫检索功能
		7.把检索任务分成多任务(多线程)同时下载
		9.数据库模式
		10.编码转换
		11.自动网摘和百度搜藏
		12.爬蜘蛛(或添加指定链接)自动摘取文章内容与自己添加的链接词库想匹配发表回复
		13.计算每次采集的文章在百度/谷歌/搜搜中的重复度(一定条目中)
		14.对每篇伪原创文章加上本站相关内容链接
		15.对伪原创的内容去除来源网站链接加上本网站链接
		16.在本站发表之后，使用指定帐号自动把自己的内容发表到指定网站(加上 "原文来自……" 之类的信息)
		17.根据文章内容智能配图
		18.审核发表机制
		19.(每200-300字之间，可以适当添加2-3个锚文本链接)
		20.图片alt注释
		21.每个脚本都检测登陆，防止恶意传参执行
		22.防盗链?作假来路?
		23.直接导入服务器数据库/本地采集之后把数据导入服务器数据库
		24.采集出错处理(根据一定条件跳出当前次采集)
		25.入库前做好内容过滤，滤去不必要字符串
		26.类似迅雷式把采集做成任务模式
		27.

*/



	/*
	*	Description:	检索类
	*	其中:
	*		1.保存图片功能依赖于pic_save.php文件
	*		2.时间相关处理依赖于function.php里相应函数
	*		3.检索图片功能依赖于function.php里相应函数
	*		4.保存检索状态功能依赖于function.php文件里相应函数
	*
	*/
class retriever{

	private $Curcontent ;			//当前网页内容
	
	private	$Startid;				//开始检索id
	private	$Endid;					//结束检索id
	private	$Baseurl;				//基本url
	private	$Ext = '';				//扩展名
	private	$Nouse = 0;				//无效网页数

	private $Timestart;				//处理开始时间
	private $Timend	;				//处理结束时间


	/*
	*	Description:	构造函数，初始化参数
	*	Param:	1.$Startid	开始检索id
	*			2.$Endid	结束检索id
	*			3.$Baseurl	基本url
	*			4.$ext		扩展名
	*/
	function __construct( $Startid, $Endid, $Baseurl, $ext = '' ){

		$this->Startid = $Startid;
		$this->Endid = $Endid;
		$this->Baseurl = $Baseurl;
		$this->Ext = $ext;

		//脚本最大执行时间不限
		ini_set('max_execution_time', '0');

		echo "<br/>";
		echo "开始检索……";
		echo "<br/>";

	}
	
	/*
	*	Description:	检索网页
	*	Param:	1.$Operation		操作(a. show 搜索显示(默认) b. save 保存)
	*			2.$Seacontent		要搜索的内容(默认为空)
	*			3.$Oldtitle			被替换的标题
	*			4.$Newtitle			新标题
	*/
	public function RetrievePage( $Operation = '', $Seacontent = '', $Startag = '', $Endtag = '', $Oldtitle = '', $Newtitle = ' ' ){

		//记录检索开始时间
		$this->Timestart = microtime_float();

		//检索
		for ( $i = $this->Startid; $i <= $this->Endid; $i++ ){

			//生成目标url
			$targeturl = $this->Baseurl.$i.$this->Ext;

			//提示信息：正在遍历哪一网页
			echo '<br/>正在遍历编号为：<font color="red">'.$i.'</font>的网页……<br/>' ;

			//存储当前网页内容
			$this->Curcontent = file_get_contents($targeturl);
			
			if ( $this->Curcontent ){

				if( $content = $this->GetContent( $Startag, $Endtag, $Seacontent ) ){


					$titleold = $this->GetTitle();
					
					//替换标题
					if( $Oldtitle ){
						$oldpos = strpos( $titleold , $Oldtitle ) ;
						$title = substr_replace( $titleold , $Newtitle , $oldpos ) ;
					}

					echo '----------------------------------------------------------------------------------------------------------';
					echo '<p>获取目标网页：<a target="_blank" href="'.$targeturl.'" style= "color:#CC9900">'.$titleold.'</a>成功！</p>';

					//如果配置为"保存网页"的话，则保存网页
					if( $Operation == 'save' ){
						$handle = fopen("page/".$title.".html", "wb");
						if( fwrite( $handle,$content ) ){
							echo '<p>保存目标网页成功！</p>';
						}
						fclose( $handle );
					}
				}

			}else {
				echo '<p>获取网页：<a target="_blank" href="'.$targeturl.'" style= "color:#ff0000">'.$targeturl.'</a>失败！</p>' ;
				//错误网页数计值加1
				$this->Nouse = $this->Nouse + 1;
			}
			
			//保存当前检索状态
			$status_content = '编号为 <font color="red">'.$i.'</font> 的网页('.$title.')已检索完毕!<br/>即将检索下一个网页……';
			$save = save_file( 'status/', 'status.html', $status_content );
			if( $save === -1 ){
				echo "状态文件保存异常，请检查错误!";
			}

			$this->Curcontent = '';

		}
		
		//记录检索结束时间
		$this->Timend = microtime_float();
		
		//输出消耗时间
		echo "本次处理消耗时间".($this->Timend - $this->Timestart)."秒,共检索".($this->Endid - $this->Startid)."个网页,其中包含".$this->Nouse."个无效网页";

	}


	/*
	*	Description:	检索图片
	*	Param:	1.$Startag			起始标签
	*			2.$Endtag			结束标签
	*			3.$Savepath			保存路径
	*			4.$Newtitle			新标题
	*/
	public function RetrieveImg( $Startag = '', $Endtag = '', $Savepath = '' ){

		//记录检索开始时间
		$this->Timestart = microtime_float();

		//检索
		for ( $i = $this->Startid; $i <= $this->Endid; $i++ ){

			//生成目标url
			$targeturl = $this->Baseurl.$i.$this->Ext;

			//提示信息：正在遍历哪一网页
			echo '<br/>正在检索编号为：<font color="red">'.$i.'</font>的网页……<br/>' ;
			
			//存储当前网页内容
			$this->Curcontent = file_get_contents($targeturl);
			

			if ( $this->Curcontent ){
				

				if( $picarray = $this->GetPics ( $Startag, $Endtag ) ){

					echo '----------------------------------------------------------------------------------------------------------';
					echo '<p>目标网页：<a target="_blank" href="'.$targeturl.'" style= "color:#CC9900">'.$this->GetTitle().'</a>获取图片成功！</p>';
					
					//保存图片
					foreach( $picarray as $key => $value ){
						download_file($value,$Savepath);
					}

				}else{

					//网页中没有符合要求的图片
					echo '<p>您搜索的网页没有符合要求的图片!</p>';
				}


			}else {
				echo '<p>获取网页：<a target="_blank" href="'.$targeturl.'" style= "color:#ff0000">'.$targeturl.'</a>失败！</p>' ;
				//错误网页数计值加1
				$this->Nouse = $this->Nouse + 1;
			}
			
			$this->Curcontent = '';

		}
		
		//记录检索结束时间
		$this->Timend = microtime_float();
		
		//输出消耗时间
		echo "本次处理消耗时间".($this->Timend - $this->Timestart)."秒,共检索".($this->Endid - $this->Startid)."个网页,其中包含".$this->Nouse."个无效网页";

	}



	/*
	*	Description:	获取指定标签后的偏移位置
	*	Param:	1.$Tag				标签(例：'<title>')
	*/
	private function GetStart( $Tag ){
		$Tagstart = strpos( $this->Curcontent , $Tag ) ;
		return strpos( $this->Curcontent , '>' , $Tagstart ) + 1 ;
	}


	/*
	*	Description:	获取当前网页标题
	*	Param:	No Param
	*/
	public function GetTitle(){

		$start = $this->GetStart('<title>');
		$end = strpos( $this->Curcontent , '</title>' ) ;

		$title = substr( $this->Curcontent , $start , $end - $start ) ;

		return $title;
	}


	/*
	*	Description:	获取当前网页内容
	*	Param:	2.$Startag			开始标签
	*			3.$Endtag			结束标签
	*			4.$Seacontent		要搜索的内容(暂只支持一个关键词)
	*/
	public function GetContent ( $Startag = '', $Endtag = '', $Seacontent = '' ){

		$start = 0;

		if( $Startag ){
			$start = $this->GetStart($Startag);
		}

		if( $Endtag ){
			$end = strpos( $this->Curcontent, $Endtag );
			$length = $end - $start;
			$content = substr( $this->Curcontent, $start, $length );
		}else{
			$content = substr( $this->Curcontent, $start );
		}
		
		if( $Seacontent === '' ){
			return $content;
		}

		//如果没有找到指定关键词的话，返回FALSE
		if ( strpos( $content, $Seacontent ) === FALSE ){

			return FALSE;

		}
		return $content ;
	}

	/*
	*	Description:	获取当前网页图片url数组
	*	Param:	1.$Startag			开始标签
	*			2.$Endtag			结束标签
	*	@return	图片url数组
	*/
	public function GetPics ( $Startag = '', $Endtag = '' ){
		
		$content = $this->GetContent( $Startag, $Endtag, $Seacontent = '' );

		$start = '<img src="';
		$end = '" >';
		
		$picarray = strelem_to_array( $content, $start, $end );

		if( $picarray === -1 ){
			return -1;
		}

		return $picarray;
	}

}

?>