<?php

	/*
	*	Description:	验证码类
	*
	*
	*/

	class ValidationCode{
	
		private $width;			//验证码图片的宽度
		private $height;		//验证码图片的高度
		private $codeNum;		//验证码字母个数
		private $checkCode;		//验证码字符串
		private $image;
		
		/*	(测试成功!)
		*	@Description:	构造函数->初始化验证码图片宽度,高度和字母个数

			@param	$witdh		验证码图片默认宽度	|	60
					$height		验证码图片默认高度	|	20
					$codeNum	验证码字符默认个数	|	4
		*
		*
		*/
		function __construct( $witdh=60, $height=20, $codeNum=4 ){
			

			$this->width = $witdh;
			$this->height = $height;
			$this->codeNum = $codeNum;

			//生成验证码字符串
			$this->checkCode = $this->createCheckCode();
		
		}

		/*	(测试成功!)
		*	@Description:	通过访问该方法向浏览器中输出图像

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

		/*	(测试成功!)
		*	@Description:	获取随机创建的验证码字符串

			@param	none
		*
		*
		*/
		function getCheckCode(){
		
			return $this->checkCode;

		}
		
		/*	(测试成功!)
		*	@Description:	创建图像资源,并初始化背影

			@param	none
		*
		*
		*/
		private function getCreateImage(){
		
			//创建指定大小的画布(基于调色板)
			$this->image = imageCreate( $this->width, $this->height );

			//设置颜色(白色)
			$back = imagecolorallocate( $this->image, 255, 255, 255 );
			//设置颜色(黑色)
			$border = imagecolorallocate( $this->image, 0, 0, 0 );

			//在图像中绘制一个矩形
			imageRectangle( $this->image, 0, 0, $this->width-1, $this->height-1, $border );

		}
		
		/*	(测试成功!)
		*	@Description:	随机生成用户指定个数的验证码字符串

			@param	none
		*
		*
		*/
		private function createCheckCode(){
			
			//初始化暂存拼接变量
			$ascii_number = '';

			//随机生成指定位数的验证码字符串
			for( $i=0; $i<$this->codeNum; $i++ ){
			
				$number = rand(0,2);

				switch( $number ){
					
					//数字0-9
					case 0: $rand_number = rand(48,57);break;
					//字母A-Z
					case 1: $rand_number = rand(65,90);break;
					//字母a-z
					case 2: $rand_number = rand(97,122);break;
				
				}

				$ascii = sprintf( "%c", $rand_number );
				$ascii_number = $ascii_number.$ascii;

			}
			
			return $ascii_number;

		}
		

		/*	(测试成功!)
		*	@Description:	设置干扰元素,向图像中输出不同颜色的100个点

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

		/*	(测试成功!)
		*	@Description:	随机颜色、随机摆放、随机字符串向图像中输出

			@param	none
		*
		*
		*/
		private function outputText(){
		
			for( $i=0; $i< $this->codeNum; $i++ ){
				
				//随机颜色
				$bg_color = imagecolorallocate( $this->image, rand(0,255), rand(0,128), rand(0,255) );

				//x坐标
				$x = floor( $this->width/$this->codeNum )*$i + 3;

				//y坐标
				$y = rand( 0, $this->height-15 );

				//水平地画一个字符
				imagechar( $this->image, 5, $x, $y, $this->checkCode[$i], $bg_color );

			
			}

		}

		/*	(测试成功!)
		*	@Description:	自动检测GD支持的图像类型,并输出图像

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
			
				die("PHP不支持图像创建");

			}
		
		}

		/*	()
		*	@Description:	析构函数

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