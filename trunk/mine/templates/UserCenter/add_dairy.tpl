<div class="user_main">

	<!-- 日志页头 -->
		<h4><img align="absmiddle" src="<{$sys_dir_base}>templates/images/diary.png"><span>日志</span></h4>
	<!-- End(日志页头) -->

	<!-- Ueditor相关包含文件 -->
	<script type="text/javascript" src="<{$sys_dir_base}>/includes/ueditor/editor_config.js"></script>
	<script type="text/javascript" src="<{$sys_dir_base}>/includes/ueditor/editor_all.js"></script>
	<link rel="stylesheet" href="<{$sys_dir_base}>/includes/ueditor/themes/default/ueditor.css">
	<!-- End(Ueditor相关包含文件) -->
	
	<!-- 日志提交表单 -->
		
		<form action="index.php?u=dairy" method="post">
		
			<!-- 日志标题 -->
			<div class="dry_title">
				<input type="text" value="" tabindex="1" name="dry_title"><span>限 80 字节</span>
				<div style="display:none;" class="error_info"></div>
			</div>
			<!-- End(日志标题) -->
			
			<!-- Ueditor显示 -->
			<script type="text/plain" id="myContent" name="myDairy"></script>
			<script type="text/javascript">
			    var editor = new baidu.editor.ui.Editor();
			    editor.render("myContent");
			</script>
			<!-- End(Ueditor显示) -->
			
			<!-- 日志设置项 -->
			<table width="100%" cellspacing="0" cellpadding="0" style=" table-layout:fixed;">
				<tbody>
					<!-- 日志分类 -->
					<tr class="tr3">
						<td width="62">日志分类</td>
						<td>
							<span class="dropdown mr10">
								<span class="dropselectbox" style="width: 95px;">
									<div class="fl">
										<ul style="width: 95px; display: none;"></ul>
									</div>
									<a hidefocus="true" href="javascript:;" style="width: 95px;">默认分类</a>
								</span>
								<select id="dtid_add" name="dtid" style="display: none;">
									<option value="0">默认分类</option>
								</select>
							</span>
							<span class="btn_add">
								<span>
									<button type="button" onclick="javascript:add_dtid('0','dtid_add');">添加分类</button>
								</span>
							</span>
						</td>
					</tr>
					<!-- End(日志分类) -->

					<!-- 隐私设置 -->
					<tr class="tr3">
					    <td>隐私设置</td>
					    <td>
						<span class="dropdown mr10">
							<span class="dropselectbox" style="width: 107px;">
								<div class="fl">
									<ul style="width: 107px; display: none;"></ul>
								</div>
								<a hidefocus="true" href="javascript:;" style="width: 107px;">全站可见</a>
							</span>
							<select onchange="optionsel(this.value,'1')" id="dtid_pvc" name="privacy" style="display: none;">
							    <option value="0">全站可见</option>
							    <option value="1">仅好友可见</option>
							    <option value="2">仅自己可见</option>
							</select>
						</span>

						<label class="mr10" for="if_copy">
							<input type="checkbox" checked="" value="1" name="ifcopy" id="if_copy">&nbsp;允许转载
						</label>

						<label id="lab_weibo" class="mr10" for="if_sendweibo">
							<input type="checkbox" checked="checked" value="1" name="ifsendweibo" id="if_sendweibo">&nbsp;同时发送到新鲜事
						</label>
						<!-- 将checked 替换成 checked="checked" -->
						<label style="display: none" for="atc_convert">
							<input type="checkbox" checked="checked" value="1" id="atc_convert" name="atc_convert">&nbsp;Wind Code自动转换
						</label>
					       
					    </td>
					</tr>
					<!-- End(隐私设置) -->

					<!-- 验证码 -->
					<tr class="tr3 vt">
					    <td>验证码:</td>
					    <td>
						<input type="text" tabindex="3" size="5" id="gdcode" name="gdcode" onfocus="showgd();" class="input">

						<span style="" id="ckcode"><img align="top" title="看不清楚，换一张" alt="看不清楚，换一张" onclick="changeCkImage(this)" class="cp sitegdcheck" src="http://www.phpwind.net/&amp;sessionid=56fa252c561879edbf5fbe9c394814d9&amp;&amp;nowtime=1347839466822" id="changeGdCode"><span id="changeGdCode_a" class="s4 cp" style="margin-left:3px;" onclick="changeCkImage(this.previousSibling);">换一个</span></span>
						
						<script type="text/javascript">
						var flashWidth = "90";
						var flashHeight = "30";
						var gdtype = 1;
						var cloudgdcode = 1;var cloudcaptchaurl = "&amp;sessionid=56fa252c561879edbf5fbe9c394814d9";var cloudmode=1;
						</script>
						<script src="js/pw_authcode.js" type="text/javascript"></script>
					    </td>
					</tr>
					<!-- End(验证码) -->

					<!-- 提交,存为草稿 -->
					<tr>
					    <td>&nbsp;</td>
					    <td>
					    <div class="p10">
						<span class="btn">
							<span><button type="submit" name="Submit">提 交</button></span>
						</span>
						<span class="bt">
							<span><button onclick="savedraft();return false;" class="w_bt" type="button">存为草稿</button></span>
						</span>
						</div>
					    </td>
					</tr>
					<!-- End(提交,存为草稿) -->
				</tbody>
			</table>
			<!-- End(日志设置项) -->

			<!-- 提交发布 -->
			<input type="submit" value="发布"/>
			<!-- End(提交发布) -->

		</form>
		
		
	<!-- End(日志提交表单) -->
</div>