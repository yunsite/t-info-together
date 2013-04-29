<?php

	/*
	*	Description:	保存网页图片至本地
	*	Author:	loveruguo(http://blog.csdn.net/loveruguo/article/details/6704736)
	*
	*
	*/

	/*
	*	Description:	保存网页中图片到本地
	*
	*	@param	$Url		网页URL(需为完整url,不能为相对url)
	*	@param	$SavePath	保存本地路径
	*	@return boolean
	*/
	//http://www.iwaimai.net/gmap/images/markers/red/marker$i.png
	function download_file($Url,$SavePath='img'){
		$filename = GetUrlFileName($Url);
		$content = file_get_contents($Url);
		return file_put_contents($SavePath.'/'.$filename,$content);
	}

	/*
	*	Description:	获取文件名
	*
	*	@param	$Url	网页URL(需为完整url,不能为相对url)
	*	@return string
	*/
	function GetUrlFileName( $Url ){
		$urlarray = parse_url( $Url );
		$filename = basename( $urlarray['path'] );
		return $filename;
	}

?>