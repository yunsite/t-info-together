<?php
	/*
	*	Description:	����������ڿ�����,��ʾ����������������ͼ(���������ʼ��վ��Ϣ��ʾ)
	*
	*
	*/

	class UserIndexController{
	
		//����ģ����(��������)
		private $controller_name = "�û�����";

		//����ģ��ģ����(ģ�����ʱ��)
		private $tpl_file = "shuoshuo_main";
		

		//�� $_GET��$_POST���� ��Ϊ���캯���Ĳ���,�����캯������
		function __construct( $arg_get = '', $arg_post = '' ){
		

			//print_r($tpl);

			//print_r($sys_charset);

			//print_r($arg_get);

			//print_r( $_COOKIE );

			//�޲ε��� IndexController������
			if( $arg_get['u'] == 'index' ){
			
				//����Ĭ��Action����(��ʼ����)��ʾ��ҳ
				$this->IndexAction();

				//����Ĭ�Ͽ�������ʾģ���,�Ͳ�����Ҫ��ʾ����Action������ģ����,���Խ�������
				die();

			}
			

			//���汻ע�͵���if...else...���ṹ�ǳ������ģʽ��һ��ʾ��
			/*
			if( $get/$post/... ){
			
				

			}else{
				
				xxx;

			}
			*/
		
		}
	
		/*
		*
		*	@Description:	��ʼ����,������ʼ��վ��Ϣ��ʾ
		*	@Param	None
		*	@Return
				string	$
				string	$
		*
		*
		*/
		private function IndexAction(){
			
			//echo "test";
			
			//print_r($tpl);

			//Smarty�������global.phpʵ������
			global $tpl,$sys_dir_base;
			
			//print_r($sys_charset);

			//echo "test";
			//print_r($tpl);

			$tpl->assign( "sys_dir_base",$sys_dir_base );
			$tpl->assign( "controller_name",$this->controller_name );
			$tpl->assign( "tpl_file",$this->tpl_file );
			$tpl->display("UserCenter/frame.tpl");
			

		}

	}

	//ʵ���� IndexController������
	$UserIndex = new UserIndexController( $_GET, $_POST );

?>