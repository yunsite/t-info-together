<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	<title><{$title}></title>

	<style type="text/css" media="screen">
	<!-- @import url( <{$sys_dir_base}>templates/blog/style.css ); -->
	</style>
</head>

<body>

<div id="wrap">

	<div id="stripe"></div>

	<!-- 顶部导航 -->
	<div id="nav">
		<ul>
			<li><a href="index.php?u=dairy">个人中心</a></li>
			<li class="selected"><a href="#">博客</a></li>
			<li style="float:right;font-size:12px;"></li>
		</ul>
	</div>
	<!-- End(顶部导航) -->
	
	<!-- masthead -->
	<div id="masthead">
		<h1><a href="#"><{$blogname}>的博客</a></h1>
		<h3>这家伙很懒,什么都没有留下!</h3>
		<div class="logo"><a href="#">T-Blog</a></div>
	</div>
	<!-- End(masthead) -->

	<div id="content">

		<!-- 左部文章内容 -->
		<div id="contentleft">
				
			<!-- 遍历输出文章内容 -->
				
				<!-- 文章标题 -->
				<h1><a href="#"><{$title}></a></h1>
				<!-- End(文章标题) -->
			
				<!-- 文章说明 -->
				<p style="font-size:12px;" class="date"><a href="#"><{$author}></a> | 发布时间: <{$pub_time}> | 最后修订: <{$lastmodi_time}> | <a href="#">没有评论</a></p>
				<!-- End(文章说明) -->
			
				<!-- 文章主题内容 -->
				<{$content}>
				<!-- End(文章主题内容) -->
				
				<div style="clear:both;"></div>

				<!-- 分类,标签 -->
				<div class="bt-links">
				<strong>分类:</strong> <a rel="category" title="查看 知识与实践经验 中的全部文章" href="#">知识与实践经验</a>, <a rel="category" title="查看 资讯 中的全部文章" href="#">资讯</a><br>
				<strong>Tags:</strong> <a rel="tag" href="#">编程</a> &gt; <a rel="tag" href="#">编程语言</a> &gt; <a rel="tag" href="#">软件开发</a>
				</div>
				<!-- End(分类,标签) -->

			<!-- End(遍历输出文章内容) -->
				
		</div>
		<!-- End(左部文章内容) -->
		


		<!-- begin r_sidebar -->
		<div id="r_sidebar">

			<!-- 一些说明 -->
			<li class="widget widget_text" id="text-2">
				<h2 class="widgettitle">关于我</h2>
				<div class="textwidget">
					<p><{$blogname}>的个人博客,欢迎光临哦!</p>
				</div>
			</li>
			<!-- End(一些说明) -->
			
			<!-- 近期文章 -->
			<li class="widget widget_recent_entries" id="recent-posts-2">		
				<h2 class="widgettitle">近期文章</h2>
				<ul>
					<li><a title="编程语言的进化" href="#">编程语言的进化</a></li>
					<li><a title="软件开发之时间估算浅析" href="#">软件开发之时间估算浅析</a></li>
					<li><a title="从程序员到项目经理（四）：外行可以领导内行吗" href="#">从程序员到项目经理（四）：外行可以领导内行吗</a></li>
					<li><a title="程序员的十大谎言" href="#">程序员的十大谎言</a></li>
					<li><a title="为什么我选择CentOS而不是Debian/Ubuntu" href="#">为什么我选择CentOS而不是Debian/Ubuntu</a></li>
				</ul>
			</li>
			<!-- End(近期文章) -->

			<!-- 分类目录 -->
			<li class="widget widget_categories" id="categories-2">
				<h2 class="widgettitle">分类目录</h2>
				<ul>
					<li class="cat-item cat-item-10"><a title="查看 协议开发 下的所有文章" href="#">协议开发</a></li>
					<li class="cat-item cat-item-9"><a title="查看 服务器开发 下的所有文章" href="#">服务器开发</a></li>
					<li class="cat-item cat-item-15"><a title="查看 游戏开发 下的所有文章" href="#">游戏开发</a></li>
					<li class="cat-item cat-item-5"><a title="查看 知识与实践经验 下的所有文章" href="#">知识与实践经验</a></li>
					<li class="cat-item cat-item-3"><a title="查看 资讯 下的所有文章" href="#">资讯</a></li>
					<li class="cat-item cat-item-8"><a title="查看 软件和黑客文化 下的所有文章" href="#">软件和黑客文化</a></li>
				</ul>
			</li>
			<!-- End(分类目录) -->

			<!-- 功能 -->
			<li class="widget widget_meta" id="meta-2">
				<h2 class="widgettitle">功能</h2>
				<ul>
					<li><a href="#">登录</a></li>
					<li><a title="使用 RSS 2.0 订阅本站点内容" href="#">文章 <abbr title="Really Simple Syndication">RSS</abbr></a></li>
					<li><a title="使用 RSS 订阅本站点的所有文章的近期评论" href="#">评论 <abbr title="Really Simple Syndication">RSS</abbr></a></li>
				</ul>
			</li>
			<!-- End(功能) -->

			<!-- 搜索 -->
			<li class="widget widget_search" id="search-2">
				<form action="#" id="searchform" method="get" role="search">
				<div>
					<label for="s" class="screen-reader-text">搜索：</label>
					<input type="text" id="s" name="s" value="">
					<input type="submit" value="搜索" id="searchsubmit">
				</div>
				</form>
			</li>
			<!-- End(搜索) -->

		</div>
		<!-- end r_sidebar -->

	</div>
	<!-- The main column ends  -->


</div>
<!-- end wrap -->



<!-- begin footer -->

<div style="clear:both;"></div>
<div style="clear:both;"></div>

<!-- Footer -->
<div id="footer">
	<p>本站点由<a href="#">T-sys</a>驱动, &copy; 2012 T-sys.org <br><a href="http://www.miibeian.gov.cn/">京ICP备09007496号-9</a></p>
</div>
<!-- End(Footer) -->

</body>

</html>