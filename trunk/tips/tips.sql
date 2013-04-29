#
#	tips_access程序sql文件
#


#创建数据库2012年2月17日 15:45:32
CREATE DATABASE `tips` ;

#创建表tips2012年2月17日 15:45:37
CREATE TABLE tips(content TINYTEXT) ENGINE = MYISAM DEFAULT CHARSET = utf8;

#删除表tips(没有主键，没有id字段)2012年2月17日 15:45:41
DROP TABLE `tips` 

#创建表tips2012年2月17日 15:49:16
CREATE TABLE tips(
	tip_id int NOT NULL AUTO_INCREMENT,
	content TINYTEXT NOT NULL,
	PRIMARY KEY (tip_id)
	)ENGINE = MYISAM DEFAULT CHARSET = utf8;