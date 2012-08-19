<head>
	<title><{$controller_name}> — <{$title}></title>
	<meta name="keywords" content="<{$keywords}>" />
	<meta name="description" content="<{$description}>" />
	<meta http-equiv="Content-Type" content="text/html; charset=<{$charset}>"/>

	<!-- CSS -->
		<{include file="css/controlist.css" name="css"}>
	<!-- End(CSS) -->
</head>

<body>

	<div class="divBox">
		<div class="divBoxTitle">
			<span class="s_more"><a target="_blank" href="#" title="网页图标">产品列表</a></span>产品列表
		</div>

		<ul class="divBoxH76">
			
			<{foreach from=$controller_info item=info}>

				<li><a target="_blank" title="<{$info.controller_desc}>" href="<{$info.controller_url}>"><img width="218" height="76" border="0" src="<{$sys_dir_base}>templates/images/controllers_info/<{$info.controller_img}>" class="pic1"><br><{$info.controllername}></a></li>
			
			<{/foreach}>
		</ul>
	</div>

</body>