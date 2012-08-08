<?php

	/*
	*
	*	Description:	操作系统相关函数
	*
	*
	*
	*/


/*----------------------------------------系统启动管理--------------------------------------------*/

	/*
	*	Description:	休眠计算机(如果电脑没有启用休眠，执行此命令后系统将进入待机状态)
	*	@Param
	*		1.$time		执行休眠时间(格式为 xx:xx 例: 23:50)
	*		2.$
	*		3.$
	*	@return	无返回值
	*/
	function dormant_server( $time = '' ){

		//构造指令
		if( $time ){
			$command = 'at '.$time.' rundll32 powrprof.dll, SetSuspendState';
		}else{
			$command = 'rundll32 powrprof.dll, SetSuspendState';
		}

		shell_exec( $command );

	}

	/*
	*	Description:	关闭计算机
	*	@Param
	*		1.$time		执行关机时间(格式为 xx:xx 例: 23:50)
	*		2.$waitime	关机倒计时(秒 例:3600)(对于windows 2003 系统，有效范围是 0-600，默认为 30)
	*		3.$
	*	@return	无返回值
	*/
	function shutdown_server( $time = '', $waitime = '' ){

		//构造指令
		if( $time ){
			$command = 'at '.$time.' shutdown.exe -s';
		}else{
			$command = 'shutdown.exe -s';
		}

		if( $waitime ){
			$command = ' -t '.$waitime;
		}

		shell_exec( $command );

	}

	/*
	*	Description:	重启计算机
	*	@Param
	*		1.$time		执行重启时间(格式为 xx:xx 例: 23:50)
	*		2.$waitime	关机倒计时(秒 例:3600)(对于windows 2003 系统，有效范围是 0-600，默认为 30)
	*		3.$
	*	@return	无返回值
	*/
	function restart_server( $time = '', $waitime = '' ){

		//构造指令
		if( $time ){
			$command = 'at '.$time.' shutdown.exe -r';
		}else{
			$command = 'shutdown.exe -r';
		}

		if( $waitime ){
			$command = ' -t '.$waitime;
		}

		shell_exec( $command );

	}

	/*
	*	Description:	取消 关闭/重启计算机
	*	@Param
	*		1.$
	*		2.$
	*		3.$
	*	@return	无返回值
	*/
	function cancel_oper_server( ){

		$command = 'shutdown.exe -a';

		shell_exec( $command );

	}

	/*
	*	Description:	注销计算机当前用户
	*	@Param
	*		1.$
	*		2.$
	*		3.$
	*	@return	无返回值
	*/
	function logout_server( ){

		$command = 'shutdown.exe -l';

		shell_exec( $command );

	}

/*-------------------------------------------End(系统启动管理)----------------------------------------*/



/*-------------------------------------------文件系统管理---------------------------------------------*/

	/*
	*
	*	Description:	PHP操作硬件设备

	*	Function:

	*	Function-ing:

			1.通过汇编或者C语言修改BIOS(CMOS)主板信息,实现每天自动启动
			2.基于手册中 文件系统相关扩展 函数参考的一套类与函数实现
	*
	*/


/*-------------------------------------------End(文件系统管理)----------------------------------------*/



/*-------------------------------------------设备管理--------------------------------------------------*/

	/*
	*
	*	Description:	PHP操作硬件设备

	*	Function:

	*	Function-ing:

			1.通过汇编或者C语言修改BIOS(CMOS)主板信息,实现每天自动启动
	*
	*/


/*-------------------------------------------End(设备管理)---------------------------------------------*/






?>