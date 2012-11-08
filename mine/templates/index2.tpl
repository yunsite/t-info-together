<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<{$charset}>">
		<link type="text/css" rel="stylesheet" href="<{$sys_dir_base}>templates/css/base.css">
		<title>登录 - <{$title}></title>
		<meta name="keywords" content="<{$keywords}>" />
		<meta name="description" content="<{$description}>" />

	</head>

	<body>

        <!--head_begin-->
        <div id="wrap">

			<!-- header_Logo部分 -->
			<div id="header-wrap">
				<div id="header">
					<div class="logo">
						<a href="">T-sys</a>
					</div>
					<div class="headerArrow"></div>
				</div>
			</div>
			<!-- End(header_Logo部分) -->

			<div class="clear"></div>

			<!--container_begin-->
			    <div class="container">
				<div class="w9 mar_auto top40">
							
							<!-- 内容Title -->
							<div class="regtop">
								<span class="f16_w f_left">登录T-sys</span>
								<span class="pad14">创建一个T-sys新帐号? <a href="index.php?reg=2" class="f13_w">在这里注册</a></span>
								<div class="clear"></div>
							</div>
							<!-- End内容Title) -->

							<!-- 内容主体 -->
							<div class="gb_f6 paddnewlogin">
								<div class="loginnew">

									<!-- 登陆框 -->
									<div class="loginboxnew">
										<form method="post" action="index.php?logio=1">
											<ul class="floatul login_new_add_weibo">
												
												<li class="padb10">
													<span style="color:red;"><{$error_info}></span>											
												</li>

												<li class="padb10">
													<label class="f16_ line26">用户名</label>
													<input name="username" class="inputtxt" value="" type="text">
												</li>

												<li>
													<label class="f16_ line26">密码</label>
													<input name="password" class="inputtxt" type="password">
												</li>
												<li class="w55">&nbsp;</li>
												<li class="hei40 lft3">
													<input style="margin-left:54px;" name="remember_me" checked="checked" type="checkbox">在这台电脑上记住我 <a href="忘记密码" class="c_90" style="margin-left:20px;">忘记密码?</a>
												</li>
												<li style="margin-top:10px;">
													<label class="f16 line26">&nbsp;</label>
													<button class="w90 cur" type="submit">登录</button>    
												</li>
												
											</ul>
											<div class="clear"></div>
										</form>
									</div>
									<!-- End(登陆框) -->
									
									<!-- 微博快速登陆 -->
									<div class="loginweibo">
										<p class="f14_" style="margin-bottom:20px;">您也可以使用以下账号快速登录</p>
										<p><a href="" id="oauth_link"><img src="<{$sys_dir_base}>templates/images/240.png" style="margin-bottom:2px; margin-right:2px"></a></p>
										<p style="color:#666;line-height:30px;"><input id="follow_dewen_weibo" checked="checked" type="checkbox">关注<a href="">T-sys官方微博</a></p>
									</div>
									<!-- End(微博快速登陆) -->

									<div class="clear"></div>

								</div>
							    </div>
							    <!-- End(内容主体) -->

				</div>
			    </div>
			<!--container_end-->


        </div>
        <!--footer_begin-->

	</body>
</html>