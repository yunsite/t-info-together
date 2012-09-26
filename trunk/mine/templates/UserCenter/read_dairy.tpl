<div class="user_main">
	<!-- 头部 -->
	<div>
		<!-- 标题 -->
		<p><{$title}></p>
		<!-- End(标题) -->

		<!-- 日志信息 -->
		<p>
			<!-- 作者 -->
			<span><{$author}></span>
			<!-- End(作者) -->

			<!-- 发布时间 -->
			<span><{$pub_time}></span>
			<!-- End(发布时间) -->

			<!-- 最后修订时间 -->
			<span><{$lastmodi_time}></span>
			<!-- End(最后修订时间) -->
		</p>
		<!-- End(日志信息) -->
	</div>
	<!-- End(头部) -->

	<!-- 日志正文 -->
	<div><{$content}></div>
	<!-- End(日志正文) -->
	
	<!-- 日志操作 -->
	<div>
		<span><a href="">修改</a></span>
		<span><a href="">删除</a></span>
	</div>
	<!-- End(日志操作) -->

	<!-- 评论部分 -->
	<div>
		<!-- 评论框 -->
		<textarea></textarea>
		<!-- End(评论框) -->
		
		<!-- 评论列表_需要分页 -->
		<div>
			<!-- 评论内容 -->
			<p><{$comment_content}></p>
			<!-- End(评论内容) -->

			<!-- 评论人 -->
			<span><{$comment_author}></span>
			<!-- End(评论人) -->

			<!-- 评论时间 -->
			<span><{$comment_time}></span>
			<!-- End(评论时间) -->

			<!-- 修改评论 -->
			<span><{$comment_modi}></span>
			<!-- End(修改评论) -->

			<!-- 删除评论 -->
			<span><{$comment_dele}></span>
			<!-- End(删除评论) -->
		</div>
		<!-- End(评论列表_需要分页) -->
	</div>
	<!-- End(评论部分) -->
</div>