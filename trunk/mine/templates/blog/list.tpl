<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
	<title><{$blogname}>的博客</title>
	<meta name="keywords" content="<{$keywords}>"/>
	<meta name="description" content="<{$description}>"/>

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
			<{foreach from=$DairyList item=dry_list}>
				<!-- 文章标题 -->
				<h1><a href="index.php?u=dairy&a=read&did=<{$dry_list.dry_id}>"><{$dry_list.dry_title}></a></h1>
				<!-- End(文章标题) -->
			
				<!-- 文章说明 -->
				<p style="font-size:12px;" class="date"><a href="#<{$dry_list.dry_uid}>"><{$dry_list.author}></a> | 发布时间: <{$dry_list.dry_pubtime}> | 最后修订: <{$dry_list.dry_lmoditime}> | <a href="index.php?u=dairy&a=read&did=<{$dry_list.dry_id}>#commentblock"><{$dry_list.CommentNum}>条评论</a></p>
				<!-- End(文章说明) -->
			
				<!-- 文章主题内容 -->
				<p><{$dry_list.ContentBreif}></p>
				<p> <a class="more-link" href="index.php?u=dairy&a=read&did=<{$dry_list.dry_id}>">看完整文章</a></p>
				<!-- End(文章主题内容) -->
				
				<div style="clear:both;"></div>

				<!-- 分类,标签 -->
				<div class="bt-links">
				<strong>分类:</strong> <a rel="category" title="查看 <{$dry_list.DairysSort}>" href="index.php?u=dairy&a=read&sid=<{$dry_list.DairysSortId}>"><{$dry_list.DairysSort}></a><br>
				<strong>Tags:</strong> <a rel="tag" href="#">编程</a> &gt; <a rel="tag" href="#">编程语言</a> &gt; <a rel="tag" href="#">软件开发</a>
				</div>
				<!-- End(分类,标签) -->
			<{/foreach}>
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
				<{foreach from=$DairySort item=dry_sort}>
					<li class="cat-item cat-item-10"><a title="查看 <{$dry_sort.dry_stitle}>" href="index.php?u=dairy&a=read&sid=<{$dry_sort.dry_sid}>"><{$dry_sort.dry_stitle}></a></li>
				<{/foreach}>
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