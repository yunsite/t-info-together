<html>

	<!-- Head -->
		<{include file="UserCenter/head.tpl" name="head"}>
	<!-- End(Head) -->

	<body>
		<div class="main">

		<!-- Header -->
			<{include file="UserCenter/header.tpl" name="header"}>
		<!-- End(Header) -->
			
		<!-- Content -->
		<div class="content">

			<!-- Letf_Menu -->
				<{include file="UserCenter/left.tpl" name="left"}>
			<!-- End(Left_Menu) -->

			<!-- User_main -->
				<{include file="UserCenter/$tpl_file.tpl" name="footer"}>
			<!-- End(User_main) -->
		</div>
		<!-- End(Content) -->
			
		<!-- Footer -->
			<{include file="UserCenter/footer.tpl" name="footer"}>
		<!-- End(Footer) -->

		</div>
	</body>
</html>