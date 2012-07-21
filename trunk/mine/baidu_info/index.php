<?php

/*
*
*	@Description:	获取百度相关信息
*
*
*/

	//获取百度新闻网页信息
	$baidu_news = file_get_contents("http://home.baidu.com/news/news/");

	$news_start = stripos( $baidu_news, '<ul class="newsLsit1">' );
	$news_end = stripos( $baidu_news, '<div class="clear"></div>
    </ul>
' );

	//把</ul>后面的字符串删除
	$news_undone = substr_replace( $baidu_news, '', $news_end );
	
	//截取 经由上面处理后的字符串 ,得到ul列表
	$news_ul = substr( $news_undone, $news_start+22 );
	
	$news_ul = trim($news_ul);


	//$news_undone2 = strtr( $news_ul, '<li>', '    ' );
	//$news_undone2 = strtr( $news_undone2, '</li>', '' );


	$news_list_undone = explode( "\n", $news_ul );

	//使数组值唯一
	$news_list_undone = array_unique( $news_list_undone );

	//删除为空的元素
	unset( $news_list_undone[1] );
	
	$news_list = array();

	//过滤掉li标签前后的空白字符,并把其中的 新闻标题,链接,发布时间
	foreach( $news_list_undone as $key=>$value ){
	
		$news_list_undone[$key] = trim($value);

		//新闻链接
		$news_a_start = stripos( $news_list_undone[$key], 'http://' );
		$news_a_end = stripos( $news_list_undone[$key], '" target=' );
	
		$news_a = substr( $news_list_undone[$key], $news_a_start, ($news_a_end - $news_a_start) );

		//新闻标题
		$news_lname_start = stripos( $news_list_undone[$key], 'target="_blank">' );
		$news_lname_end = stripos( $news_list_undone[$key], '</a>' );
	
		$news_lname = substr( $news_list_undone[$key], $news_lname_start+16, ($news_lname_end - $news_lname_start)-16 );

		//新闻发布时间
		$news_ptime_start = stripos( $news_list_undone[$key], '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' );
		$news_ptime_end = stripos( $news_list_undone[$key], '</li>' );
	
		$news_ptime = substr( $news_list_undone[$key], $news_ptime_start+36, ($news_ptime_end - $news_ptime_start)-36 );

		//把时间转换为Unix时间戳
		$pub_year = (int)substr($news_ptime, 6,4);
		$pub_month = (int)substr($news_ptime, 0,2);
		$pub_day = (int)substr($news_ptime, 3,2);

		$news_ptime = mktime(0, 0, 0, $pub_month, $pub_day, $pub_year);

		$news_list[$key]['news_link'] = $news_a;
		$news_list[$key]['news_title'] = $news_lname;
		$news_list[$key]['news_pubtime'] = $news_ptime;

		//

	}


	print_r($news_list);

?>