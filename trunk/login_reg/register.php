<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员注册</title>
</head>

<body>
<div align="center"><font face="楷书" size="+3">会员注册</font></div>
<form id="form1" name="form1" method="get" action="register_get.php">
  <table width="695" border="1" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td width="167">账号：(account)</td>
      <td width="416"><input name="m_acct" type="text" id="m_acct" value="<?php if(!empty($_GET['m_acct']))
echo $_GET['m_acct'];
?>" maxlength="20" />
		<font color="#FF0000"> *</font>（由20个数字或字母组成）</td>
    </tr>
    <tr>
      <td>密码：(password)</td>
      <td><input name="m_pw" type="password" id="m_pw" maxlength="20" />
      <font color="#FF0000"> *</font>（由20个数字或字母组成）</td>
    </tr>
    <tr>
      <td>确认密码(password)</td>
      <td><input type="password" name="pass" id="pass" />
      <font color="#FF0000"> *</font>（再次输入密码）</td>
    </tr>
    <tr>
      <td>真实姓名：(name)</td>
      <td><input type="text" name="m_name" id="m_name" value="<?php if(!empty($_GET['m_name']))
echo $_GET['m_name'];
?>" /></td>
    </tr>
    <tr>
      <td>性别：(sex)</td>
      <td align="left"><p>
        <label>
          <input name="m_sex" type="radio" id="RadioGroup1_0" value="男" />
          男</label>
        <label>
          <input type="radio" name="m_sex" value="女" id="RadioGroup1_1" />
          女&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000"> *</font></label>
</td>
    </tr>
    <tr>
      <td>学号：(school number)</td>
      <td><input type="text" name="m_snum" id="m_snum" value="<?php if(!empty($_GET['m_snum']))
echo $_GET['m_snum'];
?>" /></td>
    </tr>
    <tr>
      <td>手机号码：(mobil phone)</td>
      <td><input type="text" name="m_pnum" id="m_pnum" value="<?php if(!empty($_GET['m_pnum']))
echo $_GET['m_pnum'];
?>"/></td>
    </tr>
    <tr>
      <td>电子邮箱：(email)</td>
      <td><input type="text" name="m_email" id="m_email" value="<?php if(!empty($_GET['m_email']))
echo $_GET['m_email'];
?>"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="reset" name="button" id="button" value="重置表单" />
      <input type="submit" name="button2" id="button2" value="确定注册" /></td>
    </tr>
  </table>
</form></p>
<p align="center">以上打“*”为必填项</p>
</body>
</html>