<?php

	/*
	*	Description:	��֤����
	*
	*
	*/

	class ValidationCode{
	
		private $width;			//��֤��ͼƬ�Ŀ��
		private $height;		//��֤��ͼƬ�ĸ߶�
		private $codeNum;		//��֤����ĸ����
		private $checkCode;		//��֤���ַ���
		private $image;
		
		/*	(���Գɹ�!)
		*	@Description:	���캯��->��ʼ����֤��ͼƬ���,�߶Ⱥ���ĸ����

			@param	$witdh		��֤��ͼƬĬ�Ͽ��	|	60
					$height		��֤��ͼƬĬ�ϸ߶�	|	20
					$codeNum	��֤���ַ�Ĭ�ϸ���	|	4
		*
		*
		*/
		function __construct( $witdh=60, $height=20, $codeNum=4 ){
			

			$this->width = $witdh;
			$this->height = $height;
			$this->codeNum = $codeNum;

			//������֤���ַ���
			$this->checkCode = $this->createCheckCode();
		
		}

		/*	(���Գɹ�!)
		*	@Description:	ͨ�����ʸ÷���������������ͼ��

			@param	none
		*
		*
		*/
		function showImage(){
		
			$this->getCreateImage();
			$this->outputText();
			$this->setDisturbColor();
			$this->outputImage();

		}

		/*	(���Գɹ�!)
		*	@Description:	��ȡ�����������֤���ַ���

			@param	none
		*
		*
		*/
		function getCheckCode(){
		
			return $this->checkCode;

		}
		
		/*	(���Գɹ�!)
		*	@Description:	����ͼ����Դ,����ʼ����Ӱ

			@param	none
		*
		*
		*/
		private function getCreateImage(){
		
			//����ָ����С�Ļ���(���ڵ�ɫ��)
			$this->image = imageCreate( $this->width, $this->height );

			//������ɫ(��ɫ)
			$back = imagecolorallocate( $this->image, 255, 255, 255 );
			//������ɫ(��ɫ)
			$border = imagecolorallocate( $this->image, 0, 0, 0 );

			//��ͼ���л���һ������
			imageRectangle( $this->image, 0, 0, $this->width-1, $this->height-1, $border );

		}
		
		/*	(���Գɹ�!)
		*	@Description:	��������û�ָ����������֤���ַ���

			@param	none
		*
		*
		*/
		private function createCheckCode(){
			
			//��ʼ���ݴ�ƴ�ӱ���
			$ascii_number = '';

			//�������ָ��λ������֤���ַ���
			for( $i=0; $i<$this->codeNum; $i++ ){
			
				$number = rand(0,2);

				switch( $number ){
					
					//����0-9
					case 0: $rand_number = rand(48,57);break;
					//��ĸA-Z
					case 1: $rand_number = rand(65,90);break;
					//��ĸa-z
					case 2: $rand_number = rand(97,122);break;
				
				}

				$ascii = sprintf( "%c", $rand_number );
				$ascii_number = $ascii_number.$ascii;

			}
			
			return $ascii_number;

		}
		

		/*	(���Գɹ�!)
		*	@Description:	���ø���Ԫ��,��ͼ���������ͬ��ɫ��100����

			@param	none
		*
		*
		*/
		private function setDisturbColor(){
		
			for( $i=0; $i<100; $i++ ){
			
				$color = imagecolorallocate( $this->image, rand(0,255), rand(0,255), rand(0,255) );
				imagesetpixel( $this->image, rand( 1, $this->width-2 ), rand( 1, $this->height-2 ), $color );
			
			}
		
		}

		/*	(���Գɹ�!)
		*	@Description:	�����ɫ������ڷš�����ַ�����ͼ�������

			@param	none
		*
		*
		*/
		private function outputText(){
		
			for( $i=0; $i< $this->codeNum; $i++ ){
				
				//�����ɫ
				$bg_color = imagecolorallocate( $this->image, rand(0,255), rand(0,128), rand(0,255) );

				//x����
				$x = floor( $this->width/$this->codeNum )*$i + 3;

				//y����
				$y = rand( 0, $this->height-15 );

				//ˮƽ�ػ�һ���ַ�
				imagechar( $this->image, 5, $x, $y, $this->checkCode[$i], $bg_color );

			
			}

		}

		/*	(���Գɹ�!)
		*	@Description:	�Զ����GD֧�ֵ�ͼ������,�����ͼ��

			@param	none
		*
		*
		*/
		private function outputImage(){
		
			if( imagetypes() & IMG_GIF ){
			
				header("Content-type:image/gif");
				imagegif( $this->image );

			}elseif( imagetypes() & IMG_JPG ){

				header("Content-type:image/jpeg");
				imagegif( $this->image, "", 0.5 );

			}elseif( imagetypes() & IMG_PNG ){
			
				header("Content-type:image/png");
				imagegif( $this->image );

			}elseif( imagetypes() & IMG_WBMP ){
			
				header("Content-type:image/vnd.wap.wbmp");
				imagegif( $this->image );
			
			}else{
			
				die("PHP��֧��ͼ�񴴽�");

			}
		
		}

		/*	()
		*	@Description:	��������

			@param	none
		*
		*
		*/
		function __destruct(){
		
			imagedestroy( $this->image );

		}



	}

	$validation_code = new ValidationCode();
	//echo $validation_code->getCheckCode();
	echo $validation_code->showImage();
?>