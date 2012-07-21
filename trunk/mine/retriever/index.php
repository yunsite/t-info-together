<?php
	
	/*
	*	Name:	测试执行文件
	*
	*
	*
	*/

	include("function.php");
	include("pic_save.php");
	include("retriever.php");

	//$Test = new retriever(1200,3000,'','.html');
	//$Test->RetrievePage( 'save', '', '<DIV class=title>', '</table>', '', '' );
	$Test = new retriever(708,710,'','.html');
	$Test->RetrievePage( 'save', '', '<DIV class=title>', '</table>', '', '' );
	//http://v57.demo.dedecms.com/a/webbase/div-css/2010/0407/21.html
	//$Test->RetrieveImg( '<DIV class=title>', '</table>', 'D:/img' );

?>