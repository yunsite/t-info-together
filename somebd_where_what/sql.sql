#
#	@Description:	随机应用数据库文件
#
#

#创建数据库
CREATE DATABASE `rand_app_tx` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#创建 where表
CREATE TABLE rand_where (
  rid int(10) unsigned NOT NULL AUTO_INCREMENT,
  rcontent TEXT NOT NULL DEFAULT '',
  PRIMARY KEY (rid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#创建 what表
CREATE TABLE rand_what (
  wid int(10) unsigned NOT NULL AUTO_INCREMENT,
  wcontent TEXT NOT NULL DEFAULT '',
  PRIMARY KEY (wid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;